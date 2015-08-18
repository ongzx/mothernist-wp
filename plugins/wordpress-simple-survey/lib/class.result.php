<?php
/**
 *  Class to handle saving quiz submissions
 *  and quiz export. 
 */
class WPSS_Result{

  const DB = 'wpss_results_30';
  const PAGED = 15;
  const SHORTCODE_SCORE = 'wp_simple_survey_result_score';
  const SHORTCODE_FULL_RESULTS = 'wp_simple_survey_result_full_summary';


  public function __construct($load = NULL){
    if(is_array($load)) $this->get_results($load); 
  }


 /**
  *  Grabs submission from $_POST, parses into manageable data structure
  *  and saves into database if admin option set, and emails users result.
  */
  public function parse_results($data){
    global $wpdb;

    if(empty($data['wpss'])) return '';
    $results = $data['wpss'];
    $quiz = new WPSS_Quiz($results['quiz']['id']);
    if(empty($quiz)) return '';

    $this->quiz_id = (int) $quiz->id;
    $this->quiz = $quiz;
    $this->submitter_id = $results['quiz']['submitter_id'];
    $this->wp_user_id = get_current_user_id();
    $this->posted_results = $results;
    $this->submitter_ip_address = $_SERVER['REMOTE_ADDR'];
    $this->submitted_at = current_time('mysql', 1);
    $this->email_header_compatibility = get_option('wpss_email_header_compatibility', 'pass_explicitly_to_wp_mail');

    $result = array();
    $result['quiz_id'] = (int) $quiz->id;
    $result['data'] = $this->parse_data( $results );
    $result['wp_user_id'] = get_current_user_id();
    $result['score'] = $this->score;
    $result['ip_address'] = $this->submitter_ip_address;
    $result['submitter_id'] = $this->submitter_id;
    $result['submitted_at'] = $this->submitted_at;

    if( $quiz->store_results == '1' ){
      $wpdb->insert( WPSS_RESULT_DB, $result );
    }
    $this->send_admin_email(); 
    if( $quiz->send_user_email == '1' ){
      $this->send_user_email();
    }
  }


 /**
  *  Pull results from a specified quiz.
  *  Sets results array in $this->quiz_results.
  *  Paginated results by parameters.
  *
  *  @param array $load
  *         int   $load['quiz_id']
  *         int   $load['start']
  */
  public function get_results( $load ){
    global $wpdb;
    $quiz_id = (int) $load['quiz_id'];
    $offset = (int) $load['offset'];
    
    $r = $wpdb->get_results("SELECT * FROM ".WPSS_RESULT_DB." WHERE quiz_id='$quiz_id';");
    $this->quiz_results = $r;
  }


  public static function where( $args, $offset=0 ){
    global $wpdb;

    $w = '';
    foreach( $args as $column => $value ){
      $w .= " $column='$value' ";
    }
    $sql = "SELECT * FROM ".WPSS_RESULT_DB." WHERE $w ORDER BY id DESC LIMIT ".WPSS_Result::PAGED." OFFSET $offset";

    $results = $wpdb->get_results( $sql, OBJECT );
    foreach( $results as $result ){
      $result->data = unserialize( $result->data );
    }

    return $results; 
  }


 /**
  * Get and load one results by id
  */
  public static function find( $id ){
    global $wpdb;
    
    $id = (int) $id;
    $result = new WPSS_Result();
    $raw_result = $wpdb->get_row("SELECT * FROM ".WPSS_RESULT_DB." WHERE id='".$id."';");

    $attributes = get_object_vars( $raw_result );
    foreach( $attributes as $attr => $val ) {
      $result->$attr = $val;
    }

    $result->quiz = WPSS_Quiz::find( $result->quiz_id );
    $result->data = unserialize( $result->data );

    # Convert timestamp to local time.
    #$result->started_at = date( "Y-m-d H:i:s", $result->data['meta']['started_at'] );
    $result->started_at = $result->data['meta']['started_at'];

    return $result;
  }


  public static function count( $quiz_id = '' ){
    global $wpdb;

    if( empty( $quiz_id ) ){
      $i = $wpdb->get_var( "SELECT COUNT(*) FROM ".WPSS_RESULT_DB );
    } else {
      $quiz_id = (int) $quiz_id;
      $i = $wpdb->get_var( "SELECT COUNT(*) FROM ".WPSS_RESULT_DB." WHERE quiz_id=$quiz_id" );
    }

    return ( $i == NULL ) ? 0 : $i;
  }


  public static function pages( $quiz_id = '' ){
    return ceil( WPSS_Result::count($quiz_id) / WPSS_Result::PAGED );
  }



 /**
  *  Pull in questions and answers into data structure for staorage.
  */
  private function set_posted_ids($questions){
    $this->question_ids = array();
    $this->answer_ids = array();

    $question_ids = array();
    $answer_ids = array();
    foreach($questions as $question_id => $ans_ids){
      $question_ids[] = (int) $question_id;
      foreach($ans_ids as $answer_id){
        $answer_ids[] = (int) $answer_id;
      }
    }
    $this->question_ids = $question_ids;
    $this->answer_ids = $answer_ids;
  }



 /**
  * Convert posted result into data ready to be stored.
  * Adds transient data store when quiz is first outputted.
  */
  private function parse_data( $results ){

    $results['meta'] = get_transient( $this->submitter_id );

    $this->started_at = $results['meta']['started_at'];
    $this->set_questions( $results );
    $this->set_fields( $results );
    $this->set_route( $results );
    $this->set_wp_user_data( $results );

    return serialize( $results );
  }


 /**
  * Get question and answer text from database to store with result.
  * This allows admin the change questions without affecting existing results.
  */
  private function set_questions( &$results ){

    $results['full_results'] = array();
    $this->score = 0;
    foreach($results['questions'] as $question_id => $answer_ids){
      $qa = array();
      $q = $this->quiz->get_question_by_id( (int) $question_id );

      if( !empty( $q ) ){

        $qa['question_id'] = $q['question']->id;
        $qa['question_text'] = $q['question']->question;
        $qa['question_type'] = $q['question']->type;
        $qa['answer'] = $this->get_answer_value($q, $answer_ids);

        $results['full_results'][] = $qa;
      }
    }

    $this->full_results = $results['full_results'];
  }


 /**
  * Get answer text from chosen answer id or return free text value
  */
  private function get_answer_value( $question, $answer_ids ){
    if( !in_array( $question['question']->type, WPSS_Question::free_answer_question_type_ids() ) ){
      $a = array();
      $a['answer_ids'] = $answer_ids;
      $answer_texts = array();
      $a['score'] = 0;
      foreach( $answer_ids as $id ){
        $answer_texts[] = $this->quiz->get_answer_text_by_id( (int) $id );
        $a['score'] += (int) trim($this->quiz->get_answer_weight_by_id( (int) $id ));
      }
      $a['answer_text'] = implode( $answer_texts, ', ' );
      $this->score += (int) $a['score'];

      return $a;
    } else {
      $this->score += 0;
      return array( 'answer_text' => sanitize_text_field( $answer_ids[0] ), 'score' => 0);
    }
  }


 /**
  * Combine and set posted field values with database values settings.
  * This allows admin the change fields without affecting existing results.
  */
  private function set_fields( &$results ){

    $results['field_results'] = array();
    if( !empty($results['fields']) ){
      foreach( $results['fields'] as $field_id => $posted_value ){
        $f = array();
        
        $fv = $this->quiz->get_field_by_id($field_id);
  
        $f['field_id'] = $fv->id;
        $f['field_text'] = $fv->name;
        $f['field_type'] = $fv->meta_type;
        $f['required'] = $fv->required;
        $f['answer'] = sanitize_text_field( $posted_value );
  
        $results['field_results'][] = $f;
      }
    }

    $this->field_results = $results['field_results'];
  }


 /**
  * Calculates routes and puts into object for storage.
  */
  private function set_route( &$results ){
    $this->redirect_to = $this->get_route();

    $results['route_results'] = $this->redirect_to;
  }

 
 /**
  * Store WP User data with results
  */
  private function set_wp_user_data( &$results ){
    if( !empty( $results['meta']['wp_user_id']) && is_numeric($results['meta']['wp_user_id']) ){
      $user = get_userdata( (int) $results['meta']['wp_user_id'] );
      if( !empty( $user ) ) {
        $results['meta']['has_wp_user'] = true;
        $results['meta']['wp_user_login'] = $user->user_login;
        $results['meta']['wp_first_name'] = $user->first_name;
        $results['meta']['wp_last_name'] = $user->last_name;
        $results['meta']['wp_roles'] = implode( ', ', $user->roles );
        $results['meta']['wp_user_email'] = $user->user_email;
      }
    }
  }



 /**
  *  Get Route to redirect_to, assumes this->score already set.
  */
  public function get_route(){
    global $wpdb;

    $s = $this->score;
    $raw_route = $wpdb->get_row("SELECT * FROM ".WPSS_ROUTE_DB." WHERE $s >= from_score AND $s <= to_score AND quiz_id='".$this->quiz_id."' LIMIT 1");

    if( empty($raw_route) ){
      return array('name'=>'Route not found', 'url'=>'#route_not_found', 'msg' => 'Could not find route for corresponding score: ' . $s, 'error' => true );
    } else {

      $route = array();
      foreach( get_object_vars( $raw_route ) as $attr => $val ) {
        $route[$attr] = $val;
      }

      $route['error'] = false;
      return $route;
    }
  }






  public function destroy(){
    if( !empty( $this->id ) && is_numeric( $this->id) ){
      global $wpdb;
      $id = (int) $this->id;
      $sql = "DELETE FROM ".WPSS_RESULT_DB." WHERE id='$id'";
      return $wpdb->query( $sql );
    } 
  }



  public static function custom_field_values_preview( $field_results ){
    $f = array();
    foreach( $field_results as $field ){
      $f[] = trim($field['answer']);
    }
    return wpss_text_preview( implode( ', ', $f ), 60 );
  }





  /** ------------------------------------------------------------------*/
  /* Emailing functions                                                 */
  /** ------------------------------------------------------------------*/


  private function send_admin_email(){
    $msg = wpss_admin_email_content( $this );
    $subject = '[' . get_bloginfo('name') . '] ' . $this->quiz->title . ' - New Quiz Submitted';
    $send_to = array();
    $send_to[] = $this->quiz->admin_email_addr;
    
   /**
    * Optionally send main admin email
    */
    if( $this->quiz->send_admin_email == '1' ){
      if($this->email_header_compatibility == 'pass_explicitly_to_wp_mail'){
        $headers   = array();
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset="'.get_option('blog_charset').'"';
        $headers[] = 'From: '.$this->quiz->admin_email_addr;
        $headers[] = 'Reply-To: '.$this->quiz->admin_email_addr;
        $headers[] = 'X-Mailer: PHP/'. phpversion();

        wp_mail($send_to, $subject, $msg, implode("\r\n",$headers));

      } elseif($this->email_header_compatibility == 'set_with_callbacks'){

        add_filter('wp_mail_content_type', 'wpss_set_content_type_html');
        add_filter('wp_mail_from', array($this, 'wp_mail_from_callback'));
        wp_mail($send_to, $subject, $msg);
        add_filter('wp_mail_content_type', 'wpss_set_content_type_text');

      } elseif($this->email_header_compatibility == 'do_not_set_headers'){
        add_filter('wp_mail_content_type', 'wpss_set_content_type_html');
        wp_mail($send_to, $subject, $msg);
        add_filter('wp_mail_content_type', 'wpss_set_content_type_text');
      }
    }
  }


  private function send_user_email(){
    $msg = wpss_quiz_taker_email_content($this);
    $subject = $this->quiz->user_email_subject;
    $send_to = array();
    foreach( $this->field_results as $field ){
      if( $field['field_type'] == 'email_quiz_taker' && is_email($field['answer']) ){
        $send_to[] = $field['answer'];
      }
    }

    if(!empty($send_to)){
      if($this->email_header_compatibility == 'pass_explicitly_to_wp_mail'){
        $headers = array();
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset="'.get_option('blog_charset').'"';
        $headers[] = 'From: ' . $this->quiz->user_email_from_name . ' <' . $this->quiz->user_email_from_address . '>';
        $headers[] = 'Reply-To: ' . $this->quiz->user_email_from_name . ' <' . $this->quiz->user_email_from_address . '>';
        $headers[] = 'X-Mailer: PHP/'. phpversion();

        wp_mail($send_to, $subject, $msg, implode("\r\n", $headers));

      } elseif($this->email_header_compatibility == 'set_with_callbacks'){

        add_filter('wp_mail_content_type', 'wpss_set_content_type_html');
        add_filter('wp_mail_from', array($this, 'wp_mail_from_callback'));
        add_filter('wp_mail_from_name', array($this, 'wp_mail_from_name_callback'));
        wp_mail($send_to, $subject, $msg);
        add_filter('wp_mail_content_type', 'wpss_set_content_type_text');

      } elseif($this->email_header_compatibility == 'do_not_set_headers'){
        add_filter('wp_mail_content_type', 'wpss_set_content_type_html');
        wp_mail($send_to, $subject, $msg);
        add_filter('wp_mail_content_type', 'wpss_set_content_type_text');
      }
    }
  }

  public function wp_mail_from_callback($original){
    $mail_from = $this->quiz->user_email_from_address;
    if(!empty($mail_from)){
      return $mail_from;
    } else {
      return $original;
    }
  }

  public function wp_mail_from_name_callback($original){
    $mail_from_name = $this->quiz->user_email_from_name;
    if(!empty($mail_from_name)){
      return $mail_from_name;
    } else {
      return $original;
    }
  }

  /** ------------------------------------------------------------------*/
  /* CSV functions                                                      */
  /** ------------------------------------------------------------------*/


  public static function static_csv_headers(){
    $h = array();
    $h[] = 'id';
    $h[] = 'title';
    $h[] = 'quiz_id';
    $h[] = 'started';
    $h[] = 'submitted';
    $h[] = 'route name';
    $h[] = 'route_id';
    $h[] = 'route from score';
    $h[] = 'route to score';
    $h[] = 'routed to';
    $h[] = 'score';
    $h[] = 'submitter_id';
    $h[] = 'submit text';
    $h[] = 'ip address';
    $h[] = 'WP User Login';
    $h[] = 'WP First Name';
    $h[] = 'WP Last Name';
    $h[] = 'WP User Email';
    $h[] = 'WP Roles';
    $h[] = 'WP User ID';

    return $h;
  }  



  /** ------------------------------------------------------------------*/
  /* Displaying Results To User Functions                               */
  /** ------------------------------------------------------------------*/
  public static function get_result_by_submitter_id($submitter_id){
    global $wpdb;
    
    $result = new WPSS_Result();
    $raw_result = $wpdb->get_row("SELECT * FROM ".WPSS_RESULT_DB." WHERE submitter_id='".$submitter_id."';");

    if( !empty( $raw_result ) ) {
      $attributes = get_object_vars( $raw_result );
      foreach( $attributes as $attr => $val ) {
        $result->$attr = $val;
      }
  
      $result->quiz = WPSS_Quiz::find( $result->quiz_id );
      $result->data = unserialize( $result->data );
      $result->started_at = $result->data['meta']['started_at'];

      return $result;
    } else {
      return NULL;  
    }
  }

}
?>

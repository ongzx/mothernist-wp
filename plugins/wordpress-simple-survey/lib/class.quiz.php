<?php
/** 
 *  WordPress Simple Survey - Quiz Class
 *  Loads, Saves and Deletes Quizzes along with associated
 *  questions and answers.
 */
class WPSS_Quiz{

  const DB = 'wpss_quizzes_30';

 /**
  *  Create Quiz Object. 
  *  Preload with a quiz through $id
  *
  *  @param int $id loads quiz and Q&A's by database id
  *  @param string $id : 'All' will load all quiz records into $quizzes
  *  @param string $id : 'New' will load new quiz with defaults
  */
  public function __construct($id = 'All') { 

    if(is_numeric($id)) $this->load_quiz($id);
    elseif($id == 'All') $this->load_index();
    elseif($id == 'New') $this->load_new();
    elseif($id == 'Create') $this->create();
    elseif($id == 'update') $this->update();
    elseif($id == 'delete') $this->destroy();
  }
 


 /**
  *  Load Quiz into object by mapping DB record to object attributes.
  *  Loads questions in $this->questions: 
  *      array( array(question=>$q, answers=>array( array(answer=>$a, weight=>$w)...) ) ...)
  *
  *  @param int $id, database id of quiz record
  */
  public function load_quiz($id){
    global $wpdb;
    $q = $wpdb->get_results('SELECT * FROM '.WPSS_QUIZ_DB.' WHERE id="'.$id.'" LIMIT 1');
    $quiz = stripslashes_deep($q[0]);
    if(empty($quiz)) return '';

    $attributes = get_object_vars($quiz);
    foreach($attributes as $attr => $val){
      $this->$attr = $val;
    }
    $this->new = false;
   
    $this->questions = new WPSS_Question(array('quiz_id'=>$id));
    if( $this->questions->question_count > 0 && !is_admin()  && $this->question_order == 'random_order' ){
      shuffle( $this->questions->questions );
    }
    $this->routes = new WPSS_Route(array('quiz_id'=>$id));
    $this->fields = new WPSS_Field(array('quiz_id'=>$id));

    if( !empty($this->questions) && !empty($this->questions->questions) ){
      $this->questions_count = count( $this->questions->questions );
    }
  }




 /**
  *  Load all quizzes into $this->quizzes
  *  Stripslashes on DB return values.
  */
  public function load_index($load_qa = false){
    global $wpdb;
    if(!$load_qa){
      $q = $wpdb->get_results('SELECT * FROM '.WPSS_QUIZ_DB.' ORDER BY id');
      $this->quizzes = stripslashes_deep($q);
    }

  }



 /**
  * Return quiz object by id.
  */
  public static function find( $id ){
    global $wpdb;
    
    $id = (int) $id;
    $quiz = new WPSS_Quiz();
    $quiz->raw_result = $wpdb->get_row("SELECT * FROM ".WPSS_QUIZ_DB." WHERE id='".$id."';");

    $attributes = get_object_vars( $quiz->raw_result );
    foreach( $attributes as $attr => $val ) {
      $quiz->$attr = $val;
    }

    return $quiz;
  }



 /**
  *  Load defaults into class attributes
  */
  public function load_new(){
    $current_user = wp_get_current_user();

    $this->new = true;
    $this->title = "New Survey or Quiz";
    $this->submit_txt = "Thank you for taking our survey.";
    $this->submit_button_txt = "Click to Submit";
    $this->store_results = true;
    $this->send_admin_email = true;
    $this->admin_email_addr = $current_user->user_email;
    $this->send_user_email = true;
    $this->user_email_content = '<p>Thank you for taking our [quiztitle]</p>
                                 <p>You scored [score] and were routed to:<br />[routed]</p>
                                 <div>Summary:<br /><div>[answers]</div></div>';
    $this->user_email_subject = '[' . get_bloginfo('name') . '] ' . 'Thank you for taking our quiz!';
    $this->user_email_from_name = "WP-Simple-Survey";
    $this->user_email_from_address = $current_user->user_email;
    $this->question_order = 'display_order';
    $this->show_title = true;
  }




 /**
  *  Create new quiz record from $_POST
  *  Set $this->saved on success.
  *  Set $this->insert_id to $wpdb->insert_id.
  */
  private function create(){
    $this->saved = false;
    if(empty($_POST)) return '';
    if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
      $quiz = $_POST['wpss'];
      if(empty($quiz)) return '';
      global $wpdb;
      $this->saved = $wpdb->insert(WPSS_QUIZ_DB, $this->prepare($quiz));
      $this->insert_id = $wpdb->insert_id;
    }
  }




 /**
  *  Update quiz record and call update functions. 
  */
  private function update(){
    $this->saved = false;
    if(empty($_POST)) return '';
    if(function_exists('is_admin') && is_admin()){
      if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
        $quiz = $_POST['wpss'];
        if(empty($quiz)) return '';
        global $wpdb;
        $this->saved = $wpdb->update(WPSS_QUIZ_DB, $this->prepare($quiz), array('id'=>$quiz['id']));
      }
    }
  }





 /**
  *  Converts array input values into 
  *  values need for database storage
  *
  *  @param array $q : raw quiz associative array from $_POST
  *  @return array : array prepared for database insertion
  */
  private function prepare($q){
    $attributes = array();
    foreach($q as $attr => $val){
      $attributes[$attr] = $val; 
    }
    $bools = array('store_results', 'send_admin_email', 'send_user_email', 'show_title');
    foreach($bools as $b) {
      $attributes[$b] = empty($q[$b])? 0 : 1;
    }
    
    unset($attributes['id']);
    return $attributes;
  }





 /**
  *  Delete quiz record from $_POST
  *  Set $this->deleted on success.
  */
  private function destroy(){
    if(empty($_POST) || empty($_POST['wpss'])) return '';
    if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
      $quiz = $_POST['wpss'];
      global $wpdb;
      $this->deleted = $wpdb->query('DELETE FROM '.WPSS_QUIZ_DB.' WHERE id="'.$quiz['id'].'"');
    }
  }


 /**
  *  Used in testing and WP Shell.
  */
  public function destroy_all(){
    global $wpdb;
    $wpdb->query( 'DELETE FROM '.WPSS_QUIZ_DB );
    $wpdb->query( 'DELETE FROM '.WPSS_QUESTION_DB );
    $wpdb->query( 'DELETE FROM '.WPSS_ANSWER_DB );
    $wpdb->query( 'DELETE FROM '.WPSS_ROUTE_DB );
    $wpdb->query( 'DELETE FROM '.WPSS_RESULT_DB );
  }

 /**
  *  Stores a unique submitter_id and other meta data using Transients API.
  *  Dat gets pulled, matched, and stores on quiz result store.
  */
  public function create_submitter_id(){
    $data = array();
    $submitter_id = uniqid("wpss_");
    $this->submitter_id = $submitter_id;
    $this->wp_user_id = get_current_user_id();

    $data['quiz_id'] = $this->id;
    $data['title'] = $this->title;
    $data['started_at'] = current_time('mysql', 1);
    $data['wp_user_id'] = $this->wp_user_id;

    set_transient( $submitter_id, $data, 60*60*24*7 );
  }



 /** Member functions relating to child objects */


 /**
  *  Loads requested quiz question into $this->question
  */
  public function load_question($id){
    $this->question = new WPSS_Question($id);
  }



 /**
  *  Return quiz subquestion text by quiestion id.
  */
  public function get_question_text_by_id( $question_id ){
    $question_text = '';

    if( !empty($this->questions) && !empty($this->questions->questions) ){
      foreach( $this->questions->questions as $question ){
        if( $question['question']->id == $question_id ) {
          $question_text = $question['question']->question;
          break;
        }
      }
    }
    return $question_text;
  }

 /**
  *  Return quiz question by quiestion id.
  */
  public function get_question_by_id( $question_id ){
    $q = '';

    if( !empty($this->questions) && !empty($this->questions->questions) ){
      foreach( $this->questions->questions as $question ){
        if( $question['question']->id == $question_id ) {
          $q = $question;
          break;
        }
      }
    }
    return $q;
  }

 /**
  * Return answer text from id.
  */
  public function get_answer_text_by_id($answer_id){
    $answer_text = '';

    if( !empty($this->questions) && !empty($this->questions->questions) ){
      foreach( $this->questions->questions as $question ){
        foreach( $question['answers'] as $answer ) {
          if( $answer->id == $answer_id ){
            $answer_text = $answer->answer;
          }
        }
      }
    }

    return $answer_text;
  }


 /**
  * Return answer weight from id.
  */
  public function get_answer_weight_by_id($answer_id){
    $answer_weight = 0;

    if( !empty($this->questions) && !empty($this->questions->questions) ){
      foreach( $this->questions->questions as $question ){
        foreach( $question['answers'] as $answer ) {
          if( $answer->id == $answer_id ){
            $answer_weight += (int) $answer->weight;
          }
        }
      }
    }

    return $answer_weight;
  }


 /**
  *  Return field object from id.
  */
  public function get_field_by_id( $field_id ){
    $f = '';

    if( !empty($this->fields) && !empty($this->fields->fields) ){
      foreach( $this->fields->fields as $field ) {
        if( $field->id == $field_id ) {
          $f = $field;
          break;
        }
      }
    }

    return $f;
  }


}
?>

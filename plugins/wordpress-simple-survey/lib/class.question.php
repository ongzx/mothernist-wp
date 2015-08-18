<?php
/**
 *  Quiz Questions
 */
class WPSS_Question{
 
  const DB = 'wpss_questions_30';

 /**
  *  Contruct Question object, define question types.
  *
  *  @param array $load contains quiz_id to load
  *  @param int $load load question with this id
  */
  public function __construct($load = ''){
    
    if(is_array($load)) $this->load_quiz($load['quiz_id']);
    elseif($load=='New') $this->load_new();
    elseif($load=='new' || is_numeric($load)) $this->load_question($load);
    elseif($load=='create') $this->create();
    elseif($load=='update') $this->update();
    elseif($load=='delete') $this->destroy();

    $this->set_question_types();
  }




 /**
  *  Load array of questions associated with a quiz
  *  into $this->questions:
  *    array( array( question=>$q, 
  *                    answers=>array(
  *                      array(ans=>$a, $weight=>$w)...))...)
  *
  *  @param int $quiz_id id to pull questions from
  */
  public function load_quiz($quiz_id){
    global $wpdb;
    $questions = $wpdb->get_results('SELECT * FROM '.WPSS_QUESTION_DB.' WHERE quiz_id="'.$quiz_id.'" ORDER BY display_order ASC, id ASC');
    $answers = $wpdb->get_results('SELECT * FROM '.WPSS_ANSWER_DB.' WHERE quiz_id='.$quiz_id. ' ORDER BY display_order ASC, id ASC');

    $qs_and_as = array();
    foreach($questions as $question){
      $q_ans = array('question'=>$question);
      $an = array();
      foreach($answers as $answer){
        if($question->id == $answer->question_id){
          $an[] = $answer;
        }
      }
      $q_ans['answers'] = $an;
      $qs_and_as[] = $q_ans;
    }

    $this->question_count = !empty($questions)? count($questions) : 0;
    $this->questions = stripslashes_deep($qs_and_as);
  }


 /**
  *  Load default Q&A's for new quiz
  *  Uses the same format as $this->load_quiz
  */
  public function load_new(){
    $template = (object) array('id'=>'new', 'question'=>'Insert New Question', 'type'=>'0', 'display_order'=>0, 'new'=>true);
    $default = array('question'=>$template);
    $questions = array();
    $questions[] = $default;
    $this->questions = $questions;
  }



 /**
  *  Load Question attibutes into $this
  */
  public function load_question($id){
    if($id == 'new'){
      $this->id = 'new';
      $this->question = 'Insert New Question';
      $this->type = 0;
      $this->display_order = 0;
      $this->new = true;
    } 
    elseif(is_numeric($id)) {
    
      global $wpdb;
      $q = $wpdb->get_results('SELECT * FROM '.WPSS_QUESTION_DB.' WHERE id="'.$id.'" LIMIT 1');
      $question = stripslashes_deep($q[0]);
      if(empty($question)) return '';
  
      $attributes = get_object_vars($question);
      foreach($attributes as $attr => $val){
        $this->$attr = $val;
      }
      $this->new = false;


      $a = $wpdb->get_results('SELECT * FROM '.WPSS_ANSWER_DB.' WHERE question_id="'.$id.'" ORDER BY display_order ASC, id ASC');
      $this->answers = stripslashes_deep($a);

    }
  }
  

 

 /**
  *  Create new question record from $_POST
  */
  private function create(){
    $this->saved = false;
    if(empty($_POST)) return '';
    if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
        $question = $_POST['wpss'];
        if(empty($question)) return '';
        global $wpdb;
        $this->saved = $wpdb->insert(WPSS_QUESTION_DB, $this->prepare($question));
        $this->insert_id = $wpdb->insert_id;
    }
  }




 /**
  *  Update question record and call update functions
  *  Questions, Answers, Fields, and Routes
  */
  private function update(){
    $this->saved = false;
    if(empty($_POST)) return '';
    if(function_exists('is_admin') && is_admin()){
      if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
        $question = $_POST['wpss'];
        if(empty($question)) return '';
        global $wpdb;
        $this->saved = $wpdb->update(WPSS_QUESTION_DB, $this->prepare($question), array('id'=>$question['id']));
      }
    }
  }




 /**
  *  Converts array input values into 
  *  values need for database storage
  *
  *  @param array $q : raw question associative array from $_POST
  *  @return array : array prepared for database insertion
  */
  private function prepare($q){
    $attributes = array();
    foreach($q as $attr => $val){
      $attributes[$attr] = $val; 
    }
    /*
    $bools = array('store_results', 'send_admin_email', 'send_user_email');
    foreach($bools as $b) {
      $attributes[$b] = empty($q[$b])? 0 : 1;
    }
    */
    
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
      $question = $_POST['wpss'];
      global $wpdb;
      $this->quiz_id = (int) $question['quiz_id'];
      $this->deleted = $wpdb->query('DELETE FROM '.WPSS_QUESTION_DB.' WHERE id="'.$question['id'].'"');
    }
  }

 


 /**
  *  Set questions types. To add a question type
  *  add to array then create a view in views.answers.php
  *  wpss_answer_{$safe_type_name}()
  *  
  */
  public function set_question_types(){
    $this->question_types = array(
       array('name'=>'Only allow one Answer', 'safe'=>'radio', 'db'=>0),
    );
  }


 /**
  * Array of ids that correspond to question types that allow free input.
  */
  public static function free_answer_question_type_ids(){
    return array(3,4);  
  }

  public function is_free_answer_type(){
    return in_array( $this->type, $this->free_answer_question_type_ids() );
  }



 /**
  *  Turn DB $type as integer and turn into
  *  associated $safe_name.
  *
  *  @return string $safe_name from $this->question_types
  */
  public function get_safe_type($type_id){
    if(empty($this->question_types)) $this->set_question_types;

    foreach($this->question_types as $type){
      if($type_id == $type['db']) return $type['safe'];
    }
    /* failsafe */
    return 'radio';
  }


}
?>

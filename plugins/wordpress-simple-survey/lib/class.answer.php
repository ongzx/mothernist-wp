<?php
/**
 *  Class to manage Answers for Questions
 */
class WPSS_Answer{
 
  const DB = 'wpss_answers_30';

 /**
  *  Construct Object containing questions answers
  *
  *  @param array $load contains question_id to load answers for.
  *  @param int $load loads answer with this id
  */
  public function __construct($load){
    
    if(is_array($load)){
      $this->load_routes($load['question_id']);
    }
    elseif($load=='new' || is_numeric($load)) $this->load_answer($load);
    elseif($load=='create') $this->create();
    elseif($load=='update') $this->update();
    elseif($load=='delete') $this->destroy();
  }





 /**
  *  Return template answer set for new quiz
  *
  *  @return array : array('ans'=>$a, 'weight'=>$w)...
  */
  public function template_answer_set(){
    $answers = array();
    $answers[] = array('ans'=>'Insert New Answer', 'weight'=>0, 'display_order' => 0);
    $answers[] = array('ans'=>'Insert New Answer', 'weight'=>1, 'display_order' => 0);
    $answers[] = array('ans'=>'Insert New Answer', 'weight'=>5, 'display_order' => 0);

    return $answers; 
  }





 /**
  *  Loads answer from database or sets defaults for new
  */
  public function load_answer($load){
    if($load=='new'){
      $this->answer = "Insert new answer.";
      $this->weight = "1";
      $this->new = true;
      $this->display_order = 0;
    }
    elseif(is_numeric($load)) {
      
      global $wpdb;
      $a = $wpdb->get_results('SELECT * FROM '.WPSS_ANSWER_DB.' WHERE id="'.$load.'" LIMIT 1');
      $answer = stripslashes_deep($a[0]);
      if(empty($answer)) return '';
  
      $attributes = get_object_vars($answer);
      foreach($attributes as $attr => $val){
        $this->$attr = $val;
      }
      $this->new = false;
    }
  }


  
 /**
  *  Create new answer record from $_POST
  */
  private function create(){
    $this->saved = false;
    if(empty($_POST)) return '';
    if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
        $answer = $_POST['wpss'];
        if(empty($answer)) return '';
        global $wpdb;
        $this->saved = $wpdb->insert(WPSS_ANSWER_DB, $this->prepare($answer));
        $this->insert_id = $wpdb->insert_id;
        $this->question_id = (int) $answer['question_id'];
    }
  }




 /**
  *  Update answer record
  */
  private function update(){
    $this->saved = false;
    if(empty($_POST)) return '';
    if(function_exists('is_admin') && is_admin()){
      if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
        $answer = $_POST['wpss'];
        if(empty($answer)) return '';
        global $wpdb;
        $this->saved = $wpdb->update(WPSS_ANSWER_DB, $this->prepare($answer), array('id'=>$answer['id']));
      }
    }
  }




 /**
  *  Converts array input values into 
  *  values need for database storage
  *
  *  @param array $a : raw answer associative array from $_POST
  *  @return array : array prepared for database insertion
  */
  private function prepare($a){
    $attributes = array();
    foreach($a as $attr => $val){
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
  *  Delete route record from $_POST
  *  Set $this->deleted on success.
  */
  private function destroy(){
    if(empty($_POST) || empty($_POST['wpss'])) return '';
    if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
      $answer = $_POST['wpss'];
      global $wpdb;
      $this->question_id = (int) $answer['question_id'];
      $this->deleted = $wpdb->query('DELETE FROM '.WPSS_ANSWER_DB.' WHERE id="'.$answer['id'].'"');
    }
  }

}
?>

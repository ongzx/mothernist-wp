<?php
/**
 *  Input fields for quiz submission
 */
class WPSS_Field{
 
  const DB = 'wpss_fields_30';

 /**
  *  Construct Object containing quiz fields 
  *
  *  @param array $load contains quiz_id to load fields for.
  *  @param int $load loads field with this id
  *  @param string $load "New" : loads default fields
  */
  public function __construct($load){
 
    $this->name = "Field Name:";
    $this->required = 0;
    $mt = $this->field_types();
    $this->meta_type = $mt[0]['value'];
    $this->field_types = $this->field_types();
    $this->meta = '';
    $this->new = true;
    
    if(is_array($load)) $this->load_fields($load['quiz_id']);
    elseif($load == 'New') $this->load_new();
    elseif($load == 'new' || is_numeric($load)) $this->load_field($load);
    elseif($load == 'create') $this->create();
    elseif($load == 'update') $this->update();
    elseif($load == 'delete') $this->destroy();

    $this->load_types();
  }




 /**
  *  Load array of input fields associated with a quiz
  *  into $this->fields:
  *    array( array( id=>$id
  *                  name=>$n, 
  *                  required=>bool )...)
  *
  *  @param int $quiz_id id to get inputs for
  */
  public function load_fields($quiz_id){
    global $wpdb;
    $fields = $wpdb->get_results('SELECT * FROM '.WPSS_FIELD_DB.' WHERE quiz_id="'.$quiz_id.'"');

    $this->fields = $fields;
  }




 /**
  *  Loads field from database or sets defaults for new
  */
  public function load_field($load){
    if(is_numeric($load)) {
      
      global $wpdb;
      $f = $wpdb->get_results('SELECT * FROM '.WPSS_FIELD_DB.' WHERE id="'.$load.'" LIMIT 1');
      $field = stripslashes_deep($f[0]);
      if(empty($field)) return '';
  
      $attributes = get_object_vars($field);
      foreach($attributes as $attr => $val){
        $this->$attr = $val;
      }
      $this->new = false;
    }
  }





  

 /**
  *  Load default fields for new quiz
  */
  public function load_new(){
    $fields = 
      array( 
        (object) array( 'name' => 'Name:', 'required' => true, 'type' => 'string'),
        (object) array('name' => 'Email:', 'required' => true, 'type' => 'email'));
    $this->fields = $fields;
  }




 /**
  *  Load field types
  */
  public function load_types(){
    $types = array();
    $types['string'] = array('name'=>'String', 'value'=>'string');
    $types['email'] = array('name'=>'Email', 'value'=>'email');

    $this->types = $types;
  }



 /**
  *  Create new field record from $_POST
  */
  private function create(){
    $this->saved = false;
    if(empty($_POST)) return '';
    if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
        $field = $_POST['wpss'];
        if(empty($field)) return '';
        global $wpdb;
        $this->saved = $wpdb->insert(WPSS_FIELD_DB, $this->prepare($field));
        $this->insert_id = $wpdb->insert_id;
    }
  }




 /**
  *  Update field record
  */
  private function update(){
    $this->saved = false;
    if(empty($_POST)) return '';
    if(function_exists('is_admin') && is_admin()){
      if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
        $field = $_POST['wpss'];
        if(empty($field)) return '';
        global $wpdb;
        $this->saved = $wpdb->update(WPSS_FIELD_DB, $this->prepare($field), array('id'=>$field['id']));
      }
    }
  }




 /**
  *  Converts array input values into 
  *  values need for database storage
  *
  *  @param array $r : raw field associative array from $_POST
  *  @return array : array prepared for database insertion
  */
  private function prepare($r){
    $attributes = array();
    foreach($r as $attr => $val){
      $attributes[$attr] = $val; 
    }

    foreach($this->field_types() as $f){
      if( $attributes['meta_type'] == $f['name'] ){
        $attributes['meta_type'] == $f['value'];
      }
    }


    $bools = array('required');
    foreach($bools as $b) {
      $attributes[$b] = empty($r[$b])? 0 : 1;
    }
    
    unset($attributes['id']);
    return $attributes;
  }





 /**
  *  Delete field record from $_POST
  *  Set $this->deleted on success.
  */
  private function destroy(){
    if(empty($_POST) || empty($_POST['wpss'])) return '';
    if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
      $field = $_POST['wpss'];
      global $wpdb;
      $this->quiz_id = (int) $field['quiz_id'];
      $this->deleted = $wpdb->query('DELETE FROM '.WPSS_FIELD_DB.' WHERE id="'.$field['id'].'"');
    }
  }




 /**
  *  Return array of allowed field types.
  */
  public static function field_types(){
    $types = array();
    $types[] = array('name'=>'Text field', 'value'=>'text');
    $types[] = array('name'=>'Email Address (Quiz Taker)', 'value'=>'email_quiz_taker');
    $types[] = array('name'=>'Email Address', 'value'=>'email');

    return $types;
  }


}
?>

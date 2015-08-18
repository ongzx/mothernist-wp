<?php
/**
 *  Quiz Routes, connects score ranges to URLs
 */
class WPSS_Route{
 
  const DB = 'wpss_routes_30';


 /**
  *  Construct Object object
  *
  *  @param array $load contains quiz_id to load routes for.
  *  @param int $load load route with this id
  */
  public function __construct($load){
    if(is_array($load)) $this->load_routes($load['quiz_id']);
    elseif($load == 'New') $this->load_new();
    elseif($load=='new' || is_numeric($load)) $this->load_route($load);
    elseif($load=='create') $this->create();
    elseif($load=='update') $this->update();
    elseif($load=='delete') $this->destroy();
  }




 /**
  *  Load array of routes associated with a quiz
  *  into $this->routes:
  *    array( array( name=>$n, 
  *                  from=>$f,
  *                  to=>$t,
  *                  url=>$url)...)
  *
  *  @param int $quiz_id id to pull routes from
  */
  public function load_routes($quiz_id){
    global $wpdb;
    $routes = $wpdb->get_results('SELECT * FROM '.WPSS_ROUTE_DB.' WHERE quiz_id="'.$quiz_id.'"');
    
    $this->routes = $routes;
  }

  


 /**
  *  Load default routes for new quiz
  */
  public function load_new(){
    $u = get_site_url();
    $routes = 
      array( 
        (object) array('new'=>true, 'name'=>'Insert New Route', 'from_score'=>0, 'to_score'=>10, 'url'=>$u.'/success'));
    $this->routes = $routes;
  }




 /**
  *  Loads route from database or sets defaults for new
  */
  public function load_route($load){
    if($load=='new'){
      $this->name = "New Route";
      $this->from_score = "0";
      $this->to_score = "10";
      $this->url = get_site_url();
      $this->new = true;
    }
    elseif(is_numeric($load)) {
      
      global $wpdb;
      $r = $wpdb->get_results('SELECT * FROM '.WPSS_ROUTE_DB.' WHERE id="'.$load.'" LIMIT 1');
      $route = stripslashes_deep($r[0]);
      if(empty($route)) return '';
  
      $attributes = get_object_vars($route);
      foreach($attributes as $attr => $val){
        $this->$attr = $val;
      }
      $this->new = false;
    }
  }




 /**
  *  Create new route record from $_POST
  */
  private function create(){
    $this->saved = false;
    if(empty($_POST)) return '';
    if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
        $route = $_POST['wpss'];
        if(empty($route)) return '';
        global $wpdb;
        $this->saved = $wpdb->insert(WPSS_ROUTE_DB, $this->prepare($route));
        $this->insert_id = $wpdb->insert_id;
    }
  }




 /**
  *  Update route record
  */
  private function update(){
    $this->saved = false;
    if(empty($_POST)) return '';
    if(function_exists('is_admin') && is_admin()){
      if( wp_verify_nonce($_POST['wpss_crud'],'wpss_crud') ){
        $route = $_POST['wpss'];
        if(empty($route)) return '';
        global $wpdb;
        $this->saved = $wpdb->update(WPSS_ROUTE_DB, $this->prepare($route), array('id'=>$route['id']));
      }
    }
  }




 /**
  *  Converts array input values into 
  *  values need for database storage
  *
  *  @param array $r : raw route associative array from $_POST
  *  @return array : array prepared for database insertion
  */
  private function prepare($r){
    $attributes = array();
    foreach($r as $attr => $val){
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
      $route = $_POST['wpss'];
      global $wpdb;
      $this->quiz_id = (int) $route['quiz_id'];
      $this->deleted = $wpdb->query('DELETE FROM '.WPSS_ROUTE_DB.' WHERE id="'.$route['id'].'"');
    }
  }

}

?>

<?php
/**
 *  Util class for WPSS admin
 */
class WPSS_Util{

 /**
  *  Setup utility constants
  */
  function __construct(){
    $this->define_constants();
    $this->url = plugins_url()."/wordpress-simple-survey/";
    $this->assets = $this->url . 'assets/';
  }


 /**
  *  Define Constants used in script execution
  *  and load function files.
  */
  private function define_constants(){
    if(!defined('WPSS_UTIL')){
      global $wpdb;
      $prefix = strtolower($wpdb->prefix); /* http://core.trac.wordpress.org/ticket/19748 */
      require_once(WPSS_PATH."functions.php");
      $models = array( 'quiz', 'question', 'answer', 'route', 'field', 'result' );
      foreach( $models as $m ){
        require_once( WPSS_PATH . "lib/class.$m.php" );
        define( 'WPSS_'.strtoupper($m).'_DB', $wpdb->prefix . constant('WPSS_'.ucfirst($m).'::DB') );
        if( !in_array( $m, array('result', 'route') ) ){ require_once( WPSS_PATH . "views/$m/view.$m.php" ); }
      }
      define('WPSS_UTIL','1');
      define('WPSS_ADMIN_SLUG','wpss-page');
      define('WPSS_SUBMIT_RESULTS', get_bloginfo('url')."/?wpss-routing=results");
      define('WPSS_CRUD_URL', get_site_url().'/?wpss-routing=crud');
      define('WPSS_NEW_QUIZ', WPSS_CRUD_URL.'&'.WPSS_ADMIN_SLUG.'=quiz&action=new');
      define('WPSS_DELETE_QUIZ', WPSS_CRUD_URL.'&'.WPSS_ADMIN_SLUG.'=quiz&action=delete&id=');
      define('WPSS_NEW_QUESTION', WPSS_CRUD_URL.'&'.WPSS_ADMIN_SLUG.'=question&action=new');
      define('WPSS_DELETE_QUESTION', WPSS_CRUD_URL.'&'.WPSS_ADMIN_SLUG.'=question&action=delete&id=');
      define('WPSS_NEW_ANSWER', WPSS_CRUD_URL.'&'.WPSS_ADMIN_SLUG.'=answer&action=new');
      define('WPSS_DELETE_ANSWER', WPSS_CRUD_URL.'&'.WPSS_ADMIN_SLUG.'=answer&action=delete&id=');
      define('WPSS_DELETE_RESULT', WPSS_CRUD_URL.'&'.WPSS_ADMIN_SLUG.'=result&action=delete&id=');
      define('WPSS_EXPORT_RESULTS', get_bloginfo('url')."/?wpss-routing=export&quiz_id=");
      define('WPSS_EXTENDED_DB_VERSION','1.0');
      require_once(ABSPATH.'wp-admin/includes/upgrade.php');
      require_once(WPSS_PATH."lib/db_setup.php");
      require_once(WPSS_PATH."admin/functions.php");
      require_once(WPSS_PATH."views/view.print.php");
      require_once(WPSS_PATH."mailers/view.admin_email_content.php");
      require_once(WPSS_PATH."mailers/view.quiz_taker_email_content.php");
      require_once(WPSS_PATH."views/results/view.user_quiz_results.full_results.php");
      require_once(WPSS_PATH."views/results/view.user_quiz_results.score.php");
      require_once(WPSS_PATH."views/progress_bar/view.progress_bar.php");
    }
  }





 /**
  *  Return admin urls for given object
  *
  *  @param string $obj singular name of object (quiz, question)
  *  @param string $action control name (edit, new)
  *  @param int $id database id of record for action
  */
  public static function admin_url($obj, $action, $id = ''){
    $req = WPSS_ADMIN_SLUG.'='.$obj.'&action='.$action.'&id='.$id;
    $url = admin_url('admin.php?page=wpss-quizzes&'.$req);
    return $url;
  }



 /**
  *  Return correct form url for CRUD
  *
  *  @param string $obj singular name of object (quiz, question)
  *  @param string $action control name (edit, new)
  *  @param int $id database id of record for action
  */
  public function admin_form_url($obj, $action, $id = ''){
    return WPSS_CRUD_URL.'&'.WPSS_ADMIN_SLUG.'='.$obj.'&action='.$action.'&id='.$id;
  }



 /**
  *  Dispatcher for loading admin pages.
  *  Calls CRUD actions and redirects:
  *    new -> edit on saves
  *    delete -> index on record removal
  */
  public static function load_admin_page(){
    $obj = !empty($_GET[WPSS_ADMIN_SLUG])? $_GET[WPSS_ADMIN_SLUG]: '';
    $action = !empty($_GET['action'])? $_GET['action'] : '';

    if($obj == '') require(WPSS_PATH.'admin/quizzes/index.php'); 
    elseif($obj == 'quiz'){
      if($action == 'edit'){ 
        $q = new WPSS_Quiz('update');
        require(WPSS_PATH.'admin/quizzes/edit.php'); 
      }
      elseif($action == 'questions_index'){
        require(WPSS_PATH.'admin/questions/index.php'); 
      }
      elseif($action == 'routes_index'){
        require(WPSS_PATH.'admin/routes/index.php'); 
      }
      elseif($action == 'fields_index'){
        require(WPSS_PATH.'admin/fields/index.php'); 
      }
      elseif($action == 'results_index'){
        require(WPSS_PATH.'admin/results/index.php'); 
      }
    }
    elseif($obj == "question"){
      if($action == 'new') require(WPSS_PATH.'admin/questions/new.php'); 
      if($action == 'edit') {
        $q = new WPSS_Question('update');
        require(WPSS_PATH.'admin/questions/edit.php'); 
      }
    }

    elseif($obj == "answer"){
      if($action == 'new') require(WPSS_PATH.'admin/answers/new.php'); 
      if($action == 'edit') {
        $q = new WPSS_Answer('update');
        require(WPSS_PATH.'admin/answers/edit.php'); 
      }
    }

    elseif($obj == "route"){
      if($action == 'new') require(WPSS_PATH.'admin/routes/new.php'); 
      if($action == 'edit') {
        $r = new WPSS_Route('update');
        require(WPSS_PATH.'admin/routes/edit.php'); 
      }
    }

    elseif($obj == "field"){
      if($action == 'edit') {
        $f = new WPSS_Field('update');
        require(WPSS_PATH.'admin/fields/edit.php'); 
      }
    }
    
    elseif($obj == 'result'){
      if($action == "show") require(WPSS_PATH.'admin/results/show.php'); 
    }
  }




 /**
  *  Execute Create and Deletes then redirect
  *  to proper admin URL. This function is call during
  *  WordPress parse_request when actions are posted to 
  *  WPSS /?wpss-routing=crud (WPSS_CRUD_URL)
  */
  public function crud_redirect(){
    $obj = !empty($_GET[WPSS_ADMIN_SLUG])? $_GET[WPSS_ADMIN_SLUG]: '';
    $action = !empty($_GET['action'])? $_GET['action'] : '';
    $util = new WPSS_Util();

    if($obj == 'quiz'){
      if( $action == 'delete'){
        $q = new WPSS_Quiz('delete');
        if($q->deleted) {wp_redirect($this->admin_url('', '','')); exit;}
        else echo "You cannot edit this record.";
      }
    }
    
    if($obj=='question'){
      if($action == 'new'){
        $q = new WPSS_Question('create');
        if($q->saved) {wp_redirect($this->admin_url('question', 'edit', $q->insert_id)); exit;}
        else die('Failed to create record. Make sure you Deactivate and then Activate the plugin to flush DB changes'); 
      }
      elseif($action=='delete'){
        $q = new WPSS_Question('delete');
        if($q->deleted) {wp_redirect($this->admin_url('quiz', 'questions_index', $q->quiz_id)); exit;}
        else echo "You cannot edit this record.";
      }
    }

    if($obj=='answer'){
      if($action == 'new'){
        $a = new WPSS_Answer('create');
        if($a->saved) {
          #wp_redirect($this->admin_url('answer', 'edit', $a->insert_id)); exit;
          wp_redirect($this->admin_url('question', 'edit', $a->question_id)); exit;
        }
        else die('Failed to create record. Make sure you Deactivate and then Activate the plugin to flush DB changes'); 
      }
      elseif($action=='delete'){
        $a = new WPSS_Answer('delete');
        if($a->deleted) {wp_redirect($this->admin_url('question', 'edit', $a->question_id)); exit;}
        else die('Failed to create record. Make sure you Deactivate and then Activate the plugin to flush DB changes'); 
      }
    }

    if($obj=='route'){
      if($action == 'new'){
        $r = new WPSS_Route('create');
        if($r->saved) {
          wp_redirect($this->admin_url('route', 'edit', $r->insert_id)); exit;
        }
        else die('Failed to create record. Make sure you Deactivate and then Activate the plugin to flush DB changes'); 
      }
      elseif($action=='delete'){
        $r = new WPSS_Route('delete');
        if($r->deleted) {wp_redirect($this->admin_url('quiz', 'routes_index', $r->quiz_id)); exit;}
        else die('Failed to create record. Make sure you Deactivate and then Activate the plugin to flush DB changes'); 
      }
    }

    if($obj=='field'){
      if($action=='delete'){
        $f = new WPSS_Field('delete');
        if($f->deleted) {wp_redirect($this->admin_url('quiz', 'fields_index', $f->quiz_id)); exit;}
        else die('Failed to create record. Make sure you Deactivate and then Activate the plugin to flush DB changes'); 
      }
    }

    if($obj=='result'){
      if($action=='delete'){

        if( empty($_POST) || empty($_POST['wpss']) ) {
          return ''; 
        } elseif( wp_verify_nonce( $_POST['wpss_crud'], 'wpss_crud' ) ) {
          $result = WPSS_Result::find( (int) $_GET['id'] );
          $result->destroy();
          wp_redirect( $util->admin_url('quiz', 'results_index', $result->quiz->id) );
          exit;
        } else {
          die('Failed to create record. Make sure you Deactivate and then Activate the plugin to flush DB changes'); 
        }
      }
    }
  }




 /**
  *  Return URL to given JS file
  */
  public function get_js($f = ''){
    return $this->assets . 'build/js/' . $f;
  }



 /**
  *  Return URL to given CSS file
  */
  public function get_css($f = ''){
    return $this->assets . 'build/css/' . $f;
  }

}
?>

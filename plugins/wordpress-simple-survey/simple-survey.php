<?php
/*
Plugin Name: WP Simple Survey
Plugin URI: http://www.sailabs.co/products/wordpress-simple-survey/
Description: Use this plugin to easily create surveys and graded quizzes. You can track the results and guide users to different locations based on their scores.
Version: 3.3.0
Author: Richard Royal
Author URI: http://www.sailabs.co/
*/

define('WPSS_PATH',  plugin_dir_path( __FILE__ ) );
define('WPSS_URL', WP_PLUGIN_URL."/wordpress-simple-survey/" );
require_once(WPSS_PATH."lib/class.util.php");
$util = new WPSS_Util();

register_activation_hook(__FILE__,'wpss_plugin_install');



/*------------------------------------------------*/
/* Admin Pages                                    */
/*------------------------------------------------*/

/**
 * Authorize access to edit quizzes
 */
function wpss_authorize_admin(){
  if(!defined('WPSS_URL')){
    die('Restricted access');
  } elseif(!is_user_logged_in()){
    wp_die('Restricted access');
  } else {
    $auth = false;
    $allowed_capabilities = wpss_allowed_capabilities();

    foreach($allowed_capabilities as $cap){
      if(current_user_can($cap)){
        $auth = true;
        break;
      }
    }
    return $auth;
  }
}


/**
 *  WP Capabilities that are allowed to edit quizzes.
 *  To edit quizzes, a user must have at least one of these
 *  capabilities and to see the admin menu, they must have
 *  the last capability on the list (they are ordered from
 *  most admin-like to least admin-like).
 */
function wpss_allowed_capabilities(){
    $allowed_capabilities = array();
    $allowed_capabilities[] = 'manage_options';
    $allowed_capabilities[] = 'edit_plugins';
    $allowed_capabilities[] = 'publish_posts';
    $allowed_capabilities[] = 'edit_posts';

    return $allowed_capabilities;
}


function wpss_admin_help_page() {     require_once("admin/help/help.php"); }
function wpss_admin_options_page() {  require_once("admin/options/options.php"); }
function wpss_admin_quizzes() {       require_once(WPSS_PATH."admin/dispatcher.php"); }
function wpss_admin_pages() {
  $min_capability = wpss_allowed_capabilities();
  $min_capability = end($min_capability);

  if (current_user_can($min_capability)) {
    add_menu_page("Setup Quizzes and Surveys", "Surveys/Quizzes", "publish_posts", "wpss-quizzes","wpss_admin_quizzes", 'dashicons-welcome-learn-more' );
    add_submenu_page( "wpss-quizzes", "WP Simple Survey - Options", "WPSS Options", "publish_posts", "wpss-options", "wpss_admin_options_page");
    add_submenu_page( "wpss-quizzes", "WP Simple Survey - Help", "WPSS Help", "publish_posts", "wpss-help", "wpss_admin_help_page");
  }
}add_action('admin_menu', 'wpss_admin_pages');




/*------------------------------------------------*/
/* WP Shortcode Handlers                          */
/*------------------------------------------------*/
function wpss_quiz_shortcode_handler($atts, $content=null, $code=""){
   return wpss_get_quiz($atts);
}add_shortcode('wp_simple_survey', 'wpss_quiz_shortcode_handler');



/*------------------------------------------------*/
/* Register JS and CSS                            */
/*------------------------------------------------*/
function wpss_register_javascripts(){
  if(!is_admin()){ 
    $util = new WPSS_Util();
  
    wp_enqueue_script('wpss-pkg', $util->get_js('wpss-pkg.min.js'), array('jquery'), '3.0.0');
  }
}add_action('wp_print_scripts', 'wpss_register_javascripts');


function wpss_register_stylesheets() {
  if(!is_admin()){
    $util = new WPSS_Util();
    wp_enqueue_style('wpss-style', $util->get_css('wpss-pkg.min.css'));
    wp_enqueue_style('wpss-custom-db-style', get_bloginfo('url').'/?wpss-routing=custom-css');
  } 
}add_action('wp_print_styles', 'wpss_register_stylesheets');


function wpss_register_admin_stylesheets(){
  wp_enqueue_style('wpss-admin-style', WPSS_URL.'assets/build/css/wpss-pkg.min.css');
}add_action('admin_init', 'wpss_register_admin_stylesheets');







/*-------------------------------------------------------------*/
/**
 *  Setup custom URL for plugin to POST quiz results to,
 *  CRUD actions, and data export.
 *  Allows for proper access to 'global worpress' scope
 *  including database settings needed for tracking, without
 *  headers being outputted first.
 *
 *  /?wpss-routing=results
 *  /?wpss-routing=crud
 *  /?wpss-routing=export
 *  /?wpss-routing=print
 *  /?wpss-routing=css
 */
function wpss_parse_request($wp) {
    if (array_key_exists('wpss-routing', $wp->query_vars) && $wp->query_vars['wpss-routing'] == 'results') {
      include(WPSS_PATH.'submit/submit.php');  
      die();exit();
    }
    if (array_key_exists('wpss-routing', $wp->query_vars) && $wp->query_vars['wpss-routing'] == 'crud') {
      $util = new WPSS_Util();
      $util->crud_redirect();
      die();
    }
    if (array_key_exists('wpss-routing', $wp->query_vars) && $wp->query_vars['wpss-routing'] == 'print') {
      echo wpss_get_printer_friendly_quiz((int) $_GET['quiz_id']);
      die();exit();
    }
    if (array_key_exists('wpss-routing', $wp->query_vars) && $wp->query_vars['wpss-routing'] == 'custom-css') {
      $custom_css = get_option('wpss_custom_css');
      header( 'Content-Type: text/css' );
      echo $custom_css;
      die();exit();
    }
}add_action('parse_request', 'wpss_parse_request');


function wpss_parse_query_vars($vars) {
    $vars[] = 'wpss-routing';
    return $vars;
}add_filter('query_vars', 'wpss_parse_query_vars');

/*-------------------------------------------------------------*/

?>

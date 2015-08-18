<?php
defined('WPSS_URL') or die('Restricted access');


/**
 * Preview for TinyMCE inputted fields.
 */
function wpss_text_preview( $full, $l=85 ){

  $txt = strip_tags( $full );
  $m = '';

  if( strlen($txt) > $l ){
    $m = substr( $txt, 0, $l ) . "...";
  } else {
    $m = $txt;
  }

  return $m;
}



/**
 *  Creates and saves new quiz with default settings.
 */
function wpss_create_new_quiz(){
  global $wpdb;
  global $current_user; get_currentuserinfo();
  
  $q = array();
  $q['title'] = 'New Quiz';
  $q['submit_txt'] = 'You have finished the quiz.';
  $q['submit_button_txt'] = 'Click to submit';
  $q['store_results'] = '1';
  $q['send_admin_email'] = '1';
  $q['admin_email_addr'] = $current_user->user_email;
  $q['user_email_from_name'] = 'WP-Simple-Survey';
  $q['send_user_email'] = '1';
  $q['show_title'] = '1';
  $q['user_email_from_address'] = $current_user->user_email;
  $q['user_email_content'] = '<p>Thank you for taking our [quiztitle]</p><p>You scored [score] and were routed to:<br />[routed]</p><p>Summary:</p>[answers]';
  $q['user_email_subject'] = '[' . get_bloginfo('name') . '] ' . 'Thank you for taking our quiz!';
  $wpdb->insert( WPSS_QUIZ_DB, $q);
  $quiz_id = $wpdb->insert_id;
  

  /**********************************************/ 
  /* Create 3 default questions, 2 answers each */
  /**********************************************/ 
  for( $i=0; $i<3; $i++) {
    $wpdb->insert(WPSS_QUESTION_DB, array('question'=>'Insert New Question', 'quiz_id' => $quiz_id, 'type'=>'0', 'display_order' => ($i+1) ));
    $new_question_id = $wpdb->insert_id;
    $wpdb->insert(WPSS_ANSWER_DB, array('answer'=>'Insert New Answer','quiz_id'=>$quiz_id ,'question_id'=>$new_question_id,'weight'=>1 ) );
    $wpdb->insert(WPSS_ANSWER_DB, array('answer'=>'Insert New Answer','quiz_id'=>$quiz_id ,'question_id'=>$new_question_id,'weight'=>1 ) );
  }
  
  /**********************************************/ 
  /* Create default routes                      */
  /**********************************************/ 
  $wpdb->insert(WPSS_ROUTE_DB, array( 'name' => 'Example', 'from_score'=>0,'to_score'=>69,'url'=>'Insert_a_URL_to_a_page_for_this_scoring_range','quiz_id'=>$quiz_id ) );
  $wpdb->insert(WPSS_ROUTE_DB, array( 'name' => 'Passing', 'from_score'=>70,'to_score'=>95,'url'=>'Ex: '.get_bloginfo('url').'/passing','quiz_id'=>$quiz_id ) );
  $wpdb->insert(WPSS_ROUTE_DB, array( 'name' => 'Excellant' , 'from_score'=>96,'to_score'=>100,'url'=>'Ex: '.get_bloginfo('url').'/excellent', 'quiz_id'=>$quiz_id) ); 
 
  /**********************************************/ 
  /* Create default fields                      */
  /**********************************************/ 
  $wpdb->insert(WPSS_FIELD_DB, array( 'name'=>'Name:','required'=>1,'quiz_id'=>$quiz_id, 'meta_type' => 'text' ));
  $wpdb->insert(WPSS_FIELD_DB, array( 'name'=>'Email:','required'=>1,'quiz_id'=>$quiz_id, 'meta_type' => 'email_quiz_taker' ));
 
  $wpdb->flush();
}



/**
 *  Save options from admin options page
 */
function wpss_save_options(){
  if( !empty($_POST)  && $_POST['save_options'] == 'Save Options'){
    $options = $_POST['wpss'];
  
    $css = $options['custom_css'];
    update_option('wpss_custom_css', $css);

    $email_header_compatibility = $options['email_header_compatibility'];
    update_option('wpss_email_header_compatibility', $email_header_compatibility);
  }
}




/**
 * Set email header callbacks
 */
function wpss_set_content_type_html($content_type){
  return 'text/html';
}

function wpss_set_content_type_text($content_type){
  return 'text/plain';
}

?>

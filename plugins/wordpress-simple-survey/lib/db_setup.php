<?php
/**
 *  Setup database tables on plugin activation.
 *  Relies on WP::dbDelta() for handling migrations.
 */
function wpss_plugin_install() {
  global $wpdb;
  $util = new WPSS_Util();
  
  /***************************************************************/
  /* Quiz Table                                                  */
  /***************************************************************/
  $sql = "CREATE TABLE " . constant( 'WPSS_QUIZ_DB' ) . " ( 
          id int NOT NULL AUTO_INCREMENT,
          title text NOT NULL,
          submit_txt text NOT NULL,
          submit_button_txt text NOT NULL,
          store_results tinyint NOT NULL,
          send_admin_email tinyint NOT NULL,
          admin_email_addr text NOT NULL,
          send_user_email tinyint NOT NULL,
          user_email_content text NOT NULL,
          user_email_subject text NOT NULL,
          user_email_from_name text NOT NULL,
          user_email_from_address text NOT NULL,
          question_order text NOT NULL,
          show_title tinyint NOT NULL,
          UNIQUE KEY id (id)
        )DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
  dbDelta($sql);


  /***************************************************************/
  /* User Results Table                                          */
  /***************************************************************/
  $sql = "CREATE TABLE " . constant( 'WPSS_RESULT_DB' ) . " (
          id int NOT NULL AUTO_INCREMENT,
          quiz_id int NOT NULL,
          data text NOT NULL,
          score float NOT NULL,
          submitter_id text NOT NULL,
          wp_user_id int NOT NULL,
          ip_address text NOT NULL,
          started_at TIMESTAMP NOT NULL,
          submitted_at TIMESTAMP NOT NULL,
          UNIQUE KEY id (id)
        )DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
  dbDelta($sql);


  /***************************************************************/
  /* Questions Table                                             */
  /***************************************************************/
  $sql = "CREATE TABLE " . constant( 'WPSS_QUESTION_DB' ) . " (
          id int NOT NULL AUTO_INCREMENT,
          question text,
          type text,
          display_order int(5),
          quiz_id int,
          UNIQUE KEY id (id)
        )DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
  dbDelta($sql);
  

  /***************************************************************/
  /* Answers Table                                               */
  /***************************************************************/
  $sql = "CREATE TABLE " . constant( 'WPSS_ANSWER_DB' ) . " (
          id int NOT NULL AUTO_INCREMENT,
          answer text,
          weight float,
          quiz_id int,
          question_id int,
          display_order int(5),
          UNIQUE KEY id (id)
        )DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
  dbDelta($sql);
  
 
  /***************************************************************/
  /* Routes Table                                                */
  /***************************************************************/
  $sql = "CREATE TABLE " . constant( 'WPSS_ROUTE_DB' ) . " (
          id int NOT NULL AUTO_INCREMENT,
          name text,
          from_score float,
          to_score float,
          url text,
          quiz_id int,
          UNIQUE KEY id (id)
        )DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
  dbDelta($sql);


  /***************************************************************/
  /* Custom User Fields Table                                    */
  /***************************************************************/
  $sql = "CREATE TABLE " . constant( 'WPSS_FIELD_DB' ) . " (
          id int NOT NULL AUTO_INCREMENT,
          name text,
          meta_type text,
          meta text,
          required tinyint,
          quiz_id int,
          display_order int(5),
          UNIQUE KEY id (id) 
        )DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
  dbDelta($sql);







  /***************************************************************/
  /* Create first quiz if one does not exist                     */
  /***************************************************************/
  $quizzes = $wpdb->get_results( "SELECT * FROM " . constant( 'WPSS_QUIZ_DB' ), ARRAY_A);
  if( !count($quizzes) ) wpss_create_new_quiz();


  add_option("wpss_extended_db_version", WPSS_EXTENDED_DB_VERSION);
}

?>

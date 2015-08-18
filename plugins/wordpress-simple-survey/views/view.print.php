<?php
/**
 *  Outputs full HTML printer friendly view of Quiz.
 */

function wpss_get_printer_friendly_quiz($id){

  global $wpdb;
  if(empty($id) || !is_numeric($id) ) return '';

  /* Get Quiz, Questions, Answers and Fields */
  $quiz = new WPSS_Quiz($id);
  if(empty($quiz)) return "Quiz not found.";
 
  $s = '<html>
          <head>
            <meta charset="UTF-8" />
            <title>'.$quiz->title.'</title>
            <link rel="stylesheet" href="'.WPSS_URL.'css/style.css" type="text/css" media="all" />
          </head>
          <body>QUIZ'.
          '</body>
        </html>';


  return $s;


}

?>

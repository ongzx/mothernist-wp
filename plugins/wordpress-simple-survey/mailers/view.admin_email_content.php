<?php

/**
 * Email message sent to admin or site administrator as set in quiz settings.
 */
function wpss_admin_email_content( $result ){
  $msg  = '';

  $msg .= '<p>Quiz Title: '.$result->quiz->title.'</p>';
  $msg .= '<p>Quiz ID: '.$result->quiz->id.'</p>';
  $msg .= '<p>User Score: '.$result->score.'</p>';
  $msg .= '<p>Route: '.$result->redirect_to['name'].'</p>';
  $msg .= '<p>Routed To: '.$result->redirect_to['url'].'</p>';
  $msg .= '<p>Started: '.$result->started_at.'</p>';
  $msg .= '<p>Submitted At: '.$result->submitted_at.'</p>';
  $msg .= '<p>IP Address: '.$result->submitter_ip_address.'</p>';

  $msg .= '<hr />';

  foreach( $result->field_results as $field ){
    $msg .= '<p>'.$field['field_text'].'</p>';
    $msg .= '<p>'.$field['answer'].'</p>';
  }

  $msg .= '<hr />';

  foreach( $result->full_results as $qa ){
    $msg .= '<p>'.$qa['question_text'].'</p>';
    $msg .= '<p>'.$qa['answer']['answer_text'].'</p>';
    $msg .= '<p>Weight: '.$qa['answer']['score'].'</p>';
  }
  
  return $msg;
}

?>

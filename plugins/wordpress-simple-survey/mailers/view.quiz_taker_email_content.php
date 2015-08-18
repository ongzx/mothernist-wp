<?php
/**
 * Email message sent to quiz taker as configured on quiz admin with shortcodes are replaced.
 */
function wpss_quiz_taker_email_content( $result ){
  $msg  = '';

  $msg = wpss_wysiwyg_output( $result->quiz->user_email_content );

  $msg = str_replace( '[routed]',  $result->redirect_to['url'], $msg );
  $msg = str_replace( '[score]',  $result->score, $msg );
  $msg = str_replace( '[quiztitle]',  $result->quiz->title, $msg );

  foreach($result->field_results as $field){
    $msg = str_replace('[wp_ss_field_'.$field['field_id'].']', $field['answer'], $msg);
  }

  $ans = '';
  foreach( $result->full_results as $qa ){
    $ans .= '<p>'.$qa['question_text'].'</p>';
    $ans .= '<p>'.$qa['answer']['answer_text'].'</p>';
    $ans .= '<p>Weight: '.$qa['answer']['score'].'</p>';
  }
  $msg = str_replace( '[answers]',  $ans, $msg );

  return $msg;
}

?>

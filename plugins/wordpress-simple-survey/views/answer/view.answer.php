<?php 
/**
 *  Display given question's answers
 */
function wpss_get_answers( $answers, $type_id, $question_id ){

  $question_util = new WPSS_Question();
  $type = $question_util->get_safe_type($type_id);

  $layout = 'wpss_get_answers_' . $type;

  $o = '';

  if( function_exists($layout) ) {
    $o .= call_user_func( $layout, $answers, $question_id );
  } else {
    wpss_error_log("Could not find layout function: $layout.");
    $o .= 'Question Type Layout not found.';
  }
    
  return $o;
}




/**
 *  View for Radio button list of answers
 */
function wpss_get_answers_radio( $answers, $question_id ){
  $o = '';
  foreach( $answers as $i => $a ){
    $o .= '<div class="answer_text">'."\n";
    $o .=   '<input type="radio" class="wpss-radio" name="wpss[questions]['.$question_id.'][]" id="answer_'.$a->id.'" value="'.$a->id.'" />'."\n";
    $o .=   '<label for="answer_'.$a->id.'">'. $a->answer .'</label>'."\n";
    $o .=   '<div class="wpss-clear"></div>';
    $o .= '</div>'."\n";
  }
  return $o;  
}



?>

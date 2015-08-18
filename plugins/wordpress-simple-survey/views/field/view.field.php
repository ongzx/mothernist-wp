<?php
/**
 *  Display the quiz slide containing the fields
 *  and submit button.
 */
function wpss_get_fields($quiz){

  global $wpdb;
  global $current_user; get_currentuserinfo();

  $o  = '<div class="wpss_panel_'.($quiz->questions_count + 1 ).'  wpss-form-panel wpss-hidden wpss-fields-panel">'."\n";
  $o .=   '<fieldset>'."\n";
  $o .=     '<div class="wpss-submit-message">' . wpss_wysiwyg_output( $quiz->submit_txt ) . '</div>'."\n";


  $o .=     '<div class="wpss-fields">';
  foreach( $quiz->fields->fields as $field ) { 
    $o .=     wpss_get_field($field); 
  }
  $o .=     '</div>';

  $o .=     '<input type="hidden" name="wpss[quiz][id]" value="'.$quiz->id.'" />';
  $o .=     '<input type="hidden" name="wpss[quiz][submitter_id]" value="'.$quiz->submitter_id.'" />';
  $o .=     '<div class="clear"></div>';
  $o .=     '<input id="submitButton" type="submit" name="wpss[quiz][submit]" value="'.$quiz->submit_button_txt.'" />';
  $o .=   '</fieldset>';
  $o .= '</div>';

  return $o; 
}




/** --------------------------------------------------------------------*/

/**
 * Individual custom fields
 *
 * @return string HTML block for custom field
 */
function wpss_get_field($f){
  $o = '';

  $class = empty($f->required) ? '' : 'wpss_required';
  $field_func = 'wpss_get_field_' . $f->meta_type;

  $o .= '<div class="wpss-field">';
  $o .=   '<label>'.$f->name.'</label>';
  if( function_exists( $field_func ) ){
    $o .= call_user_func( $field_func, $f, $class );
  } else {
    $o .= '<br />No layout found for field type: ' . $f->meta_type;
  }
  $o .=   '<div class="wpss-clear"></div>';
  $o .= '</div>';
    
  $o .= '<div class="wpss-clear"></div>';
  
  return $o;
}



/**
 *  Output html field: text
 */
function wpss_get_field_text($f, $class){
  $required = ($f->required == 1) ? 'required="required"' : '';
  return '<input type="text" name="wpss[fields]['.$f->id.']" class="'.$class.'" value="" '.$required.' />';
}




/**
 *  Output html field: email
 */
function wpss_get_field_email($f, $class){
  $required = ($f->required == 1) ? 'required="required"' : '';
  return '<input type="email" name="wpss[fields]['.$f->id.']" class="'.$class.'" value="" '.$required.' />';
}


/**
 *  Output html field: email_quiz_taker
 *  Used to send results to end user.
 */
function wpss_get_field_email_quiz_taker($f, $class){
  $required = ($f->required == 1) ? 'required="required"' : '';
  return '<input type="email" name="wpss[fields]['.$f->id.']" class="'.$class.'" value="" '.$required.' />';
}


?>

<?php 
/**
 *  Display given quiz questions
 */
function wpss_get_questions($questions){

  $o = '';

  foreach($questions->questions as $i => $q){
    
    $o .= '<div id="wpss_question_panel_'.$q['question']->id.'" class="wpss_panel_'.($i+1).' wpss-form-panel wpss-hidden">' . "\n"; 
    $o .=   '<fieldset>'."\n";

    $o .=     '<div id="wpss_question_'.$q['question']->id.'" class="wpss-question">' . "\n";
    $o .=       wpss_wysiwyg_output( $q['question']->question );
    $o .=      '<div class="wpss-clear"></div>';
    $o .=     '</div>'."\n";

    $o .=     '<div class="answers">'."\n";
    $o .=        wpss_get_answers( $q['answers'], $q['question']->type, $q['question']->id );
    $o .=     '</div>'."\n";

    $o .= '<span class="poweredby_questionaire">Powered by <a href="http://www.evoke-coaching.net" target="_blank"><img class="evoke_logo" src="http://mothernistzone.mediaparticlepte1.netdna-cdn.com/wp-content/uploads/2014/08/evoke_logo.png"></a></span>'."\n";

    $o .=   '</fieldset>'."\n";
    $o .= '</div>'."\n";

  }

  return $o;
}
?>

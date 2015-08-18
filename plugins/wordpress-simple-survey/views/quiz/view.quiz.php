<?php
/**
 *  Displays quiz by id on frontend through shortcode
 */
function wpss_get_quiz($atts){
  
  if(empty($atts['id']) || !is_numeric($atts['id']) ) return '';
  $quiz_id = $atts['id'];
  $util = new WPSS_Util(); 
  $quiz = new WPSS_Quiz($quiz_id);
  $quiz->create_submitter_id();

  $o =  "<!-- WordPress Simple Survey | Copyright SAI Digital (http://www.sailabs.co) -->\n";

  if( !empty( $quiz->id ) ) {

    $o .= '<div id="wpss_quiz_'.$quiz->id.'" class="wpss" data-quiz-id="'.$quiz->id.'" data-question-count="'.$quiz->questions->question_count.'">'."\n";
    $o .=   '<div class="form-container">';
    $o .=     '<div class="questionaire_header"></div>';

    if( $quiz->show_title ){
      $o .=   '<h2 class="wpss_title">' . $quiz->title . '</h2>';
    }

    $o .=      wpss_get_progress_bar();
    $o .=     '<form id="wpss_form_'.$quiz->id.'" class="wpss-form" action="'.WPSS_SUBMIT_RESULTS.'" method="post" >';
    $o .=        wpss_get_questions($quiz->questions);
    $o .=        wpss_get_fields($quiz);
    $o .=       '<p class="wpss_prev_next">';
    $o .=         '<a href="javascript:void(0)" class="wpss_back wpss_disabled">&laquo; Back</a>&nbsp;';
    $o .=         '<a href="javascript:void(0)" class="wpss_next wpss_disabled">Next &raquo;</a>';
    $o .=       '</p>';
    $o .=     '</form>';
  
    $o .=   '</div>'."\n";
    $o .= '</div>'."\n";

  } else {

    $o .= '<p>Could not find quiz with that ID.</p>';

  }

  return $o;
}



?>

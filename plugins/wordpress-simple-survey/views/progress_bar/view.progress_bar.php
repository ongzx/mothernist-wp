<?php

function wpss_get_progress_bar(){
  $o  = '';

  $o .= '<div class="wpss-progress-bar">';
  $o .=   '<span style="width: 0%;"></span>';
  $o .= '</div>';
  
  return $o;
}

?>

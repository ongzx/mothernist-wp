<?php


function wpss_collect( $attribute, $objects ){
  $v = array();
  foreach( $objects as $object ){
    if( is_array($object) ){
      $v[] =  $object[$attribute];
    } elseif( is_object($object) ){
      $v[] =  $object->$attribute;
    }
  }
  return $v;
}


function wpss_error_log( $o ){
  error_log("-----------------------------------------");
  error_log( var_export($o, true) );
  error_log("-----------------------------------------");
}



/**
 *  Gets array row by key=>value
 *  @return array
 */
function wpss_array_trim($key,$value,&$array){
  foreach($array as $n => $row){
    if($row[$key] == $value) return $array[$n];
  }
}



/**
 * Convert TinyMCE field to full HTML on output. 
 * 
 * https://core.trac.wordpress.org/browser/tags/3.8.1/src/wp-includes/post-template.php
 */
function wpss_wysiwyg_output( $content ){
  $content = apply_filters( 'the_content', $content ); 
  $content = str_replace( ']]>', ']]&gt;', $content );
  return $content;
}


/**
 *  Filter TinyMCE inputted field to remove HTML. 
 */
function wpss_safe_string( $s ){
  $s = strip_tags($s);
  $s = trim( str_replace( array( '"', "'" ), '', $s) );
  return htmlspecialchars( $s );
} 

?>

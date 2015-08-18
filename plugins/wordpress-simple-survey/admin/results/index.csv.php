<?php
if( !defined('WPSS_URL') || !current_user_can('manage_options')) { wp_die('Restricted access'); exit; }

$quiz = new WPSS_Quiz( (int) $_GET['quiz_id'] );
$util = new WPSS_Util(); 
$results = WPSS_Result::where( array( 'quiz_id' => $quiz->id ) );

$static_headers = WPSS_Result::static_csv_headers();
$current_field_headers = wpss_collect( 'name', $quiz->fields->fields );
$current_field_ids = wpss_collect( 'id', $quiz->fields->fields );
$headers = array_merge( $static_headers, $current_field_headers, array('Other Field Values') );
$csv = array();
$csv[] = $headers;


foreach( $results as $result ){
  $row = array();

  $row[] = $result->id;
  $row[] = $result->data['meta']['title'];
  $row[] = $result->data['meta']['quiz_id'];
  $row[] = date( $result->data['meta']['started_at'] );
  $row[] = $result->submitted_at;
  $row[] = $result->data['route_results']['name'];
  $row[] = $result->data['route_results']['id'];
  $row[] = $result->data['route_results']['from_score'];
  $row[] = $result->data['route_results']['to_score'];
  $row[] = $result->data['route_results']['url'];
  $row[] = $result->score;
  $row[] = $result->data['quiz']['submitter_id'];
  $row[] = $result->data['quiz']['submit'];
  $row[] = $result->ip_address;
  $row[] = $result->data['meta']['wp_user_login'];
  $row[] = $result->data['meta']['wp_first_name'];
  $row[] = $result->data['meta']['wp_last_name'];
  $row[] = $result->data['meta']['wp_user_email'];
  $row[] = $result->data['meta']['wp_roles'];
  $row[] = (string) $result->data['meta']['wp_user_id'];

  $submitted_fields = $result->data['field_results'];
  foreach( $current_field_ids as $field_id ){
    foreach( $submitted_fields as $i => $field ){
      if( $field['field_id'] == $field_id ){
        $row[] = $field["answer"];
        unset( $submitted_fields[$i] );
      }
    }
  }
  $row[] = implode( ', ', $submitted_fields );
  
  $csv[] = $row;
}


$debug = false;

if( $debug == false ){

  $filename = "WPSS-Results-Quiz-".$quiz->id."-(".date('Y-m-d_H:i:s_e').").csv";
  header("Content-type: application/csv");
  header("Content-Disposition: attachment; filename=$filename");
  header("Pragma: no-cache");
  header("Expires: 0");
  $fp = fopen("php://output", 'w');
  foreach( $csv as $line ){
    fputcsv($fp, $line, ';', '"');
  }
  fclose($fp);
  
} else {
  
  echo "<pre>";
  var_dump( $csv );
  echo "</pre>";
 
}
?>


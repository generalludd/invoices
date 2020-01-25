<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

$fields = array (
		"day" => "Day",
		"start_time" => "Start Time",
		"end_time" => "End Time",
		"total" => "Total",
		"var_value" => "Category",
		"details" => "Details" 
);
$filename || $filename = "timesheet.csv";
foreach ( array_values ( $fields ) as $value ) {
	$header_values [] = $value;
}

$output = array (
		implode ( ",", $header_values ) 
);
foreach ( $entries as $entry ) {
	foreach ( array_keys ( $fields ) as $key ) {
		if ($key == "total") {
			$line [] = (strtotime ( $entry->day . $entry->end_time ) - strtotime ( $entry->day . $entry->start_time )) / 3600;
		} else {
			$line [] = $entry->$key;
		}
	}
	$output [] = "\"" . implode ( "\",\"", $line ) . "\"";
	$line = NULL;
}

$data = implode ( "\n", $output );
force_download ( $filename, $data );


<?php

function mysql_timestamp()
{
	return date ( 'Y-m-d H:i:s' );
}

/*
 * @function format_date
 * @params $date date string
 * @params $format string
 * description: this shouldn't be in this file, but I didn't want to create a new file with general formatting tools yet.
 */
function format_date($date, $format = "standard")
{
	// $format=mysql//yyyy-mm-dd
	// $format=standard//mm-dd-yyyy
	$clean_date = str_replace ( "-", "/", $date );
	switch ($format) {
		case "mysql" :
			$parts = explode ( "/", $clean_date );
			$month = $parts [0];
			$day = $parts [1];
			$year = $parts [2];
			$output = "$year-$month-$day";
			break;
		case "standard" :
			$parts = explode ( "/", $clean_date );
			$year = $parts [0];
			$month = $parts [1];
			$day = $parts [2];
			$output = "$month/$day/$year";
			break;
		default :
			$output = $clean_date;
	}
	return $output;
}

function bake_cookie($name, $value)
{
	if (is_array ( $value )) {
		$value = implode ( ",", $value );
	}
	set_cookie ( array (
			"name" => $name,
			"value" => $value,
			"expire" => 0 
	) );
}

function burn_cookie($name)
{
	set_cookie ( array (
			"name" => $name,
			"value" => "",
			"expire" => NULL 
	) );
}

function get_current_year()
{
	if (date ( "m" ) > 6) { // after August
		$year = date ( "Y" ) + 1;
	} else {
		$year = date ( "Y" );
	}
	return $year;
}

/*
 * @params $table varchar table name @params $data array consisting of "where"
 * string or array, and "select" comma-delimited string @returns an array of
 * key-value pairs reflecting a Database primary key and human-meaningful string
 */
function get_keyed_pairs($list, $pairs, $initialBlank = NULL, $other = NULL, $alternate = array())
{
	$output = false;
	if ($initialBlank) {
		$output [""] = "";
	}
	if (! empty ( $alternate )) {
		$output [$alternate ['name']] = $alternate ['value'];
	}
	
	foreach ( $list as $item ) {
		$key_name = $pairs [0];
		$key_value = $pairs [1];
		$output [urlencode ( $item->$key_name )] = $item->$key_value;
	}
	if ($other) {
		$output ["other"] = "Other...";
	}
	return $output;
}

function get_value($object, $item, $default = null)
{
	$output = $default;
	
	if ($default) {
		$output = $default;
	}
	if ($object) {
		
		$var_list = get_object_vars ( $object );
		$var_keys = array_keys ( $var_list );
		if (in_array ( $item, $var_keys )) {
			$output = ($object->$item);
		}
	}
	return $output;
}

function get_as_price($int)
{
	$output = sprintf ( "$%s", number_format ( $int, 2 ) );
	return $output;
}

function get_as_time($time)
{
	$output = "";
	if ($time != "0") {
		$output = $time;
		// $output= date("g:i A",strtotime($time));
	}
	return $output;
}

function get_user_name($user)
{
	return sprintf ( "%s %s", $user->first_name, $user->last_name );
}

function clean_string($string)
{
	return preg_replace ( "/[^a-zA-Z0-9\"\.\<\>\=]+/", " ", $string );
}

/**
 * Create a custom sql sorting string.
 *
 * @param array $values        	
 * @param string $field        	
 * @return string
 */
function get_custom_order($values = array(NULL), $field = "name")
{
	// @TODO there should be a UI-available tool for global sorting.
	$order [] = "CASE";
	for($i = 0; $i < count ( $values ); $i ++) {
		$my_value = $values [$i];
		$x = $i + 1;
		if ($my_value == "NULL" || $my_value == NULL) {
			$order [] = "WHEN `$field` IS NULL THEN $x";
		} else {
			$order [] = "WHEN `$field`='$my_value' THEN $x";
		}
	}
	$order [] = "END";
	return implode ( " ", $order );
}

function ucfirst_array($array)
{
	if (! is_array ( $array )) {
		$array = explode ( ",", $array );
	}
	
	foreach ( $array as $item ) {
		$output [] = ucfirst ( $item );
	}
	return $output;
}

function humanize($str, $separator = '_')
{
	return ucwords ( preg_replace ( '/[' . $separator . ']+/', ' ', trim ( MB_ENABLED ? mb_strtolower ( $str ) : strtolower ( $str ) ) ) );
}

function format_name($contact){
	return $contact->first_name . ' ' . $contact->last_name;
}


function get_lapsed_time($entry){
	$start = date('U', strtotime($entry->start_time));
	$end = date('U', strtotime($entry->end_time));
	return (object)['time'=>gmdate('j\h i\m', $end - $start),'seconds'=>$end-$start];
}

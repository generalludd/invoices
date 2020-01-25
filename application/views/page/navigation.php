<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// navigation.php Chris Dart Mar 6, 2015 12:45:16 PM chrisdart@cerebratorium.com

$buttons [] = array (
		"text" => "Home",
		"href" => site_url ( "" ),
		"style" => "default" 
);

$buttons [] = array (
		"text" => "Timesheet <i class='fa fa-clock-o'></i>",
		"href" => site_url ( "timesheet" ),
		"style" => "default" 
);


$buttons [] = array (
		"text" => "Invoices",
		"href" => site_url ( "invoice" ),
		"style" => "default" 
);
$buttons [] = array (
		"text" => "Clients",
		"href" => site_url ( "client" ),
		"style" => "default" 
);

$buttons [] = array (
		"text" => "New Client",
		"href" => site_url ( "client/create" ),
		"style" => "new",
		"class" => "create-vendor create dialog" 
);

$buttons [] = array (
		"text" => "New Invoice",
		"href" => site_url ( "invoice/create" ),
		"style" => "new",
		"class" => "create-po create dialog" 
);

print create_toolbar ( $buttons );

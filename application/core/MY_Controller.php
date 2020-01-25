<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class MY_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct ();
		date_default_timezone_set ( 'America/Chicago' );
		if (! $this->ion_auth->logged_in ()) {
			
			$uri = $_SERVER ["REQUEST_URI"];
			if (! $this->input->get ( "ajax" )) {
				
				if ($uri != "/auth") {
					bake_cookie ( "uri", $uri );
				}
			} else {
				burn_cookie ( "uri" );
			}
			redirect ( "auth/login" );
		} else {
			$this->load->model ( "ion_auth_model" );
			$this->load->library('globals');
			define ( 'IS_ADMIN', $this->ion_auth->in_group ( 1 ) );
		}
	}

	function set_option(&$options, $key)
	{
		if ($value = urldecode ( $this->input->get ( $key ) )) {
			bake_cookie ( $key, $value );
			$options [$key] = $value;
		} else {
			burn_cookie ( $key );
		}
	}

	function set_options(&$options, $keys = array())
	{
		foreach ( $keys as $key ) {
			$this->set_option ( $options, $key );
		}
	}
}

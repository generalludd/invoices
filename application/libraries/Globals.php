<?php


class Globals {

	protected $CI;

	function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->model('variable_model');


	}

	function get($key, $user_id){
		return $this->CI->variable_model->get('global',$key, $user_id)->var_value;

	}
}

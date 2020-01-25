<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Variable_model extends MY_Model {
	var $category;
	var $user_id = 0;
	var $var_key;
	var $var_value;

	function __construct()
	{
		parent::__construct ();
	}

	function get_types($category)
	{
		$this->db->from ( "variable" );
		$this->db->where ( "category", $category );
		$this->db->order_by ( "var_value" );
		$result = $this->db->get ()->result ();
		return $result;
	}

	function get($category, $key, $user_id = 0)
	{
		$this->db->from ( "variable" );
		$this->db->where ( "category", $category );
		$this->db->where('user_id',$user_id);
		$this->db->where ( "var_key", $key );
		$result = $this->db->get ()->row ();
		return $result;
	}

	function insert($category, $value, $user_id = 0)
	{
		$this->var_key = preg_replace ( "/[a-z]\_]/", '', str_replace ( " ", "_", strtolower ( $value ) ) );
		if (!empty($this->get ( $category, $this->var_key , $this->user_id))) {
			$this->var_value = $value;
			$this->category = $category;
			$this->user_id= $user_id;
			$this->_insert ( "variable" );
		}
		return $this->var_key;
	}

	function get_pairs($category, $user_id=0, $order_by = array())
	{
		$this->db->where ( 'category', $category );
		$this->db->select ( 'var_key' );
		$this->db->select ( 'var_value' );
		$direction = "ASC";
		$order_field = "key";
		
		if (! empty ( $order_by )) {
			if (array_key_exists ( 'direction', $order_by )) {
				$direction = $order_by ['direction'];
			}
			if (array_key_exists ( 'field', $order_by )) {
				$order_field = $order_by ['field'];
			}
			$this->db->order_by ( $order_field, $direction );
		}
		if($user_id !=0) {
			$this->db->where_in('user_id',[0,$user_id]);
		}
		else{
			$this->db->where('user_id', $user_id);
		}
		
		$this->db->from ( 'variable' );
		$result = $this->db->get ()->result ();
		return $result;
	}
}

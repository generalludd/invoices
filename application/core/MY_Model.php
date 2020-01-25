<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class MY_Model extends CI_Model {

	function __construct()
	{
		parent::__construct ();
	}

	function _get_value($db, $id, $field)
	{
		$this->db->where ( "id", $id );
		$this->db->select ( $field );
		$this->db->from ( $db );
		$output = $this->db->get ()->row ();
		if ($output) {
			return $output->$field;
		} else {
			return FALSE;
		}
	}

	function _get($db, $id)
	{
		$this->db->from ( $db );
		$this->db->where ( "id", $id );
		$result = $this->db->get ()->row ();
		return $result;
	}

	function _get_distinct($db, $field)
	{
		$this->db->from ( $db );
		$this->db->distinct ( $field );
		$this->db->order_by ( $field );
		$result = $this->db->get ()->result ();
		return $result;
	}

	function _insert($db)
	{
		if ($this->ion_auth->in_group ( array (
				1,
				2 
		) )) {
			$this->db->from($db);
			$this->db->set($this);
			$this->db->insert();
			$id = $this->db->insert_id ();
			return $id;
		} else {
			return FALSE;
		}
		$this->_log ();
	}

	function _update($db, $id, $values = NULL)
	{
		if ($this->ion_auth->in_group ( array (
				1,
				2 
		) )) {
			$this->db->where ( "id", $id );
			if (empty ( $values )) {
				$this->prepare_variables ();
				$this->db->update ( $db, $this );
			} else {
				$this->db->update ( $db, $values );
				
				if (count ( $values ) == 1) {
					$keys = array_keys ( $values );
					return $this->_get_value ( $db, $id, $keys [0] );
				}
			}
		} else {
			return FALSE;
		}
	}

	function _delete($db, $id)
	{
		if ($this->ion_auth->in_group ( array (
				1,
				2 
		) )) {
			$this->db->delete ( $db, array (
					"id" => $id 
			) );
		} else {
			return FALSE;
		}
		return $this->db->last_query ();
	}

	function _log($element = "warning")
	{
		if ($_SERVER ['HTTP_HOST'] != 'inventory.fsmn.org') {
			$last_query = $this->db->last_query ();
			$this->session->set_flashdata($element,$last_query);
		}
	}
}

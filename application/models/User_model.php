<?php
class User_model extends Ion_auth_model {

	function __construct()
	{
		parent::__construct ();
	}

	function get_group_members($group_id)
	{
		$this->db->from ( "users" );
		$this->db->where ( "users_groups.group_id", $group_id );
		$this->db->join ( "users_groups", "users.id=users_groups.user_id" );
		$this->db->order_by ( "users.username" );
		$this->db->select ( "users.id,CONCAT(`users`.`first_name`,' ',`users`.`last_name`) as user", FALSE );
		$result = $this->db->get ()->result ();
		return $result;
	}

	function get_user($id)
	{
		$this->db->from ( "users" );
		$this->db->where ( "users.id", $id );
		$this->db->select ( "users.id, users.first_name, users.last_name, users.email" );
		$result = $this->db->get ()->row ();
		return $result;
	}
}
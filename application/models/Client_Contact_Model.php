<?php


class Client_Contact_Model extends MY_Model {

	public $client_id;

	public $contact_id;

	public $role;

	function get_clients($contact_id){
		$this->db->from('client_contact');
		$this->db->where('contact_id',$contact_id);
		$this->db->join('client','client.id=client_contact.client_id');
		$this->db->select('client.*, client_contact.role');
		return $this->db->get()->result();
	}

	function get_contact($client_id){
		$this->db->from('client_contact');
		$this->db->where('client_id',$client_id);
		$this->db->join('contact','contact.id=client_contact.contact_id');
		$this->db->select('contact.*, client_contact.role');
		return $this->db->get()->result();
	}

	function insert($client_id, $contact_id , $role = NULL){
		$this->contact_id = $contact_id;
		$this->client_id =$client_id;
		$this->role = $role;
		$this->_insert('client_contact');
		return $this->db->insert_id ();
	}

	function update($client_id, $contact_id, $role){
		$this->db->where('client_id',$client_id);
		$this->db->where('contact_id',$contact_id);
		$this->db->update('client_contact', ['role'=>$role]);
	}

	function delete($client_id, $contact_id){
		$this->db->where('client_id', $client_id);
		$this->db->where('contact_id', $contact_id);
		$this->db->delete('client_contact');
	}

}

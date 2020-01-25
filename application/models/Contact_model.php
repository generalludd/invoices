<?php


class Contact_Model extends MY_Model {

	public $first_name;

	public $last_name;

	public $email;

	public $phone;

	public $user_id;

	function __construct() {
		parent::__construct();
		$this->load->model('Client_Contact_Model', 'client_contact');
	}

	function prepare_variables() {
		foreach ($this as $key => $value) {
			$this->{$key} = $this->input->post($key);
		}
	}

	function get($contact_id) {
		$contact = $this->_get('contact', $contact_id);
		$contact->clients = $this->client_contact->get_clients($contact_id);
		return $contact;

	}

	function insert($client_id, $role) {
		$this->prepare_variables();
		$contact_id = $this->_insert('contact');
		if ($client_id) {
			$this->client_contact->insert($client_id, $contact_id, $role);
		}
		return $contact_id;

	}

	function update($contact_id) {
		$this->prepare_variables();
		$this->_update('contact', $contact_id);
		$roles = count($this->input->post('role'));
		for($i = 0; $i< $roles; $i++){
			$this->client_contact->update($this->input->post('client_id')[$i], $contact_id, $this->input->post('role')[$i]);
		}

	}


}

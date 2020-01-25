<?php


class Client_model extends MY_Model {

	public $client_name;

	public $email;

	public $phone;

	public $address;

	public $city;

	public $state;

	public $postal_code;

	public $country;

	public $url;

	public $user_id;

	public $rate;

	function __construct() {
		parent::__construct();
		$this->load->model('Client_Contact_Model', 'client_contact');
	}


	function prepare_values() {
		foreach ($this as $key => $value) {
				$this->{$key} = $this->input->post($key);
		}

	}

	function get($client_id) {
		$client =  $this->_get('client', $client_id);
		$client->contacts = $this->client_contact->get_contact($client_id);
		return $client;
	}

	function get_all(){
		$this->db->from('client');
		$this->db->where('user_id',$this->ion_auth->get_user_id());
		$this->db->order_by('client_name');
		$clients = $this->db->get()->result();
		foreach($clients as $client){
			$client->contacts = $this->client_contact->get_contact($client->id);
		}
		return $clients;
	}

	function insert() {
		$this->prepare_values();
		return $this->_insert('client');

	}

	function update($client_id) {
			$this->prepare_values();
			$this->_update('client', $client_id, $this);
	}

}

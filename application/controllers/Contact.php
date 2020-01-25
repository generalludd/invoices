<?php


class Contact extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Contact_model', 'contact');
		$this->load->model('Client_model', 'client');

	}

	function index() {
		//show all contacts propbably grouped by client
	}

	function view($contact_id) {
		$contact = $this->contact->get($contact_id);
		$data = [
			'title' => 'Viewing ' . format_name($contact),
			'target' => 'contact/view',
			'contact' => $contact,
		];
		if ($this->input->get('ajax')) {
			$this->load->view('page/modal', $data);
		}
		else {
			$this->load->view('page/index', $data);
		}
	}

	function create($client_id) {
		$client = $this->client->get($client_id);
		$data = [
			'title' => 'Adding a contact for ' . $client->client_name,
			'target' => 'contact/edit',
			'action' => 'insert',
			'contact' => NULL,
			'client' => $client,
		];
		if ($this->input->get('ajax')) {
			$this->load->view('page/modal', $data);
		}
		else {
			$this->load->view('page/index', $data);
		}
	}

	function insert() {
		$contact_id = $this->contact->insert($this->input->post('client_id'), $this->input->post('role'));
		redirect('contact/view/' . $contact_id);
	}

	function edit($contact_id) {
		$contact = $this->contact->get($contact_id);
		$data = [
			'title' => 'Editing ' . format_name($contact),
			'target' => 'contact/edit',
			'action' => 'update',
			'contact' => $contact,
			'clients' => $contact->clients,
		];
		if ($this->input->get('ajax')) {
			$this->load->view('page/modal', $data);
		}
		else {
			$this->load->view('page/index', $data);
		}
	}

	function update() {
		$contact_id = $this->input->post('id');
		$this->contact->update($contact_id);
		redirect('contact/view/' . $contact_id);
	}


}

<?php


class Client extends My_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('client_model', 'client');
		$this->load->model('Invoice_model','invoice');
	}

	function index() {
		$clients = $this->client->get_all();
		$data = [
			'title' => 'Showing all your clients',
			'target' => 'client/list',
			'clients' => $clients,
		];
		$this->load->view('page/index', $data);

	}

	function view($client_id) {
		$client = $this->client->get($client_id);
		$invoices = $this->invoice->get_for_client($client_id);
		$data = [
			'title' => 'Viewing ' . $client->client_name,
			'target' => 'client/view',
			'client' => $client,
			'invoices'=>$invoices,
		];
		$this->load->view('page/index', $data);
	}

	function create() {
		$data = [
			'target' => 'client/edit',
			'action' => 'insert',
			'title' => 'Create a Client',
			'client' => NULL,
		];
		if (NULL !== $this->input->get('ajax')) {
			$this->load->view('page/modal', $data);
		}
		else {
			$this->load->view('page/index', $data);
		}
	}

	function insert() {
		$client_id = $this->client->insert();
		redirect('client/view/' . $client_id);
	}

	function edit($client_id) {
		$client = $this->client->get($client_id);
		$data = [
			'target' => 'client/edit',
			'action' => 'update',
			'title' => 'Edit ' . $client->client_name,
			'client' => $client,
		];
		if ($this->input->get('ajax')) {
			$this->load->view('page/modal', $data);
		}
		else {
			$this->load->view('page/index', $data);
		}

	}

	function update() {
		if ($client_id = $this->input->post('id')) {
			$this->client->update($client_id);
			redirect('client/view/' . $client_id);
		}
		else {
			$this->session->set_flashdata('alert', 'The client id was missing from the update script.');
			redirect('/');
		}
	}

	function delete() {

	}

}

<?php


class Invoice extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Invoice_model', 'invoice');
		$this->load->model('Client_model', 'client');
		$this->load->model('Timesheet_model', 'timesheet');

	}

	function index() {

	}

	function view($invoice_id) {
		$invoice = $this->invoice->get($invoice_id);
		$free_entries = $this->timesheet->get_for_user($this->ion_auth->get_user_id(), [
			'uninvoiced' => TRUE,
			'client_id' => $invoice->client->id,
		]);
		$data = [
			'title' => 'Editing Invoice #' . $invoice_id,
			'target' => 'invoice/view',
			'invoice' => $invoice,
			'free_entries' => $free_entries,
		];
		$this->load->view('page/index', $data);
	}


	function create($client_id) {
		$client = $this->client->get($client_id);
		$data = [
			'title' => 'Create an invoice for ' . $client->client_name,
			'target' => 'invoice/edit',
			'action' => 'insert',
			'client' => $client,
			'invoice' => NULL,
		];
		$this->load->view('page/index', $data);
	}

	function insert() {
		$invoice_id = $this->invoice->insert();
		redirect('invoice/view/' . $invoice_id);
	}

	function edit($invoice_id){
		$invoice = $this->invoice->get($invoice_id);
		$client = $this->client->get($invoice->client_id);

		$data =[
			'title'=>'Edit Invoice Details',
			'target' =>'invoice/edit',
			'action'=>'update',
			'invoice' => $invoice,
			'client'=>$client,
		];
		if($this->input->get('ajax')){
			$this->load->view('page/modal', $data);
		}
		else{
			$this->load->view('page/index',$data);
		}
	}

	function update(){
		$invoice_id= $this->input->post('id');
		$this->invoice->update($invoice_id);
		redirect('invoice/view/' . $invoice_id);
	}
}

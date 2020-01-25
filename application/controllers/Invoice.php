<?php


class Invoice  extends MY_Controller {

	function __construct() {
		parent::__construct();
$this->load->model('Invoice_model','invoice');
		$this->load->model('Client_model','client');
		$this->load->model('Timesheet_model','timesheet');

	}

	function index(){

	}


	function create($client_id){
		$client = $this->client->get($client_id);
		$time_entries = $this->timesheet->get_for_user($this->ion_auth->get_user_id(), ['uninvoiced'=>TRUE, 'client_id'=>$client_id]);
		$data =[
			'title'=>'Create an invoice for ' . $client->client_name,
			'target' => 'invoice/edit',
			'action' => 'insert',
			'client' => $client,
			'invoice'=>NULL,
			'time_entries'=>$time_entries,
		];
		$this->load->view('page/index', $data);
	}
}

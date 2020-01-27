<?php


class Invoice_model extends MY_Model {

	public $client_id;

	public $user_id;

	public $date_created;

	public $date_sent;

	public $date_paid;

	function __construct() {
		parent::__construct();
		$this->load->model('client_model', 'client');
		$this->load->model('timesheet_model', 'timesheet');

	}

	function prepare_variables() {
		foreach ($this as $key => $value) {
			$this->{$key} = $this->input->post($key);
		}
	}

	function get($invoice_id) {
		$invoice = $this->_get('invoice', $invoice_id);
		$invoice->client = $this->client->get($invoice->client_id);
		$invoice->time_entries = $this->timesheet->get_for_user($this->ion_auth->get_user_id(), ['invoice_id' => $invoice_id]);
		return $invoice;

	}

	function insert() {
		$this->prepare_variables();
		return $this->_insert('invoice');
	}

	function get_for_client($client_id){
		$this->db->from('invoice');
		$this->db->where('client_id', $client_id);
		$this->db->order_by('date_paid');
		$this->db->order_by('date_sent');
		$this->db->order_by('date_created');
		return $this->db->get()->result();
	}

	function update($invoice_id){
		$this->prepare_variables();
		$this->_update('invoice',$invoice_id, $this);
	}

}

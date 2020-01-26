<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Timesheet_model extends MY_Model {

	public $user_id;

	public $day;

	public $start_time;

	public $end_time;

	public $category;

	public $details;

	public $client_id;

	public $invoice_id;

	function prepare_variables() {
		foreach ($this as $key => $value) {
			$this->{$key} = $this->input->post($key);
		}
	}

	function get($id) {
		return $this->_get('timesheet', $id);
	}

	function get_for_user($user_id, $options = []) {
		$this->db->from('timesheet');
		$this->db->where('timesheet.user_id', $user_id);
		if (array_key_exists('day', $options)) {
			$this->db->where('day', $options ['day']);
		}
		if (array_key_exists('start_time', $options)) {
			$this->db->where('start_time >=', $options ['start_time']);
		}
		if (array_key_exists('end_time', $options)) {
			$this->db->where('end_time <=', $options ['end_time']);
		}
		if (array_key_exists('start_day', $options)) {
			$this->db->where('day >=', $options ['start_day']);
		}
		if (array_key_exists('end_day', $options)) {
			$this->db->where('day <=', $options ['end_day']);
		}
		if (array_key_exists('category', $options)) {
			$this->db->where('timesheet.category', $options ['category']);
		}
		if(array_key_exists('uninvoiced', $options)){
			$this->db->where('timesheet.invoice_id IS NULL', FALSE, FALSE);
		}
		if(array_key_exists('client_id', $options)){
			$this->db->where('client_id', $options['client_id']);
		}
		if(array_key_exists('invoice_id', $options)){
			$this->db->where('invoice_id', $options['invoice_id']);
		}
		$this->db->join("variable", "variable.category='time_category' AND var_key = timesheet.category", "LEFT");
		$this->db->order_by('day');
		$this->db->order_by('start_time');
		$this->db->order_by('end_time');
		$this->db->select("timesheet.*,variable.var_value");
		$timesheets = $this->db->get()->result();
		foreach($timesheets as $timesheet){
			$timesheet->client = $this->client->get($timesheet->client_id);
		}
		return $timesheets;
	}

	function insert($values = []) {
		if (empty ($values)) {
			$this->prepare_variables();
			$this->category = $this->variable->insert('time_category', $this->category, $this->user_id);
		}
		else {
			foreach ($values as $key => $value) {
				$this->{$key} = $value;
			}
		}
		return $this->_insert('timesheet');
	}

	function update($id, $values = []) {
		if (empty ($values)) {
			$this->prepare_variables();
			$this->category = $this->variable->insert('time_category', $this->category, $this->user_id);

		}
		else {
			foreach ($values as $key => $value) {
				$this->{$key} = $value;
			}
		}
		return $this->_update('timesheet', $id, $this);
	}

	function delete($id) {
		$this->_delete('timesheet', $id);
	}
}

<?php


class Invoice_model extends MY_Model{
	protected $client_id;
	protected $user_id;
	protected $date_created;
	protected $date_sent;
	protected $date_paid;

	function prepare_variables(){
		foreach($this as $key=>$value){
			$this->{$key} = $this->input->post($key);
		}
	}



}

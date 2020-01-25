<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Timesheet extends MY_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->model ( 'timesheet_model', 'timesheet' );
		$this->load->model ( 'user_model', 'user' );
		$this->load->model ( 'variable_model', 'variable' );
		$this->load->model('client_model', 'client');
	}

	public function index()
	{
		// redirect to show the search for the current day
		redirect ( sprintf ( "timesheet/search?is_search=1&start_day=%s&end_day=%s&user_id=%s", date ( 'Y-m-d' ), date ( 'Y-m-d' ), $this->ion_auth->get_user_id () ) );
	}

	public function search()
	{
		if ($this->input->get ( "is_search" )) {
			$user_id = $this->input->get ( "user_id" );
			$user_id || $user_id = $this->ion_auth->get_user_id ();
			$fields = array (
					"start_day",
					"end_day",
					"category" 
			);
			$options = array ();
			foreach ( $fields as $field ) {
				if ($value = $this->input->get ( $field )) {
					$options [$field] = $value;
				}
			}
			$user = $this->user->get_user ( $user_id );
			$data ['entries'] = $this->timesheet->get_for_user ( $user_id, $options );
			$data ['target'] = "timesheet/list";
			$data ['title'] = "Time Search Results for $user->first_name $user->last_name";
			if ($this->input->get ( "export" )) {
				$this->load->helper ( "download" );
				$data ['filename'] = sprintf ( "%s_%s-timesheet_%s.csv", $user->first_name, $user->last_name, implode ( "_", $options ) );
				$this->load->view ( "timesheet/export", $data );
			} else {
				$this->load->view ( 'page/index', $data );
			}
		} else {
			$user_id = $this->ion_auth->get_user_id ();
			$data ['user_id'] = $user_id;
			$users = array ();
			if ($this->ion_auth->is_admin ()) {
				
				$users = $this->ion_auth->users ()->result ();
			}
			$data ['users'] = get_keyed_pairs ( $users, array (
					"user_id",
					"first_name" 
			) );

			$clients = $this->client->get_all();
			$data['clients'] = get_keyed_pairs($clients,[
				'id',
				'client_name',
			],TRUE, FALSE);
			$categories = $this->variable->get_pairs ( 'time_category', $user_id, array (
					"field" => "var_key",
					"direction" => "ASC" 
			) );
			$data ['categories'] = get_keyed_pairs ( $categories, array (
					"var_key",
					"var_value" 
			), TRUE, TRUE );
			$data ['target'] = "timesheet/search";
			$data ['title'] = "Search for Timesheet Entries";
			if ($this->input->get ( "ajax" )) {
				$this->load->view ( 'page/modal', $data );
			} else {
				$this->load->view ( 'page/index', $data );
			}
		}
	}

	public function create($user_id = NULL)
	{
		// @TODO Make sure that unauthorized users cannot see other users' timesheets.
		$user_id || $user_id = $this->ion_auth->get_user_id ();
		$user = $this->user->get_user ( $user_id );
		$data ['user'] = $user;
		$data ['title'] = sprintf ( 'Create a Timesheet entry for %s %s', $user->first_name, $user->last_name );
		$data ['target'] = 'timesheet/edit';
		$categories = $this->variable->get_pairs ( 'time_category', $user_id, array (
				"field" => "var_key",
				"direction" => "ASC" 
		) );
		$data ['categories'] = get_keyed_pairs ( $categories, array (
				"var_key",
				"var_value" 
		), TRUE, TRUE );

		$clients = $this->client->get_all();
		$data['clients'] = get_keyed_pairs($clients,[
			'id',
			'client_name',
		],TRUE, FALSE);
		$data ['action'] = 'insert';
		$data ['entry'] = NULL;
		if ($this->input->get ( 'ajax' )) {
			$this->load->view ( 'page/modal', $data );
		} else {
			$this->load->view ( 'page/index', $data );
		}
	}

	public function next($id)
	{
		$last_entry = $this->timesheet->get ( $id );
		$values = array (
				"user_id" => $last_entry->user_id,
				"day" => $last_entry->day,
				"start_time" => $last_entry->end_time,
				"end_time" => date ( "H:i" ) 
		);
		$this->timesheet->insert ( $values );
		redirect ( "timesheet/search?is_search=1&start_day=$last_entry->day&end_day=$last_entry->day&user_id=$last_entry->user_id" );
	}

	public function insert()
	{
		$this->timesheet->insert ();
		$date = $this->input->post ( "day" );
		$user_id = $this->input->post ( "user_id" );
		redirect ( sprintf ( "timesheet/search?is_search=1&start_day=%s&end_day=%s&user_id=%s", $date, $date, $user_id ) );
	}

	public function edit($id)
	{
		$entry = $this->timesheet->get ( $id );
		$data ['entry'] = $entry;
		$user_id = $entry->user_id;
		$user = $this->user->get_user ( $user_id );
		$data ['user'] = $user;
		$data ['title'] = sprintf ( 'Edit a Timesheet entry for %s %s', $user->first_name, $user->last_name );
		$data ['target'] = 'timesheet/edit';
		$categories = $this->variable->get_pairs ( 'time_category', $user_id, array (
				"field" => "var_key",
				"direction" => "ASC" 
		) );

		$data ['categories'] = get_keyed_pairs ( $categories, array (
				"var_key",
				"var_value" 
		), TRUE, TRUE );

		$clients = $this->client->get_all();
		$data['clients'] = get_keyed_pairs($clients,[
			'id',
			'client_name',
		],TRUE, FALSE);
		$data ['action'] = 'update';
		if ($this->input->get ( 'ajax' )) {
			$this->load->view ( 'page/modal', $data );
		} else {
			$this->load->view ( 'page/index', $data );
		}
	}

	public function update()
	{
		$id = $this->input->post ( "id" );
		$this->timesheet->update ( $id );
		$date = $this->input->post ( "day" );
		$user_id = $this->input->post ( "user_id" );
		redirect ( sprintf ( "timesheet/search?is_search=1&start_day=%s&end_day=%s&user_id=%s", $date, $date, $user_id ) );
	}

	public function delete()
	{
		$id = $this->input->post ( "id" );
		$entry = $this->timesheet->get ( $id );
		$this->timesheet->delete ( $id );
		$target = "timesheet/search?is_search=1&start_day=$entry->day&end_day=$entry->day&user_id=$entry->user_id";
		if ($this->input->post ( "ajax" ) == 1) {
			echo site_url ( $target );
		} else {
			redirect ( $target );
		}
	}
}

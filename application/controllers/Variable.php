<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Variable extends MY_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->model ( "variable_model", "variable" );
	}

	function show_all($category = FALSE)
	{
		if ($this->ion_auth->in_group ( 1 )) {
			$data ["items"] = $this->variable->get_all ( $category );
			$data ["categories"] = $this->variable->get_categories ( FALSE );
			
			if ($category) {
				$data ["title"] = "Showing Menu Items for $category";
			} else {
				$data ["title"] = "Showing All Menu Items";
			}
		} else {
			$data ["title"] = "You are not authorized to view this page.";
			$data ["items"] = NULL;
			$this->session->set_flashdata ( "notice", "You are not authorized to do edit menu items" );
		}
		$data ["target"] = "menu/list";
		
		$this->load->view ( "page/index", $data );
	}

	function show_categories()
	{
		$data ["categories"] = $this->variable->get_categories ( FALSE );
		$data ["target"] = "menu/categories";
	}

	function create()
	{
		if ($this->ion_auth->in_group ( 1 )) {
			$data ["title"] = "Editing a Menu Item";
			$data ["target"] = "menu/edit";
			$data ["ajax"] = FALSE;
			$data ["action"] = "insert";
			$data ["item"] = NULL;
			$data ["categories"] = get_keyed_pairs ( $this->variable->get_categories ( FALSE ), array (
					"category",
					"category" 
			) );
			$page = "page/index";
			if ($this->input->get ( "ajax" )) {
				$data ["ajax"] = TRUE;
				$page = $data ["target"];
			}
			$this->load->view ( $page, $data );
		}
	}

	function edit($id = NULL)
	{
		if ($id) {
			$data ["title"] = "Editing a Menu Item";
			$data ["target"] = "menu/edit";
			$data ["ajax"] = FALSE;
			$data ["categories"] = get_keyed_pairs ( $this->variable->get_categories ( FALSE ), array (
					"category",
					"category" 
			) );
			
			$page = "page/index";
			if ($this->input->get ( "ajax" )) {
				$data ["ajax"] = TRUE;
				
				$page = $data ["target"];
			}
			
			if ($this->ion_auth->in_group ( 1 )) {
				$data ["action"] = "update";
				$data ["item"] = $this->variable->get ( $id );
			} else {
				$data ["item"] = NULL;
				$data ["title"] = "No Access";
				$data ["action"] = FALSE;
			}
			$this->load->view ( $page, $data );
		}
	}

	function insert()
	{
		if ($this->ion_auth->in_group ( 1 )) {
			$item = $this->variable->insert ();
			$this->session->set_flashdata ( "notice", "The item was successfully added" );
			redirect ( "menu/show_all/$item->category" );
		}
	}

	function update()
	{
		if ($this->ion_auth->in_group ( 1 )) {
			if ($id = $this->input->post ( "id" )) {
				$item = $this->variable->update ( $id );
				$this->session->set_flashdata ( "notice", "The item was successfully updated" );
				
				redirect ( "menu/show_all/$item->category" );
			}
		}
	}

	function edit_value()
	{
		$data ["name"] = $this->input->get ( "field" );
		
		$value = $this->input->get ( "value" );
		if ($value != "&nbsp;") {
			$data ["value"] = $value;
		} else {
			$data ['value'] = "";
		}
		if (is_array ( $value )) {
			$data ["value"] = implode ( ",", $value );
		}
		$data ["data-id"] = $this->input->get ( "id" );
		$data ["size"] = strlen ( $data ["value"] ) + 5;
		$data ["type"] = $this->input->get ( "type" );
		$data ["category"] = $this->input->get ( "category" );
		$data['data-field'] = $this->input->get('field');
		$data['data-table'] = $this->input->get('table');
		$data['class'] = "inline-field form-control";

		switch ($data ["type"]) {
			case "dropdown" :
				$output = $this->_get_dropdown ( $data ["category"], $data ["value"], $data ["name"] );
				break;
			case "multiselect" :
				$output = $this->_get_multiselect ( $data ["category"], $data ["value"], $data ["name"] );
				break;
			case "autocomplete" :
			    $data['class'] .= " autocomplete";
			    $output = form_input ( $data );
				break;
			default :
				$output = form_input ( $data );
		}
		
		echo $output;
	}

	function _get_dropdown($category, $value, $field, $parent_id = FALSE)
	{
		$categories = $this->variable->get_pairs ( $category, array (
				"field" => "var_value",
				"direction" => "ASC" 
		) );
		
		$pairs = get_keyed_pairs ( $categories, array (
				"key",
				"value" 
		), TRUE );
		return form_dropdown ( $field, $pairs, $value, "class='live-field'" );
	}

	function _get_multiselect($category, $value, $field)
	{
		$categories = $this->variable->get_pairs ( $category, array (
				"field" => "value",
				"direction" => "ASC" 
		) );
		$pairs = get_keyed_pairs ( $categories, array (
				"key",
				"value" 
		) );
		$output = array ();
		$output [] = form_multiselect ( $field, $pairs, explode ( ",", $value ), "id='$field'" );
		$buttons = implode ( " ", $output );
		echo $buttons . sprintf ( "<span class='button save-multiselect' target='%s'>Save</span>", $field );
	}
}

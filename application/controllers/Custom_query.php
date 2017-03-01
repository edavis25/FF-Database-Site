<?php

class Custom_query extends CI_Controller {
	
	
	
	public function __construct() {
       parent::__construct();
	   $this->load->helper('util');
    }
	
	public function query() {
		$data = array();
		$this->load->view('custom_query_view', $data);
	}
	
	/**
	 * This function is called from an AJAX request in "custom-query.js"
	 */
	public function display_results() {
		// Load model
		$this->load->model('Custom_query_model');
		
		// Build data array with POST data filters
		$input = array(
			
			'Roof' => safeParam($_POST, 'roof-radios', '%')
		);
		
		
		$data['data'] = $this->Custom_query_model->gameQuery($input);
		
		// Get the POST data
		// TODO: Get selected teams as formatted array
		//$data['team'] = safeParam($_POST['select-team'], 0, false);
		
		//$data['start_year'] = $_POST['start-year'];
		
		$this->load->view('query_results_view', $data);
	}
}
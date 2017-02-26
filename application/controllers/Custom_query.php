<?php

class Custom_query extends CI_Controller {
	
	public function query() {
		$data = array();
		$this->load->view('custom_query_view', $data);
	}
	
	public function display_results() {
		$data = array();
		$data['test'] = $_POST['test'];
		$data['team'] = $_POST['select-team'];
		$data['start_year'] = $_POST['start-year'];
		
		$this->load->view('query_results_view', $data);
	}
}
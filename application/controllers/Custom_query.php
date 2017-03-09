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
	
	public function display_team_stats_results() {
		// Load model + build array for the SQL query
		$this->load->model('Custom_query_model');
		
		$input = array();
		
		// Get selected teams as array
		$teamArr = $this->input->post('select-team');
		// If no team selected -OR- "Select ALL" option checked, get all team names as array
		if (!$teamArr || $teamArr[0] == '%') {
			$teamArr = $this->Custom_query_model->selectAllTeamNames();
		}
		$input['Teams'] = $teamArr;
		
		// Run query and retrieve results
		$data['data'] = $this->Custom_query_model->teamQuery($input);
		
		// Load results table
		$this->load->view('query_results_view', $data);
	}
	
	
	/**
	 * This function is called from an AJAX request in "custom-query.js"
	 */
	public function display_game_results() {
			
		// Load model + build array for the SQL query
		$this->load->model('Custom_query_model');
		
		$input = array();
		
		// Get selected teams as array
		$teamArr = $this->input->post('select-team');
		// If no team selected -OR- "Select ALL" option checked, get all team names as array
		if (!$teamArr || $teamArr[0] == '%') {
			$teamArr = $this->Custom_query_model->selectAllTeamNames();
		}		
		
		// Get won/lost filter (used with $teamArr in query for Winners/Losers columns)
		$wonLost = safeParam($_POST, 'won-radios', false);
		if ($wonLost == 'won') {
			$input['Winner'] = $teamArr;
			$input['Loser'] = array('');
		}
		else if ($wonLost == 'lost') {
			$input['Winner'] = array('');
			$input['Loser'] = $teamArr;
		}
		else {
			$input['Winner'] = $teamArr;
			$input['Loser'] = $teamArr;
		}
		
		// Get the other radio button choices		
		$input['Roof'] = safeParam($_POST, 'roof-radios', '%');
		
		$input['Surface'] = safeParam($_POST, 'surface-radios', '%');

		$input['Spread'] = safeParam($_POST, 'spread-radios', '%');

		$input['OverUnder'] = safeParam($_POST, 'overUnder-radios', '%');
		
		// Get start and end year. Note: 04-20 (April 20th) is the usual date new NFL offseasons begin
		$input['StartDate'] = safeParam($_POST, 'start-year', false);
		if ($input['StartDate'] == 'allYears') {
			$input['StartDate'] = '1900-04-20';
			$input['EndDate'] = '9999-04-20';
		}
		else {
			$input['StartDate'] = $input['StartDate'] . '-04-20';
			$input['EndDate'] = safeParam($_POST, 'end-year', false) .'-04-20';
		}
		
		// Get start week and end week
		$input['StartWeek'] = safeParam($_POST, 'start-week', 0);
		if (!$input['StartWeek']) {
			$input['EndWeek'] = '99'; 
		}
		else {
			$input['EndWeek'] = safeParam($_POST, 'end-week', false);
		} 
		
		// Run query and retrieve results
		$data['data'] = $this->Custom_query_model->gameQuery($input);
		
		// Load results table
		$this->load->view('query_results_view', $data);
	}
	
}
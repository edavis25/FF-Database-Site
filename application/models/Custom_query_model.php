<?php 

Class Custom_query_model extends CI_Model {
		
	// Global variable for the DB's Game View
	private $GAME_VIEW = 'Games_View';
	
	function gameQuery($data) {

		$sql = "SELECT * FROM $this->GAME_VIEW WHERE
				Winner IN ? OR
				Loser IN ? AND
				Roof LIKE ? AND
				Surface LIKE ? AND
				SpreadCovered LIKE ? AND
				OUResult LIKE ? AND
				Week BETWEEN ? AND ? AND
				Date BETWEEN ? AND ?
				LIMIT ?
				";
		
		// Create variable binding array
		$binds = array(
			$data['Winner'],
			$data['Loser'],
			$data['Roof'],
			$data['Surface'],
			$data['Spread'],
			$data['OverUnder'],
			$data['StartWeek'],
			$data['EndWeek'],
			$data['StartDate'],
			$data['EndDate'],
			10
		);
		
		$query = $this->db->query($sql, $binds);

		
		// Build query testing (return SQL as string)
		$arr = array(array($this->db->last_query()));
		return $arr;
		
		// WORKING RESULTS RETURN -->
        //return $query->result_array();
	}
	
	/*
	 * Get integer indexed, single dimension array of all team names
	 */
	function selectAllTeamNames() {
		$result = array();
		
		$query = $this->db->query('SELECT Name FROM Teams');
		$teams = $query->result_array();

		foreach ($teams as $row) {
			foreach ($row as $col) {
				$result[] = $col;
			}
		}
		return $result;
	}

	
}
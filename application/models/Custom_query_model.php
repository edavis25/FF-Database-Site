<?php 

Class Custom_query_model extends CI_Model {
		
	// Global variables for the DB table/views
	private $GAME_VIEW = 'Games_View';
	private $TEAM_VIEW = 'TeamGame_View';
	
	function gameQuery($data) {

		$sql = "SELECT Date, Week, Day, Time, Winner, Loser, WinScore, LoseScore, Duration, Stadium, Attendance, Roof, Surface, Temp, Humidity, Wind, Favored, Spread, SpreadCovered, OULine, OUResult
				FROM $this->GAME_VIEW WHERE
				(Winner IN ? OR
				Loser IN ?) AND
				Roof LIKE ? AND
				Surface LIKE ? AND
				SpreadCovered LIKE ? AND
				OUResult LIKE ? AND
				Week BETWEEN ? AND ? AND
				Date BETWEEN ? AND ?
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
			$data['EndDate']
		);
		
		$query = $this->db->query($sql, $binds);

		
		// Build query testing (return SQL as string)
		//$arr = array(array($this->db->last_query()));
		//return $arr;
		
		// WORKING RESULTS RETURN -->
        return $query->result_array();
	}
	
	function teamQuery($data) {
		$sql = "SELECT Name, Date, Week, Day, Time, Won, Opponent, TotalScore, OppScore, Duration, Stadium, Home, Roof, Surface, Temp, Humidity, Wind,
					1stDowns, RushAtt, RushYds, RushTds, PassComp, PassAtt, PassYds, PassTds, Ints, SkTaken, SkYds, NetPassYds, TotalYds, Fmb, FL, Turnovers, Pen, PenYds,
					3rdM, 3rdAtt, 4thM, 4thAtt, TOP, Q1, Q2, Q3, Q4, OT
				FROM $this->TEAM_VIEW WHERE
				Name IN ?  
				LIMIT 10";
		
		$binds = array(
			$data['Teams']
		);
		
		$query = $this->db->query($sql, $binds);
		return $query->result_array();
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
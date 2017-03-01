<?php 

Class Custom_query_model extends CI_Model {
		
	// Global variable for the DB's Game View
	private $GAME_VIEW = 'Games_View';
	
	function gameQuery($data) {
		$sql = "SELECT * FROM $this->GAME_VIEW WHERE
				Roof LIKE ?
				LIMIT ?
				";
		
		$binds = array(
			
		);
		
		$query = $this->db->query($sql, array($data['Roof'], 10));
        
        return $query->result_array();
	}
}
	
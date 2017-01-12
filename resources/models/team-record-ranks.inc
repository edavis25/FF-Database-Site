<?php

/**
 * Get Team Win/Loss Record
 */
function getRecord($teamName, $outcome, $DB) {
	
	//global $TEAM_GAME_VIEW;
	$TEAM_GAME_VIEW = 'TeamGame2016_View';
	
	$query = "SELECT 
    				(SELECT 
        				COUNT(Won)
    				FROM " . $TEAM_GAME_VIEW . " 
    				WHERE Won = 'Y'
    				AND Name = '" . $teamName . "') AS Won,
    				(SELECT 
        				COUNT(Won)
    				FROM " . $TEAM_GAME_VIEW . " 
    				WHERE Won = 'N'
    				AND Name = '" . $teamName . "') AS Lost";

	// Query database and store results
	mysqli_query($DB, $query) or die('Error querying database. - Record');
	$result = mysqli_query($DB, $query);

	$record = array();
	while ($row = mysqli_fetch_array($result)) {
		$record[] = $row['Won'];
		$record[] = $row['Lost'];
	}

	if ($outcome == "wins") {
		return $record[0];
	} else if ($outcome == "losses") {
		return $record[1];
	} else {
		return "Record Error";
	}
}
?>
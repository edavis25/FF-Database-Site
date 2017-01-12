<?php 
	$team = $_POST['team'];
	include 'resources/models/db.inc';
	include 'resources/models/team-record-ranks.inc';
	$DB = getDB();

	function teamName()
	{
		global $team;
		return $team;
	}
	
	function showRecord()
	{
		global $DB, $team;
		return getRecord($team, "wins", $DB).' - '.getRecord($team, "losses", $DB);
	}
?>
<?php
/**
 * Helper functions for team-dashboard.php.
 * These functions contain the logic and more difficult function calls
 * to the team-record-ranks.inc model. Include this file in the team-dashboard.php
 * and use these functions for simplified displaying of data and queries.
 */

include 'resources/models/team-record-ranks.inc';

// Globals for team name and record (used in multiple functions)
$team = $_POST['team'];
$record = getRecord($team);


function getHomeWins()
{
	global $team;
	$homeRecord = retrieveHomeRecord($team);
	return json_encode($homeRecord);
}

function getAttendance()
{
	global $team;
	$attendance = retrieveAttendance($team);
	return json_encode($attendance);
}
function getTeamTheme()
{
	global $team;	
	$colors  = retrieveTeamTheme($team);
	return json_encode($colors);
}
function getTurnovers()
{
	global $team;
	$turnovers = retrieveTurnovers($team);
	return json_encode($turnovers);
}

/**
 * Get 3rd downs. Returns an associate array with 1 row and 2 columns.
 * Column names = '3rdM' and '3rdAtt' --> access like: $third[0]['3rdM']
 */
function get3rdDowns()
{
	global $team;
	$thirds = retrieve3rdDowns($team);
	return json_encode($thirds);
}

/*
 * Return the team name
 */
function teamName() 
{
	global $team;
	return $team;
}

/**
 * 'Won' or 'Lost'
 */
function getWinOrLoss($result)
{
	global $record;
	return $record[0][$result];
}

function showYardsBarChart()
{
	global $team;
	$arr = getYardTotals($team);
	
	echo "
			yardsBarChart(".json_encode($arr).");	
		";
}

function showPointsBarChart()
{
	global $team;
	$arr = getSeasonPoints($team);
	echo "
			pointsBarChart(".json_encode($arr).");	
		";
}


function fillOffLeadersTbl()
{
	global $team;	
	
	$tblString = "";
	
	/***** PASSING *****/
	$tblString = "<tr><th><b>Passing</b></th><th><b>YDs</b></th><th><b>TDs</b></th><th><b>COMP</b></th><th><b>ATT</b></th><th><b>COMP%</b></th></tr>";
	// Array of desired columns for passing
	$offCol = array("Name", "PassYds", "PassTD", "PassCmp", "PassAtt");
	// Get results
	$offResult = getSeasonLeader($team, $offCol, 'PassYds', 2);

	$tblString .= buildTableRow($offResult, 3, 4, 'percentageOf');
	
	
	/***** RUSHING *****/
	$tblString .= "<tr><th><b>Rushing</b></th><th><b>YDs</b></th><th><b>TDs</b></th><th><b>FUMB</b></th><th><b>ATT</b></th><th><b>YDs/ATT</b></th></tr>";
	// Array of desired columns for rushing
	$defCol = array("Name", "RushYds", "RushTD", "Fmb", "RushAtt");
	// Get results
	$defResult = getSeasonLeader($team, $defCol, 'RushYds', 2);
	
	$tblString .= buildTableRow($defResult, 1, 4, 'yardsPer');
	
	/***** RECEIVING *****/
	$tblString .= "<tr><th><b>Receiving</b></th><th><b>YDs</b></th><th><b>TDs</b></th><th><b>TGT</b></th><th><b>REC</b></th><th><b>YDs/REC</b></th></tr>";
	// Array of desired columns for receiving
	$recCol = array("Name", "RecYds", "RecTds", "RecTgt", "Rec");
	// Get results
	$recResult = getSeasonLeader($team, $recCol, 'RecYds', 4);
	
	$tblString .= buildTableRow($recResult, 1, 4, 'yardsPer');
	
	echo $tblString;
}

function buildTableRow($arr, $col1, $col2, $func)
{
	$result = "";
	for ($i = 0; $i < sizeof($arr); $i++)
	{
		$result.="<tr>";
		for ($j = 0; $j < sizeof($arr[$i]); $j++)
		{
			$result.="<td>";
			$result.=$arr[$i][$j];
			$result.="</td>";
		}
		$result.= "<td>";
		//$result.= number_format(percentageOf($arr[$i][$col1], $arr[$i][$col2]), 1);
		$result .= number_format($func($arr[$i][$col1], $arr[$i][$col2]), 2);
		$result.= "</td>";
		$result.= "</tr>";
	}
	return $result;
}

function percentageOf($num1, $num2)
{
	return (($num1 / $num2) * 100);
}
function yardsPer($num1, $num2)
{
	return ($num1 / $num2);
}

/**
 * Echo back the JavaScript function call for building the gauge
 * CHECK FOR REMOVAL
 */
function showGauge()
{
	global $record;	
	
	echo "
			winLossGauge(".$record[0]['Won'].",".$record[0]['Lost']."); 
		 ";
}

/*
 * Return a formatted record using function found in 'team-record-ranks.inc'
 */
function showRecord() 
{
	global $team;
	global $record;
	return $record[0]['Won'] . ' - ' . $record[0]['Lost'];
}

function showOffRank()
{
	global $team;
	return getOffRank($team);
}

function showDefRank()
{
	global $team;
	return getDefRank($team);
}

function showRushRank()
{
	global $team;
	return getRushRank($team);
}

function showPassRank()
{
	global $team;
	return getPassRank($team);
}

function showPointsRank()
{
	global $team;
	$pts = getPointsAllowedRank($team);
	return $pts[0]['Rank'];
}
function showYardsRank()
{
	global $team;
	$yds = getYardsAllowedRank($team);
	return $yds[0]['Rank'];
}

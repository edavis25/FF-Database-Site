<?php

include 'resources/models/db.inc';
include 'resources/models/db2.inc';

include 'resources/models/pdo.inc';

// Global for DB
$DB = getDB();

// Globals for Views
//$TEAM_GAME_VIEW = 'TeamGame2016_View';
$TEAM_GAME_VIEW = 'TeamGame2016_Summary';
$OFFENSE_VIEW = 'Offense2016_View';

// Object Version (Newest)
$db = new DB();




/*
 * Yet another type of DB connection :)
 * I'm still trying to learn new things, sorry :(
 */
function retrieveHomeRecord($teamName)
{
	global $TEAM_GAME_VIEW;
	global $pdo;
	
	$sql = "SELECT Home FROM $TEAM_GAME_VIEW WHERE Name = :name";
    
    $sql = 	 "SELECT 
				(SELECT COUNT(*) FROM $TEAM_GAME_VIEW
   				 	WHERE Name = :name AND Home = 'Y' AND Won = 'Y') AS Won,
   				(SELECT COUNT(*) FROM $TEAM_GAME_VIEW
    				WHERE Name = :name AND Home = 'Y') AS Home";
    
    $statement = $pdo -> prepare($sql);
    $statement -> bindParam(':name', $teamName);
    $statement -> execute();
    return $statement -> fetchAll(PDO::FETCH_ASSOC);	

}


function getPointsAllowedRank($teamName)
{
	global $TEAM_GAME_VIEW;
	global $pdo;
	
	$state = $pdo -> query('SELECT @idx := 0');
	
	$sql = "SELECT Rank
			FROM
			(SELECT 
				@idx := @idx+1 AS Rank,
				Name
			FROM
				(SELECT
					Name,
					SUM(OppScore) AS OppScore
				FROM $TEAM_GAME_VIEW
				GROUP BY TeamID
				ORDER BY OppScore ASC
				) innerTbl
			) outerTbl
		WHERE Name = :name";
	
	$statement = $pdo -> prepare($sql);
    $statement -> bindParam(':name', $teamName);
	$statement -> execute();
	return $statement -> fetchAll(PDO::FETCH_ASSOC);
}


function getYardsAllowedRank($teamName)
{
	global $TEAM_GAME_VIEW;
	global $pdo;
	
	$state = $pdo -> query('SELECT @idx := 0');
	$sql = "SELECT Rank
			FROM
			(SELECT 
				@idx := @idx+1 AS Rank,
				Opponent
			FROM
				(SELECT Opponent, (SUM(NetPassYds) + SUM(RushYds)) AS Total
				FROM $TEAM_GAME_VIEW
            	GROUP BY Opponent
            	ORDER BY Total ASC
			) innerTbl
		) outerTbl
    WHERE Opponent = :name";
	
	$statement = $pdo -> prepare($sql);
	$statement -> bindParam(':name', $teamName);
	$statement -> execute();
	return $statement -> fetchAll(PDO::FETCH_ASSOC);
}





function retrieve3rdDowns($teamName)
{
	global $TEAM_GAME_VIEW;
	global $db;
	
	$query =   "SELECT SUM(3rdM) AS 3rdM, SUM(3rdAtt) AS 3rdAtt
				FROM ".$TEAM_GAME_VIEW."
				WHERE Name = '".$teamName."'";
	
	$result = $db -> select($query);
	return $result;
}

function retrieveAttendance($teamName)
{
	global $TEAM_GAME_VIEW;
	global $db;
	
	$query =   "SELECT ROUND(AVG(Games.Attendance), 0) AS Attendance
				FROM ".$TEAM_GAME_VIEW."
				INNER JOIN Games ON Games.GameID = ".$TEAM_GAME_VIEW.".GameID
				WHERE ".$TEAM_GAME_VIEW.".Home = 'Y'
				AND ".$TEAM_GAME_VIEW.".Name = '".$teamName."'
				GROUP BY TeamID";
				
	$result = $db -> select($query);
	return $result;
}

function retrieveTurnovers($teamName)
{
	global $TEAM_GAME_VIEW;
	global $db;
	$query =   "SELECT plus.PlusFum AS PlusFum, plus.PlusInt AS PlusInt, n.NegFum AS NegFum, n.NegInt AS NegInt
				FROM
				(SELECT SUM(FL) AS PlusFum, SUM(Ints) AS PlusInt
					FROM ".$TEAM_GAME_VIEW."
					WHERE Opponent = '".$teamName."') AS plus,
				(SELECT SUM(FL) AS NegFum, SUM(Ints) AS NegInt
					FROM TeamGame2016_Summary
    				WHERE Name = '".$teamName."') AS n";
	
	$result = $db -> select($query);
	return $result;
}

function retrieveTeamTheme($teamName)
{
	global $db;
	$query = "SELECT PrimaryColor, SecondaryColor, TopNavColor, TopNavText, SideNavText, LogoURL
				FROM TeamTheme
				INNER JOIN Teams ON Teams.TeamID = TeamTheme.TeamID
				AND Teams.Name = '".$teamName."'";
	
	$result = $db -> select($query);
	return $result;
}

/**
 * Get Team Win/Loss Record
 * Note: $outcome MUST be Won or Lost (or same as given column name - used in assoc. array)
 */
function getRecord($teamName) 
{
	global $db;
	global $TEAM_GAME_VIEW;
	
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

	// Retrieve results
	$result = $db -> select($query);

	// Return desired result
	return $result;
}

/**
 * Get Team Offensive Rank
 */
function getOffRank($teamName)
{
	// Declare globals	
	global $TEAM_GAME_VIEW;
	global $db;
	
	// Create SQL counter variable for finding rank
	$counter = "SELECT @idx := 0";
	$db -> query($counter);
	
	$query = "	SELECT Rank
				FROM
					(SELECT 
						@idx := @idx+1 AS Rank,
						Name
					FROM
    					(SELECT
							Name,
							((SUM(PassYds) * 0.04) + (SUM(PassTds) * 6) + (SUM(RushYds) * 0.1) + (SUM(RushTds) * 6) + (SUM(FL) * - 2) + (SUM(Ints) * - 1)) AS OffRank
						FROM ".$TEAM_GAME_VIEW."
						GROUP BY Name
						ORDER BY OffRank DESC
						) innerTbl
					) outerTbl
				WHERE outerTbl.Name = '".$teamName."'";
	
	// Retrieve results
	$rows = $db -> select($query);
	return $rows[0]['Rank'];
}


/**
 * Get Team Defensive Rank 
 */
function getDefRank($teamName)
{
	// Declare globals
	global $TEAM_GAME_VIEW;
	global $db;
	
	// Create SQL counter variable for finding rank
	$counter = "SELECT @idx := 0";
	$db -> query($counter);
			
	$query = "  SELECT Rank
				FROM
					(SELECT 
						@idx := @idx+1 AS Rank,
						Opponent
					FROM
						(SELECT
							Opponent,
							((SUM(PassYds) * 0.04) + (SUM(PassTds) * 6) + (SUM(RushYds) * 0.1) + (SUM(RushTds) * 6) + (SUM(FL) * - 2) + (SUM(Ints) * - 1)) AS OffRank
						FROM ".$TEAM_GAME_VIEW."
						GROUP BY Opponent
						ORDER BY OffRank ASC
						) innerTbl
					) outerTbl
				WHERE outerTbl.Opponent = '".$teamName."'";
 		
	// Retrieve results
	$rows = $db -> select($query);
	return $rows[0]['Rank'];
}


 /**
  * Get Team Rushing Rrank
  */
function getRushRank($teamName) 
{
	global $TEAM_GAME_VIEW;
	global $db;
	
	// Create SQL counter variable for finding rank
	$counter = "SELECT @idx := 0";
	$db -> query($counter);
	
	$query = "
				SELECT Rank
				FROM
					(SELECT 
						@idx := @idx+1 AS Rank,
						Name
					FROM
						(SELECT
							Name,
							((SUM(RushYds) * 0.1) + (SUM(RushTds) * 6) + (SUM(FL) * - 2)) AS OffRank
						FROM ".$TEAM_GAME_VIEW."
						GROUP BY Name
						ORDER BY OffRank DESC
						) innerTbl
					) outerTbl
				WHERE outerTbl.Name = '".$teamName."'";
	
	// Retrieve results
	$rows = $db -> select($query);
	return $rows[0]['Rank'];
}


/**
 * Get Team Passing Rank
 */
function getPassRank($teamName)
{
	global $TEAM_GAME_VIEW;		
	global $db;
	
	// Create SQL counter variable for finding rank
	$counter = "SELECT @idx := 0";
	$db -> query($counter);	
	
	$query = "
				SELECT Rank
				FROM
					(SELECT 
						@idx := @idx+1 AS Rank,
						Name
					FROM
						(SELECT
							Name,
							((SUM(PassYds) * 0.1) + (SUM(PassTds) * 6) + (SUM(Ints) * - 2)) AS OffRank
						FROM ".$TEAM_GAME_VIEW."
						GROUP BY Name
						ORDER BY OffRank DESC
						) innerTbl
					) outerTbl
				WHERE outerTbl.Name = '".$teamName."'";

	// Retrieve results
	$rows = $db -> select($query);
	return $rows[0]['Rank'];
}


	
/**
 * 
 */
function getYardTotals($teamName)
{
	global $DB;
	global $TEAM_GAME_VIEW;
	global $db;
	
	$query = "SELECT
  			  (
         		SELECT SUM(NetPassYds)
         		FROM ".$TEAM_GAME_VIEW." 
         		WHERE Name = '".$teamName."'
     		  ) AS PassEarned,
    			(
         			SELECT SUM(NetPassYds)
         			FROM ".$TEAM_GAME_VIEW." 
         			WHERE Opponent = '".$teamName."'
     			) AS PassAllowed,
     			(
         			SELECT SUM(RushYds)
         			FROM ".$TEAM_GAME_VIEW." 
         			WHERE Name = '".$teamName."'
     			) AS RushEarned,
     			(
         			SELECT SUM(RushYds)
         			FROM ".$TEAM_GAME_VIEW." 
         			WHERE Opponent = '".$teamName."'
     			) AS RushAllowed";
	
	$rows = $db -> select($query);
	return $rows[0];
}

/*
 * TODO: Rebuild this gross shit
 */
function getSeasonLeader($teamName, $columnArray, $orderBy, $limit)
{
	// Get global references to Database and Table
	global $DB;		
	global $OFFENSE_VIEW;
		
	// Initialize the return array
	$returnArr = array();
	
	// Start building query
	$query = "SELECT ";
	
	// First row MUST be Player Name
	$query.= $OFFENSE_VIEW .".". $columnArray[0];
	
	// If other elements in array exist, add to query
	for ($i = 1; $i < count($columnArray); $i++)
	{
		$query.=",";		
		$query.= "SUM(".$OFFENSE_VIEW .".". $columnArray[$i] .")";
	}
		
	$query.= " FROM ". $OFFENSE_VIEW;
	$query.= " INNER JOIN Players ON Players.PlayerID = ".$OFFENSE_VIEW.".PlayerID";
	$query.= " INNER JOIN Teams ON Teams.TeamID = Players.ActTeam";
	$query.= " AND Players.ActTeam = Teams.TeamID";
	$query.= " AND Teams.Name = '" .$teamName ."'";
	$query.= " GROUP BY ". $OFFENSE_VIEW .".".$columnArray[0];
	$query.= " ORDER BY SUM(". $orderBy .") DESC";
	$query.= " LIMIT ". $limit;
	
	// Query DB
	mysqli_query($DB, $query) or die('Error querying database.');
	$result = mysqli_query($DB, $query);
	
	// Fetch each row from return result into return array
	//while ($row = mysqli_fetch_array($result))
	while ($row = mysqli_fetch_row($result)) 
	{
		$returnArr[] = $row;
	}
	return $returnArr;
}

/**
 * TODO: Rebuild this gross shit
 */
function getSeasonPoints($teamName)
{
	global $DB;
	global $TEAM_GAME_VIEW;
	
	$query = "
				SELECT
					SUM(TotalScore) AS PtsFor,
					SUM(OppScore) AS PtsAgst
				FROM ".$TEAM_GAME_VIEW."
				WHERE Name = '".$teamName."'
			 ";
			 
	// Query database and store results
	mysqli_query($DB, $query) or die('Error querying database. - Yards');
	$result = mysqli_query($DB, $query);
		
	$row = mysqli_fetch_array($result);
	return $row; 
}

<?php
/*******************************************************************************
 |  Team Dashboard Model - Contains all the SQL queries used for
 |  the various charts & graphs on the team dashboard.
 |  
 | **** CONTENTS ****
 | I.    Team Record & 3rd% & TOs
 | II.   Yard/point totals & season leaders
 | III.  League Rankings
 * 
 ******************************************************************************/

Class Team_dashboard_model extends CI_Model {
    
    // Global variable for table names
    private $TEAM_GAME_VIEW = 'TeamGame2016_Summary';
    private $OFFENSE_VIEW = 'Offense2016_View';
    
    // Team name is set by controller
    public $teamName;
    
    
    public function getTheme()
    {
        $sql = "SELECT PrimaryColor, SecondaryColor, TopNavColor, TopNavText, SideNavText, LogoURL
		FROM TeamTheme
		INNER JOIN Teams ON Teams.TeamID = TeamTheme.TeamID
		AND Teams.Name = ? ";
        
        $query = $this->db->query($sql, $this->teamName);
        return $query->row();
    }
   
    public function getGameStats()
    {
        $sql = "SELECT RushYds, PassYds, RushAtt, PassAtt, PassComp, SkTaken, SkYds, Pen, PenYds, 1stDowns, 3rdM, 3rdAtt
                FROM $this->TEAM_GAME_VIEW
                WHERE Name = ? ";
        
        $query = $this->db->query($sql, $this->teamName);
        return $query->result_array();
    }
    
    
    /***************************************************
    |  I. Team Record & 3rdDown % & TOs
    ****************************************************/
    /**
     * Get team record
     * @return Array[0] w/ 2 values ['Won'] & ['Lost']
     */
    public function getRecord()
    {
        $sql = "SELECT 
                    (SELECT 
      			COUNT(Won) 
                    FROM $this->TEAM_GAME_VIEW
                    WHERE Won = 'Y'
                    AND Name = ?) AS Won,
                    (SELECT 
        		COUNT(Won)
                    FROM $this->TEAM_GAME_VIEW
                    WHERE Won = 'N'
                    AND Name = ?) AS Lost";
        
        $query = $this->db->query($sql, array($this->teamName, $this->teamName));
        return $query->row();
    }
    
    /**
     * Get team home record
     * @return Array[0] -> ['Won'], ['Home']
     */
    public function getHomeRecord()
    {
        $sql = "SELECT 
                    (SELECT COUNT(*) FROM $this->TEAM_GAME_VIEW
                        WHERE Name = ? AND Home = 'Y' AND Won = 'Y') AS Won,
                    (SELECT COUNT(*) FROM $this->TEAM_GAME_VIEW
                        WHERE Name = ? AND Home = 'Y') AS Home";
        
        $query = $this->db->query($sql, array($this->teamName, $this->teamName));
        return $query->row();
    }
    
    /**
     * Get team third downs made/attempted
     * @return Array[0] -> ['ThirdM'], ['ThirdAtt']
     */
    public function getThirdDownPercent()
    {
        $sql = "SELECT SUM(3rdM) AS ThirdM, SUM(3rdAtt) AS ThirdAtt
		FROM $this->TEAM_GAME_VIEW
		WHERE Name = ? ";
                
	$query = $this->db->query($sql, $this->teamName);
        return $query->row();
    }
    
    /**
     * Get team turnovers
     * @return Array[0] -> ['PlusFum'], ['PlusInt'], ['NegFum'], ['NegInt']
     */
    public function getTurnovers()
    {
        $sql = "SELECT plus.PlusFum AS PlusFum, plus.PlusInt AS PlusInt, n.NegFum AS NegFum, n.NegInt AS NegInt
		FROM
                    (SELECT SUM(FL) AS PlusFum, SUM(Ints) AS PlusInt
                        FROM $this->TEAM_GAME_VIEW
                        WHERE Opponent = ? ) AS plus,
                    (SELECT SUM(FL) AS NegFum, SUM(Ints) AS NegInt
			FROM TeamGame2016_Summary
    			WHERE Name = ? ) AS n";
        
        $query = $this->db->query($sql, array($this->teamName, $this->teamName));
        return $query->row();
    }
    
    
    
    /***************************************************
    |  II. Yard/point totals & season leaders
    ****************************************************/
    /**
     * Get season yard totals
     * @return Array[0] -> ['PassEarned'], ['PassAllowed'], ['RushEarned'], ['RushAllowed']
     */
    function getYardTotals()
    {
        $sql = "SELECT
                    (SELECT SUM(NetPassYds) FROM $this->TEAM_GAME_VIEW WHERE Name = ? ) AS PassEarned,
                    (SELECT SUM(NetPassYds) FROM $this->TEAM_GAME_VIEW WHERE Opponent = ? ) AS PassAllowed,
                    (SELECT SUM(RushYds) FROM $this->TEAM_GAME_VIEW WHERE Name = ? ) AS RushEarned,
                    (SELECT SUM(RushYds) FROM $this->TEAM_GAME_VIEW WHERE Opponent = ? ) AS RushAllowed";
        $query = $this->db->query($sql, array($this->teamName, $this->teamName, $this->teamName, $this->teamName));
        return $query->row();
    }
    
    /**
     * Get season point totals
     * @return Array[0] -> ['PtsFor'], ['PtsAgst']
     */
    function getPointTotals()
    {
        $sql = "SELECT 
                    SUM(TotalScore) AS PtsFor, 
                    SUM(OppScore) AS PtsAgst
		FROM $this->TEAM_GAME_VIEW
		WHERE Name = ? ";
        
        $query = $this->db->query($sql, $this->teamName);
        return $query->row();
    }
    
    /**
     * Get stats for season team leaders
     * @param Array $columnArr - String array containing names of desired DB columns
     * @param String $orderBy - String column name used in ordering table
     * @param Int $limit - Integer value to restrict limit of results
     * @return Assoc.Array result set
     */
    function getSeasonLeaders($columnArr, $orderBy, $limit)
    {	
	// Initialize the return array
	$returnArr = array();
	
        // First index MUST be player name
        $sql = "SELECT $this->OFFENSE_VIEW.$columnArr[0]";

	// Add other columns to SELECT
	for ($i = 1; $i < count($columnArr); $i++)
	{
		$sql.=",";		
		$sql.= "SUM($this->OFFENSE_VIEW.". $columnArr[$i] .")";
	}
	
        // Finish query
	$sql.= " FROM $this->OFFENSE_VIEW
                   INNER JOIN Players ON Players.PlayerID = $this->OFFENSE_VIEW.PlayerID
                   INNER JOIN Teams ON Teams.TeamID = Players.ActTeam
                   AND Teams.Name = ?
                   GROUP BY $this->OFFENSE_VIEW.PlayerID
                   ORDER BY SUM($orderBy) DESC
                   LIMIT $limit";
	
	
        $query = $this->db->query($sql, $this->teamName);
        return $query->result();
    }
    
    
    
    /***************************************************
    |   III. League Rankings 
    ****************************************************/
    /**
     * Get team offensive ranking
     * @return Array[0] -> ['OffRank']
     */
    public function getOffenseRank()
    {
        // Create SQL counter variable for finding rank
	$this->db->query('SELECT @idx := 0');
        
	$sql ="SELECT Rank AS OffRank
                 FROM
                    (SELECT @idx := @idx+1 AS Rank, Name
                    FROM
    			(SELECT Name, ((SUM(PassYds) * 0.04) + (SUM(PassTds) * 6) + (SUM(RushYds) * 0.1) + (SUM(RushTds) * 6) + (SUM(FL) * - 2) + (SUM(Ints) * - 1)) AS OffRank
			FROM $this->TEAM_GAME_VIEW
			GROUP BY Name
                	ORDER BY OffRank DESC
			) innerTbl
                    ) outerTbl
		WHERE outerTbl.Name = ? ";
        
        // Bind params and return results
        $query = $this->db->query($sql, array($this->teamName));
        return $query->row();
    }
    
    /**
     * Get team defensive ranking
     * @return Array[0] -> ['DefRank']
     */
    public function getDefenseRank()
    {
        // Create SQL counter variable for finding rank
	$this->db->query('SELECT @idx := 0');
        
        $sql = "SELECT Rank AS DefRank
		FROM
                    (SELECT @idx := @idx+1 AS Rank, Opponent
                    FROM
			(SELECT Opponent, ((SUM(PassYds) * 0.04) + (SUM(PassTds) * 6) + (SUM(RushYds) * 0.1) + (SUM(RushTds) * 6) + (SUM(FL) * - 2) + (SUM(Ints) * - 1)) AS OffRank
			FROM $this->TEAM_GAME_VIEW
			GROUP BY Opponent
			ORDER BY OffRank ASC
			) innerTbl
                    ) outerTbl
		WHERE outerTbl.Opponent = ? ";
        
        // Bind params and return results
        $query = $this->db->query($sql, array($this->teamName));
        return $query->row();
    }
    
    /**
     * Get team rushing ranking
     * @return Array[0] -> ['RushRank']
     */
    public function getRushRank()
    {
        // Create SQL counter variable for finding rank
	$this->db->query('SELECT @idx := 0');
        	
	$sql = "SELECT Rank AS RushRank FROM
                   (SELECT @idx := @idx+1 AS Rank, Name FROM
			(SELECT	Name, ((SUM(RushYds) * 0.1) + (SUM(RushTds) * 6) + (SUM(FL) * - 2)) AS OffRank
			FROM $this->TEAM_GAME_VIEW
                        GROUP BY Name
			ORDER BY OffRank DESC
			) innerTbl
                    ) outerTbl
		WHERE outerTbl.Name = ? ";
        
        // Bind params and return results
        $query = $this->db->query($sql, array($this->teamName));
        return $query->row();
    }
    
    /**
     * Get team passing ranking
     * @return Array[0] -> ['PassRank']
     */
    public function getPassRank()
    {
        // Create SQL counter variable for finding rank
	$this->db->query('SELECT @idx := 0');
	
	$sql = "SELECT Rank AS PassRank FROM
                   (SELECT @idx := @idx+1 AS Rank, Name FROM
			(SELECT	Name, ((SUM(PassYds) * 0.1) + (SUM(PassTds) * 6) + (SUM(Ints) * - 2)) AS OffRank
			FROM $this->TEAM_GAME_VIEW
			GROUP BY Name
			ORDER BY OffRank DESC
			) innerTbl
                    ) outerTbl
		WHERE outerTbl.Name = ? ";
        
        // Bind params and return results
        $query = $this->db->query($sql, array($this->teamName));
        return $query->row();
    }
    
    /**
     * Get points allowed rank 
     * @return Array[0] => ['PtsRank']
     */
    public function getPointsAllowedRank()
    {
        // Create SQL counter variable for finding rank
	$this->db->query('SELECT @idx := 0');
	
	$sql = "SELECT Rank AS PtsRank FROM
                   (SELECT @idx := @idx+1 AS Rank, Name FROM
                        (SELECT Name, SUM(OppScore) AS OppScore
			FROM $this->TEAM_GAME_VIEW
			GROUP BY TeamID
			ORDER BY OppScore ASC
                        ) innerTbl			
                    ) outerTbl
		WHERE Name = ? ";
        
        // Bind params and return results
        $query = $this->db->query($sql, array($this->teamName));
        return $query->row();
    }
    
    /**
     * Get team yards allowed rank
     * @return Array[0] -> ['YdsRank']
     */
    public function getYardsAllowedRank()
    {
       // Create SQL counter variable for finding rank
	$this->db->query('SELECT @idx := 0');
        
        $sql = "SELECT Rank AS YdsRank FROM 
                   (SELECT @idx := @idx+1 AS Rank, Opponent FROM
                        (SELECT Opponent, (SUM(NetPassYds) + SUM(RushYds)) AS Total
                        FROM $this->TEAM_GAME_VIEW
                        GROUP BY Opponent
                        ORDER BY Total ASC
			) innerTbl
                    ) outerTbl
                WHERE Opponent = ? ";
        
        // Bind params and return results
        $query = $this->db->query($sql, array($this->teamName));
        return $query->row();
    }

}
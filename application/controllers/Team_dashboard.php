<?php

class Team_dashboard extends CI_Controller {
    
    public function dashboard() {
        // Get POST team name
        $teamName = $this->input->post('team', TRUE);
        
        // Load model and set team name variable inside model
        $this->load->model('Team_dashboard_model');
        $this->Team_dashboard_model->teamName = $teamName;
              
        // Create array of league ranking values
        $rank['OffRank'] = $this->Team_dashboard_model->getOffenseRank();
        $rank['DefRank'] = $this->Team_dashboard_model->getDefenseRank();
        $rank['RushRank'] = $this->Team_dashboard_model->getRushRank();
        $rank['PassRank'] = $this->Team_dashboard_model->getPassRank();
        $rank['PtsRank'] = $this->Team_dashboard_model->getPointsAllowedRank();
        $rank['YdsRank'] = $this->Team_dashboard_model->getYardsAllowedRank();
        
        // Add items to data array and pass to view
        $data['team'] = $teamName;        
        $data['record'] = $this->Team_dashboard_model->getRecord();
        $data['homeRecord'] = $this->Team_dashboard_model->getHomeRecord();
        $data['thirdDowns'] = $this->Team_dashboard_model->getThirdDownPercent();
        $data['ranks'] = $rank; //<-- League rankings array
        $data['turnovers'] = $this->Team_dashboard_model->getTurnovers();
        $data['yardTotals'] = $this->Team_dashboard_model->getYardTotals();
        $data['pointTotals'] = $this->Team_dashboard_model->getPointTotals();
        $data['leaders'] = $this->getSeasonLeadersArr(); //<-- Local function for leaders array
        $data['theme'] = $this->Team_dashboard_model->getTheme();
        
        $data['gameStats'] = $this->Team_dashboard_model->getGameStats();
        
        // Load team dashboard view
        $this->load->view('team_dashboard_view', $data);
    }
    
    private function getSeasonLeadersArr()
    {
        // Add pass leaders to return array
        $passLead = array('Name', 'PassYds', 'PassTD', 'PassCmp', 'PassAtt');
        $result['pass'] = $this->Team_dashboard_model -> getSeasonLeaders($passLead, 'PassYds', 2);
        
        // Add rush leaders to return array
        $rushLead = array('Name', 'RushYds', 'RushTD', 'Fmb', 'RushAtt');
        $result['rush'] = $this->Team_dashboard_model -> getSeasonLeaders($rushLead, 'RushYds', 2);
        
        // Add rec leaders to return array
        $recLead = array('Name', 'RecYds', 'RecTds', 'RecTgt', 'Rec');
        $result['rec'] = $this->Team_dashboard_model -> getSeasonLeaders($recLead, 'RecYds', 4);
        
        return $result;
    }
}


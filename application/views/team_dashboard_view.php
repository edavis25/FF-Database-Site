<?php
    include_once 'header.php';
    include_once 'navigation.php';
?>
<!-- Row 1 (Team name + record) -->
<div class="row">
    <div class="container col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3" style="font-size: 100px;">
 	<div class="row team-name-title">
            <h1 ><b><?php echo $team; ?></b> <small class="hidden-xs hidden-sm">Dashboard</small></h1>	
            <h3 class="team-record"><?php echo $record->Won."-".$record->Lost ?></h3>
        </div>
    </div>
    <div class="container col-xs-6 col-sm-6 col-md-3 col-lg-2">
      	<div class="gauge" id="win-loss-gauge"></div>
    </div>
    <div class="container col-xs-6 col-sm-6 col-md-3 col-lg-2">
        <div class="gauge" id="home-win-gauge"></div>
    </div>
    <div class="container col-xs-6 col-sm-6 col-md-3 col-lg-2">
       	<div class="gauge" id="third-down-gauge"></div>
    </div>
</div> <!-- End Row 1 -->


<!-- Row 2 (League rankings) -->
<div class="row">
    <div class="panel bg-white">
	<div class="panel-heading" id="league-ranks-heading">
            <h3 class="panel-title"><i class="fa fa-fw fa-sort-amount-asc"></i> League Rankings</h3>		
	</div>
	<div class="panel-body">
            <!-- Offense Rank -->
            <div class="col-md-2 col-sm-4 col-xs-4 border-right">
		<div class="row">
                    <h1 class="ranking-value"><?php echo $ranks['OffRank']->OffRank ?></h1>
		</div>
		<div class="row">
                    <p class="ranking-label">OFF</p>
		</div>
            </div>
			
            <!-- Defense Rank -->
            <div class="col-md-2 col-sm-4 col-xs-4 border-right">
                <div class="row">
                    <h1 class="ranking-value"><?php echo $ranks['DefRank']->DefRank ?></h1>
 		</div>
		<div class="row">
                    <p class="ranking-label">DEF</p>
		</div>
            </div>
				
            <!-- Rush Rank -->
            <div class="col-md-2 col-sm-4 col-xs-4 border-right">
		<div class="row">
                    <h1 class="ranking-value"><?php echo $ranks['RushRank']->RushRank ?></h1>
                </div>
		<div class="row">
                    <p class="ranking-label">RUSH</p>
		</div>
            </div>
		
            <!-- Pass Rank -->
            <div class="col-md-2 col-sm-4 col-xs-4 border-right">
            	<div class="row">
                    <h1 class="ranking-value"><?php echo $ranks['PassRank']->PassRank ?></h1>
		</div>
		<div class="row">
                    <p class="ranking-label">PASS</p>
		</div>
            </div>
				
            <!-- Points Rank -->
            <div class="col-md-2 col-sm-4 col-xs-4 border-right">
                <div class="row">
                    <h1 class="ranking-value"><?php echo $ranks['PtsRank']->PtsRank ?></h1>
		</div>
                <div class="row">
                    <p class="ranking-label">PTs/ALL</p>
		</div>
            </div>
            
            <!-- Pass Rank -->
            <div class="col-md-2 col-sm-4 col-xs-4 border-right">
		<div class="row">
                    <h1 class="ranking-value"><?php echo $ranks['YdsRank']->YdsRank ?></h1>
		</div>
                <div class="row">
                    <p class="ranking-label">YDs/ALL</p>
           	</div>
            </div>
		
	</div> <!-- End panel body -->
    </div> <!-- End panel -->
</div> <!-- End row 2 -->


<!-- Row 3 Timelapse chart & turnovers pie -->
<div class="row" >
    <div class="col-xs-12">
        <div class="panel bg-white" >
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-line-chart fa-fw"></i> Current Season</h1>
            </div>
            <div class="panel-body">
                <div class="row">
                  
                    <div class="col-xs-12 col-sm-8 border-right">
                        <!-- TODO: ADD TIMELAPSE LINE CHART -->
                        <div id="timelapse-chart"></div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-4">
                        <div id="turnovers-pie-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Row 3 -->


<!-- Row 4 - (Pts/Yds graphs + leaders table) -->
<div class="row">
    <!-- Season Yard Totals bar graph -->
    <div class="col-md-6">
        <div class="row">
            <div class="panel bg-white">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-align-left"></i> Total Points</h3>
                </div>
                <div class="panel-body">
                    <div id="points-bar-chart"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel bg-white">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-align-left"></i> Season Yardage Totals</h3>
                </div>
                <div class="panel-body">
                    <div id="yards-bar-chart" style="height: 198px"></div>
                </div>
            </div>
        </div>

    </div>

    <!-- Offense Season Leaders -->
    <div class="col-md-6">
        <div class="panel bg-white">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Offensive Leaders</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    
                    <table class="table table-striped" id="offense-leaders-table">
                        <!-- Passing leaders -->
                        <tr><th><b>Passing</b></th><th><b>YDs</b></th><th><b>TDs</b></th><th><b>COMP</b></th><th><b>ATT</b></th></tr>
                        <?php foreach($leaders['pass'] as $row): ?>
                        <tr>
                            <?php foreach($row as $cell): ?>
                            <td><?php echo $cell; ?></td>
                            <?php endforeach; ?>                      
                        </tr>
                        <?php endforeach; ?>

                        <!-- Rushing leaders -->
                        <tr><th><b>Rushing</b></th><th><b>YDs</b></th><th><b>TDs</b></th><th><b>FUMB</b></th><th><b>ATT</b></th></tr>
                        <?php foreach($leaders['rush'] as $row): ?>
                        <tr>
                            <?php foreach($row as $cell): ?>
                            <td><?php echo $cell; ?></td>
                            <?php endforeach; ?>                      
                        </tr>
                        <?php endforeach; ?>
                       
                        <!-- Receiving leaders -->
                        <tr><th><b>Rushing</b></th><th><b>YDs</b></th><th><b>TDs</b></th><th><b>FUMB</b></th><th><b>ATT</b></th></tr>
                        <?php foreach($leaders['rec'] as $row): ?>
                        <tr>
                            <?php foreach($row as $cell): ?>
                            <td><?php echo $cell; ?></td>
                            <?php endforeach; ?>                      
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div> <!-- End row 4 -->


<!-- Highcharts CDN -->
<script src="https://code.highcharts.com/highcharts.js" defer="defer"></script>
<script src="https://code.highcharts.com/modules/exporting.js" defer="defer"></script>

<!-- Team Dashboard Display Scripts & Document Ready -->
<script>  
    
    // Set league ranking colors (before ready)
    setRankColors();
    
    // Set team color theme & logo using DB values
    var theme = <?php echo json_encode($theme); ?>;
    var baseURL = "<?php echo base_url(); ?>";
    setTeamTheme(theme, baseURL);
    
    
    // DOCUMENT READY -->
    $(document).ready(function()
    {
    	// Show gauges (delay all after load)
	setTimeout(function() { 
            // Win/Loss gauge
            var win = <?php echo $record->Won; ?>;
            var loss = <?php echo $record->Lost; ?>;
            var winLoss = (win / (win + loss)) * 100;
            showGauge(winLoss, 'win-loss-gauge', 'Win/Loss %');
           
            // Home win gauge
            var homePercent = (<?php echo $homeRecord->Won; ?> / <?php echo $homeRecord->Home; ?>) * 100;
            showGauge(homePercent, 'home-win-gauge', 'Home Win %');
			
            // 3rd down gauge
            var thirds = (<?php echo $thirdDowns->ThirdM; ?> / <?php echo $thirdDowns->ThirdAtt; ?>) * 100;
            showGauge(thirds, 'third-down-gauge', '3rd Down %'); 
	
        // Move lower?
        //}, 500);
        
        // Turnovers pie chart
        var turnovers = <?php echo json_encode($turnovers); ?>;
	showTurnoversPieChart(turnovers);
        
        // Total points bar graph
        var pointTotals = <?php echo json_encode($pointTotals); ?>;        
        showPointsBarChart(pointTotals);
        
        // Total yards bar graph
        var yardTotals = <?php echo json_encode($yardTotals); ?>;
        showYardsBarChart(yardTotals);
        
        
        var gameStats = <?php echo json_encode($gameStats); ?>;
        showTimelapseChart(gameStats);
        
        }, 250);

    });
</script>

<?php require_once 'footer.php'; ?>
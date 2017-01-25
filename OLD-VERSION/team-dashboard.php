<?php include 'resources/controllers/team-dashboard-ctrl.inc'; ?>

<!DOCTYPE html>
<html>
	<!-- Get head info -->
	<?php require_once 'resources/templates/header.php'; ?>

	<!-- Get the Navbar -->
	<?php require_once 'resources/templates/navigation.php'; ?>


	<!-- =============================================
	========== TEAM DASHBOARD CONTENT ================
	================================================== -->
	

	<!-- Row 1 (Team name + record) -->
	<div class="row">
    	<div class="container col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
    		<div class="row team-name-title">
    			<h1 ><b><?php echo teamName(); ?></b> <small class="hidden-xs hidden-sm">Dashboard</small></h1>	
        		<h3 class="team-record"><?php echo showRecord(); ?></h3>
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
						<h1 class="ranking-value"><?php echo showOffRank(); ?></h1>
					</div>
					<div class="row">
						<p class="ranking-label">OFF</p>
					</div>
				</div>
				
				<!-- Defense Rank -->
				<div class="col-md-2 col-sm-4 col-xs-4 border-right">
					<div class="row">
						<h1 class="ranking-value"><?php echo showDefRank(); ?></h1>
					</div>
					<div class="row">
						<p class="ranking-label">DEF</p>
					</div>
				</div>
				
				<!-- Rush Rank -->
				<div class="col-md-2 col-sm-4 col-xs-4 border-right">
					<div class="row">
						<h1 class="ranking-value"><?php echo showRushRank(); ?></h1>
					</div>
					<div class="row">
						<p class="ranking-label">RUSH</p>
					</div>
				</div>
				
				<!-- Pass Rank -->
				<div class="col-md-2 col-sm-4 col-xs-4 border-right">
					<div class="row">
						<h1 class="ranking-value"><?php echo showPassRank(); ?></h1>
					</div>
					<div class="row">
						<p class="ranking-label">PASS</p>
					</div>
				</div>
				
				<!-- Pass Rank -->
				<div class="col-md-2 col-sm-4 col-xs-4 border-right">
					<div class="row">
						<h1 class="ranking-value"><?php echo showPointsRank(); ?></h1>
					</div>
					<div class="row">
						<p class="ranking-label">PTs/ALL</p>
					</div>
				</div>
				
				<!-- Pass Rank -->
				<div class="col-md-2 col-sm-4 col-xs-4 border-right">
					<div class="row">
						<h1 class="ranking-value"><?php echo showYardsRank(); ?></h1>
					</div>
					<div class="row">
						<p class="ranking-label">YDs/ALL</p>
					</div>
				</div>
		
			</div> <!-- End panel body -->
		</div> <!-- End panel -->
	</div> <!-- End row 2 -->


	<!-- ####### Set colors early before document ready ####### -->
	<script>
		setRankColors();
		
		var colorArr = <?php echo getTeamTheme(); ?>;
		setTeamTheme(colorArr);
	</script>
	
	
	<!-- Row 3 -->
	<div class="row" >
		<div class="col-xs-12">
			<div class="panel bg-white" >
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-line-chart fa-fw"></i> Current Season</h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12 col-sm-8 border-right">
							<div id="timelapse-chart"></div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div id="turnovers-pie-chart"></div>
							<p>Legend</p>
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
						<div id="yards-bar-chart" style="height: 200px;"></div>
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
							<?php fillOffLeadersTbl(); ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- End row 4 -->
	
	
	<!-- Row 5 -->
	<div class="row">
		<div class="panel bg-white col-xs-12 col-md-3 col-lg-3">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-fw fa-users"></i> Average Home Attendance: <b id="atten"></b></h3>
			</div>
			<div class="panel-body">
				<div class="parent" style="width: 100%;">
					<div id="attendance-images" style="width: 75%; margin-left: auto; margin-right: auto;"></div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://code.highcharts.com/highcharts.js" defer="defer"></script>
	<script src="https://code.highcharts.com/modules/exporting.js" defer="defer"></script>
	<script src="resources/library/jquery.visible.min.js"></script>
	<!-- Call functions from the team-dashboard.js file -->
	
	<script src="js/team-turnovers-pie.js"></script>
	
	
	<!-- ####### TESTING SCRIPTS ####### -->

	<script>
		$("<style type='text/css'> .person { fill: #" + colorArr[0]['PrimaryColor'] +"; } </style>").appendTo("head");
		
		// Attendance test
		function roundNum(num) {
			var floor = Math.floor(num);
			return ((num - floor > 0.35) && (num - floor < 0.75) );
		}
		
		function numberWithCommas(num) {
    		return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}
		
		// Get and round attendance
		var attenArr = <?php echo getAttendance(); ?>;
		var index = parseFloat(attenArr[0]['Attendance'] / 10000).toFixed(1);
		
		
		// Set attendance number in panel heading
		$('#atten').html(numberWithCommas(attenArr[0]['Attendance']));
		
		// Set half-person print flag and iteration
		var halfPrint = false;
		var iterations = 0;
		
		if (roundNum(index)) {
			iterations = Math.floor(index);
			halfPrint = true;
		} 
		else {
			iterations = Math.round(index);
		}

		// Add images
		for (var i = 0; i < iterations; i++) {
			var div = document.getElementById("attendance-images");
			div.innerHTML = div.innerHTML + "<i src='img/person.svg' class='attendance-image person'></i>" ;
			if (i == iterations -1 && halfPrint)
			{
				div.innerHTML = div.innerHTML + "<i src='img/half-person.svg' class='attendance-image person'></i>" ;
			}
		}
		
		// Change person image color
   		$('.person[src$=".svg"]').each(function() {
      		var $img = jQuery(this);
        	var imgURL = $img.attr('src');
        	var attributes = $img.prop("attributes");

    	    $.get(imgURL, function(data) {
	            // Get the SVG tag, ignore the rest
            	var $svg = jQuery(data).find('svg');

            	// Remove any invalid XML tags
            	$svg = $svg.removeAttr('xmlns:a');

            	// Loop through IMG attributes and apply on SVG
            	$.each(attributes, function() {
                	$svg.attr(this.name, this.value);
            	});

            	// Replace IMG with SVG
            	$img.replaceWith($svg);
        	}, 'xml');
   		});
		
	</script>
	
	
	
	<!-- Document Ready -->
	<script>
	$(document).ready(function()
	{
		// Show gauges (delay all after load)
		setTimeout(function() { 
			// Win/Loss gauge
			var win = <?php echo getWinOrLoss('Won'); ?>;
			var loss = <?php echo getWinOrLoss('Lost'); ?>;
			var winLoss = (win / (win + loss)) * 100;
			showGauge(winLoss, 'win-loss-gauge', 'Win/Loss %');
			
			// Home win gauge
			var homeW = <?php echo getHomeWins(); ?>;
			var homePercent = (homeW[0]['Won'] / homeW[0]['Home']) * 100;
			showGauge(homePercent, 'home-win-gauge', 'Home Win %');
			
			// 3rd down gauge
			var arr3rd = <?php echo get3rdDowns(); ?>;
			var thirds = (arr3rd[0]['3rdM'] / arr3rd[0]['3rdAtt']) * 100;
			showGauge(thirds, 'third-down-gauge', '3rd Down %'); 
		
		}, 500);
		
		

		
		// Timelapse chart
		timelapseChart();
		
		
		// YDs & Points bar charts
		// Flags for done (to stop repeat animations)
		var ptsDone = false;
		var ydsDone = false;
		
		// Show bar charts when visible in viewport
		$(document).on('scroll', function()
		{
			if ($('#points-bar-chart:visible').visible( true, true ) && !ptsDone)
			{
				<?php showPointsBarChart(); ?>
				ptsDone = true;
			}
			if ($('#yards-bar-chart:visible').visible( true, true ) && !ydsDone)
			{
				<?php showYardsBarChart(); ?>
				ydsDone = true;
			}
		});
		
		// Turnovers chart
		var turnovers = <?php echo getTurnovers(); ?>;
		showTurnoversPieChart(turnovers);

	});
	</script>
	
	
	<!-- Get the footer -->
	<?php require_once 'resources/templates/footer.php'; ?>
</html>
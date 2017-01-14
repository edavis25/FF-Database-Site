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
    	<div class="col-xs-12 col-sm-5 col-md-4 col-xl-3">
    		<h1><b><?php echo teamName(); ?></b> <small>Dashboard</small></h1>	
        	<h3 class="team-record"><?php echo showRecord(); ?></h3>	
        </div>
        <div class="col-xs-12 col-sm-7 col-md-8 col-xl-9">
        	<div class="col-xs-8" id="win-loss-gauge" class="gauge"></div>
        </div>
	</div> <!-- End Row 1 -->
	
	
	


	<!-- Row 2 (League rankings) -->
	<div class="row">
		<div class="panel bg-white">
			<div class="panel-heading" id="league-ranks-heading">
				<h3 class="panel-title">League Rankings</h3>		
			</div>
			<div class="panel-body">
				
				<!-- Offense Rank -->
				<div class="col-md-2 col-sm-4 col-xs-6 border-right">
					<div class="row">
						<h1 class="ranking-value"><?php echo showOffRank(); ?></h1>
					</div>
					<div class="row">
						<p class="ranking-label">OFF</p>
					</div>
				</div>
				
				<!-- Defense Rank -->
				<div class="col-md-2 col-sm-4 col-xs-6 border-right">
					<div class="row">
						<h1 class="ranking-value"><?php echo showDefRank(); ?></h1>
					</div>
					<div class="row">
						<p class="ranking-label">DEF</p>
					</div>
				</div>
				
				<!-- Rush Rank -->
				<div class="col-md-2 col-sm-4 col-xs-6 border-right">
					<div class="row">
						<h1 class="ranking-value"><?php echo showRushRank(); ?></h1>
					</div>
					<div class="row">
						<p class="ranking-label">RUSH</p>
					</div>
				</div>
				
				<!-- Pass Rank -->
				<div class="col-md-2 col-sm-4 col-xs-6 border-right">
					<div class="row">
						<h1 class="ranking-value"><?php echo showPassRank(); ?></h1>
					</div>
					<div class="row">
						<p class="ranking-label">PASS</p>
					</div>
				</div>
				
				<!-- Pass Rank -->
				<div class="col-md-2 col-sm-4 col-xs-6 border-right">
					<div class="row">
						<h1 class="ranking-value">1</h1>
					</div>
					<div class="row">
						<p class="ranking-label">RANK</p>
					</div>
				</div>
				
				<!-- Pass Rank -->
				<div class="col-md-2 col-sm-4 col-xs-6 border-right">
					<div class="row">
						
					</div>
					<div class="row">
						<p class="ranking-label">W/L %</p>
					</div>
				</div>
		
			</div> <!-- End panel body -->
		</div> <!-- End panel -->
	</div> <!-- End row 2 -->


	<!-- Set colors early before document ready -->
	<script>
		setRankColors();
		//setPageColor("<?php echo getColor('PrimaryColor'); ?>", "<?php echo getColor('SecondaryColor'); ?>");
		//var primary = "<?php echo getColor('PrimaryColor'); ?>";
		//setPageColor(primary);
		
		var arr = <?php echo getColorArray(); ?>;
		setPageColor(arr);
	</script>
	
	
	<!-- Row 3 -->
	<div class="row">
		<div class="col-xs-12">
			<div class="panel bg-white">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Current Season</h1>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12 col-sm-8 border-right">
							<div id="timelapse-chart"></div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<p>Legend</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- End Row 3 -->
	
	<!-- Row 4 -->
	<div class="row">
		
		<!-- Season Yard Totals bar graph -->
		<div class="col-md-6">
			<div class="row">
				<div class="panel bg-white">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="glyphicon glyphicon-align-left"></i> Total Points</h3>
					</div>
					<div class="panel-body">
						<div id="points-bar-chart" style="height: 200px; margin-top: -26px; margin-bottom: -18px"></div>
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
	</div>




	<script src="https://code.highcharts.com/highcharts.js" defer="defer"></script>
	<script src="https://code.highcharts.com/modules/exporting.js" defer="defer"></script>
	<script src="resources/library/jquery.visible.min.js"></script>
	<!-- Call functions from the team-dashboard.js file -->
	
	<script>
	$(document).ready(function()
	{
		setTimeout(function() { <?php showGauge(); ?> }, 1000);
		//setRankColors();
		timelapseChart();
		
		<?php showYardsBarChart(); ?>
		<?php showPointsBarChart(); ?>
		
		var ptsDone = false;
		var ydsDone = false;
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

	});
	</script>
	
	
	<!-- Get the footer -->
	<?php require_once 'resources/templates/footer.php'; ?>
</html>
<?php
	include_once 'header.php';
	include_once 'navigation.php';
?>

<!-- TODO: MOVE THIS IMPORT SOMEWHERE ELSE -->
<script src="<?php echo base_url().'js/custom-query.js' ?>"></script>

<h3>Create a custom query</h3>
<ul class="nav nav-tabs" data-tabs="tabs">
	<li class="active">
		<a data-toggle="tab" href="#game-info">Game Info</a>
	</li>
	<li>
		<a data-toggle="tab" href="#team-stats">Team Stats</a>
	</li>
	<li>
		<a data-toggle="tab" href="#player-stats">Player Stats</a>
	</li>
</ul>

<br />

<div class="tab-content">
	<!-- Game info tab -->
	<div class="tab-pane active" id="game-info">
		<!-- Insert game query form -->
		<?php require_once 'game-query-form.php'; ?>
	</div>

	<!-- Tab 2 -->
	<div class="tab-pane" id="team-stats">
		<!-- Insert team stats query form -->
		<?php require_once 'team-query-form.php'; ?>

	</div>

	<!-- Tab 3 -->
	<div class="tab-pane" id="player-stats">
		<h1>Player Stats</h1>
		<p>
			Future home of the team stats custom query
		</p>
	</div>
	
</div> <!-- End tab content wrapper (all tabs) -->


<br />

<div id="output-panel" class="panel">
	<div class="panel-heading">
		<h3 class="inline">Query Results</h3>
		<a href="#"><img src="<?php echo base_url(); ?>img/csv-export.png" id="output-csv" /></a>
	</div>
	<div class="panel-body">
		<span id="load" style="display: none;"><img src="<?php echo base_url(); ?>img/ajax-loader-arrows.gif" /></span>
		<div id="output-table-div"></div>
	</div>
</div>


<script src="<?php echo base_url().'lib/FileSaver.js' ?>"></script>

<!-- Event handlers and ready scripts -->
<script>
	$(document).ready(function() {
		// Clear form
		clearForm('query-form');
		
		/*********************
		*   Event Handlers 
		**********************/
		// End year/week dropdown population
		$("#start-year").on("change", function() {
			populateEndBox("start-year", "end-year", "allYears", 1, true);				
		});
		
		$("#start-week").on("change", function() {
			populateEndBox("start-week", "end-week", 0, 20, false);
		});
		
		// Game query submit button
		$("#game-query-submit").on("click", function(){
			// Add a little timeout to get the arrows spinning	
			setTimeout(function() {
				runQuery('<?php echo base_url().'custom_query/display_game_results' ?>', 'game-form');
			}, 200);
		});
		
		// Team query submit button
		$("#team-query-submit").on("click", function() {
			// Add a little timeout to get the arrows spinning	
			setTimeout(function() {
				runQuery('<?php echo base_url().'custom_query/display_team_stats_results' ?>', 'team-form');
			}, 200);
		});
		
		// Clear form button
		$(".clear-form-btn").on('click', function() { 
			clearForm('query-form') 
		});
		
		// Export csv
		$("#output-csv").on('click', function() {
			var csvStr = tableAsCsv('query-results-table');
			if (csvStr) {
				//saveStringToCsvFile(csvStr, 'SS Custom Query Results');
				var blob = new Blob([csvStr], {type: "text/csv;charset=utf-8"});
				saveAs(blob, 'SS Custom Query Results.csv');
			}
						
		});
		
	
	}); // End document ready block
</script>


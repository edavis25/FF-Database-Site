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
<div class="tab-content">
	<!-- Game info tab -->
	<div class="tab-pane active" id="game-info">
		<p>Filters applied to selected teams.</p>
		<form id="game-form">
			<fieldset>
				
				<!-- Form Row 1 -->
				<div class="row">
					<!-- Team selection box -->
					<div class="form-group col-lg-3">
												
						<label for="select-team" class="control-label">Team</label>
						<select multiple="" id="select-team" name="select-team[]" class="form-control" size="5">
							<option value="%">Select ALL</option><option value="Cardinals">Arizona Cardinals</option>
							<option value="Falcons">Atlanta Falcons</option><option value="Ravens">Baltimore Ravens</option><option value="Bills">Buffalo Bills</option><option value="Panthers">Carolina Panthers</option>
							<option value="Bears">Chicago Bears</option><option value="Bengals">Cincinnati Bengals</option><option value="Browns">Cleveland Browns</option><option value="Cowboys">Dallas Cowboys</option>
							<option value="Broncos">Denver Broncos</option><option value="Lions">Detroit Lions</option><option value="Packers">Green Bay Packers</option><option value="Texans">Houston Texans</option>
							<option value="Colts">Indianapolis Colts</option><option value="Jaguars">Jacksonville Jaguars</option><option value="Chiefs">Kansas City Chiefs</option><option value="Rams">Los Angeles Rams</option>
							<option value="Dolphins">Miami Dolphins</option><option value="Vikings">Minnesota Vikings</option><option value="Patriots">New England Patriots</option><option value="Saints">New Orleans Saints</option>
							<option value="Giants">New York Giants</option><option value="Jets">New York Jets</option><option value="Raiders">Oakland Raiders</option><option value="Eagles">Philadelphia Eagles</option>
							<option value="Steelers">Pittsburgh Steelers</option><option value="Chargers">San Diego Chargers</option><option value="49ers">San Francisco 49ers</option><option value="Seahawks">Seattle Seahawks</option>
							<option value="Buccaneers">Tampa Bay Buccaneers</option><option value="Titans">Tennessee Titans</option><option value="Redskins">Washington Redskins</option>
						</select>
					</div>

					<!-- Week Select Boxes -->
					<div class="form-group col-lg-3 col-xs-6">
						<label for="start-year" class="control-label">Start Year</label>
						<select id="start-year" name="start-year" class="form-control">
							<option value="allYears">All</option>
							<option value="2016">2016</option>
							<option value="2015">2015</option>
							<option value="2014">2014</option>
							<option value="2013">2013</option>
							<option value="2012">2012</option>
							<option value="2011">2011</option>
							<option value="2010">2010</option>
							<option value="2009">2009</option>
							<option value="2008">2008</option>
							<option value="2007">2007</option>
							<option value="2006">2006</option>
							<option value="2005">2005</option>
						</select>
						<label for="end-year" class="control-label">End Year</label>
						<select id="end-year" name="end-year" class="form-control disable-on-clear" disabled>
						<!-- Options created in JavaScript function weekChange() -->
						</select>
					</div>

					<div class="form-group col-lg-3 col-xs-6">
						<label for="start-week" class="control-label">Start Week</label>
						<select id="start-week" name="start-week" class="form-control">
							<option value="0">All</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">Wildcard</option>
							<option value="19">Divison Playoff</option>
							<option value="20">Conf. Champ</option>
							<option value="21">Super Bowl</option>
						</select>
						<label for="end-week" class="control-label">End Week</label>
						<select id="end-week" name="end-week" class="form-control disable-on-clear" disabled>
							<!-- Options created in JavaScript function weekChange() -->
						</select>
					</div>

					<!-- Indoor/Outdoor Radio Buttons -->
					<div class="form-group col-lg-3 col-xs-6">
						<label class="control-label">Indoor/Outdoor</label>
						<div class="radio">
							<label>
								<input type="radio" id="roof-radio-both" name="roof-radios" value="%" checked />
								All Games </label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" id="roof-radio-y" name="roof-radios" value="Y" />
								Indoor Only </label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" id="roof-radio-n" name="roof-radios" value="N" />
								Outdoor Only </label>
						</div>
					</div>
				</div>
				<!-- End Form Row 1 -->

				<!-- Form Row 2 -->
				<div class="row">
					<div class="form-group col-lg-3 col-md-3 col-xs-6">
						<label class="control-label">Won/Lost</label>
						<div class="radio">
							<label>
								<input type="radio" id="won-radio-both" name="won-radios" value="%" checked />
								All Games </label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" id="won-radio-won" name="won-radios" value="won" />
								Games Won </label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" id="won-radio-lost" name="won-radios" value="lost" />
								Games Lost </label>
						</div>
					</div>

					<div class="form-group col-lg-3 col-md-3 col-xs-6">
						<label class="control-label">Surface Type</label>
						<div class="radio">
							<label>
								<input type="radio" id="surface-radio-both" name="surface-radios" value="%" checked />
								All Games </label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" id="surface-radio-grass" name="surface-radios" value="G" />
								Grass Only </label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" id="surface-radio-turf" name="surface-radios" value="T" />
								Turf Only </label>
						</div>
					</div>

					<div class="form-group col-lg-3 col-md-3 col-xs-6">
						<label class="control-label">Spread Covered</label>
						<div class="radio">
							<label>
								<input type="radio" id="spread-radio-both" name="spread-radios" value="%" checked />
								All Games </label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" id="spread-radio-yes" name="spread-radios" value="Y" />
								Spread Covered </label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" id="spread-radio-no" name="spread-radios" value="N" />
								Not Covered </label>
						</div>
					</div>

					<div class="form-group col-lg-3 col-md-3 col-xs-6">
						<label class="control-label">Over/Under Result</label>
						<div class="radio">
							<label>
								<input type="radio" id="overUnder-radio-both" name="overUnder-radios" value="%" checked />
								All Games </label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" id="overUnder-radio-over" name="overUnder-radios" value="O" />
								Over </label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" id="overUnder-radio-under" name="overUnder-radios" value="U" />
								Under </label>
						</div>
					</div>
				</div>
				<!-- End Form row 2 -->

				<!-- Form Row 3 -->
				<div class="row">
					<input type="button" id="game-query-submit" onclick="gameInfoQuery('<?php echo base_url().'custom_query/display_results' ?>')" name="submit-button" class="btn btn-success col-lg-3 audiowide-font submit-button" value="Run Query" />
					<input type="button" id="" name="clear-button" class="btn btn-danger col-lg-3 col-lg-offset-1 audiowide-font clear-button" value="Clear All" />
				</div>
			</fieldset>
		</form>
	</div>

	<!-- Tab 2 -->
	<div class="tab-pane" id="team-stats">
		<h1>Orange</h1>
		<p>
			orange orange orange orange orange
		</p>
	</div>

	<!-- Tab 3 -->
	<div class="tab-pane" id="player-stats">
		<h1>Yellow</h1>
		<p>
			yellow yellow yellow yellow yellow
		</p>
	</div>
</div>

<div id="output-table">
	<h1>Output</h1>
</div>

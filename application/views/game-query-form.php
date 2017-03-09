<form id="game-form" class="query-form">
	<fieldset>
		<!-- Form Row 1 -->
		<div class="row">
			<!-- Import Team selection box -->
			<div class="form-group col-lg-3">
				<?php require 'team-selectbox.html'; ?>
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
		</div><!-- End Form row 2 -->
	</fieldset>

	<!-- Form Row 3 -->
	<div class="row">
		<!-- input type="button" id="game-query-submit" onclick="gameInfoQuery('<?php echo base_url().'custom_query/display_game_results' ?>')" name="submit-button" class="btn btn-success col-lg-3 submit-button" value="Run Query" / -->
		<input type="button" id="game-query-submit" name="submit-button" class="btn btn-success col-lg-3 submit-button" value="Run Query" />
		<input type="button" name="clear-button" class="clear-form-btn btn btn-danger col-lg-3 col-lg-offset-1 audiowide-font" value="Clear All" />
	</div>
</form>


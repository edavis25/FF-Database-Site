<form id="team-form" class="query-form">
	<fieldset>
		<!-- Form Row 1 -->
		<div class="row">
			<!-- Import Team selection box -->
			<div class="form-group col-lg-3">
				<?php require 'team-selectbox.html'; ?>
			</div>
		</div>
	</fieldset>
	
	<div class="row">
		<input type="button" id="team-query-submit" name="submit-button" class="btn btn-success col-lg-3 submit-button" value="Run Query" />
		<input type="button" name="clear-button" class="clear-form-btn btn btn-danger col-lg-3 col-lg-offset-1 audiowide-font" value="Clear All" />
	</div>
</form>
<?php
	//$team = $_POST['team'];
	//include 'resources/models/db.inc';
	//include 'resources/models/team-record-ranks.inc';
	//$DB = getDB();
	include 'resources/controllers/team-dashboard-ctrl.inc';
?>

<!DOCTYPE html>
<html>
	<!-- Get head info -->
	<?php require_once 'resources/templates/header.php'; ?>

	<!-- Get the Navbar -->
	<?php require_once 'resources/templates/navigation.php'; ?>

	<!-- =============================================
	========== TEAM DASHBOARD CONTENT ================
	================================================== -->
	
	<div class="row">
    	<div class="col-lg-12">
        	<h1><b><?php echo teamName(); ?></b> <small>Dashboard</small></h1>
            <h3 class="team-record"><?php echo showRecord(); ?></h3>
        </div>
    </div>
	<h1><?php echo teamName(); ?></h1>
	
	
	<?php require_once 'resources/templates/footer.php'; ?>
</html>
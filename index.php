<!DOCTYPE html>
<html>
	<!-- Get head info -->
	<?php require_once 'resources/templates/header.php'; ?>

	<!-- Get the Navbar -->
	<?php require_once 'resources/templates/navigation.php'; ?>

	<!-- =============================================
	========== MAIN PAGE CONTENT =====================
	================================================== -->

	<?php include 'resources/models/db.inc'; ?>
	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"> Team Name <small>Dashboard</small></h1>
		</div>
	</div>
	<!-- /.row -->

	<div class="row pad-bottom-10" id="league-ranks">

		<h3 style="border-bottom: 1px solid #e7e7e7;" class="pad-left">League Rankings</h3>
		<!-- Container 1 -->
		<div class="col-md-2 col-sm-4 col-xs-6 border-right">
			<div class="row">
				<!-- h1 class="ranking-label"><b>OFF</b>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: green; font-weight: 600; font-size: 150%;">5</span></h1 -->
				<h1 class="ranking-value" style="color: green; font-family: times;">6</h1>
			</div>
			<div class="row">
				<p class="ranking-label" style="text-align: center;">
					Offense
				</p>
			</div>

		</div>

		<!-- Container 2 -->
		<div class="col-md-2 col-sm-4 col-xs-6 border-right">
			<div class="row">
				<!-- h1 class="ranking-label"><b>OFF</b>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: green; font-weight: 600; font-size: 150%;">5</span></h1 -->
				<h1 class="ranking-value" style="color: red;">23</h1>
			</div>
			<div class="row">
				<p class="ranking-label" style="text-align: center;">
					Defense
				</p>
			</div>
		</div>

		<!-- Container 3 -->
		<div class="col-md-2 col-sm-4 col-xs-6 border-right">
			<div class="row">
				<!-- h1 class="ranking-label"><b>OFF</b>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: green; font-weight: 600; font-size: 150%;">5</span></h1 -->
				<h1 class="ranking-value" style="color: #dbd700;">13</h1>
			</div>
			<div class="row">
				<p class="ranking-label" style="text-align: center;">
					Rushing
				</p>
			</div>
		</div>

		<!-- Container 4 -->
		<div class="col-md-2 col-sm-4 col-xs-6 border-right">
			<div class="row">
				<!-- h1 class="ranking-label"><b>OFF</b>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: green; font-weight: 600; font-size: 150%;">5</span></h1 -->
				<h1 class="ranking-value" style="color: green;">3</h1>
			</div>
			<div class="row">
				<p class="ranking-label" style="text-align: center;">
					Passing
				</p>
			</div>
		</div>

		<!-- Container 5 -->
		<div class="col-md-2 col-sm-4 col-xs-6 border-right">
			<div class="row">
				<!-- h1 class="ranking-label"><b>OFF</b>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: green; font-weight: 600; font-size: 150%;">5</span></h1 -->
				<h1 class="ranking-value" style="color: green;">67%</h1>
			</div>
			<div class="row">
				<p class="ranking-label" style="text-align: center;">
					Win %
				</p>
			</div>
		</div>

		<!-- Container 6 -->
		<div class="col-md-2 col-sm-4 col-xs-6">
			<div class="row">
				<!-- h1 class="ranking-label"><b>OFF</b>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: green; font-weight: 600; font-size: 150%;">5</span></h1 -->
				<h1 class="ranking-value">23</h1>
			</div>
			<div class="row">
				<p class="ranking-label" style="text-align: center;">
					Offense
				</p>
			</div>
		</div>
	</div>
	<!-- /.End top container row -->

	<div class="row v-margin-15">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Current Season</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12 col-sm-8 border-right">
							<div id="tester"></div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<p>
								This will be the key/checkboxes
							</p>
						</div>
					</div>
					<!-- div id="morris-area-chart"></div -->

				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->

	<!-- 3rd Row -->
	<div class="row">

		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-align-left"></i> Season Totals</h3>
				</div>
				<div class="panel-body">
					<div id="bar-test"></div>
					<div class="text-right">
						<a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>

					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Season Leaders</h3>
				</div>
				<div class="panel-body">
					<div class="list-group">
						<a href="#" class="list-group-item"> <span class="badge">just now</span> <i class="fa fa-fw fa-calendar"></i> Calendar updated </a>
						<a href="#" class="list-group-item"> <span class="badge">4 minutes ago</span> <i class="fa fa-fw fa-comment"></i> Commented on a post </a>
						<a href="#" class="list-group-item"> <span class="badge">23 minutes ago</span> <i class="fa fa-fw fa-truck"></i> Order 392 shipped </a>
						<a href="#" class="list-group-item"> <span class="badge">46 minutes ago</span> <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid </a>
						<a href="#" class="list-group-item"> <span class="badge">1 hour ago</span> <i class="fa fa-fw fa-user"></i> A new user has been added </a>
						<a href="#" class="list-group-item"> <span class="badge">2 hours ago</span> <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning" </a>
						<a href="#" class="list-group-item"> <span class="badge">yesterday</span> <i class="fa fa-fw fa-globe"></i> Saved the world </a>
						<a href="#" class="list-group-item"> <span class="badge">two days ago</span> <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page" </a>
					</div>
					<div class="text-right">
						<a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th>Order #</th>
									<th>Order Date</th>
									<th>Order Time</th>
									<th>Amount (USD)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>3326</td>
									<td>10/21/2013</td>
									<td>3:29 PM</td>
									<td>$321.33</td>
								</tr>
								<tr>
									<td>3325</td>
									<td>10/21/2013</td>
									<td>3:20 PM</td>
									<td>$234.34</td>
								</tr>
								<tr>
									<td>3324</td>
									<td>10/21/2013</td>
									<td>3:03 PM</td>
									<td>$724.17</td>
								</tr>
								<tr>
									<td>3323</td>
									<td>10/21/2013</td>
									<td>3:00 PM</td>
									<td>$23.71</td>
								</tr>
								<tr>
									<td>3322</td>
									<td>10/21/2013</td>
									<td>2:49 PM</td>
									<td>$8345.23</td>
								</tr>
								<tr>
									<td>3321</td>
									<td>10/21/2013</td>
									<td>2:23 PM</td>
									<td>$245.12</td>
								</tr>
								<tr>
									<td>3320</td>
									<td>10/21/2013</td>
									<td>2:15 PM</td>
									<td>$5663.54</td>
								</tr>
								<tr>
									<td>3319</td>
									<td>10/21/2013</td>
									<td>2:13 PM</td>
									<td>$943.45</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="text-right">
						<a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->

	<!-- Set active tab -->
	<script>
		$("#home").css('background-color', '#e7e7e7', '!important');
		
		// Change the color of the <li> container class - the anchor tag text inherits this color
		//var active = document.getElementsByClassName("active-container");
		//$(active[0]).css('color', '#337ab7', '!important');
	</script>
	
	<?php
	require_once 'resources/templates/footer.php';
 ?>
</html>

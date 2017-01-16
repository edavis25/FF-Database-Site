<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	
	<!-- Logo and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>	
		
		<!-- Logo and title (also team images for dashboard)-->
		<a class="navbar-brand" href="index.php" id="logo"><b><i>Saber-skeptics</i></b></a>
		<img src="" class="img" id="team-logo" />
		
	</div>
	
	<!-- Top Navbar Menu Items -->
	<ul class="nav navbar-right top-nav">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
			
			<!-- Top right navbar message icon dropdown menu --> 
			<ul class="dropdown-menu message-dropdown">
				<li class="message-preview">
					<a href="#">
						<div class="media">
							<span class="pull-left"> <img class="media-object" src="http://placehold.it/50x50" alt=""> </span>
							<div class="media-body">
								<h5 class="media-heading"><strong>John Smith</strong></h5>
								<p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
								<p>Lorem ipsum dolor sit amet, consectetur...</p>
							</div>
						</div> 
					</a>
				</li>
				<li class="message-preview">
					<a href="#">
						<div class="media">
							<span class="pull-left"> <img class="media-object" src="http://placehold.it/50x50" alt=""> </span>
							<div class="media-body">
								<h5 class="media-heading"><strong>John Smith</strong></h5>
								<p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
								<p>Lorem ipsum dolor sit amet, consectetur...</p>
							</div>
						</div> 
					</a>
				</li>
				<li class="message-preview">
					<a href="#">
						<div class="media">
							<span class="pull-left"> <img class="media-object" src="http://placehold.it/50x50" alt=""> </span>
							<div class="media-body">
								<h5 class="media-heading"><strong>John Smith</strong></h5>
								<p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
								<p>Lorem ipsum dolor sit amet, consectetur...</p>
							</div>
						</div>
					 </a>
				</li>
				<li class="message-footer"><a href="#">Read All New Messages</a></li>
			</ul>
		</li> <!-- End message icon dropdown menu -->
		
		<!-- Top right navbar alert (bell) icon dropdown menu -->
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
			<ul class="dropdown-menu alert-dropdown">
				<li><a href="#">Alert Name <span class="label label-default">Alert Badge</span></a></li>
				<li><a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a></li>
				<li><a href="#">Alert Name <span class="label label-success">Alert Badge</span></a></li>
				<li><a href="#">Alert Name <span class="label label-info">Alert Badge</span></a></li>
				<li><a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a></li>
				<li><a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a></li>
				<li class="divider"></li>
				<li><a href="#">View All</a></li>
			</ul>
		</li>
		
		<!-- Top right navbar username dropdown menu -->
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="#"><i class="fa fa-fw fa-user"></i> Profile</a></li>
				<li><a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a></li>
				<li><a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a></li>
				<li class="divider"></li>
				<li><a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a></li>
			</ul>
		</li>
	</ul> <!-- End top right navbar icon menus -->
	
	
	<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav side-nav bg-swap">
			
			<li class="active-container">
				<a href="index.php" id="home"><i class="fa fa-fw fa-home"></i> Home</a></li>
			
			<li class="active-container">
				<a href="#" data-toggle="collapse" data-target="#team-links" id="dashboard"><i class="fa fa-fw fa-dashboard"></i> Team Dashboards <i class="fa fa-fw fa-caret-down"></i></a>
				<!-- Team dashboard collapsable menu -->
				<div class="collapse" id="team-links">
					
					<!-- Form to post team name data to the server -->
					<form method="post" action="team-dashboard.php">
						<table id="team-table" class="table table-stripes table-hover">
							<tbody>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Cardinals">Arizona Cardinals</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Falcons">Atlanta Falcons</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Ravens">Baltimore Ravens</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Bills">Buffalo Bills</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Panthers">Carolina Panthers</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Bears">Chicago Bears</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Bengals">Cincinnati Bengals</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Browns">Cleveland Browns</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Cowboys">Dallas Cowboys</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Broncos">Denver Broncos</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Lions">Detroit Lions</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Packers">Green Bay Packers</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Texans">Houston Texans</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Colts">Indianapolis Colts</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Jaguars">Jacksonville Jaguars</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Chiefs">Kansas City Chiefs</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Rams">Los Angeles Rams</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Dolphins">Miami Dolphins</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Vikings">Minnesota Vikings</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Patriots">New England Patriots</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Saints">New Orleans Saints</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Giants">New York Giants</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Jets">New York Jets</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Raiders">Oakland Raiders</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Eagles">Philadelphia Eagles</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Steelers">Pittsburgh Steelers</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Chargers">San Diego Chargers</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="49ers">San Francisco 49ers</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Seahawks">Seattle Seahawks</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Buccaneers">Tampa Bay Buccaneers</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Titans">Tennessee Titans</button></td>
								</tr>
								<tr>
									<td><button type="submit" class="team-link" name="team" value="Redskins">Washington Redskins</button></td>
								</tr>
							</tbody>
						</table>
					</form> 
				</div>
			</li> <!-- End team dashboard link -->
			
			<li class="active-container">
				<a href="charts.html"><i class="fa fa-fw fa-users"></i> Player Search</a>
			</li>
			
			<li class="active-container">
				<a href="tables.html"><i class="fa fa-fw fa-sort-amount-desc"></i> League Leaders</a>
			</li>
			
			<li class="active-container">
				<a href="forms.html"><i class="fa fa-fw fa-history"></i> Historical Trends</a>
			</li>
			
			<li class="active-container">
				<a href="bootstrap-elements.html"><i class="fa fa-fw fa-database"></i> Custom Query</a>
			</li>
			
			<li class="active-container">
				<a href="bootstrap-grid.html"><i class="fa fa-fw fa-info-circle"></i> About the Project</a>
			</li>
			
			<li class="active-container">
				<a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Contact</a>
				
			</li>
			
			<li class="active-container">
				<a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
			</li>
		</ul>
	</div>
	<!-- /.navbar-collapse -->
</nav>

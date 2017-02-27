<?php
    include_once 'header.php';
    include_once 'navigation.php';
?>


<!-- =============================================
========== MAIN PAGE CONTENT =====================
================================================== -->

<!-- Page Heading -->
<div class="row">
    <div class="jumbotron">
        <h1 class="page-header"> <b><i>Saber<span style="color:#0F0064;">skeptics</span></i></b></h1>
        <p id="site-subtitle" class="text-muted">10 years of NFL statistics, analysis, visualizations, &amp; projections.</p>
    </div>
</div>
<!-- /.row -->

<div class="row">
    
    
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Slide Number Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">

			<!-- Slide 1 -->
			<div class="item active">
				<!-- h3 style="text-align: center;">Dynamic Team Dashboards</h3 -->
				<!-- h1 style="position: absolute; background-color: rgba(0,0,0,0.8); color: white; margin-left: 20%; float: bottom;">Team Dashboards</h1 -->
				<img src="img/dashboard-wide1.png" alt="" style="height: 470px; margin-left: auto; margin-right: auto;" />
				<div style="position: absolute; width: 75%; left: 12.5%; background-color: rgba(10,0,68, 1); color: white; bottom: 30px;">
					<h3 style="text-align: center"><b>Team Dashboards</b></h3>
					<div style="color: white; text-align: center;">
						&bull; Detailed Season Rankings &amp; Statistics<br />
						&bull; Dynamically Generated Interactive Visualizations &amp; Charts<br /><br />
					</div>
				</div>
			</div>
			<!-- Slide 2 -->
			<div class="item">
				<img src="img/dashboard-500.png" alt=""/>
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
	</div>

    
    
    
    <div class="container col-sm-6 col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <i class="fa fa-info" aria-hidden="true"></i> <b>About the Project</b>
            </div>
            <div class="panel-body">
                <p>
                	The Saberskeptics relational database contains nearly 150,000 rows of detailed NFL statistics from the past 10 years. Harvested using custom-built Selenium web scrapers, the database contains
                	complete player and team statistics organized by game performance. 
                </p>
                <br />
                <ul>
                	<li>For more info on the project, check out the <a href="">about page</a></li>
					<li>For more info on the database, check out the <a href="">schema</a></li>
                </ul>
                <a href="https://github.com/edavis25/Fantasy-Football-Database"><i class="fa fa-github fa-2x"></i> All your stars are belong to us!</a>
                <br />
                <br />
                <small><b>Disclaimer:</b> The Saberskeptics project is purely nonprofit and for educational purposes only! (Please don't sue us Mr. Goodell)</small>
            </div>
        </div>
    </div>
    <div class="container col-sm-6 col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <i class="fa fa-fw fa-dashboard"></i> <b>Dynamic Team Dashboards</b>
            </div>
            <div class="panel-body">
                <p>Dynamically generated, interactive dashboards to visualize your favorite team's season performance!</p>
                <img src="img/dashboard-500.png" class="img img-responsive" style="height: 210px; margin-left: auto; margin-right: auto; "/>
            </div>
        </div>
    </div>
    
    
    <div class="container col-sm-6 col-md-4">
        <div class="panel">
            <div class="panel-heading">
                Panel 3 Header
            </div>
            <div class="panel-body">
                Panel 3
            </div>
        </div>
    </div>
</div>



<!-- Set active tab -->
<script>
    $("#home").css('background-color', '#e7e7e7', '!important');

    // Change the color of the <li> container class - the anchor tag text inherits this color
    //var active = document.getElementsByClassName("active-container");
    //$(active[0]).css('color', '#337ab7', '!important');
</script>

<?php require_once 'footer.php'; ?>


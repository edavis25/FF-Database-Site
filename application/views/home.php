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
        <p id="site-subtitle" class="text-muted">10 years of NFL player, team, and game statistics.</p>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="container col-xs-4">
        <div class="panel">
            <div class="panel-heading">
                Panel 1 Header
            </div>
            <div class="panel-body">
                Panel 1
            </div>
        </div>
    </div>
    <div class="container col-xs-4">
        <div class="panel">
            <div class="panel-heading">
                Panel 2 Header
            </div>
            <div class="panel-body">
                Panel 2
            </div>
        </div>
    </div>
    <div class="container col-xs-4">
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


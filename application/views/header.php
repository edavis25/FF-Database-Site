<?php
    if(isset($_POST['team']))
    {
	$title = $_POST['team']. " Dashboard";
    }
    else 
    {
	$title = "Saber-skeptics";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap Core CSS 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!-- Theme CSS -->
    <link href="<?php echo base_url().'/css/sb-admin.css' ?>" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"> 
    
    <!-- Custom CSS -->
    <link href="<?php echo base_url().'css/ffdatabase.css'?>" rel="stylesheet">
    
    <!-- jQuery 3.1.1 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    <!-- Bootstrap 3.3.7 JavaScript-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" defer="defer"></script>
    
    <!-- Plotly -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js" defer="defer"></script>


    <!-- Just Gauge -->
    <script src="<?php echo base_url().'lib/just-gauge/justgage-1.2.2/raphael-2.1.4.min.js' ?>"></script>
    <script src="<?php echo base_url().'lib/just-gauge/justgage-1.2.2/justgage.js' ?>"></script>

    <!-- Custom Javascript-->
    <script src="<?php echo base_url().'js/team-dashboard.js'?>"></script>
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="wrapper">
    	<div id="page-wrapper">
            <div class="container-fluid">
            <!-- These wrappers are ended in the footer.php file -->
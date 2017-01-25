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
    <link href="css/sb-admin.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="resources/library/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"> 
    
    <!-- Custom CSS -->
    <link href="css/ffdatabase.css" rel="stylesheet">
    <!-- link href="css/ffdatabase-alt.css" rel="stylesheet" -->

    
    <!-- jQuery 3.1.1 -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    <!-- Bootstrap 3.3.7 JavaScript-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" defer="defer"></script>
    
	<!-- Plotly -->
	<script src="https://cdn.plot.ly/plotly-latest.min.js" defer="defer"></script>

	<!-- Custom -->
	<script src="js/team-dashboard.js"></script>
	
	<script src="resources/library/just-gauge/justgage-1.2.2/raphael-2.1.4.min.js"></script>
	<script src="resources/library/just-gauge/justgage-1.2.2/justgage.js"></script>
	
	

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
<!--  InfoTechServices System

      Programmer: 
        Dalmo, Manilyn

-->

<!--  client/ index page  -->

<?php

//start session
session_start();

//check if user is not logged in
if(!isset($_SESSION["username"]) && !isset($_SESSION["useraccount_id"]) && !isset($_SESSION["usertype"]) && !isset($_SESSION["dept_id"])){

	//redirect to login page
  	header ('location: ../login.php');
}else{

	if($_SESSION['usertype'] !== 'department'){

		//redirect to login page
  		header ('location: ../login.php');
  	 	}
}

?>

<!DOCTYPE html>

<html class="h-100 w-100">

<head>

    <!-- Meta Tag to Set Page's Width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  Title Page  -->
    <title>PGO IT Services - Client Page</title>

    <!--  Link Bootstrap stylesheet -->
    <link href="../plug-ins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--  Link sidebar stylesheet  -->
    <link href="../css/simple-sidebar.css" rel="stylesheet">

    <!-- Font Awesome Icons Stylesheet -->
  	<link href="../plug-ins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
  	<script src="../plug-ins/jquery/jquery.min.js"></script>
  	<script src="../plug-ins/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>

<body class="h-100 w-100">

	    <!-- Page Content -->
	    <div class="h-100 w-100">


	    		<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-success">

			        <div class="collapse navbar-collapse" id="navbarSupportedContent">
			          	<ul class="navbar-nav ml-auto">
				            <li class="nav-item active">
				              	<a class="nav-link text-dark font-weight-bold" href="index.php">INFO TECH SERVICES</a>
				            </li>
			          	</ul>
			        </div>

			        <div class="collapse navbar-collapse" id="navbarSupportedContent">

			          	<ul class="navbar-nav ml-auto mt-2 mt-lg-0">

				            <li class="nav-item">
				              	<a class="nav-link text-dark font-weight-bold disabled" ><?php echo $_SESSION['username']; ?></a>
				            </li>
				            <li class="nav-item">
				              	<a class="nav-link text-dark " href="../logout.php" data-toggle="tooltip" title="Logout" ><i class="fa fa-sign-out" aria-hidden="true"></i></a>
				            </li>

			          	</ul>
			        </div>

			    </nav>
	    		
	    		<div class="container-fluid h-100" style="margin-top: 80px;">

			    	<div class="row">
			    		<p class="h3 mx-auto"> Welcome Information Technology Services Request Page, <?php echo $_SESSION['username']; ?>  !</p>
			    	</div>

			    	<hr class="border border-bottom border-success">
			    	
			    	<div class="row h-100">
			    		<div class="mx-auto row ">
				    		<div class="col-lg-6" >
				    			<button type="button" style="height: 300px; width: 300px; font-size: 200px;" class="btn btn-success" id="request" data-toggle="tooltip" title="Request" ><i class="fa fa-phone-square" aria-hidden="true" ></i> </button>
				    		</div>
				    		<div class="col-lg-6">
				               	<button type="button" style="height: 300px; width: 300px;  font-size: 200px;" class="btn btn-success" id="track" data-toggle="tooltip" title="Track Requests"><i class="fa fa-eye" aria-hidden="true" ></i></button>
				            </div>
				        </div>
			        </div>
		    		
				</div>	    
		    	<!--/# Container -->

	   	</div>
	    <!-- /# Page Content -->  	

</body>

</html>

<script>

	$('#request').click(function(e){
	 	e.preventDefault();

	 	var url = "../forms/incomingrequest-addingform.php";

	 	(window).open(url);
	});

	$('#track').click(function(e){
	 	e.preventDefault();

	 	var url = "../client/sent-requests.php";

	 	(window).open(url);
	});

</script>
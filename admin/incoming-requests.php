<!--  InfoTechServices System

      Programmer: 
        Dalmo, Manilyn

-->

<!--  admin/ request page  -->

<?php

//start session
session_start();

//check if user is not logged in
if (!isset($_SESSION["username"]) && !isset($_SESSION['usertype'])) {

	//redirect to login page
	header('location: ../login.php');
} else {
	if ($_SESSION['usertype'] !== 'admin') {
		if ($_SESSION['usertype'] !== 'personnel') {
			if ($_SESSION['usertype'] !== 'programmer') {
				//redirect to login page
				header('location: ../login.php');
			}
		}
	}
}

//include database connection
require_once('../config/db_connection.php');

//include file containing queries
include_once "../config/controllers/controller.php";

//instantiate Controller
$control = new Controller();

$hardwarecomponents = $control->getHardwareComponents();

$requests = $control->getRequest();

$depts = $control->getDepartment();

?>

<!DOCTYPE html>

<html class="h-100 w-100">

<head>

	<!-- Meta Tag to Set Page's Width -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--  Title Page  -->
	<title>PGO IT Services - Admin Page</title>

	<!--  Link Bootstrap stylesheet -->
	<link href="../plug-ins/bootstrap/css/bootstrap.min.css" rel="stylesheet">


	<!-- Font Awesome Icons Stylesheet -->
	<link href="../plug-ins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!--  Link sidebar stylesheet  -->
	<link href="../css/simple-sidebar.css" rel="stylesheet">

	<!-- Bootstrap core JavaScript -->
	<script src="../plug-ins/jquery/jquery.min.js"></script>
	<script src="../plug-ins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Jquery Redirect JavaScript -->
	<script src="../plug-ins/jquery/jquery.redirect.js"></script>

</head>

<body class="h-100 w-100">

	<!-- /# Wrapper -->
	<div class="d-flex" id="wrapper">

		<!-- Sidebar -->
		<div class="bg-secondary border-right mt-5 pt-2" id="sidebar-wrapper">
			<div class="list-group list-group-flush">
				<a href="incoming-requests.php" class="list-group-item list-group-item-action bg-secondary text-light border-bottom"><i class="fa fa-bell" aria-hidden="true"></i> Incoming Requests</a>
				<a href="incoming-repairs.php" class="list-group-item list-group-item-action bg-secondary text-light border-bottom"><i class="fa fa-wrench" aria-hidden="true"></i> Incoming Repairs</a>

				<!-- <a href="#reportsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-secondary text-light"><i class="fa fa-file" aria-hidden="true"></i> Reports </a>
	        <ul class="collapse list-unstyled" id="reportsSubmenu">
	          <li><a href="completed-requests.php" class="list-group-item list-group-item-action text-white border-bottom" style="background-color: #adb5bd">Completed Requests</a></li>
	          <li><a href="completed-repairs.php" class="list-group-item list-group-item-action text-white" style="background-color: #adb5bd">Completed Repairs</a></li>
	        </ul> -->

				<?php if ($_SESSION['usertype'] === 'admin' || $_SESSION['usertype'] === 'programmer') :	?>
					<a href="#settingsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-secondary text-light"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
					<ul class="collapse list-unstyled" id="settingsSubmenu">
						<li><a href="settings/user-accounts.php" class="list-group-item list-group-item-action text-white border-bottom" style="background-color: #adb5bd">User Accounts</a></li>
						<li><a href="settings/employees.php" class="list-group-item list-group-item-action text-white border-bottom" style="background-color: #adb5bd">Employees</a></li>
						<li><a href="settings/departments.php" class="list-group-item list-group-item-action text-white border-bottom" style="background-color: #adb5bd">Departments</a></li>
						<li><a href="settings/hardware-components.php" class="list-group-item list-group-item-action text-white" style="background-color: #adb5bd">Hardware Components</a></li>
					</ul>
				<?php endif; ?>
			</div>

		</div>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div class="h-100 w-100">
			<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">

				<button class="btn btn-primary" id="menu-toggle" data-toggle="tooltip" title="Toggle Sidebar"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link text-primary font-weight-bold" href="incoming-requests.php">INFO TECH SERVICES</a>
						</li>
					</ul>
				</div>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
						<li class="nav-item">
							<a class="nav-link text-primary font-weight-bold disabled"><?= $_SESSION['username']; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-primary " href="../logout.php" data-toggle="tooltip" title="Logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
						</li>
					</ul>
				</div>

			</nav>

			<div class="container-fluid h-100" style="margin-top: 80px;">

				<div class="row">
					<p class="h3 mx-auto"><i class="fa fa-bell-o" aria-hidden="true"></i> Incoming Requests </p>
				</div>

				<hr class="border border-bottom border-primary">

				<div class="row">
					<div class="col-lg-3">
						<input type="text" class="form-control " id="search" placeholder="Search">
					</div>
					<div class="mr-3 ml-auto">
						<button type="button" class="btn btn-primary" data-toggle="tooltip" title="Download Summary in MSword" id="printSummary"><i class="fa fa-download" aria-hidden="true"></i></button>
					</div>
				</div>

			</div>
			<!--/# Container -->

			<!-- Modal View -->
			<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<!--  View Modal  -->
						<div id="view-form">
							<div class="modal-header text-light bg-primary">
								<div class="container-fluid text-center">
									<p class="h5 modal-title" id="exampleModalLabel">VIEW REQUEST DETAILS</p>
								</div>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div id="view-table" class="modal-body">

								<form>

									<div class="container-fluid form-row">
										<div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
											<label> Status: </label> <br>
											<label> Date&Time of Request: </label> <br>
											<label> Requestee: </label> <br>
											<label> Concern: </label> <br>

											<div id="other-labels">
											</div>
										</div>
										<div class="form-group col-lg-7 col-md-7 col-sm-12 col-xs-12" id="data">
										</div>
									</div>

								</form>

							</div>

							<div class="modal-footer text-light bg-primary" id="footer-buttons" style="margin-bottom: 0">
								<button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Close</button>
							</div>
						</div>
						<!-- /#View Modal -->

					</div>
				</div>
			</div>
			<!-- /# Modal  -->

			<!-- Modal Pullout / Done -->
			<div class="modal fade" id="modalPulloutDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<!--  Pullout Modal  -->
						<div id="pullout-done-form">

							<?php include_once('../forms/pullout_done-form.php');	?>

						</div>
						<!-- /#Pullout Modal -->

					</div>
				</div>
			</div>
			<!-- /# Modal  -->

			<!-- Modal Print -->
			<div class="modal fade" id="modalPrint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<!--  Print Modal  -->
						<div id="printSorting-form">

							<?php
							include_once('../forms/printSorting-form.php');
							?>

						</div>
						<!-- /#Print Modal -->
					</div>
				</div>
			</div>
			<!-- /# Modal  -->

			<!-- Table Container -->
			<div id="incoming-requests" class="container-fluid mt-2">
				<!-- Incoming Requests Table -->
				<?php include_once('../tables/incomingrequest-tbl.php'); ?>
				<!-- /# Incoming Requests Table -->
			</div>
			<!--/#Table Container-->

		</div>
		<!-- /# Page Content -->

	</div>
	<!-- /# Wrapper -->

</body>

</html>

<script>
	/* Menu Toggle Script */
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

	$("#search").on("keyup", function() {
		var search_text = $(this).val().toLowerCase();
		$("#table_body tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(search_text) > -1)
		});
	});

	$('input[name="sort"]').change(function(e) {
		if ($('input[name="sort"]:checked').val() === 'department') {
			$('#dept_selection').show();
		} else {
			$('#dept_selection').hide();
		}
	});

	$('#printSummary').click(function(e) {
		e.preventDefault();

		$('#modalPrint').modal('toggle');

	});

	$('#printSorting-form').submit(function(e) {
		e.preventDefault();

		var action = "RequestSummaryReport";
		var sort = $('input[name="sort"]:checked').val();
		var dept_id = $('#dept_id').val();
		var day = $('#day').val();

		if (sort === 'all') {
			var url = "downloadables/excel-all.php";
		} else if (sort === 'department') {
			var url = "downloadables/excel-dept.php";
		} else if (sort === 'day') {
			var url = "downloadables/excel-date.php";
		}

		$.redirect(url, {
			action: action,
			dept_id: dept_id,
			day: day
		});
		$('#modalPrint').modal('toggle');

	});

	//View Request Details Script
	$(".view").click(function(e) {
		e.preventDefault();
		var action = 'getRequest';
		var itsrequest_id = $(this).attr('id');

		$.ajax({
			url: "../config/processors/requestArguments.php",
			type: "post",
			data: {
				action: action,
				itsrequest_id: itsrequest_id
			},
			dataType: 'JSON',
		}).done(function(request) {
			$('#modalView').modal('toggle');
			if (request.status === 'received') {
				$('#data').append('<label class="font-weight-bold text-info">' + request.status + '</label><br>');
			} else if (request.status === 'pending') {
				$('#data').append('<label class="font-weight-bold text-success">' + request.status + '</label><br>');
			} else if (request.status === 'done') {
				$('#data').append('<label class="font-weight-bold text-secondary">' + request.status + '</label><br>');
			}

			$('#data').append('<label class="font-weight-bold">' + request.itsrequest_date + '</label><br>');
			$('#data').append('<label class="font-weight-bold">' + request.dept_code + '|' + request.emp_fname + ' ' + request.emp_lname + '</label><br>');
			$('#data').append('<label class="font-weight-bold">' + request.concern + '</label><br>');

			if (request.itsrequest_category == 'hw') {
				$('#other-labels').append('<label> Repair Location: </label> <br>');
				$('#data').append('<label class="font-weight-bold">' + request.itshw_category + '</label><br>')
				$('#other-labels').append('<label> Hardware: </label> <br>');
				$('#data').append('<label class="font-weight-bold">' + request.hwcomponent_name + '</label><br>')

				if (request.itshw_category == 'pulled-out' || request.itshw_category == 'walk-in') {
					;
					$('#other-labels').append('<label> Property Number: </label> <br>');
					$('#data').append('<label class="font-weight-bold">' + request.property_num + '</label><br>');
				}
			}
		});


		$('#modalView').modal({
			backdrop: 'static',
			keyboard: false
		});
	});

	$('.done').click(function(e) {
		e.preventDefault();
		var itsrequest_id = $(this).attr('id');
		var statusupdate_useraccount_id = $(this).attr('data-id');

		$('#itsrequest_id').append('<input type="hidden" class="form-control" name="itsrequest_id" id="itsrequest_id" value=' + itsrequest_id + '>');
		$('#statusupdate_useraccount_id').append('<input type="hidden" class="form-control" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value=' + statusupdate_useraccount_id + '>');
		$('#input_field').append('<label for="solution">Solution:</label><textarea class="form-control" name="solution" id="solution"></textarea>');

		$('#modalPulloutDone').modal({
			backdrop: 'static',
			keyboard: false
		});
	});

	$('.pullout').click(function(e) {
		e.preventDefault();
		var itsrequest_id = $(this).attr('id');
		var hwcomponent_id = $(this).attr('hw-id');
		var statusupdate_useraccount_id = $(this).attr('data-id');

		$('#action').val('categoryPulloutRequest');
		$('.modal-title').text('Hardware Pullout Form');
		$('#itsrequest_id').append('<input type="hidden" class="form-control" name="itsrequest_id" id="itsrequest_id" value=' + itsrequest_id + '>');
		$('#statusupdate_useraccount_id').append('<input type="hidden" class="form-control" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value=' + statusupdate_useraccount_id + '>');
		$('#hwcomponent_select').show();
		$('#hwcomponent_id').val(hwcomponent_id);
		$('#input_field').append('<input type="text" class="form-control" name="property_num" id="property_num" placeholder="Property Number"/>');
		$('#submit_btn').text('Pullout');
		$('#modalPulloutDone').modal({
			backdrop: 'static',
			keyboard: false
		});
	});

	$('#pullout_done-form').submit(function(e) {
		e.preventDefault();

		$.ajax({
			url: "../config/processors/requestArguments.php",
			type: "POST",
			data: $(this).serialize(),
		}).done(function(val) {
			alert(val);
			window.location.replace('./incoming-repairs.php');
		});

	});

	$('.pending').click(function(e) {
		e.preventDefault();
		var action = 'statusPending';
		var itsrequest_id = $(this).attr('id');
		var statusupdate_useraccount_id = $(this).attr('data-id');

		$.ajax({
			url: "../config/processors/requestArguments.php",
			type: "post",
			data: {
				action: action,
				itsrequest_id: itsrequest_id,
				statusupdate_useraccount_id: statusupdate_useraccount_id
			},
		}).done(function(val) {
			alert(val);
			location.reload(true);
		});
	});

	$('.close').click(function() {
		location.reload(true);
	});

	$('.cancel').click(function() {
		location.reload(true);
	});
</script>
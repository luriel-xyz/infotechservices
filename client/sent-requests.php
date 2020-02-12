<!--  InfoTechServices System

      Programmer: 
        Dalmo, Manilyn

-->

<!--  client/ index page  -->

<?php

//start session
session_start();

//check if user is not logged in
if (!isset($_SESSION["username"]) && !isset($_SESSION['usertype']) && !isset($_SESSION['dept_id'])) {

	//redirect to login page
	header('location: ../login.php');
}

//include database connection
require_once('../config/db_connection.php');

//include file containing queries
include_once "../config/controllers/controller.php";

//instantiate Controller
$control = new Controller();

$requests = $control->getRequestByDepartment($_SESSION['dept_id']);
$requestCount = $control->getTotalRequests($_SESSION['emp_id']);
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

		<div class="container-fluid h-100">

			<div class="row">
				<p class="h1 mx-auto"> <?= $_SESSION['username'] ?> </p>
			</div>

			<div class="row">
				<div class="col-2">
					<button class="btn" onclick="window.close()"><i class="fa fa-arrow-left fa-fw"></i> Go back</button>
				</div>
				<div class="col-6 offset-3">
					<p class="h3 mx-auto">Sent Requests <?= $requestCount ?> </p>
				</div>
			</div>
			<!-- <div class="row">
			    	</div> -->

			<hr class="border border-bottom border-success">

			<div class="col-lg-3">
				<input type="text" class="form-control " id="search" placeholder="Search by name">
			</div>

			<!-- Table Container -->
			<div class="container-fluid mt-2">
				<?php
				include_once('../tables/sentrequests-tbl.php');
				?>
			</div>
			<!--/#Table Container-->

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

	</div>
	<!-- /# Page Content -->

</body>

</html>

<script type="text/javascript">
	$(() => {
		$("#search").on("keyup", function() {
			var search_text = $(this).val().toLowerCase();
			$("#table_body tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(search_text) > -1)
			});
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
			}).done(function(data) {
				$.each(data, function(index, value) {
					$('#modalView').modal('toggle');
					if (value.status === 'received') {
						$('#data').append('<label class="font-weight-bold text-info">' + value.status + '</label><br>');
					} else if (value.status === 'pending') {
						$('#data').append('<label class="font-weight-bold text-warning">' + value.status + '</label><br>');
					} else {
						$('#data').append('<label class="font-weight-bold text-success">' + value.status + '</label><br>');
					}

					$('#data').append('<label class="font-weight-bold">' + value.itsrequest_date + '</label><br>');
					$('#data').append('<label class="font-weight-bold">' + value.dept_code + '|' + value.emp_fname + ' ' + value.emp_lname + '</label><br>');
					$('#data').append('<label class="font-weight-bold">' + value.concern + '</label><br>');

					if (value.itsrequest_category == 'hw') {
						$('#other-labels').append('<label> Repair Location: </label> <br>');
						$('#data').append('<label class="font-weight-bold">' + value.itshw_category + '</label><br>')
						$('#other-labels').append('<label> Hardware: </label> <br>');
						$('#data').append('<label class="font-weight-bold">' + value.hwcomponent_name + '</label><br>')

						if (value.itshw_category == 'pulled-out' || value.itshw_category == 'walk-in') {
							;
							$('#other-labels').append('<label> Property Number: </label> <br>');
							$('#data').append('<label class="font-weight-bold">' + value.property_num + '</label><br>');
						}
					}

				});

			});
		});

		$('.close').click(function() {
			location.reload(true);
		});

		$('.cancel').click(function() {
			location.reload(true);
		});

		$('.receive').click(function(e) {
			e.preventDefault();
			var action = 'statusDeployed';
			var itsrequest_id = $(this).attr('id');

			$.ajax({
				url: "../config/processors/requestArguments.php",
				type: "post",
				data: {
					action: action,
					itsrequest_id: itsrequest_id
				},
			}).done(function(val) {
				alert(val);
				location.reload(true);
			});
		});
	})
</script>
<!--  InfoTechServices System
      Programmer: 
        Dalmo, Manilyn
-->

<!--  repair form adding page  -->

<?php

//start session
session_start();

//check if user is not logged in
if (!isset($_SESSION["username"]) && !isset($_SESSION['usertype'])) {

	//redirect to login page
	header('location: ../login.php');
} else {
	if ($_SESSION['usertype'] !== 'admin' && $_SESSION['usertype'] !== 'personnel' && $_SESSION['usertype'] !== 'programmer') {
		//redirect to login page
		header('location: ../login.php');
	}
}

//include database connection
require_once('../config/db_connection.php');

//include file containing queries
include_once "../config/controllers/controller.php";

//instantiate controller
$control = new Controller();

//get all departments
$departments = $control->getDepartment();

//get all hardware component
$hardwarecomponents = $control->getHardwareComponentsByCategory('main');

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
	<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!-- Bootstrap core JavaScript -->
	<script src="../plug-ins/jquery/jquery.min.js"></script>
	<script src="../plug-ins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Jquery Redirect JavaScript -->
	<script src="../plug-ins/jquery/jquery.redirect.js"></script>

</head>

<body class="h-100 w-100 bg-dark">

	<!-- Page Content -->
	<div class="h-100 w-100 row">

		<!--  Container -->
		<div class="container-fluid col-lg-6 col-md-6 col-sm-12 col-xs-12 offset-lg-3 offset-md-3 my-auto text-white">

			<button class="btn btn-default text-white" onclick="(window).close()"><i class="fa fa-arrow-left"></i>Go back</button>
			<form method="POST" class=" p-3 border rounded" id="incomingrepair-form">
				<div class="form-group text-center">
					<p class="h3"><i class="fa fa-wrench" aria-hidden="true"></i> Repair Adding Form</p>
				</div>
				<div class="form-group">
					<input type="hidden" class="form-control" name="action" id="action" value="addWalk-inRepair">
				</div>

				<div class="form-group">
					<input type="hidden" class="form-control" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value="<?= $_SESSION['useraccount_id']; ?>">
				</div>

				<div>
					<input type="hidden" class="form-control" name="itshw_category" id="itshw_category" value="walk-in">
				</div>

				<div class="form-group">
					<select class="form-control" id="dept_id" name="dept_id">
						<option disabled selected> -- Select Department -- </option>
						<?php foreach ($departments as $department) :	?>
							<option value="<?= $department['dept_id'] ?>"> <?= $department['dept_code'] ?> </option>
						<?php endforeach;	?>
					</select>
				</div>

				<div class="form-group">

					<select class="form-control" id="emp_id" name="emp_id">

					</select>

				</div>

				<div class="form-group request_category" style="display: none">

					<select class="form-control" id="itsrequest_category" name="itsrequest_category">

						<option disabled selected> -- Select Request Category -- </option>
						<option value="hw"> Hardware </option>
						<option value="other"> Other </option>

					</select>

				</div>

				<div id="hw_category" style="display: none">

					<div class="form-group">

						<select class="form-control" id="hwcomponent_id" name="hwcomponent_id">

							<option disabled selected> -- Select Hardware -- </option>

							<?php foreach ($hardwarecomponents as $component) : ?>
								<option value="<?= $component['hwcomponent_id'] ?>"> <?= $component['hwcomponent_name'] ?> </option>
							<?php endforeach; ?>

						</select>

					</div>

					<div class="form-group property_num">
						<select class="form-control" id="hwcomponent_subcategory" name="hwcomponent_subcategory">
						</select>
					</div>

					<div class="form-group property_num">
						<input type="text" name="property_num" id="property_num" class="form-control" placeholder="Property Number">
					</div>

				</div>

				<div class="form-group">
					<label for="concern">Concern:</label>
					<textarea class="form-control" id="concern" name="concern"></textarea>
				</div>

				<div class="row">
					<div class="col text-center">
						<button type="submit" class="btn btn-primary" id="submit-btn">Add Repair</button>
					</div>
				</div>

			</form>
		</div>
		<!--/# Container -->
	</div>
	<!-- /# Page Content -->

</body>

</html>

<script type="text/javascript">
	$(document).ready(function() {

		$('#request_category').show();
		$('#hw_category').show();
		$('#itsrequest_category').val('hw');

		$('#dept_id').change(function() {
			var action = 'getEmployeesByDepartment';
			var dept_id = $(this).val();
			$.ajax({
				url: "../config/processors/requestArguments.php",
				type: "POST",
				data: {
					action: action,
					dept_id: dept_id
				},
			}).done(function(employees) {
				employees = JSON.parse(employees);
				$('#emp_id').empty();
				$('#emp_id').append('<option value = "">' + '-- Select Employee --' + '</option>');
				employees.forEach(function(employee) {
					$('#emp_id').append('<option value = ' + employee.emp_id + '>' + employee.emp_fname + ' ' + employee.emp_lname + '</option>')
				});
			});
		});

		$('#hwcomponent_id').change(function() {
			var action = 'getHardwareComponentsBySubCategory';
			var hwcomponent_id = $(this).val();

			$.ajax({
				url: "../config/processors/requestArguments.php",
				type: "POST",
				data: {
					action: action,
					hwcomponent_id: hwcomponent_id
				},
			}).done(function(components) {

				components = JSON.parse(components);
				$('#hwcomponent_subcategory').empty();
				$('#hwcomponent_subcategory').append('<option value = "">' + '-- Select Specific Hardware Component(Optional) --' + '</option>');
				components.forEach(function(components) {
					$('#hwcomponent_subcategory').append('<option value = ' + components.hwcomponent_id + '>' + components.hwcomponent_name + '</option>')
				});
			});
		});

		$('#incomingrepair-form').submit(function(e) {
			e.preventDefault();

			$.ajax({
				url: "../config/processors/requestArguments.php",
				type: "POST",
				data: $(this).serialize(),
			}).done(function(val) {
				alert(val);
				window.close();
			});

		});

	});
</script>
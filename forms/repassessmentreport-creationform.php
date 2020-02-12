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
	if ($_SESSION['usertype'] !== 'admin' && $_SESSION['usertype'] !== 'personnel') {
		//redirect to login page
		header('location: ../login.php');
	}
}

if (isset($_POST['useraccount_id']) && isset($_POST['itsrequest_id'])) {
	$useraccount_id = $_POST['useraccount_id'];
	$itsrequest_id = $_POST['itsrequest_id'];
	$dept_id = $_POST['dept_id'];
	$hwcomponent_id = $_POST['hwcomponent_id'];
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
$hardwareComponents = $control->getHardwareComponentsByCategory('main');

//get all sub hardware component
$subHardwareComponents = $control->getHardwareComponentsByCategory('sub');
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
	<link href="../plug-ins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

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
		<div class="container-fluid col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-lg-1 offset-md-1 my-auto text-light">
			<form method="POST" class=" p-3 border border-light rounded" id="repassessmentreport-form">
				<div class="form-group text-center">
					<p class="h3"><i class="fa fa-file-o" aria-hidden="true"></i> Repair Assessment Report Creation Form </p>
				</div>

				<div class="form-group">
					<input type="hidden" class="form-control" name="action" id="action" value="addRepAssessReport">
					<input type="hidden" class="form-control" name="itsrequest_id" id="itsrequest_id" value="<?php echo $itsrequest_id; ?>">
				</div>

				<div class="form-group">
					<input type="hidden" class="form-control" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value="<?php echo $_SESSION['useraccount_id']; ?>">
				</div>

				<div class="col-lg-12 row">
					<div class="col-lg-2">
						<label class="form-group"> Date: </label>
					</div>
					<div class="form-group col-lg-4">
						<input class="form-control" type="date" name="assessment_date" id="assessment_date" />
					</div>
				</div>

				<hr class="border border-light">

				<div class="container-fluid row">

					<div class="col-lg-3">

						<label class="form-group col-lg-12"> Name of Item: </label>
						<br>
						<br>
						<label class="form-group col-lg-12"> Model/Description: </label>
						<br>
						<br>
						<label class="form-group col-lg-12"> Date Acquired: </label>
						<br>
						<br>
						<label class="form-group col-lg-12"> Acquisition Price: </label>
					</div>

					<div class="col-lg-3 form-group">
						<select class="form-control" name="hwcomponent_id" id="hwcomponent_id">
							<?php
							foreach ($hardwareComponents as $value) {
							?>
								<option value="<?= $value['hwcomponent_id'] ?>" <?php if ($value['hwcomponent_id'] == $hwcomponent_id) : ?> selected <?php endif ?>>
									<?= $value['hwcomponent_name'] ?>
								</option>
							<?php
							}
							?>
						</select>
						<br>
						<input class="form-control" type="text" name="hwcomponent_description" id="hwcomponent_description">
						<br>
						<input class="form-control" type="date" name="hwcomponent_dateacquired" id="hwcomponent_dateacquired" />
						<br>
						<input class="form-control" type="text" name="hwcomponent_acquisitioncost" id="hwcomponent_acquisitioncost">
					</div>

					<div class="col-lg-3">

						<label class="form-group col-lg-12"> Department/Office: </label>
						<br>
						<br>
						<label class="form-group col-lg-12"> Property Number: </label>
						<br>
						<br>
						<label class="form-group col-lg-12"> Issued To: </label>
						<br>
						<br>
						<label class="form-group col-lg-12"> Serial Number: </label>

					</div>

					<div class="col-lg-3 form-group ">
						<select class="form-control" name="dept_id" id="dept_id">
							<?php
							foreach ($departments as $value) {
							?>
								<option value="<?= $value['dept_id'] ?>" <?php if ($dept_id == $value['dept_id']) : ?> selected='selected' <?php endif; ?>>
									<?= $value['dept_code'] ?>
								</option>
							<?php
							}
							?>
						</select>
						<br>
						<input class="form-control" type="text" name="property_num" id="property_num" />
						<br>
						<select class="form-control" name="emp_id" id="emp_id">
						</select>
						<br>
						<input class="form-control" type="text" name="serial_num" id="serial_num">
					</div>

				</div>

				<div class="container-fluid row">

					<div class="col-lg-3">

						<label class="form-group col-lg-12"> Problem: </label>

					</div>

					<div class="col-lg-9 form-group">
						<div class="col-lg-12 border border-light rounded overflow-auto" style="height: 90px;">
							<div class="checkbox text-left " id="checkbox">
								<label class="row px-2">
									<div class="col-lg-12" id="checkbox_container">
									</div>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="container-fluid row">
					<div class="col-lg-3">
						<label class="form-group col-lg-12"> Findings: </label>
						<br>
						<br>
						<label class="form-group col-lg-12"> Notes: </label>
					</div>

					<div class="col-lg-9 row">

						<div class="col-lg-4 form-group">
							<select class="form-control" name="findings_category" id="findings_category">
								<option value="">-- Select Findings --</option>
								<option value="repaired">Repaired</option>
								<option value="partly damaged">Partly Damaged</option>
								<option value="beyond repair">Beyond Repair</option>
								<option value="for replacement">For Replacement</option>
							</select>
						</div>

						<div class="col-lg-8 form-group">
							<input class="form-control" type="text" name="findings_description" id="findings_description" placeholder="Findings Description">
						</div>

						<div class="col-lg-12 form-group">

							<input class="form-control" type="text" name="notes" id="notes" placeholder="Notes">

						</div>

					</div>
				</div>

				<hr class="border border-light">

				<div class="row">
					<div class="col text-center">

						<button type="submit" class="btn btn-primary" id="submit-btn">Create</button>

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
	window.onload = function() {

		var action = 'getEmployeesByDepartment';
		var dept_id = $('#dept_id').val();
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

		var action = 'getRepair';
		var itsrequest_id = <?php echo $itsrequest_id; ?>;

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
				$('#property_num').val(value.property_num);
				$('#emp_id').val(value.emp_id);
			});
		});

	};

	var action = 'getHardwareComponentsBySubCategory';
	var hwcomponent_id = $('#hwcomponent_id').val();

	console.log(hwcomponent_id);
	$.ajax({
		url: "../config/processors/requestArguments.php",
		type: "POST",
		data: {
			action: action,
			hwcomponent_id: hwcomponent_id
		},
	}).done(function(components) {
		console.log(components);
		components = JSON.parse(components);
		$('#checkbox_container').empty();
		components.forEach(function(components) {
			$('#checkbox_container').append('<input type="checkbox" class="cb_hwcomponent" name="cb_hwcomponent[]" id=' + components.hwcomponent_id + '>' + components.hwcomponent_name + '<br>');
		});
	});

	$('#dept_id').change(function(e) {
		e.preventDefault();

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

	$('#repassessmentreport-form').submit(function(e) {
		e.preventDefault();

		var action = $('#action').val();
		var itsrequest_id = $('#itsrequest_id').val();
		var hwsubcomponent = [];
		$(".cb_hwcomponent:checked").each(function() {
			hwsubcomponent.push($(this).attr('id'));
		});
		var statusupdate_useraccount_id = $('#statusupdate_useraccount_id').val();
		var assessment_date = $('#assessment_date').val();
		var hwcomponent_id = $('#hwcomponent_id').val();
		var hwcomponent_description = $('#hwcomponent_description').val();
		var hwcomponent_dateacquired = $('#hwcomponent_dateacquired').val();
		var hwcomponent_acquisitioncost = $('#hwcomponent_acquisitioncost').val();
		var dept_id = $('#dept_id').val();
		var emp_id = $('#emp_id').val();
		var findings_category = $('#findings_category').val();
		var findings_description = $('#findings_description').val();
		var notes = $('#notes').val();
		var serial_num = $('#serial_num').val();
		var property_num = $('#property_num').val();

		$.ajax({
			url: "../config/processors/requestArguments.php",
			type: "POST",
			data: {
				action: action,
				hwsubcomponent: hwsubcomponent,
				statusupdate_useraccount_id: statusupdate_useraccount_id,
				assessment_date: assessment_date,
				hwcomponent_id: hwcomponent_id,
				hwcomponent_description: hwcomponent_description,
				hwcomponent_dateacquired: hwcomponent_dateacquired,
				hwcomponent_acquisitioncost: hwcomponent_acquisitioncost,
				dept_id: dept_id,
				emp_id: emp_id,
				findings_category: findings_category,
				findings_description: findings_description,
				notes: notes,
				itsrequest_id: itsrequest_id,
				serial_num: serial_num,
				property_num: property_num
			},
		}).done(function(val) {
			alert(val);
			window.location.replace('../admin/incoming-repairs.php');
		});

	});
</script>
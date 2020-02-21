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
	exit;
}

if (!in_array($_SESSION['usertype'], ['admin', 'personnel'])) {
	//redirect to login page
	header('location: ../login.php');
	exit;
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

// echo ($_POST['useraccount_id']);
// echo ($_POST['itsrequest_id']);
// echo ($_POST['hwcomponent_id']);
// die;
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
			<form method="POST" class="p-3 border border-light rounded" id="repassessmentreport-form">
				<div class="form-group text-center">
					<div class="row">
						<div class="col-2">
							<!-- Redirect to incoming repairs page -->
							<a href="../admin/incoming-repairs.php" class="btn btn-default pl-0 text-white"><i class="fa fa-arrow-left fa-fw"></i>Go Back</a>
						</div>
						<div class="col-8">
							<p class="h3"><i class="fa fa-file-o" aria-hidden="true"></i> Repair Assessment Report Creation Form </p>
						</div>
					</div>
				</div>

				<div class="form-group">
					<input type="hidden" class="form-control" name="action" id="action" value="addRepAssessReport">
					<input type="hidden" class="form-control" name="itsrequest_id" id="itsrequest_id" value="<?= $itsrequest_id ?>">
				</div>

				<div class="form-group">
					<input type="hidden" class="form-control" name="assessmenttechrep_useraccount_id" id="assessmenttechrep_useraccount_id" value="<?= $_SESSION['useraccount_id']; ?>" required>
				</div>

				<div class="col-lg-12 row">
					<div class="col-lg-2 ml-3">
						<label class="form-group"> Date: </label>
					</div>
					<div class="form-group col-lg-4">
						<input class="form-control" type="date" name="assessment_date" id="assessment_date" value="<?= date('Y-m-d') ?>" required />
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
						<!-- Name of Item Select Field -->
						<select class="form-control" name="hwcomponent_id" id="hwcomponent_id" required disabled>
							<?php foreach ($hardwareComponents as $component) : ?>
								<option value="<?= $component['hwcomponent_id'] ?>" <?php if ($component['hwcomponent_id'] == $hwcomponent_id) : ?> selected <?php endif ?>>
									<?= $component['hwcomponent_name'] ?>
								</option>
							<?php endforeach; ?>
						</select>
						<!-- /# Name of Item Select Field -->
						<br>
						<!-- Hardware Component Description Field -->
						<textarea name="hwcomponent_description" class="form-control" id="hwcomponent_description" rows="2" required></textarea>
						<!-- <input class="form-control" type="text" name="hwcomponent_description" id="hwcomponent_description" required> -->
						<!-- /# Hardware Component Description Field -->
						<br>
						<!-- Date Acquired Field -->
						<input class="form-control" type="date" name="hwcomponent_dateAcquired" id="hwcomponent_dateAcquired" required />
						<!-- /# Date Acquired Field -->
						<br>
						<!-- Acquisition Cost Field -->
						<input class="form-control" type="number" name="hwcomponent_acquisitioncost" id="hwcomponent_acquisitioncost" min="0" step=".01" required placeholder="Php">
						<!-- /# Acquisition Cost Field -->
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

					<div class="col-lg-3 form-group">
						<!-- Department Field -->
						<select class="form-control" name="dept_id" id="dept_id" required>
							<?php foreach ($departments as $department) : ?>
								<option value="<?= $department['dept_id'] ?>" <?php if ($dept_id == $department['dept_id']) : ?> selected='selected' <?php endif; ?>>
									<?= $department['dept_code'] ?>
								</option>
							<?php endforeach; ?>
						</select>
						<!-- /# Department Field -->
						<br>
						<!-- Property Number Field -->
						<input class="form-control" type="text" name="property_num" id="property_num" required />
						<!-- /# Property Number Field -->
						<br>
						<!-- Employee Id Field -->
						<select class="form-control" name="emp_id" id="emp_id" required>
						</select>
						<!-- /# Employee Id Field -->
						<br>
						<!-- Serial Number Field -->
						<input class="form-control" type="text" name="serial_number" id="serial_number" required>
						<!-- /# Serial Number Field -->
					</div>

				</div>

				<div class="container-fluid row">
					<div class="col-lg-3">
						<label class="form-group col-lg-12"> Problem: </label>
					</div>

					<div class="col-lg-9 form-group">
						<div class="col-lg-12 border border-light rounded overflow-auto" style="height: 150px;">
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
							<!-- Findings Select Field -->
							<select class="form-control" name="findings_category" id="findings_category" required>
								<option value="0">-- Select Findings --</option>
								<option value="repaired">Repaired</option>
								<option value="partly damaged">Partly Damaged</option>
								<option value="beyond repair">Beyond Repair</option>
								<option value="for replacement">For Replacement</option>
							</select>
							<!-- /# Findings Select Field -->
						</div>
						<div class="col-lg-8 form-group">
							<!-- Findings Description Field -->
							<input class="form-control" type="text" name="findings_description" id="findings_description" required placeholder="Findings Description">
							<!-- /# Findings Description Field -->
						</div>
						<div class="col-lg-12 form-group">
							<!-- Notes Field -->
							<input class="form-control" type="text" name="notes" id="notes" placeholder="Notes">
							<!-- /# Notes Field -->
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
			<!-- <button class="btn btn-print btn-info">
				<i class="fa fa-print fa-fw"></i>
				Print
			</button> -->
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
			$('#emp_id').append('<option selected option>-- Select Employee --</option>');
			employees.forEach(function(employee) {
				$('#emp_id').append('<option value = ' + employee.emp_id + '>' + employee.emp_fname + ' ' + employee.emp_lname + '</option>');
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
		}).done(function(requests) {
			$.each(requests, function(index, request) {
				$('#property_num').val(request.property_num);
				$('#emp_id').val(request.emp_id);
			});
		});

	};

	// Send POST request for retrieving the sub-components of the main component
	var action = 'getHardwareComponentsBySubCategory';
	var hwcomponent_id = $('#hwcomponent_id').val(); // refers to the main component id

	$.post("../config/processors/requestArguments.php", {
		action: action,
		hwcomponent_id: hwcomponent_id
	}).done(function(components) {
		components = JSON.parse(components); // parse JSON string 

		$('#checkbox_container').empty(); // clear checkbox container
		// Loop through subcomponents
		components.forEach(function(component) {
			// Create subcomponent field
			const subcomponent = `
				<label for="checkbox-${component.hwcomponent_id}" id="hw_component" class="hw_component label-${component.hwcomponent_id} d-block mb-0 d-flex justify-content-between align-items-center">
					<div class="checkbox-container">
						<input type="checkbox" class="cb_hwcomponent mr-1" name="cb_hwcomponent[]" id="checkbox-${component.hwcomponent_id}" data-sub_component_id="${component.hwcomponent_id}"> ${component.hwcomponent_name}
					</div>
					<div class="remark-container w-75" style="display: none">
						<input id="sub-component-remark-${component.hwcomponent_id}" type="text" class="w-100 mt-2" placeholder="Remark">
					</div>
				</label>
			`;

			// Append subcomponent field to checkbox container
			$('#checkbox_container').append(subcomponent);

			// Listen to checkbox click event
			$(`#checkbox-${component.hwcomponent_id}`).click(() => {
				// Toggle remark container
				$(`.label-${component.hwcomponent_id} > .remark-container`).toggle('slow');
			});
		});

		// const others =
		// 	`<label for="checkbox-others" id="hw_component" class="hw_component label-others d-block mb-0 d-flex justify-content-between align-items-center">
		// 			<div class="checkbox-container">
		// 				<input type="checkbox" class="cb_hwcomponent mr-1" name="cb_hwcomponent[]" id="checkbox-others"> Others
		// 			</div>
		// 			<div class="remark-container w-75" style="display: none">
		// 				<input type="text" class="w-100 mt-2 others-recommendation" placeholder="Recommendation">
		// 			</div>
		// 		</label>`;

		// $('#checkbox_container').append(others);

		// // Listen to checkbox click event
		// $(`#checkbox-others`).click(() => {
		// 	// Toggle remark container
		// 	$(`.label-others > .remark-container`).toggle('slow');
		// });
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

	$('.btn-print').click(() => (window).open('../admin/downloadables/print-repassessmentreport-form.php'));

	$('#repassessmentreport-form').submit(function(e) {
		e.preventDefault();

		const action = $('#action').val();
		const itsrequest_id = $('#itsrequest_id').val();
		const hwSubComponentsAssessments = [];
		// Loop through all checked checkboxes except 'others checkbox'
		$(".cb_hwcomponent:checked").each(function(i, val) {
			const subComponentId = $(this).data('sub_component_id');
			const subComponentLabelId = $(this).parent().parent().attr('id'); // We need this so that we can access the remark field
			const subComponentRecommendation = $(`#${subComponentLabelId} > .remark-container > #sub-component-remark-${subComponentId}`).val();
			hwSubComponentsAssessments.push({
				sub_component_id: subComponentId,
				remark: subComponentRecommendation
			});
		});

		// Determine if "others checkbox" is checked
		// const othersCheckboxIsChecked = $('#checkbox-others').prop('checked');
		// if (othersCheckboxIsChecked) {
		// 	const othersComponentRecommendation = $('.others-recommendation').val();
		// 	};
		// }

		const assessmenttechrep_useraccount_id = $('#assessmenttechrep_useraccount_id').val();
		const assessment_date = $('#assessment_date').val();
		const hwcomponent_id = $('#hwcomponent_id').val();
		const hwcomponent_description = $('#hwcomponent_description').val();
		const hwcomponent_dateAcquired = $('#hwcomponent_dateAcquired').val();
		const hwcomponent_acquisitioncost = $('#hwcomponent_acquisitioncost').val();
		const dept_id = $('#dept_id').val();
		const emp_id = $('#emp_id').val();
		const findings_category = $('#findings_category').val();
		const findings_description = $('#findings_description').val();
		const notes = $('#notes').val();
		const serial_number = $('#serial_number').val();
		const property_num = $('#property_num').val();

		const assessmentReportData = {
			action: action,
			assessmenttechrep_useraccount_id: assessmenttechrep_useraccount_id,
			assessment_date: assessment_date,
			hwcomponent_id: hwcomponent_id,
			hwcomponent_description: hwcomponent_description,
			hwcomponent_dateAcquired: hwcomponent_dateAcquired,
			hwcomponent_acquisitioncost: hwcomponent_acquisitioncost,
			dept_id: dept_id,
			emp_id: emp_id,
			findings_category: findings_category,
			findings_description: findings_description,
			notes: notes,
			itsrequest_id: itsrequest_id,
			serial_number: serial_number,
			property_num: property_num
		};

		// Insert assessment report data to db
		$.post('../config/processors/requestArguments.php', assessmentReportData)
			.done(
				function(assessmentReportId) {
					const subComponentAssessmentData = {
						action: 'addAssessmentSubComponents',
						assessmentReportId: assessmentReportId,
						subcomponents: hwSubComponentsAssessments,
					};

					// Insert sub-component hardware assessment data
					$.post('../config/processors/requestArguments.php', subComponentAssessmentData)
						.fail(() => alert('Error!'))
						.done(res => {
							if (res) {
								alert('Assessment Report Created!');
								// Redirect to Assessment Report Print Page
								$.redirect('../admin/downloadables/print-repassessmentreport-form.php', {
									assessment_report_id: assessmentReportId
								});
							} else {
								alert('Error!, Try again');
							}
						});
				});

	});
</script>
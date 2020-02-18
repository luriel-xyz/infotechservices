<?php

session_start();

//include database connection
require_once('../../config/db_connection.php');

//include file containing queries
include_once "../../config/controllers/controller.php";

//instantiate controller
$control = new Controller();

if (!isset($_SESSION["username"])) {
	//redirect to login page
	header('Location: ../login.php');
	return;
}

if (!isset($_POST['data'])) {
	header('Location: ../incoming-repairs.php');
	return;
}

$data = json_decode($_POST['data']);
$issuedTo = $control->getEmployee($data->issued_to);
$requestedBy = $control->getEmployee($data->requested_by);
$preInspectedBy = $control->getEmployee($data->pre_inspected_by);
$preInspectedDate = $data->pre_inspected_date;
$preRecommendingApproval = $control->getEmployee($data->pre_recommending_approval);
$preApproved = $control->getEmployee($data->pre_approved);

$postInspectedBy = $control->getEmployee($data->post_inspected_by);
$postInspectedDate = $data->post_inspected_date;
$postRecommendingApproval = $control->getEmployee($data->post_recommending_approval);
$postApproved = $control->getEmployee($data->post_approved);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<!-- Meta Tag to Set Page's Width -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--  Title Page  -->
	<title>PGO IT Services - Pre And Post Repair Inspection Report</title>
	<!--  Link Bootstrap stylesheet -->
	<link href="../../plug-ins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../plug-ins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="../../css/app.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript -->
	<script src="../../plug-ins/jquery/jquery.min.js"></script>
	<script src="../../plug-ins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Jquery Redirect JavaScript -->
	<script src="../../plug-ins/jquery/jquery.redirect.js"></script>
</head>

<body>
	<div class="container py-5">
		<div class="inspection-report">
			<!-- Floating buttons -->
			<div class="floating-buttons">
				<!-- Don't Print Button -->
				<a href="../../admin/incoming-repairs.php" class="btn btn-sm btn-do-not-print btn-secondary" role="button">
					<i class="fa fa-arrow-left fa-fw"></i>
					Cancel
				</a>
				<!-- /# Don't Print Button -->
				<!-- Print Button -->
				<button class="btn btn-sm btn-print btn-info" onclick="window.print()"><i class="fa fa-print fa-fw"></i>Print</button>
				<!-- /# Print Button -->
			</div>
			<!-- /# Floating buttons -->
			<!-- Propery plant and equipment section -->
			<div class="row">
				<!--  -->
				<div class="row mx-auto mt-1">
					<div class="col-md-3 pr-0">
						<img class="w-100" src="../../images/beng_cap_logo.png" alt="logo">
					</div>
					<div class="col-md-9 d-flex flex-column justify-content-center">
						<div class="republic">Republic of the Philippines</div>
						<div class="province">Province of Benguet</div>
						<div class="address">Capitol, La Trinidad</div>
					</div>
				</div>
				<!-- /# -->
				<div class="col-md-3 offset-md-8 text-right">
					<div class="pgo-it-file font-weight-bold red--text">PGO - IT FILE</div>
					<div class="to">TO: <span class="underlined"><?= $data->to ?></span></div>
				</div>
			</div>
			<!-- Form Title -->
			<h1 class="text-center text-uppercase title mt-2">Pre and Post-Repair Inspection Report</h1>
			<!-- /# Form Title -->
			<!--  -->
			<div class="d-flex justify-content-end">
				<div class="d-flex flex-column mr-2">
					<span class="font-size-small">Control No.: <span class="underlined"><?= $data->control_number ?></span></span>
					<span class="font-size-small">Date: <span class="font-weight-bold"><?= $data->date ?></span></span>
				</div>
			</div>
			<!-- /# -->
			<h2 class="subtitle-1 text-uppercase">Propery Plant And Equipment</h2>
			<div class="mt-2 w-25">
				<div class="text-uppercase font-size-small d-flex justify-content-between">type: <span class="font-weight-bold underlined"><?= $data->type ?></span></div>
				<div class="text-uppercase font-size-small d-flex justify-content-between">model: <span class="font-weight-bold underlined"><?= $data->model ?></span></div>
				<div class="text-uppercase font-size-small d-flex justify-content-between">propery number: <span class="font-weight-bold underlined"><?= $data->property_number ?></span></div>
				<div class="text-uppercase font-size-small d-flex justify-content-between">serial number: <span class="font-weight-bold underlined"><?= $data->serial_number ?></span></div>
				<div class="text-uppercase font-size-small d-flex justify-content-between">acquisition date: <span class="font-weight-bold underlined"><?= $data->acquisition_date ?></span></div>
				<div class="text-uppercase font-size-small d-flex justify-content-between">acquisition cost: <span class="font-weight-bold underlined"><?= $data->acquisition_cost ?></span></div>
				<div class="text-uppercase font-size-small d-flex justify-content-between">issued to: <span class="font-weight-bold underlined"><?= $issuedTo['emp_fname'] . ' ' . $issuedTo['emp_lname'] ?></span></div>
			</div>
			<!-- Requested by -->
			<div class="d-flex justify-content-end mt-3">
				<div>
					<div class="signed-by">Requested by:</div>
					<div class="name text-center"><?= "{$requestedBy['emp_fname']} {$requestedBy['emp_lname']}" ?></div>
					<div class="position">Position</div>
				</div>
			</div>
			<!-- /# Requested by -->
			<!-- /# Propery plant and equipment section -->
			<hr class="border border-dark">
			<!-- Pre-repair inspection section -->
			<h2 class="subtitle-1 text-uppercase">Pre-repair inspection</h2>
			<!-- Pre-repair inspection list -->
			<ol class="pl-4" type="I">
				<li class="subtitle-2">Findings/Recommendations:</li>
				<li class="subtitle-2">
					Job Order
					<span class="text-capitalize">(Nature & Scope of work to be done): </span>
				</li>
				<li>
					<span class="subtitle-2">Parts to be replaced and / or procured:</span>
					<!-- Tables row -->
					<div class="container-fluid row">
						<!-- Parts Table -->
						<div class="col-6">
							<?php if (count($data->parts)) : ?>
								<table class="table table-bordered mt-3 parts-to-replace">
									<thead>
										<tr>
											<th class="text-uppercase">QTY</th>
											<th class="text-capitalize">Unit</th>
											<th class="text-capitalize">Particulars / Description</th>
											<th class="text-capitalize">Amount</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($data->parts as $part) : ?>
											<tr class="text-center">
												<td><?= $part->qty ?></td>
												<td><?= $part->unit ?></td>
												<td><?= $part->particularsDescriptions ?></td>
												<td><?= $part->amount ?></td>
											</tr>
										<?php endforeach;	 ?>
									</tbody>
								</table>
							<?php endif; ?>
						</div>
						<!-- /# Parts Table -->
					</div>
					<!-- /# Tables row -->
				</li>
			</ol>
			<!-- /# Psre-repair inspection list -->
			<div class="d-flex justify-content-between">
				<!-- Pre-inspected by -->
				<div class="d-flex">
					<div class="mt-3">
						<div class="signed-by">Pre-inspected by:</div>
						<div class="name text-center"><?= "{$preInspectedBy['emp_fname']} {$preInspectedBy['emp_lname']}" ?></div>
						<div class="position"></div>
						<div class="date">Date: <span class="font-weight-bold"><?= $preInspectedDate ?></span></div>
					</div>
				</div>
				<!-- /# Pre-inspected by -->
				<!-- Pre-inspected by -->
				<div class="d-flex">
					<div class="mt-3">
						<div class="signed-by">Recommending Approval:</div>
						<div class="name text-center"><?= "{$preRecommendingApproval['emp_fname']} {$preRecommendingApproval['emp_lname']}" ?></div>
						<div class="position">Position</div>
					</div>
				</div>
				<!-- /# Pre-inspected by -->
			</div>
			<!-- Approved -->
			<div class="d-flex justify-content-end mt-3">
				<div class="text-center">
					<div class="signed-by">Approved:</div>
					<div class="name"><?= "{$preApproved['emp_fname']} {$preApproved['emp_lname']}" ?></div>
					<div class="position">Position</div>
				</div>
			</div>
			<!-- /# Approved -->
			<!-- /# Pre-repair inspection section -->
			<hr class="border border-dark">
			<!-- Post-repair inspection section -->
			<!-- Pre-repair inspection section -->
			<h2 class="subtitle-1 text-uppercase mb-1">Post-repair inspection</h2>
			<!-- Pre-repair inspection list -->
			<p class="body-1">New Memory Module 4gb installed. End-user to submit waste material report to PGSO etc.</p>
			<!-- /# Post-repair inspection section -->
			<div class="p-1 px-3 d-flex flex-wrap bg-grey mx-4">
				<div class="d-flex align-items-center">
					<div class="checkbox"></div>
					<span class="body-2 font-weight-bold">Stock / Supplies from PGO-IT</span>
				</div>
				<div class="d-flex ml-2 align-items-center">
					<div class="checkbox"></div>
					<span class="checkbox-label font-weight-bold mr-2">ICS Number: </span>
					<span class="caption"><?= $data->ics_number ?></span>
				</div>
				<div class="d-flex ml-2 align-items-center mt-1">
					<div class="checkbox"></div>
					<span class="checkbox-label font-weight-bold mr-2">Inventory Item No:</span>
					<span class="caption"><?= $data->inventory_item_number ?></span>
				</div>
				<div class="d-flex ml-2 align-items-center mt-1">
					<div class="checkbox"></div>
					<span class="checkbox-label font-weight-bold mr-2">S/N:</span>
					<span class="caption"><?= $data->serial_number ?></span>
				</div>
			</div>
			<!--  -->
			<div class="row mt-2 mx-4">
				<div class="col-md-6">
					<div class="d-flex align-items-center">
						<div class="checkbox"></div>
						<span class="checkbox-label-smaller">With Waste Material / Property Return Slip</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="d-flex align-items-center">
						<div class="checkbox"></div>
						<span class="checkbox-label-smaller">Without Waste Material / Property Return Slip</span>
					</div>
				</div>
			</div>
			<!-- /# -->
			<div class="d-flex justify-content-between">
				<!-- Post-inspected by -->
				<div class="d-flex">
					<div class="mt-3">
						<div class="signed-by">Post-inspected by:</div>
						<div class="name text-center"><?= "{$postInspectedBy['emp_fname']} {$postInspectedBy['emp_lname']}" ?></div>
						<div class="position">Position</div>
						<div class="date">Date: <span class="font-weight-bold"><?= $postInspectedDate ?></span></div>
					</div>
				</div>
				<!-- /# Post-inspected by -->
				<!-- Recommending approval -->
				<div class="d-flex">
					<div class="mt-3">
						<div class="signed-by">Recommending Approval:</div>
						<div class="name text-center"><?= "{$postRecommendingApproval['emp_fname']} {$postRecommendingApproval['emp_lname']}" ?></div>
						<div class="position">Position</div>
					</div>
				</div>
				<!-- /# Recommending approval -->
			</div>
			<!-- Approved approval -->
			<div class="d-flex justify-content-end">
				<div class="mt-3 text-center">
					<div class="signed-by">Approved:</div>
					<div class="name"><?= "{$postApproved['emp_fname']} {$postApproved['emp_lname']}" ?></div>
					<div class="position">Position</div>
				</div>
			</div>
			<!-- /# Approved approval -->
		</div>
	</div>
	<script>
		$(() => {
			// window.print()
		})
	</script>
</body>

</html>
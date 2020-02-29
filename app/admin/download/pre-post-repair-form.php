<?php

use App\Employee;

require_once('../../../config/init.php');

if (!isUserLoggedIn()) {
	//redirect to login page
	redirect(getPath('app/auth/login.php'));
	return;
}

if (!isset($_POST['data'])) {
	redirect(getPath('app/admin/incoming-repairs.php'));
	return;
}

$data = json_decode($_POST['data']);
$issuedTo = Employee::getEmployee($data->issued_to);
$requestedBy = Employee::getEmployee($data->requested_by);
$preInspectedBy = Employee::getEmployee($data->pre_inspected_by);
$preInspectedDate = $data->pre_inspected_date;
$preRecommendingApproval = Employee::getEmployee($data->pre_recommending_approval);
$preApproved = Employee::getEmployee($data->pre_approved);

$postInspectedBy = Employee::getEmployee($data->post_inspected_by);
$postInspectedDate = $data->post_inspected_date;
$postRecommendingApproval = Employee::getEmployee($data->post_recommending_approval);
$postApproved = Employee::getEmployee($data->post_approved);

$viewData = compact(
	'data',
	'issuedTo',
	'requestedBy',
	'preInspectedBy',
	'preInspectedDate',
	'preRecommendingApproval',
	'preApproved',
	'postInspectedBy',
	'postInspectedDate',
	'postRecommendingApproval',
	'postApproved'
);
view('admin/download/pre-post-repair', $viewData);

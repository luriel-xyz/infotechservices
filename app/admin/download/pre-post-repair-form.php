<?php

use App\Assessment;
use App\Employee;
use App\InspectionReport;
use App\MotorVehicle;
use App\OtherPropPlantEquip;
use App\PostInspectionReport;
use App\PreInspectionHardware;
use App\PreInspectionReport;

require_once('../../../config/init.php');

if (!isUserLoggedIn()) {
	//redirect to login page
	redirect(getPath('app/auth/login.php'));
	return;
}

if (!isset($_POST['assessment_report_id'])) {
	redirect(getPath('app/admin/incoming-repairs.php'));
	return;
}

$assessmentReport = Assessment::getAssessmentReport($_POST['assessment_report_id']);
$inspectionReport = InspectionReport::byAssessmentReportId($assessmentReport->repassessreport_id);
$motorVehicle = MotorVehicle::byInspectionReportId($inspectionReport->id);
$other = OtherPropPlantEquip::byInspectionReportId($inspectionReport->id);
$issuedTo = Employee::find($other->issued_to);
$requestedBy = Employee::find($other->requested_by);
$preInspectionReport = PreInspectionReport::byInspectionReportId($inspectionReport->id);
$preRepairFindings = $preInspectionReport->repair_inspection;
$preInspectionParts = PreInspectionHardware::allByPreInspectionReportId($preInspectionReport->id);
$preInspectedBy = Employee::find($preInspectionReport->inspected_by);
$preInspectedDate = $preInspectionReport->date_inspected;
$preRecommendingApproval = Employee::find($preInspectionReport->recommending_approval);
$preApproved = Employee::find($preInspectionReport->approved);

$postRepairInspectionReport = PostInspectionReport::byInspectionReportId($inspectionReport->id);
$postRepairFindings = $postRepairInspectionReport->repair_inspection;
$postInspectedBy = Employee::find($postRepairInspectionReport->inspected_by);
$postInspectedDate = $postRepairInspectionReport->date_inspected;
$postRecommendingApproval = Employee::find($postRepairInspectionReport->recommending_approval);
$postApproved = Employee::find($postRepairInspectionReport->approved);
// $data = json_decode($_POST['data']);
// $issuedTo = Employee::getEmployee($data->issued_to);
// $requestedBy = Employee::getEmployee($data->requested_by);
// $preRepairFindings = $data->pre_repair_findings;
// $preInspectedBy = Employee::getEmployee($data->pre_inspected_by);
// $preInspectedDate = $data->pre_inspected_date;
// $preRecommendingApproval = Employee::getEmployee($data->pre_recommending_approval);
// $preApproved = Employee::getEmployee($data->pre_approved);

// $postRepairFindings = $data->post_repair_findings;
// $postInspectedBy = Employee::getEmployee($data->post_inspected_by);
// $postInspectedDate = $data->post_inspected_date;
// $postRecommendingApproval = Employee::getEmployee($data->post_recommending_approval);
// $postApproved = Employee::getEmployee($data->post_approved);

$viewData = compact(
	'inspectionReport',
	'motorVehicle',
	'other',
	'issuedTo',
	'requestedBy',
	'preRepairFindings',
	'preInspectionReport',
	'preInspectionParts',
	'preInspectedBy',
	'preInspectedDate',
	'preRecommendingApproval',
	'preApproved',
	'postRepairInspectionReport',
	'postRepairFindings',
	'postInspectedBy',
	'postInspectedDate',
	'postRecommendingApproval',
	'postApproved'
);

view('admin/download/pre-post-repair', $viewData);

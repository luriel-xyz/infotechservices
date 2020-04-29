<?php

/**
 * Render pre inspection report onlny, the post inspection report part is blank
 */

use App\Assessment;
use App\Employee;
use App\InspectionReport;
use App\MotorVehicle;
use App\OtherPropPlantEquip;
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

$viewData = compact(
	'inspectionReport',
	'other',
	'issuedTo',
	'requestedBy',
	'preRepairFindings',
	'preInspectionReport',
	'preInspectionParts',
	'preInspectedBy',
	'preInspectedDate',
	'preRecommendingApproval',
	'preApproved'
);

view('admin/download/pre-repair-form', $viewData);

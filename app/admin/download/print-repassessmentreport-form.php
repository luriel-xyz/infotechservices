<?php
require_once('../../../config/init.php');

use App\Assessment;
use App\Hardware;
use App\Request;
use App\Employee;
use App\User;

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

if (!isset($_POST['assessment_report_id'])) {
  redirect(getPath('app/admin/incoming-repairs.php'));
  exit;
}

$assessmentReportId = $_POST['assessment_report_id'];
$assessmentReport = Assessment::getAssessmentReport($assessmentReportId);
$date = $assessmentReport->assessment_date;

$mainComponentId = $assessmentReport->hwcomponent_id;
$nameOfItem = Hardware::getHardwareComponents($mainComponentId)->hwcomponent_name;
$modelOrDescription = $assessmentReport->hwcomponent_description;
$dateAcquired = $assessmentReport->hwcomponent_dateAcquired;
$acquisitionCost = $assessmentReport->hwcomponent_acquisitioncost;
$acquisitionCost = \Money\Money::PHP($acquisitionCost);
$acquisitionCost = $acquisitionCost->getCurrency() . ' ' . $acquisitionCost->getAmount();

$request = Request::getRequest($assessmentReport->itsrequest_id);
$departmentCode = $request->dept_code;
$propertyNumber = $request->property_num;

$issuedTo = Employee::getEmployee($request->emp_id);
$issuedTo = $issuedTo->emp_fname . ' ' . $issuedTo->emp_lname;

$subComponents = Assessment::getSubComponentsAssessmentByMainAssessmentId($assessmentReportId);
$findingsCategory = $assessmentReport->findings_category;
$findingsDescription = $assessmentReport->findings_description;
$notes = $assessmentReport->notes;

$techRepresentativeEmpId = User::getUserAccount($assessmentReport->assessmenttechrep_useraccount_id)->emp_id;
$techRepresentative = Employee::getEmployee($techRepresentativeEmpId);

// Hardcoded parameter
$cpuComponents = Hardware::getHardwareComponentsBySubCategory(23);
$printerComponents = Hardware::getHardwareComponentsBySubCategory(24);
$upsComponents = Hardware::getHardwareComponentsBySubCategory(25);
$accessoriesComponents = Hardware::getHardwareComponentsBySubCategory(26);
$othersComponents = Hardware::getHardwareComponentsBySubCategory(27);

$data = compact(
  'assessmentReportId',
  'assessmentReport',
  'date',
  'mainComponentId',
  'nameOfItem',
  'modelOrDescription',
  'dateAcquired',
  'acquisitionCost',
  'request',
  'departmentCode',
  'propertyNumber',
  'issuedTo',
  'subComponents',
  'findingsCategory',
  'findingsDescription',
  'notes',
  'techRepresentativeEmpId',
  'techRepresentative',
  'cpuComponents',
  'printerComponents',
  'upsComponents',
  'accessoriesComponents',
  'othersComponents'
);

view('admin/download/assessment-report', $data); 

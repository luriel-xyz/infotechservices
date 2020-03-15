<?php

use App\Employee;
use App\InspectionReport;

require_once('../../config/init.php');

//check if user is not logged in
if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

if (!in_array(user()->usertype, [ADMIN, PERSONNEL])) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

if (
  !isset($_POST['useraccount_id'])
  || !isset($_POST['itsrequest_id'])
) {
  redirect(getPath('app/admin/incoming-repairs.php'));
  exit;
}

// $dept_id = $_POST['dept_id'];
// $hwcomponent_id = $_POST['hwcomponent_id'];

$useraccount_id = $_POST['useraccount_id'];
$itsrequest_id = $_POST['itsrequest_id'];
$assessment_report_id = $_POST['assessment_report_id'];

$inspectionReport = InspectionReport::byAssessmentReportId($assessment_report_id); // yay!

//get all employees
$employees = Employee::all();

view('includes/forms/post-insp', compact(
  'inspectionReport',
  'useraccount_id',
  'itsrequest_id',
  'assessment_report_id',
  'employees'
));

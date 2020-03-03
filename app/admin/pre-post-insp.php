<?php

use App\Assessment;
use App\Employee;
use App\Request;

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
  || !isset($_POST['action'])
) {
  redirect(getPath('app/admin/incoming-repairs.php'));
  exit;
}

// $dept_id = $_POST['dept_id'];
// $hwcomponent_id = $_POST['hwcomponent_id'];

$action = $_POST['action'];
$useraccount_id = $_POST['useraccount_id'];
$itsrequest_id = $_POST['itsrequest_id'];
$assessment_report_id = $_POST['assessment_report_id'];

//get all employees
$employees = Employee::getEmployee();

$assessmentReport = Assessment::getAssessmentReport($assessment_report_id);
$request = Request::getRequest($assessmentReport->itsrequest_id);

view('includes/forms/prepostinspectionreport-addingform', compact(
  'action',
  'useraccount_id',
  'itsrequest_id',
  'assessment_report_id',
  'employees',
  'assessmentReport',
  'request'
));

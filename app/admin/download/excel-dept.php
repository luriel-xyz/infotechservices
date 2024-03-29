<?php

require_once('../../../config/init.php');

use App\Department;
use App\Repair;
use App\Request;

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

if (!isset($_POST['action'])) {
  redirectToPreviousPage();
  exit;
}

$action = $_POST['action'];
$dept_id = $_POST['dept_id'];

$department = Department::find($dept_id);
$dept_code = $department->dept_code;

if ($action === 'RepairSummaryReport') {
  $result = Repair::getRepairsByDepartment($dept_id);
} else if ($action === 'RequestSummaryReport') {
  $result = Request::getRequestsByDepartment($dept_id);
}

// Redirect back to previous page if empty
if (empty($result)) {
  redirect($_SERVER['HTTP_REFERER'], 'error', 'There is no data to be downloaded.');
}

view('admin/download/excel-dept', compact('action', 'dept_code', 'result'));

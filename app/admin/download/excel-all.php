<?php

require_once('../../../config/init.php');

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
if ($action === 'RepairSummaryReport') {
  $requests = Repair::getRepair();
} else if ($action === 'RequestSummaryReport') {
  $requests = Request::getRequest();
}

view('includes/excel-all', compact('action', 'requests'));

?>
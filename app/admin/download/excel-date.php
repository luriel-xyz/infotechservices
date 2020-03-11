<?php
require_once('../../../config/init.php');

use App\Repair;
use App\Request;
use App\User;

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
$day = $_POST['day'];

if ($action === 'RepairSummaryReport') {
  $result = Repair::getRepairByDate($day);
} else if ($action === 'RequestSummaryReport') {
  $result = Request::getRequestsByDate($day);
}

view('includes/excel-date', compact('action', 'day', 'result'));

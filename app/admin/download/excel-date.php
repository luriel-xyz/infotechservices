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

// Redirect back to previous page if empty
if (empty($result)) {
  redirect($_SERVER['HTTP_REFERER'], 'error', 'There is no data to be downloaded.');
}

view('includes/excel-date', compact('action', 'day', 'result'));

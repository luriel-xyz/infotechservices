<?php

use App\Repair;
use App\Request;

require_once('../../../config/init.php');

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
  $result = Repair::all();
} else if ($action === 'RequestSummaryReport') {
  $result = Request::all();
}

view('admin/download/excel-all', compact('action', 'result'));

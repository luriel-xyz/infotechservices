<?php

use App\Department;
use App\Hardware;

require_once('../../config/init.php');
//check if user is not logged in
if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

if (isset($_POST['useraccount_id']) && isset($_POST['itsrequest_id'])) { 
  // $useraccount_id = $_POST['useraccount_id'];
  $itsrequest_id = $_POST['itsrequest_id'];
  $dept_id = $_POST['dept_id'];
  $hwcomponent_id = $_POST['hwcomponent_id'];
}

//get all departments
$departments = Department::getDepartment();

//get all hardware component
$hardwareComponents = Hardware::getHardwareComponentsByCategory('main');

//get all sub hardware component
$subHardwareComponents = Hardware::getHardwareComponentsByCategory('sub');

// echo ($_POST['useraccount_id']);
// echo ($_POST['itsrequest_id']);
// echo ($_POST['hwcomponent_id']);
// die;

$data = compact('itsrequest_id', 'dept_id', 'hwcomponent_id', 'departments', 'hardwareComponents', 'subHardwareComponents');
view('includes/forms/assessment-form', $data);

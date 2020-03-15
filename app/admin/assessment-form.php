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

if (
  !isset($_POST['itsrequest_id'])
  && !isset($_POST['dept_id'])
  && !isset($_POST['hwcomponent_id'])
) {
  redirectToPreviousPage();
}

$itsrequest_id = $_POST['itsrequest_id'];
$dept_id = $_POST['dept_id'];
$hwcomponent_id = $_POST['hwcomponent_id'];

//get all departments
$departments = Department::all();

//get all hardware component
$hardwareComponents = Hardware::getHardwareComponentsByCategory('main');

//get all sub hardware component
$subHardwareComponents = Hardware::getHardwareComponentsByCategory('sub');

$data = compact('itsrequest_id', 'dept_id', 'hwcomponent_id', 'departments', 'hardwareComponents', 'subHardwareComponents');
view('includes/forms/assessment-form', $data);

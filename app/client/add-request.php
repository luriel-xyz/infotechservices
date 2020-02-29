<?php

use App\Employee;
use App\Hardware;

require_once('../../config/init.php');

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

$employees = Employee::getEmployeesByDepartment(user()->dept_id);

$mainHardwareComponents = Hardware::getHardwareComponentsByCategory('main');

view('includes/forms/add-request', compact('employees', 'mainHardwareComponents'));

?>

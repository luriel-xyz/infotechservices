<?php

use App\Department;
use App\Employee;

require_once('../../../config/init.php');

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

$departments = Department::getDepartment();

$employees = Employee::getEmployee();

view('admin/settings/employees', compact('departments', 'employees'));
?>


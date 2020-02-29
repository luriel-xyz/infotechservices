<?php

use App\Department;
use App\Employee;
use App\User;

require_once('../../../config/init.php'); 

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

$departments = Department::getDepartment(); 

$personnels = Employee::getEmployeesByDepartment(1); 

$useraccounts = User::getUserAccount();

view('admin/settings/user-accounts', compact('departments', 'personnels', 'useraccounts'));
?>


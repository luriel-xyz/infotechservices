<?php

use App\Department;

require_once('../../../config/init.php');

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

$departments = Department::getDepartment();

view('admin/settings/departments', compact('departments'));
?>

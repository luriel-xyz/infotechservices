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

// Paginator
$pages = new Paginator('5', 'p');
$pages->set_total(Employee::count());
$employees = Employee::all($pages->get_limit());
$links = $pages->page_links();

view('admin/settings/employees', compact('departments', 'employees', 'links'));

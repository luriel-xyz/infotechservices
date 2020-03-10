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

// Paginator
$pages = new Paginator('5', 'p');
$pages->set_total(User::count());
$useraccounts = User::all($pages->get_limit());
$links = $pages->page_links();

view('admin/settings/user-accounts', compact('departments', 'personnels', 'useraccounts', 'links'));

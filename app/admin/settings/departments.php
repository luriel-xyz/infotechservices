<?php

use App\Department;

require_once('../../../config/init.php');

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

// Paginator
$pages = new Paginator('10', 'p');
$pages->set_total(Department::count());
$departments = Department::all($pages->get_limit());
$links = $pages->page_links();

view('admin/settings/departments', compact('departments', 'links'));

<!--  admin/ request page  -->

<?php

use App\Hardware;
use App\Request;
use App\Department;

require_once('../../config/init.php');

//check if user is not logged in
if (!isUserLoggedIn()) {
	//redirect to login page
	redirect(getPath('app/auth/login.php'));
	exit;
}

$hardwarecomponents = Hardware::getHardwareComponents();

$requests = Request::getRequest();

$depts = Department::getDepartment();

view('admin/incoming-requests', compact('hardwarecomponents', 'requests', 'depts'));
?>
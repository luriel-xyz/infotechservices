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

//get all departments
$departments = Department::getDepartment();

//get all hardware component
$hardwarecomponents = Hardware::getHardwareComponentsByCategory('main');

view('includes/forms/add-repair', compact('departments', 'hardwarecomponents'));

?>
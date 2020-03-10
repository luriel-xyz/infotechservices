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
$depts = Department::getDepartment();
$type = 'requests';

// Paginator
$pages = new Paginator('5', 'p');
$pages->set_total(Request::count());
$requests = Request::all($pages->get_limit());
$links = $pages->page_links();

$data = compact('hardwarecomponents', 'requests', 'depts', 'type', 'requests', 'links');
view('admin/incoming-requests', $data);
?>
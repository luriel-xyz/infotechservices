<!--  admin/ request page  -->

<?php

use App\Hardware;
use App\Request;
use App\Department;
use JasonGrimes\Paginator;

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

$type = 'requests';

$totalItems = count($requests);
$itemsPerPage = 50;
$currentPage = 1;
$urlPattern = '?page/(:num)';

$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

$data = compact('hardwarecomponents', 'requests', 'depts', 'type', 'paginator');
view('admin/incoming-requests', $data); 
?>
<!--  admin/incoming-repairs page  -->

<?php

use App\Repair;
use App\Department;
use App\Hardware;

require_once('../../config/init.php');

//check if user is not logged in 
if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

$depts = Department::getDepartment();
$hardwareComponents = Hardware::getHardwareComponentsByCategory('main');
$type = 'repairs';

// Paginator
$pages = new Paginator('5', 'p');
$pages->set_total(Repair::count());
$repairs = Repair::all($pages->get_limit());
$links = $pages->page_links();

view('admin/incoming-repairs', compact('repairs', 'links', 'depts', 'hardwareComponents', 'type'));
?>
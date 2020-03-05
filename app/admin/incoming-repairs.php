<!--  admin/incoming-repairs page  -->

<?php

use App\Repair;
use App\Department;
use App\Hardware;
use DawPhpPagination\Pagination;

require_once('../../config/init.php');

//check if user is not logged in 
if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

$repairs = Repair::getRepair();

$depts = Department::getDepartment();

$hardwareComponents = Hardware::getHardwareComponentsByCategory('main');

// $pagination = new Pagination();

// $pagination->paginate(count($repairs));

// $limit = $pagination->getLimit();
// $offset = $pagination->getOffset();

$type = 'repairs';

view('admin/incoming-repairs', compact('repairs', 'depts', 'hardwareComponents', 'type'));
?>
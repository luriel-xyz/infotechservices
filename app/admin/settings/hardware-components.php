<?php

use App\Hardware;

require_once('../../../config/init.php');

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

$hardware_components = Hardware::getHardwareComponents();

$main_hwcomponents = Hardware::getHardwareComponentsByCategory('main');

view('admin/settings/hardware-components', compact('hardware_components', 'main_hwcomponents'));
?>


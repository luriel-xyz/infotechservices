<?php

use App\Hardware;

require_once('../../../config/init.php');

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

$main_hwcomponents = Hardware::getHardwareComponentsByCategory('main');

// Paginator
$pages = new Paginator('10', 'p');
$pages->set_total(Hardware::count());
$hardware_components = Hardware::all($pages->get_limit());
$links = $pages->page_links();

view('admin/settings/hardware-components', compact('hardware_components', 'main_hwcomponents', 'links'));

<!--  client/ index page  -->

<?php

use App\Request;

require_once('../../config/init.php');

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

$requestCount = Request::getTotalRequestsByDepartment(user()->dept_id);

// Paginator
$pages = new Paginator('5', 'p');
$pages->set_total($requestCount);
$requests = Request::getRequestsByDepartment(user()->dept_id, $pages->get_limit());
$links = $pages->page_links();

view('client/sent-requests', compact('requests', 'requestCount', 'links'));
?>
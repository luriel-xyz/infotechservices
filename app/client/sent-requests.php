<!--  client/ index page  -->

<?php

use App\Request;

require_once('../../config/init.php');

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

$requests = Request::getRequestsByDepartment(user()->dept_id);
$requestCount = Request::getTotalRequestsByDepartment(user()->dept_id);

view('client/sent-requests', compact('requests', 'requestCount'));
?>
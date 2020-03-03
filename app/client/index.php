<!--  client/ index page  -->

<?php

require_once('../../config/init.php');

if (!isUserLoggedIn()) {
  //redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}

// Check if usertype is not department
if (user()->usertype != 'department') {
	//redirect to login page
	redirect(getPath('auth/login.php'));
}

view('client/index');
?>
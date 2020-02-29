<?php

require_once('./config/init.php');

//check if user is not logged in
if (!isUserLoggedIn()) {
  // redirect to login page
  redirect(getPath('app/auth/login.php'));
  exit;
}


// Redirect to previous page if already logged in.
redirectToPreviousPage();

// Redirect to user dashboard if already logged in.
redirectIfLoggedIn();
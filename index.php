<?php

//start session
session_start();

//check if user is not logged in
if (!isset($_SESSION["username"])) {
  // redirect to login page
  header('Location: ./login.php');
  exit;
}

// Go back to previous page.
if (isset($_SERVER['HTTP_REFERER'])) {
  $previous = $_SERVER['HTTP_REFERER'];
  header("Location: {$previous}");
  exit;
}

if (in_array($_SESSION['usertype'], ['admin', 'personnel', 'programmer'])) {
  header("Location: ./admin/incoming-requests.php");
  exit;
}

header("Location: ./client/index.php");
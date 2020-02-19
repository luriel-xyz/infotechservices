<?php

//start session
session_start();

//check if user is not logged in
if (!isset($_SESSION["username"]) && !isset($_SESSION['usertype'])) {
  //redirect to login page
  header('Location: ./login.php');
  exit;
}

// Go back to previous page.
$previous = $_SERVER['HTTP_REFERER'] ?? "javascript:history.go(-1)";
header("Location: {$previous}");

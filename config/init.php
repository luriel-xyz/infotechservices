<?php
//start session
session_start();

// Set timezone to Asia Manila
date_default_timezone_set('Asia/Manila');

// Root url
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
// Views directory path
define('VIEW', ROOT . '/resources/views');
// Assets directory path
define('ASSET', ROOT . '/app/assets');

// Require autoload file
require_once(ROOT . '/vendor/autoload.php');

// Adds user data to session if exists.
if (isset($_POST['user'])) {
  // Converts user array to object.
  $userObject = json_decode(json_encode($_POST['user']), FALSE);
  // Adds user object to session
  session('user', $userObject);
}

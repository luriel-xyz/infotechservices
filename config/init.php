<?php
//start session
session_start();

// Set timezone to Asia Manila
date_default_timezone_set('Asia/Manila');

// Root url
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . 'infotechservices');
define('VIEW', ROOT . '/resources/views');
define('ASSET', ROOT . '/app/assets');

// Autoload file
require_once(ROOT . '/vendor/autoload.php');

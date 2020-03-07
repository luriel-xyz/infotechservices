<?php

require_once('../../config/init.php');

redirectIfLoggedIn();

view('auth/login');
?>
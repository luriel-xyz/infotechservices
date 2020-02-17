<!--  InfoTechServices System

      Programmer: 
        Dalmo, Manilyn

-->

<!--  login page  -->

<?php

//include database connection
require_once('config/db_connection.php');

//include file containing queries
include_once "config/controllers/controller.php";

//start session
session_start();

$control = new Controller();

// dept_id, $emp_idnum, $emp_fname, $emp_lname <-- employee
// $control->addEmployee(8, 321, 'Depart', 'Ment');

//checks if request is equal to post
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $password = mysqli_real_escape_string($con, $_POST['password']);

  //instantiate Controller
  $control = new Controller();

  //pass login arguments
  $login = $control->login($username, $password);

  if ($login) {
    $user = $login[0];
    $_SESSION['username'] = $user['username'];
    $_SESSION['usertype'] = $user['usertype'];
    $_SESSION['status'] = $user['status'];
    $_SESSION['useraccount_id'] = $user['useraccount_id'];
    $_SESSION['emp_id'] = $user['emp_id'];
    $_SESSION['lname'] = $user['emp_lname'];
    $_SESSION['fname'] = $user['emp_fname'];
    $_SESSION['dept_id'] = $user['dept_id'];
    $_SESSION['dept_name'] = $user['dept_name'];

    if ($_SESSION['status'] === '1') {
      if ($_SESSION['usertype'] === 'personnel' || $_SESSION['usertype'] === 'admin' || $_SESSION['usertype'] === 'programmer') {
        header("Location: admin/incoming-requests.php");
      } else if ($_SESSION['usertype'] === 'department' || $_SESSION['usertype'] === 'programmer') {
        header('location: client/index.php');
      }
    } else {
      echo '<div class="alert alert-danger text-center">Entered User Account is Disabled!</div>';
    }
  } else {
    echo '<div class="alert alert-warning text-center">Incorrect Entry!</div>';
  }
}
?>

<!DOCTYPE html>

<html class="h-100 w-100">

<head>
  <!-- Meta Tag to Set Page's Width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--  Title Page  -->
  <title>PGO IT Services - Login Page</title>

  <!--  Link Bootstrap stylesheet -->
  <link href="plug-ins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="plug-ins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="h-100 w-100">
  <!-- Page Content -->
  <div class="h-100 w-100 row">
    <!--  Container -->
    <div class="container-fluid col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4 offset-md-4 my-auto">
      <?php include_once('forms/login_form.php'); ?>
    </div>
    <!--/# Container -->
  </div>
  <!-- /# Page Content -->
</body>

</html>
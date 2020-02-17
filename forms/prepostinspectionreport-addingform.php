<?php
//start session
session_start();

//check if user is not logged in
if (!isset($_SESSION["username"]) && !isset($_SESSION['usertype'])) {
  //redirect to login page
  header('location: ../login.php');
} else {
  if ($_SESSION['usertype'] !== 'admin' && $_SESSION['usertype'] !== 'personnel') {
    //redirect to login page
    header('location: ../login.php');
  }
}

if (isset($_POST['useraccount_id']) && isset($_POST['itsrequest_id'])) {
  $useraccount_id = $_POST['useraccount_id'];
  $itsrequest_id = $_POST['itsrequest_id'];
  $dept_id = $_POST['dept_id'];
  $hwcomponent_id = $_POST['hwcomponent_id'];
}

//include database connection
require_once('../config/db_connection.php');

//include file containing queries
include_once "../config/controllers/controller.php";

//instantiate controller
$control = new Controller();

//get all employees
$employees = $control->getEmployee();

?>

<!DOCTYPE html>
<html class="h-100 w-100">

<head>
  <!-- Meta Tag to Set Page's Width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--  Title Page  -->
  <title>Pre-Post-Repair Inspection Report</title>
  <!--  Link Bootstrap stylesheet -->
  <link href="../plug-ins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- App CSS -->
  <link href="../css/app.css" rel="stylesheet">
  <!-- Bootstrap core JavaScript -->
  <script src="../plug-ins/jquery/jquery.min.js"></script>
  <script src="../plug-ins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Jquery Redirect JavaScript -->
  <script src="../plug-ins/jquery/jquery.redirect.js"></script>

</head>

<body class="h-100 w-100 bg-dark">
  <!-- Page Content -->
  <div class="h-100 w-100 row">
    <!--  Container -->
    <div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12  my-auto text-white">
      <a href="../admin/incoming-repairs.php" class="btn btn-default text-white" role="button">
        <i class="fa fa-arrow-left fa-fw"></i>
        Go back
      </a>
      <form method="POST" class="p-3 border rounded" id="pre-post-repair-form">
        <p class="h3 text-center">
          <i class="fa fa-wrench" aria-hidden="true"></i>
          Pre and Post Repair Inspection Report
        </p>
        <hr style="border-color:white">
        <input type="hidden" class="form-control" name="action" id="action" value="addWalk-inRepair">
        <input type="hidden" class="form-control" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value="<?= $_SESSION['useraccount_id'];  ?>">
        <input type="hidden" class="form-control" name="itshw_category" id="itshw_category" value="walk-in">
        <div class="col-md-6">
          <div class="row">
            <div class="col-6">
              <!-- To Field -->
              <div class="form-group">
                <input type="text" class="form-control mb-2" name="to" id="to" placeholder="To">
              </div>
              <!-- /# To Field -->

              <!-- Control Number -->
              <div class="form-group">
                <input type="text" class="form-control mb-2" name="control_number" id="control-number" placeholder="Control Number">
              </div>
              <!-- /# Control Number -->
            </div>
            <div class="col-6">
              <!-- Date -->
              <div class="form-group">
                <label for="date" class="font-size-small mb-1">Date</label>
                <input type="date" class="form-control" name="date" id="date" placeholder="Date">
              </div>
              <!-- /# Date -->
            </div>
          </div>
        </div>
        <hr class="border border-light">
        <div class="container-fluid row">

          <!-- Property Plant and Equipment Section -->
          <div class="col-md-6">
            <h5 class="text-uppercase">DESCRIPTION OF PROPERTY, PLANT AND EQUIPMENT</h5>
            <h5>Property, Plant and Equipment</h5>
            <div class="form-group">
              <input type="text" class="form-control" name="type" id="type" placeholder="Type">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="model" id="model" placeholder="Model">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="property_number" id="property-number" placeholder="Property Number">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="serial_number" id="serial-number" placeholder="Serial Number">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mt-4 pt-2">
              <label for="acquisition-date font-size-small">Acquisition Date:</label>
              <input type="date" class="form-control" name="acquisition_date" id="acquisition-date" placeholder="Acquisition Date">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="acquisition_cost" id="acquisition-cost" placeholder="Acquisition Cost">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="issued_to" id="issued-to" placeholder="Issued to">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="requested_by" id="requested-by" placeholder="Requested By">
            </div>
          </div>
          <!-- /# Property Plant and Equipment Section -->
        </div>

        <hr style="border-color: white">
        <!-- Pre-repair Inspection -->
        <div class="col-md-6">
          <h5 class="text-uppercase">Pre-repair Inspection</h5>
          <div class="form-group">
            <input type="text" class="form-control" name="findings_recommendations" id="findings-recommendations" placeholder="Findings/Recommendations">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" name="job_order" id="job-order" placeholder="Job Order">
          </div>
        </div>
        <!-- /# Pre-repair Inspection -->
        <div class="h6 ml-3">Parts to be Replaced and/or Procured:</div>
        <div class="form-row">
          <table class="table">
            <thead class="text-white text-center">
              <tr>
                <th>Qty</th>
                <th>Unit</th>
                <th>Particulars/Description</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="text" class="form-control" name="qty[]"></td>
                <td><input type="text" class="form-control" name="unit[]"></td>
                <td><input type="text" class="form-control" name="particulars_descriptions[]"></td>
                <td><input type="text" class="form-control" name="amount[]"></td>
              </tr>
              <tr>
                <td><input type="text" class="form-control" name="qty[]"></td>
                <td><input type="text" class="form-control" name="unit[]"></td>
                <td><input type="text" class="form-control" name="particulars_descriptions[]"></td>
                <td><input type="text" class="form-control" name="amount[]"></td>
              </tr>
              <tr>
                <td><input type="text" class="form-control" name="qty[]"></td>
                <td><input type="text" class="form-control" name="unit[]"></td>
                <td><input type="text" class="form-control" name="particulars_descriptions[]"></td>
                <td><input type="text" class="form-control" name="amount[]"></td>
              </tr>
              <tr>
                <td><input type="text" class="form-control" name="qty[]"></td>
                <td><input type="text" class="form-control" name="unit[]"></td>
                <td><input type="text" class="form-control" name="particulars_descriptions[]"></td>
                <td><input type="text" class="form-control" name="amount[]"></td>
              </tr>
              <tr>
                <td><input type="text" class="form-control" name="qty[]"></td>
                <td><input type="text" class="form-control" name="unit[]"></td>
                <td><input type="text" class="form-control" name="particulars_descriptions[]"></td>
                <td><input type="text" class="form-control" name="amount[]"></td>
              </tr>
              <tr>
                <td><input type="text" class="form-control" name="qty[]"></td>
                <td><input type="text" class="form-control" name="unit[]"></td>
                <td><input type="text" class="form-control" name="particulars_descriptions[]"></td>
                <td><input type="text" class="form-control" name="amount[]"></td>
              </tr>
            </tbody>
          </table>
        </div>

        <hr style="border-color: white">
        <div class="form-group">
          <label class="d-flex align-items-center">
            <input type="checkbox" name="additional_sheet" class="mr-1">
            <span>Additional Sheet Attached</span>
          </label>
        </div>

        <!-- Pre Inspection Select Fields -->
        <div class="form-group d-flex mb-0">
          <!-- Pre Inspected by -->
          <div class="form-group mr-4">
            <label for="pre-inspected-by">Pre Inspected By:</label>
            <select name="pre_inspected_by" class="form-control" id="pre-inspected-by">
              <option value="0" disabled>-- Select Employee --</option>
              <?php foreach ($employees as $employee) : ?>
                <option value="<?= $employee['emp_id'] ?>"><?= "{$employee['emp_fname']} {$employee['emp_lname']}" ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- /# Pre Inspected by -->

          <!-- Pre-repair Inspection Recommending Approval -->
          <div class="form-group mr-4">
            <label for="pre-recommending-approval">Recommending Approval:</label>
            <select name="pre_recommending_approval" class="form-control" id="pre-recommending-approval">
              <option value="0" disabled>-- Select Employee --</option>
              <?php foreach ($employees as $employee) : ?>
                <option value="<?= $employee['emp_id'] ?>"><?= "{$employee['emp_fname']} {$employee['emp_lname']}" ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- /# Pre-repair Inspection Recommending Approval -->

          <!-- Pre-repair Inspection Approved -->
          <div class="form-group mr-4">
            <label for="pre-approved">Approved:</label>
            <select name="pre_approved" class="form-control" id="pre-approved">
              <option value="0" disabled>-- Select Employee --</option>
              <?php foreach ($employees as $employee) : ?>
                <option value="<?= $employee['emp_id'] ?>"><?= "{$employee['emp_fname']} {$employee['emp_lname']}" ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- /# Pre-repair Inspection Approved -->
        </div>

        <!-- Date Pre Inspected -->
        <div class="form-group col-md-2 pl-0">
          <label for="date-inspected">Date Inspected:</label>
          <input type="date" name="date_pre_inspected" class="form-control" id="date-pre-inspected">
        </div>
        <!-- /# Date Pre Inspected -->
        <!-- /# Pre Inspection Select Fields -->

        <hr style="border-color: white">

        <!-- Post Repair Inspection -->
        <h5 class="text-uppercase">Post-repair Inspection Findings</h5>

        <div class="row mb-4">
          <div class="col-md-5 form-group">
            <textarea name="findings" class="form-control" id="findings" cols="30" rows="3" placeholder="Findings"></textarea>
          </div>
          <!-- /# Post Repair Inspection -->

          <!-- Checkboxes -->
          <div class="col-md-6 offset-md-1">
            <div class="form-check">
              <label class="form-check-label d-flex align-items-center" for="stock-supplies">
                <input type="checkbox" name="stock_supplies" class="form-check-input" id="stock-supplies" style="position:relative;bottom:1px;">
                <span class="ml-1">Stock / Supplies</span>
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label d-flex align-items-center" for="with">
                <input type="checkbox" name="stock_supplies" class="form-check-input" id="with" style="position:relative;bottom:1px;">
                <span class="ml-1 text-capitalize">With Waste Material / Property Return Slip</span>
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label d-flex align-items-center" for="without">
                <input type="checkbox" name="stock_supplies" class="form-check-input" id="without" style="position:relative;bottom:1px;">
                <span class="ml-1 text-capitalize">Without Waste Material / Property Return Slip</span>
              </label>
            </div>
          </div>
          <!-- /# Checkboxes -->
        </div>

        <!-- Post Inspection Select Fields -->
        <div class="form-group d-flex mb-0">
          <!-- Post Inspected by -->
          <div class="form-group mr-4">
            <label for="post-inspected-by">Post Inspected By:</label>
            <select name="post_inspected_by" class="form-control" id="post-inspected-by">
              <option value="0" disabled>-- Select Employee --</option>
              <?php foreach ($employees as $employee) : ?>
                <option value="<?= $employee['emp_id'] ?>"><?= "{$employee['emp_fname']} {$employee['emp_lname']}" ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- /# Post Inspected by -->

          <!-- Post-repair Inspection Recommending Approval -->
          <div class="form-group mr-4">
            <label for="post-recommending-approval">Recommending Approval:</label>
            <select name="post_recommending_approval" class="form-control" id="post-recommending-approval">
              <option value="0" disabled>-- Select Employee --</option>
              <?php foreach ($employees as $employee) : ?>
                <option value="<?= $employee['emp_id'] ?>"><?= "{$employee['emp_fname']} {$employee['emp_lname']}" ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- /# Post-repair Inspection Recommending Approval -->

          <!-- Post-repair Inspection Approved -->
          <div class="form-group mr-4">
            <label for="post-approved">Approved:</label>
            <select name="post_approved" class="form-control" id="post-approved">
              <option value="0" disabled>-- Select Employee --</option>
              <?php foreach ($employees as $employee) : ?>
                <option value="<?= $employee['emp_id'] ?>"><?= "{$employee['emp_fname']} {$employee['emp_lname']}" ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- /# Post-repair Inspection Approved -->
        </div>

        <!-- Date Post Inspected -->
        <div class="form-group col-md-2 pl-0">
          <label for="date-inspected">Date Inspected:</label>
          <input type="date" name="date_pre_inspected" class="form-control" id="date-pre-inspected">
        </div>
        <!-- /# Date Post Inspected -->

        <!-- /# Post Inspection Select Fields -->

        <!-- Create Button -->
        <button type="submit" class="btn btn-primary d-block mx-auto mt-4" id="submit-btn">Create</button>
        <!-- /# Create Button -->
      </form>
    </div>
    <!--/# Container -->

  </div>
  <!-- /# Page Content -->

</body>

</html>
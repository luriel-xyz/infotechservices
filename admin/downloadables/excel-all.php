<?php

//include database connection
require_once('../../config/db_connection.php');

//include file containing queries
include_once "../../config/controllers/controller.php";

//instantiate controller
$control = new Controller();

if (isset($_POST['action'])) {
  $action = $_POST['action'];

  if ($action === 'RepairSummaryReport') {
    $requests = $control->getRepair();
  } else if ($action === 'RequestSummaryReport') {
    $requests = $control->getRequest();
  }
}

?>
<html>

<head>
  <title></title>
</head>

<body>
  <?php
  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=" . date('m_d_Y') . $action . ".xls");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private", false);
  ?>

  <table border='1' border-color='#333'>
    <thead>
      <center>
        <h3>
          <?php
          if ($action === 'RepairSummaryReport') {
            echo 'REPAIR ';
          } else if ($action === 'RequestSummaryReport') {
            echo 'REQUEST ';
          }
          echo 'SUMMARY REPORT as of ' . date('M d Y');
          ?>
        </h3>
      </center>
    </thead>
    <thead>
      <th style="background-color: gray">Request Date</th>
      <th style="background-color: gray">Department/Office</th>
      <th style="background-color: gray">Employee</th>
      <th style="background-color: gray">Hardware</th>
      <?php if ($action === 'RepairSummaryReport') : ?>
        <th style="background-color: gray">Property Number</th>
      <?php endif; ?>
      <th style="background-color: gray">Concern</th>
      <th style="background-color: gray">Status</th>
      <th style="background-color: gray">IT Personnel</th>
      <th style="background-color: gray">Solution</th>
      <?php if ($action === 'RepairSummaryReport') : ?>
        <th style="background-color: gray">Deployment Date</th>
      <?php endif; ?>
      ?>
    </thead>
    <tbody>
      <?php
      foreach ($requests as $key => $value) {
        if ($value['statusupdate_useraccount_id'] !== NULL) {
          $technician = $control->getUserAccount($value['statusupdate_useraccount_id']);
          foreach ($technician as $key => $val) {
            $tech_name = $val['emp_fname'] . ' ' . $val['emp_lname'];
          }
        } else {
          $tech_name = "";
        }
      ?>
        <tr>
          <td><?= $value['itsrequest_date'] ?></td>
          <td><?= $value['dept_name'] ?></td>
          <td><?= $value['emp_fname'] ?> <?= $value['emp_lname'] ?></td>
          <td><?= $value['hwcomponent_name'] ?></td>
          <?php
          if ($action === 'RepairSummaryReport') {
            echo '<td>' . $value['property_num'] . '</td>';
          }
          ?>
          <td><?= $value['concern'] ?></td>
          <td><?= $value['status'] ?></td>
          <td><?= $tech_name ?></td>
          <td><?= $value['solution'] ?></td>
          <?php
          if ($action === 'RepairSummaryReport') {
            echo '<td>' . $value['received_date'] . '</td>';
          }
          ?>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>

</body>

</html>
<?php

//include database connection
require_once('../../config/db_connection.php');

//include file containing queries
include_once "../../config/controllers/controller.php";

//instantiate controller
$control = new Controller();

if(isset($_POST['action'])){
  $action = $_POST['action'];
  $day = $_POST['day'];

  if($action === 'RepairSummaryReport'){
    $requests = $control->getRepairByDate($day);
  }else if($action === 'RequestSummaryReport'){
    $requests = $control->getRequestByDate($day);
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
header("Content-Disposition: attachment; filename=".date('m_d_Y').$action.".xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>

<table border='1' border-color='#333'>
  <thead>
    <center><h3>
    <?php 
    if($action === 'RepairSummaryReport'){
      echo $day.' REPAIR ';
    }else if($action === 'RequestSummaryReport'){
      echo $day.' REQUEST ';
    }
    echo 'SUMMARY REPORT as of '.date('M d Y');
    ?>
    </h3></center>
  </thead>
  <thead>
    <th style="background-color: gray">Employee</th>
    <th style="background-color: gray">Hardware</th>
    <?php 
    if($action === 'RepairSummaryReport'){
      echo '<th style="background-color: gray">Property Number</th>';
    }
    ?>
    <th style="background-color: gray">Concern</th>
    <th style="background-color: gray">Status</th>
    <th style="background-color: gray">IT Personnel</th>
    <th style="background-color: gray">Solution</th>
    <?php 
    if($action === 'RepairSummaryReport'){
      echo '<th style="background-color: gray">Deployment Date</th>';
    }
    ?>
  </thead>
  <tbody>
    <?php
    if($requests !== 0 && $requests !== false && $requests !== ""){
      foreach ($requests as $key => $value) {
        if($value['statusupdate_useraccount_id'] !== NULL){
          $technician = $control->getUserAccount($value['statusupdate_useraccount_id']);
          $tech_name = $technician['emp_fname'].' '.$technician['emp_lname'];
        }else{
          $tech_name = "";
        }
      ?>
      <tr>
        <td><?=$value['emp_fname']?> <?=$value['emp_lname']?></td>
        <td><?=$value['hwcomponent_name']?></td>
        <?php 
        if($action === 'RepairSummaryReport'){
          echo '<td>'.$value['property_num'].'</td>';
        }
        ?>
        <td><?=$value['concern']?></td>
        <td><?=$value['status']?></td>
        <td><?=$tech_name?></td>
        <td><?=$value['solution']?></td>
        <?php 
        if($action === 'RepairSummaryReport'){
          echo '<td>'.$value['received_date'].'</td>';
        }
        ?>
      </tr>
    <?php
      }
    }
    ?>
  </tbody>
</table>

</body>
</html>
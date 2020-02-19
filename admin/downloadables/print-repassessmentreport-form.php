<?php
session_start();

//include database connection
require_once('../../config/db_connection.php');

//include file containing queries
include_once "../../config/controllers/controller.php";

//instantiate controller
$control = new Controller();

if (!isset($_SESSION["username"])) {
  //redirect to login page
  header('Location: ../login.php');
}

if (!isset($_POST['assessment_report_id'])) {
  header('Location: ../incoming-repairs.php');
} else {
  $assessmentReportId = $_POST['assessment_report_id'];
  $assessmentReport = $control->getAssessmentReport($assessmentReportId);
  $date = $assessmentReport['assessment_date'];

  $mainComponentId = $assessmentReport['hwcomponent_id'];
  $nameOfItem = $control->getHardwareComponents($mainComponentId)['hwcomponent_name'];
  $modelOrDescription = $assessmentReport['hwcomponent_description'];
  $dateAcquired = $assessmentReport['hwcomponent_dateAcquired'];
  $acquisitionCost = $assessmentReport['hwcomponent_acquisitioncost'];

  $request = $control->getRequest($assessmentReport['itsrequest_id']);
  $departmentCode = $request['dept_code'];
  $propertyNumber = $request['property_num'];

  $issuedTo = $control->getEmployee($request['emp_id']);
  $issuedTo = $issuedTo['emp_fname'] . ' ' . $issuedTo['emp_lname'];

  $subComponents = $control->getSubComponentsAssessmentByMainAssessmentId($assessmentReportId);
  $findingsCategory = $assessmentReport['findings_category'];
  $findingsDescription = $assessmentReport['findings_description'];
  $notes = $assessmentReport['notes'];

  $techRepresentativeEmpId = $control->getUserAccount($assessmentReport['assessmenttechrep_useraccount_id'])['emp_id'];
  $techRepresentative = $control->getEmployee($techRepresentativeEmpId);

  // Hardcoded parameter
  $cpuComponents = $control->getHardwareComponentsBySubCategory(23);
  $printerComponents = $control->getHardwareComponentsBySubCategory(24);
  $upsComponents = $control->getHardwareComponentsBySubCategory(25);
  $accessoriesComponents = $control->getHardwareComponentsBySubCategory(26);
  $othersComponents = $control->getHardwareComponentsBySubCategory(27);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- Meta Tag to Set Page's Width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--  Title Page  -->
  <title>PGO IT Services - Assessment Report</title>

  <!--  Link Bootstrap stylesheet -->
  <link href="../../plug-ins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../plug-ins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Assessment report css -->
  <link href="../../css/assessment-report.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript -->
  <script src="../../plug-ins/jquery/jquery.min.js"></script>
  <script src="../../plug-ins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Jquery Redirect JavaScript -->
  <script src="../../plug-ins/jquery/jquery.redirect.js"></script>
</head>

<body class="container my-5 mx-4">
  <div class="floating-buttons">
    <!-- Don't Print Button -->
    <a href="../incoming-repairs.php" class="btn btn-sm btn-do-not-print btn-secondary" role="button">
      <i class="fa fa-arrow-left fa-fw"></i>
      Cancel
    </a>
    <!-- /# Don't Print Button -->
    <!-- Print Button -->
    <button class="btn btn-sm btn-print btn-info" onclick="window.print()"><i class="fa fa-print fa-fw"></i>Print</button>
    <!-- /# Print Button -->
  </div>

  <header>
    <div class="container">
      <div class="d-flex justify-content-center">
        <img src="../../images/beng_cap_logo.png" class="logo" alt="BenguetCapitolLogo">
        <div class="ml-3">
          <h2 class="province text-uppercase">PROVINCE OF BENGUET</h2>
          <h1 class="title text-uppercase">Information Technology Services</h1>
          <h3 class="subtitle-1 text-uppercase">PROVINCIAL GOVERNOR’S OFFICE</h3>
          <h4 class="subtitle-2 mt-4"><u>REPAIR / ASSESSMENT REPORT</u></h4>
        </div>
      </div>
    </div>
  </header>

  <!--  Hardware Info Table  -->
  <div class="hardware-info-table">
    <div class="row">
      <!-- First Column -->
      <div class="hardware-info-table__col col-6">
        <div class="row">
          <!-- Labels -->
          <div class="hardware-info-table__labels body-1">
            <div class="label">Date:</div>
            <div class="label">Name of Item:</div>
            <div class="label">Date Acquired:</div>
            <div class="label">Model/Description:</div>
          </div>
          <!-- /# Labels -->
          <!-- Values -->
          <div class="hardware-info-table__values body-1">
            <div id="date" class="value"><?= $date ?></div>
            <div id="name-of-item" class="value"><?= $nameOfItem ?></div>
            <div id="date-acquired" class="value"><?= $dateAcquired ?></div>
            <div id="model-or-description" class="value"><?= $modelOrDescription ?></div>
          </div>
          <!-- /# Values -->
        </div>
      </div>
      <!-- /# First Column -->

      <!-- / Second Column -->
      <div class="hardware-info-table__col col-6">
        <div class="d-flex">
          <!-- Labels -->
          <div class="hardware-info-table__labels body-1">
            <div class="label">DEPARTMENT/OFFICE:</div>
            <div class="label">PROPERTY NO.:</div>
            <div class="label">ISSUED TO:</div>
            <div class="label">ACQUISITION PRICE:</div>
          </div>
          <!-- /# Labels -->
          <!-- Values -->
          <div class="hardware-info-table__values body-1">
            <div id="department-or-office" class="value"><?= $departmentCode ?></div>
            <div id="property-number" class="value"><?= $propertyNumber ?></div>
            <div id="issued-to" class="value"><?= $issuedTo ?></div>
            <div id="acquisition-price" class="value"><?= $acquisitionCost ?></div>
          </div>
          <!-- /# Values -->
        </div>
      </div>
      <!-- /# Second Column -->
    </div>
    <!--  /# Hardware Info Table  -->

    <!-- Problems table -->
    <!-- <div class="problems-table">
      <div class="row">
        <div class="problems-table__col col-3">
          <span class="problems-table__label">
            <span class="text-uppercase">problem</span> (issues or errors):
          </span>
        </div>
        <div class="problems-table__col col-9 pl-1">
          <span class="problems-table__value">
            Error : Blinking Lights
          </span>
        </div>
      </div>
    </div> -->
    <!-- /# Problems table -->

    <!-- Components Table -->
    <div class="components mt-4 pt-4">
      <h4 class="subtitle-2 text-uppercase">Components:</h4>
      <div class="d-flex">
        <div class="flex-1">
          <!-- CPU -->
          <div>
            <h5 class="main-component bordered mb-0">cpu</h5>
            <?php foreach ($cpuComponents as $component) : ?>
              <div class="sub-component bordered"><?= $component['hwcomponent_name'] ?></div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <!-- /# CPU -->
          <!-- Printers -->
          <div>
            <h5 class="main-component bordered mb-0">printers</h5>
            <?php foreach ($printerComponents as $component) : ?>
              <div class="sub-component bordered"><?= $component['hwcomponent_name'] ?></div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <!-- /# Printers -->
        </div>
        <div class="flex-1">
          <div>
            <!-- CPU components remarks -->
            <h5 class="main-component bordered mb-0">&nbsp;</h5>
            <!-- Show remark description if exists otherwise show a blank -->
            <?php foreach ($cpuComponents as $component) : ?>
              <div class="sub-component bordered">
                <?php
                foreach ($subComponents as $subComponentRemark) {
                  if ($component['hwcomponent_id'] == $subComponentRemark['sub_component_id']) {
                    echo $subComponentRemark['remark'];
                  } else {
                    echo '&nbsp;';
                  }
                }
                ?>
              </div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
            <!-- /# CPU components remarks -->
          </div>
          <div>
            <!-- Printer components remarks -->
            <h5 class="main-component bordered mb-0">&nbsp;</h5>
            <!-- Show remark description if exists otherwise show a blank -->
            <?php foreach ($printerComponents as $component) : ?>
              <div class="sub-component bordered">
                <?php
                foreach ($subComponents as $subComponentRemark) {
                  if ($component['hwcomponent_id'] == $subComponentRemark['sub_component_id']) {
                    echo $subComponentRemark['remark'];
                  } else {
                    echo '&nbsp;';
                  }
                }
                ?>
              </div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
            <!-- /# Printer components remarks -->
          </div>
        </div>
        <div class="flex-1">
          <!-- UPS -->
          <div>
            <h5 class="main-component bordered mb-0">ups</h5>
            <?php foreach ($upsComponents as $component) : ?>
              <div class="sub-component bordered"><?= $component['hwcomponent_name'] ?></div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <!-- /# UPS -->
          <!-- Accessories -->
          <div>
            <h5 class="main-component bordered mb-0">accessories</h5>
            <?php foreach ($accessoriesComponents as $component) : ?>
              <div class="sub-component bordered"><?= $component['hwcomponent_name'] ?></div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <!-- /# Accessories -->
          <div>
            <h5 class="main-component bordered mb-0">others</h5>
            <?php foreach ($othersComponents as $component) : ?>
              <div class="sub-component bordered"><?= $component['hwcomponent_name'] ?></div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <!-- /# Accessories -->
        </div>
        <div class="flex-1">
          <div>
            <!-- UPS components remarks -->
            <h5 class="main-component bordered mb-0">&nbsp;</h5>
            <!-- Show remark description if exists otherwise show a blank -->
            <?php foreach ($upsComponents as $component) : ?>
              <div class="sub-component bordered">
                <?php
                foreach ($subComponents as $subComponentRemark) {
                  if ($component['hwcomponent_id'] == $subComponentRemark['sub_component_id']) {
                    echo $subComponentRemark['remark'];
                  } else {
                    echo '&nbsp;';
                  }
                }
                ?>
              </div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
            <!-- /# UPS components remarks -->
          </div>
          <div>
            <!-- Accessories components remarks -->
            <h5 class="main-component bordered mb-0">&nbsp;</h5>
            <!-- Show remark description if exists otherwise show a blank -->
            <?php foreach ($accessoriesComponents as $component) : ?>
              <div class="sub-component bordered">
                <?php
                foreach ($subComponents as $subComponentRemark) {
                  if ($component['hwcomponent_id'] == $subComponentRemark['sub_component_id']) {
                    echo $subComponentRemark['remark'];
                  } else {
                    echo '&nbsp;';
                  }
                }
                ?>
              </div>
            <?php endforeach ?>
            <!-- /# Accessories components remarks -->
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <div>
            <!-- Others components remarks -->
            <h5 class="main-component bordered mb-0">&nbsp;</h5>
            <!-- Show remark description if exists otherwise show a blank -->
            <?php foreach ($othersComponents as $component) : ?>
              <div class="sub-component bordered">
                <?php
                foreach ($subComponents as $subComponentRemark) {
                  if ($component['hwcomponent_id'] == $subComponentRemark['sub_component_id']) {
                    echo $subComponentRemark['remark'];
                  } else {
                    echo '&nbsp;';
                  }
                }
                ?>
              </div>
            <?php endforeach ?>
            <!-- Others components remarks -->
            <div class="sub-component bordered">&nbsp;</div>
          </div>
        </div>
      </div>
    </div>
    <!-- /# Components Table -->

    <!-- Findings Table -->
    <div class="findings mt-4">
      <h4 class="subtitle-2 text-uppercase">Findings / Recommendations:</h4>
      <div class="row">
        <div class="col-6">
          <div class="partly-damaged findings__category">
            <?php if ($findingsCategory === 'partly damaged') : ?>
              <i class="fa fa-circle fa-fw text-danger"></i>
            <?php else :  ?>
              <i class="fa fa-square-o fa-fw"></i>
            <?php endif; ?>
            <span class="text-uppercase">partly damaged</span>
          </div>
        </div>
        <div class="col-6">
          <div class="beyond-repair findings__category">
            <?php if ($findingsCategory === 'beyond repair') : ?>
              <i class="fa fa-circle fa-fw text-danger"></i>
            <?php else :  ?>
              <i class="fa fa-square-o fa-fw"></i>
            <?php endif; ?>
            <span class="text-uppercase">beyond repair</span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="for-replacement">
            <div class="d-flex align-items-center">
              <div class="findings__category">
                <?php if ($findingsCategory === 'for replacement') : ?>
                  <i class="fa fa-circle fa-fw text-danger"></i>
                <?php else :  ?>
                  <i class="fa fa-square-o fa-fw"></i>
                <?php endif; ?>
                <span class="text-uppercase">for replacement</span>
              </div>
              <div class="findings__description ml-4">
                <?php if ($findingsCategory === 'for replacement') : ?>
                  <?= $findingsDescription ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="repaired findings__category">
            <?php if ($findingsCategory === 'repaired') : ?>
              <i class="fa fa-circle fa-fw text-success"></i>
            <?php else :  ?>
              <i class="fa fa-square-o fa-fw"></i>
            <?php endif; ?>
            <span class="text-uppercase">Repaired</span>
          </div>
          <div class="others findings__category">
            <?php if ($findingsCategory === 'others') : ?>
              <i class="fa fa-circle fa-fw text-danger"></i>
            <?php else :  ?>
              <i class="fa fa-square-o fa-fw"></i>
            <?php endif; ?>
            <span class="text-uppercase">others</span>
          </div>
        </div>
      </div>
    </div>
    <!-- /# Findings Table -->

    <!-- Notes -->
    <div class="notes mt-4 mb-4 pb-4">
      <h4 class="subtitle-2 text-uppercase">Notes:</h4>
      <p class="body-1"><?= $notes ?></p>
    </div>
    <!-- /# Notes -->

    <!-- Technical Representative -->
    <div class="mt-4">
      <span class="tech-rep-name"><?= "{$techRepresentative['emp_fname']} {$techRepresentative['emp_lname']}" ?></span>
      <div class="tech-rep-position"><?= $techRepresentative['emp_position'] ?></div>
    </div>
    <!-- /# Technical Representative -->

    <!-- Info -->
    <div class="info text-center text-uppercase mt-4 pt-4">
      <div class="text-danger subtitle-2">****** ANY TYPE OF COMPUTER REPAIR MAY RESULT IN THE LOSS OF DATA ******</div>
      <div class="text-danger subtitle-2">***** BACKING-UP OF DATA IS THE USER’S RESPONSIBILITY *****</div>
      <div class="font-size-x-small font-weight-bold mt-4">(THIS FORM IS MADE FOR THE BENGUET PROVINCIAL GOVERNMENT)</div>
    </div>
    <!-- /# Info -->
  </div>

</body>

</html>
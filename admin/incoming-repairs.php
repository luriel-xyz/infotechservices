<!--  InfoTechServices System

      Programmer: 
        Dalmo, Manilyn

-->

<!--  admin/incoming-repairs page  -->

<?php

//start session
session_start();

//check if user is not logged in
if (!isset($_SESSION["username"]) && !isset($_SESSION['usertype'])) {
  //redirect to login page
  header('location: ../login.php');
  exit;
} else {
  if (
    $_SESSION['usertype'] !== 'admin'
    && $_SESSION['usertype'] !== 'personnel'
    && $_SESSION['usertype'] !== 'programmer'
  ) {
    //redirect to login page
    header('location: ../login.php');
  }
}

//include database connection
require_once('../config/db_connection.php');

//include file containing queries
include_once "../config/controllers/controller.php";

//instantiate Controller
$control = new Controller();

$repairs = $control->getRepair();

$depts = $control->getDepartment();

$hardwareComponents = $control->getHardwareComponentsByCategory('main');

?>

<!DOCTYPE html>
<html class="h-100 w-100">

<head>
  <!-- Meta Tag to Set Page's Width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--  Title Page  -->
  <title>PGO IT Services - Admin Page</title>
  <!--  Link Bootstrap stylesheet -->
  <link href="../plug-ins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!--  Link sidebar stylesheet  -->
  <link href="../css/simple-sidebar.css" rel="stylesheet">

  <!-- Font Awesome Icons Stylesheet -->
  <link href="../plug-ins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript -->
  <script src="../plug-ins/jquery/jquery.min.js"></script>
  <script src="../plug-ins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Jquery Redirect JavaScript -->
  <script src="../plug-ins/jquery/jquery.redirect.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
</head>

<body class="h-100 w-100">
  <!-- /# Wrapper -->
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-secondary border-right mt-5 pt-2" id="sidebar-wrapper">
      <div class="list-group list-group-flush">
        <a href="incoming-requests.php" class="list-group-item list-group-item-action bg-secondary text-light border-bottom"><i class="fa fa-bell" aria-hidden="true"></i> Incoming Requests</a>
        <a href="incoming-repairs.php" class="list-group-item list-group-item-action bg-secondary text-light border-bottom"><i class="fa fa-wrench" aria-hidden="true"></i> Incoming Repairs</a>

        <!-- The settings menu can only be accessed by the admin and programmer.  -->
        <?php if (
          $_SESSION['usertype'] === 'admin'
          || $_SESSION['usertype'] === 'programmer'
        ) : ?>
          <a href="#settingsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-secondary text-light"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
          <ul class="collapse list-unstyled" id="settingsSubmenu">
            <li><a href="settings/user-accounts.php" class="list-group-item list-group-item-action text-white bo*rder-bottom" style="background-color: #adb5bd">User Accounts</a></li>
            <li><a href="settings/employees.php" class="list-group-item list-group-item-action text-white border-bottom" style="background-color: #adb5bd">Employees</a></li>
            <li><a href="settings/departments.php" class="list-group-item list-group-item-action text-white border-bottom" style="background-color: #adb5bd">Departments</a></li>
            <li><a href="settings/hardware-components.php" class="list-group-item list-group-item-action text-white" style="background-color: #adb5bd">Hardware Components</a></li>
          </ul>
        <?php endif; ?>

      </div>

    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div class="h-100 w-100">
      <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
        <button class="btn btn-primary" id="menu-toggle" data-toggle="tooltip" title="Toggle Sidebar">
          <i class="fa fa-caret-square-o-down" aria-hidden="true"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link text-primary font-weight-bold" href="incoming-requests.php">INFO TECH SERVICES</a>
            </li>
          </ul>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link text-primary font-weight-bold disabled"><?= $_SESSION['username'] ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-primary " href="../logout.php" data-toggle="tooltip" title="Logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid h-100" style="margin-top: 80px;">
        <div class="row">
          <p class="h3 mx-auto"> <i class="fa fa-wrench" aria-hidden="true"></i> Incoming Repairs </p>
        </div>

        <hr class="border border-bottom border-primary">
        <div class="row">
          <!-- Search Field -->
          <div class="col-lg-4">
            <div class="input-group">
              <input type="text" class="form-control " id="search" placeholder="Search">
              <div class="input-group-append">
                <button type="button" class="btn btn-primary" data-toggle="tooltip" title="Add Incoming Repair" id="add"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Repair</button>
              </div>
            </div>
          </div>
          <!-- /# Search Field -->
          <!-- Download Summary Button -->
          <div class="mr-3 ml-auto">
            <button type="button" class="btn btn-primary" data-toggle="tooltip" title="Download Summary in MSword" id="printSummary"><i class="fa fa-download" aria-hidden="true"></i></button>
          </div>
          <!-- /# Download Summary Button -->
        </div>

      </div>
      <!--/# Container -->

      <!-- Modal View -->
      <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <!--  View Modal  -->
            <div id="view-form">
              <div class="modal-header text-light bg-primary">
                <div class="container-fluid text-center">
                  <p class="h5 modal-title text-uppercase" id="exampleModalLabel">VIEW REPAIR DETAILS</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div id="view-table" class="modal-body">
                <form>
                  <div class="container-fluid form-row">
                    <div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
                      <label> Status: </label> <br>
                      <label> Date&Time: </label> <br>
                      <label> Requestee: </label> <br>
                      <label> Hardware Type: </label> <br>
                      <label> Property Number: </label> <br>
                      <label> Problem: </label> <br>
                      <label> Repair Category: </label> <br>
                    </div>

                    <div class="form-group col-lg-7 col-md-7 col-sm-12 col-xs-12" id="data">
                    </div>
                  </div>

                </form>

              </div>

              <div class="modal-footer text-light bg-primary" id="footer-buttons" style="margin-bottom: 0">
                <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /#View Modal -->
          </div>
        </div>
      </div>
      <!-- /# Modal  -->

      <!-- Modal Done -->
      <div class="modal fade" id="modalDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <!--  Done Modal  -->
            <div id="done-form">
              <?php include_once('../forms/pullout_done-form.php'); ?>
            </div>
            <!-- /#Done Modal -->
          </div>
        </div>
      </div>
      <!-- /# Modal  -->

      <!-- Modal Print -->
      <div class="modal fade" id="modalPrint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <!--  Print Modal  -->
            <div id="printSorting-form">
              <?php include_once('../forms/printSorting-form.php'); ?>
            </div>
            <!-- /#Print Modal -->
          </div>
        </div>
      </div>
      <!-- /# Modal  -->

      <!-- Table Container -->
      <div class="container-fluid mt-2">
        <?php include_once('../tables/incomingrepair-tbl.php');  ?>
      </div>
      <!--/#Table Container-->

    </div>
    <!-- /# Page Content -->

  </div>
  <!-- /# Wrapper -->
</body>

</html>

<script>
  $(function() {
    function setAssessmentDone(itsrequest_id, useraccount_id) {
      const action = 'statusAssessed';

      $.post('../config/processors/requestArguments.php', {
        action: action,
        itsrequest_id: itsrequest_id,
        useraccount_id: useraccount_id
      }).done(function(data) {
        alert(data);
        location.reload(true);
      });

      // $.ajax({
      //   url: "../config/processors/requestArguments.php",
      //   type: "POST",
      //   data: {
      //     action: action,
      //     itsrequest_id: itsrequest_id,
      //     useraccount_id: useraccount_id*
      //   },
      // }).done(function(val) {
      //   alert(val);
      //   location.reload(true);
      // });
    }

    /* Menu Toggle Script */
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    $("#search").on("keyup", function() {
      var search_text = $(this).val().toLowerCase();
      $("#table_body tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(search_text) > -1)
      });
    });

    $('input[name="sort"]').change(function(e) {
      if ($('input[name="sort"]:checked').val() === 'department') {
        $('#dept_selection').show();
        $('#date_selection').hide();
      } else if ($('input[name="sort"]:checked').val() === 'day') {
        $('#dept_selection').hide();
        $('#date_selection').show();
      } else {
        $('#date_selection').hide();
        $('#dept_selection').hide();
      }
    });

    $('#printSummary').click(function(e) {
      e.preventDefault();
      $('#modalPrint').modal('toggle');
    });

    $('#printSorting-form').submit(function(e) {
      e.preventDefault();

      var action = "RepairSummaryReport";
      var sort = $('input[name="sort"]:checked').val();
      var dept_id = $('#dept_id').val();
      var day = $('#day').val();

      if (sort === 'all') {
        var url = "downloadables/excel-all.php";
      } else if (sort === 'department') {
        var url = "downloadables/excel-dept.php";
      } else if (sort === 'day') {
        var url = "downloadables/excel-date.php";
      }

      $.redirect(url, {
        action: action,
        dept_id: dept_id,
        day: day
      });
      $('#modalPrint').modal('toggle');

    });

    //View Request Details Script
    $(".view").click(function(e) {
      e.preventDefault();
      var action = 'getRequest';
      var itsrequest_id = $(this).attr('id');

      $.post({
        url: "../config/processors/requestArguments.php",
        type: "post",
        data: {
          action: action,
          itsrequest_id: itsrequest_id
        },
        dataType: 'JSON',
      }).done(function(request) {
        $('#modalView').modal('toggle');
        if (request.status === 'received') {
          $('#data').append('<label class="font-weight-bold text-info">' + request.status + '</label><br>');
        } else if (request.status === 'pending' || request.status === 'assessment pending') {
          $('#data').append('<label class="font-weight-bold text-success">' + request.status + '</label><br>');
        } else if (request.status === 'deployed' || request.status === 'assessed' || request.status === 'done') {
          $('#data').append('<label class="font-weight-bold text-secondary">' + request.status + '</label><br>');
        } else if (request.status === 'pre-repair inspected' || request.status === 'post-repair inspected') {
          $('#data').append('<label class="font-weight-bold text-warning">' + request.status + '</label><br>');
        }

        $('#data').append('<label class="font-weight-bold">' + request.itsrequest_date + '</label><br>');
        $('#data').append('<label class="font-weight-bold">' + request.dept_code + '|' + request.emp_fname + ' ' + request.emp_lname + '</label><br>');
        $('#data').append('<label class="font-weight-bold">' + request.hwcomponent_name + '</label><br>')
        $('#data').append('<label class="font-weight-bold">' + request.property_num + '</label><br>');
        $('#data').append('<label class="font-weight-bold">' + request.concern + '</label><br>');
        $('#data').append('<label class="font-weight-bold">' + request.itshw_category + '</label><br>')
      });

      $("#modalView").modal({
        backdrop: 'static',
        keyboard: false
      });
    });

    $('.pending').click(function(e) {
      e.preventDefault();
      var action = 'statusPending';
      var itsrequest_id = $(this).attr('id');
      var statusupdate_useraccount_id = $(this).attr('data-id');

      $.ajax({
        url: "../config/processors/requestArguments.php",
        type: "post",
        data: {
          action: action,
          itsrequest_id: itsrequest_id,
          statusupdate_useraccount_id: statusupdate_useraccount_id
        },
      }).done(function(val) {
        alert(val);
        location.reload(true);
      });
    });

    $('.done').click(function(e) {
      e.preventDefault();
      var itsrequest_id = $(this).attr('id');
      var statusupdate_useraccount_id = $(this).attr('data-id');

      $('#itsrequest_id').append('<input type="hidden" class="form-control" name="itsrequest_id" id="itsrequest_id" value=' + itsrequest_id + '>');
      $('#statusupdate_useraccount_id').append('<input type="hidden" class="form-control" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value=' + statusupdate_useraccount_id + '>');
      $('#input_field').append('<label for="solution">Solution:</label><textarea class="form-control" name="solution" id="solution"></textarea>');
      $('#modalDone').modal({
        backdrop: 'static',
        keyboard: false
      });
    });

    $('#pullout_done-form').submit(function(e) {
      e.preventDefault();

      $.ajax({
        url: "../config/processors/requestArguments.php",
        type: "POST",
        data: $(this).serialize(),
      }).done(function(val) {
        alert(val);
        location.reload(true);
      });

    });

    // Add new repair button click listener
    $('#add').click(function(e) {
      e.preventDefault();

      var url = "../forms/incomingrepair-addingform.php";

      (window).open(url);
    });

    // Assessment Button CLick Listener
    $('.assess').click(function(e) {
      e.preventDefault();

      $.redirect('../forms/repassessmentreport-creationform.php', {
        itsrequest_id: $(this).attr('id'),
        useraccount_id: $(this).data('useraccount_id'),
        dept_id: $(this).data('dept_id'),
        hwcomponent_id: $(this).data('hwcomponent_id')
      });

      // var action = 'statusAssessmentPending';
      const itsrequest_id = $(this).attr('id');
      const useraccount_id = $(this).attr('data-id');

    });

    $('.assessment-created').click(function(e) {
      e.preventDefault();
      const itsrequest_id = $(this).attr('id');
      const useraccount_id = $(this).attr('data-id');
      setAssessmentDone(itsrequest_id, useraccount_id);
    });

    $('.btn-print-assessment').click(function() {
      $.redirect('./downloadables/print-repassessmentreport-form.php', {
        assessment_report_id: $(this).data('assessment-report-id')
      });
    });

    // Pre and Post Inspect Button
    $('.pre-post-inspect').click(function() {
      // Redirect to Inspection Report Form
      const action = 'statusPreAndPostInspected';
      const itsrequest_id = $(this).attr('id');
      const useraccount_id = $(this).attr('data-id');
      $.redirect('../forms/prepostinspectionreport-addingform.php', {
        action: action,
        itsrequest_id: itsrequest_id,
        useraccount_id: useraccount_id
      });
    });

    // $('.pre-inspect').click(function(e) {
    //   e.preventDefault();

    //   var action = 'statusPreInspected';
    //   var itsrequest_id = $(this).attr('id');
    //   var useraccount_id = $(this).attr('data-id');

    //   $.ajax({
    //     url: "../config/processors/requestArguments.php",
    //     type: "POST",
    //     data: {
    //       action: action,
    //       itsrequest_id: itsrequest_id,
    //       useraccount_id: useraccount_id
    //     },
    //   }).done(function(val) {
    //     alert(val);
    //     location.reload(true);
    //   });
    // });

    // $('.post-inspect').click(function(e) {
    //   e.preventDefault();

    //   var action = 'statusPostInspected';
    //   var itsrequest_id = $(this).attr('id');
    //   var useraccount_id = $(this).attr('data-id');

    //   $.ajax({
    //     url: "../config/processors/requestArguments.php",
    //     type: "POST",
    //     data: {
    //       action: action,
    //       itsrequest_id: itsrequest_id,
    //       useraccount_id: useraccount_id
    //     },
    //   }).done(function(val) {
    //     alert(val);
    //     location.reload(true);
    //   });
    // });

    /*$('.download-assessrep').click(function(e){
     	e.preventDefault();

     	var itsrequest_id = $(this).attr('id');
     	var url = "downloadables/word.php";

     	$.redirect(url, {itsrequest_id:itsrequest_id});
    });*/


    $('.close').click(function() {
      location.reload(true);
    });

    $('.cancel').click(function() {
      location.reload(true);
    });
  })
</script>
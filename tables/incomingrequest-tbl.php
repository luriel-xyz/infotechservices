<?php
//include database connection
require_once('../config/db_connection.php');

//include file containing queries
include_once "../config/controllers/controller.php";

//instantiate Controller
$control = new Controller();
$requests = $control->getRequest();

?>


<?php
//if no requests
if (!$requests) :
?>
  <div class="alert alert-info text-center">
    <?= "No Incoming Request Queued!"; ?>
  </div>
<?php
//if not empty
else :
?>
  <table class="table table-bordered text-center">
    <thead>
      <th>#</th>
      <th>Date</th>
      <th>Department</th>
      <th>Employee Name</th>
      <th>Concern</th>
      <th>Status</th>
      <th>Action</th>
    </thead>
    <tbody id="table_body">
      <?php
      $id = 1;
      foreach ($requests as $request) :
        $component = $control->getHardwareComponents($request['hwcomponent_sub_id']);
        $userAccount = $control->getUserAccount($request['statusupdate_useraccount_id']);
        // $techRepEmployee = $control->getEmployee($userAccount['emp_id']);
      ?>
        <tr>
          <td> <?= $id ?> </td>
          <td> <?= date_format(date_create($request['itsrequest_date']), "M d, Y h:i a") ?> </td>
          <td> <?= $request['dept_code'] ?> </td>
          <td> <?= $request['emp_fname'] ?> <?= $request['emp_lname'] ?> </td>
          <td style="width:20%">
            <!-- Hardware component name -->
            <?php
            if ($request['itsrequest_category'] == 'hw') {
              if ($component) {
                echo $request['hwcomponent_name'] . '(' . $component['hwcomponent_name'] . ')' . ' -';
              } else {
                echo $request['hwcomponent_name'] . ' -';
              }
            }
            ?>
            <!-- /# Hardware component name -->

            <?= $request['concern'] ?>

          </td>
          <td> <?= $request['status'] ?>
            <?php
            // if ($request['statusupdate_useraccount_id']) {
            //   echo 'by ' . '<b>' . $techRepEmployee['emp_fname'] . '</b>';
            // }
            ?>
          </td>
          <td style="width:15%">
            <button type="button" class="btn btn-info view" data-toggle="tooltip" title="View Details" id="<?= $request['itsrequest_id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
            <?php
            if ($request['itsrequest_category'] == 'hw') {
              if ($request['itshw_category'] == 'on-site') {
                if ($request['status'] === 'received') {
            ?>
                  <button type="button" class="btn btn-warning pending" data-toggle="tooltip" title="Go" id="<?= $request['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
                <?php
                } else if ($request['status'] == 'pending') {
                ?>
                  <button type="button" class="btn btn-danger pullout" data-toggle="tooltip" title="Pullout" id="<?= $request['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>" hw-id="<?= $request['hwcomponent_id'] ?>"><i class="fa fa-hand-rock-o" aria-hidden="true"></i></button>
                  <button type="button" class="btn btn-success done" data-toggle="tooltip" title="Done" id="<?= $request['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                <?php
                }
              }
            } else if ($request['itsrequest_category'] == 'other') {
              if ($request['status'] === 'received') {
                ?>
                <button type="button" class="btn btn-warning pending" data-toggle="tooltip" title="Do" id="<?= $request['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
              <?php
              } else if ($request['status'] == 'pending') {
              ?>
                <button type="button" class="btn btn-success done" data-toggle="tooltip" title="Done" id="<?= $request['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
            <?php
              }
            }
            ?>
          </td>
        </tr>
      <?php
        $id += 1;
      endforeach;
      ?>
    </tbody>
  </table>
  </div>
  </div>
<?php endif; ?>
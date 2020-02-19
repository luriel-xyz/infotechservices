<?php
//if no requests
if (!$requests) {
?>
  <div class="alert alert-info text-center">
    <?= "No Incoming Request Queued!"; ?>
  </div>
<?php
  //if not empty
} else {
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
      foreach ($requests as $value) {
        $component = $control->getHardwareComponents($value['hwcomponent_sub_id']);
      ?>
        <tr>
          <td> <?= $id ?> </td>
          <td> <?= $value['itsrequest_date'] ?> </td>
          <td> <?= $value['dept_code'] ?> </td>
          <td> <?= $value['emp_fname'] ?> <?= $value['emp_lname'] ?> </td>
          <td style="width:20%">
            <?php
            if ($value['itsrequest_category'] == 'hw') {
              if ($component) {
                echo $value['hwcomponent_name'] . '(' . $component['hwcomponent_name'] . ')' . ' -';
              } else {
                echo $value['hwcomponent_name'] . ' -';
              }
            }
            ?>

            <?= $value['concern'] ?>

          </td>
          <td> <?= $value['status'] ?>
            <?php
            if ($value['statusupdate_useraccount_id']) {
              $userAccount = $control->getUserAccount($value['statusupdate_useraccount_id']);
              $techRepEmployee = $control->getEmployee($userAccount['emp_id']);
              echo 'by ' . '<b>' . $techRepEmployee['emp_fname'] . '</b>';
            }
            ?>
          </td>
          <td style="width:15%">
            <button type="button" class="btn btn-info view" data-toggle="tooltip" title="View Details" id="<?= $value['itsrequest_id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>

            <?php
            if ($value['itsrequest_category'] == 'hw') {

              if ($value['itshw_category'] == 'on-site') {

                if ($value['status'] === 'received') {
            ?>
                  <button type="button" class="btn btn-warning pending" data-toggle="tooltip" title="Go" id="<?= $value['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
                <?php
                } else if ($value['status'] == 'pending') {
                ?>
                  <button type="button" class="btn btn-danger pullout" data-toggle="tooltip" title="Pullout" id="<?= $value['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>" hw-id="<?= $value['hwcomponent_id'] ?>"><i class="fa fa-hand-rock-o" aria-hidden="true"></i></button>
                  <button type="button" class="btn btn-success done" data-toggle="tooltip" title="Done" id="<?= $value['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                <?php
                }
              }
            } else if ($value['itsrequest_category'] == 'other') {
              if ($value['status'] === 'received') {
                ?>
                <button type="button" class="btn btn-warning pending" data-toggle="tooltip" title="Do" id="<?= $value['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
              <?php
              } else if ($value['status'] == 'pending') {
              ?>
                <button type="button" class="btn btn-success done" data-toggle="tooltip" title="Done" id="<?= $value['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
            <?php
              }
            }
            ?>
          </td>
        </tr>
      <?php
        $id += 1;
      }
      ?>
    </tbody>
  </table>
  </div>
  </div>
<?php
}
?>
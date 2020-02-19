<!-- if requests is empty -->
<?php if (!$requests) { ?>
  <div class="alert alert-info text-center">
    <?php echo "No Request Sent!"; ?>
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
      <th>By</th>
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
          <td> <?= $value['status'] ?> </td>
          <td>
            <?php
            if ($value['statusupdate_useraccount_id']) {
              $techRepEmployee = $control->getUserAccount($value['statusupdate_useraccount_id']);
              echo $techRepEmployee['emp_fname'] . ' ' . $techRepEmployee['emp_lname'];
            }
            ?>
          </td>
          <td>
            <button type="button" class="btn btn-primary view" data-toggle="tooltip" title="View Details" id="<?= $value['itsrequest_id'] ?>"><i class="fa fa-eye"></i></button>

            <?php
            if ($value['itsrequest_category'] == 'hw') {

              if ($value['itshw_category'] == 'pulled-out' || $value['itshw_category'] == 'walk-in') {

                if ($value['status'] === 'done') {
                  echo '<button type="button" class="btn btn-success receive" data-toggle="tooltip" title="Receive" id=' . $value["itsrequest_id"] . '><i class="fa fa-hand-rock-o"></i></button>';
                }
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
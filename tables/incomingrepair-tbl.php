<?php
//if repairs is empty

if (!$repairs) {
?>
  <div class="alert alert-info text-center">
    <?= "No Incoming Repair Queued!"; ?>
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
      <th>Hardware & Problem</th>
      <th>Status</th>
      <th>Tech Representative</th>
      <th>Action</th>
    </thead>
    <tbody id="table_body">
      <?php
      $ctr = 1;
      foreach ($repairs as $value) {
        $component = $control->getHardwareComponents($value['hwcomponent_sub_id']);
      ?>
        <tr>
          <td> <?= $ctr ?> </td>
          <td> <?= $value['itsrequest_date'] ?> </td>
          <td> <?= $value['dept_code'] ?> </td>
          <td> <?= $value['emp_fname'] ?> <?= $value['emp_lname'] ?> </td>
          <td> <?= $value['hwcomponent_name'] ?>
            <?php
            if ($component !== 0) {
              foreach ($component as $name) {
            ?>
                (<?= $name['hwcomponent_name'] ?>)
            <?php
              }
            }
            ?>
            - <?= $value['concern'] ?> </td>
          <td> <?= $value['status'] ?> </td>
          <td>
            <?php $getTechRepEmployee = $control->getUserAccount($value['statusupdate_useraccount_id']);
            foreach ($getTechRepEmployee as $val) {
              echo $val['emp_fname'] . ' ' . $val['emp_lname'];
            }
            ?>
          </td>
          <td style="width: 15%">
            <!-- This button will always be visible -->
            <button type="button" class="btn btn-info view" data-toggle="tooltip" title="View Details" id="<?= $value['itsrequest_id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
            <?php
            // If request is received from incoming repairs
            if ($value['status'] === 'received') {
            ?>
              <!-- Show repair button -->
              <button type="button" class="btn btn-warning pending" data-toggle="tooltip" title="Start Repair" id="<?= $value['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
            <?php
            } else if ($value['status'] == 'pending') {
              $techRepEmployee = $control->getUserAccount($value['statusupdate_useraccount_id']);
              $dept_id = $techRepEmployee[0]['dept_id'];
            ?>
              <button type="button" class="btn btn-assessment btn-danger assess" data-toggle="tooltip" title="For Assessment" id="<?= $value['itsrequest_id'] ?>" data-useraccount_id="<?= $_SESSION['useraccount_id'] ?>" data-hwcomponent_id="<?= $value['hwcomponent_id'] ?>" data-dept_id="<?= $value['dept_id'] ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i></button>
              <button type="button" class="btn btn-success done" data-toggle="tooltip" title="Done" id="<?= $value['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></button>
            <?php
              // show assesment form
            } else if ($value['status'] === 'assessment pending') {
            ?>
              <button type="button" class="btn btn-danger assessment-created" data-toggle="tooltip" title="Assessment Created" id="<?= $value['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
            <?php
            } else if ($value['status'] === 'assessed') {
            ?>
              <input type="hidden" name="" value="<?=$value['itsrequest_id']?>">
              <button type="button" class="btn btn-warning pre-inspect" data-toggle="tooltip" title="Pre-Repair Inspect" id="<?= $value['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i></button>
              <?php $assessmentReport = $control->getAssessmentReportByRequestId($value['itsrequest_id']); ?>
              <button type="button" class="btn btn-secondary btn-print-assessment" data-toggle="tooltip" title="Print Assessment Form" data-assessment-report-id="<?= $assessmentReport['repassessreport_id'] ?>"><i class="fa fa-print" aria-hidden="true"></i></button>
            <?php
              // show
            } else if ($value['status'] === 'pre-repair inspected') {
            ?>
              <button type="button" class="btn btn-warning post-inspect" data-toggle="tooltip" title="Post-Repair Inspect" id="<?= $value['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></button>
            <?php
            } else if ($value['status'] === 'post-repair inspected') {
            ?>
              <button type="button" class="btn btn-success done" data-toggle="tooltip" title="Done" id="<?= $value['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></button>
            <?php
            }
            ?>
          </td>
        </tr>
      <?php
        $ctr += 1;
      }
      ?>
    </tbody>
  </table>
  </div>
  </div>
<?php
}
?>
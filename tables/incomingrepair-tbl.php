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
      $id = 1;
      foreach ($repairs as $repair) {
        $component = $control->getHardwareComponents($repair['hwcomponent_sub_id']);
      ?>
        <tr>
          <td> <?= $id ?> </td>
          <td> <?= $repair['itsrequest_date'] ?> </td>
          <td> <?= $repair['dept_code'] ?> </td>
          <td> <?= $repair['emp_fname'] ?> <?= $repair['emp_lname'] ?> </td>
          <td> <?= $repair['hwcomponent_name'] ?>
            <?php if ($component) : ?>
              (<?= $component['hwcomponent_name'] ?>)
            <?php endif; ?>
            - <?= $repair['concern'] ?> </td>
          <td> <?= $repair['status'] ?> </td>
          <td>
            <?php
            $techRecEmployee = $control->getUserAccount($repair['statusupdate_useraccount_id']);
            echo $techRecEmployee['emp_fname'] . ' ' . $techRecEmployee['emp_lname'];
            ?>
          </td>
          <td style="width: 15%">
            <!-- This button will always be visible -->
            <button type="button" class="btn btn-info view" data-toggle="tooltip" title="View Details" id="<?= $repair['itsrequest_id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
            <?php
            // If request is received from incoming repairs
            if ($repair['status'] === 'received') {
            ?>
              <!-- Show repair button -->
              <button type="button" class="btn btn-warning pending" data-toggle="tooltip" title="Start Repair" id="<?= $repair['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
            <?php
            } else if ($repair['status'] == 'pending') {
              $techRepEmployee = $control->getUserAccount($repair['statusupdate_useraccount_id']);
              $dept_id = $techRepEmployee['dept_id'];
            ?>
              <button type="button" class="btn btn-assessment btn-danger assess" data-toggle="tooltip" title="For Assessment" id="<?= $repair['itsrequest_id'] ?>" data-useraccount_id="<?= $_SESSION['useraccount_id'] ?>" data-hwcomponent_id="<?= $repair['hwcomponent_id'] ?>" data-dept_id="<?= $repair['dept_id'] ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i></button>
              <button type="button" class="btn btn-success done" data-toggle="tooltip" title="Done" id="<?= $repair['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></button>
            <?php
              // show assesment form
            } else if ($repair['status'] === 'assessment pending') {
            ?>
              <button type="button" class="btn btn-danger assessment-created" data-toggle="tooltip" title="Assessment Created" id="<?= $repair['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
            <?php
            } else if ($repair['status'] === 'assessed') {
            ?>
              <input type="hidden" name="" value="<?= $repair['itsrequest_id'] ?>">
              <button type="button" class="btn btn-warning pre-post-inspect" data-toggle="tooltip" title="Pre And Post Repair Inspect" id="<?= $repair['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i></button>
              <?php $assessmentReport = $control->getAssessmentReportByRequestId($repair['itsrequest_id']); ?>
              <button type="button" class="btn btn-secondary btn-print-assessment" data-toggle="tooltip" title="Print Assessment Form" data-assessment-report-id="<?= $assessmentReport['repassessreport_id'] ?>"><i class="fa fa-print" aria-hidden="true"></i></button>
              <?php
              // show
              // } else if ($repair['status'] === 'pre-repair inspected') {
              // 
              ?>
              <!-- <button type="button" class="btn btn-warning post-inspect" data-toggle="tooltip" title="Post-Repair Inspect" id="<?= $repair['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></button> -->
              <?php
              // } else if ($repair['status'] === 'post-repair inspected') {
              // 
              ?>
              <!-- <button type="button" class="btn btn-success done" data-toggle="tooltip" title="Done" id="<?= $repair['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></button> -->
              <?php
              // }
              // 
              ?>
            <?php } else if ($repair['status'] === 'pre-post-repair inspected') { ?>
              <button type="button" class="btn btn-success done" data-toggle="tooltip" title="Done" id="<?= $repair['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></button> -->
            <?php } ?>
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
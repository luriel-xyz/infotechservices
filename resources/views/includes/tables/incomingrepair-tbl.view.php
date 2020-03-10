<?php
//if repairs is empty
if (!$repairs) :
?>
  <div class="alert alert-info text-center">
    <?= "No Incoming Repair Queued!"; ?>
  </div>
<?php
//if not empty
else :
?>
  <table class="table text-center">
    <thead class="blue-grey lighten-4">
      <th>Date</th>
      <th>Department</th>
      <th>Employee Name</th>
      <th>Hardware & Problem</th>
      <th>Status</th>
      <th>Tech Representative</th>
      <th>Action</th>
    </thead>
    <tbody id="table_body">
      <?php foreach ($repairs as $repair) :
        $component = App\Hardware::find($repair->hwcomponent_sub_id);
        $assessmentReport = App\Assessment::getAssessmentReportByRequestId($repair->itsrequest_id);
        $techRecUser = App\User::find($repair->statusupdate_useraccount_id);
        $techRecEmployee = App\Employee::find($techRecUser->emp_id);
        $dept_id = $techRecEmployee->dept_id;
      ?>
        <tr>
          <td> <small><?= date('M d, Y h:i a', strtotime($repair->itsrequest_date)) ?></small></td>
          <td> <?= $repair->dept_code ?> </td>
          <td> <?= $repair->emp_fname ?> <?= $repair->emp_lname ?> </td>
          <td>
            <span class="font-weight-bold"><?= $repair->hwcomponent_name ?></span>
            <!-- </?php if ($component) : ?>
              (</?= $component->hwcomponent_name ?>)
            </?php endif; ?> -->
            <!-- Show view concern button if concern length exceeds 20 -->
            <?php if (strlen($repair->concern) >= 20) : ?>
              <!-- View concern button -->
              <small><a href="#" class="btn-view-concern btn-link underlined d-block" data-id="<?= $repair->itsrequest_id ?>">View concern</a></small>
              <!-- /# View concern button -->
            <?php else : ?>
              - <?= $repair->concern ?>
            <?php endif; ?>
          </td>
          <td>
            <?php if ($repair->status === 'assessment pending') : ?>
              <span class="badge p-1 badge-warning"><?= $repair->status ?></span>
            <?php elseif ($repair->status === 'deployed') : ?>
              <span class="badge p-1 badge-info"><?= $repair->status ?></span>
            <?php elseif ($repair->status === 'done') : ?>
              <span class="badge p-1 badge-success"><?= $repair->status ?></span>
            <?php elseif ($repair->status === 'pending') : ?>
              <span class="badge p-1 badge-warning"><?= $repair->status ?></span>
            <?php elseif ($repair->status === 'received') : ?>
              <span class="badge p-1 badge-info"><?= $repair->status ?></span>
            <?php elseif ($repair->status === 'assessed') : ?>
              <span class="badge p-1 badge-success"><?= $repair->status ?></span>
            <?php elseif ($repair->status === 'pre-post-repair inspected') : ?>
              <span class="badge p-1 badge-secondary"><?= $repair->status ?></span>
            <?php endif; ?>
          </td>
          <td>
            <?= "{$techRecEmployee->emp_fname} {$techRecEmployee->emp_lname}" ?>
          </td>
          <td style="width: 15%">
            <!-- Dropdown button -->
            <div class="dropdown">
              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="text-capitalize"><i class="fas fa-list"></i></span>
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuMenu">
                <button type="button" class="dropdown-item view-repair" data-toggle="tooltip" id="<?= $repair->itsrequest_id ?>">View Details</button>
                <?php
                // If request is received from incoming repairs
                if ($repair->status === 'received') : ?>
                  <!-- Show repair button -->
                  <button type="button" class="dropdown-item pending" data-toggle="tooltip" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>">Start Repair</button>
                <?php
                elseif ($repair->status == 'pending') :
                ?>
                  <button type="button" class="dropdown-item btn-assessment assess" data-toggle="tooltip" id="<?= $repair->itsrequest_id ?>" data-useraccount_id="<?= user()->useraccount_id ?>" data-hwcomponent_id="<?= $repair->hwcomponent_id ?>" data-dept_id="<?= $repair->dept_id ?>">Create assessment form</button>
                  <button type="button" class="dropdown-item done-repair" data-toggle="tooltip" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>">Done</button>
                <?php
                // show assesment form 
                elseif ($repair->status === 'assessment pending') : ?>
                  <button type="button" class="dropdown-item assessment-created" data-toggle="tooltip" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>">Assessment Created</button>
                <?php elseif ($repair->status === 'assessed') : ?>
                  <input type="hidden" name="" value="<?= $repair->itsrequest_id ?>">
                  <button type="button" class="dropdown-item pre-post-inspect" data-toggle="tooltip" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>" data-assessment-report-id="<?= $assessmentReport->repassessreport_id ?>">Pre and Post</button>
                  <button type="button" class="dropdown-item btn-print-assessment" data-toggle="tooltip" data-assessment-report-id="<?= $assessmentReport->repassessreport_id ?>">Print Assessment Form</button>
                  <?php
                  // show
                  // } else if ($repair['status'] === 'pre-repair inspected') {
                  // 
                  ?>
                  <!-- <button type="button" class="dropdown-item btn-warning post-inspect" data-toggle="tooltip" title="Post-Repair Inspect" id="</?= $repair['itsrequest_id'] ?>" data-id="</?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></button> -->
                  <?php
                  // } else if ($repair['status'] === 'post-repair inspected') {
                  // 
                  ?>
                  <!-- <button type="button" class="dropdown-item btn-success done-repair" data-toggle="tooltip" title="Done" id="</?= $repair['itsrequest_id'] ?>" data-id="</?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></button> -->
                  <?php
                  // }
                  // 
                  ?>
                <?php elseif ($repair->status === 'pre-post-repair inspected') : ?>
                  <button type="button" class="dropdown-item done-repair" data-toggle="tooltip" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>">Done</button>
                  <button type="button" class="dropdown-item btn-print-assessment" data-toggle="tooltip" data-assessment-report-id="<?= $assessmentReport->repassessreport_id ?>">Print Assessment Report</button>
                  <button type="button" class="dropdown-item btn-print-inspection-report" data-toggle="tooltip" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>" data-assessment-report-id="<?= $assessmentReport->repassessreport_id ?>">Print Inspection Report</button>
                <?php elseif ($repair->status === 'done') : ?>
                  <button type="button" class="dropdown-item btn-print-assessment" data-toggle="tooltip" data-assessment-report-id="<?= $assessmentReport->repassessreport_id ?>">Print Assessment Report</button>
                  <button type="button" class="dropdown-item btn-print-inspection-report" data-toggle="tooltip" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>" data-assessment-report-id="<?= $assessmentReport->repassessreport_id ?>">Print Inspection Report</button>
                <?php endif; ?>
              </div>
            </div>
            <!-- /# Dropdown button -->
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  </div>
<?php endif; ?>
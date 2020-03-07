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
      foreach ($repairs as $repair) :
        $component = App\Hardware::getHardwareComponents($repair->hwcomponent_sub_id);
        $assessmentReport = App\Assessment::getAssessmentReportByRequestId($repair->itsrequest_id);
        $techRecUser = App\User::getUserAccount($repair->statusupdate_useraccount_id);
        $techRecEmployee = App\Employee::getEmployee($techRecUser->emp_id);
        $dept_id = $techRecEmployee->dept_id;
      ?>
        <tr>
          <td> <small><?= $id ?></small></td>
          <td> <small><?= date('M d, Y h:i a', strtotime($repair->itsrequest_date)) ?></small></td>
          <td> <?= $repair->dept_code ?> </td>
          <td> <?= $repair->emp_fname ?> <?= $repair->emp_lname ?> </td>
          <td>
            <span class="font-weight-bold"><?= $repair->hwcomponent_name ?></span>
            <!-- </?php if ($component) : ?>
              (</?= $component->hwcomponent_name ?>)
            </?php endif; ?> -->
            <small><a href="#" class="btn-view-concern btn-link underlined d-block" data-id="<?= $repair->itsrequest_id ?>">View problem</a></small>
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
            <!-- This button will always be visible -->
            <button type="button" class="btn btn-sm btn-info view-repair" data-toggle="tooltip" title="View Details" id="<?= $repair->itsrequest_id ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
            <?php
            // If request is received from incoming repairs
            if ($repair->status === 'received') :
            ?>
              <!-- Show repair button -->
              <button type="button" class="btn btn-sm btn-warning pending" data-toggle="tooltip" title="Start Repair" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>"><i class="fas fa-arrow-circle-right" aria-hidden="true"></i></button>
            <?php
            elseif ($repair->status == 'pending') :
            ?>
              <button type="button" class="btn btn-sm btn-assessment btn-danger assess" data-toggle="tooltip" title="For Assessment" id="<?= $repair->itsrequest_id ?>" data-useraccount_id="<?= user()->useraccount_id ?>" data-hwcomponent_id="<?= $repair->hwcomponent_id ?>" data-dept_id="<?= $repair->dept_id ?>"><i class="fas fa-file" aria-hidden="true"></i></button>
              <button type="button" class="btn btn-sm btn-success done-repair" data-toggle="tooltip" title="Done" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>"><i class="fa fa-check" aria-hidden="true"></i></button>
            <?php
            // show assesment form 
            elseif ($repair->status === 'assessment pending') :
            ?>
              <button type="button" class="btn btn-sm btn-danger assessment-created" data-toggle="tooltip" title="Assessment Created" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
            <?php
            elseif ($repair->status === 'assessed') :
            ?>
              <input type="hidden" name="" value="<?= $repair->itsrequest_id ?>">
              <button type="button" class="btn btn-sm btn-warning pre-post-inspect" data-toggle="tooltip" title="Pre And Post Repair Inspect" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>" data-assessment-report-id="<?= $assessmentReport->repassessreport_id ?>"><i class="fas fa-file" aria-hidden="true"></i></button>
              <button type="button" class="btn btn-sm btn-secondary btn-print-assessment" data-toggle="tooltip" title="Print Assessment Form" data-assessment-report-id="<?= $assessmentReport->repassessreport_id ?>"><i class="fa fa-print" aria-hidden="true"></i></button>
              <?php
              // show
              // } else if ($repair['status'] === 'pre-repair inspected') {
              // 
              ?>
              <!-- <button type="button" class="btn btn-sm btn-warning post-inspect" data-toggle="tooltip" title="Post-Repair Inspect" id="</?= $repair['itsrequest_id'] ?>" data-id="</?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></button> -->
              <?php
              // } else if ($repair['status'] === 'post-repair inspected') {
              // 
              ?>
              <!-- <button type="button" class="btn btn-sm btn-success done-repair" data-toggle="tooltip" title="Done" id="</?= $repair['itsrequest_id'] ?>" data-id="<?= $_SESSION['useraccount_id'] ?>"><i class="fa fa-check" aria-hidden="true"></i></button> -->
              <?php
              // }
              // 
              ?>
            <?php elseif ($repair->status === 'pre-post-repair inspected') : ?>
              <button type="button" class="btn btn-sm btn-success done-repair" data-toggle="tooltip" title="Done" id="<?= $repair->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>"><i class="fa fa-check" aria-hidden="true"></i></button>
            <?php endif; ?>
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
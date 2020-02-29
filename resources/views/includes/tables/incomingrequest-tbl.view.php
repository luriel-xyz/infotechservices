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
        $component = App\Hardware::getHardwareComponents($request->hwcomponent_sub_id);
        $userAccount = App\User::getUserAccount($request->statusupdate_useraccount_id);
        // $techRepEmployee = App\Employee::getEmployee($userAccount->emp_id);
      ?>
        <tr>
          <td> <small><?= $id ?></small></td>
          <td> <small><?= date_format(date_create($request->itsrequest_date), "M d, Y h:i a") ?></small></td>
          <td> <?= $request->dept_code ?> </td>
          <td> <?= $request->emp_fname ?> <?= $request->emp_lname ?> </td>
          <td style="width:20%">
            <!-- Hardware component name -->
            <?php
            if ($request->hwcomponent_name) {
              echo $request->hwcomponent_name . ' -';
            }
            ?>
            <!-- /# Hardware component name -->

            <?= $request->concern ?>

          </td>
          <td>
            <span class="badge badge-default"><?= $request->status ?></span>

            <!-- </?php if ($request->statusupdate_useraccount_id) : ?> -->
            <!-- <small class="font-italic">by </?= $techRepEmployee->emp_fname ?></small> -->
            <!-- </?php endif; ?> -->
          </td>
          <td style="width:15%">
            <button type="button" class="btn btn-sm btn-info view-request" data-toggle="tooltip" title="View Details" id="<?= $request->itsrequest_id ?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
            <?php
            if ($request->itsrequest_category == 'hw') {
              if ($request->itshw_category == 'on-site') {
                if ($request->status === 'received') {
            ?>
                  <button type="button" class="btn btn-sm btn-warning pending" data-toggle="tooltip" title="Go" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>"><i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                <?php
                } else if ($request->status == 'pending') {
                ?>
                  <button type="button" class="btn btn-sm btn-danger pullout" data-toggle="tooltip" title="Pullout" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>" hw-id="<?= $request->hwcomponent_id ?>"><i class="fa fa-hand-rock" aria-hidden="true"></i></button>
                  <button type="button" class="btn btn-sm btn-success done-request" data-toggle="tooltip" title="Done" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>"><i class="fas fa-check-circle" aria-hidden="true"></i></button>
                <?php
                }
              }
            } else if ($request->itsrequest_category == 'other') {
              if ($request->status === 'received') {
                ?>
                <button type="button" class="btn btn-sm btn-warning pending" data-toggle="tooltip" title="Do" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>"><i class="fas fa-arrow-right" aria-hidden="true"></i></button>
              <?php
              } else if ($request->status == 'pending') {
              ?>
                <button type="button" class="btn btn-sm btn-success done-request" data-toggle="tooltip" title="Done" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>"><i class="fas fa-check-circle-o" aria-hidden="true"></i></button>
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
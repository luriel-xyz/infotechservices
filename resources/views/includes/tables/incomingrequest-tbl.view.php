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
  <table class="table text-center">
    <thead class="blue-grey lighten-4">
      <th>Date</th>
      <th>Department</th>
      <th>Employee Name</th>
      <th>Concern</th>
      <th>Status</th>
      <th>Action</th>
    </thead>
    <tbody id="table_body">
      <?php foreach ($requests as $request) :
        $component = App\Hardware::find($request->hwcomponent_sub_id);
        $userAccount = App\User::find($request->statusupdate_useraccount_id);
        // $techRepEmployee = App\Employee::getEmployee($userAccount->emp_id);
      ?>
        <tr>
          <td> <small><?= date_format(date_create($request->itsrequest_date), "M d, Y h:i a") ?></small></td>
          <td> <?= $request->dept_code ?> </td>
          <td> <?= $request->emp_fname ?> <?= $request->emp_lname ?> </td>
          <td style="width:20%">
            <!-- Hardware component name -->
            <?php if ($request->hwcomponent_name) : ?>
              <span class="font-weight-bold"><?= $request->hwcomponent_name ?></span>
            <?php endif; ?>
            <!-- /# Hardware component name -->

            <!-- </?= $request->concern ?> -->
            <!-- Show view concern button if concern length exceeds 20 -->
            <?php if (strlen($request->concern) >= 20) : ?>
              <!-- View concern button -->
              <small><a href="#" class="btn-view-concern btn-link underlined d-block" data-id="<?= $request->itsrequest_id ?>">View concern</a></small>
              <!-- /# View concern button -->
            <?php else : ?>
              - <?= $request->concern ?>
            <?php endif; ?>
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
                  <button type="button" class="btn btn-sm btn-warning pending" data-toggle="tooltip" title="Receive Request" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>"><i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                <?php
                } else if ($request->status == 'pending') {
                ?>
                  <button type="button" class="btn btn-sm btn-danger pullout" data-toggle="tooltip" title="Pullout" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>" hw-id="<?= $request->hwcomponent_id ?>"><i class="fa fa-hand-rock" aria-hidden="true"></i></button>
                  <button type="button" class="btn btn-sm btn-success done-request" data-toggle="tooltip" title="Done" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>"><i class="fas fa-check" aria-hidden="true"></i></button>
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
                <button type="button" class="btn btn-sm btn-success done-request" data-toggle="tooltip" title="Done" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>"><i class="fas fa-check" aria-hidden="true"></i></button>
            <?php
              }
            }
            ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  </div>
<?php endif; ?>
<?php
//if no requests
if (!$requests) :
?>
  <div class="alert alert-info text-center">
    <?= "There are no requests."; ?>
  </div>
<?php
//if not empty
else :
?>
  <table class="table table-hover text-center">
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
            <!-- Dropdown button -->
            <div class="dropdown">
              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="text-capitalize"><i class="fas fa-list"></i></span>
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuMenu">
                <button type="button" class="dropdown-item view-request" data-toggle="tooltip" id="<?= $request->itsrequest_id ?>">View Details</button>
                <?php
                if ($request->itsrequest_category == 'hw') {
                  if ($request->itshw_category == 'on-site') {
                    if ($request->status === 'received') {
                ?>
                      <button type="button" class="dropdown-item pending" data-toggle="tooltip" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>">Receive Request</button>
                    <?php
                    } else if ($request->status == 'pending') {
                    ?>
                      <button type="button" class="dropdown-item pullout" data-toggle="tooltip" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>" hw-id="<?= $request->hwcomponent_id ?>">Pullout</button>
                      <button type="button" class="dropdown-item done-request" data-toggle="tooltip" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>">Done</button>
                    <?php
                    }
                  }
                } else if ($request->itsrequest_category == 'other') {
                  if ($request->status === 'received') {
                    ?>
                    <button type="button" class="dropdown-item pending" data-toggle="tooltip" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>">Do</button>
                  <?php
                  } else if ($request->status == 'pending') {
                  ?>
                    <button type="button" class="dropdown-item done-request" data-toggle="tooltip" id="<?= $request->itsrequest_id ?>" data-id="<?= user()->useraccount_id ?>">Done</button>
                <?php
                  }
                }
                ?>
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
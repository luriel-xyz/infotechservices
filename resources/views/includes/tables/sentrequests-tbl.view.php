<!-- if requests is empty -->
<?php if (!$requests) : ?>
  <div class="alert alert-info text-center">
    <?= "No Request Sent!"; ?>
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
      <th>By</th>
      <th>Action</th>
    </thead>
    <tbody id="table_body">
      <?php
      $id = 1;
      foreach ($requests as $request) :
      ?>
        <tr>
          <!-- Id column -->
          <td> <?= $id ?> </td>
          <!-- /# Id column -->
          <!-- Date column -->
          <td>
            <small><?= date('M d, Y h:i a', strtotime($request->itsrequest_date)) ?></small>
          </td>
          <!-- /# Date column -->
          <td> <?= $request->dept_code ?> </td>
          <td> <?= $request->emp_fname ?> <?= $request->emp_lname ?> </td>
          <td style="width: 20%">
            <?php if ($request->itsrequest_category == 'hw') : ?>
              <?= $request->hwcomponent_name . ' -' ?>
            <?php endif; ?>
            <?= $request->concern ?>
          </td>
          <td>
            <?php if ($request->status == 'received') : ?>
              <span class="text-info"><?= $request->status ?></span>
            <?php elseif ($request->status == 'pending') : ?>
              <span class="text-warning"><?= $request->status ?></span>
            <?php elseif ($request->status == 'done') : ?>
              <span class="text-success"><?= $request->status ?></span>
            <?php else : ?>
              <span class="text-secondary"><?= $request->status ?></span>
            <?php endif; ?>
          </td>
          <td>
            <?php
            if ($request->statusupdate_useraccount_id) {
              $techRepEmployee = App\User::getUserAccount($request->statusupdate_useraccount_id);
              echo "{$techRepEmployee->emp_fname} {$techRepEmployee->emp_lname}";
            } else {
              echo 'None';
            }
            ?>
          </td>
          <td>
            <button type="button" class="btn btn-sm btn-primary view-sent-request" data-toggle="tooltip" title="View Details" id="<?= $request->itsrequest_id ?>"><i class="fa fa-eye"></i></button>
            <?php
            if ($request->itsrequest_category == 'hw') {
              if ($request->itshw_category == 'pulled-out' || $request->itshw_category == 'walk-in') {
                if ($request->status === 'done') {
                  echo '<button type="button" class="btn btn-sm btn-success receive" data-toggle="tooltip" title="Receive" id=' . $request->itsrequest_id . '><i class="fa fa-hand-rock-o"></i></button>';
                }
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
<!-- if requests is empty -->
<?php if (!$requests) : ?>
  <div class="alert alert-info text-center">
    <?= "No Request Sent!"; ?>
  </div>
<?php
//if not empty
else :
?>
  <table class="table table-hover text-center">
    <thead class="blue-grey lighten-4">
      <th>#</th>
      <th>Date</th>
      <th>Employee</th>
      <th>Concern</th>
      <th>Status</th>
      <th>IT Rep</th>
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
          <!-- Employee column -->
          <td>
            <?= "{$request->emp_fname} {$request->emp_lname}" ?>
          </td>
          <!-- /# Employee column -->
          <!-- Concern column -->
          <td style="width: 20%">
            <?php if ($request->itsrequest_category == 'hw') : ?>
              <span class="font-weight-bold"><?= $request->hwcomponent_name ?></span>
            <?php endif; ?>

            <!-- Show view concern button if concern length exceeds 20 -->
            <?php if (strlen($request->concern) >= 20) : ?>
              <!-- View concern button -->
              <small><a href="#" class="btn-view-concern btn-link underlined d-block" data-id="<?= $request->itsrequest_id ?>">View concern</a></small>
              <!-- /# View concern button -->
            <?php else : ?>
              - <?= $request->concern ?>
            <?php endif; ?>
          </td>
          <!-- /# Concern column -->
          <!-- Status column -->
          <td>
            <?php if ($request->status == 'received') : ?>
              <span class="text-info"><?= 'Sent' ?></span>
            <?php elseif ($request->status == 'pending') : ?>
              <span class="text-warning"><?= $request->status ?></span>
            <?php elseif ($request->status == 'done') : ?>
              <span class="text-success"><?= $request->status ?></span>
            <?php else : ?>
              <span class="text-secondary"><?= $request->status ?></span>
            <?php endif; ?>
          </td>
          <!-- /# Status column -->
          <!-- IT rep column -->
          <td>
            <?php
            if ($request->statusupdate_useraccount_id) {
              $techRepEmployee = App\User::find($request->statusupdate_useraccount_id);
              echo "{$techRepEmployee->emp_fname} {$techRepEmployee->emp_lname}";
            } else {
              echo 'n/a';
            }
            ?>
          </td>
          <!-- /# IT rep column -->
          <!-- Action column -->
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
          <!-- /# Action column -->
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
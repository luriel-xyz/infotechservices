<?php
//if users is empty
if (!$useraccounts) :
?>
  <div class="alert alert-info text-center">
    <?= "No Data Found!"; ?>
  </div>
<?php
//if not empty
else :
?>
  <table class="table table-bordered table-hover text-center">
    <thead class="">
      <th>#</th>
      <th>Username</th>
      <th>Employee/Department Name</th>
      <th>User Type</th>
      <th style="width: 15%">Action</th>
    </thead>
    <tbody id="table_body">
      <?php
      $id = 1;
      foreach ($useraccounts as $user) :
      ?>
        <tr>
          <td> <?= $id ?> </td>
          <td> <?= $user->username ?> </td>
          <td> <?= $user->emp_fname ?> <?= $user->emp_lname ?> <?= $user->dept_name ?> </td>
          <td> <?= $user->usertype ?> </td>
          <td>
            <button type="button" class="btn btn-sm btn-primary edit-user" id="<?= $user->useraccount_id ?>" data-toggle="tooltip" title="Edit"><i class="fas fa-pen-square" aria-hidden="true"></i></button>
            <?php if ($user->status === '1') : ?>
              <button type="button" class="btn btn-sm btn-danger disable" id="<?= $user->useraccount_id ?>" data-toggle="tooltip" title="Disable"><i class="fas fa-user-times" aria-hidden="true"></i></button>
            <?php else : ?>
              <button type="button" class="btn btn-sm btn-success enable" id="<?= $user->useraccount_id ?>" data-toggle="tooltip" title="Enable"><i class="fas fa-user-circle" aria-hidden="true"></i></button>
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
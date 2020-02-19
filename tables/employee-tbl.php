<?php
//if employees is empty
if (!$employees) {
?>
  <div class="alert alert-info text-center">
    <?= "No Data Found!"; ?>
  </div>
<?php
  //if not empty
} else {
?>
  <table class="table table-bordered text-center">
    <thead class="">
      <th>#</th>
      <th>Department Code</th>
      <th>Employee ID</th>
      <th>Employee Name</th>
      <th>Position</th>
      <th>Action</th>
    </thead>
    <tbody id="table_body">
      <?php
      $id = 1;
      foreach ($employees as $employee) {
      ?>
        <tr>
          <td> <?= $id ?> </td>
          <td> <?= $employee['dept_code'] ?> </td>
          <td> <?= $employee['emp_idnum'] ?> </td>
          <td> <?= $employee['emp_fname'] ?> <?= $employee['emp_lname'] ?> </td>
          <td> <?= $employee['emp_position'] ?> </td>
          <td>
            <button type="button" class="btn btn-primary edit" id="<?= $employee['emp_id'] ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
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
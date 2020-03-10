<?php
//if employees is empty
if (!$employees) :
?>
  <div class="alert alert-info text-center">
    <?= "No Data Found!"; ?>
  </div>
<?php
//if not empty
else :
?>
  <table class="table table-hover text-center">
    <thead class="blue-grey lighten-4">
      <th>Department Code</th>
      <th>Employee ID</th>
      <th>Employee Name</th>
      <th>Position</th>
      <th>Action</th>
    </thead>
    <tbody id="table_body">
      <?php foreach ($employees as $employee) : ?>
        <tr>
          <td class="font-weight-bold"> <?= $employee->dept_code ?> </td>
          <td> <?= $employee->emp_idnum ?> </td>
          <td> <?= $employee->emp_fname ?> <?= $employee->emp_lname ?> </td>
          <td> <?= $employee->emp_position ?> </td>
          <td>
            <button type="button" class="btn btn-sm btn-primary edit-employee" id="<?= $employee->emp_id ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pen-square" aria-hidden="true"></i></button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  </div>
<?php
endif;
?>
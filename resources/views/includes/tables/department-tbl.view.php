<?php
//if departments is empty
if (!$departments) :
?>
  <div class="alert alert-info text-center">
    <?= "No Data Found!"; ?>
  </div>
<?php
//if not empty
else :
?>
  <table class="table table-bordered table-hover text-center">
    <thead>
      <th>#</th>
      <th>Department Code</th>
      <th>Department Name</th>
      <th>Action</th>
    </thead>
    <tbody id="table_body">
      <?php
      $id = 1;
      foreach ($departments as $department) :
      ?>
        <tr>
          <td> <?= $id ?> </td>
          <td> <?= $department->dept_code ?> </td>
          <td> <?= $department->dept_name ?> </td>
          <td>
            <button type="button" class="btn btn-sm waves-effect btn-primary edit-department" id="<?= $department->dept_id ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pen-square" aria-hidden="true"></i></button>
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
<?php
endif;
?>
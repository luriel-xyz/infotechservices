<?php
//if users is empty
if($departments == 0 || $departments == false){
?>
  <div class="alert alert-info text-center">
    <?php echo "No Data Found!"; ?>
  </div>
<?php
//if not empty
}else{
?>
    <table class="table table-bordered text-center">
      <thead class="">
        <th>#</th>
        <th>Department Code</th>
        <th>Department Name</th>
        <th>Action</th>
      </thead>
      <tbody id="table_body">
        <?php
        $ctr = 1;
        foreach ($departments as $key => $value) {
        ?>
        <tr>
          	<td> <?=$ctr?> </td>
          	<td> <?=$value['dept_code']?> </td>
            <td> <?=$value['dept_name']?> </td>
            <td> 
                <button type="button" class="btn btn-primary edit" id="<?=$value['dept_id']?>"  data-toggle="tooltip" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            </td>
        </tr>
        <?php 
        $ctr+=1; 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<?php
}
?>
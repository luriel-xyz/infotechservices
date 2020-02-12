<?php
//if users is empty
if($useraccounts == 0 || $useraccounts == false){
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
        <th>Username</th>
        <th>Employee/Department Name</th>
        <th>User Type</th>
        <th>Action</th>
      </thead>
      <tbody id="table_body">
        <?php
        $ctr = 1;
        foreach ($useraccounts as $key => $value) {
        ?>
        <tr>
          	<td> <?=$ctr?> </td>
          	<td> <?=$value['username']?> </td>
            <td> <?=$value['emp_fname']?> <?=$value['emp_lname']?> <?=$value['dept_name']?> </td>
      	    <td> <?=$value['usertype']?> </td>
            <td> 
               
                <button type="button" class="btn btn-primary edit" id="<?=$value['useraccount_id']?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                
                <?php
                if($value['status'] === '1'){
                	echo '<button type="button" class="btn btn-danger disable" id='.$value["useraccount_id"].' data-toggle="tooltip" title="Disable"><i class="fa fa-user-times" aria-hidden="true"></i></button>';
                }else{
                	echo '<button type="button" class="btn btn-success enable" id='.$value["useraccount_id"].' data-toggle="tooltip" title="Enable"><i class="fa fa-user-circle-o" aria-hidden="true"></i></button>';
                }
               	?>
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
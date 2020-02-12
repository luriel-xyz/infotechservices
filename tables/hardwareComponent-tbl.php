<?php
//if users is empty
if($hardware_components == 0 || $hardware_components == false){
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
        <th>Hardware Component Name</th>
        <th>Hardware Component Type</th>
        <th>Hardware Sub Component Category</th>
        <th>Action</th>
      </thead>
      <tbody id="table_body">
        <?php
        $ctr = 1;
        foreach ($hardware_components as $key => $value) {
          if($value['hwcomponent_type'] === 'sub'){
            $hwcomponent_categoryname = $control->getHardwareComponents($value['hwcomponent_category']);
          }
        ?>
        <tr>
          	<td> <?=$ctr?> </td>
          	<td> <?=$value['hwcomponent_name']?> </td>
            <td> <?=$value['hwcomponent_type']?> </td>
            <td>
            <?php
            if($value['hwcomponent_type'] === 'sub'){
              if($hwcomponent_categoryname !== 0 && $hwcomponent_categoryname !== NULL && $hwcomponent_categoryname !== ""){
                foreach ($hwcomponent_categoryname as $name) {
                  echo $name['hwcomponent_name'];
                }
              }
            }
            ?>
            </td>
            <td> 
                <button type="button" class="btn btn-primary edit" id="<?=$value['hwcomponent_id']?>" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
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
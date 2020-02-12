<?php
//if users is empty
if($reports == 0 || $reports == false){
?>
  <div class="alert alert-info text-center">
    <?php echo "No Incoming Request Queued!"; ?>
  </div>
<?php
//if not empty
}else{
?>
    <table class="table table-bordered text-center">
      <thead>
        <th>#</th>
        <th>Assessment Date</th>
        <th>Action</th>
      </thead>
      <tbody id="table_body">
        <?php
        $ctr = 1;
        foreach ($reports as $key => $value) {
        ?>
        <tr>
          	<td> <?=$ctr?> </td>
          	<td> <?=$value['assessment_date']?> </td>
            <td style="width:15%"> 
                <button type="button" class="btn btn-info view" id="<?=$value['repassessreport_id']?>">Print</button>
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
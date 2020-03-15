<!-- Post-repair inspection section -->
<h2 class="subtitle-1 text-uppercase mb-1">Post-repair inspection findings</h2>
<p class="body-1"><?= $postRepairFindings ?></p>
<!-- /# Post-repair inspection section -->
<div class="p-1 px-3 d-flex flex-wrap bg-grey mx-4">
  <div class="d-flex align-items-center">
    <div class="checkbox d-flex align-items-center justify-content-center text-center">
      <?php if ($postRepairInspectionReport->stock) : ?>
        <i class="fas fa-circle font-size-x-small"></i>
      <?php endif; ?>
    </div>
    <span class="body-2 font-weight-bold">Stock / Supplies from PGO-IT</span>
  </div>
  <div class="d-flex ml-2 align-items-center">
    <div class="checkbox d-flex align-items-center justify-content-center text-center">
      <?php if ($postRepairInspectionReport->ics_no) : ?>
        <i class="fas fa-circle font-size-x-small"></i>
      <?php endif; ?>
    </div>
    <span class="checkbox-label font-weight-bold mr-2">ICS Number: </span>
    <span class="caption"><?= $postRepairInspectionReport->ics_no ?></span>
  </div>
  <div class="d-flex ml-2 align-items-center mt-1">
    <div class="checkbox d-flex align-items-center justify-content-center text-center">
      <?php if ($postRepairInspectionReport->inventory_item_no) : ?>
        <i class="fas fa-circle font-size-x-small"></i>
      <?php endif; ?>
    </div>
    <span class="checkbox-label font-weight-bold mr-2">Inventory Item No:</span>
    <span class="caption"><?= $postRepairInspectionReport->inventory_item_no ?></span>
  </div>
  <div class="d-flex ml-2 align-items-center mt-1">
    <div class="checkbox d-flex align-items-center justify-content-center text-center">
      <?php if ($postRepairInspectionReport->serial_no) : ?>
        <i class="fas fa-circle font-size-x-small"></i>
      <?php endif; ?>
    </div>
    <span class="checkbox-label font-weight-bold mr-2">S/N:</span>
    <span class="caption"><?= $postRepairInspectionReport->serial_no ?></span>
  </div>
</div>
<!--  -->
<div class="row mt-2 mx-4">
  <div class="col-md-6">
    <div class="d-flex align-items-center">
      <div class="checkbox d-flex align-items-center justify-content-center text-center">
        <?php if ($postRepairInspectionReport->with_wm_prs) : ?>
          <i class="fas fa-circle font-size-x-small"></i>
        <?php endif; ?>
      </div>
      <span class="checkbox-label-smaller">With Waste Material / property Return Slip</span>
    </div>
  </div>
  <div class="col-md-6">
    <div class="d-flex align-items-center">
      <div class="checkbox d-flex align-items-center justify-content-center text-center">
        <?php if (!$postRepairInspectionReport->with_wm_prs) : ?>
          <i class="fas fa-circle font-size-x-small"></i>
        <?php endif; ?>
      </div>
      <span class="checkbox-label-smaller">Without Waste Material / property Return Slip</span>
    </div>
  </div>
</div>
<!-- /# -->
<div class="d-flex justify-content-between">
  <!-- Post-inspected by -->
  <div class="d-flex">
    <div class="mt-3">
      <div class="signed-by">Post-inspected by:</div>
      <div class="name text-center"><?= "{$postInspectedBy->emp_fname} {$postInspectedBy->emp_lname}" ?></div>
      <div class="position"><?= $postInspectedBy->emp_position ?></div>
      <div class="date">Date: <span class="font-weight-bold"><?= date('M d, Y', strtotime($postInspectedDate)) ?></span></div>
    </div>
  </div>
  <!-- /# Post-inspected by -->
  <!-- Recommending approval -->
  <div class="d-flex">
    <div class="mt-3">
      <div class="signed-by">Recommending Approval:</div>
      <div class="name text-center"><?= "{$postRecommendingApproval->emp_fname} {$postRecommendingApproval->emp_lname}" ?></div>
      <div class="position"><?= $postRecommendingApproval->emp_position ?></div>
    </div>
  </div>
  <!-- /# Recommending approval -->
</div>
<!-- Approved approval -->
<div class="d-flex justify-content-end">
  <div class="mt-3 text-center">
    <div class="signed-by">Approved:</div>
    <div class="name"><?= "{$postApproved->emp_fname} {$postApproved->emp_lname}" ?></div>
    <div class="position"><?= $postApproved->emp_position ?></div>
  </div>
</div>
<!-- /# Approved approval -->
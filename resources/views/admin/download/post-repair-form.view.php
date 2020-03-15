<?php view('includes/header'); ?>
<div class="container py-5">
  <div class="inspection-report">
    <!-- Floating buttons -->
    <div class="floating-buttons">
      <!-- Don't Print Button -->
      <a href="<?= getPath('admin/incoming-repairs.php') ?>" class="btn btn-sm btn-do-not-print btn-secondary" role="button">
        <i class="fa fa-arrow-left fa-fw"></i>
        Cancel
      </a>
      <!-- /# Don't Print Button -->
      <!-- Print Button -->
      <button class="btn btn-sm btn-print btn-info" onclick="window.print()"><i class="fa fa-print fa-fw"></i>Print</button>
      <!-- /# Print Button -->
    </div>
    <!-- /# Floating buttons -->
    <div class="row">
      <!--  -->
      <div class="row mx-auto mt-1">
        <div class="col-md-3 pr-0">
          <img class="w-100" src="<?= asset('img/beng_cap_logo.png') ?>" alt="logo">
        </div>
        <div class="col-md-9 d-flex flex-column justify-content-center">
          <div class="republic">Republic of the Philippines</div>
          <div class="province">Province of Benguet</div>
          <div class="address">Capitol, La Trinidad</div>
        </div>
      </div>
      <!-- /# -->
      <div class="col-md-3 offset-md-8 text-right">
        <div class="pgo-it-file text-uppercase font-weight-bold red--text">PGO - IT FILE</div>
        <div class="to">TO: <span class="underlined"><?= $inspectionReport->to_whom ?></span></div>
      </div>
    </div>
    <!-- Form Title -->
    <h1 class="text-center text-uppercase title mt-2">Pre and Post-Repair Inspection Report</h1>
    <!-- /# Form Title -->
    <!--  -->
    <div class="d-flex justify-content-end">
      <div class="d-flex flex-column mr-2">
        <span class="font-size-small">Control No.: <span class="underlined"><?= $inspectionReport->control_no ?></span></span>
        <span class="font-size-small">Date: <span class="font-weight-bold"><?= date('M d, Y', strtotime($inspectionReport->date)) ?></span></span>
      </div>
    </div>
    <!-- /# -->
    <!-- Pre Inspection Report Data -->
    <?php view('admin/download/pre-repair', compact(
      'inspectionReport',
      'other',
      'issuedTo',
      'requestedBy',
      'preRepairFindings',
      'preInspectionReport',
      'preInspectionParts',
      'preInspectedBy',
      'preInspectedDate',
      'preRecommendingApproval',
      'preApproved'
    )); ?>
    <!-- /# Pre Inspection Report Data -->
    <hr class="border border-dark">

    <?php view('admin/download/post-repair', compact(
      'postRepairInspectionReport',
      'postRepairFindings',
      'postInspectedBy',
      'postInspectedDate',
      'postRecommendingApproval',
      'postApproved'
    )); ?>
  </div>
</div>

<?php view('includes/footer'); ?>
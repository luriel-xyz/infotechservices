<?php view('includes/header'); ?>
<!-- Page Content -->
<div class="h-100 w-100 row">
  <!--  Container -->
  <div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12 my-auto">
    <a href="<?= getPath('app/admin/incoming-repairs.php') ?>" class="btn btn-link text-capitalize" role="button">
      <i class="fas fa-arrow-left fa-fw"></i>
      Go back
    </a>
    <form method="POST" class="p-3 border rounded d-block mx-auto" id="post-repair-form">
      <!-- <input type="hidden" class="form-control" name="action" id="action" value="addWalk-inRepair"> -->
      <input type="hidden" name="inspection_report_id" id="inspection-report-id" value="<?= $inspectionReport->id ?>">
      <input type="hidden" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value="<?= $useraccount_id ?>">
      <input type="hidden" name="itsrequest_id" id="itsrequest_id" value="<?= $itsrequest_id ?>">
      <input type="hidden" name="assessment_report_id" id="assessment-report-id" value="<?= $assessment_report_id ?>">
      <p class="h3 text-center">
        <i class="fa fa-wrench fa-fw" aria-hidden="true"></i>
        Post Repair Inspection Report
      </p>
      <!-- Post Repair Inspection -->
      <h5 class="text-uppercase">Post-repair Inspection Findings</h5>

      <div class="row mb-4">
        <div class="col-md-5 form-group">
          <textarea name="post_repair_findings" class="form-control" id="post-repair-findings" cols="30" rows="3" placeholder="Findings"></textarea>
        </div>

        <!-- Checkboxes -->
        <div class="col-md-6 offset-md-1">
          <div class="form-check">
            <label class="form-check-label d-flex align-items-center" for="stock-supplies">
              <input type="checkbox" name="stock_supplies" class="form-check-input" id="stock-supplies" style="position:relative;bottom:1px;">
              <span class="ml-1">Stock / Supplies</span>
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label d-flex align-items-center" for="with-waste-material">
              <input type="checkbox" name="with_waste_material" class="form-check-input" id="with-waste-material" style="position:relative;bottom:1px;">
              <span class="ml-1 text-capitalize">With Waste Material / Property Return Slip</span>
            </label>
          </div>
        </div>
        <!-- /# Checkboxes -->
      </div>

      <!-- Stock Information -->
      <div class="stock-container d-none form-group w-75">
        <div class="d-flex">
          <div class="form-group">
            <input type="text" name="ics_number" class="form-control" id="ics-number" placeholder="ICS Number">
          </div>
          <div class="form-group  ml-4">
            <input type="text" name="inventory_item_number" class="form-control" id="inventory-item-number" placeholder="Inventory Item No">
          </div>
          <div class="form-group ml-4">
            <input type="text" name="stock_serial_number" class="form-control" id="stock-serial-number" placeholder="S/N">
          </div>
        </div>
      </div>
      <!-- /# Stock Information -->

      <!-- Post Inspection Select Fields -->
      <div class="form-group d-flex mb-0">
        <!-- Post Inspected by -->
        <div class="form-group mr-4">
          <label for="post-inspected-by">Post Inspected By:</label>
          <select name="post_inspected_by" class="form-control" id="post-inspected-by" required>
            <option selected disabled>-- Select Employee --</option>
            <?php foreach ($employees as $employee) : ?>
              <option value="<?= $employee->emp_id ?>"><?= "{$employee->emp_fname} {$employee->emp_lname}" ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <!-- /# Post Inspected by -->

        <!-- Post-repair Inspection Recommending Approval -->
        <div class="form-group mr-4">
          <label for="post-recommending-approval">Recommending Approval:</label>
          <select name="post_recommending_approval" class="form-control" id="post-recommending-approval" required>
            <option selected disabled>-- Select Employee --</option>
            <?php foreach ($employees as $employee) : ?>
              <option value="<?= $employee->emp_id ?>"><?= "{$employee->emp_fname} {$employee->emp_lname}" ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <!-- /# Post-repair Inspection Recommending Approval -->

        <!-- Post-repair Inspection Approved -->
        <div class="form-group mr-4">
          <label for="post-approved">Approved:</label>
          <select name="post_approved" class="form-control" id="post-approved" required>
            <option selected disabled>-- Select Employee --</option>
            <?php foreach ($employees as $employee) : ?>
              <option value="<?= $employee->emp_id ?>"><?= "{$employee->emp_fname} {$employee->emp_lname}" ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <!-- /# Post-repair Inspection Approved -->
      </div>

      <!-- Date Post Inspected -->
      <div class="form-group col-md-2 pl-0">
        <label for="post-inspected-date">Date Inspected:</label>
        <input type="date" name="post_inspected_date" class="form-control" id="post-inspected-date" required>
      </div>
      <!-- /# Date Post Inspected -->

      <!-- /# Post Inspection Select Fields -->
      <!-- /# Post Repair Inspection -->
      <!-- Create Post Repair Inspection Report Button -->
      <button type="submit" class="btn btn-sm btn-primary d-block mx-auto mt-4" id="submit-btn">Create</button>
      <!-- /# Create Post Repair Inspection Report Button -->
    </form>
  </div>
  <!--/# Container -->

</div>
<!-- /# Page Content -->

<?php view('includes/footer'); ?>
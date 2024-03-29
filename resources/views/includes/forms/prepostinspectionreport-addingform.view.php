<?php view('includes/header'); ?>
<!-- Page Content -->
<div class="h-100 w-100 row">
  <!--  Container -->
  <div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12 my-auto">
    <a href="<?= getPath('app/admin/incoming-repairs.php') ?>" class="btn btn-link text-capitalize" role="button">
      <i class="fas fa-arrow-left fa-fw"></i>
      Go back
    </a>
    <form method="POST" class="p-3 border rounded d-block mx-auto" id="pre-repair-form">
      <!-- <input type="hidden" class="form-control" name="action" id="action" value="addWalk-inRepair"> -->
      <input type="hidden" class="form-control" name="action" id="action" value="<?= $action ?>">
      <input type="hidden" class="form-control" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value="<?= $useraccount_id ?>">
      <input type="hidden" class="form-control" name="itsrequest_id" id="itsrequest_id" value="<?= $itsrequest_id ?>">
      <input type="hidden" class="form-control" name="assessment_report_id" id="assessment-report-id" value="<?= $assessment_report_id ?>">
      <p class="h3 text-center">
        <i class="fa fa-wrench fa-fw" aria-hidden="true"></i>
        Pre and Post Repair Inspection Report
      </p>
      <hr class="border-grey">
      <div class="col-md-6">
        <div class="row">
          <div class="col-6">

            <!-- To Field -->
            <div class="form-group">
              <input type="text" class="form-control mb-2" name="to" id="to" placeholder="To">
            </div>
            <!-- /# To Field -->

            <!-- Control Number -->
            <div class="form-group">
              <input type="text" class="form-control mb-2" name="control_number" id="control-number" placeholder="Control Number" required>
            </div>
            <!-- /# Control Number -->
          </div>
          <div class="col-6">
            <!-- Date -->
            <div class="form-group">
              <label for="date" class="font-size-small mb-1">Date</label>
              <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="<?= date('Y-m-d') ?>" required>
            </div>
            <!-- /# Date -->
          </div>
        </div>
      </div>
      <hr class="border border-light">
      <div class="container-fluid row">
        <!-- Property Plant and Equipment Section -->
        <h5 class="col-md-12 text-uppercase">DESCRIPTION OF PROPERTY, PLANT AND EQUIPMENT</h5>
        <!-- <div class="col-md-12"> -->
        <!-- Motor Vehicles -->
        <!-- <h5>Motor Vehicles <span class="btn btn-primary"></span></h5> -->
        <!-- <div class="row"> -->
        <!-- First column -->
        <!-- <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" name="vehicle_type" id="vehicle-type" placeholder="Type">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="plate_no" id="plate-no" placeholder="Plate Number">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="vehicle_property_no" id="vehicle-property-no" placeholder="Property Number">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="engine_no" id="engine-no" placeholder="Engine Number">
              </div>
              <div class="form-group mb-1">
                <input type="text" class="form-control" name="chassis_no" id="chassis-no" placeholder="Chassis Number">
              </div>
              <div class="form-group">
                <label for="vehicle-acquisition-date" class="font-size-small my-0 py-0">Acquisition Date:</label>
                <input type="date" class="form-control" name="vehicle_acquisition_date" id="vehicle-acquisition-date" placeholder="Acquisition Date">
              </div>
            </div> -->
        <!-- /# First column -->
        <!-- Second column -->
        <!-- <div class="col-md-6">
              <div class="form-group">
                <input type="number" class="form-control" name="vehicle_acquisition_cost" id="vehicle-acquisition-cost" min="0" step=".01" placeholder="Acquisition Cost">
              </div>
              <div class="form-group mb-0">
                <input type="text" class="form-control" name="repair_history" id="repair-history" placeholder="Repair History">
              </div>
              <div class="form-group">
                <label for="repair-date" class="font-size-small my-0 py-0">Repair Date:</label>
                <input type="date" class="form-control" name="repair_date" id="repair-date" placeholder="Repair Date">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="nature_of_last_repair" id="nature-of-last-repair" placeholder="Nature of Last Repair & Maintenance">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="defects_complaints" id="defects-complaints" placeholder="Defects / Complaints">
              </div>
            </div> -->
        <!-- /# Second column -->
        <!-- </div> -->
        <!-- /# Motor Vehicles -->
        <!-- </div> -->
        <div class="col-md-12">
          <!-- Other Property Plant and Equipment -->
          <h5>Property, Plant and Equipment</h5>
          <div class="row">
            <!-- First Column -->
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" name="other_type" id="other-type" placeholder="Type" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="model" id="model" placeholder="Model" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="other_property_number" id="other-property-number" placeholder="Property Number" value="<?= $request->property_num ?>" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="serial_number" id="serial-number" placeholder="Serial Number" value="<?= $assessmentReport->serial_number ?>" required>
              </div>
            </div>
            <!-- /# First Column -->
            <!-- Second Column -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="other-acquisition-date" class="font-size-small mb-0">Acquisition Date:</label>
                <input type="date" class="form-control" name="other_acquisition_date" id="other-acquisition-date" placeholder="Acquisition Date" value="<?= $assessmentReport->hwcomponent_dateAcquired ?>" required>
              </div>
              <div class="form-group mb-0">
                <input type="number" min="0" step=".01" class="form-control" name="other_acquisition_cost" id="other-acquisition-cost" placeholder="Acquisition Cost" value="<?= $assessmentReport->hwcomponent_acquisitioncost ?>" required>
              </div>
              <div class="form-group mb-0">
                <label for="issued-to" class="font-size-small mb-0">Issued To:</label>
                <select name="issued_to" id="issued-to" class="form-control" required>
                  <option selected disabled>-- Select Employee --</option>
                  <?php foreach ($employees as $employee) : ?>
                    <option value="<?= $employee->emp_id ?>"><?= "{$employee->emp_fname} {$employee->emp_lname}" ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="requested-by" class="font-size-small mb-0">Requested By:</label>
                <select name="requested_by" id="requested-by" class="form-control" required>
                  <option selected disabled>-- Select Employee --</option>
                  <?php foreach ($employees as $employee) : ?>
                    <option value="<?= $employee->emp_id ?>"><?= "{$employee->emp_fname} {$employee->emp_lname}" ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <!-- /# Second Column -->
          </div>
          <!-- /# Other Property Plant and Equipment -->
        </div>
        <!-- /# Property Plant and Equipment Section -->
      </div>

      <hr class="border-white">
      <!-- Pre-repair Inspection -->
      <div class="col-md-8">
        <h5 class="text-uppercase pb-2">Pre-repair Inspection</h5>
        <div class="form-group">
          <textarea name="pre_repair_findings" id="pre-repair-findings" class="form-control" cols="30" rows="3" placeholder="Findings/Recommendations" required></textarea>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="job_order" id="job-order" placeholder="Job Order" required>
        </div>
      </div>
      <div class="h5 ml-3 text-center mt-4 pb-2">Parts to be Replaced and/or Procured:</div>
      <div class="form-row">
        <div class="col-8 offset-2">
          <table>
            <thead class="text-center">
              <tr>
                <th style="width: 10%">Qty</th>
                <th style="width: 15%">Unit</th>
                <th>Particulars / Description</th>
                <th style="width: 20%">Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php for ($i = 0; $i < 6; $i++) : ?>
                <tr class="row-part row-part-<?= $i ?>">
                  <td><input type="number" min="0" class="qty form-control" name="qty[]"></td>
                  <td><input type="text" class="unit form-control" name="unit[]"></td>
                  <td><input type="text" class="particulars_descriptions form-control" name="particulars_descriptions[]"></td>
                  <td><input type="number" min="0" step=".01" class="amount form-control" name="amount[]"></td>
                </tr>
              <?php endfor; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Additional Sheet Checkbox -->
      <div class="form-group">
        <label class="d-flex align-items-center">
          <input type="checkbox" name="additional_sheet_attached" class="mr-1" id="additional-sheet-attached">
          <span>Additional Sheet Attached</span>
        </label>
      </div>
      <!-- /# Additional Sheet Checkbox -->
      <hr class="border-grey">

      <!-- Pre Inspection Select Fields -->
      <div class="form-group d-flex mb-0">
        <!-- Pre Inspected by -->
        <div class="form-group mr-4">
          <label for="pre-inspected-by">Pre Inspected By:</label>
          <select name="pre_inspected_by" class="form-control" id="pre-inspected-by" required>
            <option value="0" selected disabled>-- Select Employee --</option>
            <?php foreach ($employees as $employee) : ?>
              <option value="<?= $employee->emp_id ?>"><?= "{$employee->emp_fname} {$employee->emp_lname}" ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <!-- /# Pre Inspected by -->

        <!-- Pre-repair Inspection Recommending Approval -->
        <div class="form-group mr-4">
          <label for="pre-recommending-approval">Recommending Approval:</label>
          <select name="pre_recommending_approval" class="form-control" id="pre-recommending-approval" required>
            <option value="0" selected disabled>-- Select Employee --</option>
            <?php foreach ($employees as $employee) : ?>
              <option value="<?= $employee->emp_id ?>"><?= "{$employee->emp_fname} {$employee->emp_lname}" ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <!-- /# Pre-repair Inspection Recommending Approval -->

        <!-- Pre-repair Inspection Approved -->
        <div class="form-group mr-4">
          <label for="pre-approved">Approved:</label>
          <select name="pre_approved" class="form-control" id="pre-approved" required>
            <option value="0" selected disabled>-- Select Employee --</option>
            <?php foreach ($employees as $employee) : ?>
              <option value="<?= $employee->emp_id ?>"><?= "{$employee->emp_fname} {$employee->emp_lname}" ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <!-- /# Pre-repair Inspection Approved -->
      </div>

      <!-- Date Pre Inspected -->
      <div class="form-group col-md-2 pl-0">
        <label for="pre-inspected-date">Date Inspected:</label>
        <input type="date" name="pre_inspected_date" class="form-control" id="pre-inspected-date" required>
      </div>
      <!-- /# Date Pre Inspected -->

      <!-- /# Pre Inspection Select Fields -->

      <!-- /# Pre-repair Inspection -->

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
      <!-- Create Pre Repair Inspection Report Button -->
      <button type="submit" class="btn btn-sm btn-primary d-block mx-auto mt-4" id="submit-btn">Create</button>
      <!-- /# Create Pre Repair Inspection Report Button -->
    </form>
  </div>
  <!--/# Container -->

</div>
<!-- /# Page Content -->

<?php view('includes/footer'); ?>
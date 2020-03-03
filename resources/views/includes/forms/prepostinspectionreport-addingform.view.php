<?php view('includes/header'); ?>
<!-- Page Content -->
<div class="h-100 w-100 row">
  <!--  Container -->
  <div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12 my-auto text-white">
    <a href="javascript:history.back()" class="btn btn-default text-white" role="button">
      <i class="fa fa-arrow-left fa-fw"></i>
      Go back
    </a>
    <form method="POST" class="p-3 border rounded d-block mx-auto" id="pre-post-repair-form">
      <!-- <input type="hidden" class="form-control" name="action" id="action" value="addWalk-inRepair"> -->
      <input type="hidden" class="form-control" name="action" id="action" value="<?= $action ?>">
      <input type="hidden" class="form-control" name="statusupdate_useraccount_id" id="statusupdate_useraccount_id" value="<?= $useraccount_id ?>">
      <input type="hidden" class="form-control" name="itsrequest_id" id="itsrequest_id" value="<?= $itsrequest_id ?>">
      <p class="h3 text-center">
        <i class="fa fa-wrench" aria-hidden="true"></i>
        Pre and Post Repair Inspection Report
      </p>
      <hr style="border-color:white">
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
              <input type="date" class="form-control" name="date" id="date" placeholder="Date" required>
            </div>
            <!-- /# Date -->
          </div>
        </div>
      </div>
      <hr class="border border-light">
      <div class="container-fluid row">

        <!-- Property Plant and Equipment Section -->
        <div class="col-md-6">
          <h5 class="text-uppercase">DESCRIPTION OF PROPERTY, PLANT AND EQUIPMENT</h5>
          <h5>Property, Plant and Equipment</h5>
          <div class="form-group">
            <input type="text" class="form-control" name="type" id="type" placeholder="Type" required>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" name="model" id="model" placeholder="Model" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="property_number" id="property-number" placeholder="Property Number" value="<?= $request->property_num ?>" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="serial_number" id="serial-number" placeholder="Serial Number" value="<?= $assessmentReport->serial_number ?>" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mt-4 pt-2">
            <label for="acquisition-date" class="font-size-small">Acquisition Date:</label>
            <input type="date" class="form-control" name="acquisition_date" id="acquisition-date" placeholder="Acquisition Date" value="<?= $assessmentReport->hwcomponent_dateAcquired ?>" required>
          </div>
          <div class="form-group">
            <input type="number" min="0" step=".01" class="form-control" name="acquisition_cost" id="acquisition-cost" placeholder="Acquisition Cost" value="<?= $assessmentReport->hwcomponent_acquisitioncost ?>" required>
          </div>
          <div class="form-group">
            <label for="issued-to" class="font-size-small">Issued To:</label>
            <select name="issued_to" id="issued-to" class="form-control" required>
              <option selected disabled>-- Select Employee --</option>
              <?php foreach ($employees as $employee) : ?>
                <option value="<?= $employee->emp_id ?>"><?= "{$employee->emp_fname} {$employee->emp_lname}" ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="issued-to" class="font-size-small">Requested By:</label>
            <select name="requested_by" id="requested-by" class="form-control" required>
              <option selected disabled>-- Select Employee --</option>
              <?php foreach ($employees as $employee) : ?>
                <option value="<?= $employee->emp_id ?>"><?= "{$employee->emp_fname} {$employee->emp_lname}" ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <!-- /# Property Plant and Equipment Section -->
      </div>

      <hr style="border-color: white">
      <!-- Pre-repair Inspection -->
      <div class="col-md-8">
        <h5 class="text-uppercase pb-2">Pre-repair Inspection</h5>
        <div class="form-group">
          <input type="text" class="form-control" name="findings_recommendations" id="findings-recommendations" placeholder="Findings/Recommendations" required>
        </div>

        <div class="form-group">
          <input type="text" class="form-control" name="job_order" id="job-order" placeholder="Job Order" required>
        </div>
      </div>
      <!-- /# Pre-repair Inspection -->
      <div class="h5 ml-3 text-center mt-4 pb-2">Parts to be Replaced and/or Procured:</div>
      <div class="form-row">
        <div class="col-8 offset-2">
          <table>
            <thead class="text-white text-center">
              <tr>
                <th style="width: 8%">Qty</th>
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

      <hr style="border-color: white">
      <div class="form-group">
        <label class="d-flex align-items-center">
          <input type="checkbox" name="additional_sheet_attached" class="mr-1" id="additional-sheet-attached">
          <span>Additional Sheet Attached</span>
        </label>
      </div>

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

      <hr style="border-color: white">

      <!-- Post Repair Inspection -->
      <h5 class="text-uppercase">Post-repair Inspection Findings</h5>

      <div class="row mb-4">
        <div class="col-md-5 form-group">
          <textarea name="findings" class="form-control" id="findings" cols="30" rows="3" placeholder="Findings"></textarea>
        </div>
        <!-- /# Post Repair Inspection -->

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

      <div class="stock-container d-none form-group w-75">
        <div class="d-flex">
          <input type="text" name="ics_number" class="form-control" id="ics-number" placeholder="ICS Number">
          <input type="text" name="inventory_item_number" class="form-control ml-4" id="inventory-item-number" placeholder="Inventory Item No">
          <input type="text" name="serial_number" class="form-control ml-4" id="stock-serial-number" placeholder="S/N">
        </div>
      </div>

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

      <!-- Create Button -->
      <button type="submit" class="btn btn-primary d-block mx-auto mt-4" id="submit-btn">Create</button>
      <!-- /# Create Button -->
    </form>
  </div>
  <!--/# Container -->

</div>
<!-- /# Page Content -->

<!-- Script -->
<script>
  $(() => {
    $('#stock-supplies').change(function() {
      const stockContainer = $('.stock-container');
      if (this.checked) {
        stockContainer.removeClass('d-none');
        stockContainer.show('fast');
      } else {
        $('#ics-number').val('');
        $('#inventory-item-number').val('');
        $('#stock-serial-number').val('');
        stockContainer.hide('fast');
      }
    });

    $('#pre-post-repair-form').submit(function(e) {
      e.preventDefault();

      // Set request status to pre-post-repair inspected 
      $.post('../../config/processors/requestArguments.php', {
          action: $('#action').val(),
          itsrequest_id: $('#itsrequest_id').val(),
          useraccount_id: $('#statusupdate_useraccount_id').val(),
        })
        .fail(function() {
          alert('Error!')
        })
        .done(function(res) {
          alert(res ? 'Request Inspected' : 'Error');
          redirectToPrintInspectionPage();
        });



      // $.post('../config/processors/requestArguments.php', $(this).serialize())
      //   .fail(function() {
      //     alert('Error')
      //   })
      //   .done(function(res) {
      //     alert(res)
      //   });
    });

    function redirectToPrintInspectionPage() {
      // Gather inspection report data
      const partsToReplaceProcure = [];
      $('.row-part').each(function(i, val) {
        // Row column datum
        const qty = $(`.row-part-${i} .qty`).val();
        const particularsDescriptions = $(`.row-part-${i} .particulars_descriptions`).val();
        const unit = $(`.row-part-${i} .unit`).val();
        const amount = $(`.row-part-${i} .amount`).val();

        // Check if some of the fields have values
        if (!qty || !particularsDescriptions || !unit || !amount) return;
        partsToReplaceProcure.push({
          qty,
          particularsDescriptions,
          unit,
          amount
        });
      });

      // Redirect to print inspection report page
      $.redirect('../../app/admin/download/pre-post-repair-form.php', {
        data: JSON.stringify({
          to: $('#to').val() || 'n/a',
          control_number: $('#control-number').val() || 'n/a',
          date: $('#date').val() || 'n/a',
          type: $('#type').val() || 'n/a',
          model: $('#model').val() || 'n/a',
          property_number: $('#property-number').val() || 'n/a',
          serial_number: $('#serial-number').val() || 'n/a',
          acquisition_date: $('#acquisition-date').val() || 'n/a',
          acquisition_cost: $('#acquisition-cost').val() || 'n/a',
          issued_to: $('#issued-to').val() || 'n/a',
          requested_by: $('#requested-by').val() || 'n/a',
          findings_recommendations: $('#findings-recommendations').val() || 'n/a',
          job_order: $('#job-order').val() || 'n/a',
          parts: partsToReplaceProcure,
          additional_sheet: $('#additional-sheet').val() || 'n/a',
          pre_inspected_by: $('#pre-inspected-by').val() || 'n/a',
          pre_recommending_approval: $('#pre-recommending-approval').val() || 'n/a',
          pre_approved: $('#pre-approved').val() || 'n/a',
          pre_inspected_date: $('#pre-inspected-date').val() || 'n/a',
          findings: $('#findings').val() || 'n/a',
          stock_supplies: $('#stock-supplies').is(':checked'),
          with: $('#with-waste-material').is(':checked'),
          additional_sheet_attached: $('#additional-sheet-attached').is(':checked'),
          ics_number: $('#ics-number').val() || 'n/a',
          inventory_item_number: $('#inventory-item-number').val() || 'n/a',
          stock_serial_number: $('#stock-serial-number').val() || 'n/a',
          post_inspected_by: $('#post-inspected-by').val() || 'n/a',
          post_recommending_approval: $('#post-recommending-approval').val() || 'n/a',
          post_approved: $('#post-approved').val() || 'n/a',
          post_inspected_date: $('#post-inspected-date').val() || 'n/a',
        })
      });
    }
  });
</script>
<!-- /# Script -->

<?php view('includes/footer'); ?>
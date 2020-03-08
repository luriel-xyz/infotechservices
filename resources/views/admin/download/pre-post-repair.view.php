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
    <!-- Propery plant and equipment section -->
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
        <div class="pgo-it-file font-weight-bold red--text">PGO - IT FILE</div>
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
    <h2 class="subtitle-1 text-uppercase">Propery Plant And Equipment</h2>
    <div class="mt-2 w-50">
      <div class="text-uppercase font-size-small d-flex justify-content-between">type: <span class="font-weight-bold underlined"><?= $other->type ?></span></div>
      <div class="text-uppercase font-size-small d-flex justify-content-between">model: <span class="font-weight-bold underlined"><?= $other->model ?></span></div>
      <div class="text-uppercase font-size-small d-flex justify-content-between">propery number: <span class="font-weight-bold underlined"><?= $other->property_no ?></span></div>
      <div class="text-uppercase font-size-small d-flex justify-content-between">serial number: <span class="font-weight-bold underlined"><?= $other->serial_no ?></span></div>
      <div class="text-uppercase font-size-small d-flex justify-content-between">acquisition date: <span class="font-weight-bold underlined"><?= $other->acquisition_date ?></span></div>
      <div class="text-uppercase font-size-small d-flex justify-content-between">acquisition cost: <span class="font-weight-bold underlined"><?= $other->acquisition_cost ?></span></div>
      <div class="text-uppercase font-size-small d-flex justify-content-between">issued to: <span class="font-weight-bold underlined"><?= "{$issuedTo->emp_fname} {$issuedTo->emp_lname}" ?></span></div>
    </div>
    <!-- Requested by -->
    <div class="d-flex justify-content-end mt-3">
      <div>
        <div class="signed-by">Requested by:</div>
        <div class="name text-center"><?= "{$requestedBy->emp_fname} {$requestedBy->emp_lname}" ?></div>
        <div class="position"><?= $requestedBy->emp_position ?></div>
      </div>
    </div>
    <!-- /# Requested by -->
    <!-- /# Propery plant and equipment section -->
    <hr class="border border-dark">
    <!-- Pre-repair inspection section -->
    <h2 class="subtitle-1 text-uppercase">Pre-repair inspection</h2>
    <!-- Pre-repair inspection list -->
    <ol class="pl-4" type="I">
      <li class="subtitle-2">Findings/Recommendations:</li>
      <li class="subtitle-2">
        Job Order
        <span class="text-capitalize">(Nature & Scope of work to be done): </span>
      </li>
      <li class="subtitle-2">
        <span class="text-uppercase">Parts to be replaced and / or procured:</span>
        <!-- Tables row -->
        <div class="container-fluid row">
          <!-- Parts Table -->
          <div class="col-6">
            <?php if (count($preInspectionParts)) : ?>
              <table class="assessment-table table table-bordered mt-3 parts-to-replace">
                <thead>
                  <tr>
                    <th class="text-uppercase">QTY</th>
                    <th class="text-capitalize">Unit</th>
                    <th class="text-capitalize">Particulars / Description</th>
                    <th class="text-capitalize">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($preInspectionParts as $part) : ?>
                    <tr class="text-center">
                      <td><?= $part->qty ?></td>
                      <td><?= $part->unit ?></td>
                      <td><?= $part->description ?></td>
                      <td><?= $part->amount ?></td>
                    </tr>
                  <?php endforeach;   ?>
                </tbody>
              </table>
            <?php endif; ?>
          </div>
          <!-- /# Parts Table -->
        </div>
        <!-- /# Tables row -->

        <!-- Additional Sheet Attached Checkbox -->
        <div class="d-flex align-items-center ml-4">
          <div class="checkbox d-flex align-items-center justify-content-center text-center">
            <?php if ($preInspectionReport->additional_sheet) : ?>
              <i class="fas fa-circle font-size-x-small"></i>
            <?php endif; ?>
          </div>
          <span class="body-2 font-weight-bold">Additional Sheet Attached</span>
        </div>
        <!-- /# Additional Sheet Attached Checkbox -->
      </li>
    </ol>
    <!-- /# Psre-repair inspection list -->
    <div class="d-flex justify-content-between">
      <!-- Pre-inspected by -->
      <div class="d-flex">
        <div class="mt-3">
          <div class="signed-by">Pre-inspected by:</div>
          <div class="name text-center"><?= "{$preInspectedBy->emp_fname} {$preInspectedBy->emp_lname}" ?></div>
          <div class="position"></div>
          <div class="date">Date: <span class="font-weight-bold"><?= date('M d, Y', strtotime($preInspectedDate)) ?></span></div>
        </div>
      </div>
      <!-- /# Pre-inspected by -->
      <!-- Pre-inspected by -->
      <div class="d-flex">
        <div class="mt-3">
          <div class="signed-by">Recommending Approval:</div>
          <div class="name text-center"><?= "{$preRecommendingApproval->emp_fname} {$preRecommendingApproval->emp_lname}" ?></div>
          <div class="position"><?= $preRecommendingApproval->emp_position ?></div>
        </div>
      </div>
      <!-- /# Pre-inspected by -->
    </div>
    <!-- Approved -->
    <div class="d-flex justify-content-end mt-3">
      <div class="text-center">
        <div class="signed-by">Approved:</div>
        <div class="name"><?= "{$preApproved->emp_fname} {$preApproved->emp_lname}" ?></div>
        <div class="position"><?= $preApproved->emp_position ?></div>
      </div>
    </div>
    <!-- /# Approved -->
    <!-- /# Pre-repair inspection section -->
    <hr class="border border-dark">
    <!-- Post-repair inspection section -->
    <!-- Pre-repair inspection section -->
    <h2 class="subtitle-1 text-uppercase mb-1">Post-repair inspection</h2>
    <!-- Pre-repair inspection list -->
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
          <span class="checkbox-label-smaller">With Waste Material / Property Return Slip</span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="d-flex align-items-center">
          <div class="checkbox d-flex align-items-center justify-content-center text-center">
            <?php if (!$postRepairInspectionReport->with_wm_prs) : ?>
              <i class="fas fa-circle font-size-x-small"></i>
            <?php endif; ?>
          </div>
          <span class="checkbox-label-smaller">Without Waste Material / Property Return Slip</span>
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
  </div>
</div>

<?php view('includes/footer'); ?>
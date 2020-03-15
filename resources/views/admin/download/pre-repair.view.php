<div class="row mt-4">
  <div class="col-md-6">
    <!-- Motor Vehicles -->
    <h2 class="subtitle-1 text-uppercase">A. Motor Vehicles</h2>
    <div class="mt-2">
      <div class="pre-inspection-body-text">type: <span>_______________________________________________</span></div>
      <div class="pre-inspection-body-text">plate number: <span>_______________________________________________</span></div>
      <div class="pre-inspection-body-text">property number: <span>_______________________________________________</span></div>
      <div class="pre-inspection-body-text">engine number: <span>_______________________________________________</span></div>
      <div class="pre-inspection-body-text">chassis number: <span>_______________________________________________</span></div>
      <div class="pre-inspection-body-text">acquisition date: <span>_______________________________________________</span></div>
      <div class="pre-inspection-body-text">acquisition cost: <span>_______________________________________________</span></div>
      <div class="pre-inspection-body-text">repair history: <span>_______________________________________________</span></div>
      <div class="pre-inspection-body-text">repair date: <span>_______________________________________________</span></div>
      <div class="pre-inspection-body-text">nature of last repair & maintenance: <span>_______________________________________________</span></div>
      <div class="pre-inspection-body-text">defects / complaints: <span>_______________________________________________</span></div>
    </div>
    <!-- /# Motor Vehicles -->
  </div>
  <div class="col-md-6">
    <!-- Property Plant and Equipment -->
    <h2 class="subtitle-1 text-uppercase">B. property Plant And Equipment</h2>
    <div class="mt-2">
      <div class="pre-inspection-body-text">type: <span class="font-weight-bold underlined"><?= $other->type ?></span></div>
      <div class="pre-inspection-body-text">model: <span class="font-weight-bold underlined"><?= $other->model ?></span></div>
      <div class="pre-inspection-body-text">propery number: <span class="font-weight-bold underlined"><?= $other->property_no ?></span></div>
      <div class="pre-inspection-body-text">serial number: <span class="font-weight-bold underlined"><?= $other->serial_no ?></span></div>
      <div class="pre-inspection-body-text">acquisition date: <span class="font-weight-bold underlined"><?= $other->acquisition_date ?></span></div>
      <div class="pre-inspection-body-text">acquisition cost: <span class="font-weight-bold underlined"><?= $other->acquisition_cost ?></span></div>
      <div class="pre-inspection-body-text">issued to: <span class="font-weight-bold underlined"><?= "{$issuedTo->emp_fname} {$issuedTo->emp_lname}" ?></span></div>
    </div>
    <!-- /# property Plant and Equipment -->
  </div>
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
  <li class="subtitle-2">Findings/Recommendations: <span class="font-weight-normal underlined"><?= $preInspectionReport->repair_inspection ?></span></li>
  <li class="subtitle-2">
    Job Order
    <span class="text-capitalize">(Nature & Scope of work to be done): </span>
    <span class="font-weight-normal underlined"><?= $preInspectionReport->job_order ?></span>
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
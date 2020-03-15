<?php view('includes/header'); ?>
<div class="container py-4">
  <div class="floating-buttons">
    <!-- Don't Print Button -->
    <a href="<?= getPath('app/admin/incoming-repairs.php') ?>" class="btn btn-sm btn-do-not-print btn-secondary" role="button">
      <i class="fa fa-arrow-left fa-fw"></i>
      Cancel
    </a>
    <!-- /# Don't Print Button -->
    <!-- Print Button -->
    <button class="btn btn-sm btn-print btn-info" onclick="window.print()"><i class="fa fa-print fa-fw"></i>Print</button>
    <!-- /# Print Button -->
  </div>

  <header>
    <div class="container">
      <div class="d-flex justify-content-center">
        <img src="<?= asset('img/beng_cap_logo.png') ?>" class="logo" alt="BenguetCapitolLogo">
        <div class="ml-3">
          <h2 class="province text-uppercase">PROVINCE OF BENGUET</h2>
          <h1 class="title text-uppercase">Information Technology Services</h1>
          <h3 class="subtitle-1 text-uppercase">PROVINCIAL GOVERNOR’S OFFICE</h3>
          <h4 class="subtitle-2 mt-4"><u>REPAIR / ASSESSMENT REPORT</u></h4>
        </div>
      </div>
    </div>
  </header>

  <!--  Hardware Info Table  -->
  <div class="hardware-info-table">
    <div class="row">
      <!-- First Column -->
      <div class="hardware-info-table__col col-6">
        <div class="row">
          <!-- Labels -->
          <div class="hardware-info-table__labels body-1">
            <div class="label">Date:</div>
            <div class="label">Name of Item:</div>
            <div class="label">Date Acquired:</div>
            <div class="label">Model/Description:</div>
          </div>
          <!-- /# Labels -->
          <!-- Values -->
          <div class="hardware-info-table__values body-1">
            <div id="date" class="value"><?= date_format(date_create($date), "M d, Y h:i a") ?></div>
            <div id="name-of-item" class="value"><?= $nameOfItem ?></div>
            <div id="date-acquired" class="value"><?= date_format(date_create($dateAcquired), "M d, Y h:i a") ?> </div>
            <div id="model-or-description" class="value"><?= $modelOrDescription ?></div>
          </div>
          <!-- /# Values -->
        </div>
      </div>
      <!-- /# First Column -->

      <!-- / Second Column -->
      <div class="hardware-info-table__col col-6">
        <div class="d-flex">
          <!-- Labels -->
          <div class="hardware-info-table__labels body-1">
            <div class="label">DEPARTMENT/OFFICE:</div>
            <div class="label">PROPERTY NO.:</div>
            <div class="label">ISSUED TO:</div>
            <div class="label">ACQUISITION PRICE:</div>
          </div>
          <!-- /# Labels -->
          <!-- Values -->
          <div class="hardware-info-table__values body-1">
            <div id="department-or-office" class="value"><?= $departmentCode ?></div>
            <div id="property-number" class="value"><?= $propertyNumber ?></div>
            <div id="issued-to" class="value"><?= $issuedTo ?></div>
            <div id="acquisition-price" class="value"><?= $acquisitionCost ?></div>
          </div>
          <!-- /# Values -->
        </div>
      </div>
      <!-- /# Second Column -->
    </div>
    <!--  /# Hardware Info Table  -->

    <!-- Problems table -->
    <!-- <div class="problems-table">
      <div class="row">
        <div class="problems-table__col col-3">
          <span class="problems-table__label">
            <span class="text-uppercase">problem</span> (issues or errors):
          </span>
        </div>
        <div class="problems-table__col col-9 pl-1">
          <span class="problems-table__value">
            Error : Blinking Lights
          </span>
        </div>
      </div>
    </div> -->
    <!-- /# Problems table -->

    <!-- Components Table -->
    <div class="components mt-4 pt-4">
      <h4 class="subtitle-2 text-uppercase">Components:</h4>
      <div class="d-flex">
        <div class="flex-1">
          <!-- CPU -->
          <div>
            <h5 class="main-component bordered mb-0">cpu</h5>
            <?php foreach ($cpuComponents as $component) : ?>
              <div class="sub-component bordered"><?= $component->hwcomponent_name ?></div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <!-- /# CPU -->
          <!-- Printers -->
          <div>
            <h5 class="main-component bordered mb-0">printers</h5>
            <?php foreach ($printerComponents as $component) : ?>
              <div class="sub-component bordered"><?= $component->hwcomponent_name ?></div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <!-- /# Printers -->
        </div>
        <div class="flex-1">
          <div>
            <!-- CPU components remarks -->
            <h5 class="main-component bordered mb-0">&nbsp;</h5>
            <!-- Show remark description if exists otherwise show a blank -->
            <?php foreach ($cpuComponents as $component) : ?>
              <div class="sub-component bordered">
                <?php
                foreach ($subComponents as $subComponentRemark) {
                  if ($component->hwcomponent_id == $subComponentRemark->sub_component_id) {
                    echo $subComponentRemark->remark;
                  } else {
                    echo '&nbsp;';
                  }
                }
                ?>
              </div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
            <!-- /# CPU components remarks -->
          </div>
          <div>
            <!-- Printer components remarks -->
            <h5 class="main-component bordered mb-0">&nbsp;</h5>
            <!-- Show remark description if exists otherwise show a blank -->
            <?php foreach ($printerComponents as $component) : ?>
              <div class="sub-component bordered">
                <?php
                foreach ($subComponents as $subComponentRemark) {
                  if ($component->hwcomponent_id == $subComponentRemark->sub_component_id) {
                    echo $subComponentRemark->remark;
                  } else {
                    echo '&nbsp;';
                  }
                }
                ?>
              </div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
            <!-- /# Printer components remarks -->
          </div>
        </div>
        <div class="flex-1">
          <!-- UPS -->
          <div>
            <h5 class="main-component bordered mb-0">ups</h5>
            <?php foreach ($upsComponents as $component) : ?>
              <div class="sub-component bordered"><?= $component->hwcomponent_name ?></div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <!-- /# UPS -->
          <!-- Accessories -->
          <div>
            <h5 class="main-component bordered mb-0">accessories</h5>
            <?php foreach ($accessoriesComponents as $component) : ?>
              <div class="sub-component bordered"><?= $component->hwcomponent_name ?></div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <!-- /# Accessories -->
          <div>
            <h5 class="main-component bordered mb-0">others</h5>
            <?php foreach ($othersComponents as $component) : ?>
              <div class="sub-component bordered"><?= $component->hwcomponent_name ?></div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <!-- /# Accessories -->
        </div>
        <div class="flex-1">
          <div>
            <!-- UPS components remarks -->
            <h5 class="main-component bordered mb-0">&nbsp;</h5>
            <!-- Show remark description if exists otherwise show a blank -->
            <?php foreach ($upsComponents as $component) : ?>
              <div class="sub-component bordered">
                <?php
                foreach ($subComponents as $subComponentRemark) {
                  if ($component->hwcomponent_id == $subComponentRemark->sub_component_id) {
                    echo $subComponentRemark->remark;
                  } else {
                    echo '&nbsp;';
                  }
                }
                ?>
              </div>
            <?php endforeach ?>
            <div class="sub-component bordered">&nbsp;</div>
            <!-- /# UPS components remarks -->
          </div>
          <div>
            <!-- Accessories components remarks -->
            <h5 class="main-component bordered mb-0">&nbsp;</h5>
            <!-- Show remark description if exists otherwise show a blank -->
            <?php foreach ($accessoriesComponents as $component) : ?>
              <div class="sub-component bordered">
                <?php
                foreach ($subComponents as $subComponentRemark) {
                  if ($component->hwcomponent_id == $subComponentRemark->sub_component_id) {
                    echo $subComponentRemark->remark;
                  } else {
                    echo '&nbsp;';
                  }
                }
                ?>
              </div>
            <?php endforeach ?>
            <!-- /# Accessories components remarks -->
            <div class="sub-component bordered">&nbsp;</div>
          </div>
          <div>
            <!-- Others components remarks -->
            <h5 class="main-component bordered mb-0">&nbsp;</h5>
            <!-- Show remark description if exists otherwise show a blank -->
            <?php foreach ($othersComponents as $component) : ?>
              <div class="sub-component bordered">
                <?php
                foreach ($subComponents as $subComponentRemark) {
                  if ($component->hwcomponent_id == $subComponentRemark->sub_component_id) {
                    echo $subComponentRemark->remark;
                  } else {
                    echo '&nbsp;';
                  }
                }
                ?>
              </div>
            <?php endforeach ?>
            <!-- Others components remarks -->
            <div class="sub-component bordered">&nbsp;</div>
          </div>
        </div>
      </div>
    </div>
    <!-- /# Components Table -->

    <!-- Findings Table -->
    <div class="findings mt-4">
      <h4 class="subtitle-2 text-uppercase">Findings / Recommendations:</h4>
      <!-- Partly Damaged -->
      <div class="d-flex">
        <div class="d-flex justify-content-between align-items-center">
          <div class="findings__category">
            <?php if ($findingsCategory === 'beyond repair') : ?>
              <i class="fas fa-circle fa-fw text-danger"></i>
            <?php else :  ?>
              <i class="fas fa-square-full fa-fw"></i>
            <?php endif; ?>
            <span class="text-uppercase">beyond repair : </span>
          </div>

          <div class="findings__description ml-4">
            <?php if ($findingsCategory === 'beyond repair') : ?>
              <?= $findingsDescription ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- /# Partly Damaged -->

      <!-- Beyond Repair -->
      <div class="d-flex">
        <div class="d-flex justify-content-between align-items-center">
          <div class="findings__category">
            <?php if ($findingsCategory === 'partly damaged') : ?>
              <i class="fa fa-circle fa-fw text-danger"></i>
            <?php else :  ?>
              <i class="fas fa-square-full fa-fw"></i>
            <?php endif; ?>
            <span class="text-uppercase">partly damaged : </span>
          </div>

          <div class="findings__description ml-4">
            <?php if ($findingsCategory === 'partly damaged') : ?>
              <?= $findingsDescription ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- /# Beyond Repair -->

      <!-- For Replacement -->
      <div class="d-flex">
        <div class="d-flex justify-content-between align-items-center">
          <div class="findings__category">
            <?php if ($findingsCategory === 'for replacement') : ?>
              <i class="fa fa-circle fa-fw text-danger"></i>
            <?php else :  ?>
              <i class="fas fa-square-full fa-fw"></i>
            <?php endif; ?>
            <span class="text-uppercase">for replacement : </span>
          </div>

          <div class="findings__description ml-4">
            <?php if ($findingsCategory === 'for replacement') : ?>
              <?= $findingsDescription ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- /# For Replacement -->

      <!-- Repaired -->
      <div class="d-flex">
        <div class="d-flex justify-content-between align-items-center">
          <div class="findings__category">
            <?php if ($findingsCategory === 'repaired') : ?>
              <i class="fa fa-circle fa-fw text-danger"></i>
            <?php else :  ?>
              <i class="fas fa-square-full fa-fw"></i>
            <?php endif; ?>
            <span class="text-uppercase">repaired : </span>
          </div>

          <div class="findings__description ml-4">
            <?php if ($findingsCategory === 'repaired') : ?>
              <?= $findingsDescription ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- /# Repaired -->

      <!-- Others -->
      <div class="d-flex">
        <div class="d-flex justify-content-between align-items-center">
          <div class="findings__category">
            <?php if ($findingsCategory === 'others') : ?>
              <i class="fa fa-circle fa-fw text-danger"></i>
            <?php else :  ?>
              <i class="fas fa-square-full fa-fw"></i>
            <?php endif; ?>
            <span class="text-uppercase">others : </span>
          </div>

          <div class="findings__description ml-4">
            <?php if ($findingsCategory === 'others') : ?>
              <?= $findingsDescription ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- /# Others -->
    </div>
    <!-- /# Findings Table -->

    <!-- Notes -->
    <div class="notes mt-4 mb-4 pb-4">
      <h4 class="subtitle-2 text-uppercase">Notes:</h4>
      <p class="body-1"><?= $notes ?></p>
    </div>
    <!-- /# Notes -->

    <!-- Technical Representative -->
    <div class="mt-4 w-25">
      <span class="tech-rep-name"><?= "{$techRepresentative->emp_fname} {$techRepresentative->emp_lname}" ?></span>
      <div class="tech-rep-position text-center mr-4"><?= $techRepresentative->emp_position ?></div>
    </div>
    <!-- /# Technical Representative -->

    <!-- Info -->
    <div class="info text-center text-uppercase mt-4 pt-4">
      <div class="text-danger subtitle-2">****** ANY TYPE OF COMPUTER REPAIR MAY RESULT IN THE LOSS OF DATA ******</div>
      <div class="text-danger subtitle-2">***** BACKING-UP OF DATA IS THE USER’S RESPONSIBILITY *****</div>
      <div class="font-size-x-small font-weight-bold mt-4">(THIS FORM IS MADE FOR THE BENGUET PROVINCIAL GOVERNMENT)</div>
    </div>
    <!-- /# Info -->
  </div>
</div>
<?php view('includes/footer'); ?>
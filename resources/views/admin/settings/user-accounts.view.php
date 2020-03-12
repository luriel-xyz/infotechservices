<?php view('includes/header', ['subtitle' => '| Users']); ?>
<!-- /# Wrapper -->
<div class="d-flex" id="wrapper">

  <!-- Sidebar -->
  <?php view('includes/sidebar'); ?>
  <!-- /# Sidebar -->

  <!-- Page Content -->
  <div class="h-100 w-100">

    <!-- Page Title -->
    <?php view('includes/navbar'); ?>
    <!-- /# Page Title -->

    <div class="container-fluid h-100 mt-4">

      <div class="md-form">
        <div class="row">
          <!-- Search Field -->
          <div class="col-md-6">
            <i class="fas fa-search prefix grey-text"></i>
            <input type="text" class="form-control " id="search" placeholder="Search">
          </div>
          <!-- /# Search Field -->
          <!-- Create Admin Account Button -->
          <button type="button" class="btn btn-sm btn-primary text-capitalize" style="font-size: small" id="addPersonnelAccount" data-toggle="tooltip" title="Add Personnel Account">
            <i class="fas fa-user-plus fa-fw" aria-hidden="true"></i>
            Admin
          </button>
          <!-- /# Create Admin Account Button -->
          <!-- Create Department Account Button -->
          <button type="button" class="btn btn-sm btn-primary text-capitalize" style="font-size: small" id="addDeptAccount" data-toggle="tooltip" title="Add Department Account">
            <i class="fas fa-user-plus fa-fw" aria-hidden="true"></i>
            Department
          </button>
          <!-- /# Create Department Account Button -->
        </div>
      </div>

      <!--/# Container -->

      <!-- Modal Department -->
      <div class="modal fade" id="modalDepartmentAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <!-- Forms -->
            <!--  Add Modal  -->
            <div id="add-form">
              <?php view('includes/forms/departmentUserAccount-addingform', compact('departments')); ?>
            </div>
            <!-- /#Add Modal -->

            <!-- /#Forms -->
          </div>
        </div>
      </div>
      <!-- /# Modal  -->

      <!-- Modal Personnel -->
      <div class="modal fade" id="modalPersonnelAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <!-- Forms -->
            <!--  Add Modal  -->
            <div id="add-form">
              <?php view('includes/forms/personnelUserAccount-addingform', compact('personnels')); ?>
            </div>
            <!-- /#Add Modal -->

            <!-- /#Forms -->
          </div>
        </div>
      </div>
      <!-- /# Modal  -->

      <!-- Table Container -->
      <div class="container-fluid mt-2">
        <?php view('includes/tables/useraccounts-tbl', compact('useraccounts')); ?>
      </div>
      <!--/#Table Container-->
    </div>
    <!-- /# Page Content -->
    <!-- Paginator -->
    <div class="d-flex justify-content-center">
      <?= $links ?>
    </div>
    <!-- /# Paginator -->
  </div>
  <!-- /# Wrapper -->
  <?php view('includes/footer'); ?>
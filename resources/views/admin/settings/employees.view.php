<?php view('includes/header'); ?>

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
          <div class="col-md-5">
            <i class="fas fa-search prefix grey-text"></i>
            <input type="text" class="form-control " id="search" placeholder="Search">
          </div>
          <button type="button" class="btn btn-sm btn-primary" id="add-employee" data-toggle="tooltip" title="Add Employee"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
    <!--/# Container -->

    <!-- Modal  -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <!-- Forms -->
          <!--  Add Modal  -->
          <div id="add-form">
            <?php view('includes/forms/employee-addingform', compact('departments')); ?>
          </div>
          <!-- /#Add Modal -->

          <!--  Edit Modal  -->
          <div id="edit-form">
          </div>
          <!--  /#Edit Div  -->

          <!-- /#Forms -->
        </div>
      </div>
    </div>
    <!-- /# Modal  -->

    <!-- Table Container -->
    <div class="container-fluid mt-2">
      <?php view('includes/tables/employee-tbl', compact('employees')); ?>
    </div>
    <!--/#Table Container-->


    <!-- Paginator -->
    <div class="d-flex justify-content-center">
      <?= $links ?>
    </div>
    <!-- /# Paginator -->
  </div>
  <!-- /# Page Content -->

</div>
<!-- /# Wrapper -->

<?php view('includes/footer'); ?>
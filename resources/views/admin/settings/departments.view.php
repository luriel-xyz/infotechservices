<?php view('includes/header', ['subtitle' => '| Departments']); ?>
<!-- /# Wrapper -->
<div class="d-flex" id="wrapper">
  <?php view('includes/sidebar'); ?>

  <!-- Page Content -->
  <div class="h-100 w-100">

    <!-- Page Title -->
    <?php view('includes/navbar'); ?>
    <!-- /# Page Title -->

    <div class="container-fluid h-100 mt-4">
      <div class="md-form">
        <div class="row">
          <!-- Search Text Field -->
          <div class="col-md-5">
            <i class="fas fa-search prefix grey-text"></i>
            <input type="text" class="form-control " id="search" placeholder="Search">
          </div>
          <!-- /# Search Text Field -->
          <!-- Add Department Button -->
          <button type="button" class="btn btn-sm btn-primary" id="add-department" data-toggle="tooltip" title="Add Department"><i class="fa fa-plus" aria-hidden="true"></i> <i class="fa fa-building" aria-hidden="true"></i></button>
          <!-- /# Add Department Button -->
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
            <?php view('includes/forms/department-addingform.php'); ?>
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
      <?php view('includes/tables/department-tbl', compact('departments'));  ?>
    </div>
    <!--/#Table Container-->

    <!-- Paginator -->
    <div class="d-flex justify-content-center">
      <?= $links ?>
    </div>
    <!-- /# Paginator -->
  </div>
  <!-- /# Page Content -->

  <script type="text/javascript" src="<?= asset('js/departments.js') ?>"></script>
</div>
<!-- /# Wrapper -->
<?php view('includes/footer'); ?>
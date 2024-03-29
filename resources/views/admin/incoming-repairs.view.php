<?php view('includes/header', ['subtitle' => '| Repairs']); ?>
<!-- /# Wrapper -->
<div class="d-flex" id="wrapper">

  <!-- Sidebar -->
  <?php view('includes/sidebar'); ?>
  <!-- /#Sidebar -->

  <!-- Page Content -->
  <div class="h-100 w-100">

    <!-- Page Title -->
    <?php view('includes/navbar'); ?>
    <!-- /# Page Title -->

    <!-- Alert message -->
    <?php view('includes/message'); ?>
    <!-- /# Alert message -->

    <div class="container-fluid h-100 mt-4">

      <div class="md-form">
        <div class="row align-items-center">
          <!-- Search Field -->
          <div class="col-md-6">
            <i class="fas fa-search prefix grey-text"></i>
            <input type="text" class="form-control " id="search" placeholder="Search">
          </div>

          <div class="col-md-3">
            <button type="button" class="btn btn-sm btn-primary text-capitalize" data-toggle="tooltip" title="Add Incoming Repair" id="add">
              <i class="fas fa-plus-circle fa-fw" aria-hidden="true"></i>
              New Repair
            </button>
          </div>

          <!-- /# Search Field -->
          <!-- Download Repair Summary Button -->
          <?php if (count($repairs)) : ?>
            <div class="col-md-3 d-flex justify-content-end">
              <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Download repair summary in MSExcel" id="printSummary">
                <i class="fas fa-download" aria-hidden="true"></i>
              </button>
            </div>
          <?php endif; ?>
          <!-- /# Download Repair Summary Button -->
        </div>
      </div>

    </div>
    <!--/# Container -->

    <!-- Modal View -->
    <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

          <!--  View Modal  -->
          <div id="view-form">
            <div class="modal-header text-dark border-bottom pb-3">
              <div class="container-fluid text-center">
                <p class="h5 modal-title text-capitalize" id="exampleModalLabel">VIEW REPAIR DETAILS</p>
              </div>
              <a class="p-1" type="button" data-dismiss="modal" aria-label="Close" onclick="$('#modalView').modal('hide')">
                <span aria-hidden="true">&times;</span>
              </a>
            </div>

            <div id="view-table" class="modal-body">
              <form>
                <div class="container-fluid form-row">
                  <div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <label> Status: </label> <br>
                    <label> Date & Time: </label> <br>
                    <label> Requestee: </label> <br>
                    <label> Hardware Type: </label> <br>
                    <label> Property Number: </label> <br>
                    <label> Problem: </label> <br>
                    <label> Repair Category: </label> <br>
                  </div>

                  <div class="form-group col-lg-7 col-md-7 col-sm-12 col-xs-12" id="data">
                  </div>
                </div>

              </form>

            </div>

            <div class="modal-footer text-light mb-0" id="footer-buttons">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modalView').modal('hide')">Close</button>
            </div>
          </div>
          <!-- /#View Modal -->
        </div>
      </div>
    </div>
    <!-- /# Modal  -->

    <!-- Modal Done -->
    <div class="modal fade" id="modalDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!--  Done Modal  -->
          <div id="done-form">
            <?php view('includes/forms/pullout_done-form'); ?>
          </div>
          <!-- /#Done Modal -->
        </div>
      </div>
    </div>
    <!-- /# Modal  -->

    <!-- Modal Print -->
    <div class="modal fade" id="modalPrint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!--  Print Modal  -->
          <div id="printSorting-form">
            <?php view('includes/forms/printSorting-form', compact('depts', 'type')); ?>
          </div>
          <!-- /#Print Modal -->
        </div>
      </div>
    </div>
    <!-- /# Modal Print -->

    <!-- Modal View Repair Concern -->
    <div class="modal fade" id="modalViewConcern" tabindex="-1" role="dialog" aria-labelledby="modalViewConcern" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <p class="h5 modal-title text-uppercase mx-auto">VIEW CONCERN</p>
          </div>
          <div class="modal-body">
            <div class="concern card-text"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" onclick="$('#modalViewConcern').modal('hide')">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- /# Modal View Repair Concern -->

    <!-- Table Container -->
    <div class="container-fluid mt-2">
      <?php view('includes/tables/incomingrepair-tbl', compact('repairs')); ?>
    </div>
    <!-- /#Table Container -->

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
      <?= $links ?>
    </div>
    <!-- /# Pagination -->
  </div>
  <!-- /# Page Content -->

</div>
<!-- /# Wrapper -->

<!-- Script -->
<!-- <script type="text/javascript" src="</?= asset('js/repairs.js') ?>"></script> -->

<!-- /# Script -->
<?php view('includes/footer'); ?>
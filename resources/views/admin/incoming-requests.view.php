<?php view('includes/header'); ?>
<!-- /# Wrapper -->
<div class="d-flex" id="wrapper">

  <!-- Sidebar -->
  <?php view('includes/sidebar'); ?>
  <!-- /#Sidebar -->

  <!-- Page Content -->
  <div class="h-100 w-100">

    <!-- Page Title -->
    <?php view('includes/page-title'); ?>
    <!-- /# Page Title -->

    <div class="container-fluid h-100 mt-4">
      <div class="row">
        <!-- Search Field -->
        <div class="col-md-5">
          <div class="md-form">
            <i class="fas fa-search prefix"></i>
            <input type="text" class="form-control " id="search" placeholder="Search">
          </div>
        </div>
        <!-- /# Search Field -->

        <!-- Print Request Summary Button -->
        <?php if (count($requests)) : ?>
          <div class="mr-3 ml-auto">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Download Summary in MSword" id="printSummary"><i class="fa fa-download" aria-hidden="true"></i></button>
          </div>
        <?php endif; ?>
        <!-- /# Print Request Summary Button -->
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
                <p class="h5 modal-title text-uppercase" id="exampleModalLabel">VIEW REQUEST DETAILS</p>
              </div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div id="view-table" class="modal-body">
              <form>
                <div class="container-fluid form-row">
                  <div class="form-group col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <label> Status: </label> <br>
                    <label> Date&Time of Request: </label> <br>
                    <label> Requestee: </label> <br>
                    <label> Concern: </label> <br>

                    <div id="other-labels">
                    </div>
                  </div>
                  <div class="form-group col-lg-7 col-md-7 col-sm-12 col-xs-12" id="data">
                  </div>
                </div>
              </form>
            </div>

            <div class="modal-footer text-light mb-0" id="footer-buttons">
              <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /#View Modal -->
        </div>
      </div>
    </div>
    <!-- /# Modal  -->

    <!-- Modal Pullout / Done -->
    <div class="modal fade" id="modalPulloutDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!--  Pullout Modal  -->
          <div id="pullout-done-form">
            <?php view('includes/forms/pullout_done-form', compact('hardwarecomponents'));  ?>
          </div>
          <!-- /#Pullout Modal -->
        </div>
      </div>
    </div>
    <!-- /# Modal  -->

    <!-- Modal Print -->
    <div class="modal fade" id="modalPrint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <!--  Print Modal  -->
          <div id="printSorting-form">
            <?php
            view('includes/forms/printSorting-form', compact('depts', 'type'));
            ?>
          </div>
          <!-- /#Print Modal -->
        </div>
      </div>
    </div>
    <!-- /# Modal  -->

    <!-- Table Container -->
    <div id="incoming-requests" class="container-fluid mt-2">
      <!-- Incoming Requests Table -->
      <?php view('includes/tables/incomingrequest-tbl', compact('requests')); ?>
      <!-- /# Incoming Requests Table -->
    </div>
    <!--/#Table Container-->
  </div>
  <!-- /# Page Content -->
</div>
<!-- /# Wrapper -->

<!-- Script -->
<!-- <script type="text/javascript" src="</?= asset('js/requests.js') ?>"></script> -->
<!-- /# Script -->
<?php view('includes/footer'); ?>
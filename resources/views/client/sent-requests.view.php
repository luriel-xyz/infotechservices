<?php view('includes/header'); ?>

<?php view('client/toolbar'); ?>

<!-- Page Content -->
<div class="h-100 w-100">
  <div class="container-fluid h-100 mt-4">

    <div class="row">
      <p class="h1 mx-auto"> <?= user()->username ?> </p>
    </div>

    <?php if ($requestCount) : ?>
      <p class="h4 mx-auto text-center">
        <small>Sent Requests <strong><?= $requestCount ?></strong></small>
      </p>
    <?php endif; ?>
    <!-- <div class="row">
			    	</div> -->

    <hr class="border border-bottom border-success">

    <div class="col-lg-3">
      <input type="text" class="form-control " id="search" placeholder="Search">
    </div>

    <!-- Table Container -->
    <div class="container-fluid mt-2">
      <?php view('includes/tables/sentrequests-tbl', compact('requests')); ?>
    </div>
    <!--/#Table Container-->

  </div>
  <!--/# Container -->

  <!-- Modal View -->
  <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <!--  View Modal  -->
        <div id="view-form">
          <div class="modal-header text-dark pb-3 border-bottom">
            <div class="container-fluid text-center">
              <p class="h5 modal-title text-capitalize" id="exampleModalLabel">VIEW REQUEST DETAILS</p>
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
                  <label> Date & Time of Request: </label> <br>
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
</div>
<!-- /# Page Content -->

<?php view('includes/footer'); ?>
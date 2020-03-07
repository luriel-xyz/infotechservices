<?php view('includes/header'); ?>
<!-- Page Content -->
<div class="h-100 w-100">

  <?php view('client/toolbar'); ?>

  <div class="container-fluid h-100 mt-4">

    <div class="container">
      <h1 class="h3 text-center"> Welcome to Information Technology Services Request Page, <?= user()->username ?>.</h1>
    </div>

    <hr class="border border-bottom border-success">

    <div class="row h-100">
      <div class="mx-auto row ">
        <div class="col-lg-6">
          <div class="row text-center">
            <div class="col-12">
              <!-- Send Request Button -->
              <button class="btn btn-request btn-success" id="request" data-toggle="tooltip" data-placement="left" title="Request" onclick="$.redirect('<?= getPath('client/add-request.php') ?>')">
                <i class="fa fa-phone-square" aria-hidden="true"></i>
              </button>
              <!-- /# Send Request Button -->
            </div>
            <div class="col-12">
              <small>Send a request</small>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="row text-center">
            <div class="col-12">
              <!-- View Sent Requests Button -->
              <button class="btn btn-request btn-success" id="track" data-toggle="tooltip" data-placement="right" title="Track Requests" onclick="$.redirect('<?= getPath('client/sent-requests.php') ?>')">
                <i class="fa fa-eye" aria-hidden="true"></i>
              </button>
              <!-- /# View Sent Requests Button -->
            </div>
            <div class="col-12">
              <small>View Sent Requests</small>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!--/# Container -->
</div>
<!-- /# Page Content -->

<?php view('includes/footer'); ?>
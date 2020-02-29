<?php view('includes/header'); ?> 
<!-- Alerts -->
<?php if (isset($user)) : ?>
  <?php if (!$user) : ?>
    <div class="alert alert-danger text-center">Incorrect Entry!</div>
  <?php elseif (!$accountEnabled) : ?>
    <div class="alert alert-warning text-center">Entered User Account is Disabled!</div>
  <?php endif; ?>
<?php endif; ?>
<!-- /# Alerts -->

<!-- Page Content -->
<div class="h-100 w-100 row">
  <!--  Container -->
  <div class="container-fluid col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4 offset-md-4 my-auto">
    <?php view('includes/forms/login'); ?>
  </div>
  <!--/# Container -->
</div>
<!-- /# Page Content -->
<?php view('includes/footer'); ?>
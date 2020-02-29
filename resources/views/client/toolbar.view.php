<nav class="navbar navbar-expand-sm navbar-dark bg-success">

  <!-- Back Button -->
  <!-- Show when we're not at index.php -->
  <?php if (basename($_SERVER['PHP_SELF'], '.php') != 'index') : ?>
    <div class="ml-4 mt-2 p-0">
      <a href="<?= getPath('client/index.php') ?>" class="btn btn-link text-light" style="font-size: 1em;" role="button">
        <i class="fas fa-arrow-left"></i>
      </a>
    </div>
  <?php endif; ?>
  <!-- /# Back Button -->

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link text-light font-weight-bold text-capitalize" href="#">INFO TECH SERVICES</a>
      </li>
    </ul>
  </div>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link text-light font-weight-bold disabled"><?= user()->username; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="<?= logoutPath() ?>" data-toggle="tooltip" title="Logout">
          <i class="fa fa-sign-out-alt" aria-hidden="true"></i>
        </a>
      </li>
    </ul>
  </div>

</nav>
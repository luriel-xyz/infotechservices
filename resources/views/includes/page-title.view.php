<nav class="navbar navbar-expand-sm navbar-dark">
  <button class="btn btn-primary btn-sm mt-1" id="menu-toggle" data-toggle="tooltip" title="Toggle Sidebar" onclick="$('#wrapper').toggleClass('toggled')">
    <i class="fas fa-list" style="font-size: 1.3em;" aria-hidden="true"></i>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <span class="text-primary font-weight-bold text-capitalize" style="font-size:1.3em;">
          <?= pageTitle() ?>
        </span>
      </li>
    </ul>
  </div>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link text-primary font-weight-bold disabled"><?= user()->username ?></a>
      </li>
      <li class="nav-item">
        <a class="btn-logout nav-link text-primary" href="<?= logoutPath() ?>" data-toggle="tooltip" title="Logout" role="button"><i class="fas fa-sign-out-alt" aria-hidden="true"></i></a>
      </li>
    </ul>
  </div>

</nav>
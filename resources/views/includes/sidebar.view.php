<div class="border-right" id="sidebar-wrapper">
  <div class="row mb-2">
    <div class="col-6 offset-3">
      <img src="<?= asset('img/beng_cap_logo.png') ?>" class="w-100" alt="BenguetCapitolLogo">
    </div>
  </div>
  <div class="list-items border-top list-group list-group-flush mt-2">
    <a href="<?= getPath('admin/incoming-requests.php') ?>" class="btn btn-link m-0 list-group-item list-group-item-action text-dark border-bottom">
      <i class="fas fa-fw fa-bell" aria-hidden="true"></i>
      <span class="text-capitalize">Incoming Requests</span>
    </a>
    <a href="<?= getPath('admin/incoming-repairs.php') ?>" class="btn btn-link m-0 list-group-item list-group-item-action text-dark border-bottom">
      <i class="fas fa-fw fa-wrench" aria-hidden="true"></i>
      <span class="text-capitalize">Incoming Repairs</span>
    </a>

    <!-- The links that can only be accessed by the admin and programmer.  -->
    <?php if (in_array(user()->usertype, [ADMIN, PROGRAMMER])) : ?>
      <hr>
      <div class="border-bottom pl-2 pb-2">
        <div class="ml-4">
          <span class="font-weight-bold">Settings</span>
        </div>
      </div>
      <a href="<?= getPath('admin/settings/user-accounts.php') ?>" class="btn btn-link m-0 list-group-item list-group-item-action text-dark border-bottom">
        <i class="fas fa-fw fa-user" aria-hidden="true"></i>
        <span class="text-capitalize">User Accounts</span>
      </a>
      <a href="<?= getPath('admin/settings/employees.php') ?>" class="btn btn-link m-0 list-group-item list-group-item-action text-dark border-bottom">
        <i class="fas fa-fw fa-users" aria-hidden="true"></i>
        <span class="text-capitalize">Employees</span>
      </a>
      <a href="<?= getPath('admin/settings/departments.php') ?>" class="btn btn-link m-0 list-group-item list-group-item-action text-dark border-bottom">
        <i class="fas fa-fw fa-building" aria-hidden="true"></i>
        <span class="text-capitalize">Departments</span>
      </a>
      <a href="<?= getPath('admin/settings/hardware-components.php') ?>" class="btn btn-link m-0 list-group-item list-group-item-action text-dark border-bottom">
        <i class="fas fa-fw fa-desktop" aria-hidden="true"></i>
        <span class="text-capitalize">Hardware Components</span>
      </a>
    <?php endif; ?>

    <!-- <ul class="collapse list-unstyled" id="settingsSubmenu">
        <li class="list-group-item list-group-item-action text-dark border-bottom">
          <a href="</?= getPath('admin/settings/user-accounts.php') ?>">
            <span class="text-capitalize">User Accounts</span>
          </a>
        </li>
        <li class="list-group-item list-group-item-action text-dark border-bottom">
          <a href="</?= getPath('admin/settings/employees.php') ?>">
            <span class="text-capitalize">Employees</span>
          </a>
        </li>
        <li class="list-group-item list-group-item-action text-dark border-bottom">
          <a href="</?= getPath('admin/settings/departments.php') ?>">
            <span class="text-capitalize">Departments</span>
          </a>
        </li>
        <li class="list-group-item list-group-item-action text-white">
          <a href="</?= getPath('admin/settings/hardware-components.php') ?>">
            <span class="text-capitalize">Hardware Components</span>
          </a>
        </li>
      </ul> -->
  </div>
</div>
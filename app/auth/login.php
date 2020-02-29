<!--  login page  -->
<?php

use App\Auth;

require_once('../../config/init.php');

redirectIfLoggedIn();

$accountEnabled = false;
if (isset($_POST['login'])) {
  $username = strip_tags($_POST['username']);
  $password = strip_tags($_POST['password']);

  //pass login arguments
  $user = Auth::login($username, $password);

  if ($user) {
    session('user', $user);

    $accountEnabled = user()->status === '1';
    if ($accountEnabled) {
      $isClient = user()->usertype == 'department';
      $location = $isClient ? getPath('client/index.php') : getPath('admin/incoming-requests.php');
      redirect($location);
      exit;
    }
  }
}

view('auth/login', compact('user', 'accountEnabled'));
?>
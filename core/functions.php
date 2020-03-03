<?php

// Redirect to user dashboard if user is logged in
function redirectIfLoggedIn()
{
  if (!isUserLoggedIn()) {
    return;
  }

  if ($_POST['usertype'] == DEPARTMENT) {
    redirect(getPath('app/client/index.php'));
  } else {
    redirect(getPath('app/admin/incoming-repairs.php'));
  }
}

function logoutPath()
{
  if (!isUserLoggedIn()) {
    return;
  }

  $logoutPath = getPath('app/auth/logout.php');

  return $logoutPath;
}

function redirectToPreviousPage()
{
  // Go back to previous page.
  if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
    redirect($previous);
    exit;
  }
}

function redirect($url)
{
  header("Location: {$url}");
}

function isUserLoggedIn()
{
  return isset($_SESSION['user']);
}

function view($path, $data = [])
{
  extract($data);
  $dirname = dirname($path);
  $filename = pathinfo($path, PATHINFO_FILENAME);
  $path = VIEW . "/{$dirname}/{$filename}.view.php";
  require_once($path);
}

function asset($path)
{
  // $path = str_replace('assets', '', $path);
  // amazing

  $assetsDir = getPath("public/{$path}");

  return $assetsDir;
}

function getPath($path)
{
  $path = strtolower($path);
  $result = "./{$path}";
  if (!file_exists($result)) {
    $result = "../{$path}";
  }
  if (!file_exists($result)) {
    $result = "../../{$path}";
  }
  if (!file_exists($result)) {
    $result = "../../../{$path}";
  }
  if (!file_exists($result)) {
    $result = "../../../../{$path}";
  }
  if (!file_exists($result)) {
    $result = "../../../../../{$path}";
  }

  return $result;
}

function base($path = '')
{
  return ROOT . ($path ? "/{$path}" : '/');
}

function user()
{
  return $_SESSION['user'] ?? null;
}

function pageTitle()
{
  $str = basename($_SERVER['PHP_SELF'], '.php');
  return str_replace('-', ' ', $str);
}

function session($key, $val = null)
{
  if ($val != null) {
    $_SESSION[$key] = $val;
  } else {
    return $_SESSION[$key];
  }
}

// var_dump then die
function dd($any)
{
  echo "<pre style='background-color:#111;color:#fff';padding:0;margin:0;padding:2px 0;>";
  var_dump($any);
  echo "</pre>";
  die;
}
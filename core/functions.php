<?php

// Redirect to user dashboard if user is logged in
function redirectIfLoggedIn(): void
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

function logoutPath(): string
{
  return getPath('app/auth/logout.php');
}

function redirectToPreviousPage(): void
{
  if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
    redirect($previous);
  }
}

function redirect($url, $key = null, $val = null): void
{
  if (is_array($val)) {
    $val = array_filter($val);
  }

  session($key, $val);
  header("Location: {$url}");
  exit;
}

function isUserLoggedIn(): bool
{
  return isset($_SESSION['user']);
}

function view($path, $data = []): void
{
  extract($data);
  $dirname = dirname($path);
  $filename = pathinfo($path, PATHINFO_FILENAME);
  $path = VIEW . "/{$dirname}/{$filename}.view.php";
  require_once($path);
}

function asset($path): string
{
  // $path = str_replace('assets', '', $path);

  $assetsDir = getPath("public/{$path}");

  return $assetsDir;
}

function getPath($path): string
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

function base($path = ''): string
{
  return ROOT . ($path ? "/{$path}" : '/');
}

function user()
{
  return $_SESSION['user'] ?? null;
}

function pageTitle(): string
{
  return str_replace('-', ' ', currentPage());
}

/** Set or return a session data */
function session($key, $val = null)
{
  if ($val != null) {
    return $_SESSION[$key] = $val;
  } else {
    return $_SESSION[$key] ?? null;
  }
}

function currentPage(): string
{
  return basename($_SERVER['PHP_SELF'], '.php');
}

function truncate($str, $length): string
{
  if (strlen($str) <= $length) {
    return $str;
  } else {
    return substr($str, 0, $length) . '...';
  }
}

// var_dump then die
function dd($any): void
{
  $style = "background-color: #111;
            color: #fff;
            padding: 0;
            margin: 0;
            padding: 2px 0;";
  echo "<pre style='{$style}'>";
  var_dump($any);
  echo "</pre>";
  die;
}

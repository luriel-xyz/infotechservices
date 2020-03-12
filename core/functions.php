<?php

/**
 * Helper functions
 * @author Luriel Mapili
 * @version 1.0
 */


/**
 * Redirect to user dashboard if user is logged in.
 * @return void
 */
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

/**
 * Retrieve the logout path.
 * @return string
 */
function logoutPath(): string
{
  return getPath('app/auth/logout.php');
}

/**
 * Redirect to previous page.
 * @return void
 */
function redirectToPreviousPage(): void
{
  if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
    redirect($previous);
  }
}

/**
 * @param string $url - Redirect to this url.
 * @param mixed $key - Session key
 * @param mixed $val - Session value
 * @return void
 */
function redirect(string $url, $key = null, $val = null): void
{
  if (is_array($val)) {
    $val = array_filter($val);
  }

  session($key, $val);
  header("Location: {$url}");
  exit;
}

/**
 * Check if the session contains user data.
 * @return bool
 */
function isUserLoggedIn(): bool
{
  return isset($_SESSION['user']);
}

/**
 * Require a view file.
 * @param string $path - The path of the view file
 * @param array $data - The data to be passed to the view
 * @return void
 */
function view(string $path, array $data = []): void
{
  extract($data);
  $dirname = dirname($path);
  $filename = pathinfo($path, PATHINFO_FILENAME);
  $path = VIEW . "/{$dirname}/{$filename}.view.php";
  require_once($path);
}

/**
 * Return the path of the asset file.
 * @param string $path - The path of the asset
 * @return string
 */
function asset(string $path): string
{
  // $path = str_replace('assets', '', $path);

  return getPath("public/{$path}");
}

/**
 * Retrieve the relative path of a file.
 * @param string $path
 * @return string
 */
function getPath(string $path): string
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

/**
 * Return the absolute path of a file.
 * @param string $path
 * @return string
 */
function base(string $path = ''): string
{
  return ROOT . ($path ? "/{$path}" : '/');
}

/**
 * Retrieve user data from session
 * @return mixed
 */
function user()
{
  return session('user');
}

/**
 * Retrieve the current file name.
 * @return string
 */
function pageTitle(): string
{
  return str_replace('-', ' ', currentPage());
}

/** 
 * Set or return a session data 
 * @param mixed $key - Session key
 * @param mixed $val - Session value
 * @return mixed
 * */
function session($key, $val = null)
{
  if ($val != null) {
    return $_SESSION[$key] = $val;
  } else {
    return $_SESSION[$key] ?? null;
  }
}

/**
 * Retrieve the current php filename.
 * @return string
 */
function currentPage(): string
{
  return basename($_SERVER['PHP_SELF'], '.php');
}

/**
 * @param string $str
 * @param $length
 * @return string
 */
function truncate($str, $length): string
{
  $result = (strlen($str) <= $length) ? $str : substr($str, 0, $length) . '...';
  return $result;
}

/**
 * Dump and die
 * @param mixed $any
 * @return void
 */
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

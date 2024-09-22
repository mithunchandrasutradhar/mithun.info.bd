<?php

session_start();
require_once("config.php");

//database connection
$con = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("DB Error Occurred . $con->connect_error");



// redirect user to another page.. must be in double quote ""
function Redirect($path)
{
  header("location: $path");
  exit;
}

// go back utility function
function goback()
{
  header('location:' . $_SERVER['HTTP_REFERER']);
  exit;
}

// alert function
function setAlert($type, $msg)
{
  $_SESSION['alert'][] =
    "<div class='alert alert-$type alert-dismissible show fade removeAlert'>$msg<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
}

function getAlerts()
{
  if (isset($_SESSION['alert'])) {
    foreach ($_SESSION['alert'] as $alert) {
      echo $alert;
    }
    unset($_SESSION['alert']);
  }
}



//user login
function Login()
{
  global $con, $group;
  $sql = "SELECT * FROM users WHERE username = '$_POST[username]'";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    $user = $result->fetch_array();

    if (password_verify($_POST['password'], $user['password'])) {

      $_SESSION['login'] = true;
      $_SESSION['id'] = $user['id'];
      $_SESSION['name'] = $user['name'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['group_id'] = $user['group_id'];
      return true;
    }
    setAlert('danger', 'Wrong password');
  } else {
    setAlert('danger', 'No user found with this email.');
  }

  return false;
}

function logout()
{
  session_unset();
  session_destroy();
  Redirect(SITE_URL);
}

if (isset($_POST['logout'])) {
  logout();
  Redirect(SITE_URL);
}

//check login
function checklogin()
{
  if (!isset($_SESSION['login'])) {
    Redirect(SITE_URL . "/admin/login.php");
  }
}


// get data from sql query
function GetData($sql)
{
  global $con;
  $query = $con->query($sql);
  $result = [];
  if ($query) {
    while ($row = $query->fetch_assoc()) {
      $result[] = $row;
    }
  }

  return (count($result) < 1 ? false : $result);
}

// Create pagination
function MySQLDataPagination($mysqlQuery)
{
  global $con;

  //SET LIMIT
  if (empty($_SESSION['viewLimit'])) {
    $_SESSION['viewLimit'] = 10;
  }
  $limit = $_SESSION['viewLimit'];

  $page_num = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 0;
  if ($page_num == 0) $page_num = 1;

  //SET Starting
  $start = (isset($page_num) ? mysqli_real_escape_string($con, ($page_num - 1) * $limit) : 0);

  $content = GetData($mysqlQuery . " LIMIT $start, $limit");

  //Start Pagination
  $params = $_GET;
  unset($params['page']);
  $params['page'] = '';

  $cUrl = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '?' . http_build_query($params);

  $totalCount = $con->query($mysqlQuery)->num_rows;
  $totalPage = ceil($totalCount / $limit);

  $pHTML = "<nav>";
  $pHTML .= "<ul class='pagination pagination-primary justify-content-end'>";

  $pHTML .= "<li class='page-item " . ($page_num == 1 ? 'disabled' : '') . "'>";
  $pHTML .= "<a class='page-link' href='" . $cUrl . ($page_num > 1 ? ($page_num - 1) : '#') . "'>Previous</a>";
  $pHTML .= "</li>";

  $pHTML .= "<li class='page-item " . ($page_num == 1 ? 'active' : '') . "'>";
  $pHTML .= "<a class='page-link' href='" . $cUrl . "1'>1</a>";
  $pHTML .= "</li>";

  $pHTML .= ($page_num > 4 ? "<li class='page-item disabled'><a class='page-link'>...</a></li>" : "");
  $startLoop = ($page_num > 4 ? ($page_num - 2) : 2);
  $endLoop = ($page_num < ($totalPage - 3) ? ($page_num + 2) : ($totalPage - 1));
  for ($i = $startLoop; $i <= $endLoop; $i++) {
    $pHTML .= "<li class='page-item " . ($i == $page_num ? 'active' : '') . "'>";
    $pHTML .= "<a class='page-link' href='{$cUrl}{$i}'>{$i}</a>";
    $pHTML .= "</li>";
  }
  $pHTML .= ($page_num < ($totalPage - 3) ? "<li class='page-item disabled'><a class='page-link'>...</a></li>" : "");
  $pHTML .= ($totalPage > 1 ? "<li class='page-item " . ($i == $page_num ? "active" : "") . "'><a class='page-link' href={$cUrl}{$totalPage}>$totalPage</a></li>" : "");
  $pHTML .= "<li class='page-item " . ($page_num == $totalPage ? 'disabled' : '') . "'>";
  $pHTML .= "<a class='page-link' href='" . $cUrl . ($page_num < $totalPage ? ($page_num + 1) : '#') . "'>Next</a>";
  $pHTML .= "</li>";

  $pHTML .= "</ul>";
  $pHTML .= "</nav>";

  $info = "Showing " . ((($page_num - 1) * $_SESSION['viewLimit']) + 1) . " to " . (($page_num * $_SESSION['viewLimit']) > $totalCount ? $totalCount : ($page_num * $_SESSION['viewLimit'])) . " of {$totalCount}";

  //Start Paginate Info

  if ($_SESSION['viewLimit'] === 'all') {
    $pHTML = '';
    $info = "Showing " . $totalCount;
  }

  return ["content" => $content, "pagination" => $pHTML, "info" => $info];
}
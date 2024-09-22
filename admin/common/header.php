<?php
require_once('functions.php');

checklogin();

?>

<!DOCTYPE html>

<html lang="en">



<meta http-equiv="content-type" content="text/html;charset=utf-8" />



<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= $page_title; ?> | <?php echo SITE_NAME; ?></title>



<link rel="preconnect" href="https://fonts.gstatic.com/">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&amp;display=swap"
rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">

<link rel="stylesheet" href="./assets/css/bootstrap.css">



<link rel="stylesheet" href="./assets/vendors/iconly/bold.css">



<link rel="stylesheet" href="./assets/vendors/perfect-scrollbar/perfect-scrollbar.css">

<link rel="stylesheet" href="./assets/vendors/bootstrap-icons/bootstrap-icons.css">

<link rel="stylesheet" href="./assets/css/magnific-popup.css">

<link rel="stylesheet" href="./assets/css/app.css">

<link rel="stylesheet" href="./assets/css/app-dark.css">

<link rel="shortcut icon" href="./assets/images/favicon.png" type="image/x-icon">

</head>



<body class="theme-dark">

<div id="sidebar" class="active">

<div class="sidebar-wrapper active">

<div class="sidebar-header">

<div class="d-flex justify-content-between">

<div class="logo">

        <a href="<?= SITE_URL; ?>" class="logo-text">

          Mithun Sutradhar

        </a>

      </div>

  <div class="toggler">

    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>

  </div>

</div>

</div>

<div class="sidebar-menu">

<?php include('menu.php') ?>

</div>

<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>

</div>

</div>

<div id="main">

<header class="mb-3">

<a href="#" class="burger-btn d-block d-xl-none">

<i class="bi bi-justify fs-3"></i>

</a>

</header>
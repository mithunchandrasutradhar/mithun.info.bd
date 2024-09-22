<?php
include_once("./common/functions.php")
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Access Forbidden</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/bootstrap.css">
  <link rel="stylesheet" href="./assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="./assets/css/app.css">
  <link rel="stylesheet" href="./assets/css/pages/error.css">
  
  <link rel="shortcut icon" href="./assets/images/favicon.png" type="image/x-icon">
</head>

<body>
  <div id="error">


    <div class="error-page container">
      <div class="row">
        <div class="col-12">
        <img class="img-fluid d-block m-auto" src="./assets/images/error-403.png"
          alt="Not Found" width="700" height="700">
        <div class="text-center">
          <h1 class="error-title">Forbidden</h1>
          <p class="fs-5 text-gray-600">You are unauthorized to access this page.</p>
          <a href="javascript:logout()" class="btn btn-lg btn-outline-primary mt-3">Go Home</a>
        </div>
      </div>
      </div>
      
    </div>


  </div>
  <form method="post" action="" id="logout" class="d-none">
  <input type="hidden" name="logout">
</form>
  <script>
  function logout() {
    sessionStorage.clear();
    $('#logout').submit();
  }
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
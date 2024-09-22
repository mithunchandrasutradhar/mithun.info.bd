<?php
$pageTitle = "Login ";
require_once('./common/functions.php');


if (isset($_SESSION['login'])) {
  Redirect(SITE_URL . "/admin/index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $password = "";
  $err = [];
  $requiredFields = ['username', 'password'];
  $validated = true;
  foreach ($requiredFields as $field) {
    if (isset($_POST[$field]) && $_POST[$field] <> "") {
      $_POST[$field] = mysqli_real_escape_string($con, $_POST[$field]);
    } else {
      $validated = false;
      $err[$field] = ucwords($field) . " is empty";
    }
  }

  if ($validated && Login()) {
    setAlert('success', 'Welcome Back!!!');
    Redirect(SITE_URL . "/admin/index.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle; ?> | <?php echo SITE_NAME; ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="stylesheet" href="assets/css/pages/auth.css">
  <link rel="shortcut icon" href="./assets/images/favicon.png" type="image/x-icon">
</head>

<body>
  <div id="auth">

    <div class="row h-100">
      <div class="col-lg-5 col-12">
        <div id="auth-left">
          <div class="auth-logo">
            <a href="/"><img class="img-fluid" loading="lazy" src="./assets/images/logo.png"
                alt="Mithun Chandra Sutradhar" width="300" height="100"></a>
          </div>
          <h1 class="auth-title">Log in</h1>
          <p class="auth-subtitle mb-5">Log in with your data and change your personal information easily.</p>

          <form action="" method="POST">
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="text" class="form-control form-control-xl" name="username" placeholder="Username" required>
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="password" class="form-control form-control-xl" name="password" placeholder="Password"
                required>
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            <div class="form-check form-check-lg d-flex align-items-end">
              <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault" required>
              <label class="form-check-label text-gray-600" for="flexCheckDefault">
                Remember Me
              </label>
            </div>
            <?php getAlerts(); ?>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
          </form>
        </div>
      </div>
      <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
      </div>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./assets/js/bootstrap.bundle.min.js"></script>

  <script>
  $(function() {
    setTimeout(function() {
      $(".removeAlert").slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  });
  </script>

</body>

</html>
<?php
$page_title = "Profile";
include_once('./common/header.php');
?>

<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3><?= $page_title; ?></h3>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $page_title; ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<?php
getAlerts();
$info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `users` WHERE id = $_SESSION[id]"));

?>
<div class="page-content">

  <section class="section">
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <div class="card p-5">
          <div class="float-end">
            <a data-bs-toggle="modal" data-bs-target="#ajaxModal"
              data-href="./modals/profile.php?id=<?= $info['id']; ?>">
              <div class="stats-icon purple" Title="Edit Inforamtion">
                <i class="iconly-boldEdit-Square"></i>
              </div>
            </a>
          </div>

          <div class="profile-picture text-center mb-3">
            <img class="img-fluid rounded-circle border border-4" loading="lazy"
              src="./assets/images/<?= $info['avatar']; ?>?v=<?= rand(); ?>" alt="<?= $info['name']; ?>" width="200"
              height="200" style="width:200px; height:200px;object-fit:cover;">
          </div>
          <hr>
          <p class="mb-0"><strong>Name:</strong> <?= $info['name']; ?></p>
          <hr>
          <p class="mb-0"><strong>Role:</strong> <?= $info['group_name']; ?></p>

          <hr>
          <p class="mb-0"><strong>Email:</strong> <?= $info['email']; ?></p>
          <hr>
          <p class="mb-0"><strong>Phone:</strong> <?= $info['phone']; ?></p>
          <hr>

        </div>
      </div>
    </div>
  </section>
</div>
<?php include('./common/footer.php'); ?>
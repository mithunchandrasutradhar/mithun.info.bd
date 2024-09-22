<?php
$page_title = "Feedback";
include_once('./common/admin_header.php');
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

$total_feedback = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as total_feedback FROM `feedback`"));
$active_feedback = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as active_feedback FROM `feedback` WHERE `status` = 1"));
$pending_feedback = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as pending_feedback FROM `feedback` WHERE `status` = 0"));

?>
<div class="page-content">
  <div class="row">
    <!--Total News Section Start-->
    <div class="col-6 col-lg-4 col-md-6">
      <div class="card">
        <div class="card-body px-3 py-4-5">
          <div class="row">
            <div class="col-md-4">
              <div class="stats-icon purple">
                <i class="iconly-boldDocument"></i>
              </div>
            </div>
            <div class="col-md-8">
              <h6 class="text-muted font-semibold">
                Total Feedback
              </h6>
              <h6 class="font-extrabold mb-0"><?= $total_feedback['total_feedback']; ?></h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Total News Section End-->
    <!--Active News Section Start-->
    <div class="col-6 col-lg-4 col-md-6">
      <div class="card">
        <div class="card-body px-3 py-4-5">
          <div class="row">
            <div class="col-md-4">
              <div class="stats-icon green">
                <i class="iconly-boldTick-Square"></i>
              </div>
            </div>
            <div class="col-md-8">
              <h6 class="text-muted font-semibold">Active Feedback</h6>
              <h6 class="font-extrabold mb-0"><?= $active_feedback['active_feedback']; ?></h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Active News Section End-->
    <!--Pending News Section Start-->
    <div class="col-6 col-lg-4 col-md-6">
      <div class="card">
        <div class="card-body px-3 py-4-5">
          <div class="row">
            <div class="col-md-4">
              <div class="stats-icon bg-warning">
                <i class="iconly-boldInfo-Square"></i>
              </div>
            </div>
            <div class="col-md-8">
              <h6 class="text-muted font-semibold">Pending Feedback</h6>
              <h6 class="font-extrabold mb-0"><?= $pending_feedback['pending_feedback']; ?></h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Pending News Section End-->
  </div>
  <section class="section">
    <div class="row" id="table-bordered">
      <div class="col-12">
        <div class="card">
          <div class="align-items-center card-header d-flex justify-content-between">
            <h4 class="card-title"><?= $page_title; ?> list</h4>
            <a data-bs-toggle="modal" data-bs-target="#ajaxModal" data-href="../modals/admin_feedback.php?mode=add">
              <div class="stats-icon purple" Title="Add">
                <i class="iconly-boldPlus"></i>
              </div>
            </a>
          </div>

          <div class="card-body">
            <!-- table bordered -->
            <?php

            $data = MySQLDataPagination("SELECT f.*,f.id AS feed_id, f.published_on AS published, u1.id, u1.name AS created_by, u1.group_id AS group_id, u1.group_name AS group_name, u2.name AS published_on FROM `feedback` AS f JOIN `users` AS u1 ON f.created_by = u1.id JOIN `users` AS u2 ON f.published_on = u2.id ORDER BY f.id DESC");
            if (!$data['content']) {

              echo '<h4>Sorry, no data found.</h4>';
            } else {
              echo '
            <div class="table-responsive">
              <table class="table table-bordered mb-0">

                
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Published On</th>
                    <th>Time</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>';

              foreach ($data['content'] as $item) {

                $created = date_create($item['created']);
                $created = $created->format('M d, Y');
                echo '<tr>
                    <td><a data-bs-toggle="modal" data-bs-target="#ajaxModal" title="View News"
                        data-href="../modals/admin_feedback.php?mode=view&id=' . $item['feed_id'] . '">' . substr($item['name'], 0, 10) . '</a></td>
                    <td class="text-center">
                    <a class="img-popup" href="../assets/img/testimonials/' . $item["image"] . '"><i class="bi bi-image" Title="View Image"></i></a>
                    </td>
                    
                    <td>' . substr($item['description'], 0, 35) . '</td>
                    <td class="text-center">' .  ($item['status'] == 1 ? '<i class="bi bi-check-circle-fill text-success"></i>' : '<i class="bi bi-x-circle-fill text-danger"></i>')  . '</td>
                    <td>' . ($item['group_id'] == 1 ? 'Admin' : substr($item['created_by'], 0, 15)) . '</td>
                    <td>' . ($item['published'] == 1 ? 'Website' : substr($item['published_on'], 0, 13)) . '</td>
                    <td>' . $created . '</td>
                    <td class="d-flex justify-content-around"><a data-bs-toggle="modal" data-bs-target="#ajaxModal"
                        data-href="../modals/admin_feedback.php?mode=edit&id=' . $item['feed_id'] . '"><i
                          class="bi bi-pencil-square" title="Edit"></i></a>';
                echo '<a data-bs-toggle="modal" data-bs-target="#ajaxModal" data-href="../modals/admin_feedback.php?mode=delete&id=' . $item['feed_id'] . '"><i class="bi bi-trash" title="Delete"></i></a>
                    </td>
                  </tr>';
              }
              echo '</tbody>';
            } ?>
            </table>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-lg-6">
                <p><?php echo $data['info']; ?></p>
              </div>
              <div class="col-lg-6">
                <nav aria-label="Page navigation example">
                  <?php echo $data['pagination']; ?>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
</div>
<?php include('./common/footer.php'); ?>
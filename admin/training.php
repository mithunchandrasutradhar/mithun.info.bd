<?php
$page_title = "Training";
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
?>
<div class="page-content">
  <section class="section">
    <div class="row" id="table-bordered">
      <div class="col-12">
        <div class="card">
          <div class="align-items-center card-header d-flex justify-content-between">
            <h4 class="card-title"><?= $page_title; ?> list</h4>
            <a data-bs-toggle="modal" data-bs-target="#ajaxModal" data-href="modals/training.php?mode=add">
              <div class="stats-icon purple" Title="Add">
                <i class="iconly-boldPlus"></i>
              </div>
            </a>
          </div>

          <div class="card-body">
            <!-- table bordered -->
            <?php

            $data = MySQLDataPagination("SELECT * FROM `training` ORDER BY `id` DESC");
            if (!$data['content']) {

              echo '<h4>Sorry, no data found.</h4>';
            } else {
              echo '
            <div class="table-responsive">
              <table class="table table-bordered mb-0">

                
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Institute</th>
                    <th>Country</th>
                    <th>Description</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Manage</th>
                  </tr>
                </thead>
                <tbody>';

              foreach ($data['content'] as $item) {
                echo '<tr>
                    <td>' . $item['title'] . '</td>    
                    <td>' . $item['institute'] . '</td>
                    <td>' . $item['country'] . '</td>
                    <td>' . $item['description'] . '</td>
                    <td>' . $item['year'] . '</td>
                    <td class="text-center">' .  ($item['status'] == 1 ? '<i class="bi bi-check-circle-fill text-success"></i>' : '<i class="bi bi-x-circle-fill text-danger"></i>')  . '</td>
                    <td class="d-flex justify-content-around"><a data-bs-toggle="modal" data-bs-target="#ajaxModal"
                        data-href="modals/training.php?mode=edit&id=' . $item['id'] . '"><i
                          class="bi bi-pencil-square" title="Edit"></i></a>';
                echo '<a data-bs-toggle="modal" data-bs-target="#ajaxModal" data-href="modals/training.php?mode=delete&id=' . $item['id'] . '"><i class="bi bi-trash" title="Delete"></i></a>
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
<?php
$page_title = "Dashboard";
include_once('./common/header.php');

?>

<div class="page-heading">
  <h3><?= $page_title; ?></h3>
</div>
<?php
getAlerts();
$total_services = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as total_services FROM `services`"));
$total_projects = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as total_projects FROM `projects`"));
$total_testimonials = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as total_testimonials FROM `testimonials`"));
$total_photos = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(id) as total_photos FROM `gallery`"));
$info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `users` WHERE id = $_SESSION[id]"));
?>
<div class="page-content">
  <section class="row">
    <div class="col-lg-9">
      <div class="row">
        <div class="col-6 col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon purple mb-2">
                    <i class="iconly-boldTicket-Star"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">
                    Services
                  </h6>
                  <h6 class="font-extrabold mb-0"><?= $total_services['total_services']; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon purple mb-2">
                    <i class="iconly-boldGraph"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">
                    Projects
                  </h6>
                  <h6 class="font-extrabold mb-0"><?= $total_projects['total_projects']; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon blue mb-2">
                    <i class="iconly-boldChat"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Testimonials</h6>
                  <h6 class="font-extrabold mb-0"><?= $total_testimonials['total_testimonials']; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-xl-3 col-lg-6 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                  <div class="stats-icon green mb-2">
                    <i class="iconly-boldImage"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Gallery</h6>
                  <h6 class="font-extrabold mb-0"><?= $total_photos['total_photos']; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="col-lg-3">
      <div class="card">
        <div class="card-body py-4 px-4">
          <div class="d-flex align-items-center">
            <div class="avatar avatar-xl">
              <img class="img-fluid" loading="lazy" src="./assets/images/<?= $info['avatar']; ?>?v=<?= rand(); ?>"
                alt="<?= $info['name']; ?>" />
            </div>
            <div class="ms-3 name">
              <h5 class="font-bold"><?= $info['name']; ?></h5>
              <h6 class="text-muted mb-0"><?= $info['username']; ?></h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Profile Visit</h4>
          </div>
          <div class="card-body">
            <div id="chart-profile-visit"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="assets/vendors/apexcharts/apexcharts.min.js"></script>

<script>
var optionsProfileVisit = {
  annotations: {
    position: "back",
  },
  dataLabels: {
    enabled: false,
  },
  chart: {
    type: "bar",
    height: 300,
  },
  fill: {
    opacity: 1,
  },
  plotOptions: {},
  series: [{
    name: "Viewer",
    data: [9, 20, 30, 20, 10, 20, 30, 20, 10, 20, 30, 20],
  }, ],
  colors: "#435ebe",
  xaxis: {
    categories: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
  },
}


var chartProfileVisit = new ApexCharts(
  document.querySelector("#chart-profile-visit"),
  optionsProfileVisit
)

chartProfileVisit.render()
</script>
<?php include('./common/footer.php'); ?>
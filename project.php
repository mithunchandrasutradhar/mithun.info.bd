<!DOCTYPE html>
<html lang="en">

<?php require 'head.php' ?>

<body class="template-color-1 spybody box-wrapper" data-spy="scroll" data-target=".navbar-example2" data-offset="70">


  <?php require 'desktopmenu.php' ?>
  <?php require 'mobilemenu.php' ?>
  <main class="main-page-wrapper">

    <!-- Start Project Area -->
    <div class="rn-portfolio-area rn-section-gap section-separator" id="project">
      <div class="container">

        <div class="row row--25 mt--10 mt_md--10 mt_sm--10 project-filter">
          <?php

                    $data = GetData("SELECT * FROM `projects` WHERE `status` = '1' ORDER BY `id` DESC");
                    $delay = 100;
                    $project = 1;
                    foreach ($data as $item) {
                        echo '  
                    <div data-aos="fade-up" data-aos-delay="100" data-aos-once="true"
                        class="col-lg-6 col-xl-4 col-md-6 col-12 mt--30 mt_md--25 mt_sm--25">
                        <div class="rn-portfolio" data-bs-toggle="modal" data-bs-target="#project' . $project . '">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="javascript:void(0)">
                                        <img class="img-fluid" loading="lazy" src="assets/images/projects/' . $item['image'] . '"
                                            alt="' . $item['title'] . '" width="342" height="228">
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="category-info">
                                        <div class="category-list">
                                            <a href="javascript:void(0)">' . $item['domain'] . '</a>
                                        </div>
                                    </div>
                                    <h4 class="title"><a href="javascript:void(0)">' . $item['title'] . ' <i
                                                class="feather-arrow-up-right"></i></a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="project' . $project . '" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i data-feather="x"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row align-items-center">

                                        <div class="col-lg-6">
                                            <div class="portfolio-popup-thumbnail">
                                                <div class="image">
                                                    <img class="w-100" loading="lazy" src="assets/images/projects/' . $item['image'] . '"
                                                        alt="' . $item['title'] . '" width="545" height="363">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="text-content">
                                                <h3>
                                                    <span>' . $item['domain'] . '</span> ' . $item['title'] . '
                                                </h3>
                                                <p class="mb--30">' . $item['description'] . '</p>
                                                <div class="button-group mt--20">
                                                    <a href="' . $item['url'] . '" target="_blank" class="rn-btn">
                                                        <span>VIEW PROJECT</span>
                                                        <i data-feather="chevron-right"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
                        $delay += 200;
                        $project++;
                    }
                    ?>

        </div>
      </div>
    </div>
    <!-- End Project Area -->

    <?php require 'contactform.php' ?>
    <!-- Back to  top Start -->
    <div class="backto-top">
      <div>
        <i data-feather="arrow-up"></i>
      </div>
    </div>
    <!-- Back to top end -->

  </main>
  <?php require 'footer.php' ?>
</body>

</html>
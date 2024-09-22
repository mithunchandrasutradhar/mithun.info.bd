        <!-- Start Project Area -->
        <div class="rn-portfolio-area rn-section-gap section-separator" id="project">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="section-title text-center">
                  <span class="subtitle">Project</span>
                  <h2 class="title">My Amazing Work</h2>
                </div>
              </div>
            </div>

            <div class="row row--25 mt--10 mt_md--10 mt_sm--10">
              <?php

                    $data = GetData("SELECT * FROM `projects` WHERE `status` = '1' AND `home` = '1' ORDER BY `id` DESC LIMIT 8");
                    $delay = 100;
                    $project = 1;
                    foreach ($data as $item) {
                        echo '  
                    <!-- Start Single Portfolio -->
                    <div data-aos="fade-up" data-aos-delay="100" data-aos-once="true"
                        class="col-lg-6 col-xl-3 col-md-6 col-12 mt--25 mt_md--25 mt_sm--25">
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
                    <!-- End Single Portfolio -->
                    <!-- Modal Portfolio Body area Start -->
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
                                            <!-- End of .text-content -->
                                        </div>
                                    </div>
                                    <!-- End of .row Body-->
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
            <div class="text-center  mt--45">
              <a class="rn-btn" href="project.php"><span>View All Projects</span></a>
            </div>
          </div>
        </div>
        <!-- End Project Area -->
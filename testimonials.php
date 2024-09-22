        <!-- Start Testimonia Area  -->
        <div class="rn-testimonial-area rn-section-gap section-separator" id="testimonial">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="section-title text-center">
                  <span class="subtitle">Testimonials</span>
                  <h2 class="title">What People Say</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="testimonial-activation testimonial-pb mb--30">
                  <?php

                  $data = GetData("SELECT * FROM `testimonials` WHERE `status` = '1' ORDER BY `id` ASC");
                  foreach ($data as $item) {
                    $date = date_create($item['date']);
                    $date = $date->format('M d, Y');
                    echo '  
                  <!-- Start Single testiminail -->
                  <div class="testimonial mt--50 mt_md--40 mt_sm--40">
                    <div class="inner">
                      <div class="card-info">
                        <div class="card-thumbnail">
                          <img class="img-fluid" loading="lazy" src="assets/images/testimonials/' . $item['image'] . '"
                            alt="' . $item['name'] . '" width="335" height="252">
                        </div>
                        <div class="card-content">
                          <span class="subtitle mt--10"></span>
                          <h3 class="title">' . $item['name'] . '</h3>
                          <span class="designation">' . $item['designation'] . '</span>
                        </div>
                      </div>
                      <div class="card-description">
                        <div class="title-area">
                          <div class="title-info">
                            <h3 class="title">' . $item['title'] . '</h3>
                            <span class="date">via ' . $item['source'] . ' - ' . $date . '</span>
                          </div>
                          <div class="rating">
                            <img src="assets/images/icons/rating.png" alt="rating-image">
                            <img src="assets/images/icons/rating.png" alt="rating-image">
                            <img src="assets/images/icons/rating.png" alt="rating-image">
                            <img src="assets/images/icons/rating.png" alt="rating-image">
                            <img src="assets/images/icons/rating.png" alt="rating-image">
                          </div>
                        </div>
                        <div class="seperator"></div>
                        <p class="discription">' . $item['description'] . '</p>
                      </div>
                    </div>
                  </div>
                  <!--End Single testiminail -->
                ';
                    $delay += 50;
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Testimonia Area  -->
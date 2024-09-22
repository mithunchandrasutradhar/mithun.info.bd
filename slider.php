    <!-- Start Slider Area -->

    <div id="about" class="rn-slider-area">

      <div class="slide slider-style-1">

        <div class="container">

          <div class="row row--30 align-items-center">

            <div class="order-2 order-lg-1 col-lg-7 mt_md--50 mt_sm--50 mt_lg--30">

              <div class="content">

                <div class="inner">

                  <span class="subtitle">Welcome to my world</span>

                  <h1 class="title">Hi, I’m <span>Mithun</span><br><span class="passion">Full Stack Web Developer</span></h1>

                  <div>

                    <p class="description">I'm a creative Full Stack Web Developer who has the

                      ability to complete any project on my own. I'm a Computer

                      Engineer and I've completed B.Sc. in Computer Science & Engineering.

                    </p>

                  </div>

                </div>

                <div class="row">

                  <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12">

                    <div class="social-share-inner-left">

                      <span class="title">connect with me</span>

                      <ul class="social-share d-flex liststyle">

                        <li class="github"><a href="https://github.com/mithunchandrasutradhar" target="_blank"><i

                              data-feather="github"></i></a>

                        </li>

                        <li class="linkedin"><a

                            href="https://www.linkedin.com/in/mithun-chandra-sutradhar/"

                            target="_blank"><i data-feather="linkedin"></i></a>

                        </li>
                       <li class="whatsapp"><a

                            href="https://wa.me/+8801739909819"

                            target="_blank"><img class="img-fluid" loading="lazy" src="assets/images/icons/whatsapp.svg" alt="WhatsApp" width="18" height="18""></a>

                        </li>

                        <li class="facebook"><a href="https://www.facebook.com/mithun.chandra.96/"

                            target="_blank"><i data-feather="facebook"></i></a>

                        </li>

                      </ul>

                    </div>

                  </div>

                  <div class="col-lg-6 col-xl-6 col-md-6 col-sm-6 col-12 mt_mobile--30">

                    <div class="skill-share-inner">

                      <span class="title">best skill on</span>

                      <ul class="skill-share d-flex liststyle">

<?php

                    $data = GetData("SELECT * FROM `skills` WHERE `status` = '1' AND `best` = '1' ORDER BY `id` ASC");
                    $delay = 100;
                    foreach ($data as $item) {
                      echo ' 
                                        <li>
                                            <img class="img-fluid" loading="lazy" src="assets/images/skills/' . $item['image'] . '" alt="' . $item['title'] . '" width="23" height="23"">
                                        </li>
                                        ';
                      $delay += 50;
                    }
                    ?>
                      </ul>

                    </div>

                  </div>

                </div>

              </div>

            </div>



            <div class="order-1 order-lg-2 col-lg-5">

              <div class="thumbnail">

                <div class="inner">

                  <img class="img-fluid" loading='lazy' src="assets/images/slider/mithun-chandra-sutradhar.png"

                    alt="Mithun Chandra Sutradhar" title="Mithun Chandra Sutradhar" width="508" height="697">

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <!-- End Slider Area -->
       <!-- Start Company Area  -->
       <div class="rn-client-area rn-section-gap section-separator" id="clients">
         <div class="container">
           <div class="row">
             <div class="col-lg-12">
               <div class="section-title text-center">
                 <span class="subtitle">Company</span>
                 <h2 class="title">My Contribution</h2>
               </div>
             </div>
           </div>
           <div class="row row--25 mt--50 mt_md--40 mt_sm--40">
             <div class="col-lg-12">
               <div class="d-flex align-items-start">
                 <div class="client-card">
                   <?php

                    $data = GetData("SELECT * FROM `company` WHERE `status` = '1' ORDER BY `id` ASC");
                    $delay = 100;
                    foreach ($data as $item) {
                      echo '
                               <!-- Start Single Brand  -->
                               <div class="main-content" data-aos="fade-up" data-aos-duration="500" data-aos-delay="' . $delay . '" data-aos-once="true">
                                   <div class="inner text-center">
                                       <div class="thumbnail">
                                           <a href="' . $item['url'] . '" target="_blank">
                                               <img class="img-fluid" loading="lazy" src="assets/images/company/' . $item['image'] . '" alt="' . $item['title'] . '" width="90" height="90">
                                           </a>
                                       </div>
                                       <div class="seperator"></div>
                                       <div class="client-name">
                                           <span>
                                               <a href="' . $item['url'] . '" target="_blank">' . $item['title'] . '</a>
                                           </span>
                                       </div>
                                   </div>
                               </div>
                               <!-- End Single Brand  -->
                ';
                      $delay += 50;
                    }
                    ?>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
       <!-- End Company Area -->
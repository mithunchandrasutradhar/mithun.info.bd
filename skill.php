     <!-- Start Resume Area -->
     <div class="rn-resume-area rn-section-gap section-separator" id="skill">
       <div class="container">
         <div class="row">
           <div class="col-lg-12">
             <div class="section-title text-center">
               <span class="subtitle">Skills</span>
               <h2 class="title">My Technical Skills</h2>
             </div>
           </div>
         </div>
         <div class="row mt--45 justify-content-center">

           <div class="col-lg-12">
             <div class="personal-experience-inner mt--40">
               <div class="mt_md--40 mt_sm--40">
                 <ul class="skill-style-1">
                   <?php

                    $data = GetData("SELECT * FROM `skills` WHERE `status` = '1' ORDER BY `id` ASC");
                    $delay = 100;
                    foreach ($data as $item) {
                      echo ' 
                                            <li data-aos="fade-up" data-aos-duration="500" data-aos-delay="' . $delay . '" data-aos-once="true" title="' . $item['title'] . '">
                                                <img class="img-fluid" loading="lazy" src="assets/images/skills/' . $item['image'] . '" alt="' . $item['title'] . '" width="100" height="100">
                                            </li>
                                            ';
                      $delay += 50;
                    }
                    ?>
                 </ul>
               </div>
             </div>
             <!-- Start Tab Content Wrapper  -->
           </div>
         </div>
       </div>
     </div>
     <!-- End Resume Area -->
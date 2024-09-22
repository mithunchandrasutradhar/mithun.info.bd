     <!-- Start Resume Area -->
     <div class="rn-resume-area rn-section-gap section-separator" id="resume">
       <div class="container">
         <div class="row">
           <div class="col-lg-12">
             <div class="section-title text-center">
               <span class="subtitle">Educations & Jobs</span>
               <h2 class="title">Educational Qualifications & Job Experiences</h2>
             </div>
           </div>
         </div>
         <div class="row mt--45 justify-content-center">

           <div class="col-lg-12">
             <!-- Start Tab Content Wrapper  -->
             <div class="personal-experience-inner mt--40">
               <div class="row">
                 <!-- Start Skill List Area  -->
                 <div class="col-lg-6 col-md-12 col-12">
                   <div class="content">
                     <span class="subtitle">2013 - Present</span>
                     <h4 class="maintitle">Education Qualifications</h4>
                     <div class="experience-list">

                       <?php

                        $data = GetData("SELECT * FROM `qualifications` WHERE `status` = '1' ORDER BY `id` ASC");
                        foreach ($data as $item) {
                          echo ' 
                          <!-- Start Single List  -->
                          <div class="resume-single-list">
                            <div class="inner">
                              <div class="heading">
                                <div class="title">
                                  <h4>' . $item['title'] . '</h4>
                                  <span>' . $item['institute'] . '</span>
                                  <span>' . $item['country'] . '</span>
                                </div>
                                <div class="date-of-time">
                                  <span>' . $item['year'] . '</span>
                                </div>
                              </div>
                              <p class="description">' . $item['description'] . '</p>
                            </div>
                          </div>
                          <!-- End Single List  -->
      ';
                        }
                        ?>
                     </div>
                   </div>
                   <div class="content mt--65">
                     <span class="subtitle">2014 - Present</span>
                     <h4 class="maintitle">Training Experiences</h4>
                     <div class="experience-list">

                       <?php

                        $data = GetData("SELECT * FROM `training` WHERE `status` = '1' ORDER BY `id` ASC");
                        foreach ($data as $item) {
                          echo ' 
                          <!-- Start Single List  -->
                          <div class="resume-single-list">
                            <div class="inner">
                              <div class="heading">
                                <div class="title">
                                  <h4>' . $item['title'] . '</h4>
                                  <span>' . $item['institute'] . '</span>
                                  <span>' . $item['country'] . '</span>
                                </div>
                                <div class="date-of-time">
                                  <span>' . $item['year'] . '</span>
                                </div>
                              </div>
                              <p class="description">' . $item['description'] . '</p>
                            </div>
                          </div>
                          <!-- End Single List  -->
      ';
                        }
                        ?>
                     </div>
                   </div>
                 </div>
                 <!-- End Skill List Area  -->

                 <!-- Start Skill List Area 2nd  -->
                 <div class="col-lg-6 col-md-12 col-12 mt_md--60 mt_sm--60">
                   <div class="content">
                     <span class="subtitle">2020 - Present</span>
                     <h4 class="maintitle">Job Experiences</h4>
                     <div class="experience-list">

                       <?php

                        $data = GetData("SELECT * FROM `jobs` WHERE `status` = '1' ORDER BY `id` ASC");
                        foreach ($data as $item) {
                          echo ' 
                          <!-- Start Single List  -->
                          <div class="resume-single-list">
                            <div class="inner">
                              <div class="heading">
                                <div class="title">
                                  <h4>' . $item['title'] . '</h4>
                                  <span>' . $item['institute'] . '</span>
                                  <span>' . $item['country'] . '</span>
                                </div>
                                <div class="date-of-time">
                                  <span>' . $item['year'] . '</span>
                                </div>
                              </div>
                              <p class="description">' . $item['description'] . '</p>
                            </div>
                          </div>
                          <!-- End Single List  -->
      ';
                        }
                        ?>



                     </div>
                   </div>
                 </div>
                 <!-- End Skill List Area  -->
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     <!-- End Resume Area -->
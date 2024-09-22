<!-- Start Service Area -->
<div class="rn-service-area rn-section-gap section-separator" id="whatido">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title text-left" data-aos="fade-up" data-aos-duration="500" data-aos-delay="100"
          data-aos-once="true">
          <span class="subtitle">Services</span>
          <h2 class="title">What I Do</h2>
        </div>
      </div>
    </div>
    <div class="row row--25 mt_md--10 mt_sm--10">
      <?php

      $data = GetData("SELECT * FROM `services` WHERE `status` = '1' ORDER BY `id` ASC");
      $delay = 100;
      foreach ($data as $item) {
        echo '   
                            <!-- Start Single Service -->
            <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="' . $delay . '" data-aos-once="true" class="col-lg-6 col-xl-4 col-md-6 col-sm-12 col-12 mt--30 mt_md--25 mt_sm--25">
                <div class="rn-service">
                    <div class="inner">
                        <div class="icon">' . $item['icon'] . '</div>
                        <div class="content">
                            <h4 class="title">' . $item['title'] . '</h4>
                            <p class="description">' . $item['description'] . '</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End SIngle Service -->
                ';
        $delay += 50;
      }
      ?>



    </div>
  </div>
</div>
<!-- End Service Area  -->
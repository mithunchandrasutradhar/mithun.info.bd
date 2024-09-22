<!-- Start Gallery Area  -->
<div class="rn-gallery-area rn-section-gap section-separator" id="gallery">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="100" data-aos-once="true"
          class="section-title text-center">
          <span class="subtitle">Lifestyle</span>
          <h2 class="title">Recent Pictures</h2>
        </div>
      </div>
    </div>
    <div class="row row--25 mt--30 mt_md--10 mt_sm--10">
      <?php

      $data = GetData("SELECT * FROM `gallery` WHERE `status` = '1' ORDER BY `id` ASC");
      $delay = 100;
      foreach ($data as $item) {
        echo '
                      <!-- Start Single blog -->
      <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="' . $delay . '" data-aos-once="true"
        class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mt--30 text-center">
        <div class="gallery-item">
          <a href="assets/images/gallery/' . $item['image'] . '_full.jpg" data-fancybox="gallery">
            <img class="img-fluid" loading="lazy" src="assets/images/gallery/' . $item['image'] . '_thumb.jpg" alt="' . $item['title'] . '" width="400"
              height="300" style="height: 217px; object-fit: cover;" >
            <div class="gallery-title">
              <p>' . $item['title'] . '</p>
            </div>
          </a>
        </div>
      </div>
      <!-- End Single blog -->
        
        ';
        $delay += 50;
      }
      ?>
    </div>
  </div>
</div>
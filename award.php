<!-- Start portfolio Area -->
<div id="award" class="rn-project-area portfolio-style-two rn-section-gap section-separator">
  <div class="container">
    <div class="row">

      <div class="col-lg-12">
        <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="100" data-aos-once="true" class="section-title text-left mb_md--25 mb_sm--25">
          <span class="subtitle">Recognition</span>
          <h2 class="title">My Awards</h2>
        </div>
      </div>

    </div>
    <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" data-aos-once="true" id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">

        <?php

        $data = GetData("SELECT * FROM `awards` WHERE `status` = '1' ORDER BY `id`");
        $delay = 100;
        $awards = 1;
        foreach ($data as $item) {
          echo '  
                  <!-- Start Single Item  -->
        <div class="carousel-item ' .  ($awards == 1 ? 'active' : '')  . '">
          <div class="portfolio-single">
            <div class="row direction">
              <div class="col-lg-5">
                <div class="inner">
                  <h5 class="title">
                    ' . $item['title'] . '
                  </h5>
                  <p class="discription">
                   ' . $item['description'] . '</p>
                </div>
              </div>
              <div class="col-lg-7 col-xl-7">
                <div class="thumbnail">
                  <img class="img-fluid" loading="lazy" src="assets/images/awards/' . $item['image'] . '" alt="' . $item['title'] . '" width="685" height="513">
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Single Item  -->';
          $delay += 200;
          $awards++;
        }
        ?>
      </div>
      <button class="carousel-control-prev" role="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <i data-feather="chevron-left"></i>
      </button>
      <button class="carousel-control-next" role="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <i data-feather="chevron-right"></i>
      </button>
    </div>
  </div>
</div>
<!-- End portfolio Area -->
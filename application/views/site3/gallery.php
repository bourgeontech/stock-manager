<?php 
$site_settings=$this->site_model->settings();
$asideimage=$site_settings['asideimage'];
$videolink=$site_settings['video_link'];
$smbanner=$site_settings['small_banner'];
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.1/dist/css/themes/splide-skyblue.min.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.1/dist/js/splide.min.js"></script>
    <section class="slide_part">
      <div class="container">
        <div class="row">
          <div class='col-md-12'>
            <div class='homeslider'>
                <img class='img-fluid maxheight' title='' alt='' src='<?php echo $smbanner ?>'> 
            </div>
          </div>
        </div>  
      </div>
    </section>
    
    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-9">
              <div class="home_main_block">
                <div class='inner_pak'>
                  <div class='row'>
                    <div class='col-md-12'>
                      <div class="gallery"> 
                        <section id="main-slider" class="splide" aria-label="My Awesome Gallery">
                          <div class="splide__track">
                            <ul class="splide__list">
                                <?php foreach ($gallery as $value) { ?>
                                  <li class="splide__slide">
                                    <img src="../../uploads/gallery/<?PHP echo $value['image']; ?>" alt="" />
                                  </li>
                                <?php } ?>
                            </ul>
                          </div>
                        </section>
                        <ul id="thumbnails" class="thumbnails">
                            <?php foreach ($gallery as $value) { ?>
                              <li class="thumbnail">
                                <img src="../../uploads/gallery/<?PHP echo $value['image']; ?>" alt="" />
                              </li>
                            <?php } ?>

                        </ul>
                      </div> 
                    </div>  
                  </div>
                </div>
              </div>
            </div>
        <!-- ASIDE START-->
        <?php $this->load->view('site3/layouts/aside'); ?>   
        <!-- ASIDE END-->
          </div>
        </div>
      </div>
    </section>  

    <div class="clearfix"></div>
    
    <script>

  var splide = new Splide("#main-slider", {
    width: '100%',
    height: 400,
    pagination: false,
    cover: true,
    autoplay: true,
    interval: 3000,
    rewind: true, 
    perMove: 1, 
    perPage: 1, 
    gap: 0, 
  });

  var thumbnails = document.getElementsByClassName("thumbnail");
  var current;

  for (var i = 0; i < thumbnails.length; i++) {
    initThumbnail(thumbnails[i], i);
  }

  function initThumbnail(thumbnail, index) {
    thumbnail.addEventListener("click", function () {
      splide.go(index);
    });
  }

  splide.on("mounted move", function () {
    var thumbnail = thumbnails[splide.index];

    if (thumbnail) {
      if (current) {
        current.classList.remove("is-active");
      }

      thumbnail.classList.add("is-active");
      current = thumbnail;
    }
  });

  splide.mount();


</script>
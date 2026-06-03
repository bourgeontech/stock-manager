<?php 

$site_settings=$this->site_model->settings();
$asideimage=$site_settings['asideimage'];
$videolink=$site_settings['video_link'];
$smbanner=$site_settings['small_banner'];
?>
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
              <div class="home_main_block mb-4">
                <h2 class="inner-title ">Events </h2>
                <div class='inner_pak'>
                  <div class='row'>
                    <div class='col-md-12 events'>
                        <ul>
                            <?php
                                foreach ($announcements as $value) { ?>
                                    <li>
                                        <h5><?php echo $value['title'];?>  </h5> 
                                        <p><?php echo $value['description'];?> </p>

                                    </li>
                            <?php } ?>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="home_gallery">
                <div class="gallery-bgm">
                  <ul id='gallery' class='owl-carousel owl-theme dotte_slider'>
                    <?php 
                        foreach ($gallery_list as $value){
                        ?>
                        <li> 
                            <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery' 
                            title='gallery'><img alt='' src='../../uploads/gallery/<?PHP echo $value['image']; ?>' height="150px"/></a> 
                        </li>
                    <?php } ?>
                  </ul>
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
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
                <h2 class="inner-title ">Administration</h2>
                <div class='inner_pak'>
                  <div class='row'>
                    <div class='col-md-12'>
                      <div class="team-container">
                        <ul class="listt clearfix">
							<?php if (empty($trusteeboard)): ?>
  								<li>
    								<div class="team-member text-center">
      									No data found
    								</div>
  								</li>
							<?php else: ?>
  								<?php foreach ($trusteeboard as $value): ?>
    							<li>
      								<div class="team-member">
        								<img src="../../uploads/trustee/<?php echo $value['image']; ?>" alt="">
        								<div class="name"><?php echo $value['name']; ?></div>
        								<div class="designation"><?php echo $value['designation']; ?></div>
      								</div>
    							</li>
  								<?php endforeach; ?>
							<?php endif; ?>

                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="home_gallery">
                <!-- <h2 class="title1 title1_center">Gallery</h2> -->
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
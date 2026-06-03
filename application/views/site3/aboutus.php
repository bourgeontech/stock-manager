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
              <div class="home_main_block">
                <h2 class="inner-title ">HISTORY</h2>
                <div class='inner_pak'>
                  <div class='row'>
 
                    <div class='col-md-12'>
                       <?php foreach ($aboutus as $value) { ?>
                        
                            <div class='news_more'> <img class='news_moreimg' src='../../uploads/aboutus/<?PHP echo $value['image']; ?>'>
                                <p> <?php echo nl2br($value['content']);?> </p>
                            </div>
                            
                        <?php } ?>
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


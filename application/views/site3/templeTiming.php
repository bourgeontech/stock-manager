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
              <div class="home_main_block" style="background: #a81108">
                <div class='inner_pak'>
                  <div class='row'>
                    <div class='col-md-12'>
                        <ul>
                            <li>
                                <div class='block_event' style="text-align:left;">
                      
                                    <input type="time" id="p_time" value="<?php echo $templeTiming[0]['title'];?>" hidden>
                                    <h3><?php echo $templeTiming[0]['title'];?></h3><h6><?php echo $templeTiming[0]['rules'];?></h6>
                                </div>
                            </li>
                        </ul>
                        
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
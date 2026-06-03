 <?php 
$site_settings=$this->site_model->settings();
$asideimage=$site_settings['asideimage'];
$videolink=$site_settings['video_link'];
?>
				<div class="col-lg-3">
                  <div class="home_right_block">
                    <div class='inner_pak'>
                      <div class='row'>
                        <div class='col-md-12 mb-3'>
                            <h2 class="titleright">TEMPLE TIMINGS</h2>
                          <!--  <img class='img-fluid maxheight' title='<?php //print_r($temple_list[0]['name']);?>' alt='' src='<?php //echo $asideimage ?>'> 
                      -->
                      
                      <?php //echo $templeTiming[0]['title'];?></h3><h6><?php echo $templeTiming[0]['rules'];?>
                      
                      
                        <div class='col-md-12 mb-3'>
                          <h2 class="titleright ">VIDEO</h2>
                          <div class="responsive-iframe-container">
                            <?php echo $videolink ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
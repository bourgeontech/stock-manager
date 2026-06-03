<?php 
$site_settings=$this->site_model->settings();
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
            <div class="col-lg-12">
              <div class="home_main_block mb-4">
                <h2 class="inner-title ">Privacy Policy </h2>
                <div class='inner_pak'>
                  <div class='row'>
                    <div class='col-md-12 events'>
                                            <hr><p>
                        We do not sell or rent your personal information to third parties for their marketing purposes without
                        your explicit consent and we only use your information as described in the Privacy Policy. We view
                        protection of your privacy as a very important community principle. We understand clearly that you
                        and Your Information is one of our most important assets. We store and process Your Information on
                        computers located in India that are protected by physical as well as technological security devices.
                    </p>
                    <br>
                    <p>
                    	We use third parties to verify and certify our privacy principles. If you object to your Information being
						transferred or used in this way please do not use the Site.

                	</p>
                    <br>
                    <p>
                    	If <?php print_r($getcontact[0]['temp_name']); ?> is prevented, restricted, delayed, in the performance of their
                        obligations by force majeure circumstances including but not limited to fire , earthquake, riots which
                        are beyond the control of the debongoshoes.com, the obligations of debongoshoes.com which cannot
                        be performed by reason of such force majeure conditions shall remain suspended.

                	</p>
                    <br>
                    <br>
                    <p>
                    	For any queries, please write to <?php print_r($getcontact[0]['email']);?>
                	</p>
                    <hr>
                        

                    </div>  
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
    </section>  

    <div class="clearfix"></div>
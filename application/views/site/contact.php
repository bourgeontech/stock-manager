    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
           <div class="col-lg-12">
            <div class="home_about_block">
                <h2 class="title1 title1_left">Contact Us</h2>
                <div class='inner_pak'>

                     <?php
                      foreach ($contact as $value) {
                        $temp_name=$value['temp_name'];  
                        $land_ph=$value['land_ph'];  
                        $mob_ph=$value['mob_ph'];  
                        $email=$value['email']; 
                        $address=$value['address']; 
						  $location=$value['location']; 
                      }
                      ?>
                <div class="row">
                    <div class='col-lg-6'>
                      <div style='font-size: 18px;
    font-weight: bold;
    margin-bottom: 4px;'><?php echo $temp_name;?></div>
                      <p><?php echo $address;?> </p>
                      <p><i class='fa fa-phone-square'></i> <?php echo $land_ph;?> , <?php echo $mob_ph;?>  </p>
                      <p><i class='fa fa-envelope'></i> <?php echo $email;?></p>
                    </div>
                    <div class="col-lg-12 mt-5">
                      <h3 style="margin-bottom: 20px; color: #702308;">Location Map</h3>
                    
		
<iframe src="<?php echo $location;?>" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    						
                    </div>
                  </div>
                  
        


                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

 
    <div class="clearfix"></div>

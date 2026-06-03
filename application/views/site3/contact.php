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
                <h2 class="inner-title ">Contact Us</h2>
                <div class='inner_pak'>
                  <div class='row'>
                    <div class='col-md-12'>
                        <div class="containerr">
                            <div class="form-containerr">
                                <!----FORM----->
                                <form action="<?php echo base_url(); ?>index.php/welcome/contact_form" method="post">
                                    <div>
                                        <label class="textgrey">Name</label>
                                        <input type="text" name="name" id="name" class="form-controlr" required>
                                    </div>
                                    <div>
                                        <label class="textgrey mt-2">Email</label>
                                        <input type="text" name="email" id="email" class="form-controlr" required>
                                    </div>
                                    <div>
                                        <label class="textgrey mt-2">Phone No</label>
                                        <input type="text" name="phone" id="phone" class="form-controlr" onkeypress="return isNumberKey(event)" required>
                                    </div>
                                    <div>
                                        <label class="textgrey mt-2">Mobile No</label>
                                        <input type="text" name="mobile" id="mobile" class="form-controlr" onkeypress="return isNumberKey(event)" required>
                                    </div>
                                    <div>
                                        <label class="textgrey mt-2">Message</label>
                                        <textarea name="message" id="message" class="form-controlr" rows="6" required></textarea>
                                    </div>
                                    <div align="right">
                                        <input type="submit" name="submit" id="submit" class="btn formbutton" value="Submit Message">
                                    </div>
                                </form>

                                <!----FORM----->
                            </div>
                            <div class="vertical-line"></div> <!-- Vertical line -->
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

                            <div class="address-containerr pl-2">
                                <!----ADDRESS----->
                                <div class="address-textr">
                                    <h6><?php echo $temp_name;?></h6>
                                    <p><?php echo $address;?></p>
                                    <p><i class='fa fa-phone-square'></i> <?php echo $land_ph;?> , <?php echo $mob_ph;?>  </p>
                                    <p><i class='fa fa-envelope'></i> <?php echo $email;?></p>
                                </div>
                                <hr>
                                    <?php if (isset($value['bank_name'])): ?>
                                        <div><?php echo $value['bank_name']; ?></div>
                                        <p><?php echo $value['branch']; ?></p>
                                        <p><?php echo $value['account_no']; ?></p>
                                        <p><?php echo $value['ifsc']; ?></p>
                                    <?php endif; ?>

                                <!----ADDRESS----->
                                
                            </div>
                        </div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
        <!-- ASIDE START-->
        <?php $this->load->view('site3/layouts/aside'); ?>   
        <!-- ASIDE END-->
            <?php
                      foreach ($contact as $value) {
						 $location=$value['location']; 
                    }
                    ?>
                   <!-- <div class='col-md-9 mb-3'>
                      <h2 class="titleright ">LOCATION</h2>
                      <div class="responsive-iframe-container">
                        <iframe src="<?php echo $location;?>" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                      </div>
                    </div>-->>

        </div>
      </div>
    </section>  

    <div class="clearfix"></div>
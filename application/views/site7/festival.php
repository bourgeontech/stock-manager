<?php 
$site_settings=$this->site_model->settings();
?>
 
<!--Header-->
    <div class="container-fluid headerBg">
      <div class="container">
        <div class="row">
          <div class="col-md-6"><img src="<?php echo base_url(); ?>/assets/site6/images/sree-kadampuzha-bhagavathy-temple-logo.jpg" alt="Sree Kadampuzha Bhagavathy Temple logo" class="img-responsive logoAlign"></div>
            <div class="col-md-6">
		<?php  
          if($site_settings['online']=='1'){?>
        	<input name="" type="button" value="Online Donation" class="btnVazhipadu" onclick="url_redirect2()" id="online_donation">
        	<input name="" type="button" value="Online Vazhipadu Booking" class="btnVazhipadu" onclick="url_redirect()" id="vazhipadu_booking">
        	<input name="" type="button" value="E-Kanikka" class="btnVazhipadu" onclick="url_redirect4()" id="e_dakshina">
      	<?php } ?>
          </div>
          <!--<div class="col-md-3 col-sm-6">-->
          <!--  <input name="" type="button" value="Online Vazhipadu Booking" class="btnVazhipadu" onClick="url_redirect()">-->
          <!--  <input name="" type="button" value="Virtual Queue Darshan Booking" class="btnVazhipadu" onClick="url_redirect3()">-->
          <!--</div>-->
        </div>
      </div>
    </div>
    <!--Main Nav-->
    <div class="container-fluid mainNavBg">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <nav>
              <ul class="menu  listMainNav ">
                <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/index">Home</a></li>
                <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/temple">The Temple&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/temple#about">About</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/temple#devathas">Devathas</a></li></ul></li>
                <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/poojas">Poojas &nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#vazhipadu">Vazhivadu (Offerings)</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#online">Book an offering</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#timing">Daily Pooja Timings</a></li></ul></li>
                <li><a class="active" href="<?php echo base_url(); ?>index.php/welcome/festivals">Festivals&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">Thanthrik Festivals</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">Gallery</a></li></ul></li>
                <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/index">News </a></li>
                <li><a href="<?php echo base_url(); ?>index.php/welcome/contact">Administrative</a><ul><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#trustee">Trust &amp; Trustees </a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#staffs">Temple Staffs</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#hwreach">How to Reach</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/index#tmmap">Contact Us</a></li></ul></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!--news/blog-->
    
              <!-- Divider-->
              <hr class="my-4" />
              <!-- Pager-->
              <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
          </div>
      </div>
    </div>
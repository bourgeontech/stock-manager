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
            <li><a class="active" href="<?php echo base_url(); ?>index.php/welcome/poojas">Poojas &nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#vazhipadu">Vazhivadu (Offerings)</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#online">Book an offering</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#timing">Daily Pooja Timings</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/festivals">Festivals&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">Thanthrik Festivals</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">Gallery</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/news">News </a></li>
            <li><a href="<?php echo base_url(); ?>index.php/welcome/contact">Administrative</a><ul><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#trustee">Trust &amp; Trustees </a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#staffs">Temple Staffs</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#hwreach">How to Reach</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#tmmap">Contact Us</a></li></ul></li>
          </ul>
        </nav>
        <a href="<?php echo base_url(); ?>index.php/welcome/poojas"><img src="<?php echo base_url(); ?>/assets/site6/images/eng.png" alt="English" class="socialIcons"></a><a href="<?php echo base_url(); ?>index.php/welcome/poojas_ml"><img src="<?php echo base_url(); ?>/assets/site6/images/mal.png" alt="Malayalam" class="socialIcons"> </a></div></div>
    </div>
  </div>
</div>


<!--online vazhipadu-->
<a id="vazhipadu"></a>
<div class="container-fluid narayanaBg">
  <div class="container">
    <div class="well"> 
        <div class="row">
             <div class="col-md-12">
                 <div class="row hidden-md hidden-lg"><h1 class="text-center" >PARAKKUNATHU BHAGAVATHI KSHETRAM </h1></div>
                     
                 
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        PARAKKUNATHU BHAGAVATHI KSHETRAM VAZHIPADU LIST 
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Mahaguruthi
                       <span class="badge bg-warning">Rs. 11,000</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Chanthattam (Bookings are until 2035.)  (The remaining amount is to be paid at the time of offering.)
                        <span class="badge bg-primary rounded-pill">Advance: Rs. 10000</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Chathan Swami Kalasham 
                        <span class="badge bg-primary rounded-pill">Rs. 2000</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Shatrutha Samhara Guruthi
                        <span class="badge bg-primary rounded-pill">Rs. 500</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Marriage
                        <span class="badge bg-primary rounded-pill">Rs. 500</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Kedavilakku
                        <span class="badge bg-primary rounded-pill">Rs. 101</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Vellari Pooja
                        <span class="badge bg-primary rounded-pill">Rs. 100</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Kadina Payasam
                        <span class="badge bg-primary rounded-pill">Rs. 50</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pattucharthal
                        <span class="badge bg-primary rounded-pill">Rs. 50</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Shatrutha Samhara muttu with Pooja
                        <span class="badge bg-primary rounded-pill">Rs. 25</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Shatrutha Samhara Pushpanjali 
                        <span class="badge bg-primary rounded-pill">Rs. 25</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Mangalya Muttu with Pooja 
                        <span class="badge bg-primary rounded-pill">Rs. 25</span>
                      </li>
                    </ul>  
                    </div>
              </div>
          </div>
          <a id="online"></a>
        
              <div class="col-sm-4">
                <input name="" type="button" value="Online Donation" class="btnVazhipadu" onclick="url_redirect2()" id="online_donation">  
                </div>
              <div class="col-sm-4"> 
                <input name="" type="button" value="Online Vazhipadu Booking" class="btnVazhipadu" onclick="url_redirect()" id="vazhipadu_booking">
              </div>
              <div class="col-sm-4"> 
                <input name="" type="button" value="E-Kanikka" class="btnVazhipadu" onclick="url_redirect4()" id="e_dakshina"> 
              </div>
            
          </div>
          </div>
          </div>
      </div>
      </div>
      </div>
      </div>
      
    </div>

<!--Opening Time-->
<a id="timing"></a>
<div class="container-fluid timingBg text-center">  
  <div class="container">
   <br>   
  <h3 class="margin head22YellowBold">Temple Timings</h3><br>
  <div class="row">
      </div>
    </div>
</div>
<div class="container-fluid timingBg ">
<div class="container"> 
  <h4 class="margin txt16White">Sri Parakkunnathu Temple Timings</h4>
<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Opening-Morning
    <span class="badge bg-primary rounded-pill">6 AM</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Main Pooja Time
    <span class="badge bg-primary rounded-pill">8 AM</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Closing-Morning
    <span class="badge bg-primary rounded-pill">11:30 AM</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Opening-Evening 
    <span class="badge bg-primary rounded-pill">5 PM</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Closing-Evening
    <span class="badge bg-primary rounded-pill">6:30 PM</span>
  </li>
</ul>
<br>
<h4 class="margin txt16White">Sri Anthi Mahakalan Temple Timings</h4>
<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Opening-Morning
    <span class="badge bg-primary rounded-pill">6 AM</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Main Pooja Time
    <span class="badge bg-primary rounded-pill">8 AM</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Closing-Morning
    <span class="badge bg-primary rounded-pill">9:30 AM</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Opening-Evening
    <span class="badge bg-primary rounded-pill">5 AM</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    Deeparadhana
    <span class="badge bg-primary rounded-pill">6:30 PM</span>
  </li>
</ul>

</div>
</div>

<!--team-->

      <!-- /row end-->
  </div>
  <!-- /container end-->
</div>

</div>
</body>
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
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/index">ഹോം     </a>  </li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/temple_ml">ക്ഷേത്രം&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/temple_ml#about">ക്ഷേത്രത്തെക്കുറിച്ച്</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/temple_ml#devathas">ദേവതകള്‍</a></li></ul></li>
            <li><a class="active" href="<?php echo base_url(); ?>index.php/welcome/poojas_ml">പൂജകള്‍ &nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas_ml#vazhipadu">വഴിപാടുകള്‍</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas_ml#online">വഴിപാട് കഴിക്കുക</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas_ml#timing">പൂജാ സമയം</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/festivals">ഉത്സവം&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">ഉത്സവ വിശേഷം</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">ചിത്രങ്ങള്‍</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/news">വിശേഷങ്ങള്‍ </a></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/contact_ml">നിര്‍വ്വഹണം‌&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#trustee">ട്രസ്റ്റും ഭാരവാഹികളും</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#staffs">ക്ഷേത്ര ജീവനക്കാര്‍</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#hwreach">എത്തിച്ചേരുക</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#tmmap"> ബന്ധപെടുക</a></li></ul></li>            </ul>
        </nav>
        <a href="<?php echo base_url(); ?>index.php/welcome/poojas"><img src="<?php echo base_url(); ?>/assets/site6/images/eng.png" alt="English" class="socialIcons"></a><a href="<?php echo base_url(); ?>index.php/welcome/poojas_ml"><img src="<?php echo base_url(); ?>/assets/site6/images/mal.png" alt="Malayalam" class="socialIcons"> </a></div></div></div>
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
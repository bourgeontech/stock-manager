<?php 
$aboutus=$this->site_model->aboutus_home();
$aboutus=$this->site_model->getaboutus();
$site_settings=$this->site_model->settings();
?>

<!--Header-->
<div class="container-fluid headerBg">
  <div class="container">
    <div class="row">
    	<div class="col-md-6">
    		<h1 class="text-white m-4"><?php print_r($temple_list[0]['name']);?></h1>
        	<h4 class="text-white m-3"> <?php print_r($temple_list[0]['address']);?></h4>
		</div>

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
            <li><a class="active" href="<?php echo base_url(); ?>index.php/welcome/index">Home</a></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/temple">The Temple&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/temple#about">About</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/temple#devathas">Devathas</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/poojas">Poojas &nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#vazhipadu">Vazhivadu (Offerings)</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#online">Book an offering</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#timing">Daily Pooja Timings</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/festivals">Festivals&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">Thanthrik Festivals</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">Gallery</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/news">News </a></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/contact">Administrative</a><ul><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#trustee">Trust &amp; Trustees </a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#staffs">Temple Staffs</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#hwreach">How to Reach</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#tmmap">Contact Us</a></li></ul></li>
          </ul>
        </nav>
        <a href="<?php echo base_url(); ?>index.php/welcome/index"><img src="<?php echo base_url(); ?>/assets/site6/images/eng.png" alt="English" class="socialIcons"></a><a href="<?php echo base_url(); ?>index.php/welcome/index_ml"><img src="<?php echo base_url(); ?>/assets/site6/images/mal.png" alt="Malayalam" class="socialIcons"> </a></div>
    </div>
  </div>
</div>
<!--Banner-->
 	<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 banner2 paddingAdj" style="padding:0px;">
      <div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
        <div class="slides" data-group="slides">
          <ul>
            <li>
              <div class="slide-body" data-group="slide"><img src="<?php echo base_url(); ?>/assets/site6/images/7746-1867-banner-1.jpg" alt="Banner 1" class="img-responsive" width="100%">
                <div class="caption header" data-animate="slideAppearRightToLeft" data-delay="500" data-length="300">
                </div>
              </div>
            </li>
            <li>
              <div class="slide-body" data-group="slide"><img src="<?php echo base_url(); ?>/assets/site6/images/4884-1113-banner-2.jpg" alt="Banner 2" class="img-responsive" width="100%">
                <div class="caption header" data-animate="slideAppearRightToLeft" data-delay="500" data-length="300">
                </div>
              </div>
            </li>
            <li>
              <div class="slide-body" data-group="slide"><img src="<?php echo base_url(); ?>/assets/site6/images/4007-8868-banner-3.jpg" alt="Banner 3" class="img-responsive" width="100%">
                <div class="caption header" data-animate="slideAppearRightToLeft" data-delay="500" data-length="300">
                </div>
              </div>
            </li>
          </ul>
        </div>
        <span class="scroll-btn"> <a href="#"> <span class="mouse"> <span> </span> </span> </a>
    <p>scroll me</p>
    </span>
          </div>
      </div>
    </div>
  </div>


<!--Timing-->
<div class="container-fluid timingBg">
  <div class="row">
    <div class="col-sm-6 text-left">
      <ul class="listTiming">
        <li><img src="<?php echo base_url(); ?>/assets/site6/images/dasan-time.png" alt="Darsan Time" class="darsanTimeImg"></li>
        <li> <span class="txt16White">05.30 AM to 12.00 Noon.</span></li>
        <li><img src="<?php echo base_url(); ?>/assets/site6/images/darsan-arrow.png" class="darsanArrow">  <span class="txt16White">05.30 PM to 07.00 PM.</span>
<!--<input name="" value="Virtual Q Booking" class="btnDonations" onclick="url_redirect3()" type="button" style="font-size:16px;padding:5px 11px"> -->
</li>
      </ul>

    </div>

    <div class="col-sm-6 text-left">

      <ul class="listTiming">
        <li><img src="<?php echo base_url(); ?>/assets/site6/images/vazhipadu-counter-timings.png" alt="Darsan Time" class="darsanTimeImg2"></li>
        <li> <span class="txt16White">06.00 AM to 11.30 AM.</span></li>
        <li><img src="<?php echo base_url(); ?>/assets/site6/images/darsan-arrow.png" class="darsanArrow">  <span class="txt16White">05.30 PM to 06.00 PM</span></li>
      </ul>

    </div>

  </div>
</div>
<!--Temple News-->
<div class="container-fluid newsBg">
  <div class="row">

    <div class="col-sm-6 templeNewsHolder">
      <h3 class="head22YellowBold">Temple News</h3>
      <div id="owl-news" class="owl-carousel">
              <div class="item">
      <p class="txt17White">Vazhipadu Rates &nbsp;&nbsp;&nbsp;&nbsp;<a href="/news/58" class="lnkBrown">Click Here</a></p></div>
		        <div class="item">
      
      <p class="txt17White">Lunar Eclipse 31-01-2018 &nbsp;&nbsp;&nbsp;&nbsp;<a href="/news/10" class="lnkBrown">Click Here</a></p></div>
		        <div class="item">
      <p class="txt17White">Dravya Kalasham 31-10-17 to 07-11-17  &nbsp;&nbsp;&nbsp;&nbsp;<a href="/news/5" class="lnkBrown">Click Here</a></p></div>
		        <div class="item">
      <p class="txt17White">Sreemath Bhagavatha Sapthaham Yagnam &nbsp;&nbsp;&nbsp;&nbsp;<a href="/news/4" class="lnkBrown">Click Here</a></p></div>
		        <div class="item">
      <p class="txt17White">Luxury A/c Delux available in Devaswom Guest House &nbsp;&nbsp;&nbsp;&nbsp;<a href="/news/2" class="lnkBrown">Click Here</a></p></div>
		      </div>

      </div>


    <div class="col-sm-6 donationHolder">
      <p class="txt16White">Donations from devotees are the sustenance of every temple. From daily Annadanam to Temple renovations to charitable activities, many opportunities to aid activates of Parakkunathu Temple are listed.</p>
      <input name="" type="button" value="Donations" class="btnDonations" onclick="url_redirect2()">
    </div>
  </div>
</div>
<!--Amme Narayana-->
<div class="container-fluid narayanaBg">
  <div class="container">
    <div class="row">
      <div class="col-sm-4"><img src="<?php echo base_url(); ?>/assets/site6/images/amme-narayana.png" alt="Amme Narayana" class="img-responsive center-block narayanaTextAlign"></div>
      <div class="col-sm-4"><img src="<?php echo base_url(); ?>/assets/site6/images/kadampuzha-bhagavathy.png" alt="Kadampuzha Bhagavathy" class="img-responsive center-block"></div>
      <div class="col-sm-4"><img src="<?php echo base_url(); ?>/assets/site6/images/twarithe-narayana.png" alt="Twarithe Narayana" class="img-responsive center-block narayanaTextAlign"></div>
    </div>
  </div>
</div>
<!--About Temple-->
<div class="container-fluid aboutBg">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h3 class="head30BoldWhite">About Temple</h3>
        <img src="<?php echo base_url(); ?>/assets/site6/images/head-devider.png">
        <p class="txt17WhiteMargin20px"> The Parakkunathu Temple is a Bhagavathi temple at Chellur, Kuttipuram in Malappuram district, Kerala. Dedicated to the mother goddess Bhadrakali. It is one of the oldest and most powerful seat of the goddess in Kerala.  In Parakkunathu Temple the mother goddess Bhadrakali is worshipped in Kulachara Tantra Marga. Intrestingly, in the Kulachara tantra marga there is no discrimination of caste or gender. Hence any person belonging to any caste and gender can get the boons of Bhagavathi. </p>
        <input name="" type="button" value="Read More" class="btnReadMoreWhite" onclick = "window.location.href='/temple.html';"
        >
      </div>
    </div>
  </div>
</div>
<!--Pooja Times-->
<div class="container-fluid poojaTimesBg">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 oomBg"> <img src="<?php echo base_url(); ?>/assets/site6/images/oom.png" alt="oom" class="oomAlign">
        
          
          <p class="txt16White">shree parameshvara nallachante moonnaam thrukkannil ninnum paalupole potti palunku pole poyyappetta theyyavaar kola ganabhagavathi navarathna karnnabhooshaadikalum valam kayyil pallivaalum edam kayyil naadakavum muricchoppum thrikkaalinakalil ponnil chilambum thiru arayil veeraali pattum chaarthi kudamaniyum aranjaanavum ittuketti olathodolam thallum arabikadalum parlooru manikkyante pachola kudayum pallivaalum kandu uthamathil uthamappetta parakkunnathu padinjaattu thirinjirikkunna thrinethre !lokarthan sankada durithaadikal haranam cheythu vaazhum ammadevi! shree kurummba kandam kaali thunacheeduka nee enne nithyam !!!.......<p/>
        
      </div>
      <div class="col-sm-6">
        <div class="row">
          <div class="col-sm-6 poojaTimesImgHolder"> </div>
          <div class="col-sm-6 poojaTimesTxtHolder">
            <h3 class="head30BoldWhite">Pooja Times</h3>
            <input name="" type="button" value="Click Here" class="btnReadMoreWhite" onclick="url_redirect_common('Daily-Pooja-Timings')">
            <!--2017-12-04 Start-->
            <span class="pointerLeft"></span>
            <!--2017-12-04 End-->
          </div>
          <div class="col-sm-6 mainOfferingTxtHolder">
            <h3 class="head30BoldWhite">Main Offerings</h3>
            <input name="" type="button" value="Click Here" class="btnClickHereYellow" onclick="url_redirect_common('vazhivadu')">
            <!--2017-12-04 Start-->
            <span class="pointerRight"></span>
            <!--2017-12-04 End-->
          </div>
          <div class="col-sm-6 mainOfferingImgHolder"> </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="imgBgBox1"> <img src="<?php echo base_url(); ?>/assets/site6/images/icon-announcement.png">
            <h3 class="head22BoldWhiteMargin15">Announcements</h3>
            <a href="/announcements" class="lnk14Yellow">Click Here </a><img src="<?php echo base_url(); ?>/assets/site6/images/yellow-arrow.png"> </div>
        </div>
        <div class="col-sm-3">
          <div class="imgBgBox2"> <img src="<?php echo base_url(); ?>/assets/site6/images/icon-calendar.png">
            <h3 class="head22BoldWhiteMargin15">Calendar</h3>
            <a href="/events" class="lnk14Yellow">Click Here </a><img src="<?php echo base_url(); ?>/assets/site6/images/yellow-arrow.png"> </div>
        </div>
        <div class="col-sm-3">
          <div class="imgBgBox3"> <img src="<?php echo base_url(); ?>/assets/site6/images/icon-devotee.png">
            <h3 class="head22BoldWhiteMargin15">Devotee’s Corner</h3>
            <a target="_blank" href="link to blog/" class="lnk14Yellow">Click Here </a><img src="<?php echo base_url(); ?>/assets/site6/images/yellow-arrow.png"> </div>
        </div>
        <div class="col-sm-3">
          <div class="imgBgBox4"> <img src="<?php echo base_url(); ?>/assets/site6/images/icon-image.png">
            <h3 class="head22BoldWhiteMargin15">Image Gallery</h3>
            <a href="/gallery" class="lnk14Yellow">Click Here </a><img src="<?php echo base_url(); ?>/assets/site6/images/yellow-arrow.png"> </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Location Map-->
<div class="container-fluid locationBg">
  <div class="row">
    <div class="col-sm-6 ">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.2654875388766!2d76.03263467385305!3d10.867400657511538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba7b7096245c04f%3A0x66e9611a439112!2sSri%20Parakkunnathu%20Bhagavathy%20Kshethram!5e0!3m2!1sen!2sin!4v1699514849309!5m2!1sen!2sin" width="100%" height="650" frameborder="0" style="border:0" allowfullscreen=""></iframe>
      
    </div>
    <div class="col-sm-6 contactBg">
      <h3 class="headContact">Contact us</h3>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="contactDetailsTbl">
        <tbody>
          <tr>
            <td width="87"><img src="<?php echo base_url(); ?>/assets/site6/images/map.png" alt="Address"> </td>
            <td><strong>Address</strong><br>
               <?php print_r($temple_list[0]['address']);?>
          	</td>
          </tr>
          <tr>
            <td><img src="<?php echo base_url(); ?>/assets/site6/images/phone.png" alt="Phone"> </td>
            <td><strong>Phone no</strong><br>
               <?php print_r($temple_list[0]['phone']);?> 
            <strong> 
          </tr>
          
          <tr>
            <td><img src="<?php echo base_url(); ?>/assets/site6/images/email.png" alt="Email"> </td>
            <td class="mailAddress"><strong>Email</strong><br>
              parakkunnathutemple@gmail.com</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!--Footer-->

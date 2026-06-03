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
                <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/festivals">Festivals&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">Thanthrik Festivals</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">Gallery</a></li></ul></li>
                <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/news">News </a></li>
                <li><a class="active" href="<?php echo base_url(); ?>index.php/welcome/contact">Administrative</a><ul><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#trustee">Trust &amp; Trustees </a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#staffs">Temple Staffs</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#hwreach">How to Reach</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#tmmap">Contact Us</a></li></ul></li>
              </ul>
            </nav>
            <a href="<?php echo base_url(); ?>index.php/welcome/contact"><img src="<?php echo base_url(); ?>/assets/site6/images/eng.png" alt="English" class="socialIcons"></a><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml"><img src="<?php echo base_url(); ?>/assets/site6/images/mal.png" alt="Malayalam" class="socialIcons"> </a></div></div></div>
      </div>
    </div>
    <!--team-->
<a id="trustee"></a>
<div class="whos-speaking-area speakers pad100">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="section-title text-center">
                  <div class="title-text mb50">
                      <h2>Trust Members</h2>
                  </div>
              </div>
          </div>
          <!-- /col end-->
      </div>
      <!-- /.row  end-->
      <div class="row mb50">
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
              <div class="speakers xs-mb30">
                  <div class="spk-img">
                      <img class="img-fluid" src="<?php echo base_url(); ?>/assets/site6/images/team_1.jpg" alt="trainer-img" />
            
                  </div>
                  <div class="spk-info">
                      <h3>Janardhanan K R</h3>
                      <p>Managing Trusty</p>
                  </div>
              </div>
          </div>
          <!-- /col end-->
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
              <div class="speakers xs-mb30">
                  <div class="spk-img">
                      <img class="img-fluid" src="<?php echo base_url(); ?>/assets/site6/images/team_2.jpg" alt="trainer-img" />
                      
                  </div>
                  <div class="spk-info">
                      <h3>Muralidharan Kollody</h3>
                      <p>Trustee</p>
                  </div>
              </div>
          </div>
          <!-- /col end-->
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
              <div class="speakers xs-mb30">
                  <div class="spk-img">
                      <img class="img-fluid" src="<?php echo base_url(); ?>/assets/site6/images/team_3.jpg" alt="trainer-img" />
                      
                  </div>
                  <div class="spk-info">
                      <h3>Devanandhan K C</h3>
                      <p>Trustee</p>
                  </div>
              </div>
          </div>
          <!-- /col end-->
          <div class="col-xl-3 col-lg-3 d-md-none d-lg-block col-sm-12">
              <div class="speakers">
                  <div class="spk-img">
                      <img class="img-fluid" src="<?php echo base_url(); ?>/assets/site6/images/team_4.jpg" alt="trainer-img" />
                      
                  </div>
                  <div class="spk-info">
                      <h3>Balakrishnan K</h3>
                      <p>Trustee</p>
                  </div>
              </div>
          </div>
          <!-- /col end-->
      </div>
      <!-- /row end-->
      <div class="row">
          <div class="offset-2 no-gutter"></div>
          <!-- /col end-->
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
              <div class="speakers xs-mb30">
                  <div class="spk-img">
                      <img class="img-fluid" src="<?php echo base_url(); ?>/assets/site6/images/team_5.jpg" alt="trainer-img" />
                      
                  </div>
                  <div class="spk-info">
                      <h3>Sreekanth K</h3>
                      <p>Trustee</p>
                  </div>
              </div>
          </div>
          <!-- /col end-->
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
              <div class="speakers xs-mb30">
                  <div class="spk-img">
                      <img class="img-fluid" src="<?php echo base_url(); ?>/assets/site6/images/team_7.jpeg" alt="trainer-img"/>
                      
                  </div>
                  <div class="spk-info">
                      <h3>Arjun Kollody</h3>
                      <p>Trustee</p>
                  </div>
              </div>
          </div>
          <!-- /col end-->
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
              <div class="speakers">
                  <div class="spk-img">
                      <img class="img-fluid" src="<?php echo base_url(); ?>/assets/site6/images/team_6.jpg" alt="trainer-img" />
                      
                  </div>
                  <div class="spk-info">
                      <h3>Prakash K</h3>
                      <p>Trustee</p>
                  </div>
              </div>
          </div>
        
          <!-- /col end-->
      </div>
      <!-- /row end-->
  </div>
  <!-- /container end-->
</div>
<!--About Trust-->
<div class="container-fluid aboutBg">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h3 class="head30BoldWhite">Parakkunathu Temple Trust</h3>
        <img src="<?php echo base_url(); ?>/assets/site6/images/head-devider.png">
        <p class="txt17WhiteMargin20px"> Since 2006, the temple committee office-bearers formed a trust to oversee Sri Parakkunnathu Bhagavathy Temple's affairs. The dharma daiva of Kollodi Tharavatu, Chellur Sri Anthimahakalan Kavu was brought under the said trust and took over the administrative charge and carried out the reconstruction process. In this temple both Anthimahakalan and Kara Bhagavathy hold equal importance with separate sanctuaries. Nagaraja and Nagarajni are sub-deities, and Kalpuzha Mana manages the Tantrika sthanam. Devotees offer Kalam Patu annually, led by Kallat Kuruppu, showcasing the trust's dedication to preserving the temple's cultural and spiritual heritage.</p>
        
      </div>
    </div>
  </div>
</div>

<!--temple Staff-->
<a id="staffs"></a>
<div class="container-fluid narayanaBg text-center">  
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
          <div class="section-title text-center">
              <div class="title-text mb50">
                  <h2>Temple Staffs</h2>
              </div>
          </div>
      </div>
   <br>   
<div class="row">
  <div class="col-xs-6 col-sm-4 col-md-3 i">
    <div class="c text-center">
      <div class="wrap">
        <img src="<?php echo base_url(); ?>/assets/site6/images/team_8.jpg" alt="#" width="270" height="270" class="img-responsive">
        <div class="info">
          <h3 class="name">Vijayakrishnan Shanthi</h3>
          <h4 class="position">Tantri</h4>
        </div>
      </div>
    
    </div>
  </div>
  <div class="col-xs-6 col-sm-4 col-md-3 i">
    <div class="c text-center">
      <div class="wrap">
        <img src="<?php echo base_url(); ?>/assets/site6/images/team_9.jpg" alt="#" width="270" height="270" class="img-responsive">
        <div class="info">
          <h3 class="name">Krishnan Parakkunnath</h3>
          <h4 class="position">Melshanthi</h4>
        </div>
      </div>
      
    </div>
  </div>
 <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
              <div class="speakers xs-mb30">
                  <div class="spk-img">
                      <img class="img-fluid" src="<?php echo base_url(); ?>/assets/site6/images/team_k.jpeg" alt="trainer-img" />
                      
                  </div>
                  <div class="spk-info">
                      <h3>Krishnakumar</h3>
                      <p>Trust Manager</p>
                  </div>
              </div>
          </div>
       
  <div class="col-xs-6 col-sm-4 col-md-3 i">
    <div class="c text-center">
      <div class="wrap">
        <img src="<?php echo base_url(); ?>/assets/site6/images/team_10.jpg" alt="#" width="270" height="270" class="img-responsive">
        <div class="info">
          <h3 class="name">Mohan Parakkunnath</h3>
          <h4 class="position">Keezhshanthi</h4>
        </div>
      </div>
      
    </div>
  </div>
  <div class="col-xs-6 col-sm-4 col-md-3 i">
    <div class="c text-center">
      <div class="wrap">
        <img src="<?php echo base_url(); ?>/assets/site6/images/team_11.jpg" alt="#" width="270" height="270" class="img-responsive">
        <div class="info">
          <h3 class="name">Gopinath K</h3>
          <h4 class="position">Office Incharge</h4>
        </div>
      </div>
      
    </div>
  </div>
  <div class="col-xs-6 col-sm-4 col-md-3 i">
    <div class="c text-center">
      <div class="wrap">
        <img src="<?php echo base_url(); ?>/assets/site6/images/team_12.jpg" alt="#" width="270" height="270" class="img-responsive">
        <div class="info">
          <h3 class="name">Sudharshan P K</h3>
          <h4 class="position">Clerk</h4>
        </div>
      </div>
      
    </div>
  </div>
  <div class="col-xs-6 col-sm-4 col-md-3 i">
    <div class="c text-center">
      <div class="wrap">
        <img src="<?php echo base_url(); ?>/assets/site6/images/team_13.jpg" alt="#" width="270" height="270" class="img-responsive">
        <div class="info">
          <h3 class="name">Geetha C K</h3>
          <h4 class="position">Clerk</h4>
        </div>
      </div>
      
    </div>
  </div>
  
      
</div>
</div>
</div>
<!--end-->
<!---how to reach-->
</div>
</div>    
</div>
</div>
</div>
<a id="hwreach"></a>
<div class="container-fluid timingBg text-center">  
  <div class="container">
   <br>   
  <h3 class="margin head22YellowBold">How To Reach</h3><br>
  <div class="class">
    <h4  class="txt17WhiteMargin20px">By Bus </h4>
    <p class="text-justify txt16White ">To reach the temple, follow these simple steps: If you're coming from Kuttipuram, catch a Valanchery bus and get off at Mudaal stop. Then, hop on an auto to reach the temple. The temple is accessible by traveling 0.5 kilometers along the western road from Mudal. For those traveling from Tirur, Thirunnavaya, Thripangodu Temple, or Hanumankavu, take the Kuttipuram bus and get off at Chembikal, from there, you can take an auto to reach the temple. Or you can get off at Kuttipuram stand and catch the Valanchery bus from there and get off at Mudaal stop for easy access to the temple. Just keep in mind that the distance is a bit longer when coming from Chembikal. </p>
      </p>
      <br><br>
      <h4  class="txt17WhiteMargin20px">By Train </h4>
      <p class="text-justify txt16White ">The closest railway station to the temple is Kuttippuram. Upon disembarking, one may proceed by taking a Valancherry-bound bus, alighting at the Mudaal stop, and subsequently availing an auto-rickshaw to reach the temple. </p>
      <br><br>
      <h4  class="txt17WhiteMargin20px">By Air </h4>
      <p class="text-justify txt16White ">The temple is in close proximity to Kozhikode airport, with additional nearby airports in Kochi and Coimbatore. Accommodation options in Kuttipuram are limited. It is advisable to consider staying in Tirur or Kottakkal for better lodging facilities, from where you can conveniently visit the temple.</p>
<br>
    </div>
  
  
  
</div>
</div>
</div>
  
  
  <!--Location Map-->
  <a id="tmmap"></a>
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
              <td><strong> 	Address</strong><br>
                The Manager, Sri Parakkunnath Temple <br>
Chellur, PO PAZHUR <br>
kuttippuram - 679 571 <br>
Malappuram Dt. </td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url(); ?>/assets/site6/images/phone.png" alt="Phone"> </td>
              <td><strong>Phone no</strong><br>
               0494 208 8552, 949-658-3551
 <strong> 
            </tr>
            
            <tr>
              <td><img src="<?php echo base_url(); ?>/assets/site6/images/email.png" alt="Email"> </td>
              <td class="mailAddress"><strong>Email</strong><br>
               parakkunnathtemple@gmail.com</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
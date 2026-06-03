  <!--Header-->
<?php 
$site_settings=$this->site_model->settings();
?>

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
              <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/index_ml">ഹോം     </a>  </li>
              <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/temple_ml">ക്ഷേത്രം&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas_ml#about">ക്ഷേത്രത്തെക്കുറിച്ച്</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/index_ml#devathas">ദേവതകള്‍</a></li></ul></li>
              <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/poojas_ml">പൂജകള്‍ &nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas_ml#vazhipadu">വഴിപാടുകള്‍</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas_ml#online">വഴിപാട് കഴിക്കുക</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas_ml#timing">പൂജാ സമയം</a></li></ul></li>
              <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/festivals">ഉത്സവം&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">ഉത്സവ വിശേഷം</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">ചിത്രങ്ങള്‍</a></li></ul></li>
              <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/news">വിശേഷങ്ങള്‍ </a></li>
              <li><a class="active" href="<?php echo base_url(); ?>index.php/welcome/contact_ml">നിര്‍വ്വഹണം‌&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#trustee">ട്രസ്റ്റും ഭാരവാഹികളും</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#staffs">ക്ഷേത്ര ജീവനക്കാര്‍</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#hwreach">എത്തിച്ചേരുക</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#tmmap"> ബന്ധപെടുക</a></li></ul></li>
            </ul>
          </nav>
          <a href="<?php echo base_url(); ?>index.php/welcome/contact"><img src="<?php echo base_url(); ?>/assets/site6/images/eng.png" alt="English" class="socialIcons"></a><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml"><img src="<?php echo base_url(); ?>/assets/site6/images/mal.png" alt="Malayalam" class="socialIcons"> </a></div></div>
      </div>
    </div>
  </div>
  
  <!--Amme Narayana-->
  
  <!---trust--->
  <a id="trustee"></a>
<div class="whos-speaking-area speakers pad100">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="section-title text-center">
                  <div class="title-text mb50">
                      <h2>ട്രസ്റ്റ് അംഗങ്ങൾ</h2>
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
                      <h3>ജനാർദ്ദനൻ കെ ആർ</h3>
                      <p>മാനേജിംഗ് ട്രസ്റ്റി </p>
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
                      <h3>മുരളീധരൻ കൊല്ലോടി</h3>
                      <p>ട്രസ്റ്റീ</p>
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
                      <h3>ദേവാനന്ദൻ കെ സി</h3>
                      <p>ട്രസ്റ്റീ</p>
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
                      <h3>ബാലകൃഷ്ണൻ കെ</h3>
                      <p>ട്രസ്റ്റീ</p>
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
                      <h3>ശ്രീകാന്ത് കെ</h3>
                      <p>ട്രസ്റ്റീ</p>
                  </div>
              </div>
          </div>
          <!-- /col end-->
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
              <div class="speakers xs-mb30">
                  <div class="spk-img">
                      <img class="img-fluid" src="<?php echo base_url(); ?>/assets/site6/images/team_7.jpg" alt="trainer-img" />
                      
                  </div>
                  <div class="spk-info">
                      <h3>അർജുൻ കൊല്ലോടി</h3>
                      <p>ട്രസ്റ്റീ</p>
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
                      <h3>പ്രകാശ് കെ</h3>
                      <p>ട്രസ്റ്റീ</p>
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
        <h3 class="head30BoldWhite">പറക്കുന്നത്ത് ക്ഷേത്ര ട്രസ്റ്റ്</h3>
        <img src="<?php echo base_url(); ?>/assets/site6/images/head-devider.png">
        <p class="txt17WhiteMargin20px"> 2006 മുതൽ നിലവിലെ ക്ഷേത്ര കമ്മിറ്റി ഭാരവാഹികൾ ഒരു റജിസ്റ്രേഡ് ട്രസ്റ്റ് രൂപികരിക്കുകയും ശ്രീ പറക്കുന്നത്ത് ഭഗവതീ ക്ഷേത്രത്തിന്റെ നിത്യ നൈമിത്തിക കാര്യങ്ങൾ യഥാ വിധി നടത്തുകയും ചെയ്യുന്നു. കൊല്ലോടി തറവാട്ടു വക ധർമ്മ ദൈവമായ ചെല്ലൂർ ശ്രീ അന്തിമഹാകാളൻ കാവും പ്രസ്തുത ട്രസ്റ്റിന്റെ കീഴിൽ കൊണ്ടുവന്ന് ഭരണ ചുമതലയും ഏറ്റെടുത്ത് പുനർനിർമ്മാണ പ്രക്രിയകൾ നടത്തുകയുണ്ടായി. അവിടെ അന്തിമഹാകാളനും കാരാ ഭഗവതിക്കും തുല്യ പ്രാധാന്യമാണുളളത്. അവർക്ക് പ്രത്യേകം പ്രത്യേകം ശ്രീകോവിലുകളുമുണ്ട് - ഉപദേവൻമാരായി നാഗരാജാവും, നാഗ രാജ്ഞിയുമുണ്ട്. അവിടത്തെ തന്ത്രം കൽപ്പുഴ മനക്കാണ്.നിത്യ പൂജാദി കർമ്മങ്ങൾ നടന്നു വരുന്നുണ്ട്.ഭക്‌തരുടെ വഴിപാടായി കളം പാട്ടും വർഷത്തിൽ നടന്നു വരുന്നു. കല്ലാറ്റ് കുറുപ്പന്മാരാണ് കളം പാട്ടിന് നേതൃത്വം കൊടുക്കുന്നത്.

        </p>
        
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
                  <h2>ക്ഷേത്ര ജീവനക്കാര്‍</h2>
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
          <h4 class="name">വിജയകൃഷ്ണൻ ശാന്തി</h4>
          <h5 class="position">തന്ത്രി</h5>
        </div>
      </div>
    
    </div>
  </div>
  <div class="col-xs-6 col-sm-4 col-md-3 i">
    <div class="c text-center">
      <div class="wrap">
        <img src="<?php echo base_url(); ?>/assets/site6/images/team_9.jpg" alt="#" width="270" height="270" class="img-responsive">
        <div class="info">
          <h4 class="name">കൃഷ്ണൻ പറക്കുന്നത്ത്</h4>
          <h5 class="position">മേൽശാന്തി</h5>
        </div>
      </div>
      
    </div>
  </div>
  <div class="col-xs-6 col-sm-4 col-md-3 i">
    <div class="c text-center">
      <div class="wrap">
        <img src="<?php echo base_url(); ?>/assets/site6/images/team_10.jpg" alt="#" width="270" height="270" class="img-responsive">
        <div class="info">
          <h4 class="name">മോഹൻ പറക്കുന്നത്ത്</h4>
          <h5 class="position">കീഴ്ശാന്തി</h5>
        </div>
      </div>
      
    </div>
  </div>
  <div class="col-xs-6 col-sm-4 col-md-3 i">
    <div class="c text-center">
      <div class="wrap">
        <img src="<?php echo base_url(); ?>/assets/site6/images/team_11.jpg" alt="#" width="270" height="270" class="img-responsive">
        <div class="info">
          <h4 class="name">ഗോപിനാഥ് കെ</h4>
          <h5 class="position">ഓഫീസ് ഇൻചാർജ്</h5>
        </div>
      </div>
      
    </div>
  </div>
  
  <div class="col-xs-6 col-sm-4 col-md-3 i">
    <div class="c text-center">
      <div class="wrap">
        <img src="<?php echo base_url(); ?>/assets/site6/images/team_12.jpg" alt="#" width="270" height="270" class="img-responsive">
        <div class="info">
          <h4 class="name">സുദർശൻ പി കെ</h4>
          <h5 class="position">ക്ലര്‍ക്ക്</h5>
        </div>
      </div>  
    </div>
  </div>
  <div class="col-xs-6 col-sm-4 col-md-3 i">
    <div class="c text-center">
      <div class="wrap">
        <img src="<?php echo base_url(); ?>/assets/site6/images/team_13.jpg" alt="#" width="270" height="270" class="img-responsive">
        <div class="info">
          <h4 class="name">ഗീത സി കെ</h4>
          <h5 class="position">ക്ലര്‍ക്ക്</h5>
        </div>
      </div>
      
    </div>
  </div>
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
  <h3 class="margin head22YellowBold">എത്തിച്ചേരുക</h3><br>
  <div class="class">
    <h4  class="txt17WhiteMargin20px">ബസ്സ് മാര്‍ഗം </h4>
    <p class="text-justify txt16White ">കുറ്റിപ്പുറത്തു നിന്ന് വളാഞ്ചേരി ബസ്സില്‍ കയറി മൂടാല്‍ എന്ന സ്റ്റോപ്പില്‍ ഇറങ്ങിയാല്‍ അമ്പലത്തിലേക്ക് ഓട്ടോ കിട്ടും.  
      തിരൂര്‍, തിരുന്നാവായ, തൃപ്പങ്കോടു ക്ഷേത്രം, ഹനുമാന്‍കാവ് എന്നിവിടങ്ങളില്‍ നിന്ന്  വരുന്നവര്‍ കുറ്റിപ്പുറം ബസ്സില്‍ വന്ന് ചെമ്പിക്കല്ലില്‍ ഇറങ്ങി ഓട്ടോയില്‍ വരുകയോ അല്ലെങ്കില്‍ കുറ്റിപ്പുറം സ്റ്റാന്‍റില്‍ നിന്ന് വളാഞ്ചേരി ബസ്സില്‍ കയറി മൂടാല്‍ എന്ന സ്റ്റോപ്പില്‍ ഇറങ്ങി ഓട്ടോയില്‍ വരുകയോ ചെയ്യാം. (മൂടാലിൽ നിന്നും പടിഞ്ഞാട്ടുള്ള റോഡിൽ 1/2 കിലോ മീറ്റർ വന്നാൽ ക്ഷേത്രത്തിൽ എത്താം, ചെമ്പിക്കല്ലില്‍ നിന്ന് ദൂരം കൂടുതലാണ്)
      </p>
      <br><br>
      <h4  class="txt17WhiteMargin20px">തീവണ്ടി മാര്‍ഗം </h4>
      <p class="text-justify txt16White ">പറക്കുന്നത്ത് ക്ഷേത്രത്തിന്‍റെ അടുത്തുള്ള റെയില്‍ വേ സ്റ്റേഷന്‍ കുറ്റിപ്പുറമാണ്. അവിടെ ഇറങ്ങി വളാഞ്ചേരി ബസ്സില്‍ കയറി മൂടാല്‍ എന്ന സ്റ്റോപ്പില്‍ ഇറങ്ങിയാല്‍ അമ്പലത്തിലേക്ക് ഓട്ടോ കിട്ടും. തിരൂര്‍ സ്റ്റേഷനിലാണ് ഇറങ്ങിയതെങ്കില്‍ തിരൂരില്‍ നിന്ന് കുറ്റിപ്പുറം ബസ്സില്‍ വന്ന് ചെമ്പിക്കല്ലില്‍ ഇറങ്ങി ഓട്ടോയില്‍ വരുകയോ അല്ലെങ്കില്‍ കുറ്റിപ്പുറം സ്റ്റാന്‍റില്‍ നിന്ന് വളാഞ്ചേരി ബസ്സില്‍ കയറി മൂടാല്‍ എന്ന സ്റ്റോപ്പില്‍ ഇറങ്ങി ഓട്ടോയില്‍ വരുകയോ ചെയ്യാം. </p>
      <br><br>
      <h4  class="txt17WhiteMargin20px">വിമാന മാര്‍ഗം </h4>
      <p class="text-justify txt16White ">പറക്കുന്നത്ത് ക്ഷേത്രത്തിന്‍റെ അടുത്തുള്ള വിമാന താവളം കോഴിക്കോടാണ്. അടുത്തുള്ള മറ്റ് വിമാന താവളങ്ങള്‍ കൊച്ചിയും കോയമ്പത്തൂരുമാണ്. നല്ല താമസ സൌകര്യം കുറ്റിപ്പുറത്തു കുറവാണ്. അയതിന്നാല്‍ തിരൂരോ, കോട്ടക്കല്ലോ റൂ എടുത്ത് ക്ഷേത്ര ദര്‍ശ്ശനം നടത്താം. </p>
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
              <td><strong>വിലാസം</strong><br>
                മാനേജർ, പറക്കുന്നത്തു ക്ഷേത്രം, ചെല്ലൂർ, കുറ്റിപ്പുറം, കേരളം 67957 </td>
            </tr>
            <tr>
              <td><img src="<?php echo base_url(); ?>/assets/site6/images/phone.png" alt="Phone"> </td>
              <td><strong>ഫോൺ നമ്പർ</strong><br>
                0494 260 7552, <strong> 
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
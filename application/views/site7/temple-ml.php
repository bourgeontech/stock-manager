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
            <li><a class="Inactive" href="index-ml.html">ഹോം</a></li>
            <li><a class="active" href="temple-ml.html">ക്ഷേത്രം&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="temple-ml.html#about">ക്ഷേത്രത്തെക്കുറിച്ച്</a></li><li><a href="temple-ml.html#devathas">ദേവതകള്‍</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/poojas_ml">പൂജകള്‍ &nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="poojas-ml.html#vazhipadu">വഴിപാടുകള്‍</a></li><li><a href="poojas-ml.html#online">വഴിപാട് കഴിക്കുക</a></li><li><a href="poojas-ml.html#timing">പൂജാ സമയം</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/festivals">ഉത്സവം&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">ഉത്സവ വിശേഷം</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">ചിത്രങ്ങള്‍</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/news">വിശേഷങ്ങള്‍ </a></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/contact_ml">നിര്‍വ്വഹണം‌&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#trustee">ട്രസ്റ്റും ഭാരവാഹികളും</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#staffs">ക്ഷേത്ര ജീവനക്കാര്‍</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#hwreach">എത്തിച്ചേരുക</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact_ml#tmmap"> ബന്ധപെടുക</a></li></ul></li>            </ul>
        </nav>
        <a href="<?php echo base_url(); ?>index.php/welcome/temple"><img src="<?php echo base_url(); ?>/assets/site6/images/eng.png" alt="English" class="socialIcons"></a><a href="<?php echo base_url(); ?>index.php/welcome/temple_ml"><img src="<?php echo base_url(); ?>/assets/site6/images/mal.png" alt="Malayalam" class="socialIcons"> </a></div></div>
    </div>
  </div>
</div>

<!--About-->
<a id="about"></a>
<div class="container-fluid narayanaBg">
  <div class="container">
    <div class="well"> 
        <div class="row">
             <div class="col-md-12">
                 <div class="row hidden-md hidden-lg"><h1 class="text-center" >പറക്കുന്നത്ത് ഭഗവതി ക്ഷേത്രം </h1></div>
                     
                 <div class="pull-left col-md-4 col-xs-12 thumb-contenido"><img class="center-block img-responsive" src="<?php echo base_url(); ?>/assets/site6/images/temhero.jpg" /></div>
                 <div class="">
                     <h1  class="hidden-xs hidden-sm">പറക്കുന്നത്ത് ഭഗവതി ക്ഷേത്രം </h1>
                     <hr>
                     <hr>
                     <p class="text-justify">മലപ്പുറം ജില്ലയിലെ കുറ്റിപ്പുറത്ത് ചെല്ലൂരിലുള്ള ഒരു ഭഗവതി ക്ഷേത്രമാണ് പറക്കുന്നത്ത്ക്ഷേത്രം.മാതൃഭാവത്തിലുള്ള ഭദ്രകാളിയാണ് പ്രതിഷ്ഠ. കേരളത്തിലെ ദേവിയുടെ ഏറ്റവും പഴക്കമേറിയതും ശക്തവുമായ ഇരിപ്പിടങ്ങളിൽ ഒന്നാണിത്. ഇവിടെ ദേവിയെ കുലാചാര തന്ത്ര മാർഗത്തിലാണ് ആരാധിക്കുന്നത്. കുലാചാര തന്ത്ര മാർഗത്തിൽ ജാതി മത വര്‍ണ്ണ ലിംഗഭേദങ്ങള്‍ പാടില്ല. ഇവിടെ എല്ലാവരും ദേവിയുടെ മക്കളാണ്. അതിനാൽ ഏത് ജാതിയിലും ലിംഗത്തിലും പെട്ട ആർക്കും ഭഗവതിയെ ദര്‍ശ്ശനം നടത്താം<br><br>

                      ജാതിമത ഭേദമന്യേ, ദുരിതങ്ങളിൽ നിന്നും മോചനം തേടി ദൂരദേശങ്ങളിൽ നിന്നുപോലും ആളുകൾ ഈ ക്ഷേത്രത്തിൽ എത്തുന്നു. ദേവി തന്‍റെ ക്ഷേത്രത്തില്‍ വരുന്ന എല്ലാ ഭക്തരേയും സ്വന്തം മക്കളെപ്പോലെ കാണുകയും അവരുടെ എല്ലാ ആഗ്രഹങ്ങളും നിറവേറ്റുകയും ചെയ്യുന്നു. ‘കുലാചാര' സമ്പ്രദായമനുസരിച്ച് ദേവിക്ക് പൂജകൾ (വഴിപാടുകൾ) നടത്തുന്നു. ഇവിടെ മുക്കോല ചാത്തൻ ദേവിയുടെ ആശ്രിതനായി കണക്കാക്കപ്പെടുന്ന ഒരു ഉപദേവനായും ആരാധിക്കപ്പെടുന്നു.<br><br>
                      
                      2000-ൽ ഈ ക്ഷേത്രത്തിൽ ചില ദുശ്ശകുനങ്ങൾ ശ്രദ്ധയിൽപ്പെട്ടതിനാൽ അതേ വർഷം തന്നെ 'താംബൂലപ്രശ്നം' നടത്തുകയും ദേവ പ്രീതിക്കായിട്ടുള്ള പരിഹാര നടപടികൾ സ്വീകരിക്കുകയും ചെയ്തു. ശ്രീകോവില്‍ പുതുക്കിപ്പണിയുകയും കാലക്രമേണ ശോഷിച്ച ദേവിയുടെ 'ദാരുഭിംബ' (വിഗ്രഹം) പുതുക്കിപ്പണിയുകയും പ്രതിഷ്ഠ നടത്തുകയും ചെയ്തു. ക്ഷേത്രം മുഖ്യ പൂജാരി ബ്രഹ്മശ്രീ വിജയകൃഷ്ണനാണ് പ്രതിഷ്ഠാ ചടങ്ങുകൾ നടത്തിയത്. <br><br>
                      
                      അതിനുശേഷം, ക്ഷേത്രത്തിന് അവിശ്വസനീയമായ പുരോഗതിയുടെ കാലഘട്ടമായിരുന്നു. മുന്പ് കഷ്ടിച്ച് 46 സെന്‍റ് മാത്രമായിരുന്നു ക്ഷേത്രപരിസരം, സ്ഥലപരിമിതി ഏറെ ബുദ്ധിമുട്ട് സൃഷ്ടിച്ചിരുന്നു, പ്രത്യേകിച്ച് ഉത്സവകാലത്ത്. ക്ഷേത്രത്തിലെത്തുന്ന ഭക്തർക്ക് പ്രാഥമിക കൃത്യങ്ങൾ നിർവഹിക്കാൻ ബുദ്ധിമുട്ട് അനുഭവപ്പെട്ടിരുന്നു. വെള്ളത്തിന്റെ ദൗർലഭ്യം സ്ഥിതിഗതികൾ കൂടുതൽ വഷളാക്കുകയും പുറത്തുനിന്ന് വെള്ളം കൊണ്ടുവരേണ്ടി വരികയും ചെയ്തു. എന്നാൽ ദേവിയുടെ അനുഗ്രഹത്താൽ ക്ഷേത്രത്തിന് സമീപത്തെ 1.65 ഏക്കർ സ്ഥലം ക്ഷേത്ര ആവശ്യങ്ങൾക്കായി വാങ്ങാൻ കഴിഞ്ഞു. ഭൂമിയിൽ കിണർ കുഴിക്കുകയും ദൂരസ്ഥലങ്ങളിൽ നിന്നെത്തുന്ന തീർഥാടകർക്ക് മറ്റു സൗകര്യങ്ങളും ഒരുക്കാനും കഴിഞ്ഞു. <br><br>
                      
                      2011 സെപ്തംബർ ഒന്ന്, രണ്ട് ദിവസങ്ങളിൽ ക്ഷേത്രത്തില്‍ അഷ്ടമംഗലപ്രശ്നം നടത്തുകയും ചില ദോഷങ്ങൾ ഉണ്ടെങ്കിലും, നിഷ്ഠകളാലും ആചാരങ്ങളാലും സമ്പന്നമായ ക്ഷേത്രത്തിൽ ദേവി പൂര്‍ണ്ണ തൃപ്തയാണെന്ന് തെളിഞ്ഞു. ദേവപ്രശ്നത്തിൽ, നൂറുകണക്കിന് വർഷങ്ങൾക്ക് മുമ്പ്, ഒരു മഹാമുനി ഇവിടെ വന്നിരുന്നുവെന്നും, ദേവിയുടെ സാന്നിധ്യം അനുഭവിച്ചറിയുകയും, തന്‍റെ തപസ്സിലൂടെ ദേവിയെ തന്‍റെ മുന്നിൽ പ്രത്യക്ഷപ്പെടുത്തിയെന്നും കണ്ടു. കുന്നിൻ മുകളിൽ ക്ഷേത്രം സ്ഥിതി ചെയ്യുന്ന സ്ഥലം പണ്ട് പരക്കുന്ന് എന്ന് അറിയപ്പെട്ടിരുന്നു എന്നും കാലക്രമേണ പരക്കുന്ന് എന്നത് ചെറിയ ഉച്ഛാര വ്യത്യാസത്തോടെ പറക്കുന്ന് എന്നറിയപ്പെടാന്‍ തുടങ്ങിയതാണെന്നും കണ്ടു. ഇന്ന് ക്ഷേത്രം പറക്കുന്ന് ക്ഷേത്രം എന്ന പേരിലാണ് അറിയപ്പെടുന്നത്, ക്ഷേത്രത്തിന്‍റെ പേരിലുള്ള കുന്ന് 'മീനചക്ര'ത്തെ സൂചിപ്പിക്കുന്നുവെന്ന് വിശ്വസിക്കപ്പെടുന്നു. ഈ പ്രദേശത്ത് ജനവാസം വളരെ കുറവായിരുന്നു, വളരെക്കാലമായി ക്ഷേത്രം ആളൊഴിഞ്ഞ നിലയിലായിരുന്നു. കല്ലടിക്കോട് മലവര ദേവതകളെ സേവിച്ച് പ്രത്യേക കഴിവുകൾ നേടിയ ആദിമുത്തപ്പൻ എന്ന പറയ സമുദായാംഗത്തിന് വർഷങ്ങൾക്ക് ശേഷം ദേവി ദർശനം നൽകുകയും അവളുടെ ആഗ്രഹപ്രകാരം ദേവിയെ ആദിമുത്തപ്പന്‍റെ പടിഞ്ഞാട്ടിൽ (പടിഞ്ഞാറ് ഭാഗം) പ്രതിഷ്ഠിക്കുകയും ചെയ്തു. ദേവി തന്‍റെ പൂജകളും അനുഷ്ഠാനങ്ങളും ആദിമുത്തപ്പനോട് നിർദ്ദേശിക്കുകയും തന്നെ സേവിക്കാൻ ആവശ്യമായ ശക്തിയും അനുഗ്രഹവും അവനും അവന്‍റെ വംശാവലിക്കും (പിൻതലമുറ) നൽകുകയും ചെയ്തു. ആദിമുത്തപ്പന്റെ പടിഞ്ഞാട്ടിലെ ശ്രഷ്‌ഠത്വമില്ലായ്മ മനസ്സിലാക്കിയ ദേവി നാടുവാഴിക്ക് സ്വപ്നദർശനം നൽകുകയും അവളുടെ നിർദ്ദേശപ്രകാരം നാടുവാഴി ദേവിയെ അത്യുന്നതമായ പറക്കുന്നത്ത് സ്ഥാനം നൽകി ആദരിക്കുകയും ചെയ്തു. <br><br>
                      
                      ആദിമുത്തപ്പയ്ക്ക് നൽകേണ്ട പൂജകളെക്കുറിച്ചും വഴിപാടുകളെക്കുറിച്ചും ദേവി ഉപദേശിക്കുന്നത് മുതൽ, ഈ ക്ഷേത്രത്തിൽ പൂജകളും ചടങ്ങുകളും അർപ്പിക്കുന്നത് പറയ സമുദായത്തിൽ പെട്ട അദ്ദേഹത്തിന്റെ പിൻതലമുറക്കാരാണ്. നാടുവാഴിക്ക് ദേവി സ്വപ്‌നദർശനം നൽകുകയും അവളുടെ പ്രതിഷ്‌ഠയെ ശ്രേഷ്ഠസ്ഥാനത്ത് പ്രതിഷ്‌ഠിക്കുകയും ചെയ്‌തതുമുതൽ, നാടുവാഴിയിലൂടെ കൊല്ലോടി കുടുംബത്തിലെ അംഗങ്ങൾക്ക് 'മേൽക്കോയ്മ' എന്ന പദവി ലഭിച്ചു. ഈ ആചാരം നാളിതുവരെ തുടരുന്നു. അദ്ദേഹം സേവിച്ച ആദിമുത്തപ്പൻ, മലവാര ദേവതകൾക്ക് പ്രത്യേക സ്ഥാനങ്ങൾ നൽകുകയും ക്ഷേത്ര പൂജാരിമാരുടെ വീടുകളിൽ ആരാധിക്കുകയും ചെയ്തിട്ടുണ്ട്. <br><br>
                       
                       </p></div>
                </div>
              </div>
          </div>
      </div>
      </div>
      </div>
      </div>
    </div>
<!--Upadevathas-->
<a id="devathas"></a>
<div class="container-fluid timingBg text-center">  
  <div class="container">
   <br>   
  <h3 class="margin head22YellowBold">ദേവതകള്‍</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <img src="<?php echo base_url(); ?>/assets/site6/images/vg-1.jpg" class="img-responsive margin" style="width:100%" alt="Image">
      <h4 class="margin head22YellowBold">മൂക്കന്‍ ചാത്തന്‍</h4>
      <p class="txt16White">മൂക്കൻ ചാത്തൻ ഈ ക്ഷേത്രത്തിന്‍റെ സംരക്ഷകനായി പ്രവർത്തിക്കുന്നു. കാളപ്പുറത്ത് തന്‍റെ മാന്ത്രിക ദണ്ഡ് ധരിച്ച് ലോകം ചുറ്റി തന്‍റെ ഭക്തരെ കാത്തു രക്ഷിക്കുന്നു. </p>
      
    </div>
    <div class="col-sm-4"> 
      <img src="<?php echo base_url(); ?>/assets/site6/images/vg-2.jpg" class="img-responsive margin" style="width:100%" alt="Image">
      <h4 class="margin head22YellowBold">പറക്കുന്നത് അമ്മ</h4>
      <p class="txt16White">പറക്കുന്നത്തു ക്ഷേത്രത്തിലെ പ്രധാന പ്രതിഷ്ഠ ഭദ്രകാളിയാണ്. തെയ്യവാർ കോലഗണഭഗവതിയുടെ രൂപത്തിലാണ് ദേവിയെ ആരാധിക്കുന്നത്.</p>
      
    </div>
    <div class="col-sm-4"> 
      <img src="<?php echo base_url(); ?>/assets/site6/images/vg-3.jpg" class="img-responsive margin" style="width:100%" alt="Image">
      <h4 class="margin head22YellowBold">നാഗ ദേവതകള്‍</h4>
      <p class="txt16White">സർപ്പങ്ങൾ ഒരു വംശത്തിന്‍റെയോ കുടുംബത്തിന്‍റെയോ സംരക്ഷക ദേവതകളാണ്, അവരുടെ ആരാധന കുടുംബത്തിന് ക്ഷേമവും സമൃദ്ധിയും നൽകുന്നു

      </p>
      
    </div>
  
</div>
</div>
</div>
<!--team-->

<!--end-->
</div>
</body>
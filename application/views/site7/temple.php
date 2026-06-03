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
            <li><a class="active" href="<?php echo base_url(); ?>index.php/welcome/temple">The Temple&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/temple#about">About</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/temple#devathas">Devathas</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/poojas">Poojas &nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#vazhipadu">Vazhivadu (Offerings)</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#online">Book an offering</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#timing">Daily Pooja Timings</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/festivals">Festivals&nbsp;<span class="caret"></span></a><ul class="sub-menu"><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">Thanthrik Festivals</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">Gallery</a></li></ul></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/news">News </a></li>
            <li><a class="Inactive" href="<?php echo base_url(); ?>index.php/welcome/contact">Administrative</a><ul><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#trustee">Trust &amp; Trustees </a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#staffs">Temple Staffs</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#hwreach">How to Reach</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#tmmap">Contact Us</a></li></ul></li>
          </ul>
        </nav>
        <a href="<?php echo base_url(); ?>index.php/welcome/temple"><img src="<?php echo base_url(); ?>/assets/site6/images/eng.png" alt="English" class="socialIcons"></a><a href="<?php echo base_url(); ?>index.php/welcome/temple_ml"><img src="<?php echo base_url(); ?>/assets/site6/images/mal.png" alt="Malayalam" class="socialIcons"> </a></div></div>
  </div>
</div>
<!--About-->
<a id="about"></a>
<div class="container-fluid narayanaBg">
  <div class="container">
    <div class="well"> 
        <div class="row">
             <div class="col-md-12">
                 <div class="row hidden-md hidden-lg"><h1 class="text-center" >PARAKKUNATHU BHAGAVATHI KSHETRAM </h1></div>
                     
                 <div class="pull-left col-md-4 col-xs-12 thumb-contenido"><img class="center-block img-responsive" src="<?php echo base_url(); ?>/assets/site6/images/temhero.jpg" /></div>
                 <div class="">
                     <h1  class="hidden-xs hidden-sm">PARAKKUNATHU BHAGAVATHI KSHETRAM </h1>
                     <hr>
                     <hr>
                     <p class="text-justify">The Parakkunathu Temple is a Bhagavathi temple at Chellur, Kuttipuram in Malappuram district, Kerala. Dedicated to the mother goddess Bhadrakali. It is one of the oldest and most powerful seat of the goddess in Kerala.  In Parakkunathu Temple the mother goddess Bhadrakali is worshipped in Kulachara Tantra Marga. Intrestingly, in the Kulachara tantra marga there is no discrimination of caste or gender. Hence any person belonging to any caste and gender can get the boons of Bhagavathi.<br><br>
                 
                      People, even from faraway places, come to this temple, irrespective of their caste or creed, seeking relief from their sufferings and misfortunes. Devi treats all her devotees who come to her altar like her own children and fulfil all their desires. Pujas (offerings) are made to Goddess as per the system of 'Kowlachara'. Mukkola Chathan is also worshipped as a subordinate deity, considered as a dependent of Devi. <br><br>
                     Some bad omens were noticed in this temple in the year 2000 and hence a 'Thamboola Prashna' was conducted in the same year and remedial measures were taken to please the goddess and to escape her wrath. The altar was renovated and Devi's 'Darubhimba' (idol), depleted of time's long passage was renovated and consecrated. The chief priest of temple, Bhramasree Vijayakrishnan conducted the consecration ceremony. <br><br>
                                      
                                           Since then, it was a period of incredible progress for the temple. The temple premises were barely 46 cents, and the lack of space had caused much inconvenience, especially in the time of festivals. Devotees who came to the temple had always found it difficult to discharge their primary routines. Scarcity of water had made matters worse and water had to be brought from outside. But thanks to Devi's blessing, the temple managed to buy 1.65 acres of adjacent land for temple purposes. Well were dug in the land and other facilities for the pilgrims who come from distant places have been provided.  <br><br>
                                      
                                           On the Ist and 2nd of September 2011, an 'Ashtamangala Prashnam' was conducted in the altar. It was observed that in spite of some 'Doshas' (unpleasant matter), Devi's presence in the temple enriched by rituals and customs was in her most happy face. 
                                           In the 'Devaprashna', it was found out that hundreds of years ago, a great sage had come to this place, and found feeling Devi's presence, had made her appear before him through his prayers. The hilltop where the temple is situated was called Parakkunnu which is pronounced with a slight difference today. It is believed that Kunnu in the name of temple indicates the 'MeenaChakra'. The population in this area was very low and the temple had been left deserted for a long time. After many years a member of the Paraya community named Adimuthappan who had acquired special talents by serving Kalladikod 
                                           Malavara Deities was given Dharshan by goddess, and, as per her wish Devi was placed in Adimuthappan's 
                                           Padinhatt (Westeren Side). Devi suggested her pujas and rituals to Adimuthappan and provided him and his lineage (posterity) with the strength of blessings required to serve her. Realizing the lack of sublimity in Adimuthappan's Padinhatt, Devi gave a dream vision to the Naduvazhi, the ruler of the province and as per her instructions, the Naduvazhi honoured the deity by providing the most sublime Parakkunnath sthana. <br><br>
                                           Ever since Devi advices to Adimuthappa about the poojas and offer offerings to be made to her, it is the members of his posterity belonging to the Paraya Community who offer poojas and rites in this temple.
                                           Ever since the Naduvazhi was given dream vision by the goddess and her deity was placed in the sublime place, the title of goddess 'melkoyma' was given to the members of Kollodi family through the Naduvazhi. This custom is continued till day. Adimuthappan and Malavara deities whom he served are given special places and have been worshipped in the houses of temple priests. 
                                         
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
  <h3 class="margin head22YellowBold">DEVATHAS</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <img src="<?php echo base_url(); ?>/assets/site6/images/vg-1.jpg" class="img-responsive margin" style="width:100%" alt="Image">
      <h4 class="margin head22YellowBold">Mookkan Chathan</h4>
      <p class="txt16White">Mookkan chathan is acts as a guardian of this temple and he got his magical stick and the bull to travel around the universe.</p>
      
    </div>
    <div class="col-sm-4"> 
      <img src="<?php echo base_url(); ?>/assets/site6/images/vg-2.jpg" class="img-responsive margin" style="width:100%" alt="Image">
      <h4 class="margin head22YellowBold">Parakkunnathu Amma</h4>
      <p class="txt16White">The primary deity of the Parakkunnathu Temple is Bhadrakali. She is worshipped as in the form of Theyyawar Kolagana Bhagavathi.</p>
      
    </div>
    <div class="col-sm-4"> 
      <img src="<?php echo base_url(); ?>/assets/site6/images/vg-3.jpg" class="img-responsive margin" style="width:100%" alt="Image">
      <h4 class="margin head22YellowBold">Naga Devathas</h4>
      <p class="txt16White">The Serpents are the protector deities of a clan or family and their worship brings well-being and prosperity to the family</p>
      
    </div>
  
</div>
</div>
</div>

</div>
</body>


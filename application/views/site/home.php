    
<?php 
$aboutus=$this->site_model->aboutus_home();
$aboutus=$this->site_model->getaboutus();
$site_settings=$this->site_model->settings();
?>
    <section class="slide_part">
      <div class="container">
        <div>
          <div class='homeslider'>
            <ul id='slider' class='owl-carousel owl-theme in_nav'>
                
              <!--<li><img class='img-fluid' title='<?php print_r($temple_list[0]['name']);?>' alt='' width='' height='' src='<?php echo base_url(); ?>/assets/new_site/uploads/banner/15_banner1.jpg'> </li>-->
              <!--<li><img class='img-fluid' title='<?php print_r($temple_list[0]['name']);?>' alt='' width='' height='' src='<?php echo base_url(); ?>/assets/new_site/uploads/banner/16_banner2.jpg'> </li>-->
              <!--<li><img class='img-fluid' title='<?php print_r($temple_list[0]['name']);?>' alt='' width='' height='' src='<?php echo base_url(); ?>/assets/new_site/uploads/banner/35_banner3.jpg'> </li>-->
              <!--<li><img class='img-fluid' title='<?php print_r($temple_list[0]['name']);?>' alt='' width='' height='' src='<?php echo base_url(); ?>/assets/new_site/uploads/banner/36_banner4.jpg'> </li>-->
             <?php 
                foreach ($banner as $value){
                ?>
                <li><img class='img-fluid' style="max-width: auto; height: 377px;" title='<?php print_r($temple_list[0]['name']);?>' alt='' width='' height='' src='../../uploads/banner/<?PHP echo $value['image']; ?>'>
                </li>
                
                 <?php } ?>
            </ul>
          </div>
          <div class='home_ad'>
            <ul id='ad_slider' class='owl-carousel owl-theme'>
               <?php 
                foreach ($advertisement as $value){
                ?>
               
                <li><img class='img-fluid' style="max-width: auto; height: 377px;" src='../../uploads/advertisement/<?PHP echo $value['image']; ?>'> </li>
                 <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
    <div  class="atd" id=""  >
      <audio autoplay id='tempAudio' src='<?php echo base_url(); ?>/assets/new_site/uploads/music/<?php echo $site_settings['opening_song']; ?>' preload='auto'> </audio>
      <a onClick='togglePlay()'>
      <div class='atd_btn'></div>
      </a> </div>
    <style>
		.atd{
			cursor: pointer;
			font-size: 20px;
			position: fixed;
			right: auto;
			bottom: 30px;
			left: 22px;
			top: 30px; text; text-align: center}
		
		.atd_btn {
			background: #eee url("<?php echo base_url(); ?>/assets/new_site/images/music_icons.png") no-repeat;
			background-position: center -19px;
			width: 30px;
			height: 30px;
		}
		.play {background-position: center 5px;}
		.atd_btn audio {
			position: absolute;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
		}
		
		
	</style>
    <section>
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class='col-lg-8'>
              <div class='home_about_block'>
                <h2 class='title1 title1_left'>About Temple</h2>
                <h3 class='mb-4 mt-3' style='    font-size: 22px;    color: #702308;'><?php print_r($temple_list[0]['name']);?></h3>
                <div class='row'>
                  <div class='col-lg-4 text-center'> <img title='<?php print_r($temple_list[0]['name']);?>' alt='<?php print_r($temple_list[0]['name']);?> image' src='<?php echo base_url(); ?>/uploads/aboutus/<?php  echo $aboutus['0']['image']; ?>' class='img-fluid'> </div>
                  <div class='col-lg-8'>
                    <p class='text-justify'> <?php print_r($aboutus[0]['short_content']);?> ...</p>
                    <a href='<?php echo base_url(); ?>index.php/welcome/aboutUs' title='Read More' class='btn btn-more'>Read More</a> </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4" onClick="location='<?php echo base_url();?>index.php/welcome/eventFestival'" style="cursor: pointer;">
				<div class="events_outer" style="height:auto;">
              <h2 class="title1 title1_left">Events</h2>
              <!--<h3 class='mb-4 mt-3' style='font-size: 22px;color: #702308;'><?php print_r($events[0]['title']);?> </h3>-->
              <!--<small style='font-size: 12px;color: #702308;'> <?php //print_r(date('d-m-Y',strtotime($events[0]['created'])));?></small>-->
              <div>
              <figure>
                  <div class='date'><?php //print_r(date('d-m-Y',strtotime($events[0]['created'])));?></div>
                  <img src='../../uploads/events/<?php print_r($events[0]['image']);?>' title='<?php print_r($events[0]['title']);?>' alt='' width='' height=''> </figure>
                <figcaption>
                <h3><?php print_r($events[0]['title']);?></h3>
                </figcaption>
            </div></div></div>
          </div>
        </div>
      </div>
    </section>
<?php
if ($this->db->field_exists('qr_home', 'site_settings') && $this->db->field_exists('bank_home', 'site_settings')) {
    $query = $this->db->select('qr_home, bank_home')
                      ->from('site_settings')
                      ->limit(1)
                      ->get();
    
    if ($query->num_rows() > 0) {
        $row = $query->row();

        if ($row->qr_home == 1 && $row->bank_home == 1) {?>
 <div class="clearfix"></div>
    <section>
      <div class="container">
        <div class="home_welcome">
         <div class='home_about_block'>
          <div class="row">
         
            <div class='col-lg-1 text-center'>
          </div>
             <div class='col-lg-5 text-center'>
               
             
               </div>
               
                 
                  
         
          <div class='col-lg-5 text-center'>
          <img src="<?php echo base_url(); ?>/assets/new_site/images/utsavam-eroor-pic.jpeg" style="width:100%;"> 
          
          </div>
         <div class='col-lg-1 text-center'>
          </div>
        
        
        </div>
        </div>
      </div>
    </section>
<?php }
    }
}
?>


    <div class="clearfix"></div>
    <section class="section_pooja">
      <div class="container">
        <div class="pooja_itemarea">
          <div class="row">
            <div class='col-lg-12'>
              <h2 class='title1 text-center title1_center'>Available Poojas</h2>
              <ul id = 'pooja_items' class='owl-carousel owl-theme dotte_slider'>
                <?php 
                foreach ($pooja_list as $pooja){
                ?>
                    <li>
                      <div class='pooja_item'>
                        <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >
                        <?php echo $pooja['name_mal']." - ".$pooja['name'];?> </div >
                    </li>
                <?php 
                }
                ?>
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    വിശേഷാൽ അർച്ചന ഭാഗ്യസൂക്തം  - SPL. ARCHANA BHAGYAS... </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    നെയ് വിളക്ക് -   Ney Vilakku </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    മാല - Mala </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    പായസം- PAYASAM </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    തൃകാല പൂജ- Thrikala Pooja </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    പാൽപായസം- Palpayasam </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    ഒരുദിവസത്തെ നെയ് വിളക്ക്- Ney Vilakku for 1 Day </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    ജന്മനക്ഷത്രപൂജ(ഒരുവർഷത്തേക്ക്)- Janma Nakshathra P... </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    തൃച്ചന്ദനം - Thrichandanam </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    മൂക്കോലക്കല്ല് -	Mookkola Kallu </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    മലർ നിവേദ്യം	- Malar  Nivedyam </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    മലർപറ - Malar Para </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    നെയ്യപ്പം 1 കൂട്ട് - Neyyappam 1 Koottu </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    നെയ്യപ്പം 1 ഇടങ്ങഴി - Neyyappam 1 Edangazhi </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    നൂറ്റെട്ടുമാല	- Noottettu Mala </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    ചുറ്റുവിളക്ക്	- Chuttuvilakku </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    ചെറിയചുറ്റുവിളക്ക്	- Cheriya Chuttuvilakku </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    തിരുമുടിമാല - Thirumudi Mala </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    ശംഖാഭിഷേകം	- Sanghabhishekam </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    ഒരുദിവസത്തെപൂജ	- One Day Pooja </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    ജന്മനക്ഷത്രപൂജ	- Janma Nakshathra Pooja </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    വിളക്ക് - Vilakku </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    മാല - Mala </div >-->
                <!--</li>-->
                <!--<li>-->
                <!--  <div class='pooja_item'>-->
                <!--    <div><img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' ></div >-->
                <!--    സ്പെഷൽ ദിവസ പൂജ - Special Divasa Pooja </div >-->
                <!--</li>-->
              </ul >
            </div >
          </div>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
    <section class="home_gallery">
      <div class="container">
        <h2 class="title1 text-center title1_center">Gallery</h2>
        <ul id='gallery' class='owl-carousel owl-theme dotte_slider'>
         
           <?php 
                foreach ($gallery_list as $value){
                ?>
          <li> 
     <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery' 
      title='gallery'><img alt='' src='../../uploads/gallery/<?PHP echo $value['image']; ?>' height="240px"/></a> </li>
                 <?php } ?>
          </ul>
      </div>
    </section>
    <div class="clearfix"></div>
<script>
    var myAudio = document.getElementById("tempAudio");
    var isPlaying = false;
    
    function togglePlay() {
      if (isPlaying) {
    	myAudio.pause()
      } else {
    	myAudio.play();
      }
    };
    myAudio.onplaying = function() {
      isPlaying = true;
    };
    myAudio.onpause = function() {
      isPlaying = false;
    };
    	
    
    	$(".atd_btn").click(function(){
    	  $(this).toggleClass("play");
    	});
    		
</script>

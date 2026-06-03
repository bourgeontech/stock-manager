<?php 
$site_settings=$this->site_model->settings();
$asideimage=$site_settings['asideimage'];
$videolink=$site_settings['video_link'];
?>
        <section class="slide_part">
          <div class="container">
            <div class="row">
              <div class='col-md-12'>
                <div class='homeslider'>
                  <ul id='slider' class='owl-carousel owl-theme in_nav'>
                    <?php 
                        foreach ($banner as $value){
                        ?>
                        <li><img class='img-fluid' style="max-width: auto; height: 377px;" title='<?php print_r($temple_list[0]['name']);?>' alt='' width='' height='' src='../../uploads/banner/<?PHP echo $value['image']; ?>'></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>  
          </div>
        </section>
          
        <section class="latest_news_outer">
          <div class="container">
              <div class="typing-container">
                <h4 id="typing-text"></h4>
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
            right: 4px;
            bottom: 30px;
            left: auto;
            top: 105px; 
            text-align: center;
            z-index: 1;
          }
          
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
                          

        <section class="home_welcome about_bg_none">
          <div class="container">
            <div class="">
              <div class="row">
                <div class='col-lg-9'>
                  <div class='home_about_block'>
                    <!--<h2 class="title1  title1_center m-3"><?php print_r($temple_list[0]['name']);?></h2>-->
                    <div class='row bg-white p-3 m-4'>
                      <!-- <div class='col-lg-5 text-center'> <img title='Mookuthala Temple' alt='Mookuthala Temple image' src='images/about_img.jpg' class='img-fluid'> </div> -->
                      <div class='col-lg-12'>
                        <p class='text-justify'> <?php print_r($aboutus[0]['short_content']);?> </p>
                        <a href='<?php echo base_url(); ?>index.php/welcome/aboutUs' title='Read More' class='btn btn-more'>Read More</a> 
                      </div>
                    </div>
                  </div>
                  <div class="home_gallery">
                    <!-- <h2 class="title1 title1_center">Gallery</h2> -->
                    <div class="gallery-bgm">
                      <ul id='gallery' class='owl-carousel owl-theme dotte_slider'>
                        <?php 
                            foreach ($gallery_list as $value){
                            ?>
                            <li> 
                                <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery' 
                                title='gallery'><img alt='' src='../../uploads/gallery/<?PHP echo $value['image']; ?>' height="150px"/></a> 
                            </li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
<!--                   <div class='home_about_block'>
                    <h2 class="title1 title1_center m-3 mt-3">Gratitude</h2>
                    <div class='row bg-white p-3'>
                      <div class='col-lg-12 '>
                        <p class='text-justify'> Venugopalaswamy Kainkaryam Trust, Chennai, under its chairman, Sri Venu Srinivasan (Chairman, TVS Group) has been involved in the restoration activity of Sree Vadakkunnathan Temple, from 2005 onwards. Till date, they have carried out the conservation activities of Sree Vettakkaran Temple, Gosalakrishnan, Sree Vrishabhan , Simhodaran, Ayyappan, North and South Chuttambalam, Valiyambalam, all the 3 Namaskara Mantapam’s , Sree Rama & Sankaranarayana Sree Kovil’s. Apart from this, the trust has also carried out the renovation of temple pond( Surya Pushkarini) . It has also done extensive work on the improvement of the environment of the temple including Landscaping, Compost pit, “Nandavanam”. .. All the works are done as per Archeology standards and specifications, and sanctions were given by Archeological Survey Of India department, to carry out the works. </p>
                      </div>
                    </div>
                  </div> -->
                </div>
        <!-- ASIDE START-->
        <?php $this->load->view('site3/layouts/aside'); ?>   
        <!-- ASIDE END-->
              </div>
            </div>
          </div>
        </section>

        <div class="clearfix"></div>
    <script>
          const text = "<?php echo $site_settings['typing_text']; ?>";
        
        const typingSpeed = 70; 
        
        let charIndex = 0;
        const typingText = document.getElementById("typing-text");
        
        function type() {
          if (charIndex < text.length) {
            typingText.innerHTML += text.charAt(charIndex);
            charIndex++;
            setTimeout(type, typingSpeed);
          }
        }
        
        document.addEventListener("DOMContentLoaded", type);

    </script>
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
<?php 
$site_settings=$this->site_model->settings();
?> 
<!-- search-wrap-start -->
    <div class="search-wrap">
        <div class="search-inner">
            <i id="search-close"  class="fal fa-times search-close open"></i>
            <div class="search-cell">
                <form action="#">
                    <div class="search-field-holder">
                        <input class="main-search-input" type="search" placeholder="Search Your Keyword...">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- search-wrap-end -->

        <main>
            <!-- slider-area_3-start -->
            <div class="slider-area_4 slider__overlay-3 position-relative" data-background="<?php echo base_url(); ?>/assets/site8/img/slider/slider-4.jpg" style="height: 400px;">
                <div class="container">
                    <div class="flider-3">
                        <h2>KALADY SRI ADI SHANKARA <br> MADAM TELANGANA </h2><br>
                    <h4>Sri.Sri. Jagadguru Adi Shankaracharya MahaSamsthanam</h4>
                        <div class="flider__btn mt-40">
                            <div class="flider-bnt1 mr-20 mb-20"><a class="s-btn" href="<?php echo base_url(); ?>index.php/worldline/booking">Online Booking</a></div>
                            <!-- <div class="filder-btn2"><a class="btn-border-2" href="causes.html">Get Member ship</a></div> -->
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>
            <!-- slider-area_3-end -->

            <!-- preacing-area-start -->
            <div class="news-sidebar-area pt-120 pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                            
                                <div class="single-news mb-50">
                                    <div class="news-thumb">
                                       <a href="#"><img src="<?php echo base_url(); ?>/assets/site8/img/madom.jpg" alt="blog" class="img-fluid"></a>
                                    </div>
                                    <div class="news-detalis-content">
                                     
                                       <h4 class="news-title mt-20 mb-20">
                                          <h3> KALADY SRI ADI SHANKARA MADAM TELANGANA .</h3>
                                       </h4>
                                       <p>Welcome to Adi sankara Madom, a sacred haven devoted to the propagation of spiritual enlightenment and the preservation of the rich cultural heritage embodied by Sri Adi Shankaracharya. Rooted in the profound teachings of this revered philosopher and spiritual luminary, Adi sankara Madom, is a religious organization committed to serving and uplifting communities through various facets of Vedic traditions</p>
                                       <div class="read-button mt-30">
                                          <a href="<?php echo base_url(); ?>index.php/welcome/aboutus2" class="sb-btn">Read More</a>
                                       </div>    
                                    </div>
                                </div>
                             
                            </div>
                     
                        </div>

                        <style>
                            .slider {
                                width: 100%;
                                overflow: hidden;
                            }

                            .slide {
                                display: none;
                            }

                            .slide img {
                                width: 100%;
                            }

                            .active {
                                display: block;
                            }

                        </style>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var slides = document.querySelectorAll('.slide');
                                var currentSlide = 0;
                                var slideInterval = setInterval(nextSlide, 2000); // Change slide every 2 seconds

                                function nextSlide() {
                                    slides[currentSlide].classList.remove('active');
                                    currentSlide = (currentSlide + 1) % slides.length;
                                    slides[currentSlide].classList.add('active');
                                }
                            });
                        </script>
                    	
                        <div class="col-xl-6 col-lg-6 col-md-6">
                        	<?php if($events): ?>
                            <div class="slider">
                         		<?php
                            	
                      				foreach ($events as $value) {
                        			$originalDate = $value['created'];
                        			$newDate = date("d-m-Y", strtotime($originalDate));
                        			$id=$value['id'];
                      			?>
                             	<div class="slide"> 
<!--                                 Default image size : style="height: 386px;"	 -->
                                    <img src="../../uploads/events/<?PHP echo $value['image']; ?>" alt=""  onClick="location='<?php echo base_url();?>index.php/welcome/eventFestival'" style="cursor: pointer;" >
                                </div>
                            <?php
                        } 
                        ?>
                                
                            </div>
                            <div class="fnservices__content"  >
                               
                                <h3><?php print_r($events[0]['title']);?></h3>
                                <p><?php print_r($events[0]['description']);?></p>
                                <h6><a href="<?php echo base_url(); ?>index.php/welcome/eventFestival" class="sb-btn"> View All</a></h6>
                            </div>
                        	<?php else: ?>
                        	<div class="text-center mt-5 pt-5 border-1 h-100">
                            	<h4> Events details will be updated soon! </h4>
                        	</div>
                        	<?php endif; ?>
                        </div>
                        <div class="col-lg-4">

                      
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- preacing-area-end -->

            <!-- causes-area-start -->
            <div class="causes-area grey-bg pt-120 pb-120">
                <div class="container">
                    <div class="section-title text-center mb-60">
                        <h6>ADI SHANKARA MADAM</h6>
                        <h2>Seva's</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="causes-single mb-30">
                                <div class="causes mb-15">
                                    <div class="causes-image w-img mb-25">
                                        <a href="<?php echo base_url(); ?>index.php/welcome/mandapam"><img src="<?php echo base_url(); ?>/assets/site8/img/team/pithru_mandapam.jpg" alt=""></a>
                                    </div>
                                    <div class="causes-content">
                                        <h5><a href="<?php echo base_url(); ?>index.php/welcome/mandapam"> Japa Mandapam</a></h5>
                                		<p>
    										<?php
    											$content = "Kalady Sri Adi Shankara Madom Telangana established an exclusive group Japa Mandapam. This innovative initiative serves as a beacon of spiritual enlightenment, offering a platform for individuals to delve into the timeless wisdom of Vedic teachings and philosophy from the comfort of their homes";
    											$limited_content = implode(' ', array_slice(explode(' ', strip_tags($content)), 0, 21));
    											echo $limited_content . "...";
    										?>
    										<h6><a href="<?php echo base_url(); ?>index.php/welcome/mandapam"> Read More</a></h6>
										</p>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="causes-single mb-30">
                                <div class="causes mb-15">
                                    <div class="causes-image w-img mb-25">
                                        <a href="<?php echo base_url(); ?>index.php/welcome/mandapam2"><img src="<?php echo base_url(); ?>/assets/site8/img/team/pooja_mandapam2.jpg" alt=""></a>
                                    </div>
                                    <div class="causes-content">
                                        <h5><a href="<?php echo base_url(); ?>index.php/welcome/mandapam2"> Pooja Mandapam</a></h5>
                                    	<p>
    										<?php
    											$content = "In the Pooja Mandapam, is dedicated to serving the Religious needs of devotees in three distinct ways, offering a comprehensive approach to religious activities.";
    											$limited_content = implode(' ', array_slice(explode(' ', strip_tags($content)), 0, 24));
    											echo $limited_content . "";
    										?>
    										<h6><a href="<?php echo base_url(); ?>index.php/welcome/mandapam2"> Read More</a></h6>
										</p>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="causes-single mb-30">
                                <div class="causes mb-15">
                                    <div class="causes-image w-img mb-25">
                                        <a href="<?php echo base_url(); ?>index.php/welcome/mandapam3"><img src="<?php echo base_url(); ?>/assets/site8/img/team/karma_mandapam.jpg" alt=""></a>
                                    </div>
                                    <div class="causes-content">
                                        <h5><a href="<?php echo base_url(); ?>index.php/welcome/mandapam3">Karma Mandapam </a></h5>
                                    	<p>
    										<?php
    											$content = "Embedded within the fabric of our existence are the rituals that shape our journey. The Karma Mandapam provides a platform for the performance of Shodasha Karma rituals,like Upanayanam, marriage etc. Beyond the celebrations of life's milestones - individuals can engage in acts of purification, offering homage to their ancestors and seeking divine grace to navigate life’s myriad pathways.";
    											$limited_content = implode(' ', array_slice(explode(' ', strip_tags($content)), 0, 24));
    											echo $limited_content . "...";
    										?>
    										<h6><a href="<?php echo base_url(); ?>index.php/welcome/mandapam3"> Read More</a></h6>
										</p>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="causes-single mb-30">
                                <div class="causes mb-15">
                                    <div class="causes-image w-img mb-25">
                                        <a href="<?php echo base_url(); ?>index.php/welcome/mandapam4"><img src="<?php echo base_url(); ?>/assets/site8/img/events/sm-eve4.jpg  " alt=""></a>
                                    </div>
                                    <div class="causes-content">
                                        <h5><a href="<?php echo base_url(); ?>index.php/welcome/mandapam4"> Krupa Mandapam</a></h5>
                                    	<p>
    										<?php
    											$content = "Kalady Sri Adi Shankara Madom Telangana proudly presents the Krupa Mandapam - a beacon of hope and transformation dedicated to extending charity services to society. Anchored in the ethos of selfless giving and inspired by the noble teachings of Sri Adi Shankaracharya.We have embarked on a journey of upliftment and empowerment by adopting Shankara Gramam - a village where our commitment to holistic development knows no bounds.";
    											$limited_content = implode(' ', array_slice(explode(' ', strip_tags($content)), 0, 21));
    											echo $limited_content . "...";
    										?>
    										<h6><a href="<?php echo base_url(); ?>index.php/welcome/mandapam4"> Read More</a></h6>
										</p>
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- causes-area-end -->
    <div class="clearfix"></div>
    <div  class="atd" id=""  >
      <audio autoplay id='tempAudio' src='<?php echo base_url(); ?>/assets/site8/uploads/music/<?php echo $site_settings['opening_song']; ?>' preload='auto'> </audio>
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



        </main>


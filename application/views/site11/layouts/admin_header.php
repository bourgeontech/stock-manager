<!doctype html>
<html class="no-js" lang="zxx">

<?php 
$temple_list=$this->general_model->gettemples();
$getcontact=$this->site_model->getcontact();
$site_settings=$this->site_model->settings();
$bgimage=$site_settings['bgimage'];
?>
    
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Adi Shankara Madam</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.html">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/site8/img/favicon.png">
        <!-- Place favicon.png in the root directory -->

		<!-- CSS here -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site8/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site8/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site8/css/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site8/css/magnific-popup.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site8/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site8/css/themify-icons.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site8/css/backtotop.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site8/css/preloader.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site8/css/meanmenu.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site8/css/slick.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/site8/css/main.css">
    </head>
    <body>

    <!-- back-to-top-start -->
    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 273.713px;"></path>
        </svg>
    </div>
    <!-- back-to-top-end -->

    <!-- preloader start -->
    <div id="preloader">
            <div class="preloader">
                <span></span>
                <span></span>
            </div>
    </div>
    <!-- preloader end -->
    
    <!-- sidebar area start -->
    <div class="sidebar__area">
        <div class="sidebar__wrapper">
           <div class="sidebar__close">
              <button class="sidebar__close-btn" id="sidebar__close-btn">
                 <i class="fal fa-times"></i>
              </button>
           </div>
           <div class="sidebar__content">
              <div class="sidebar__logo mb-40">
                 <a href="#">
                 <img src="<?php echo base_url(); ?>/assets/site8/img/logo/logo.png" alt="logo">
                 </a>
              </div>
<!--               <div class="sidebar__search mb-25">
                 <form action="#">
                    <input type="text" placeholder="What are you searching for?">
                    <button type="submit" ><i class="far fa-search"></i></button>
                 </form>
              </div> -->
              <div class="mobile-menu fix"></div>
              <div class="sidebar__contact mt-30 mb-20">
                 <h4>Contact Info</h4>
                 <ul>
                    <li class="d-flex align-items-center">
                       <div class="sidebar__contact-icon mr-15">
                          <i class="fal fa-map-marker-alt"></i>
                       </div>
                       <div class="sidebar__contact-text">
                          <a target="_blank" href="https://www.google.com/maps/place/Dhaka/@23.7806207,90.3492859,12z/data=!3m1!4b1!4m5!3m4!1s0x3755b8b087026b81:0x8fa563bbdd5904c2!8m2!3d23.8104753!4d90.4119873">
                          Sri. Sri. Jagadguru Adi Shankaracharya MahaSamsthanam P NO 23- Phase 3, Venkusa Estates, Kowkur Village,,Bolarum, Secunderabad,Telangana 500010
                       	  </a>
                       </div>
                    </li>
                    <li class="d-flex align-items-center">
                       <div class="sidebar__contact-icon mr-15">
                          <i class="far fa-phone"></i>
                       </div>
                       <div class="sidebar__contact-text">
                          <a href="tel:+918350903080">+91 8350903080</a>
                       </div>
                    </li>
                    <li class="d-flex align-items-center">
                       <div class="sidebar__contact-icon mr-15">
                          <i class="fal fa-envelope"></i>
                       </div>
                       <div class="sidebar__contact-text">
                          <a href="mailto:kaladyshankaramadomts@gmail.com"><span class="__cf_email__">kaladyshankaramadomts@gmail.com</span></a>
                       </div>
                    </li>
                 </ul>
              </div>
              <div class="sidebar__social">
                 <ul>
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                 </ul>
              </div>
           </div>
        </div>
    </div>
    <!-- sidebar area end -->

    <div class="body-overlay"></div>
    <!-- sidebar area end -->

    <!-- header start  -->
    <header>
       
        <div class="menu-area menu-area-4 menu-area-padding header-sticky">
            <div class="container">
                <div class="menu-bg-4 white-bg">
                    <div class="row align-items-center">
                        <div class="col-xl-1 col-lg-2 col-md-4 col-6">
                            <div class="logo" style="width: 300px;">
                                <a href="<?php echo base_url(); ?>index.php/welcome/"><img src="<?php echo base_url(); ?>/assets/site8/img/logo/logo.png" alt="" style="width: 190px;"> </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-12 col-md-8 col-6">
                            <div class="side-menu-icon d-lg-none text-end">
                                <a href="javascript:void(0)" class="info-toggle-btn f-right sidebar-toggle-btn"><i class="fal fa-bars"></i></a>
                            </div>
                            <!-- <div class="header-btn f-right">
                                <a class="s-btn" href="contact.html">donate now</a>
                            </div> -->
                            <div class="main-menu f-right">
                                <nav id="mobile-menu">
                                    <ul>
                                        <!-- <li><a href="#" class="active">Home</a>
                                          
                                        </li> -->
                                        <li><a href="#" >About</a>
                                            <ul class="sub-menu">
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/aboutUs">Sri. Sri. Jagadguru Adi Shankaracharya Swamiji</a></li>
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/aboutus2"> Kalady Sri. Adi Shankara Madom Telangana</a></li>
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/aboutus3"> Madathipathi</a></li>
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/aboutus4">  Adi Sankara International Foundation Kalady</a></li>
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/aboutus5">  Pranavam- Hyderabad</a></li>
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/cources">Courses</a></li>
                                            </ul>
                                        </li>
                                        <!-- <li><a href="about.html">About us</a></li> -->
                                        <li><a href="#">Sevas/Ritual</a>
                                            <ul class="sub-menu">
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/mandapam">Japa Mandapam</a></li>
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/mandapam2"> Pooja Mandapam</a></li>
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/mandapam3"> Karma Mandapam</a></li>
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/mandapam4"> Krupa Mandapam</a></li>
                                            	<li><a href="<?php echo base_url(); ?>index.php/welcome/nakshathravanam"> Nakshathra Vanam </a></li>
                                            	<li><a href="<?php echo base_url(); ?>index.php/welcome/gowpooja"> Go seva </a></li>
                                                
                                            </ul>
                                        </li>
                                       
                                        <li><a href="#">News/Events</a>
                                            <ul class="sub-menu">
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/news">News</a></li>
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/eventFestival">Upcoming Events</a></li>
                                                <li><a href="#"> Others</a></li>
                                              
                                            </ul>
                                        </li>

                                        
                                        <li><a href="#"> Gallery</a>
                                            <ul class="sub-menu">
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/gallery">Photos</a></li>
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/video">Video</a></li>
                                                
                                            </ul>
                                        </li>
                                        <!-- <li><a href="#"> Dontaion</a>
                                            
                                        </li> -->
                                        <li><a href="#"> Membership</a>
                                            <ul class="sub-menu">
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/member"> Membership</a></li>
                                                <li><a href="<?php echo base_url(); ?>index.php/welcome/sevadal"> Seva Dal</a></li>
                                                
                                            </ul>
                                        </li>
                                        <li><a href="<?php echo base_url(); ?>index.php/welcome/contact"> Contact Us</a>
                                            </li>

                                    </ul>

                                </nav>
                            </div>
                        </div>
                    <?php  if($site_settings['online']=='1'){?>  
                        <div class="col-xl-1 col-lg-2 col-md-4 col-6 d-flex flex-row">
                           <div class="logo" >
                                <a class="s-btn" href="<?php echo base_url(); ?>index.php/worldline/booking">Online Booking</a>
                           	
                            </div>
                        </div>
                    <?php } ?>
                    	
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end  -->
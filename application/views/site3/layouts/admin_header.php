<!DOCTYPE html>
<html lang="en">
    

    
<?php 
$temple_list=$this->general_model->gettemples();
$getcontact=$this->site_model->getcontact();
$site_settings=$this->site_model->settings();
$bgimage=$site_settings['bgimage'];
?>
<style>
	body {
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
	position: relative;
    overflow-x: hidden;
    background: <?php echo $site_settings['menucolor'],99; ?>;

}
.siteclr {     background: <?php echo $site_settings['menucolor'],99; ?>;
}
    body::after {
    content: "";
    background: #ffffc6 url("<?php echo $bgimage ?>");
    background-size: cover;
    background-repeat: no-repeat;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 700px;
    z-index: 0;
}
.about_bg_none {
    background: <?php echo $site_settings['menucolor'],99; ?>;
}
.home_right_block{ background: <?php echo $site_settings['menucolor'],99; ?>; padding:2px;float: left;
    width: 100%;}
.home_main_block { border: 10px solid #FBCB66; background-color: #fff; padding: 20px; float: left; width: 100%;  }
div.alignmenu {
  text-align: center;
}

ul.myUL {
  display: inline-block;
  text-align: left;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script>
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev',
        center: 'title',
        right: 'next'
        
      },
      defaultView: 'month',
      events: [
        // Sample event data
        {
          title: 'Event 1',
          start: '2023-07-15',
          end: '2023-07-16',
          description: 'Event 2 details'
        },
        {
          title: 'Event 2',
          start: '2023-07-20T10:30:00',
          end: '2023-07-20T12:30:00',
          description: 'Event 2 details'
        }
        // Add more events as needed
      ],
      eventClick: function(event) {
        Swal.fire({
            title: event.title,
            text: event.description,
          });
      }
    });
  });
</script>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <title><?php print_r($temple_list[0]['name']);?></title>
    <link rel="icon" href="<?php echo base_url(); ?>/assets/site3/images/fav_icon.png" type="images/png" sizes="35x35" />

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site3/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site3/css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site3/css/menu_styles.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site3/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site3/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site3/font-awesome-4.6.3/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site3/css/jquery-ui.css" />
  </head>
  <body class="home-v5">
      <main class="main"> 
        <!-- header -->
        <header class="">
          <div class="container">
            <div class="ct_header">
              <div class="row">
                <div class="col-lg-4">
                    <h1>
                        <a class="logo" style="font-size:18px;font-weight:bold;text-transform:uppercase;"><?php print $site_settings['templename_mal']; ?><br><?php print $site_settings['templename_eng']; ?></a></h5>
                    </h1>
                </div>
                <div class="col-lg-4">
                    <div class="info">
                    <div class='contact_info'>
                        <div class=" h6"><i class='fa fa-phone-square'></i>&nbsp;&nbsp;<?php echo $getcontact[0]['land_ph']; ?><?php if($getcontact[0]['land_ph'] == '') echo ', '; echo ', ' ?><?php echo $getcontact[0]['mob_ph'];?> </div>
                        <div class=" h6"><i class='fa fa-envelope'></i>&nbsp;&nbsp;<?php print_r($getcontact[0]['email']);?></div>
                    </div>
                  </div>
                </div>
            <?php  
                if($site_settings['online']=='1'){?>
                    <div class="col-lg-4">
            			<div class="d-flex flex-row">
                			<div class="outlined-clickandcollect">  <a href="<?php echo base_url(); ?>index.php/worldline/booking" class="btn_booking">ONLINE BOOKING</a> </div>
                			<div class="outlined-clickandcollect">  <a href="<?php echo base_url(); ?>index.php/worldline/donation" class="btn_booking">ONLINE DONATION</a> </div>
                			<div class="outlined-clickandcollect">  <a href="<?php echo base_url(); ?>index.php/donation/booking" class="btn_booking">E-KANIKKA</a> </div>
            			</div>
        			</div>
                </div>
            </div>
            <?php } ?>
              </div>
            </div>
          </div>
          <div class="menu_part">
            <div class="container">
              <div class="menu_block menubox" style="background: <?php echo $site_settings['menucolor']; ?>;">
                <div id="cssmenu" class="alignmenu">
                  <ul class="myUL" >
                    <li><a href="<?php echo base_url(); ?>index.php/welcome/"><span>home</span></a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/welcome/aboutUs"><span>History</span></a> </li>
                    <li><a href="<?php echo base_url(); ?>index.php/welcome/dietys"><span>DEITIES</span></a> </li>
                    <li><a href="<?php echo base_url(); ?>index.php/welcome/templeTiming"><span>Timing</span></a> </li>
                    <li><a href="<?php echo base_url(); ?>index.php/welcome/trusteeboard"><span>Administration</span></a> </li>
                    <li><a href="<?php echo base_url(); ?>index.php/welcome/eventFestival"><span>Festivals</span></a> </li>
                    <li><a href="<?php echo base_url(); ?>index.php/welcome/announcements"><span>Events</span></a></li>
                    <li><a href="<?php echo base_url(); ?>index.php/welcome/gallery"><span>Gallery</span></a></li>
                    <li ><a href="<?php echo base_url(); ?>index.php/welcome/contact"><span>Contact</span></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </header>
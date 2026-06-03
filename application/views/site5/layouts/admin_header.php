<!doctype html>
    
<?php 
$temple_list=$this->general_model->gettemples();
$getcontact=$this->site_model->getcontact();
$site_settings=$this->site_model->settings();
$bgimage=$site_settings['bgimage'];
?>
<html lang="en">
<style>
    .phone-link {
        color: #ffffff;
        text-decoration: none;
    }

    .phone-link:hover {
        color: #d9d9d9; 
    }
</style>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/singlepage/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/singlepage/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/singlepage/css/owl.theme.default.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/singlepage/css/style.css">

	<title><?php print_r($temple_list[0]['name']);?></title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">


    <!-- TOP NAV -->
    <div class="top-nav" id="home">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <p> <i class='bx bxs-envelope'></i> <?php print_r($getcontact[0]['email']);?></p>
					<p>
    					<i class='bx bxs-phone-call'></i>
    					<a class="phone-link" href="tel:<?php echo $getcontact[0]['land_ph']; ?>">
        					<?php echo $getcontact[0]['land_ph']; ?>
    					</a>,
    					<a class="phone-link" href="tel:<?php echo $getcontact[0]['mob_ph']; ?>">
        					<?php echo $getcontact[0]['mob_ph']; ?>,
    					</a>
                    	<a class="phone-link" href="tel:+91 8940421814">
        					 +91 8940421814
    					</a>
					</p>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#"><?php print_r($temple_list[0]['name']);?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>index.php/welcome/#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>index.php/welcome/#about">Temple</a>
                    </li>
<!--                     <li class="nav-item">
                        <a class="nav-link" href="#services">Pooja</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>index.php/welcome/#portfolio">Festivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>index.php/welcome/#team">Management</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>index.php/welcome/#diety">Dieties</a>
                    </li>
                </ul>
                <?php  
                if($site_settings['online']=='1'){?>
    				<a href="<?php echo base_url(); ?>index.php/worldline/booking" class="btn_booking" style="text-decoration: none; color: white;">
                    	<button class="btn btn-danger">
                 			Online Booking
                        </button>
                    </a>
                <?php } ?>
            		<a href="<?php echo base_url(); ?>index.php/welcome/room_booking" class="btn_booking " style="padding: 10px;text-decoration: none; color: white;">
                    	<button class="btn btn-danger">
                 			Room Booking
                        </button>
                    </a>
            <br>
            		<a href="<?php echo base_url(); ?>index.php/welcome/donatenow" class="btn_booking" style="text-decoration: none; color: white;">
                    	<button class="btn btn-danger">
                 			Donation
                        </button>
                    </a>
            </div>
        </div>
    </nav>
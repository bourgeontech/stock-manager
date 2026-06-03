<!doctype html>
    
<?php 
$temple_list=$this->general_model->gettemples();
$getcontact=$this->site_model->getcontact();
$site_settings=$this->site_model->settings();
$bgimage=$site_settings['bgimage'];
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/parakkunnath/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/parakkunnath/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/parakkunnath/css/owl.theme.default.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/parakkunnath/css/style.css">

    <title>Parakkunnath Temple </title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">


    <!-- TOP NAV -->
    <div class="top-nav" id="home">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <p> <i class='bx bxs-envelope'></i> parakkunnathutemple@gmail.com</p>
                    <p> <i class='bx bxs-phone-call'></i> (0494) 260 7552</p>
                </div>
                <div class="col-auto social-icons">
                    <a href="https://www.facebook.com/pages/category/Religious-organization/Chellur-Sri-Parakkunnath-Bagavathi-Kshethram-103348661283671/"><i class='bx bxl-facebook'></i></a>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Parakkunnath Temple <span class="dot">.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Temple</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Pooja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Festivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">Deities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Contact Us</a>
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
            </div>
        </div>
    </nav>
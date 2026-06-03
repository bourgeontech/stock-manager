<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/new_site/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/new_site/font-awesome-4.6.3/css/font-awesome.css" />
    <style>
        body {
            text-align: center; 
            font-family: Arial, sans-serif;
        	background-color: #6c1e06 ;
        	color: #C2C2C2;
        	max-width:100vw;
        	overflow:hidden;
        }
        h1 {
            margin-top: 50px; 
        	color: #C2C2C2;
        }
        p {
            margin-bottom: 10px; 
        }
        nav {
            background-color: #eb7a34; 
            padding: 10px 0; 
        }
        nav a {
            color: white;
            text-decoration: none; 
            padding: 10px 20px; 
        }
        nav a:hover {
            background-color: #A45524; 
        }
        .active {
            background-color: #F3AF85; 
        }
        .card {
            background-color: #fff;
            color: #000;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 20px auto;
        }
        .card p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <nav>
    	<a href="<?php echo base_url(); ?>index.php/"> <i class="fa fa-home"></i> </a>
    	<a href="<?php echo base_url(); ?>index.php/customer/account" class="active">Dasboard</a>
    	<a href="<?php echo base_url(); ?>index.php/customer/bookings">My Bookings</a>
    	<?php if ($membership): ?>
        <a href="<?php echo base_url(); ?>index.php/membership/membership_details">Membership Details</a>
        <a href="<?php echo base_url(); ?>index.php/membership/swaswatha_pooja">Shaswatha Pooja Date</a>
    	<a href="<?php echo base_url(); ?>index.php/membership/membership_print" target="_blank">Download Membership Certificate</a>
        <a href="<?php echo base_url(); ?>index.php/membership/referFriend">Refer a Friend</a>
        <a href="<?php echo base_url(); ?>index.php/membership/referByMe">Refered by Me</a>
    	<?php endif; ?>
    	<a href="<?php echo base_url(); ?>index.php/customer/profile">Profile</a>
        <a href="<?php echo base_url(); ?>index.php/customer/logout">Logout</a>
    </nav>
    
	<div class="row mt-5">
    	<div class="col-md-12 pt-5 mt-5 ">
        	<img width="300" src="<?php echo base_url(); ?>/assets/site8/img/logo/logo_white.png" alt="logo" class="mt-4">
    		<h1 id="membership-details" class="mt-4 text-white">Welcome, <?php echo $customer->name; ?>.</h1>
        	<h6 class="text-white"> KALADY SRI ADI SHANKARAMADOM-TELANGANA </h6> 
		</div>
	</div>
<!--     <?php if ($membership): ?>
        <div class="card">
            <p><strong>Membership ID:</strong> <?php echo $membership->membership_id; ?></p>
            <p><strong>Name:</strong> <?php echo $membership->name; ?></p>
            <p><strong>Mobile Number:</strong> <?php echo $membership->mobile_number; ?></p>
        </div>
    <?php else: ?>
        <p>No membership found for the provided mobile number and membership ID.</p>
    <?php endif; ?> -->
</body>
</html>

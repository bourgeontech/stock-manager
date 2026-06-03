<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
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
    	<a href="<?php echo base_url(); ?>index.php/customer/account">Dasboard</a>
    	<a href="<?php echo base_url(); ?>index.php/customer/bookings">My Bookings</a>
    	<?php if ($membership): ?>
        <a href="<?php echo base_url(); ?>index.php/membership/membership_details">Membership Details</a>
        <a href="<?php echo base_url(); ?>index.php/membership/swaswatha_pooja">Shaswatha Pooja Date</a>
    	<a href="<?php echo base_url(); ?>index.php/membership/membership_print" target="_blank">Download Membership Certificate</a>
        <a href="<?php echo base_url(); ?>index.php/membership/referFriend">Refer a Friend</a>
        <a href="<?php echo base_url(); ?>index.php/membership/referByMe">Refered by Me</a>
    	<?php endif; ?>
    	<a href="<?php echo base_url(); ?>index.php/customer/profile" class="active">Profile</a>
        <a href="<?php echo base_url(); ?>index.php/customer/logout">Logout</a>
    </nav>
    
	<div class="row mt-5">
    	<div class="col-md-12 mt-5 justify-content-center">
        	
    		<h1 id="membership-details" class="mt-4 text-white">Profile</h1>
        	
        
        	<div class="row justify-content-center">
            	<div class="col-md-8 row justify-content-center">
            		<div class="col-md-4">
            			<div class="card w-100 h-100">
                        	<div style="height:80px; width:80px; border: 1px solid #444; border-radius: 50%; margin:0 auto"> <i class="fa fa-user" style="font-size:4.7em;color:#444"></i> </div>
                        	<div class="mt-3"> 
                            	<h4> <b> <?php echo ucfirst($customer->name); ?> </b> </h4>
                            	<h6> <i class="fa fa-phone"> </i> <?php echo ucfirst($customer->mobile); ?> </h6>
                            	<h6> <i class="fa fa-envelope"> </i> <?php echo $customer->email ?? 'NIL'; ?> </h6>
                            	<h6> <i class="fa fa-book" aria-hidden="true"> </i> <?php echo $customer->house." ".$customer->post." ".$customer->street." ".$customer->district." ".$customer->state." ".$customer->pincode ?? 'NIL'; ?> </h6>
                        	</div>
                        	<a class="btn btn-outline-primary mt-2" href="<?php echo base_url(); ?>index.php/customer/profile_edit/<?php echo $customer->id; ?>"> Edit </a>
        				</div>
        			</div>
                	<div class="col-md-8">
            			<div class="card w-100 h-100 pt-5" >
            				<h4> <b> Membership Details </b> </h4>
                        	<div class="mt-3 h-100" >
                        	<?php if ($membership): ?>
                            	<h6><b> Membership ID: </b> <?php echo $membership->membership_id; ?></h6>
                            	<h6><b> Member From: </b>  <?php echo date('d M Y', strtotime($membership->created_at)); ?></h6>
                            	<h6><b> Referred By: </b>  <?php echo $membership->referred_by; ?> ( <?php echo $membership->referral_code; ?> )</h6>
                        	<?php else: ?>
                        		<h6> You're not a member. <a href="<?php echo base_url(); ?>index.php/membership">Be a member</a> </h6>
                        	<?php endif; ?>
                        	</div>
        				</div>
        			</div>
        		</div>
        	</div>
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

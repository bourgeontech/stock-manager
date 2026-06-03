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
    	.content {
    		overflow:scroll;
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
    
	<div class="row mt-5 content">
    	<div class="col-md-12 justify-content-center">
        	
    		<h1 id="membership-details" class="mt-4 text-white">Edit Profile</h1>
        	
        
        	<div class="row justify-content-center">
            	<div class="col-md-7">
                	<div class="card w-100 h-100 mb-5">
                    	<form action="<?php echo base_url(); ?>index.php/customer/profile_edit/<?php echo $customer->id; ?>" method="post">
                        <div class="mt-3 row"> 
                        	<div class="col-md-6 text-left mb-2">
                            	<label>Name</label>
            					<input type="text" name="name" value="<?php echo $customer->name; ?>" class="form-control" />
        					</div>
                        	<div class="col-md-6 text-left mb-2">
                            	<label>Mobile Number</label>
            					<input type="text" name="mobile" value="<?php echo $customer->mobile; ?>" class="form-control" />
        					</div>
                        	<div class="col-md-6 text-left mb-2">
                            	<label>Email</label>
            					<input type="text" name="email" value="<?php echo $customer->email; ?>" class="form-control" />
        					</div>
                        	<div class="col-md-6 text-left mb-2">
                            	<label>House</label>
            					<input type="text" name="house" value="<?php echo $customer->house; ?>" class="form-control" />
        					</div>
                        	<div class="col-md-6 text-left mb-2">
                            	<label>Post</label>
            					<input type="text" name="post" value="<?php echo $customer->post; ?>" class="form-control" />
        					</div>
                        	<div class="col-md-6 text-left mb-2">
                            	<label>Street</label>
            					<input type="text" name="street" value="<?php echo $customer->street; ?>" class="form-control" />
        					</div>
                        	<div class="col-md-6 text-left mb-2">
                            	<label>District</label>
            					<input type="text" name="district" value="<?php echo $customer->district; ?>" class="form-control" />
        					</div>
                        	<div class="col-md-6 text-left mb-2">
                            	<label>State</label>
            					<input type="text" name="state" value="<?php echo $customer->state; ?>" class="form-control" />
        					</div>
                        	<div class="col-md-6 text-left mb-2">
                            	<label>Pincode</label>
            					<input type="text" name="pincode" value="<?php echo $customer->pincode; ?>" class="form-control" />
        					</div>
                        </div>
                        <button class="btn btn-success mt-2 w-25 mx-auto"> Update </button>
                    	</form>
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

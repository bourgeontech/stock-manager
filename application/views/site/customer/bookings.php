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
        .main_row {
        	height:100vh;
        	overflow-y:scroll !important;
    	}
    </style>
</head>
<body>
    <nav>
    	<a href="<?php echo base_url(); ?>index.php/"> <i class="fa fa-home"></i> </a>
    	<a href="<?php echo base_url(); ?>index.php/customer/account">Dasboard</a>
    	<a href="<?php echo base_url(); ?>index.php/customer/bookings" class="active">My Bookings</a>
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
    
	<div class="row main_row mb-5">
    	<div class="col-md-12 p-5">
        	
    		<h1 id="membership-details">My Bookings</h1>
        	<?php if ($bookings): ?>
        	<div class="card w-100 mb-5">
            
        <table class="table border ">
            <thead>
                <tr>
                	<th>#</th>
                    <th>Pooja Name</th>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $key => $booking): ?>
                    <tr>
                    	<td><?php echo $key+1; ?></td>
                        <td><?php echo $booking->pooja_name; ?></td>
                        <td><?php echo date('d M Y', strtotime($booking->date)); ?></td>
                        <td><?php echo $booking->amount; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php else: ?>
        <p>No bookings found for you.</p>
    <?php endif; ?>
		</div>
	</div>
</body>
</html>

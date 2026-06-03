<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referred Members</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/new_site/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/new_site/font-awesome-4.6.3/css/font-awesome.css" />
    <style>
        body {
            text-align: center; 
            font-family: Arial, sans-serif;
        	background-color: #6c1e06 ;
        }
        h1 {
            margin-top: 50px; 
        	color: #aaa;
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        	background-color: #fff;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <nav>
    	<a href="<?php echo base_url(); ?>index.php/"> <i class="fa fa-home"></i> </a>
    	<a href="<?php echo base_url(); ?>index.php/customer/account">Dasboard</a>
    	<a href="<?php echo base_url(); ?>index.php/customer/bookings">My Bookings</a>
    	<?php if ($membership): ?>
        <a href="<?php echo base_url(); ?>index.php/membership/membership_details" >Membership Details</a>
        <a href="<?php echo base_url(); ?>index.php/membership/swaswatha_pooja">Shaswatha Pooja Date</a>
    	<a href="<?php echo base_url(); ?>index.php/membership/membership_print" target="_blank">Download Membership Certificate</a>
        <a href="<?php echo base_url(); ?>index.php/membership/referFriend">Refer a Friend</a>
        <a href="<?php echo base_url(); ?>index.php/membership/referByMe" class="active">Refered by Me</a>
    	<?php endif; ?>
    	<a href="<?php echo base_url(); ?>index.php/customer/profile">Profile</a>
        <a href="<?php echo base_url(); ?>index.php/customer/logout">Logout</a>
    </nav>
    <h1>Referred Members</h1>
    <?php if ($referredMembers): ?>
        <table>
            <thead>
                <tr>
                    <th>Membership ID</th>
                    <th>Name</th>
                    <th>Mobile Number</th>
                	<th>Membership Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($referredMembers as $referredMember): ?>
                    <tr>
                        <td><?php echo $referredMember->membership_id; ?></td>
                        <td><?php echo $referredMember->name; ?></td>
                        <td><?php echo $referredMember->mobile_number; ?></td>
                    	<td><?php echo date('d M Y', strtotime($referredMember->created_at)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-white">No members have been referred by you yet.</p>
    <?php endif; ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refer A Friend</title>
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
        .card {
            background-color: #fff;
            color: #000;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 20px auto;
        }
        .copy-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        .copy-button:hover {
            background-color: #0056b3;
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
        <a href="<?php echo base_url(); ?>index.php/membership/referFriend" class="active">Refer a Friend</a>
        <a href="<?php echo base_url(); ?>index.php/membership/referByMe">Refered by Me</a>
    	<?php endif; ?>
        <a href="<?php echo base_url(); ?>index.php/customer/logout">Logout</a>
    </nav>
    <h1 id="membership-details">Referral Details</h1>
    <?php if ($membership): ?>
        <div class="card">
            <p><strong>Referral ID:</strong> <?php echo $membership->membership_id; ?></p>
            <button class="copy-button" onclick="copyReferralCode()">Copy</button>
        </div>
    <?php else: ?>
        <p>No membership found for the provided mobile number and membership ID. Please Login Again</p>
    <?php endif; ?>

    <script>
        function copyReferralCode() {
            const referralCode = "<?php echo $membership->membership_id; ?>";
            navigator.clipboard.writeText(referralCode);
            const button = document.querySelector('.copy-button');
            button.textContent = 'Copied!';
            setTimeout(function() {
                button.textContent = 'Copy';
            }, 1000);
        }
    </script>
</body>
</html>

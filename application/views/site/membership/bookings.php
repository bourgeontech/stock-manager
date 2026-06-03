<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pooja Bookings</title>
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
        <a href="<?php echo base_url(); ?>index.php/membership/memberAccount">Membership Details</a>
        <a href="<?php echo base_url(); ?>index.php/membership/swaswatha_pooja">Shaswatha Pooja Date</a>
        <a href="<?php echo base_url(); ?>index.php/membership/bookings" class="active">My Bookings</a>
        <a href="<?php echo base_url(); ?>index.php/membership/membership_print" target="_blank">Download Membership Certificate</a>
        <a href="<?php echo base_url(); ?>index.php/membership/referFriend">Refer a Friend</a>
        <a href="<?php echo base_url(); ?>index.php/membership/referByMe">Refered by Me</a>
        <a href="<?php echo base_url(); ?>index.php/membership/memberLogout">Logout</a>
    </nav>
    <h1>My Pooja Bookings</h1>
    <?php if ($bookings): ?>
        <table>
            <thead>
                <tr>
                    <th>Pooja Name</th>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo $booking->pooja_name; ?></td>
                        <td><?php echo date('d M Y', strtotime($booking->date)); ?></td>
                        <td><?php echo $booking->amount; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No bookings found for you.</p>
    <?php endif; ?>
</body>
</html>

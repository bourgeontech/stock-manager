<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
    
    	@media print {
        	@page {
            	margin: 0 !important;
            	padding: 0 !important;
        	}
    	}
        body {
       
        	background-image: url(<?php echo $background_image;?>);
            background-position: center;
            background-repeat: no-repeat;
    		background-size: cover;
            width: 100%;
            height: 100%;
            font-size: 11px;
            text-align: center; 
            margin: 0 !important; 
            padding: 5px !important; 
            border: none; 
        }
    	h2 {
            color: #000;
            font-family: Arial, sans-serif; 
        	font-size:20px;
        }
    	h4.name {
            color: #453A66;
            font-family: Arial, sans-serif; 
        	margin-top: 210px;
        }
		h4.date {
            color: #453A66;
            font-family: Arial, sans-serif; 
        	margin-top: 28px;
        }
        #printer {
            padding: 1px; 
            margin-left: auto; 
            margin-right: auto; 
        }

        #printer h1, #printer h3, #printer p, #printer h4, #printer h5 {
            margin: 0; 
        }

        .left-section, .right-section {
            width: 45%; 
            vertical-align: top; 
            text-align: left; 
            padding: 0px 40px; 
        	color: #453A66;
        }
    </style>
</head>
<body>

	<h4 class="name">
    	<?php 
    	if (isset($membership_data['name'])) {
    	    echo htmlspecialchars(strtoupper($membership_data['name'])); 
    	} else {
    	    echo 'Name not available';
    	}
    	?>
    	(ID: <?php echo htmlspecialchars($membership_id); ?> )
	</h4>

	<h4 class="date">
    	<?php
    	if (isset($membership_data['created_at'])) {
        	try {
            	$date = new DateTime($membership_data['created_at']);
            	echo htmlspecialchars($date->format('d-m-Y')); 
        	} catch (Exception $e) {
            	echo 'Invalid date';
        	}
    	} else {
        	echo 'N/A'; 
    	}
    	?>
	</h4>




</body>
</html>

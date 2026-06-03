<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login</title>
    <style>
        body {
            background-color: #333;
            color: white;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .foam-padding {
            padding: 20px 20px;
        }
        .card {
            background-color: #eb7a3499;
            color: #000;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 0 auto;
        }
        .card label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }
        .card input[type="text"], 
        .card button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .card button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .card button:hover {
            background-color: #0056b3;
        }
    </style>
</form>
</head>
<body>
    <div class="foam-padding">
        <h4 class="m-4">Enter OTP</h4>
        <div class="card">
            <form action="<?php echo base_url(); ?>index.php/membership/verifyOtp" method="post">
                <label for="mobile_number">OTP:</label>
                <input type="text" name="otp" id="otp" placeholder="Enter OTP" value="" class="mb-0" required>
				<?php echo form_error('otp', '<div class="error">', '</div>'); ?>
            
            	
            	<br><br>
                <button type="submit" >Submit</button>
            </form>
        </div>
    </div>
	<?php if ($this->session->flashdata('otp')): ?>

		<script>
    	alert("<?php echo $this->session->flashdata('otp'); ?>")
		</script>
	<?php endif; ?>
	
</body>
</html>

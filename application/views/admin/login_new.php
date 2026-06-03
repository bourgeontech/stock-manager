<html>
<head>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style>
.button {
    padding: 10px 0;
    background: #fff;
    font-weight: bold;
    color: #000;
    margin-top: 28px;
    -webkit-box-shadow: 4px 4px 2px 0px rgb(0 0 0 / 22%);
    -moz-box-shadow: 4px 4px 2px 0px rgba(0,0,0,0.22);
    box-shadow: 4px 4px 2px 0px rgb(0 0 0 / 22%);
	display: block;
    width: 100%;
	text-align: center;
}
.body{
background-image: url("<?php echo base_url(); ?>/assets/images/login/bg2.png");
background-repeat: no-repeat;
background-size: 100%;
color: white;
}
.a1{
background-image: url("<?php echo base_url(); ?>/assets/images/login/bg1.png");
 border: solid thin white;
 padding: 10px;
}
 .input-ct {
    height: 45px;
    padding: 0 10px;
    width: 100%;
    background: #fff;
    border: transparent;
    color: #000;
    border: 1px solid #fff;
    margin: 2px;
    border-radius: 5px;
}
</style>
</head>
<body class="body">
<br><br><br><br><br><br>
<div class="a1" style="width:800px; margin:1 auto;">
<table border="0" width="800px" height="381.43px">
	<tr>
		<td><div>
			<br><br>
			<p>
			This Complete Temple Management Solution
			<br><br>
			Website<br>
			Online Pooja Booking<br>
			Counter Management</p>
			<br><br>
        	<?php if ($_SERVER['HTTP_HOST'] == "kadampuzha.templesoftware.in") { ?>
             		<table style="border-spacing: 10px;">
					<tr>
						<td colspan='2'><img src="<?php echo base_url(); ?>/assets/images/login/visiontech_logo.png" width="200px"></td>
					</tr>
					<tr>
						<td><i class="fas fa-phone-volume"></i></td>
						<td> +91 40 66388000<br /> +91 40 66388006<br>
						</td>
					</tr>
					<tr>
						<td><i class="fas fa-globe-americas"></i></td>
						<td> info@visiontek.co.in<br>
						 https://www.visiontek.co.in<br></td>
					</tr>
					<tr>
						<td><i class="fas fa-map-marker-alt"></i></td>
						<td>Linkwell Telesystems Pvt. Ltd. <br />
1-11-252/1B, Behind Shoppers' Stop <br />
Begumpet, Hyderabad - 500016 <br />
Telangana, India.</td>
					</tr>
				</table>
        	<?php } else { ?>
        			<table style="border-spacing: 10px;">
					<tr>
						<td colspan='2'><img src="<?php echo base_url(); ?>/assets/images/login/logo.png" width="200px"></td>
					</tr>
					<tr>
						<td><i class="fas fa-phone-volume"></i></td>
						<td> +91 98471 39 911<br>
						 +91 85476 52 906<br>
						</td>
					</tr>
					<tr>
						<td><i class="fas fa-globe-americas"></i></td>
						<td> info@bourgeoninnovations.com<br>
						 www.bourgeoninnovations.com<br></td>
					</tr>
					<tr>
						<td><i class="fas fa-map-marker-alt"></i></td>
						<td>Bourgeon Innovations Private Limited 2nd Floor,SDBI,UL Cyberpark SEZ,<br>
						Nellikode P.O.,Kozhikode,Kerala-673016</td>
					</tr>
				</table>
        	<?php } ?>
				</div>
		</td>
	<td><div>
			<table>
				<tr>
					<td><img src="<?php echo base_url(); ?>/assets/images/login/diya3.png" width="130px"></td>
					<td><h2>പുണ്യം<br>
					Punnyam</h2></td>
				</tr>
				<tr>
					<td colspan='2'>
					<form action="<?php echo base_url(); ?>index.php/auth/login" method="post" enctype="multipart/form-data">
						<div class="form-group has-feedback">
						<select name="counter_id" class="input-ct" style="color:black;">
                    <option value="">Select Counter</option>
                    <?php foreach($counter_list as $key => $c) { ?>
                    <option value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
                    <?php } ?>
                 </select>	 
                        <input  name="username" type="email" class="input-ct" placeholder="User Name"><br>
							 <input name="password" type="password" class="input-ct" placeholder="Password"><br>
							<button class="button">LOGIN</button>
						</div>
					</form>
					</td>
				</tr>
			</table>
	<br><br>
</div></td>
</tr>
</table>
</div>
</body>
</html>


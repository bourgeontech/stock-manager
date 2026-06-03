<!doctype html>
<html> 
<head>
<title>Bourgeon</title>
<link rel="icon" href="<?php echo base_url(); ?>/assets/admin/img/favicon.png" type="image/png" sizes="35x35">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin/css/sidebar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin/css/responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin/font-awesome-4.6.3/css/font-awesome.css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600" rel="stylesheet">

</head>
<body>
 
 <div>
  <!-- /.login-logo -->
  <div class="shop_brand_col"> <a class="shop_brand">e Commerce</a> </div>
  <div class="shop_login">
  <style>
  	::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    color: #fff;
    opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
    color: #fff;
}

::-ms-input-placeholder { /* Microsoft Edge */
    color: #fff;
}
  
  </style>
    <h1> LOGIN</h1>
	   <form action="<?php echo base_url(); ?>index.php/auth/login" method="post" enctype="multipart/form-data">
    <div class="login_box">
      <p class="login-box-msg"></p>
      <div class="form-group has-feedback">
      
        <input name="username" type="email" class="" placeholder="User Name">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span> </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span> </div>
     <!-- <span class="alert alert-success pull-left ">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Success Message 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>-->
      <!-- <span class="alert alert-warning">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-close"></i>&nbsp;&nbsp;&nbsp;Failed message 
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>-->
  <div class="clearfix"></div>
      <div >
       
        <!-- /.col -->
        <div class="col-xs-4">
         <button type="submit" class="btn btn_login btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </div>
	  </form>
  </div>
  <!-- /.login-box-body -->
</div>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin/js/jquery-3.2.1.min.js"></script>
<!--<script type="text/javascript" src="assets/js/jquery.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/js/sidebar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin/js/custom.js"></script>
</html>
<!doctype html>
<html>
<head>

<title> Temple Master</title>
<link rel="icon" href="<?php echo base_url(); ?>/assets/admin/img/fav_icon.png" type="image/png" sizes="35x35">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin/css/sidebar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin/css/responsive.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/admin/js/plugin/select2/css/select2.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin/font-awesome-4.6.3/css/font-awesome.css" />
<!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600" rel="stylesheet">-->
	

</head>
<body>
<div class="brand_section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6"> <a class="bran_logo" href="#"> <img src="<?php echo base_url(); ?>" height="40"/></a> </div>
      <div class="col-lg-6 col-md-6 col-sm-6"> <a href="#" class=""> </a> <a href="#" id="open-left" class=" icon-menu head_user  "> M </a>
        <div class="loged" style="display: none"> <img src="<?php echo base_url(); ?>/assets/admin/img/prof_img.gif" class="media media-object img-circle">
          <div> Hi, <b>Ajay Gosh</b> <br>
            Welcome to account </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="clearfix"></div>
<div class="container-fluid"> </div>
<div class="cp_col">
  <div class="side_left">
    <div class="clearfix"> </div>
    <div id="menu">
      <nav>
        <div id="acdnmenu" >
          <ul>
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard">Dashboard</a> </li>  
            <li>About Us&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
              <ul>
                <li><a href="<?php echo base_url();?>index.php/cms/addContent">Add Content</a></li>
                <li><a href="<?php echo base_url();?>index.php/cms/viewContent">View Content </a></li>
              </ul>
            </li> 
            <li>Gallery&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
              <ul>
                <li><a href="<?php echo base_url();?>index.php/cms/addGallery">Add Images</a></li>
                <li><a href="<?php echo base_url();?>index.php/cms/viewGallery">View Gallery </a></li>
              </ul>
            </li>   
            <li>Contact&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
              <ul>
              <li><a href="<?php echo base_url();?>index.php/cms/addContact">Add Contact</a></li>
                <!-- <li><a href="<?php echo base_url();?>index.php/admin/admin/viewContent">View Address </a></li> -->
              </ul>
            </li>         
            <li>Priest Management&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
              <ul>
                <li><a href="<?php echo base_url();?>index.php/cms/viewPriest">View</a></li>
                <li><a href="<?php echo base_url();?>index.php/cms/addPriest">Add New </a></li>
                
              </ul>
            </li>

            <li>Trustee Board&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
              <ul>
                <li><a href="<?php echo base_url();?>index.php/cms/viewTrustee">View</a></li>
                <li><a href="<?php echo base_url();?>index.php/cms/addTrustee">Add New </a></li>
                
              </ul>
            </li>
            <li>Festival Committee&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
              <ul>
                <li><a href="<?php echo base_url();?>index.php/cms/viewFestivalCommittee">View</a></li>
                <li><a href="<?php echo base_url();?>index.php/cms/addFestivalCommittee">Add New </a></li>
                
              </ul>
            </li>
            <li>Paripalana Samithi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
              <ul>
                <li><a href="<?php echo base_url();?>index.php/cms/viewParipalanaSamithi">View</a></li>
                <li><a href="<?php echo base_url();?>index.php/cms/addParipalanaSamithi">Add New </a></li>
                
              </ul>
            </li>
			<li>Diety Management&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
              <ul>
                <li><a href="<?php echo base_url();?>index.php/admin/admin/diety_view">View</a></li>
                <li><a href="<?php echo base_url();?>index.php/admin/admin/add_diety">Add New </a></li>
                <li><a href="<?php echo base_url();?>index.php/admin/admin/pooja_assign">Assign Pooja </a></li>
              </ul>
            </li>
            <li>Pooja Management&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
              <ul>
                <li><a href="<?php echo base_url();?>index.php/admin/admin/pooja_view">View</a></li>
                <li><a href="<?php echo base_url();?>index.php/admin/admin/add_pooja">Add New </a></li>
              </ul>
            </li>
            <li>Customer Management&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+
              <ul>
                <li><a href="<?php echo base_url();?>index.php/admin/admin/customer_view">View</a></li>
                <li><a href="<?php echo base_url();?>index.php/admin/admin/add_customer">Add New </a></li>
              </ul>
            </li>
            <li> Billing &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; +
              <ul>
                <li><a href="<?php echo base_url();?>index.php/admin/admin/billing">Add New </a></li>
                <li><a href="<?php echo base_url();?>index.php/admin/admin/schedule">Schedule Bill</a></li>
                <li><a href="<?php echo base_url();?>index.php/admin/admin/billing_view">View</a></li>
                <li><a href="<?php echo base_url();?>index.php/admin/admin/bill_report">Report</a></li>
              </ul>
            </li>
             <li><a href="<?php echo base_url();?>index.php/accounts/addLedger">Account Management&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+</a></li>

            <li><a href="<?php echo base_url();?>index.php/admin/admin/birth_star">Birth Star</a></li>
			<!-- <li> <a href="<?php echo base_url();?>admin/admin/category_view">Master Settings</a> </li> -->  
          </ul>
        </div>
      </nav>
    </div>
  </div>
  <div class="pos-f-t clearfix subxms ">
    <div class="container-fluid">
      <nav class="navbar navbar-dark  ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation"> <i class="fa fa-bars"></i> </button>
      </nav>
      <div class="collapse" id="navbarToggleExternalContent">
        <div class="p-2">
          <div id="acdnmenu">
            <div id="acdnmenub" >
          <ul>
            <!-- 
			<li> <a href="<?php echo base_url();?>admin/admin/dashboard">Dashboard</a> </li>  
			<li>Product Management            +
              <ul>
                <li><a href="<?php echo base_url();?>admin/admin/products_view">View</a></li>
                <li><a href="<?php echo base_url();?>admin/admin/add_product">Add New </a></li>
                <li><a href="<?php echo base_url();?>admin/admin/managePrice">Manage Price</a></li>
              </ul>
            </li> 
			<li>Merchant Management +
              <ul>
                <li><a href="<?php echo base_url();?>admin/admin/shop_view">View</a></li>
              </ul>
            </li> 
			<li>Customer Management +
              <ul>
                <li><a href="<?php echo base_url();?>admin/admin/user_view">View</a></li>
              </ul>
            </li>
             <li>Vendor Management +
              <ul>
                <li><a href="<?php echo base_url();?>admin/admin/vendor_view">View</a></li>
                <li><a href="<?php echo base_url();?>admin/admin/add_vendor">Add New </a></li>
                <li><a href="<?php echo base_url();?>admin/admin/vendor_manage">Mange Product </a></li>
                <li><a href="<?php echo base_url();?>admin/admin/vendor_category">Category </a></li>
              </ul>
            </li> 
            <li> <a href="<?php echo base_url();?>admin/admin/order_view/0">Order Management</a> </li>
			<li>Reports +
              <ul>
                <li><a href="#">Report 1</a></li>
                <li><a href="#">Report 2</a></li>
              </ul>
            </li>
            <li> <a href="<?php echo base_url();?>admin/admin/enquiry">Enquiry</a> </li>-->
			<li> <a href="<?php echo base_url();?>admin/admin/category_view">Master Settings</a> </li>  
          </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
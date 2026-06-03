<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml"><!--<![endif]--><head id="Head1">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/ico" href="favicon.ico">
<?php 
$temple_list=$this->general_model->gettemples();
$getcontact=$this->site_model->getcontact();
$site_settings=$this->site_model->settings();
$bgimage=$site_settings['bgimage'];
?>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	  <link rel="stylesheet" href="../Styles/ie8.css" />
    <![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site6/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site6/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site6/css/effects.css">


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site6/css/projects.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/site6/css/news.css">

<title><?php print_r($temple_list[0]['name']);?></title>
</head>

<body>
<!--Mobile Navigation-->
<ul id="menu">
  <li> <a href="<?php echo base_url(); ?>index.php/welcome/index">Home</a> </li>
  <li><a href="<?php echo base_url(); ?>index.php/welcome/temple">The Temple</a><ul><li><a href="<?php echo base_url(); ?>index.php/welcome/temple#about">About</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/temple#devathas">Devathas</a></li></ul></li>  
  <li><a href="<?php echo base_url(); ?>index.php/welcome/poojas">Poojas</a><ul><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#vazhipadu">Vazhivadu (Offerings)</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#online">Book an Offering</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/poojas#timing">Daily Pooja Timings</a></li></ul></li> 
  <li><a href="<?php echo base_url(); ?>index.php/welcome/festival">Festivals</a><ul><li><a href="<?php echo base_url(); ?>index.php/welcome/festival">Thanthrik Festivals</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/festival">Gallery</a></li></ul></li> 
  <li><a href="<?php echo base_url(); ?>index.php/welcome/news">News </a></li>  
  <li><a href="<?php echo base_url(); ?>index.php/welcome/contact">Administrative</a><ul><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#trustee">Trust &amp; Trustees</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#staffs">Temple Staffs</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#hwreach">How to Reach</a></li><li><a href="<?php echo base_url(); ?>index.php/welcome/contact#tmmap">Contact Us</a></li></ul></li>
</ul>

 <html>
	<head>
		<link href="<?php echo base_url(); ?>/assets/new_style/css/style.css" rel="stylesheet"/>
		<link href="<?php echo base_url(); ?>/assets/new_style/css/color-skins/color1.css" rel="stylesheet"/>
		<link href="<?php echo base_url(); ?>/assets/new_style/css/skins-modes.css" rel="stylesheet"/>
		<link href="<?php echo base_url(); ?>/assets/new_style/plugins/horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>/assets/new_style/plugins/horizontal-menu/horizontal-menu.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>/assets/new_style/plugins/charts-c3/c3-chart.css" rel="stylesheet"/>
		<link href="<?php echo base_url(); ?>/assets/new_style/plugins/tabs/tabs-2.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>/assets/new_style/plugins/p-scroll/p-scroll.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url(); ?>/assets/new_style/css/icons.css" rel="stylesheet"/>
		<link href="<?php echo base_url(); ?>/assets/new_style/plugins/right-sidebar/right-sidebar.css" rel="stylesheet">
    	<style>
        	body {
        		font-size: 1.2em;
        	}
        
        	.rounded-element {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      border: 1px solid black;
      border-style: dotted;
      border-radius: 10px; /* Adjust the border-radius to your preference */
    }

    .number {
      background-color: #fff;
  padding: 5px 0px;
  border-radius: 50%;
  width: 32px;
  text-align: center;
  float: right;
  font-size: 14px;
/*   border: 0.1px solid gray; */
    }
        
        	@media print {
         		.page-break {
             		page-break-after: always;   
            	}
        	}
    	</style>
	</head>
	<body onload="printcontend('printer')" onafterprint="myFunction()">
		<div id="printer">
			<?php 
        	$index = 0;
            if(!empty($addresses)){
            $customers = array_chunk($addresses, 3);
            foreach ($customers as $key => $customer) {

            if (($key+1) % 4 == 0) {
            	$break = true;
            	$pageBreak = 'page-break';
            } else {
            	$break = false;
            	$pageBreak = '';
            }
            ?>
            <div class="row p-5 <?php echo $pageBreak; ?>">
        	<?php 
			foreach ($customer as $customer_key => $val) {
            	$index += 1;
            
			?>
				<div class="col-lg-4 col-md-4 col-sm-4" style="padding: 10px 20px;">
                	<div class="number"> <?php echo $index."/".$val->postal_amt;?> <?php echo $val->postal_air ? ' - Airmail' : ''; ?> </div>
                	
					<p><?php echo $val->name;?><br>
                    <?php echo $val->house;?><br>
                    <?php if($val->post) { echo $val->post." Post"; } ?><br>
                    <?php if($val->street)  { echo $val->street." , "; } if($val->pincode)  {  echo $val->pincode; }?><br>
                    <?php if($val->district)   { echo $val->district." , "; } if($val->state)  { echo $val->state."."; }?> <br>
                	<?php if($val->mobile!='999999999') { ?>PH: <?php echo $val->mobile; ?> <?php } ?>
                	</p>
				</div>	
            	
            	
			<?php }  ?>
            </div>
        
           <?php  } } ?>
		</div>
	</body>
</html>
<script>
window.onfocus = function () { setTimeout(function () { window.location = "<?php echo base_url();?>index.php/admin/report/postalAddresses" }, 500); }
function myFunction(){
    window.location = "<?php echo base_url();?>index.php/admin/report/postalAddresses";
}
function printcontend(value) {
	var restorpage=document.body.innerHTML;
	var printcontend=document.getElementById(value).innerHTML;
	document.body.innerHTML=printcontend;
	window.print();
	document.body.innerHTML=restorpage;
}

</script>
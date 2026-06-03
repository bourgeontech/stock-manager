<?php if(isset($settings)){
    $id=$settings['id'];
    $distance=$settings['search_distance'];
    $app_color=$settings['app_color'];
    $currency=$settings['currency'];
    $delivery_value_limit=$settings['delivery_value_limit'];
    $delivery_charge=$settings['delivery_charge'];
    $customer_care=$settings['customer_care'];
}
else{
    $distance='';
    $app_color='';
    $currency='';
    $delivery_value_limit='';
    $delivery_charge='';
    $customer_care='';
}
?>
<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt">Settings </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="<?php echo base_url();?>admin/admin/order_view/0" class="btn btn-primary">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back</a> </li>
          </ul>
        </div>
      </div>
    </div>
  <form action="<?php echo base_url(); ?>index.php/admin/admin/settings_update/<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
        <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 ">        
       <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">App Settings</h6>
     <div class="media text-muted pt-3">
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">Delivery Distance Limit</strong>
          <a href="#"><input type="text" class="form-control" value="<?php echo $distance; ?>" name="distance" /></a>
        </div>
      </div>
    </div>
    <div class="media text-muted pt-3">
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">Customer Care</strong>
          <a href="#"><input type="text" class="form-control" value="<?php echo $customer_care; ?>" name="customer_care" /></a>
        </div>
      </div>
    </div>
  </div>
       </div>  
        </div>
        <div class="row">
            <div  class="col-lg-12 col-md-12 col-sm-12 text-right">
                <button type="submit" class="btn btn-primary" name="save">Save Changes</button>
            </div>
        </div>
        </form>
      </div>
    </div>
    <div class="clearfix"></div>
    <br>
	


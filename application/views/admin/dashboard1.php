
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"><i class="fa fa-home" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Dashboard"></i> Dashboard </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
          </ul>
        </div>
      </div>
    </div>
    <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
       <div class="row">
           <div class="col-lg-12">
               <h2><i class="fa fa-calendar" aria-hidden="true"></i>     <?php date_default_timezone_set('Africa/Kampala'); echo date("F j, Y"); ?><span id="time"></span></h2>
           </div>
       </div>  
        <hr>
     <!--  <div class="row">
           <div class="col-lg-12">
            <div class="dash_menu shadow">
            <div class="dash_top">
                <a href="<?php echo base_url();?>admin/admin/order_view/0"> 
              <div><i class="fa fa-shopping-cart" aria-hidden="true"></i><br>
               Pending Order</div>
                <div class="count"><?php echo $orderpending['order_count_pending']; ?></div>
              </a>
            </div>
            </div>
            <div class="dash_menu shadow">
            <div class="dash_top">
                <a href="<?php echo base_url();?>admin/admin/enquiry"> 
              <div><i class="fa fa-comment-o" aria-hidden="true"></i><br>
               Enquiry</div>
                <div class="count"><?php echo $enquiry['enquiry_count']; ?></div>
              </a>
            </div>
            </div>
           </div>
       </div>  
       <hr>
      <div class="row">
        <div class="col-lg-12">
          <div class="dash_menu shadow">
            <div class="dash_top">
                <a href="<?php echo base_url();?>admin/admin/user_view">
              <div><i class="fa fa-user"></i><br>
                Customers</div>
                <div class="count"><?php echo $customer['customer_count']; ?></div>
              </a>
            </div>
           <a href="#" class="view"><i class="fa fa-eye"></i>&nbsp;View</a>
             <a href="#" class="edit"><i class="fa fa-edit"></i>&nbsp;Edit</a>
            
            </div>
          <div class="dash_menu shadow">
            <div class="dash_top">
                <a href="<?php echo base_url();?>admin/admin/products_view">
              <div><i class="fa fa-shopping-bag"></i><br>
                Products</div>
                <div class="count"><?php echo $product['product_count']; ?></div>
              </a>
            </div>
             </div>
             <div class="dash_menu shadow">
            <div class="dash_top">
                <a href="<?php echo base_url();?>admin/admin/order_view/0"> 
              <div><i class="fa fa-shopping-cart" aria-hidden="true"></i><br>
               Order Delivered</div>
                <div class="count"><?php echo $orderdelivered['order_count_delivered']; ?></div>
              </a>
            </div>
            </div>


         
        </div>
      </div>
      <div class="clearfix"></div>
      <hr>
     <h5 class="mb-4" style="font-size: 16px; font-weight: bold"> <i class="fa fa-shopping-bag"></i> Recent Sale <a class="pull-right viewall" href="#" >+View All</a></h5>
      <div class="table-responsive-sm">
        <table class="table  table-hover srp_table" width="100%" border="1">
          <thead>
            <tr>
              <th scope="col" width="300">Shop Name </th>
              <th scope="col" width="200">Date</th>
				<th scope="col" width="200">Art No.</th>
              <th scope="col" width="100"> Colour</th>
				 <th scope="col" width="100"> Qty</th>
              <th scope="col" width="200">MRP </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Angel Footwear</td>
              <td>08 March 2019 </td>
				<td >Art.50454</td>
              
              <td>Red </td>
				<td >69 </td>
              <td>Rs.5000</td>
            </tr>
          </tbody>
        </table>
      </div>
      <hr>
      <h5 class="mb-4" style="font-size: 16px; font-weight: bold"> <i class="fa fa-money "></i> Recent Payments <a class="pull-right viewall" href="#" >+View All</a></h5>
      <div class="table-responsive-sm">
        <table class="table  table-hover srp_table" width="100%" border="1">
          <thead>
            <tr>
              <th scope="col" width="200">ABP </th>
              <th scope="col" width="100">Date</th>
              <th scope="col" width="100"> Amout</th>
              <th scope="col" width="200">remark </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Angel Footwear</td>
              <td>08 March 2019 </td>
              <td >Rs.500 </td>
              <td>Full Amount Paid</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="clearfix"></div>
    <br>-->
    <script>
        setInterval(function() {
            window.location.reload();
        }, 60000); 
    </script>
  
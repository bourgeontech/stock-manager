<?php 
$fields = $this->db->list_fields('site_settings');
$query = $this->db->query("select * from site_settings where id =1"); 
$site_settings = $query->row();
$add_qty = in_array('custom_multi_qty', $fields) && $site_settings->custom_multi_qty == 1;  
?>
<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style.css">
</head>  
  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <h4 class="page_txt">Billing Master</h4>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
         <form action="<?php echo base_url(); ?>index.php/admin/billing/multy_schedule" method="post" >
	     <div class="col-lg-12 col-md-12 col-sm-12">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row mb-4">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h3 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Bill - <?php echo $last_id;?> </h3>
                  </div>
               	  
			   </div>
      <div class="form_body">
        <div class="row" id="datatable">
			
			<div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Name <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Name" id="name" name="name"  type="text" >
            <input id="billno" name="billno" value="<?php echo $last_id;?>" type="hidden" >
			<?php echo form_error('name', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Deity <span class="red">*</span> </label>
            </div>
            <select name="diety_id" id="diety_id" onChange="changepooja()" class="sq_form" style="width:100%;">
              <option selected="selected" value="0">Please Select</option>
              <?php 
              foreach ($diety_list as $diety){
              ?>
              	<option value="<?php echo $diety['id'];?>"><?php echo $diety['name'];?></option>
              <?php 
              }
              ?>
            </select>
            <?php echo form_error('diety_id', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="<?php if($add_qty): print_r('col-lg-2'); else: print_r('col-lg-3'); endif;  ?>">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Birth Star <span class="red">*</span> </label>
            </div>
            <select name="star_id" id="star_id" class="sq_form star" style="width:100%;">
              <option value="0">Please Select</option>
              <?php 
              foreach ($star_list as $star){
              ?>
              	<option data-name="<?php echo $star['name_eng']; ?>" value="<?php echo $star['id'];?>"><?php echo $star['name_eng']." - ".$star['name_mal'];?></option>
              <?php 
              }
              ?>
            </select>
            <?php echo form_error('star_id', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="<?php if($add_qty): print_r('col-lg-2'); else: print_r('col-lg-3'); endif;  ?>">
        <div class="form-group">
        	<input type="hidden" id="row_value" />
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Pooja Date <span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder=" Pooja Date" id="main_date" name="main_date" value="<?php echo date('Y-m-d');?>" type="date" >
			<?php echo form_error('main_date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <?php if($add_qty): ?>
      <div class="col-lg-2">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Quantity<span class="red">*</span> </label>
            </div>
            <input class="sq_form" placeholder="Quantity" id="qty" name="qty" min="1" value="1" type="number" >
			<?php echo form_error('qty', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">Pooja <span class="red">*</span> </label><span onclick="addRow()" style="float: right;"><i class="fa fa-plus"></i></span>
            </div>
            <select name="pooja_id[]" id="pooja_id" onchange="checkpooja()" class="sq_form">
              <option value="0">Please Select</option>
            </select>
            <?php echo form_error('pooja_id', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <!-- <div class="col-sm-6 buttons" id="savebtn" style="display:none;">
            <button type="submit" class="btn btn-success" name="save" value="save" style="margin:0.7cm 4px 0 4px;"> Save </button>
       </div> -->
        </div>
      </div>
    </div>
	</div> 
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-6 ">		
<div class="form_body">
        <div class="row">
			
<div class="row" id="dvPassport">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="product-description-tab">
     
     
      <div class="description-tab-menu">
        <ul class="clearfix" role="tablist">
          <li role="presentation" id="description_1" class="active" onclick="showschedule('description')"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Daily</a></li>
          <li role="presentation" id="specification_1" onclick="showschedule('specification')"><a href="#specification" aria-controls="specification" role="tab" data-toggle="tab">Weekly</a></li>
          <li role="presentation" id="review_1" onclick="showschedule('review')"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Monthly</a></li>
          <li role="presentation" id="other_1" onclick="showschedule('other')"><a href="#other" aria-controls="others" role="tab" data-toggle="tab">Others</a></li>
       </ul>
      </div>
      
      
      <div class=" tab-content">
      
        <div role="tabpanel" class="tab-pane active" id="description">
        
        <div class="row">
  <div class="col-sm-4">
    <label>From</label>
    <div class="form-group">
     <input type="date" class="form-control clickable input-md date_inp" id="dailyfrom"  value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
    </div>
  </div>
  <div class="col-sm-4">
    <label>No Of Days</label>
    <div class="form-group" >
      <input type="text" class="form-control clickable input-md date_inp adddays"  id="noofdays" min="1" placeholder="No Of Days" >
    </div>
  </div>
  
<div class="col-sm-4">
    <label>To</label>
    <div class="form-group" >
      <input type="date" class="form-control clickable input-md date_inp" id="dailyto"  value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date" >
    </div>
  </div>
  <div class="col-sm-12">
    

  <table width="505" border="0" cellpadding="5" cellspacing="5">
</table>  
  </div>  
    <div class="col-sm-10">
    	<input type="button" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-info cart_btn1">
   	</div>
   	<div class="col-sm-2">
   		<input type="button" value="Submit" onclick="dailysub()" class="btn btn-success cart_btn1">
    </div>
</div>
 </div>
        
        
        
<div role="tabpanel" class="tab-pane" id="specification">
 <div class="row ">
  <div class="col-sm-4">
    <label>From</label>
    <div class="form-group">
     <input type="date" class="form-control clickable input-md date_inp" id="weeklyfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
    </div>
  </div>
   <div class="col-sm-4">
    <label>No Of Weeks</label>
    <div class="form-group">
     <input type="text" class="form-control clickable input-md addweeks" id="noofweeks" min="1" value="" placeholder=" No Of Weeks">
    </div>
  </div>
  <div class="col-sm-4">
    <label>To</label>
    <div class="form-group">
     <input type="date" class="form-control clickable input-md date_inp" id="weeklyto" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
    </div>
  </div>
  
  <div class="col-sm-12">
    

  <table width="505" height="100" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <th width="26" height="29" scope="row">
      <input class="booking-week-table-input" type="checkbox" name="checkbox" id="checkAll" />
</th>
    <td width="83">All</td>
    <td width="28">&nbsp;</td>
    <td width="87">&nbsp;</td>
    <td width="24">&nbsp;</td>
    <td width="88">&nbsp;</td>
    <td width="18">&nbsp;</td>
    <td width="101">&nbsp;</td>
  </tr>
  <tr>
    <th height="28" scope="row"><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Sunday" id="week"></th>
    <td>Sunday</td>
    <td><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Monday" id="week"></td>
    <td>Monday</td>
    <td><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Tuesday" id="week"></td>
    <td>Tuesday</td>
    <td><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Wednesday" id="week"></td>
    <td>Wednesday</td>
  </tr>
  <tr>
    <th scope="row"><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Thursday" id="week"></th>
    <td>Thursday</td>
    <td><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Friday" id="week"></td>
    <td>Friday</td>
    <td><input class="booking-week-table-input week" type="checkbox" name="week[]" value="Saturday" id="week"></td>
    <td>Saturday</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>  
  </div>  
   
 
  <div class="col-sm-2 ">
    <input type="button" value="Submit" onclick="weeklysub()" class="btn btn-success cart_btn1">
   </div>
  <div class="col-sm-2">
    <input type="submit" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-info cart_btn1">
   </div>



</div>
        </div>



 <div role="tabpanel" class="tab-pane" id="review">
<div class="row ">
  <div class="col-sm-4">
    <label>From</label>
    <div class="form-group">
     <input type="date" class="form-control clickable input-md date_inp datefrom" id="monthlyfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
    </div>
  </div>
    <div class="col-sm-4">
    <label>No Of Months</label>
    <div class="form-group">
     <input type="text" class="form-control addmonths" id="months"  >
    </div>
  </div>
  <div class="col-sm-4">
    <label>To</label>
    <div class="form-group">
     <input type="date" class="form-control clickable input-md date_inp dateto" id="monthlyto" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
    </div>
  </div>

 
    
<div class="row">
 

               <div class="form-check-all form-check-inline"><input id="checkmonth" type="checkbox" class="checkmonth" name="ctl00$ContentPlaceHolder1$chkmonthly$0" value="All">
              <label for="ContentPlaceHolder1_chkmonthly_0">All</label></div>
  
              <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_0" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$0" value="Aswathi">
              <label for="ContentPlaceHolder1_chkmonthly_0">Aswathi</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_1" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$1" value="Bharani">
              <label for="ContentPlaceHolder1_chkmonthly_1">Bharani</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_2" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$2" value="Karthika">
              <label for="ContentPlaceHolder1_chkmonthly_2">Karthika</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_3" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$3" value="Rohini">
              <label for="ContentPlaceHolder1_chkmonthly_3">Rohini</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_4" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$4" value="Makiyeeram">
              <label for="ContentPlaceHolder1_chkmonthly_4">Makiyeeram</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_5" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$5" value="Thiruvathira">
              <label for="ContentPlaceHolder1_chkmonthly_5">Thiruvathira</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_6" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$6" value="Ponartham">
              <label for="ContentPlaceHolder1_chkmonthly_6">Ponartham</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_7" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$7" value="Pooyam">
              <label for="ContentPlaceHolder1_chkmonthly_7">Pooyam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_8" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$8" value="Aayilyam">
              <label for="ContentPlaceHolder1_chkmonthly_8">Aayilyam</label></div>
          
          
          <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_9" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$9" value="Makam">
              <label for="ContentPlaceHolder1_chkmonthly_9">Makam</label></div>
          
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_9" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$9" value="Pooram">
              <label for="ContentPlaceHolder1_chkmonthly_9">Pooram</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_10" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$10" value="Uthram">
              <label for="ContentPlaceHolder1_chkmonthly_10">Uthram</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_11" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$11" value="Atham">
              <label for="ContentPlaceHolder1_chkmonthly_11">Atham</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_12" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$12" value="Chithra">
              <label for="ContentPlaceHolder1_chkmonthly_12">Chithra</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_13" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$13" value="Chothi">
              <label for="ContentPlaceHolder1_chkmonthly_13">Chothi</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_14" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$14" value="Visakham">
              <label for="ContentPlaceHolder1_chkmonthly_14">Visakham</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_15" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$15" value="Anisham">
              <label for="ContentPlaceHolder1_chkmonthly_15">Anisham</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_16" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$16" value="Trikketta">
              <label for="ContentPlaceHolder1_chkmonthly_16">Trikketta</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_17" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$17" value="Moolam">
              <label for="ContentPlaceHolder1_chkmonthly_17">Moolam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_18" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$18" value="Pooradam">
              <label for="ContentPlaceHolder1_chkmonthly_18">Pooradam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_19" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$19" value="Uthradam">
              <label for="ContentPlaceHolder1_chkmonthly_19">Uthradam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_20" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$20" value="Thiruvonam">
              <label for="ContentPlaceHolder1_chkmonthly_20">Thiruvonam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_21" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$21" value="Avittam">
              <label for="ContentPlaceHolder1_chkmonthly_21">Avittam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_22" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$22" value="Chathayam">
              <label for="ContentPlaceHolder1_chkmonthly_22">Chathayam</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_23" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$23" value="Poororuttathi">
              <label for="ContentPlaceHolder1_chkmonthly_23">Poororuttathi</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6">
              <input id="ContentPlaceHolder1_chkmonthly_24" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$24" value="Uthratathi">
              <label for="ContentPlaceHolder1_chkmonthly_24">Uthratathi</label></div>
          
         
            <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_25" type="checkbox" class="month" name="ctl00$ContentPlaceHolder1$chkmonthly$25" value="Revathi">
              <label for="ContentPlaceHolder1_chkmonthly_25">Revathi</label></div>
     

</div>
    
  <div class="col-sm-2 ">
    <input type="button" value="Submit" onclick="monthlysub()" class="btn btn-success cart_btn1">
   </div> 
  <div class="col-sm-2">
    <input type="submit" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Dailysubmit" class="btn btn-info cart_btn1">
   </div>

   
</div>
 </div>
      <!----->
      
       <div role="tabpanel" class="tab-pane" id="other">
<div class="row ">
  <div class="col-sm-4">
    <label>From</label>
    <div class="form-group">
     <input type="date" class="form-control clickable input-md date_inp otherfrom" id="otherfrom" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
    </div>
  </div>
    <div class="col-sm-4">
    <label>No Of Months</label>
    <div class="form-group">
     <input type="text" class="form-control addothers" id="others"  >
    </div>
  </div>
  <div class="col-sm-4">
    <label>To</label>
    <div class="form-group">
     <input type="date" class="form-control clickable input-md date_inp otherto" id="otherto" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" placeholder="&#xf133; Date">
    </div>
  </div>

 
    
<div class="row">
 
      
            <?php foreach ($other_list as $key => $other){  ?>
              <div class="form-check form-check-inline col-sm-6"><input id="ContentPlaceHolder1_chkmonthly_<?= $key; ?>" type="checkbox" class="other_id" name="ctl00$ContentPlaceHolder1$chkmonthly$<?= $key; ?>" value="<?= $other['other_code']; ?>">
              <label for="ContentPlaceHolder1_chkmonthly_<?= $key; ?>"><?= $other['other_detail']; ?></label></div>
            <?php } ?>
      
   
</div>
    
  <div class="col-sm-2 ">
    <input type="button" value="Submit" onclick="othersub()" class="btn btn-success cart_btn1">
   </div> 
  <div class="col-sm-2">
    <input type="submit" name="date" value="Cancel" id="ContentPlaceHolder1_btn_Othersubmit" class="btn btn-info cart_btn1">
   </div>

   
</div>
 </div>
      
      
      <!----->
	<div class="row" id="scheduletable">
  		<div class="col-sm-12" style="padding:10px;">
  			<table class="table display table-hover srp_table" width="100%" border="1" style="display:none;">
  				<thead>
  					<tr>
  						<th>#</th>
  						<th>Date</th>
  						<th>Star</th>
  						<th>Action</th>
  					</tr>
  				</thead>
  				<tbody id="mytbody">
  				
  				</tbody>
  			</table>
  		</div>
  	</div>

     
      </div>
    </div >
  </div >
</div>
</div>
</div >
</div>
<div class="col-lg-2 col-md-2 col-sm-2"></div>
<div class="col-lg-4 col-md-4 col-sm-4">		
    <div class="form_body">
        <div class="row">
        <div class="col-lg-11 col-md-11 col-sm-11">		
        <div class="shadow-sm p-3 mb-2 bg-white" >

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
function paymentTableControl(billtype) {
	billtype == 2 ?  $('#paymenttable').hide() : $('#paymenttable').show()
}

$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });

	$('.billtype').val() ? paymentTableControl($('.billtype').val()) : ''
	
	$('.billtype').on('change', (e) => {
    	let billtype = e.target.value;
    	paymentTableControl(billtype)
    });
});
</script>

    <?php
            	    $i=1;
            	    $total='0';
            	    foreach($temple_list as $val){ 
            	        $postel_charge=$val['postel_charge'];
            	        $amt=$this->amount[0]['SUM(rate)'];
            	        $total=$total+ ($total_bill_amount ?? 0);
                    	
            	        ?>

        <div class="col-sm-12 buttons" style="display:none;" align="right">
   			<button type="submit" class="btn btn-success" name="save" value="save" style="margin:10px 4px 0 4px; font-size: 1.5em;"> Save </button>
		</div>

          <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?php 
                    $i=1;
                   $cc=0;
                   $c=0;
                   if($bill_lists){
                foreach($bill_lists as $val)
                {
                	
                  $cc+=$val['rate'];
                  $c+=$val['total'];

              // echo $c;
                }}?>
              <tr class="g_total">
                  <th style="padding: 25px;">Total rate for pooja</th>
                  <th style="padding: 0px;">₹ <span id="Cont"><?php echo $total;?></span></th>
              </tr>
          </table>
              
<div style="display: flex; justify-content: space-between;">
    <?php if(isset($ref)) { ?>
        <div style="padding: 10px;">
            <a class="btn btn-info" href="<?php echo base_url()."index.php/welcome/multicancel/". $ref; ?>">Discard Bill</a>
        </div>
    <?php } ?>

    <div style="padding: 10px;">
        <a ID="btn_pay" class="btn btn-success" href="<?php echo base_url(); ?>index.php/admin/admin/review">Review &amp; Pay</a>
    </div>
</div>

        	</div>
        	</div>
    	</div>
	</div>
  <?php } ?>
</div>
</div>
</form>
</div></div>
<div class="clearfix"></div>
<br>

<!--    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js" integrity="sha512-/n/dTQBO8lHzqqgAQvy0ukBQ0qLmGzxKhn8xKrz4cn7XJkZzy+fAtzjnOQd5w55h4k1kUC+8oIe6WmrGUYwODA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"></script>

<script>
$('#name').autocomplete({
             source: function(request, response) {
              <?php if ($_SERVER['HTTP_HOST'] == 'malaysia.templesoftware.in') {?>
	 var translate_url = "<?php echo base_url(); ?>index.php/admin/billing/translatetext_tamil";	
	<?php }
	else {?>
   var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext";
	<?php 
	}
	?>
            	$.ajax({
                    url: translate_url,
                    type: 'post',
                	dataType: "json",
                	data: {
                    	search: $("#name").val()
                	},
                   success: function( data ) { 
                            response(data); 
                   }
                });
             },
             select: function(event, ui) {
                $("#name").val(ui.name);
             }
 });
 $( ".addmonths" ).keyup(function() {
         var x = parseInt($(this).val());
         var datefrom = $('.datefrom').val();
         var datefrom =  new Date(datefrom);
         var dateto = datefrom.addMonths(x);
         var date = dateto.toString('yyyy-MM-dd');
         $('.dateto').val(date);
});
 $( ".addothers" ).keyup(function() {
         var x = parseInt($(this).val());
         var datefrom = $('.otherfrom').val();
         var datefrom =  new Date(datefrom);
         var dateto = datefrom.addMonths(x);
         var date = dateto.toString('yyyy-MM-dd');
         $('.otherto').val(date);
});
 $( ".addweeks" ).keyup(function() {
         var x = parseInt($(this).val());
         var datefrom = $('#weeklyfrom').val();
         var datefrom =  new Date(datefrom);
         var dateto = datefrom.addWeeks(x);
         var date = dateto.toString('yyyy-MM-dd');
         $('#weeklyto').val(date);
});
 $( ".adddays" ).keyup(function() {
         var x = parseInt($(this).val());
         var datefrom = $('#dailyfrom').val();
         var datefrom =  new Date(datefrom);
         var dateto = datefrom.addDays(x-1);
         var date = dateto.toString('yyyy-MM-dd');
         $('#dailyto').val(date);
});
$( ".star" ).change(function() {
         var star = $(this).find(':selected').attr('data-name');
         $('.month').each(function(index,value){
             if(value.value == star){
                $(".month:eq(" + index + ")").prop("checked", true); 
             }
             else{
                $(".month:eq(" + index + ")").prop("checked", false); 
             }
         }); 
});
function checkpooja(){
	var pooja=$('#pooja_id').val();
	// if(pooja=="15"){
	// 	$('#dvPassport').css('display','none');
	// 	$('#savebtn').css('display','block');
	// 	var url = '<?php echo base_url();?>index.php/welcome/getmokkolakkalludate';
	// $.ajax({
	// type: "POST",
	// url: url,
	// data: {'pooja': pooja},
	// dataType: "json",
	// success: function (data) {
	// $('#main_date').val(data);
	// $('#main_date').attr('readonly', true);
	// }
	// });
	// }else{
	// var data='<?php echo date('Y-m-d');?>';
	// $('#dvPassport').css('display','block');
	// 	$('#savebtn').css('display','none');
	// $('#main_date').val(data);
	// $('#main_date').attr('readonly', false);
	// }
}
function changeamount(){
    	var rate=document.getElementById('postel_rate').value;
    	var count=document.getElementById('count').value;
        var tot=document.getElementById('main_total').value;
    	// alert(tot);
        var charge=rate*count;
        var total=parseInt(tot)+parseInt(charge);
        document.getElementById('postel_charge').innerHTML=charge;
        document.getElementById('total').innerHTML=total;
        document.getElementById('tot').value=total;
    }
function changepooja(){

    var diety=$('#diety_id').val();

    $('#pooja_id').html("");
    var html='<option value="0">Please Select</option>';
    var url = '<?php echo base_url();?>index.php/admin/admin/getpoojasbydiety';
	$.ajax({
        type: "POST",
        url: url,
        data: {'diety': diety},
        dataType: "json",
        success: function (data) {
            $.each(data, function (i, obj)
            {
            	html +='<option value="'+obj.pooja_id+'">'+obj.pooja+' - '+obj.pooja_mal+' - Rs '+obj.pooja_rt+'</option>';
            });
            $('#pooja_id').append(html);
        }
    });
}

function showschedule(id){
    $('#description').removeClass("active");
    $('#specification').removeClass("active");
    $('#review').removeClass("active");
    $('#description_1').removeAttr('class');
    $('#specification_1').removeAttr('class');
    $('#review_1').removeAttr('class');
    $('#'+id).addClass("active");
    $('#'+id+"_1").addClass("active");
}
function dailysub(){
	var datefrom=$('#dailyfrom').val();
	var dateto=$('#dailyto').val();
    var noofdays=$('#noofdays').val();
 //var date = Date.parse(datefrom).add({ years: year, months: month, weeks:week, days:days-1 });
    if(datefrom==""){
	    alert("Date field is required");
	}else if(dateto==""){
	    alert("Date field is required");
	}
	$(".display").removeAttr('style');
	$(".buttons").removeAttr('style');
	var url = '<?php echo base_url();?>index.php/admin/admin/getdatestar';
	var html="";
	var a="1";
	$.ajax({
        type: "POST",
        url: url,
        data: {'from': datefrom,'to': dateto,'noofdays':noofdays},
        dataType: "json",
        success: function (data) {
            $.each(data, function (i, obj)
            {
            	html +='<tr><td>'+a+'</td>';
            	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
            	html +='<td>'+obj.name_eng+'</td>';
            	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
            	a++;
            });
            $('#mytbody').html(html);
        }
    });
}
function weeklysub(){
    var datefrom=$('#weeklyfrom').val();
	var dateto=$('#weeklyto').val();
  var week = parseInt($('#weeks').val());
var noofweeks=parseInt($('#noofweeks').val());
if(datefrom==""){
	    alert("Date field is required");
	}else if(dateto==""){
	    alert("Date field is required");
	}
	$(".display").removeAttr('style');
	$(".buttons").removeAttr('style');
	var url = '<?php echo base_url();?>index.php/admin/admin/getweekstar';
	var html="";
	var a="1";
	var sel=$('#week:checked').map(function(_, el) {
        var day=$(el).val();
        $.ajax({
            type: "POST",
            url: url,
            data: {'from': datefrom,'to': dateto,'day': day,'noofweeks':noofweeks},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	html +='<tr><td>'+a+'</td>';
                	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                	html +='<td>'+obj.name_eng+'</td>';
                	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                	a++;
                });
                $('#mytbody').html(html);
            }
        });
    }).get();
	
}
function monthlysub(){
    var datefrom=$('#monthlyfrom').val();
	var dateto=$('#monthlyto').val();
     var month = parseInt($('#months').val());

	if(datefrom==""){
	    alert("Date field is required");
	}else if(dateto==""){
	    alert("Date field is required");
	}
	$(".display").removeAttr('style');
	$(".buttons").removeAttr('style');
	var url = '<?php echo base_url();?>index.php/admin/admin/getmonthstar';
	var html="";
	var a="1";
	var sel=$('.month:checked').map(function(_, el) {
        var star=$(el).val();
        $.ajax({
            type: "POST",
            url: url,
            data: {'from': datefrom,'to': dateto,'star': star,'month':month},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	html +='<tr><td>'+a+'</td>';
                	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                	html +='<td>'+obj.name_eng+'</td>';
                	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                	a++;
                });
                $('#mytbody').html(html);
             $("#monthlyto").show();
            }
        });
    }).get();
	
}

function othersub(){

    
    var datefrom=$('#otherfrom').val();
	 //var days = parseInt($('#days').val());
        var month = parseInt($('#others').val());
       // var dateto=$('#dateto').val();
        var date = Date.parse(datefrom).add({ years: 0, months: month, weeks:0, days:0 });
        var dateto =  date.toString('yyyy-MM-dd');
	if(datefrom==""){
	    alert("Date field is required");
	}else if(dateto==""){
	    alert("Date field is required");
	}
	$(".display").removeAttr('style');
	$(".buttons").removeAttr('style');
     $("#cdt").val(dateto);
	var url = '<?php echo base_url();?>index.php/admin/admin/getother';
	var html="";
	var a="1";
	var sel=$('.other_id:checked').map(function(_, el) {
        console.log(el);
        var other=$(el).val();
        console.log(other);
        $.ajax({
            type: "POST",
            url: url,
            data: {'from': datefrom,'to': dateto,'other': other},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	html +='<tr><td>'+a+'</td>';
                	html +='<td>'+obj.date+'<input type="hidden" name="dates[]" value="'+obj.birth_date+'"></td>';
                	html +='<td>'+obj.name_eng+'</td>';
                	html +='<td><i class="fa fa-trash" onclick="return remove_file_row(this)"></i></td></tr>';
                	a++;
                });
                $('#mytbody').html(html);
                $(".dateto").show();
               
            }
        });
    }).get();
    
}    





function todatecalc()
{
       var month = parseInt($('#months').val());
        var from=$('#monthlyfrom').val();

       
     var jan312009 = new Date(from);
var eightMonthsFromJan312009  = jan312009.setMonth(jan312009.getMonth()+month);
var revisedate=console.log(eightMonthsFromJan312009.toLocaleDateString("en-US"));
alert(revisedate);
       // var dateto=$('#dateto').val();
      //  var date = Date.parse(datefrom).add({ years: year, months: month, weeks:week, days:days });
      //  var dateto =  date.toString('yyyy-MM-dd');
//alert(dateto);

}
function addRow() {
			// var row_value=$('#row_value').val();
			// row_value++;
			// var html = '<div class="col-lg-4"><div class="form-group"><div class="row_form"><div class="div_label">';
			// html +='<label class="text_label">Pooja <span class="red">*</span> </label></div>';
			// html +='<select name="pooja_id[]" id="pooja_id" onchange="checkpooja()" class="sq_form"><option value="0">Please Select</option>';
			// <?php foreach($pooja_list as $val){ ?>
			//      html +='<option value="<?= $val['id']; ?>"><?= $val['name']." - ".$val['name_mal']." - Rs ".$val['rate']; ?></option>';
			// <?php } ?>
			// html +='</select></div></div></div>';
			// $('#datatable').append(html);
			// $('#row_value').val(row_value);
			var row_value=$('#row_value').val();
        row_value++;
        var html = '<div class="col-lg-3"><div class="form-group"><div class="row_form"><div class="div_label">';
            html +='<label class="text_label">Pooja <span class="red">*</span> </label></div>';
            html +='<select name="pooja_id[]" id="pooja_id" onchange="checkpooja()" class="sq_form select_pooja_'+row_value+'"><option value="0">Please Select</option>';
            html +='</select></div></div></div>';
    		$('#datatable').append(html);
    		$('#row_value').val(row_value);

			var diety=$('#diety_id').val();
    var url = '<?php echo base_url();?>index.php/admin/admin/getpoojasbydiety';
	$.ajax({
        type: "POST",
        url: url,
        data: {'diety': diety},
        dataType: "json",
        success: function (data) {
            $.each(data, function (i, obj)
            {
            	$('.select_pooja_'+row_value).append('<option value="'+obj.pooja_id+'">'+obj.pooja+' - '+obj.pooja_mal+' - Rs '+obj.pooja_rt+'</option>');
            });
        }
    });
    }

    function totalcalc(){
        var i;
        var table = document.getElementById('dataTable1');
    	var rowCount = table.rows.length;
        var tpoojacount = parseInt($('#st tr').length) - 1;
        //alert(tpoojacount);
        var tot=0;
        var pr_amt=($('#parsel_amt').val() != '') ?  $('#parsel_amt').val() :  0;
    
        for (i = 100; i < 1000; i++) {
          if (!isNaN(parseInt($('#amt_'+i).val()))){
              tot += parseInt($('#amt_'+i).val());
          }
        }
        tot=tot+parseFloat(pr_amt);
        $('#total').html(tot);
        var grosstotal = tot * tpoojacount;
        $('#gtotal').html(grosstotal);
        $('#bill_amount').val(grosstotal);
     $('#amount_received').val(grosstotal);
    }
    function totalgross(){
        var i;
        var table = document.getElementById('dataTable1');
    	var rowCount = table.rows.length;
        var billtype=$('#billtype:checked').val();
    console.log(billtype);
        var tpoojacount = parseInt($('#st tr').length) - 1;
        //alert(tpoojacount);
        var tot = parseInt($('#amt_100').val());
        var pr_amt=($('#parsel_amt').val() != '') ?  $('#parsel_amt').val() :  0;
        
        tot=tot+parseFloat(pr_amt);
        var pc = (tpoojacount == 0) ? 1 : tpoojacount;
        $('#total').html(tot);
        var grosstotal = tot * pc;
        console.log(pc);
        $('#gtotal').html(grosstotal);
        $('#bill_amount').val(grosstotal);
       $('#amount_received').val(grosstotal);
        if(billtype == 1){
            $('#amount_received').val(grosstotal);
            $('#balance').val(0);
        }
        else{
           $('#amount_received').val(0);
           $('#balance').val(0);
        }
        
    }

  
	$(document).on('keydown', (e) => {
     	if(e.keyCode == 9) {

        	if($("#name").is(':focus') == true){
            	// var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext";
            	// $.ajax({
            	// url: translate_url,
            	// type: 'post',
            	// dataType: "json",
            	// data: {
            	// search: $("#name").val()
            	// },
            	// success: function(data) {
            	// console.log(data)
            	// $("#name").val(data.name);
            	// }
            	// });
            
            	$("#diety_id").focus();
                return false;
        	}
        }
     })

</script>
</body>
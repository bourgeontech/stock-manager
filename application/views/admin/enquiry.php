  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Enquiry </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul">
            <li> <a href="#" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	  <hr>
      <div class="clearfix"></div>
	   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"><i class="fa fa-cube" aria-hidden="true"></i>&nbsp;&nbsp;Enquiry </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          
        </div>
	   </div>
	  </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Enquiries </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table  table-hover srp_table" width="100%" border="1">
				  <tbody>
				      <?php if(!empty($enquiry)){
				          foreach($enquiry as $e){ ?>
					<tr>
					  <td width="20%"><strong style="margin-bottom: 5px;display: block;color: #da251d;">
					      <?php echo 'Name  :  '. $e['name']; ?><br><br><br>
					      <?php echo 'Phone :  '. $e['phone']; ?><br><br><br>
					      <?php echo 'Date    :  '.$e['date']; ?></strong></td>  
					  <td width="80%"><a href="#"> 
					  <strong style="margin-bottom: 5px;display: block;color: #da251d;"><?php echo 'Subject :  '. $e['subject']; ?></strong>
						<p style="line-height: 19px; color:#000;"> <?php echo  $e['description']; ?> </p>
						</a></td>
					 </tr>
					 <?php  } } ?>
				  </tbody>
				</table>
             </div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
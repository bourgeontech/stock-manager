  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h4 class="page_txt">Pooja Muthalkootu</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp; Edit Muthalkootu </h2>
                  </div>
			   </div>
            
		       <form action="<?php echo base_url(); ?>index.php/admin/pooja/muthalkootu_update/" method="post" >
		
      <div class="form_body">
        <div class="row">
			
           <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
               <div class="col-lg-3">
        			<div class="form-group">
        			  <div class="row_form">
           				 <div class="div_label">
             				 <label class="text_label">Reference Number <span class="red">*</span> </label>
           				 </div>
                      	  <input type="hidden" name="reference_no" value="<?= $muthalkootu['reference_no']; ?>" />
           				 <input class="sq_form" placeholder=" Enter Reference Number" id="reference_no" value="<?= $muthalkootu['reference_no']; ?>"  readonly  type="text" >
						 <?php echo form_error('reference_no', '<div class="error">', '</div>'); ?>
          			</div>
        		</div>
      		</div>
                  <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">From Date <span class="red">*</span> </label>
            </div>
          	<input type="hidden" name="start_date" value="<?= $muthalkootu['from_date']; ?>" />
            <input class="sq_form" value="<?= $muthalkootu['from_date']; ?>"  readonly type="date" >
			<?php echo form_error('from_date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group">
          <div class="row_form">
            <div class="div_label">
              <label class="text_label">To Date <span class="red">*</span> </label>
            </div>
          	<input type="hidden" name="end_date" value="<?= $muthalkootu['to_date']; ?>"/>
            <input class="sq_form" value="<?= $muthalkootu['to_date']; ?>" readonly  type="date" >
			<?php echo form_error('to_date', '<div class="error">', '</div>'); ?>
          </div>
        </div>
      </div>
            <div class="col-sm-12">
				<table class="table table-bordered table-hover" width="100%">
                	<thead>
						<tr>
					  		<th scope="col" width="">Pooja</th>	
                        	<th scope="col" width="">Pooja Name in Malayalam</th>		
                    		<th scope="col" width="">Rate</th>  
                            <th scope="col" width="">Allocated Rate</th>
                        	<th scope="col" width="">Pooja Chilavu</th>
                    	</tr>
				    </thead>
                	<tbody>
                    <?php 
                      foreach($muthalkootu_poojas as $key => $val){
			
                    ?>
                        <tr>
                            <td><input type="hidden" name="pooja_id[]" value="<?php echo $val['pooja_id'];?>" > <?= $val['pooja_name']; ?></td>
                        	<td><?= $val['pooja_name_mal']; ?></td>
                            <td><input type="text" name="rate[]" value="<?= number_format((float) $val['rate'], 2, '.', '');?> " /> </td>
                        	<td><input type="text" name="allocated_rate[]" value="<?= number_format((float)$val['allocated_rate'], 2, '.', '');?> " /> </td>
                            <td><input type="text" name="pooja_cost[]" value="<?= number_format((float)$val['pooja_cost'], 2, '.', '');?>" /></td>
                        </tr>
                    <?php 
                      
                    }
                    ?>
				  </tbody>
            </table>
                
            </div>
				<div class="col-lg-12">
                <button class="btn btn-primary" type="submit" >Update</button>
                
               </div>
        </div>
      </div>
		
    </div>
			 <!--form-->
			</div> 
          </div>
               </form>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>

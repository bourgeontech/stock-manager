  <div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Role Management </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/add_role" class="btn btn-primary">Back &nbsp;&nbsp;<i class="fa fa-left-arrow" aria-hidden="true"></i></a> </li>
          </ul>
        </div>
    </div>
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Add Permission </h2>
                  </div>
			   </div>
		       <form action="<?php echo base_url(); ?>index.php/admin/admin/add_permission/<?php echo $id; ?>" method="post" >
		
      <div class="form_body">
        <div class="row">
			  <div class="col-lg-12">
                <div class="form-group">
                  <div class="row_form">
                  	<ol>
                    <?php 
                    foreach ($permission_list as $parend){
                        $this->db->select('*');
                        $this->db->from('permission');
                        $this->db->where('parent', $parend['id']);
                        $this->db->where('child', 0);
                        $childs = $this->db->get()->result_array();
                        ?>
                        
                    	<li><b><?php echo $parend['name'];?></b><ul>
    					<?php 
    					foreach ($childs as $child){
    					    $this->db->select('*');
    					    $this->db->from('permission');
    					    $this->db->where('parent', $parend['id']);
    					    $this->db->where('child', $child['id']);
    					    $sub_childs = $this->db->get()->result_array();
                            ?>
                            <li><label><input type="checkbox" class="radio" id="radio_<?php echo $child['id'];?>" name="radio[]" value="<?php echo $child['id'];?>" <?php foreach ($checked as $check){ if ($check['permission']==$child['id']){ echo "checked";}}?>>
    						<?php echo $child['name'];?></label>
    						<ol>
        					<?php 
        					foreach ($sub_childs as $sub_child){
                                ?>
                                <li><label><input type="checkbox" class="radio" id="radio_<?php echo $sub_child['id'];?>" name="radio[]" value="<?php echo $sub_child['id'];?>" <?php foreach ($checked as $check){ if ($check['permission']==$sub_child['id']){ echo "checked";}}?>>
        						<?php echo $sub_child['name'];?></label></li>
                                <?php 
                            }
                            ?>
        					</ol></li>
                            <?php 
                        }
                        ?>
    					</ul></li>
                    
                        <?php 
                    }
                    ?>
                    </ol>
                  </div>
                </div>
              </div>
           <div class="col-sm-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-success pull-right" style="margin-top:7px;">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                </div>
              </div>
        </div>
      </div>
		</form>
    </div>
			 <!--form-->
			</div> 
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
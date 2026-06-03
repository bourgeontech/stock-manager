<style type="text/css">
.submit:focus {
  background:blue;
}

</style>

<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">Billing Master</h4>
        </div>
         <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">
             Today's Collection : <?php echo $totalcollection; ?>
         </h4>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <h4 class="page_txt">
             Total Credit : <?php echo $totalcredit; ?>
         </h4>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
          </ul>
        </div>
    </div>
   <!-- <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >-->
   <!--   <div class="clearfix"></div>-->
	  <!-- <div class="row">-->
   <!--     <div class="col-lg-6 col-md-6 col-sm-6 ">-->
   <!--       <h2 class="page_txt"><i class="fa fa-tags" aria-hidden="true"></i>&nbsp;&nbsp;Billing </h2>-->
   <!--     </div>-->
   <!--     <div class="col-lg-6 col-md-6 col-sm-6 ">-->
   <!--       <ul class="btn_ul">-->
            <!-- <li> <a href="<?php// echo base_url();?>index.php/admin/admin/pooja_view" class="btn btn-primary">View &nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i></a> </li> -->
   <!--       </ul>-->
   <!--     </div>-->
	  <!-- </div>	-->
		
	  <!--</div>-->
       <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">		 
	        <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/billing" method="post" onsubmit="return validateForm()" id="myform">
               <div class="row">
                  <div class="col-lg-2 col-md-3 col-sm-3 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Bill - <?php echo $last_id;?> </h2>
                </div> 
             <div class="col-lg-1 col-md-2 col-sm-2" style="text-align:right;"> <span id="totaltop" 
                                                                                      style="color:red;font-weight:bold;font-size:20px;border:1px solid red;padding:5px;"> Bill total </span></div>
               <div class="col-lg-2 col-md-2 col-sm-2" style="text-align:right;">
               <p class="page_txt" style="vertical-align: baseline;">Bill Date </p>
               </div>  
               <div class="col-lg-2 col-md-2 col-sm-2"><?php $today=date("Y-m-d"); ?>
               		<input type="date" class="sq_form" name="date" id="bill_date" onchange="changedate()" onkeyup="changedate()" max="<?php echo $today ?>" value="<?php echo $today ?>">
               </div>
               <div class="col-lg-2 col-md-2 col-sm-2">
                   <?php if($last_bookid!=""&&$last_bookid!="0"){?>
               <select class="sq_form" id="book_id" name="book_id">
                <option value="">Select</option>
                <?php foreach($book_list as $book){?>
                    <option value="<?php echo $book['id'];?>" <?php if($last_bookid==$book['id']){ echo "selected";}?>><?php echo $book['book_no'];?></option>
                <?php }?>
                </select><?php }?>
               </div>
                 <div class="col-lg-3 col-md-3 col-sm-3">Time
                <?php echo date("h:i:sa");?>
                 <a href="#" data-toggle="modal" data-target="#exampleModal"  class="btn btn-primary" style="float:right;">Family Pooja</a>
               </div>
               
      <div class="form_body">
        <div class="row">  
		   <div class="col-lg-12">
              <div class="form-group">
                  <div class="row_form">
            	     <table class="table table-responsive-sm">
            		    <thead>
            			   <tr>
                			 <th>Diety</th>
                			 <th>Name</th>
                			 <th>Star</th>
                			 <th>Pooja</th>
                			 <th>Quantity</th>
                			 <th>Rate</th>
                			 <th>Amount</th>
                             <th>Pooja Date</th>
                			 <th>Time</th>
                			 <th style="text-align:right;"><span onclick="addRow()"><i class="fa fa-plus" style="padding: 8px;"></i></span></th>
            			</tr>
            		</thead>
            		<tbody id="dataTable2">
                		<tr>
                			<td><select name="temple[]" id="temple_100" onchange="changepooja(100)" class=" sq_form" required style="width: 3.2cm;">
                                	<option value="">Select Diety</option>
                    			<?php foreach($temple_diety_list as $val){ ?>
                    				<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			<td><input type="text" name="name[]" id="name_100" class="sq_form" placeholder="Name" value="*" required style="width: 3.2cm;"></td>
                			<td><select name="star[]" id="star_100" class="form-control <?php if($site[0]['starcode']=="1"){echo "select2-show-search";}?>" required style="width: 3.2cm;">
                                	<option value="">Select Star</option>
                    			<?php foreach($birth_star as $val){ ?>  
                    				<option value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";} echo $val['name_eng']." - ".$val['name_mal']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			<td><select name="pooja[]" id="pooja_100" onchange="change_rate(100)" onload="change_rate(100)" class="form-control <?php if($site[0]['starcode']=="1"){echo "select2-show-search";}?>" required style="width: 10cm;">
                                	<option value="">Select Pooja</option>
                    			</select>
                			</td>
                			<td><input type="hidden" value="100" id="row_value">
                			    <input type="number" min="1" name="qlt[]" onchange="change_rate(100),checkallowedqty(100)" onkeyup="change_rate(100),checkallowedqty(100)" id="qlt_100" class="sq_form" placeholder="Quatity" value="1"></td>
                			<td><input type="text" name="rate[]" id="rate_100" class="sq_form" placeholder="Rate" readonly value=""></td>
                			<td><input type="text" name="amt[]" id="amt_100" class="sq_form" onkeyup="totalcalc()" placeholder="Amount" readonly value=""></td>
                			<td><input type="date" name="date1[]" id="date_100" class="sq_form datefield" placeholder="Date" value="<?php echo date('Y-m-d');?>"  onchange="checkallowedqty(100);" onclick="checkallowedqty(100);"  style="max-width: 4.2cm;"></td>
                		    <td><select name="time[]" id="time_100"  onkeypress="return myKeyPress(event)"  class="sq_form" required style="width: 1.6cm;">
                    				<option value="M" selected="selected">M</option>
                            		<option value="N">N</option>
                    				<option value="E">E</option>
                    			</select>
                			</td>	
                        <td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>
                		</tr>
                	</tbody>
                	<tfoot>
                	    <tr>
                	        <th colspan="6" style="text-align:left">Total</th>
                	        <th style="text-align:left;padding:10px 25px" id="total">0</th>
                	        <th colspan="2"></th>
                	    </tr>
                	</tfoot>
            	</table>			
			  </div>
			</div>
			</div>
            <div class="col-md-offset-6 col-md-4">
            <div class="form-group" style="margin-top: 7px;">
                  <select id="mode" name="mode" class="sq_form" required onchange="openpaydetails()" >
                          <option value="">Select Mode</option>
                          <option value="1" selected="selected">Cash</option>
                          <option value="6">QR Code</option>
                          <option value="5">NEFT</option>
                  </select>
               </div>
            </div>
            <div class="col-md-10">
                <div class="form-group">
                   <button type="submit" onclick="formsubmit()" class="btn submit pull-right" name="save" id="100" value="print" style="margin:7px 4px;background-color:#90EE90;" onfocus="test();"> Save &amp; Print </button>
                  <!-- <button type="submit" onclick="formsubmit()" class="btn submit btn-warning pull-right" name="save" value="save" style="margin:7px 4px;"> Save </button>-->
                </div>
          </div>
         
                </div>
        
      </div>
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">Invoice Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table card-table table-vcenter table-striped">
                    <thead>
                    	<tr>
                        	<td colspan="5"><input id="myInput" type="text" class="sq_form" placeholder="Search.."></td>
                    	</tr>
                        <tr>
                            <th style="width:20%;">Sl No</th>
                            <th style="width:40%;">Name</th>
                            <th style="width:30%;">Mobile</th>
                            <th style="width:10%;"></th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php if(!empty($fpooja_list)){
	                      $i=0;
	                       foreach($fpooja_list as $val){
                           $f_id=$val['id'];
                		?>
					<tr>
					  <td><?= ++$i; ?></td>
					  <td><?= $val['name']; ?></td>
					  <td><?= $val['mobile']; ?></td>
                      <td><div class="btn-group">
						  <a href="#" onclick="add_family('<?= $f_id; ?>')" class="btn btn-outline-info" style="padding:6px;" title="Add"> <i class="fa fa-plus"></i></a></div>
                      </td>
					</tr>
                    <?php }} 
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="10">No Data Found</td>
						  </tr>
				    <?php } ?>
				  </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
	</div>
    <div class="clearfix"></div>
    <br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    // function submitform(){
    //     $('#myform').attr("target","_blank");
    //     $('#myform').submit();
    //     window.location.reload();
    // }
    // 
    //$("#temple_100").val($("#temple_100 option:first").val());
   function formsubmit(){
        $('#100').css("display",'none');
   }
    function validateForm() {
      var x = $('#temple').val();
      if (x == "") {
        alert("Diety must be filled out");
        return false;
      }
    }
    function totalcalc(){
        var i;
        var table = document.getElementById('dataTable2');
    	var rowCount = table.rows.length;
        var tot=0;
        // alert(rowCount);
        for (i = 100; i < 1000; i++) {
          if (!isNaN(parseInt($('#amt_'+i).val()))){
              tot += parseInt($('#amt_'+i).val());
          }
        }
        $('#total').html(tot);
      $('#totaltop').html(tot);
    }
    function myKeyPress(e){
        var keynum;
        e.preventDefault();
        if(window.event) { // IE                    
          keynum = e.keyCode;
        } else if(e.which){ // Netscape/Firefox/Opera                   
          keynum = e.which;
        }
        if(keynum==13){
            e.preventDefault();
            addRow();
            return false;
        }
    }   
    
    function change_rate(e){
        var pooja=$('#pooja_'+e).val();
        var qlt=$('#qlt_'+e).val();
        var url = "<?php echo base_url(); ?>index.php/admin/admin/getpoojarate";
        $.ajax({
            type: "GET",
            url: url,
            data: {'pooja': pooja},
            dataType: "json",
            success: function (data) {
              
                $.each(data, function (i, obj)
                {
                var rowcount=obj.rowcount;
                var amt=qlt*obj.rate;
                    $('#rate_'+e).val(obj.rate);
                    $('#amt_'+e).val(amt);
                    totalcalc();
                });
              
                 
              
            }
        });
        createsecondrow(data);
        checkpooja(e);
    }
    
    function checkpooja(e){
    	var pooja=$('#pooja_'+e).val();
    	 if(pooja=="2000"){
    	 	var url = '<?php echo base_url();?>index.php/welcome/getmokkolakkalludate';
    	 $.ajax({
    	 type: "POST",
    	 url: url,
    	 data: {'pooja': pooja},
    	 dataType: "json",
    	 success: function (data) {
    	 $('#date_'+e).val(data);
    	 $('#date_'+e).attr('readonly', true);
    	 }
    	 });
    	 }else{
    	 	var data='<?php echo date('Y-m-d');?>';
    	 	$('#date_'+e).val(data);
    	 $('#date_'+e).attr('readonly', false);
    	 }
    }
    
    function changedate(){
    	var bill_date=$('#bill_date').val();
    	$('#date_100').val(bill_date);
    }
    
    function changepooja(e){
        var diety=$('#temple_'+e).val();
        var poojacode='<?php echo $site[0]['poojacode']?>';
        if (diety=="8" || diety=="7"|| diety=="5"){
        	$('#amt_'+e).attr('readonly', false);
        }else{
        	$('#amt_'+e).attr('readonly', true); 
        }
        $('#pooja_'+e).html("");
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
                    if (poojacode=="0"){
                        var pooja=obj.pooja;
                    }else{
                        var pooja=obj.code+' - '+obj.pooja;
                    }
                	html +='<option value="'+obj.pooja_id+'">'+pooja+' - '+obj.pooja_mal+'</option>';
                });
                $('#pooja_'+e).append(html);
            }
        });
    }
    
    function addRow() {
    	var bill_date=$('#bill_date').val();
        var row_value=$('#row_value').val();
        var diety=$('#temple_'+row_value).val();
        var name=$('#name_'+row_value).val();
        var star=$('#star_'+row_value).val();
        row_value++;
        var html = '<tr>';
        	html +='<td><select name="temple[]" id="temple_'+row_value+'" onchange="changepooja('+row_value+')" class="js-example-basic-single sq_form" required style="width: 3.2cm;"><option value="">Select Diety</option>';
			<?php foreach($temple_diety_list as $val){ ?>
			var id="<?php echo $val['id']; ?>";
            html +='<option value="<?= $val['id']; ?>"><?= $val['name']; ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><input type="text" name="name[]" id="name_'+row_value+'" class="sq_form" placeholder="Name" value="*" required style="width: 3.2cm;"></td>';
            html +='<td><select name="star[]" id="star_'+row_value+'" class="form-control <?php if($site[0]['starcode']=="1"){echo "select2-show-search";}?>" required style="width: 3.2cm;"><option value="">Select Star</option>';
			<?php foreach($birth_star as $val){ ?>
			html +='<option value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";} echo $val['name_eng']." - ".$val['name_mal']; ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><select name="pooja[]" id="pooja_'+row_value+'" onchange="change_rate('+row_value+')" class="form-control <?php if($site[0]['starcode']=="1"){echo "select2-show-search";}?>" required style="width: 10cm;"><option value="">Select Pooja</option>';
            html +='</select></td>';
    		html +='<td><input type="number" min="1" name="qlt[]" id="qlt_'+row_value+'" onchange="change_rate('+row_value+'),checkallowedqty('+row_value+')"  onkeyup="change_rate('+row_value+'),checkallowedqty('+row_value+')" class="sq_form" placeholder="Quatity" value="1"></td>';
            html +='<td><input type="text" name="rate[]" id="rate_'+row_value+'" class="sq_form" placeholder="Rate" readonly value=""></td>';
            html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="totalcalc()" class="sq_form" placeholder="Amount" readonly value=""></td>';
            html +='<td><input type="date" name="date1[]" id="date_'+row_value+'" class="sq_form datefield" placeholder="Date" value="'+bill_date+'" onchange="checkallowedqty('+row_value+');" onclick="checkallowedqty('+row_value+');"   style="max-width: 4.2cm;"></td>';        
            html +='<td><select name="time[]" id="time_100" class="js-example-basic-single sq_form" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
			html +='<option value="M"  selected="selected">M</option><option value="N">N</option><option value="E">E</option></select></td>';
           
            html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            html +='</tr>';
           
    		$('#dataTable2').append(html);
    		$('#row_value').val(row_value);
    		$('#temple_'+row_value).val(diety);
    		$('#name_'+row_value).val(name);
    		$('#star_'+row_value).val(star);
            <?php if($site[0]['starcode']=="1"){?>
            $('#pooja_'+row_value).select2();
            $('#star_'+row_value).select2();
            <?php }?>
    		$('#temple_'+row_value).focus();
    		changepooja(row_value);
    		totalcalc();
    }
    
    function add_family(fid) {
    	var bill_date=$('#bill_date').val();
        var row_value=$('#row_value').val();
        $('#dataTable2').html("");
        var html;
        var url = '<?php echo base_url();?>index.php/admin/admin/getfpoojabyfid';
    	$.ajax({
            type: "POST",
            url: url,
            data: {'fid': fid},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                	html += '<tr>';
        			html +='<td><select name="temple[]" id="temple_'+row_value+'" onchange="changepooja('+row_value+')" class="js-example-basic-single sq_form" required style="width: 3.2cm;">';
            		html +='<option value="'+obj.diety+'">'+obj.diety_nm+'</option>';
           			html +='</select></td>';
            		html +='<td><input type="text" name="name[]" id="name_'+row_value+'" class="sq_form" placeholder="Name" value="'+obj.name+'" required style="width: 3.2cm;" readonly></td>';
            		html +='<td><select name="star[]" id="star_'+row_value+'" class="js-example-basic-single sq_form" required style="width: 3.2cm;">';
            		html +='<option value="'+obj.star+'">'+obj.star_nm+'</option>';
            		html +='</select></td>';
            		html +='<td><select name="pooja[]" id="pooja_'+row_value+'" onchange="change_rate('+row_value+')" class="select2 sq_form" required style="width: 3.2cm;">';
                	html +='<option value="'+obj.pooja+'">'+obj.pooja_nm+'</option>';
            		html +='</select></td>';
    				html +='<td><input type="number" min="1" name="qlt[]" id="qlt_'+row_value+'" onchange="change_rate('+row_value+'),checkallowedqty('+row_value+')"  onkeyup="change_rate('+row_value+'),checkallowedqty('+row_value+')" class="sq_form" placeholder="Quatity" readonly value="'+obj.nos+'"></td>';
            		html +='<td><input type="text" name="rate[]" id="rate_'+row_value+'" class="sq_form" placeholder="Rate" readonly value="'+obj.rate+'"></td>';
            		html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="totalcalc()" class="sq_form" placeholder="Amount" readonly value="'+obj.amount+'"></td>';
            		html +='<td><input type="date" name="date1[]" id="date_'+row_value+'" class="sq_form datefield" placeholder="Date" value="'+bill_date+'" onchange="checkallowedqty('+row_value+');" onclick="checkallowedqty('+row_value+');"   style="max-width: 4.2cm;"></td>';        
            		html +='<td><select name="time[]" id="time_100" class="js-example-basic-single sq_form" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
					html +='<option value="M"  selected="selected">M</option><option value="N">N</option><option value="E">E</option></select></td>';
           
            		html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            		html +='</tr>';
        			row_value++;
                });
                $('#dataTable2').append(html);
            	totalcalc();
            }
        });
    }
    
    function remove_file_row(obj){
    	$(obj).closest('tr').remove();
    	totalcalc()
    	return false;
    }
   
    function deleteRow(tableID) {
    	try {
    	var table = document.getElementById(tableID);
    	var rowCount = table.rows.length;

    	for(var i=0; i<rowCount; i++) {
    		var row = table.rows[i];
    		var chkbox = row.cells[0].childNodes[0];
    		if(null != chkbox && true == chkbox.checked) {
    			if(rowCount <= 1) {
    				alert("Cannot delete all the rows.");
    				break;
    			}
    			table.deleteRow(i);
    			rowCount--;
    			i--;
    		}


    	}
    	}catch(e) {
    		alert(e);
    	}
    }
    
    //for datepicker
    //
    function checkallowedqty(e){
    
       var url = '<?php echo base_url();?>index.php/admin/admin/getallowedqty';
       var pooja_id = $('#pooja_'+e).val();
       var date = $('#date_'+e).val();
       var qty = $('#qlt_'+e).val();
       $.ajax({
            type: "GET",
            url: url,
            data: {'pooja_id': pooja_id,'date':date,'qty':qty},
            success: function (data) {
               if(data == 1){
                  alert('Limit Exceeded!');
               }
            }
        });
    }
    
    function test()
    {
    	$('#100').css("background-color",'red')
    
    }
    
    function createsecondrow(data){
    
        if(data.rowcount>1){
            var bill_date=$('#bill_date').val();
            var starcode =' <?php echo $site[0]['starcode'];?>';
            var name = $('table.dataTable2 tbody tr:nth-child(1)').find('.name').val();
            var star = $('table.dataTable2 tbody tr:nth-child(1)').find('.star').val();
            name = (typeof name === 'undefined') ? '*' : name;
            star = (typeof star === 'undefined') ? '28' : star;
            var toggleamtreadonly = (data.diety!='9000') ? 'readonly' : '';
            var newRow = $("<tr>");
            var cols = '';
            cols += '<td>' + data.pooja + '<input name="pooja[]" value="' + data.pooja_id + '" class="pooja_code" type="hidden" required/>'; 
            cols += '<input type="hidden" name="temple[]" value="'+data.diety+'" /></td>';
            cols += '<td><input class="sq_form name"  name="name[]"  value="'+ name +'" type="text" style="width: 120px;" required/></td>';
            cols +='<td><select name="star[]"  class="sq_form star" required style="width: 3.2cm;"><option value="0">Select Star</option>';
            <?php foreach($birth_star as $val){ ?>
            cols +='<option <?php echo ($val['id'] == 28) ? 'selected' : ''; ?> value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";}?><?= $val['name_eng']." - ".$val['name_mal']; ?></option>';
            <?php } ?>
            cols += '<td><input class="sq_form qty"  name="qlt[]"  value="1" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="width: 60px;" required/></td>';
            cols += '<td><input readonly class="sq_form rate" name="rate[]" value="0"  style="width: 60px;" required/></td>';
            cols += '<td><input  class="sq_form amt" name="amt[]" value="0.00" type="number" style="width: 70px;" required '+toggleamtreadonly+'/></td>';
            cols +='<td><input type="date" name="date1[]" class="sq_form" value="'+bill_date+'" placeholder="Date" style="max-width: 4.2cm;"></td>';        
            cols +='<td><select name="time[]" id="time_100" class="js-example-basic-single sq_form" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
            cols +='<option value="M"  selected="selected">M</option><option value="N">N</option><option value="E">E</option></select></td>';
            cols +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            newRow.append(cols);
            $("table.dataTable2 tbody").prepend(newRow);
            rowindex = newRow.index();
            calculateRowPoojaData(rowindex);
            $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.star').val(star);
            var obj = $('table.dataTable2 tbody tr:nth-child(' + (rowindex + 1) + ')').find('.name');
            obj.val(obj.val());
            obj.focus().select();
        }
   }
    document.addEventListener("keydown", function(e) {
        if($("#mode").is(':focus') == true){
           if(e.keyCode == 9){
               e.preventDefault();
               $('#100').focus().select();
               $('#100').css("background-color",'red')
           }
        }
        if($('.datefield').is(':focus') == true){
            if(e.keyCode == 13){
               e.preventDefault();
            }
        }
    });
$(document).ready(function(){
  $("div").removeClass("container");
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
    
    </script>
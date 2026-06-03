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
          <h4 class="page_txt">Edit</h4>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 ">
          <ul class="btn_ul" style="float:right;">
            <li> <a href="<?php echo base_url();?>index.php/admin/admin/billing_view/1" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
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
	        <form action="<?php echo base_url(); ?>index.php/admin/admin/edit_mode/<?php echo $bill_id;?>" method="post" onsubmit="return validateForm()" id="myform">
               <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2 ">
                    <h2 class="page_txt"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Bill - <?php echo $bill_id;?> </h2>
                </div> 
                <div class="col-lg-2 col-md-2 col-sm-2">
                     <label class="radio-inline">
                        <input type="radio" name="optradio" value="1" checked>Cash
                     </label>
                     <label class="radio-inline">
                        <input type="radio" name="optradio" value="2">Credit
                     </label>
                  </div>
               <div class="col-lg-2 col-md-2 col-sm-2" style="text-align:right;">
               <p class="page_txt" style="vertical-align: baseline;">Bill Date </p>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-4"><?php $today=date("Y-m-d"); ?>
               		<input type="date" class="sq_form" name="date" id="bill_date" max="<?php echo $today ?>" value="<?php echo $bill_list[0]['date'] ?>">
               </div>
                 <div class="col-lg-2 col-md-2 col-sm-2">Time
                <?php echo date("h:i:sa");?>
               </div>
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
                    <?php  $i=100;
                    if(!empty($bill_dtls)){
                      
                        foreach($bill_dtls as $key=>$dtls){
                        ?>
                		<tr>
                			<td><select name="temple[]" id="temple_<?= $i;?>" class=" sq_form" required style="width: 3.2cm;" disabled>
                                	<option value="">Select Diety</option>
                    			<?php foreach($temple_diety_list as $val){ ?>
                    				<option value="<?= $val['id']; ?>" <?php if($dtls['diety_id']==$val['id']){ echo "selected";}?>><?= $val['name']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			<td><input type="text" name="name[]" id="name_<?= $i;?>" class="sq_form" placeholder="Name" value="<?php echo $dtls['name'];?>" required style="width: 3.2cm;" ></td>
                			<td><select name="star[]" id="star_<?= $i;?>" class=" sq_form" required style="width: 3.2cm;" >
                                	<option value="">Select Star</option>
                    			<?php foreach($birth_star as $val){ ?>  
                    				<option value="<?= $val['id']; ?>" <?php if($dtls['star']==$val['id']){ echo "selected";}?>><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";} echo $val['name_eng']." - ".$val['name_mal']; ?></option>
                    			<?php } ?>
                    			</select>
                			</td>
                			<td><select name="pooja[]" id="pooja_<?= $i;?>" onchange="change_rate('<?= $i;?>')" onload="change_rate('<?= $i;?>')" class="sq_form" required style="width: 10cm;" disabled>
                                	<option value="">Select Pooja</option>
                                    <?php foreach($pooja_list as $pooja){ ?>  
                                        <option value="<?= $pooja['id']; ?>" <?php if($dtls['pooja']==$pooja['id']){ echo "selected";}?>><?php echo $pooja['name']." - ".$pooja['name_mal']; ?></option>
                                    <?php } ?>
                    			</select>
                			</td>
                			<td><input type="hidden" value="<?=$i;?>" id="row_value">
                			    <input type="number" min="1" name="qlt[]" onchange="change_rate('<?= $i;?>'),checkallowedqty('<?= $i;?>')" onkeyup="change_rate('<?= $i;?>'),checkallowedqty('<?= $i;?>')" id="qlt_<?= $i;?>" class="sq_form" placeholder="Quatity" value="<?php echo $dtls['qlt'];?>" disabled></td>
                			<td><input type="text" name="rate[]" id="rate_<?= $i;?>" class="sq_form" placeholder="Rate" readonly value="<?php echo $dtls['rate'];?>" disabled></td>
                			<td><input type="text" name="amt[]" id="amt_<?= $i;?>" class="sq_form" onkeyup="totalcalc()" placeholder="Amount" readonly value="<?php echo $dtls['amount'];?>"></td>
                			<td><input type="date" name="date1[]" id="date_<?= $i;?>" class="sq_form datefield" placeholder="Date" value="<?php echo $dtls['date'];?>"  onchange="checkallowedqty('<?= $i;?>');" onclick="checkallowedqty('<?= $i;?>');"  style="max-width: 4.2cm;" disabled></td>
                		    <td><select name="time[]" id="time_<?= $i;?>"  onkeypress="return myKeyPress(event)"  class="sq_form" required style="width: 1.6cm;" disabled>
                    				<option value="M" <?php if($dtls['time']=="M"){ echo "selected";}?>>M</option>
                    				<option value="E" <?php if($dtls['time']=="E"){ echo "selected";}?>>E</option>
                    			</select>
                			</td>	
                        <td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>
                		</tr>
                        <?php
                         $i++;
                        }
                    }?>
                    <input type="hidden" value="<?= $i;?>" id="row_value">
                	</tbody>
                	<tfoot>
                	    <tr>
                	        <th colspan="6" style="text-align:left">Total</th>
                	        <th style="text-align:left;padding:10px 25px" id="total"><?php echo $bill_list[0]['total']; ?></th>
                	        <th colspan="2"></th>
                	    </tr>
                	</tfoot>
            	</table>			
			  </div>
			</div>
			</div>
            <div class="col-md-offset-6 col-md-4">
            <div class="form-group" style="margin-top: 7px;" id="paymenttable">
                  <select id="mode" name="mode" class="sq_form" required onchange="openpaydetails()" >
                          <option value="">Select Mode</option>
                          <option value="1" <?php if($bill_list[0]['mode']=="1"){ echo "selected";}?>>Cash</option>
                          <option value="6" <?php if($bill_list[0]['mode']=="6"){ echo "selected";}?>>QR Code</option>
                          <option value="5" <?php if($bill_list[0]['mode']=="5"){ echo "selected";}?>>NEFT</option>
                  </select>
               </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                   <button type="submit" onclick="formsubmit()" class="btn submit btn-warning pull-right" name="save" value="save" style="margin:7px 4px;"> Save </button>
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
    $('input[type=radio][name=optradio]').change(function() {
        if (this.value == '2') {
            $('#paymenttable').hide();
        }
        else if (this.value == '1') {
            $('#paymenttable').show();
        }
    });
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
                    var amt=qlt*obj.rate;
                    $('#rate_'+e).val(obj.rate);
                    $('#amt_'+e).val(amt);
                    totalcalc();
                });
            }
        });
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
            html +='<td><select name="star[]" id="star_'+row_value+'" class="js-example-basic-single sq_form" required style="width: 3.2cm;"><option value="">Select Star</option>';
			<?php foreach($birth_star as $val){ ?>
			html +='<option value="<?= $val['id']; ?>"><?php if($site[0]['starcode']=="1"){echo $val['id']." - ";} echo $val['name_eng']." - ".$val['name_mal']; ?></option>';
			<?php } ?>
            html +='</select></td>';
            html +='<td><select name="pooja[]" id="pooja_'+row_value+'" onchange="change_rate('+row_value+')" class="select2 sq_form" required style="width: 10cm;"><option value="">Select Pooja</option>';
            html +='</select></td>';
    		html +='<td><input type="number" min="1" name="qlt[]" id="qlt_'+row_value+'" onchange="change_rate('+row_value+'),checkallowedqty('+row_value+')"  onkeyup="change_rate('+row_value+'),checkallowedqty('+row_value+')" class="sq_form" placeholder="Quatity" value="1"></td>';
            html +='<td><input type="text" name="rate[]" id="rate_'+row_value+'" class="sq_form" placeholder="Rate" readonly value=""></td>';
            html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="totalcalc()" class="sq_form" placeholder="Amount" readonly value=""></td>';
            html +='<td><input type="date" name="date1[]" id="date_'+row_value+'" class="sq_form datefield" placeholder="Date" value="'+bill_date+'" onchange="checkallowedqty('+row_value+');" onclick="checkallowedqty('+row_value+');"   style="max-width: 4.2cm;"></td>';        
            html +='<td><select name="time[]" id="time_'+row_value+'" class="js-example-basic-single sq_form" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
			html +='<option value="M"  selected="selected">M</option><option value="E">E</option></select></td>';
           
            html +='<td><i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i></td>';
            html +='</tr>';
    		$('#dataTable2').append(html);
    		$('#row_value').val(row_value);
    		$('#temple_'+row_value).val(diety);
    		$('#name_'+row_value).val(name);
    		$('#star_'+row_value).val(star);
    		$('#temple_'+row_value).focus();
    		changepooja(row_value);
    		totalcalc();
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
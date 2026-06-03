    <?php $transaction_id = $site[0]['store_transaction_id']; ?>
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff !important;
            border: 1px solid #d1d1dc !important;
        }
	</style>
    <div class="side_right">
        <div class="mt-2"></div>
        <div class="clearfix"></div>
        <div class="page-header">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <h4 class="page_txt">Billing Master</h4>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="form-check form-check-inline" id="billing_type_check">
                    <input class="form-check-input billing_type_check" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="N" checked>
                    <label class="form-check-label" for="inlineRadio1">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input billing_type_check" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="M">
                    <label class="form-check-label" for="inlineRadio2">Manual</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input billing_type_check" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="A">
                    <label class="form-check-label" for="inlineRadio3">Mobile App</label>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 ">
                <h4 class="page_txt">
                    Today's Collection : <?php echo $totalcollection; ?>
                </h4>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 ">
              <ul class="btn_ul" style="float:right;">
                <li> <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a> </li>
              </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 ">		 
                <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
                    <form action="<?php echo base_url(); ?>index.php/admin/admin/billing" method="post" onsubmit="return validateForm()" class="billingForm" id="myform">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 ">
                                <h2 class="page_txt row">
                                    <div class="col-md-6"> 
                                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp;
                                        Bill - 
                                    </div>
                                    <div class="col-md-6"> 
                                        <span id="bill_no_span"><?php echo $last_id;?></span> 
                                        <input type="text" name="bill_no" value="<?php echo $last_id;?>" class="form-control d-none" id="bill_no_input" /> 
                                    </div>
                                </h2>
                                <input type="hidden" value="N" name="bill_type" />
                            </div> 
                            <div class="col-lg-1 col-md-2 col-sm-2" style="text-align:right;"> 
                                <span id="totaltop" style="color:red;font-weight:bold;font-size:20px;border:1px solid red;padding:5px;"> Bill total </span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2" style="text-align:right;">
                                <p class="page_txt" style="vertical-align: baseline;">Bill Date </p>
                            </div> 
                            <div class="col-lg-2 col-md-2 col-sm-2"><?php $today=date("Y-m-d"); ?>
                                    <input type="date" class="form-control" name="date" id="bill_date" onchange="changedate()" onkeyup="changedate()" max="<?php echo $today ?>" value="<?php echo $today ?>">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <?php if($last_bookid!=""&&$last_bookid!="0"){?>
                                <select class="form-control" id="book_id" name="book_id">
                                    <option value="">Select</option>
                                    <?php foreach($book_list as $book){?>
                                    <option value="<?php echo $book['id'];?>" <?php if($last_bookid==$book['id']){ echo "selected";}?>><?php echo $book['book_no'];?></option>
                                    <?php }?>
                                </select>
                                <?php }?>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                Time <?php echo date("h:i:sa");?>
                                <a href="#" data-toggle="modal" data-target="#exampleModal"  class="btn btn-primary" style="float:right;">Family Pooja</a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">Bill Total
                                <th style="text-align:left;padding:10px 25px" id="totaltop">0</th>
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
                                                        <th>Pooja</th>
                                                        <th>Name</th>
                                                        <th>Star</th>
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
                                                        <td>
                                                            <select name="temple[]" id="temple_1" onchange="getPooja(event)" onload="getPooja(event)" class="form-control deity"  required style="width: 3.2cm;">
                                                                <option disabled value="">Select Diety</option>
                                                                <?php foreach($temple_diety_list as $val){ ?>
                                                                <option value="<?= $val['id']; ?>"><?= $val['name']; ?> </option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12 text-danger">
                                                            <?php echo $this->session->flashdata('error_view'); ?>
                                                            </div>
                                                            <select name="pooja[]" id="pooja_1" onchange="getPoojaRate(event)" onload="getPoojaRate(event)" class="form-control js-example-basic-single pooja" required style="width: 10cm;">
                                                                <option value="">Select Pooja</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="name[]" id="name_1" class="form-control name" placeholder="Name" value="*" required style="width: 3.2cm;">
                                                        </td>
                                                        <td>
                                                            <select name="star[]" id="star_1" class="form-control js-example-basic-single star" required style="width: 3.2cm;">
                                                                <option value="28">nodata</option>
                                                                <?php foreach($birth_star as $val){ ?>  
                                                                <option value="<?= $val['id']; ?>">
                                                                	<?php if($site[0]['starcode'] == 1) { 
																			echo $val['id']." - ";
																		  } 
                                                                          echo $val['name_eng']." - ".$val['name_mal']; 
                                                                	?> 
                                                                	( <?= $val['id']; ?> )
                                                            	</option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" min="1" name="qlt[]" onchange="getPoojaRate(event)" onkeyup="getPoojaRate(event)" id="qty_1" class="form-control qty" placeholder="Quatity" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="rate[]" id="rate_1" class="form-control rate" placeholder="Rate" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="amt[]" id="amt_1" class="form-control amount" onkeyup="calculateGrandTotal()" placeholder="Amount" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="date" name="date1[]" id="date_1" class="form-control date" placeholder="Date" value="<?php echo date('Y-m-d');?>" style="max-width: 4.2cm;">
                                                        </td>
                                                        <td>
                                                            <select name="time[]" id="time_1"  onkeypress="return myKeyPress(event)"  class="form-control time" required style="width: 1.6cm;">
                                                                <option value="M" >M</option>
                                                                <option value="A" >A</option>
                                                                <option value="N" >N</option>
                                                                <option value="E" >E</option>
                                                            </select>
                                                        </td>	
                                                        <td>
                                                            <i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i>
                                                        </td>
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
                                    <div class="form-group" style="margin-top: 7px;" id="paymenttable">
                                        <select id="mode" name="mode" class="form-control" required onchange="openpaydetails()" >
                                            <option value="">Select Mode</option>
                                            <option value="1" selected="selected">Cash</option>
                                            <option value="6">QR Code</option>
                                            <option value="5">NEFT</option>
                                            <option value="7">Card</option>
                                            <option value="8">MO</option>
                                            <option value="9">Mobile App</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-offset-6 col-md-4">
                                    <input type="text" class="form-control" id="transaction_id" placeholder="Transaction ID" name="transaction_id" />
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn pull-right d-none"  name="save" id="add_adjustment_item" value="add_item" style="margin:7px 4px;background-color:#90EE90;" > Add Item </button>
                                        <button type="button" onclick="formsubmit('save');" class="btn submit pull-right" name="save" id="save_btn" value="print" style="margin:7px 4px;background-color:#90EE90;" onfocus="test();"> Save &amp; Print </button>                
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
                                                    <td colspan="5"><input id="myInput" type="text" class="form-control" placeholder="Search.."></td>
                                                </tr>
                                                <tr>
                                                    <th style="width:20%;">Sl No</th>
                                                    <th style="width:40%;">Name</th>
                                                    <th style="width:30%;">Mobile</th>
                                                    <th style="width:10%;"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="myTable">
                                                <?php 
                                                    if(!empty($fpooja_list)){
                                                        $i=0;
                                                        foreach($fpooja_list as $val){
                                                            $f_id=$val['id'];
                                                ?>
                                                <tr>
                                                    <td><?= ++$i; ?></td>
                                                    <td><?= $val['name']; ?></td>
                                                    <td><?= $val['mobile']; ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="#" onclick="add_family('<?= $f_id; ?>')" class="btn btn-outline-info" style="padding:6px;" title="Add"> <i class="fa fa-plus"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php   
                                                        }
                                                    } 
                                                    else { 
                                                ?>
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
            </div> 
        </div>
    </div>

    <div class="clearfix"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>

	<script>
    	var rowAdded = false;
    	var flag = false;
        var availabilityChecked = false;
    
        function setDefault() {
            $('#pooja_100').focus().select();
        }
        window.onload = setDefault;

        
        const checkPoojaAvailability = (pooja_id, date, qty) => {
            return new Promise((resolve, reject) => {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/admin/admin/check_pooja_availability",
                    data: {'pooja_id': pooja_id,'date':date, 'qty': qty},
                    success: function (data) {
                        let pooja_date = new Date(date)
                        let year = pooja_date.getFullYear()
                        let month = pooja_date.getMonth()
                        let day = pooja_date.getDate()
                        
                        let format2 = day + "/" + month + "/" + year;
                        data = JSON.parse(data)
                        
                        if(data.exists && data.exists == 1){
                            if(data.qty) {
                                alert('Limit exceeded for '+data.pooja+' on '+format2+'. Current quantity is '+data.qty);
                            } else {
                                alert('Limit exceeded for '+data.pooja+' on '+format2);
                            }
                            
                            resolve(false);
                        } else {
                                resolve(true);
                        }
                    },
                    error: function () {
                        reject(new Error('Failed to check product availability'));
                    }
                });
            })
        }
        
        $('.billing_type_check').on('change', (e) => {
            $('[name="bill_type"]').val(e.target.value)
            console.log(e.target.value)
            if (e.target.value == 'N') {
                console.log($('#bill_no_span'))
                $('#bill_no_span').removeClass('d-none')
                $('#bill_no_input').addClass('d-none')
            } else {
                $('#bill_no_span').addClass('d-none')
                $('#bill_no_input').removeClass('d-none')
            }
        
            if(e.target.value == 'A') {
                let options = $('#mode')[0].options;
                    for (var i = 0; i < options.length; i++) {
                          var option = options[i];
                          option.value == 9 ? ( option.selected = 'selected' ) : ( option.selected = '' )
                    }
            } else {
                let options = $('#mode')[0].options;
                    for (var i = 0; i < options.length; i++) {
                          var option = options[i];
                          option.value == 1 ? ( option.selected = 'selected' ) : ( option.selected = '' )
                    }
            }
        })
        
        
        $('.sq_form.datefield').on('change', (e) => {
            var $row = $(e.target).closest('tr'); // Get the closest row element
            var pooja_id = $row.find('.pooja_id').val();
            var date = e.target.value;
               var qty = $row.find('.qty').val();
            checkPoojaAvailability(pooja_id, date, qty)
        });
        
        
        $(document).on('focus', '.name', function() {
       var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext";
      $(this).autocomplete({
        source: function(request, response) {
          $.ajax({
            url: translate_url,
             type: 'post',
            dataType: 'json',
            data: {
              search: request.term
            },
            success: function(data) {
              response(data);
            }
          });
        },
        minLength: 2
      });
    });
        // function submitform(){
        //     $('#myform').attr("target","_blank");
        //     $('#myform').submit();
        //     window.location.reload();
        // }
        // 
        $('body').on('click','.pdfPrint',function() {
       
            $(this).attr("disabled", true);
            setInterval(function () {
                location.reload();
            }, 1000);
        });
        
        
      $('.time').on('keydown', function(e) {
        if (e.key === 'a' || e.key === 'A') {
          $(this).val('A');
        }
          else if (e.key === 'm' || e.key === 'M') {
          $(this).val('M');
        }
          else if (e.key === 'n' || e.key === 'N') {
          $(this).val('N');
        }
          else if (e.key === 'e' || e.key === 'E') {
          $(this).val('E');
        }
      });
        
        function submitFormFn() {
            var promises = [];
            $('#dataTable2 tr').each((i, e) => {
                var $row = $(e)
                var pooja_id = $row.find('.pooja_id').val();
                var date = $row.find('.datefield').val();
                var qty = $row.find('.qty').val();
                var promise = checkPoojaAvailability(pooja_id, date, qty);
                promises.push(promise);
            });
       
               Promise.all(promises)
        .then(results => {
          var flag = results.every(result => result === true);
          if (flag == true) {
              $('button.submit').attr('type', 'submit');
              $('button.submit').attr('data-availability_check', true);
              $('button.submit').trigger('click');
          } 
        })
        .catch(error => {
          console.error(error);
        });
        }
        
        $('button.submit').on('click', (e) => {
            let availabilityChecked = e.target.getAttribute('data-availability_check');
            if(!availabilityChecked)
                submitFormFn()
        })
    
        
       function formsubmit(val){
               if(val === 'print'){
               setInterval(function () {
                   window.location.reload();
               }, 1000);
               }
            
               // $('#save_btn').css("display",'none');
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
    	/***
    	 * Calculate Grand Total
    	 ***/
    	function calculateGrandTotal(){
            var $tbody = $('#dataTable2');
            var $tr	   = $tbody.find('tr')
            
            let total  = 0
            
            $tr.each((i, e) => { 
            	let amount = $(e).find('.amount').val()
              	if (!isNaN(parseInt(amount))){
              		total += parseInt(amount);
              	}
            })
        
            $('#total').html(total);
            $('#totaltop').html(total);
        }
    
    	/***
    	 * Check if Pooja is Mukkolakallu and change date
    	 ***/
    	function checkForMukkolakallu(e){
        	 var $row 	= $(e.target).closest('tr')
             var pooja	= $row.find('.pooja').val();
        	 var $date	= $row.find('.date')
             if(pooja == 2000) {
                var url = '<?php echo base_url();?>index.php/welcome/getmokkolakkalludate';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {'pooja': pooja},
                    dataType: "json",
                    success: function (data) {
                        $date.val(data);
                        $date.attr('readonly', true);
                    }
                });
            } else {
                var date ='<?php echo date('Y-m-d');?>';
                $date.val(date);
                $date.attr('readonly', false);
            }
        }
    
    	/***
    	 * Check rowcount of Pooja
    	 ***/
    	function checkRowAdd(e){
            var $row 	= $(e.target).closest('tr')
            var pooja	= $row.find('.pooja').val();
            var url 		= "<?php echo base_url(); ?>index.php/admin/admin/getPoojaById"; 
            $.ajax({
                type: "POST",
                url: url,
                data: {'pooja': pooja},
                dataType: "json",
                success: function (data) {
                    if (data.rowcount > 1 && !rowAdded) {
                		addSecondRow(data);
                		rowAdded = true; 
            		}
                }
            });
        }
    
    	/***
    	 * Get Pooja List
    	 ***/
		function getPooja(e, pooja_selected = null) {
			var deity		= e.target ?? e
            var deity_id	= deity.value;
            var poojacode	= '<?php echo $site[0]['poojacode']?>';
        	var $row		= $(deity).closest('tr')
            var $amount		= $row.find('.amount')
            var $pooja		= $row.find('.pooja')
            let pooja 		= pooja_selected ?? 0
            // Amount field is readonly for pooja under Donation
            if (deity_id == 8 || deity_id == 7 || deity_id == 5){
                $amount.attr('readonly', false);
            }
            else{
                $amount.attr('readonly', true);
            }
            
        	// If deity is Nadavaravu or Thulabharam, add adjustment also
            if(deity_id == 100 || deity_id == 200) {
                $('#add_adjustment_item').removeClass('d-none');
                $('#save_btn').addClass('d-none');
            } else {
                $('#add_adjustment_item').addClass('d-none');
                $('#save_btn').removeClass('d-none');
            }
                  
        	$pooja.html('');
            var html = '<option value="0">Please Select</option>';
            var url  = '<?php echo base_url();?>index.php/admin/admin/getpoojasbydiety';
            $.ajax({
                type: "POST",
                url: url,
                data: {'diety': deity_id},
                dataType: "json",
                success: function (data) {
                
                    $.each(data, function (i, obj)
                    {
                        if (poojacode=="0"){
                            var pooja_name = obj.pooja;
                        }else{
                            var pooja_name = obj.code+' - '+obj.pooja;
                        }
                        html +='<option value="'+obj.pooja_id+'">'+pooja_name+' - '+obj.pooja_mal+' ('+obj.code+')</option>';
                    });
                    $pooja.append(html);
                    $pooja.val(pooja).trigger('change.select2');
                }
            });
        }
    
    	/***
    	 * Get Pooja Rate
    	 ***/
		function getPoojaRate(e) {
        	var $row 	= $(e.target).closest('tr')
            var date 	= $row.find('.date').val();
            var pooja	= $row.find('.pooja').val();
            var qty		= $row.find('.qty').val();
        	var $rate 	= $row.find('.rate')
            var $amount = $row.find('.amount')
            var $time 	= $row.find('.time')
            var url 	= "<?php echo base_url(); ?>index.php/admin/admin/getpoojarate";
        
            $.ajax({
                type: "GET",
                url: url,
                data: {'pooja': pooja},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var amount = qty * obj.rate;
                        $rate.val(obj.rate);
                        $amount.val(amount);
                        $time.val(obj.time);
                    
                    	calculateGrandTotal();
                    });
                }
            });
        
            checkForMukkolakallu(e);
            checkRowAdd(e);
        }
    
    	/***
    	 * Add new row
    	 ***/
    	function addRow() {
        	var $tbody   = $('#dataTable2');
            var $tr	   	 = $tbody.find('tr:last')
            var index	 = $tr.index();
            var deity_id = $tr.find('.deity').val()
            var pooja_id = $tr.find('.pooja').val()
            var star_id  = $tr.find('.star').val()
            var name  	 = $tr.find('.name').val()
            var pooja_date  = $tr.find('.date').val()
            var pooja_time  = $tr.find('.time').val()
            
            var htmlCode = `
                            <tr>
                                <td>
                                    <select name="temple[]" id="temple_${index}" onchange="getPooja(event)" onload="getPooja(event)" class="form-control deity"  required style="width: 3.2cm;">
                                        <option disabled value="">Select Diety</option>
                                        <?php foreach($temple_diety_list as $val){ ?>
                                        <option value="<?= $val['id']; ?>"><?= $val['name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <div class="col-md-12 text-danger">
                                    <?php echo $this->session->flashdata('error_view'); ?>
                                    </div>
                                    <select name="pooja[]" id="pooja_${index}" onchange="getPoojaRate(event)" onload="getPoojaRate(event)" class="form-control js-example-basic-single pooja" required style="width: 10cm;">
                                        <option value="">Select Pooja</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="name[]" id="name_${index}" class="form-control name" placeholder="Name" value="*" required style="width: 3.2cm;">
                                </td>
                                <td>
                                    <select name="star[]" id="star_${index}" class="form-control js-example-basic-single star" required style="width: 3.2cm;">
                                        <option value="28">nodata</option>
                                        <?php foreach($birth_star as $val){ ?>  
                                        <option value="<?= $val['id']; ?>">
                                            <?php if($site[0]['starcode'] == 1) { 
                                                    echo $val['id']." - ";
                                                } 
                                            echo $val['name_eng']." - ".$val['name_mal']; 
                                            ?> 
                                            ( <?= $val['id']; ?> )
                                        </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" min="1" name="qlt[]" onchange="getPoojaRate(event)" onkeyup="getPoojaRate(event)" id="qty_${index}" class="form-control qty" placeholder="Quatity" value="1">
                                </td>
                                <td>
                                    <input type="text" name="rate[]" id="rate_${index}" class="form-control rate" placeholder="Rate" readonly>
                                </td>
                                <td>
                                    <input type="text" name="amt[]" id="amt_${index}" class="form-control amount" onkeyup="calculateGrandTotal()" placeholder="Amount" readonly>
                                </td>
                                <td>
                                    <input type="date" name="date1[]" id="date_${index}" class="form-control date" placeholder="Date" value="<?php echo date('Y-m-d');?>" style="max-width: 4.2cm;">
                                </td>
                                <td>
                                    <select name="time[]" id="time_${index}" class="form-control time" required style="width: 1.6cm;">
                                        <option value="M" >M</option>
                                        <option value="A" >A</option>
                                        <option value="N" >N</option>
                                        <option value="E" >E</option>
                                    </select>
                                </td>   
                                <td>
                                    <i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i>
                                </td>
                            </tr>
                        `;
			$tbody.append(htmlCode)
        
        	$row   = $tbody.find('tr:last')
        	$pooja = $row.find('.pooja')
        	$star  = $row.find('.star')
        	$date  = $row.find('.date')
        	$time  = $row.find('.time')
        
        	let deity = $row.find('.deity')
        	$(deity).val(deity_id).change()
        	$pooja.select2()
        	getPooja(deity, pooja_id)
        	$star.select2()
        	$star.val(star_id).trigger('change.select2');

        	$row.find('.time').val(pooja_time)
        	$row.find('.name').val(name).focus().select()
        }
    
    	/***
    	 * Add new row
    	 ***/
    	function addSecondRow() {
        	rowAdded	 = false;
        	var $tbody   = $('#dataTable2');
            var $tr	   	 = $tbody.find('tr:last')
            var index	 = $tr.index();
            var deity_id = $tr.find('.deity').val()
            var pooja_id = $tr.find('.pooja').val()
            var star_id  = $tr.find('.star').val()
            var name  	 = $tr.find('.name').val()
            
            var pooja_date  = $tr.find('.date').val()
            var pooja_time  = $tr.find('.time').val()
            
            var htmlCode = `
                            <tr>
                                <td>
                                    <select name="temple[]" id="temple_${index}" onchange="getPooja(event)" onload="getPooja(event)" class="form-control deity"  required style="width: 3.2cm;">
                                        <option disabled value="">Select Diety</option>
                                        <?php foreach($temple_diety_list as $val){ ?>
                                        <option value="<?= $val['id']; ?>"><?= $val['name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <div class="col-md-12 text-danger">
                                    <?php echo $this->session->flashdata('error_view'); ?>
                                    </div>
                                    <select name="pooja[]" id="pooja_${index}" class="form-control js-example-basic-single pooja" required style="width: 10cm;">
                                        <option value="">Select Pooja</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="name[]" id="name_${index}" class="form-control name" placeholder="Name" value="*" required style="width: 3.2cm;">
                                </td>
                                <td>
                                    <select name="star[]" id="star_${index}" class="form-control js-example-basic-single star" required style="width: 3.2cm;">
                                        <option value="28">nodata</option>
                                        <?php foreach($birth_star as $val){ ?>  
                                        <option value="<?= $val['id']; ?>">
                                            <?php if($site[0]['starcode'] == 1) { 
                                                    echo $val['id']." - ";
                                                } 
                                            echo $val['name_eng']." - ".$val['name_mal']; 
                                            ?> 
                                            ( <?= $val['id']; ?> )
                                        </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" min="0" name="qlt[]" id="qty_${index}" class="form-control qty" placeholder="Quatity" value="0">
                                </td>
                                <td>
                                    <input type="text" name="rate[]" id="rate_${index}" class="form-control rate" placeholder="Rate" value="0" readonly>
                                </td>
                                <td>
                                    <input type="text" name="amt[]" id="amt_${index}" class="form-control amount"  value="0" onkeyup="calculateGrandTotal()" placeholder="Amount" readonly>
                                </td>
                                <td>
                                    <input type="date" name="date1[]" id="date_${index}" class="form-control date" placeholder="Date" value="<?php echo date('Y-m-d');?>" style="max-width: 4.2cm;">
                                </td>
                                <td>
                                    <select name="time[]" id="time_${index}" class="form-control time" required style="width: 1.6cm;">
                                        <option value="M" >M</option>
                                        <option value="A" >A</option>
                                        <option value="N" >N</option>
                                        <option value="E" >E</option>
                                    </select>
                                </td>   
                                <td>
                                    <i class="fa fa-minus" onclick="return remove_file_row(this)" style="padding: 8px;"></i>
                                </td>
                            </tr>
                        `;
			$tbody.append(htmlCode)
        
        	$row   = $tbody.find('tr:last')
        	$pooja = $row.find('.pooja')
        	$star  = $row.find('.star')
        	$date  = $row.find('.date')
        	$time  = $row.find('.time')
        
        	let deity = $row.find('.deity')
        	$(deity).val(deity_id).change()
        	$pooja.select2()
        	getPooja(deity, pooja_id)
        	$star.select2()
        	$star.val(star_id).trigger('change.select2');

        	$row.find('.time').val(pooja_time)
        	$row.find('.name').val(name)
        
        	$tr.find('.name').focus().select()
        }

    	/***
    	 * On keydown
    	 ***/
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
                        html +='<td><select name="pooja[]" id="pooja_'+row_value+'" onchange="change_rate('+row_value+')" class="select2 sq_form" required style="width: 3.2cm;">';
                        html +='<option value="'+obj.pooja+'">'+obj.pooja_nm+'</option>';
                        html +='<td><input type="text" name="name[]" id="name_'+row_value+'" class="sq_form" placeholder="Name" value="'+obj.name+'" required style="width: 3.2cm;" readonly></td>';
                        html +='<td><select name="star[]" id="star_'+row_value+'" class="js-example-basic-single sq_form" required style="width: 3.2cm;">';
                        html +='<option value="'+obj.star+'">'+obj.star_nm+'</option>';
                        html +='</select></td>';
                        
                        html +='</select></td>';
                        html +='<td><input type="number" min="1" name="qlt[]" id="qlt_'+row_value+'" onchange="change_rate('+row_value+'),checkallowedqty('+row_value+')"  onkeyup="change_rate('+row_value+'),checkallowedqty('+row_value+')" class="sq_form qty" placeholder="Quatity" readonly value="'+obj.nos+'"></td>';
                        html +='<td><input type="text" name="rate[]" id="rate_'+row_value+'" class="sq_form" placeholder="Rate" readonly value="'+obj.rate+'"></td>';
                        html +='<td><input type="text" name="amt[]" id="amt_'+row_value+'" onkeyup="totalcalc()" class="sq_form" placeholder="Amount" readonly value="'+obj.amount+'"></td>';
                        html +='<td><input type="date" name="date1[]" id="date_'+row_value+'" class="sq_form datefield" placeholder="Date" value="'+bill_date+'" onchange="checkallowedqty('+row_value+');" onclick="checkallowedqty('+row_value+');"   style="max-width: 4.2cm;"></td>';        
                        html +='<td><select name="time[]" id="time_'+row_value+'" class="js-example-basic-single sq_form pooja_time" onkeypress="return myKeyPress(event)" required style="width: 1.6cm;"><option value="">Time</option>';
                        html +='<option value="M" >M</option><option value="A">A</option><option value="N">N</option><option value="E">E</option></select></td>';
               
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
        $('#save_btn').css("background-color",'red')
        
        }
        document.addEventListener("keydown", function(e) {
            if(e.keyCode == 13){
                   e.preventDefault();
            } 
            
            if (e.keyCode == 122) {
                e.preventDefault();
            
                let availabilityChecked = e.target.getAttribute('data-availability_check');
                if(!availabilityChecked)
                     submitFormFn()
            }
    
            if($(".qty").is(':focus') == true){
               if(e.keyCode == 9){
                   e.preventDefault();
                   let $row = $(e.target).closest('tr')
                   console.log($(e.target))
                   $row.find('.amount').focus().select();
               }
            }
        
            if($("#mode").is(':focus') == true){
               if(e.keyCode == 9){
                   e.preventDefault();
                   $('#save_btn').focus().select();
                   $('#save_btn').css("background-color",'red')
                   
                   $('#add_adjustment_item').focus().select();
                   $('#add_adjustment_item').css("background-color",'red')
               }
            }
            if($('.date').is(':focus') == true){
                if(e.keyCode == 13){
                   e.preventDefault();
                }
            }
        
            if($('#save_btn').is(':focus') == true){
                if(e.keyCode == 13){
                   e.preventDefault();
                   let availabilityChecked = e.target.getAttribute('data-availability_check');
                   if(!availabilityChecked)
                        submitFormFn()
                }
            }
            
            if($('#add_adjustment_item').is(':focus') == true){
                if(e.keyCode == 13){
                   e.preventDefault();
                   let availabilityChecked = e.target.getAttribute('data-availability_check');
                   if(!availabilityChecked)
                        submitFormFn()
                }
            }
            
            if($('.time').is(':focus') == true) {
                if(e.keyCode == 13){
                   e.preventDefault();
                   addRow()
                }
            }
        });
        
        
        $(document).ready(function(){
            $('#transaction_id').hide();
            $('#temple_100').focus().select()
        
      $("div").removeClass("container");
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    
            $('#mode').on('change', (e) => {
                let value = e.target.value;
                let hasTo ='<?php echo $transaction_id; ?>';
                
                if( value != 1 && value != 9 && hasTo == 1 ) {
                    $('#transaction_id').show();
                }
            })
        });
        
    $('input:text').each(function(index) { 
        var elementId = $(this).attr("name"); 
    
        //Call the Google API
        $.ajax({
            type : "GET",
            url : "https://ajax.googleapis.com/ajax/services/language/translate",
            dataType : 'jsonp',
            cache: false,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data : "v=1.0&q="+$("#"+elementId).val()+"&langpair=en|es",
            success : function(iData){
                //update the value
                $("#"+elementId).val(iData["responseData"]["translatedText"]);      
            },
            error:function (xhr, ajaxOptions, thrownError){ }
        });
    });  
     
	</script>
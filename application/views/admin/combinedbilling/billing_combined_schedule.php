<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    	<meta http-equiv="Pragma" content="no-cache">
    	<meta http-equiv="Expires" content="0">
		<link rel="icon" href="<?php echo base_url(); ?>/assets/admin/img/favicon.png" type="image/x-icon" sizes="35x35">
		<title>Temple Admin Dashboard</title>
    	
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/admin/css/bootstrap.css" />
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- MULTI SELECT CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/plugins/multipleselect/multiple-select.css">
		<!-- SELECT2 CSS -->
		<link href="<?php echo base_url(); ?>/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
    	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    	
<!-- 		<script type="text/javascript" src="<?php echo base_url(); ?>assets/home-2/engine1/jquery.js"></script> -->
   		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>

		<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js" integrity="sha512-/n/dTQBO8lHzqqgAQvy0ukBQ0qLmGzxKhn8xKrz4cn7XJkZzy+fAtzjnOQd5w55h4k1kUC+8oIe6WmrGUYwODA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" crossorigin="anonymous"></script>
    	
    	<style>
    	    #close-btn,
    	    #save-btn {
    	        width: 8em;
    	        border-radius: .3em;
    	    }
    	</style>
	</head>
	<body>
    	<div class="container mt-2">
    	    <input type="hidden" name="reference_no" id="reference_no" value="<?php echo $this->session->userdata('reference_no'); ?>">
    	    <h3 class="text-center"> Schedule Details </h3>
    	    <div class="card p-3 mb-3">
    	        <div class="row mb-5">
                    <div class="col-md-12 d-flex flex-row align-items-center">
                        <h4 class="page_txt my-auto"><i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;&nbsp; </h4>
                        <h4 class="page_txt my-auto"> Pooja Details </h4>
                    </div>    
                </div>
        
    	        <table class="table border mb-5">
    	            <thead>
    	                <tr>
    	                    <th>Name</th>
    	                    <th>Star</th>
    	                    <th>Pooja</th>
    	                    <th>Quantity</th>
    	                    <th>Rate</th>
    	                </tr>
    	            </thead>
    	            
    	            <tbody>
    	                
    	            </tbody>
    	        </table>
    	    </div>
    	    
    	    <!-- If the selected pooja has children, select child pooja -->
    	    <div class="card p-3 mb-3 " id="sub_pooja_card">
    	        <div class="row mb-5">
                    <div class="col-md-12 d-flex flex-row align-items-center">
                        <h4 class="page_txt my-auto"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp; </h4>
                        <h4 class="page_txt my-auto"> Sub Poojas </h4>
                    </div>    
                </div>
                
    	        <div class="row" id="sub_poojas">
                    <div class="col-md-4 mt-2 pooja_col">
                        <label>Sub Pooja</label>
                        <input class="form-control sub_pooja" type="text" id="sub_pooja_1" placeholder="Search pooja by code" autofocus />
                        <input class="form-control" type="hidden" id="pooja_id_1" name="pooja_id" />
                    </div>    
                </div>
    	    </div>
    	    
            <!-- Create Row -->
            <div class="card p-3">
                <div class="row mb-5">
                    <div class="col-md-12 d-flex flex-row align-items-center">
                        <h4 class="page_txt my-auto"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;&nbsp; </h4>
                        <h4 class="page_txt my-auto"> Schedule Type </h4>
                    </div>    
                </div>
                <!-- Schedule Type -->
                <div class="d-flex flex-row justify-content-between mb-5">
                    <div class="form-check form-check-inline schedule_type">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="daily" checked>
                      <label class="form-check-label" for="inlineRadio1">Daily</label>
                    </div>
                    <div class="form-check form-check-inline schedule_type">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="weekly">
                      <label class="form-check-label" for="inlineRadio2">Weekly</label>
                    </div>
                     <div class="form-check form-check-inline schedule_type">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="monthly">
                      <label class="form-check-label" for="inlineRadio3">Monthly</label>
                    </div>
                     <div class="form-check form-check-inline schedule_type">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="other">
                      <label class="form-check-label" for="inlineRadio4">Other</label>
                    </div>
                    <div class="form-check form-check-inline schedule_type">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="custom">
                      <label class="form-check-label" for="inlineRadio5">Custom</label>
                    </div>
                </div>

                <div class="border mb-3">
                    <!-- Tabs -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="tab-content">
                            <!-- Daily -->
                            <div class="tab-pane active" id="daily" role="tabpanel" aria-labelledby="daily-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Start Date</label>
                                        <input class="form-control" name="date_from" id="date_from" type="date" value="<?php echo date('Y-m-d'); ?>" />
                                    </div>
                                    <div class="col-md-4">
                                        <label>No. of Days</label>
                                        <input class="form-control" name="days_count" id="days_count" type="number" min="1" value="1" />
                                    </div>
                                    <div class="col-md-4">
                                        <label>End Date</label>
                                        <input class="form-control" name="date_to" id="date_to"  type="date" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')); ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Weekly -->
                            <div class="tab-pane" id="weekly" role="tabpanel" aria-labelledby="weekly-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Start Date</label>
                                        <input class="form-control" name="date_from" id="date_from" type="date" value="<?php echo date('Y-m-d'); ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Weekday</label>
                                        <select class="form-control" name="weekday" id="weekday">
                                            <option>Select a day</option>
                                            <option value="Sunday" <?php if(date('w') == 0) { echo 'selected'; } ?> >Sunday</option> 
                                            <option value="Monday" <?php if(date('w') == 1) { echo 'selected'; } ?> >Monday</option> 
                                            <option value="Tuesday" <?php if(date('w') == 2) { echo 'selected'; } ?> >Tuesday</option> 
                                            <option value="Wednesday" <?php if(date('w') == 3) { echo 'selected'; } ?> >Wednesday</option> 
                                            <option value="Thursday" <?php if(date('w') == 4) { echo 'selected'; } ?> >Thursday</option> 
                                            <option value="Friday" <?php if(date('w') == 5) { echo 'selected'; } ?> >Friday</option> 
                                            <option value="Saturday" <?php if(date('w') == 6) { echo 'selected'; } ?> >Saturday</option> 
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>No. of Weeks</label>
                                        <input class="form-control" name="weeks_count" id="weeks_count" type="number" min="1" value="1" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>End Date</label>
                                        <input class="form-control" name="date_to" id="date_to" type="date" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' +1 week')); ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Monthly -->
                            <div class="tab-pane" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Start Date</label>
                                        <input class="form-control" name="date_from" id="date_from" type="date" value="<?php echo date('Y-m-d'); ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Star</label>
                                        <input class="form-control" name="birth_star" id="birth_star" type="text" />
                                        <input class="form-control" name="birth_star_id" id="birth_star_id" type="hidden" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>No. of Months</label>
                                        <input class="form-control" name="months_count" id="months_count" type="number" min="1" value="1" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>End Date</label>
                                        <input class="form-control" name="date_to" id="date_to" type="date" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' +1 month')); ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Other -->
                            <div class="tab-pane" id="other" role="tabpanel" aria-labelledby="other-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Start Date</label>
                                        <input class="form-control" name="date_from" id="date_from" type="date" value="<?php echo date('Y-m-d'); ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Star</label>
                                        <input class="form-control" name="other_star" id="other_star" type="text" />
                                        <input class="form-control" name="other_star_id" id="other_star_id" type="hidden" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>No. of Months</label>
                                        <input class="form-control" name="months_count" id="months_count" type="number" min="1" value="1" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>End Date</label>
                                        <input class="form-control" name="date_to" id="date_to" type="date" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' +1 month')); ?>" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Custom -->
                            <div class="tab-pane" id="custom" role="tabpanel" aria-labelledby="custom-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--<input class="form-control" name="dates" id="custom_dates" type="text" value="<?php echo date('Y-m-d'); ?>" />-->
                                        <label>Dates</label>
                                        <div class="input-group date" id="datepicker">
                                            <input type="text" class="form-control" id="Dates" name="dates" placeholder="Select days" required />
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-2">
                    <div class="col-md-12 p-3 row">
                        <div class="col-md-8">
                            <p>Do you need Prasadam?</p>
                            <div class="d-flex flex-row">
                                <div class="form-check form-check-inline prasadam_check">
                                  <input class="form-check-input " type="radio" name="prasadam" id="prasadam_yes" value="1">
                                  <label class="form-check-label" for="prasadam_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline prasadam_check">
                                  <input class="form-check-input " type="radio" name="prasadam" id="prasadam_no" value="0" checked>
                                  <label class="form-check-label" for="prasadam_no">No</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div id="ifPrasadam">
                                <p>Prasadam Count</p>
                                <input class="form-control" type="number" name="prasadam_count" id="prasadam_count" value="0" min="0">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                
                <div class="d-flex flex-row justify-content-between">
                    <button class="btn btn-danger" id="close-btn"> Close </button>
                    <button class="btn btn-success" id="save-btn"> Save </button>
                </div>
            </div> 
        
        </div>
        
        
        <!-- Scripts -->
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin/js/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            var customDates = [];
            $('#datepicker').datepicker({
                startDate: new Date(),
                multidate: true,
                format: "dd/mm/yyyy",
                language: 'en'
            }).on('changeDate', function (selected) {
                var selectedDate = new Date(selected.date);
        
                // Formatting using toLocaleDateString
                var formattedDate = selectedDate.toISOString().slice(0,10);
                customDates.push(formattedDate)
            });
            // $('#datepicker').datepicker('setDate', new Date());


            $('#ifPrasadam').hide();
            $('.prasadam_check').on('change', () => {
        		var data = $('.prasadam_check input:checked').val();
        		console.log(data == 1)
                if(data == 1){
                   $('#ifPrasadam').show();
                }
            	else{
             		$('#ifPrasadam').hide();
            	}
            });
            
            function searchOtherStar(data){
                var pooja_url = "<?php echo base_url(); ?>index.php/admin/newbilling/getOtherStar";
                $.ajax({
                   type: 'POST',
                   url: pooja_url,
                   dataType: "json",
                   data: {
                        data: data
                   },
                   success: function(data) {
                        $('#other_star').val(data.star.name)
                        $('#other_star_id').val(data.star.id)
                   }
                });
            }
    
            $('#close-btn').on('click', () => {
                window.close();
        
                // Access the opener window and focus it
                if (window.opener && !window.opener.closed) {
                    window.opener.focus();
                }
            })
            
            
            $('.schedule_type').on('change', (e) => {
                let schedule_type = e.target.value
                
                $('.tab-content .tab-pane.active').removeClass('active')
                $('.tab-content').find('#'+schedule_type).addClass('active')
            })
            
            
            /***
             * Calculate dates
             ***/
            //  Daily
            
             $(".tab-pane#daily #days_count").on('input', function() {
                var x = parseInt($(this).val());
                var datefrom = $('.tab-pane#daily').find('#date_from').val();
                
                if (datefrom) {
                    var datefromObj = new Date(datefrom);
                    var dateto = new Date(datefromObj.getTime() + (x * 24 * 60 * 60 * 1000)); 
                    var date = dateto.toISOString().slice(0, 10);
                    $('.tab-pane#daily').find('#date_to').val(date);
                } else {
                    console.log('Error: Please select a valid start date.');
                }
            });
            
            // Weekly 
            $(".tab-pane#weekly #weeks_count").on('input', function() {
                var x = parseInt($(this).val());
                var datefrom = $('.tab-pane#weekly').find('#date_from').val();
                
                if (datefrom) {
                    var datefromObj = new Date(datefrom);
                    var dateto = new Date(datefromObj.getTime() + (x * 7 * 24 * 60 * 60 * 1000)); 
                    var date = dateto.toISOString().slice(0, 10);
                    $('.tab-pane#weekly').find('#date_to').val(date);
                } else {
                    console.log('Error: Please select a valid start date.');
                }
            });

            
            // Monthly
            
               $(".tab-pane#monthly #months_count").on('input', function() {
                var x = parseInt($(this).val());
                var datefrom = $('.tab-pane#monthly').find('#date_from').val();
                
                if (datefrom) {
                    var datefromObj = new Date(datefrom);
                    var dateto = new Date(datefromObj.getFullYear(), datefromObj.getMonth() + x, datefromObj.getDate()); 
                    var date = dateto.toISOString().slice(0, 10);
                    $('.tab-pane#monthly').find('#date_to').val(date);
                } else {
                    console.log('Error: Please select a valid start date.');
                }
            });
            // Other
            $( ".tab-pane#other #months_count" ).on('input', function() {
                var x = parseInt($(this).val());
                var datefrom = $('.tab-pane#other').find('#date_from').val();
                
                if (datefrom) {
                    var datefromObj = new Date(datefrom);
                    var dateto = new Date(datefromObj.getFullYear(), datefromObj.getMonth() + x, datefromObj.getDate()); 
                    var date = dateto.toISOString().slice(0, 10);
                    $('.tab-pane#other').find('#date_to').val(date);
                } else {
                    console.log('Error: Please select a valid start date.');
                }
            }); 

            
            const getScheduleDetails = (schedule_type) => {
                
                if (schedule_type == 'daily') {
                    // Daily
                    let $tab      = $('.tab-pane#daily')
                    let date_from = $tab.find('#date_from').val()
                    let date_to   = $tab.find('#date_to').val()
                    let days      = $tab.find('#days_count').val()
                    
                    var details = {
                        'date_from':   date_from,
                        'date_to'  :   date_to,
                        'days'     :   days
                    };
                } else if (schedule_type == 'weekly') {
                    // Weekly
                    let $tab      = $('.tab-pane#weekly')
                    let date_from = $tab.find('#date_from').val()
                    let date_to   = $tab.find('#date_to').val()
                    let weeks     = $tab.find('#weeks_count').val()
                    let weekday   = $tab.find('#weekday').val()
                    
                    var details = {
                        'date_from':   date_from,
                        'date_to'  :   date_to,
                        'weeks'    :   weeks,
                        'weekday'  :   weekday
                    };
                } else if (schedule_type == 'monthly') {
                    // Monthly
                    let $tab      = $('.tab-pane#monthly')
                    let date_from = $tab.find('#date_from').val()
                    let date_to   = $tab.find('#date_to').val()
                    let months    = $tab.find('#months_count').val()
                    let star_id   = $tab.find('#birth_star_id').val()
                    
                    var details = {
                        'date_from':   date_from,
                        'date_to'  :   date_to,
                        'months'   :   months,
                        'star_id'  :   star_id
                    };
                } else if (schedule_type == 'other') {
                    // Other
                    let $tab      = $('.tab-pane#other')
                    let date_from = $tab.find('#date_from').val()
                    let date_to   = $tab.find('#date_to').val()
                    let months    = $tab.find('#months_count').val()
                    let star_id   = $tab.find('#other_star_id').val()
                    
                    var details = {
                        'date_from':   date_from,
                        'date_to'  :   date_to,
                        'months'   :   months,
                        'star_id'  :   star_id
                    };
                } else {
                    // Custom
                    let $tab      = $('.tab-pane#custom')
                    let dates     = customDates
                    
                    var details = {
                        'dates'  :   dates
                    };
                }
                
                
                return details;
            }
            
            // Add new sub pooja
            function addRow(key) {
                var row_value = key + 1;

                var sub_pooja_col = '<div class="col-md-4 mt-2 pooja_col">'+
                                        '<label>Sub Pooja</label>'+
                                        '<input class="form-control sub_pooja" type="text" id="sub_pooja_'+row_value+'" placeholder="Search sub pooja by code" />'+
                                        '<input class="form-control" type="hidden" id="pooja_id_'+row_value+'" name="pooja_id" />'+
                                    '</div>';
            	$('#sub_poojas').append(sub_pooja_col);
        		$('#sub_pooja_'+row_value).focus()
            }
            
            
            /***
             * Keyboard Navigations
             ***/
            document.addEventListener("keydown", function(e) {
                var storedData       = localStorage.getItem('billingDetail');
                var retrievedData    = JSON.parse(storedData);
                
                if(e.keyCode == 13) {
                    e.preventDefault();
                    
                    if($(".sub_pooja").is(':focus') == true) {
                        // Search sub pooja by code
                        
                        var $focusedElm = $(document).find(":focus");
                        var rowIndex    = $focusedElm.closest(".pooja_col").index()
                        var parent_id   = retrievedData.pooja_id;
        				var date        = retrievedData.data;
        				var key         = rowIndex + 1
        				var code        = $focusedElm.val()
        				
                    	var pooja_fetch_url = "<?php echo base_url(); ?>index.php/admin/billing/getchildpoojabykeyword";
                    	
                    	if (code != '') {
                        	$.ajax({
                            	url: pooja_fetch_url,
                            	type: 'post',
                            	dataType: 'json',
                            	data: {'parent_id': parent_id, search: code, date: date},
                            	success: function(data) {
                                	if(data != 0) {
                            		    $focusedElm.val(data[0].name+' - '+data[0].name_mal)
                            		    $('#pooja_id_'+key).val(data[0].id)
                                	    addRow(key)
                                	} else {
                                		alert('no pooja found!')
                                	}
                            	}
                        	});
                    	} else {
                    	    alert('No input')
                    	}
                    	
                        return false;
                        
                    }  else if($("#other_star").is(':focus') == true) {
                        let star_code = $("#other_star").val()
                        
                        if (star_code) {
                            searchOtherStar(star_code);
                        } else {
                            Swal.fire('No input') 
                        }
                    } 
                }
            });
            
            /***
             * Save Data Temporarily
             ***/
            //  $('#save-btn').on('click', () => {
            //     var storedData       = localStorage.getItem('billingDetail');
            //     var retrievedData    = JSON.parse(storedData);
            //     var schedule_type    = $('.schedule_type input:checked').val()
            //     var schedule_details = getScheduleDetails(schedule_type)
            //     var reference_no     = $('#reference_no').val()
            //     var prasadam         = $('.prasadam_check input:checked').val()
            //     var prasadam_count   = $('#prasadam_count').val()
                
            //     var pooja_id;
            //     if(retrievedData.has_children == 0) {
            //         pooja_id         = retrievedData.pooja_id
            //     } else {
            //         let ids          = []
            //         let subPooja     = $('[name="pooja_id"]')
                    
            //         subPooja.each((i, e) => {
            //             let id = parseInt(e.value)
                        
            //             !isNaN(id) ? ids.push(id) : ''
            //         })
                    
            //         pooja_id = ids;
            //     }
                
                
            //     let data = {
            //         'customer_id'      : retrievedData.customer_id,
            //         'reference_no'     : reference_no,
            //         'order_id'         : retrievedData.order_id,
            //         'name'             : retrievedData.name,
            //         'star_id'          : retrievedData.star_id,
            //         'deity_id'         : retrievedData.deity_id,
            //         'pooja_id'         : pooja_id,
            //         'quantity'         : retrievedData.quantity,
            //         'rate'             : retrievedData.rate,
            //         'schedule_type'    : schedule_type,
            //         'schedule_details' : schedule_details,
            //         'prasadam'         : prasadam,
            //         'prasadam_count'   : prasadam_count
            //     };
                
            //     let url = '<?php echo base_url();?>index.php/admin/newbilling/getScheduledDates';
            // 	$.ajax({
            //         type: "POST",
            //         url: url,
            //         data: data,
            //         dataType: "json",
            //         success: function (data) {
            //             if (data.status == 'success') {
            //                 window.close();
            //                  window.opener.location.reload();
            //                 if (window.opener && !window.opener.closed) {
            //                     window.opener.focus();
            //                 }
            //             }
            //         }
            //     });
            //  })
             
             
             
             $('#save-btn').on('click', () => {
    var storedData = localStorage.getItem('billingDetail');
    var retrievedData = JSON.parse(storedData);
    var schedule_type = $('.schedule_type input:checked').val()
    var schedule_details = getScheduleDetails(schedule_type)
    var reference_no = $('#reference_no').val()
    var prasadam = $('.prasadam_check input:checked').val()
    var prasadam_count = $('#prasadam_count').val()

    var pooja_id;
    if (retrievedData.has_children == 0) {
        pooja_id = retrievedData.pooja_id
    } else {
        let ids = []
        let subPooja = $('[name="pooja_id"]')

        subPooja.each((i, e) => {
            let id = parseInt(e.value)
            console.log('Current subPooja ID:', id);

            if (!isNaN(id)) {
                ids.push(id);
            } else {
                console.error('Invalid subPooja ID:', e.value);
            }
        })

        pooja_id = ids;
        console.log('Final pooja_id:', pooja_id);
    }

    let data = {
        'customer_id': retrievedData.customer_id,
        'reference_no': reference_no,
        'order_id': retrievedData.order_id,
        'name': retrievedData.name,
        'star_id': retrievedData.star_id,
        'deity_id': retrievedData.deity_id,
        'pooja_id': retrievedData.pooja_id,
        'quantity': retrievedData.quantity,
        'rate': retrievedData.rate,
        'schedule_type': schedule_type,
        'schedule_details': schedule_details,
        'prasadam': prasadam,
        'prasadam_count': prasadam_count
    };

    let url = '<?php echo base_url();?>index.php/admin/newbilling/getScheduledDates';
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "json",
        success: function (data) {
            if (data.status == 'success') {
                window.close();
                window.opener.location.reload();
                if (window.opener && !window.opener.closed) {
                    window.opener.focus();
                }
            }
        }
    });
})

             
             /***
              * On Document Load
              ***/
              $(document).ready(() => {
                var storedData = localStorage.getItem('billingDetail');
                var retrievedData = JSON.parse(storedData);
                
                if(parseInt(retrievedData.has_children) == 0) {
                    var pooja = retrievedData.pooja;
                    $('#sub_pooja_card').hide()
                } else {
                    $('#sub_pooja_card').show()
                    var pooja = '<input class="form-control" type="text" id="search_pooja" placeholder="Search pooja by code" autofocus /><input class="form-control" type="hidden" id="pooja_id" />'
                }
                
                $('table tbody').append('<tr>'+
                                        	'<td>' + retrievedData.name + '</td>'+
                                        	'<td>' + retrievedData.star + '</td>'+
                                        	'<td>' + retrievedData.pooja + '</td>'+
                                        	'<td>' + retrievedData.quantity + '</td>'+
                                        	'<td>' + retrievedData.rate + '</td>'+
                                        '</tr>');
                                        
                
                console.log(retrievedData);
                $('[name="birth_star"]').val(retrievedData.star)
                $('[name="birth_star_id"]').val(retrievedData.star_id)
            })
        </script>
    </body>
</html>
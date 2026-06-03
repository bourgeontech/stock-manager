<div class="container mt-3">
    <!-- Header -->
    <div class="card p-3">
        <div class="row">
            <div class="col-md-3 d-flex flex-column">
                <h4 class="page_txt my-auto">Billing Master ( <?php echo $username; ?> )</h4>
            </div>
            <div class="col-md-3 d-flex flex-column">
                <h4 class="page_txt text-center my-auto">Today's Collection : <?php echo $totalcollection; ?></h4>
            </div>
            <div class="col-md-3 d-flex flex-column">
                <h4 class="page_txt text-center my-auto"><?php echo $counter; ?> </h4>
            </div>
            <div class="col-md-3 text-right">
                <a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp; Back</a>
            </div>
        </div>
    </div>
    
    <!-- Create Row -->
    <div class="card p-3">
        <!-- Bill No -->
        <div class="row mb-5">
            <div class="col-md-12 d-flex flex-row align-items-center">
                <h3 class="page_txt my-auto"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;&nbsp; </h3>
                <h4 class="page_txt my-auto">Bill: <?php echo $current_bill_no;?></h4>
            </div>    
        </div>
        
        <div class="row mb-2">
            <div class="col-md-6 d-flex flex-column">
                <input class="form-control" type="text" id="search_pooja" placeholder="Search pooja by code" autofocus />
                <input class="form-control" type="hidden" id="pooja_id" />
                <input class="form-control" type="hidden" id="has_children" />
                <input class="form-control" type="hidden" id="deity_id" />
                <input class="form-control" type="hidden" id="pooja_time" />
            </div> 
            <div class="col-md-6 d-flex flex-column">
                <div class="input-group"> 
                    <input class="form-control" type="text" id="search_devotee" placeholder="Search customer by mobile number" value="<?php print_r($walk_in->name." - ".$walk_in->mobile); ?>" />
                    <button class="btn btn-blue" id="customer-add-btn" Title="Create Devotee"> <i class="fa fa-plus"></i> </button>
                </div>
                <input class="form-control" type="hidden" id="customer_id" value="<?php print_r($walk_in->id); ?>" />
            </div> 
        </div>
        <div class="row justify-content-between">
            <div class="col-md-11 row">
                <div class="col-md-2 d-flex flex-column">
                    <input class="form-control" type="text" id="name" placeholder="Name" value="*" />
                </div>
                <div class="col-md-2 text-right">
                    <input class="form-control" type="date" id="pooja_date" placeholder="Pooja Date" value="<?php echo date('Y-m-d'); ?>" />
                </div>
                <div class="col-md-2 d-flex flex-column">
                    <input class="form-control" type="text" id="search_star" placeholder="Search star by code" value="28" />
                    <input class="form-control" type="hidden" id="star_id" />
                </div>
                <div class="col-md-2 text-right">
                    <input class="form-control" type="number" id="quantity" placeholder="Quantity" value="1" min="1" />
                </div>
                <div class="col-md-2 text-right">
                    <input class="form-control" type="number" id="rate" placeholder="Rate" />
                </div>
                <div class="col-md-2 text-right">
                    <input class="form-control" type="number" id="amount" placeholder="Amount" />
                </div>
            </div>
            <div class="col-md-1 d-flex flex-row justify-content-between text-right">
                <button class="btn btn-outline-primary" id="schedule_btn">
                    <i class="fa fa-calendar"></i>
                </button>
                <button class="btn btn-primary" id="add_row_btn">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Details -->
    <div class="card p-3">
        <form id="billingForm" method="post" action="<?php echo base_url();?>index.php/admin/newbilling/billing">
            <input type="hidden" name="order_id" id="order_id" value="<?php echo $this->session->userdata('order_id'); ?>">
            <div class="row">
                <div class="col-md-12">
                    <table class="table mb-5" id="details_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pooja</th>
                                <th>Name</th>
                                <th>Star</th>
                                <th>Date</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot> 
                            <tr>
                                <th colspan="7" class="text-right h4">Grand Total</th>
                                <th colspan="2" id="grand_total" class="h4"></th>
                            </tr>
                            <tr>
                                <th colspan="5"></th>
                                <th colspan="2" class="text-right h4">
                                    <select id="mode" name="mode" class="form-control" required onchange="getpaymentdetails(event)" tabindex="11">
                                       <?php foreach($payment_modes as $mode) { ?>
                                  			<option value="<?php echo $mode['id']; ?>" <?php if($mode['slug'] == 'cash') echo 'selected'; ?>><?php echo $mode['name']; ?></option>
                                  	   <?php } ?>
                                  </select>
                                </th>
                                <th colspan="2" class="text-right pr-5">
                                    <button class="btn btn-success mr-5">Save</button>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Scripts -->
<script>
    var request;
    // Calculate Grand Total
    function calculateGrandTotal() {
         let total = 0;
         
         $('#details_table tbody tr').each((i, e) => {
             let amount = $(e).find('[name="amount"]').val() ?? $(e).find('.amount').text()
             
             total += parseFloat(amount)
         })
         
         $('#grand_total').text(total)
    }
    
    // Calcluate Row Data
    function calculateRowData() {
        let rate     = $("#rate").val()
        let quantity = $("#quantity").val() ?? 1
        
        const $row = $('#details_table tbody tr:last');
                
        $row.find('.quantity').text(quantity)
        $row.find('[name="quantity"]').val(quantity)
        
        if (rate > 0) {
            let amount   = rate * quantity
            $('#amount').val(amount)  
            $('#amount').prop('readonly', 'readonly')
            
            
            $row.find('.rate').text(rate)
            $row.find('.amount').text(amount)
            
            $row.find('[name="rate"]').val(rate)
            $row.find('[name="amount"]').val(amount)
        } else {
            $('#amount').prop('readonly', '')
        }
    }
    
    // Show Pooja Details of Current Order
    function showPoojaDetails(order_id) {
        var url = "<?php echo base_url(); ?>index.php/admin/newbilling/getOrders";
        $.ajax({
           type: 'POST',
           url: url,
           dataType: "json",
           data: {
                order_id: order_id
           },
           success: function(data) {
                createRow(data)
           }
        });
    }
    
    // Create Row
    function createRow(data) {
        $('#search_pooja').focus().select()
        data.forEach(function(row, index) {
            let formattedDate = '';
            let type = row.type;
            let viewDetailBtn = '';
            
            if (row.type == 'S') {
                viewDetailBtn = '<button class="btn btn-sm btn-outline-primary view-details-btn ml-3 rounded " data-id="'+row.reference_no+'" type="button"> <i class="fa fa-info"></i> </button>'
                formattedDate = '( '+ row.pooja_from + ' to ' + row.pooja_to + ' )'
            } else {
                viewDetailBtn = ''
                formattedDate = row.pooja_date
            }
            
            let key = parseInt(index)+1;

            let amount = parseInt(row.quantity) * parseFloat(row.rate) + parseFloat(row.postal ?? 0)
            const $row = '<tr id="' + key + '">'+
                        '<td>'+ key +'</td>'+
                        '<td class="pooja">'+
                            row.pooja + ' | ' + row.pooja_locale +
                            // '<input type="hidden" name="pooja_id" id="pooja_'+key+'" value="'+ row.pooja_id +'" />'+
                            // '<input type="hidden" name="deity_id" id="deity_'+key+'" value="'+ row.deity_id +'" />'+
                            // '<input type="hidden" name="name" id="name_'+key+'" value="'+ row.name +'" />'+ 
                            // '<input type="hidden" name="star_id" id="star_'+key+'" value="'+ row.star_id +'" />'+ 
                            // '<input type="hidden" name="pooja_date" id="pooja_date_'+key+'" value="'+ row.pooja_date +'" />'+ 
                            // '<input type="hidden" name="quantity" id="quantity_'+key+'" value="'+ quantity +'" />'+ 
                            // '<input type="hidden" name="rate" id="rate_'+key+'" value="'+ rate +'" />'+ 
                            // '<input type="hidden" name="amount" id="amount_'+key+'" value="'+ amount +'" />'+ 
                        '</td>'+
                        '<td class="name">'+ 
                            row.name +
                        '</td>'+
                        '<td class="star">'+ 
                            row.star +
                        '</td>'+
                        '<td class="pooja_date">'+ 
                            formattedDate + viewDetailBtn +
                        '</td>'+
                        '<td class="quantity">'+ 
                            row.quantity +
                        '</td>'+
                        '<td class="rate">'+ 
                            row.rate +
                        '</td>'+
                        '<td class="amount">'+ 
                            amount +
                        '</td>'+
                        '<td>'+
                            '<button class="btn btn-sm btn-outline-danger delete-row-btn" data-id="'+row.reference_no+'" type="button"> <i class="fa fa-trash"></i> </button>' +
                        '</td>'+
                    '</tr>';


         $('#details_table tbody').append($row)
         
        });
        
        calculateGrandTotal()
        
        if ( $('#details_table tbody tr').length == 0) {
            $('tfoot').hide()
        } else {
            $('tfoot').show()
        }
    }
    
    // Create Pooja Row
    function createPoojaRow(data) {
        let has_children = data.pooja.parent_id ? 0 : 1;
        $("#has_children").val(has_children)
        $("#search_pooja").val(data.pooja.pooja)
        $("#rate").val(data.pooja.rate)
        $("#pooja_id").val(data.pooja.pooja_id)
        $("#deity_id").val(data.pooja.deity_id)
        $("#pooja_time").val(data.pooja.time)

        let rate       = data.pooja.rate
        let quantity   = $('#quantity').val()
        let amount     = rate * quantity;
        let name       = $('#name').val()
        let star       = $('#search_star').val()
        let star_id    = $('#star_id').val()
        let pooja_date = $('#pooja_date').val()
        let key        = $('#details_table tbody tr').length + 1
        
        $("#amount").val(amount)
        
        const date = new Date(pooja_date);
        const formattedDate = date.toLocaleDateString()
    
        const row = '<tr id="' + key + '">'+
                        '<td>'+ key +'</td>'+
                        '<td class="pooja">'+
                            data.pooja.pooja +
                            '<input type="hidden" name="pooja_id" id="pooja_'+key+'" value="'+ data.pooja.pooja_id +'" />'+
                            '<input type="hidden" name="deity_id" id="deity_'+key+'" value="'+ data.pooja.deity_id +'" />'+
                            '<input type="hidden" name="name" id="name_'+key+'" value="'+ name +'" />'+ 
                            '<input type="hidden" name="star_id" id="star_'+key+'" value="'+ star_id +'" />'+ 
                            '<input type="hidden" name="pooja_date" id="pooja_date_'+key+'" value="'+ pooja_date +'" />'+ 
                            '<input type="hidden" name="quantity" id="quantity_'+key+'" value="'+ quantity +'" />'+ 
                            '<input type="hidden" name="rate" id="rate_'+key+'" value="'+ rate +'" />'+ 
                            '<input type="hidden" name="amount" id="amount_'+key+'" value="'+ amount +'" />'+ 
                        '</td>'+
                        '<td class="name">'+ 
                            name +
                        '</td>'+
                        '<td class="star">'+ 
                            star +
                        '</td>'+
                        '<td class="pooja_date">'+ 
                            formattedDate +
                        '</td>'+
                        '<td class="quantity">'+ 
                            quantity +
                        '</td>'+
                        '<td class="rate">'+ 
                            rate +
                        '</td>'+
                        '<td class="amount">'+ 
                            amount +
                        '</td>'+
                        '<td>'+
                            '<button class="btn btn-sm btn-outline-danger delete-row-btn" type="button"> <i class="fa fa-trash"></i> </button>' +
                        '</td>'+
                    '</tr>';


        $('#details_table tbody').append(row)
        $('#details_table tbody').find('#'+key).hide()
    }
    
    function addAuditoriumData(bill_id) {
        Swal.fire({
              title: 'Add Booking Details',
              html: `
              <form id="myForm">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="date" name="date" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" placeholder="Marriage Date" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="muhoortham" placeholder="Muhoortham Time" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="billing_address" placeholder="Billing Address" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="bride" placeholder="Bride" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="bride_address" placeholder="Bride Address" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="groom" placeholder="Groom" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="groom_address" placeholder="Groom Address" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="reception" placeholder="Reception" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="form_no" placeholder="Form No" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="number" name="advance_amount" placeholder="Advance Amount" class="form-control custom-input" required>
                        </div>
                    </div>
                </div>
            </form>
              `,
              width: '60%',
              showCancelButton: true,
              confirmButtonText: 'Submit',
              preConfirm: () => {
                let form = document.getElementById('myForm');
                
                if (form.checkValidity()) {
                    const formData = new FormData(form);

                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/admin/newbilling/update_auditorium_data' ,
                        data: {
                            'bill_id'        : bill_id,
                            'date'           : formData.get('date'),
                            'name'           : formData.get('name'),
                            'billing_address': formData.get('billing_address'),
                            'bride'          : formData.get('bride'),
                            'bride_address'  : formData.get('bride_address'),
                            'groom'          : formData.get('groom'),
                            'groom_address'  : formData.get('groom_address'),
                            'reception'      : formData.get('reception'),
                            'form_no'        : formData.get('form_no'),
                            'advance_amount' : formData.get('advance_amount')
                        },
                        success: function (data) {
                            if (data) {
                                
                            }
                        }
                    });
        
                } else {
                  const invalidInputs = document.querySelectorAll('.custom-input:invalid');
                  $('.custom-input').css('border-color', 'unset');
                  invalidInputs.forEach(input => {
                    $(input).css('border-color', 'red');
                  });
                  
                  Swal.showValidationMessage('Please fill in all required fields.');
                }
              },
              didRender: () => {
                // Bootstrap 4: Apply Bootstrap styling to the modal content
                $('.swal2-container').addClass('bootstrap-4-modal');
              },
              didDestroy: () => {
                // Cleanup input styles after modal is destroyed
                const invalidInputs = document.querySelectorAll('.custom-input');
                invalidInputs.forEach(input => {
                  $(input).css('border-color', 'unset');
                });
              }
            });
    }
    
    function insertData(data, $row) {
        var url = "<?php echo base_url(); ?>index.php/admin/newbilling/addOrderEntry";
        $.ajax({
          type: 'POST',
          url: url,
          dataType: "json",
          data: data,
          success: function(data) {
              $row.find('.delete-row-btn').data('id', data.reference_no)
              
              if(data.auditorium == 1) {
                addAuditoriumData(data.id)    
              }
              
              if(data.associates > 0) {
                  location.reload()
              }
          }
        });
    }
    
    // Show Row
    function showRow() {
        const $row = $('#details_table tbody tr:last');
        var flag = 0;
        if (!$('#search_pooja').val()) {
            flag=1;
            Swal.fire('No pooja selected');
            $('#search_pooja').focus().select()
        }
        
        if (!$('#name').val()) {
            flag=1;
            Swal.fire('No name provided');
            $('#name').focus().select()
        }
        
        if (!$('#search_star').val()) {
            flag=1;
            Swal.fire('No star selected');
            $('#search_star').focus().select()
        }
        
        if (flag == 0) {
            $row.show()
            let data = {
                         customer_id: $('#customer_id').val(),
                         order_id   : $('#order_id').val(),
                         name: $row.find('[name="name"]').val(),
                         star_id: $row.find('[name="star_id"]').val(),
                         deity_id: $row.find('[name="deity_id"]').val(),
                         pooja_id: $row.find('[name="pooja_id"]').val(),
                         pooja_date: $row.find('[name="pooja_date"]').val(),
                         quantity: $row.find('[name="quantity"]').val(),
                         rate: $row.find('[name="rate"]').val(),
                         amount: $row.find('[name="amount"]').val(),
                     };
            insertData(data, $row)
            clearData()
            
            calculateGrandTotal()
            
            if ( $('#details_table tbody tr').length == 0) {
                $('tfoot').hide()
            } else {
                $('tfoot').show()
            }
        }
    }
    
    // Clear Data
    function clearData() {
        $('#search_pooja').val('')
        $('#rate').val('')
        $('#amount').val('')
    }
    
    // Set Star
    function setStar(data) {
        $("#search_star").val(data.star.value)
        $("#star_id").val(data.star.id)

        const $row = $('#details_table tbody tr:last');
    
        $row.find('.star').text(data.star.value)
        $row.find('[name="star_id"]').val(data.star.id)
        
    }
    
    // Search Pooja by Pooja Code
    function searchPooja(data){
        // clearSearchRow();
        
        var pooja_url = "<?php echo base_url(); ?>index.php/admin/newbilling/getPooja";
        $.ajax({
           type: 'POST',
           url: pooja_url,
           dataType: "json",
           data: {
                data: data
           },
           success: function(data) {
                if(data.status == true) {
                    createPoojaRow(data)
                        
                    if ($('#customer_id').val()) {
                        $('#name').focus().select()   
                    } else {
                        $('#search_devotee').focus().select()   
                    }
                } else {
                    Swal.fire('No pooja found!')
                }
           }
        });
    }
   
    // Search Star by Code
    function searchStar(data){
        var pooja_url = "<?php echo base_url(); ?>index.php/admin/newbilling/getStar";
        $.ajax({
           type: 'POST',
           url: pooja_url,
           dataType: "json",
           data: {
                data: data
           },
           success: function(data) {
                setStar(data)
           }
        });
    }
    
    const openNewWindow = () => {
        let data = {
                     customer_id:$('#customer_id').val(),
                     order_id:  $('#order_id').val(),
                     name:      $('#name').val(),
                     star_id:   $('#star_id').val(),
                     star:      $('#search_star').val(),
                     deity_id:  $('#deity_id').val(),
                     pooja_id:  $('#pooja_id').val(),
                     pooja:     $('#search_pooja').val(),
                     has_children: $('#has_children').val(),
                     pooja_date:$('#pooja_date').val(),
                     time:      $('#pooja_time').val(),
                     quantity:  $('#quantity').val(),
                     rate:      $('#rate').val(),
                     amount:    $('#amount').val(),
                 };
                 
        localStorage.setItem('billingDetail', JSON.stringify(data));
        
        // Define the dimensions and options of the new window
        var windowOptions = 'width=800,height=600';
        var formUrl       = "schedule";
        
        // Open the new window with the form URL and options
        var newWindow = window.open(formUrl, '_blank', windowOptions);

        // Focus the new window (optional)
        if (newWindow) {
            newWindow.focus();
        } else {
            alert('Popup blocked! Please allow popups for this site.');
        }
    }
    
    // Quantity Change
    $(document).on('input', '#quantity', () => {
        calculateRowData()
    })
    
    
   
    document.addEventListener("keydown", function(e) {
        if (e.keyCode == 27) {
    		e.preventDefault();
        
    		if ( $('#details_table tbody tr').length > 0) {
                $('#billingForm').submit()
            } else {
                Swal.fire('No pooja selected')
            }
		}
		
        if (e.keyCode == 13) {
            e.preventDefault();
            
            if($("#search_pooja").is(':focus') == true) {
                let pooja_code = $("#search_pooja").val()
                
                if (pooja_code) {
                    searchPooja(pooja_code);
                } else {
                    Swal.fire('No input') 
                }
            } else if($("#search_devotee").is(':focus') == true) {
                let customer_id = $("#customer_id").val()
                
                if (customer_id) {
                    $('#name').focus().select()   
                } else {
                    Swal.fire('No input') 
                }
            } else if($("#name").is(':focus') == true) {
                let name = $("#name").val()
                
                if (name) {
                    const $row = $('#details_table tbody tr:last');
                
                    $row.find('.name').text(name)
                    $row.find('[name="name"]').val(name)
                    $('#pooja_date').focus().select()
                } else {
                    Swal.fire('No input') 
                }
            } else if($("#pooja_date").is(':focus') == true) {
                let pooja_date = $("#pooja_date").val()
                
                if (pooja_date) {
                    const $row = $('#details_table tbody tr:last');
                    
                    const date = new Date(pooja_date);
                    const formattedDate = date.toLocaleDateString()
        
                    $row.find('.pooja_date').text(formattedDate)
                    $row.find('[name="pooja_date"]').val(pooja_date)
                    $('#search_star').focus()
                } else {
                    Swal.fire('No input') 
                }
            } else if($("#search_star").is(':focus') == true) {
                let star_code = $("#search_star").val()
                
                if (star_code) {
                    if(!isNaN(parseInt(star_code))) {
                        searchStar(star_code);
                    }
                    $('#quantity').focus().select()
                } else {
                    Swal.fire('No input') 
                }
            } else if($("#quantity").is(':focus') == true) {
                let quantity = $("#quantity").val()
                
                if (quantity) {
                    calculateRowData()
                
                    const $amount = $('#amount');
                    
                    if ($amount.prop('readonly')) {
                        $('#schedule_btn').focus().select()
                    } else {
                        $('#amount').focus().select()
                    }
                    
                } else {
                    Swal.fire('No input') 
                }
            } else if($("#amount").is(':focus') == true) {
                let amount = $("#amount").val()
                
                if (amount) {
                    calculateRowData()
                
                    $('#schedule_btn').focus().select()
                } else {
                    Swal.fire('No input') 
                }
            } else if($("#schedule_btn").is(':focus') == true) {
                if (e.ctrlKey) {
                    openNewWindow()
                } else {
                    $('#add_row_btn').focus().select()
                }
            } else if($("#add_row_btn").is(':focus') == true) {
                showRow();
                $('#search_pooja').focus().select()
            }
        }
        
        if (e.keyCode == 120) {
            let $row = $(e.target).closest('tr');

            var windowOptions = 'width=800,height=600';
            var formUrl       = "viewPoojaList";
            
            // Open the new window with the form URL and options
            var newWindow = window.open(formUrl, '_blank', windowOptions);
    
            // Focus the new window (optional)
            if (newWindow) {
                newWindow.focus();
            } else {
                alert('Popup blocked! Please allow popups for this site.');
            }
        }
    });
          
    
    $(document).ready(() => {
        $("#search_pooja").focus().select()
        $('#rate').prop('readonly', 'readonly')
        $('#amount').prop('readonly', 'readonly')
        if($(':focus').length==0){
        	$('#search_pooja').focus().select();
        } 
        
        localStorage.removeItem('billingDetail')
        
        let order_id = $('#order_id').val()
        showPoojaDetails(order_id)
    })    
    
    window.setTimeout(function () { 
        document.getElementById('search_pooja').focus(); 
    }, 0); 
    
    // Set Devotee
    function setDevotee(data) {
        $('#search_devotee').val(data.value)
        $('#customer_id').val(data.id)
    }
    
    // Search Devotee
    $('#search_devotee').autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: '<?php echo base_url();?>index.php/admin/billing/searchDevotee',
                type: 'post',
                dataType: "json",
                data:{
                    search: request.term
                },
                beforeSend: function() {
                    $('#devotee-placeholder').html('')
                    $('#search-indicator-devotee').html('<small class="text-primary">Loading...Please Wait!</small><div class="spinner-border spinner-border-sm text-primary ms-auto" role="status" aria-hidden="true"></div>');
                },
                success: function( data ) {
                	
                    if(data.length > 0){
                        response( data );
                    }
                    else{
                        // $('#search_devotee').val('');
                        $('#search-indicator-devotee').html('<small class="text-danger">No Data Found!</small>');
                        return false;
                    }
                }
            });
        },
        select: function (event, ui) {
            setDevotee(ui.item);
            $('#search-indicator-devotee').html('');
            
            return false;
        }
    })
    var translate_url = "<?php echo base_url(); ?>index.php/admin/admin/translatetext";
    $('#name').autocomplete({
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
    })
    
    // Add Devotee
    $('#customer-add-btn').on('click', (e) => {
	        Swal.fire({
              title: 'Create Devotee',
              html: `
              <form id="myForm">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="type" class="form-control custom-input" required>
                                <option value="A"> One Time </option>
                                <option value="B"> Recurring </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="house" placeholder="House" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="street" placeholder="Street" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="post" placeholder="Post" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="district" placeholder="District" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="state" placeholder="State" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="pincode" placeholder="Postal Code" class="form-control custom-input" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Phone" class="form-control custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email" class="form-control custom-input" >
                        </div>
                    </div>
                </div>
            </form>
              `,
              width: '60%',
              showCancelButton: true,
              confirmButtonText: 'Submit',
              preConfirm: () => {
                let form = document.getElementById('myForm');
                
                if (form.checkValidity()) {
                    const formData = new FormData(form);

                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>index.php/admin/admin/add_customer' ,
                        data: {
                            'type'      : formData.get('type'),
                            'name'      : formData.get('name'),
                            'house'     : formData.get('house'),
                            'street'    : formData.get('street'),
                            'post'      : formData.get('post'),
                            'district'  : formData.get('district'),
                            'state'     : formData.get('state'),
                            'pincode'   : formData.get('pincode'),
                            'phone'     : formData.get('phone'),
                            'email'     : formData.get('email')
                        },
                        success: function (data) {
                            if (data) {
                                setDevotee(JSON.parse(data))
                            }
                        }
                    });
        
                } else {
                  const invalidInputs = document.querySelectorAll('.custom-input:invalid');
                  $('.custom-input').css('border-color', 'unset');
                  invalidInputs.forEach(input => {
                    $(input).css('border-color', 'red');
                  });
                  
                  Swal.showValidationMessage('Please fill in all required fields.');
                }
              },
              didRender: () => {
                // Bootstrap 4: Apply Bootstrap styling to the modal content
                $('.swal2-container').addClass('bootstrap-4-modal');
              },
              didDestroy: () => {
                // Cleanup input styles after modal is destroyed
                const invalidInputs = document.querySelectorAll('.custom-input');
                invalidInputs.forEach(input => {
                  $(input).css('border-color', 'unset');
                });
              }
            });
	    })
	    
	    
	    
	    
    // Add Schedule
    $('#schedule_btn').on('click', () => {
        openNewWindow()
    })
    
    // Delete Row 
    $(document).on('click', '.delete-row-btn', (e) => {
        let $row = $(e.target).closest('tr');
        let reference_no   = $row.find('.delete-row-btn').data('id')
        
        var url = "<?php echo base_url(); ?>index.php/admin/newbilling/deleteGuestBillingDetail";
        $.ajax({
           type: 'POST',
           url: url,
           dataType: "json",
           data: {
                reference_no: reference_no
           },
           success: function(data) {
                if(data.status == 'success') {
                    $row.remove()
                    calculateGrandTotal()
                }
           }
        });
        
    })
    
    // Show Details 
    $(document).on('click', '.view-details-btn', (e) => {
        let $row = $(e.target).closest('tr');
        let reference_no   = $row.find('.view-details-btn').data('id')

        var windowOptions = 'width=800,height=600';
        var formUrl       = "viewScheduleBillingDetail/"+reference_no;
        
        // Open the new window with the form URL and options
        var newWindow = window.open(formUrl, '_blank', windowOptions);

        // Focus the new window (optional)
        if (newWindow) {
            newWindow.focus();
        } else {
            alert('Popup blocked! Please allow popups for this site.');
        }
        
    })
    
    window.addEventListener('message', (event) => {
        if (event.data?.pooja) {
            createPoojaRow(event.data.pooja)
            if ($('#customer_id').val()) {
                $('#name').focus().select()   
            } else {
                $('#search_devotee').focus().select()   
            }
        }
    });
</script>
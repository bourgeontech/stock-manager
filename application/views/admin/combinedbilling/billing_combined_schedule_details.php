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
            body, .fluid-container {
               height:100vh;
            }
            .table {
                overflow: scroll !important;
            }
    	</style>
	</head>
	<body>
	    
    	<div class="fluid-container mt-2 p-2">
    	    <button class="btn btn-danger float-right" id="close-btn"> Close </button>
    	    <h3 class="text-center"> Schedule Details </h3>
    	    <div class="card p-1">
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
                                    <?php foreach($orders as $key => $order) { ?>
                                        <tr>
                                            <td> <?php echo $key + 1; ?> </td>
                                            <td> <?php echo $order->pooja." | ".$order->pooja_locale; ?> </td>
                                            <td> <?php echo $order->name; ?> </td>
                                            <td> <?php echo $order->star; ?> </td>
                                            <td> <?php echo date('d-m-Y', strtotime($order->pooja_date)); ?> </td>
                                            <td> <?php echo $order->quantity; ?> </td>
                                            <td> <?php echo $order->rate; ?> </td>
                                            <td> <?php echo $order->quantity * $order->rate + $order->postal; ?> </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-danger delete-row-btn" type="button" data-id="<?php echo $order->id; ?>"> <i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        
        </div>
        
        
        <!-- Scripts -->
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/admin/js/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            // Delete Row 
            $(document).on('click', '.delete-row-btn', (e) => {
                let $row = $(e.target).closest('tr');
                let id   = $row.find('.delete-row-btn').data('id')
                
                var url = "<?php echo base_url(); ?>index.php/admin/newbilling/deleteOrderById";
                $.ajax({
                   type: 'POST',
                   url: url,
                   dataType: "json",
                   data: {
                        id: id
                   },
                   success: function(data) {
                        if(data.status == 'success') {
                            $row.remove()
                            locatio.reload()
                        }
                   }
                });
            })
            
            $('#close-btn').on('click', () => {
                window.close();
                window.opener.location.reload();
                if (window.opener && !window.opener.closed) {
                    window.opener.focus();
                }
            })
        </script>
    </body>
</html>
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
    	    <h3 class="text-center"> Pooja List with Code </h3>
    	    <div class="card p-1">
                <div class="row">
                        <div class="col-md-12">
                            <form  action="<?php echo base_url();?>index.php/admin/newbilling/viewPoojaList" method="post">
                                <div class="input-group">
                                  <input type="text" class="form-control" title="Keyword" placeholder="Search with Pooja Name" name="keyword" value="<?php if(isset($keyword)) { echo $keyword; } ?>" required style="margin:10px 0;">
                                  <?php echo form_error('keyword', '<div class="error">', '</div>'); ?>
                                  <div class="input-group-append" style="margin:10px 0;">
                                    <button type="submit" class="btn btn-outline-secondary" name="serch" value="search" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button> 
                                  </div>
                                </div>
                              </form>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-hover mb-5" id="details_table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Code</th>
                                        <th>Pooja</th>
                                        <th class="text-center">Rate</th>
                                        <th class="text-center">Time</th>
                                        <th class="text-center">Allowed Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($poojas as $key => $pooja) { ?>
                                        <tr class="table-row" data-id="<?php echo $pooja->id; ?>" style="cursor:pointer">
                                            <td class="text-orange text-center"> <b> <?php echo $pooja->code; ?> </b> </td>
                                            <td> <?php echo $pooja->pooja." | ".$pooja->pooja_locale; ?> </td>
                                            <td class="text-center"> <?php echo $pooja->rate; ?> </td>
                                            <td class="text-center"> <?php echo $pooja->time; ?> </td>
                                            <td class="text-center"> <?php echo $pooja->allowed_qty; ?> </td>
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
            $(document).ready(function() {
                $(".table-row").click(function() {
                    let id = $(this).data('id')
                    
                    var url = "<?php echo base_url(); ?>index.php/admin/newbilling/getPoojaById";
                    $.ajax({
                       type: 'POST',
                       url: url,
                       dataType: "json",
                       data: {
                            id: id
                       },
                       success: function(data) {
                            if(data) {
                                window.opener.postMessage({ pooja: data }, '*');
                                window.close();
                                if (window.opener && !window.opener.closed) {
                                    window.opener.focus();
                                }
                            }
                       }
                    });
                    
                });
            });

            $('#close-btn').on('click', () => {
                window.close();
                if (window.opener && !window.opener.closed) {
                    window.opener.focus();
                }
            })
        </script>
    </body>
</html>
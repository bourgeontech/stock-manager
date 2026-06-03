<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Punnyam - Temple Management Software" name="description">
		<meta content="Bourgeon Innovations Private Limited" name="author">
    	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    	<meta http-equiv="Pragma" content="no-cache">
    	<meta http-equiv="Expires" content="0">
    	<meta name="googlebot" content="noindex">
		<meta name="googlebot-news" content="nosnippet">
    
		<meta name="keywords" content="admin site template, html admin template,responsive admin template, admin panel template, bootstrap admin/admin panel template, admin template, admin panel template, bootstrap simple admin template premium, simple bootstrap admin template, best bootstrap admin template, simple bootstrap admin template, admin panel template,responsive admin template, bootstrap simple admin template premium"/>
		<link rel="icon" href="<?php echo base_url(); ?>/assets/admin/img/favicon.png" type="image/x-icon" sizes="35x35">
		<title>Temple Admin Dashboard</title>
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
        <!-- MULTI SELECT CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/plugins/multipleselect/multiple-select.css">
		<!-- SELECT2 CSS -->
		<link href="<?php echo base_url(); ?>/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
   		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
	</head>
	<?php 
	$this->db->select('*');
	$this->db->from('site_settings');
	$query = $this->db->get();
	$temple = $query->row();

	if(isset($this->loggedIn)){
    	
    	$name=$this->loggedIn['name'];
    	$email=$this->loggedIn['username'];
    	$role=$this->loggedIn['role'];
    }
    $this->db->select('id');
    $this->db->from('role_master');
    $this->db->where('label', $role);
    $role_id = $this->db->get()->row_array();
    $this->db->select('permission.label');
    $this->db->from('role_permission');
    $this->db->join('permission','permission.id = role_permission.permission');
    $this->db->where('role_permission.role', $role_id['id']);
    $roles = $this->db->get()->result_array();
    foreach ($roles as $rol){
        $pemission[]=$rol['label'];
    }

	$code_settings = $temple->code_settings;
	// $daily_pooja_summary = $temple->daily_pooja_summary;

    ?>
    <body class="app">
		<div id="global-loader">
			<img src="<?php echo base_url(); ?>/assets/new_style/images/svgs/loader.svg" class="loader-img" alt="Loader">
		</div>

		<div class="page">
			<div class="page-main">
				<!-- HEADER -->
				<div class="header top-header">
                 
					<div class="container-fluid">
                   		<div class="col-md-12 clearfix "></div>
						<div class="d-flex header-nav">
							<a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a>
						    <div class="color-headerlogo">
								<a class="header-desktop" href="index.html"></a>
								<a class="header-mobile" href="index.html"></a> 
                             <?php if ($role!="Webuser"){?>	<nav class="navbar">
  									<a class="btn btn-secondary" href="<?php echo base_url();?>index.php/admin/admin/billing">Billing -(F1) </a> 
                                	<?php if($code_settings == 5 || $code_settings == 7): ?>
                                	<a class="btn btn-success" href="<?php echo base_url();?>index.php/admin/schedulebilling/multy_schedule_hierarchical_pooja">Scheduled Billing (F2)</a>
                                	<?php else: ?>
                                	<a class="btn btn-success" href="<?php echo base_url();?>index.php/admin/admin/schedule">Scheduled Billing (F2)</a>
                                	<?php endif; ?>
          							<a class="btn btn-info" href="<?php echo base_url();?>index.php/admin/admin/billing_view">Bill Reprint-(F3) </a> 
                                	<a class="btn btn-warning" href="<?php echo base_url();?>index.php/admin/admin/counter_wise">Counter Wise Report (F4)</a>
            						<a class="btn btn-danger" href="<?php echo base_url();?>index.php/admin/admin/detail_view">Daily Summary ( F5 )</a>
                                	<a class="btn btn-success" href="<?php echo base_url();?>index.php/admin/admin/bill_summary">Daily  Pooja Summary </a> 
                            		<a class="btn btn-secondary" href="<?php echo base_url();?>index.php/admin/admin/bill_report">Pooja  Summary(F7)</a>
           							<a class="btn btn-success " href="<?php echo base_url();?>index.php/admin/admin/pooja_calendar" >Pooja Availability Calendar</a>
                                	<a class="btn btn-warning" href="<?php echo base_url();?>index.php/admin/billing/assign_allowed_quantity" >Update Pooja Quantity</a>
                            	</nav><?php } ?>
                            	  <script>
//   	const loadCalendar = (events = null) => {
        
//         const today         = new Date();
//         const currentYear   = today.getFullYear();
//         const currentMonth  = (today.getMonth() + 1).toString().padStart(2, "0");

//         // Initialize the FullCalendar
//         // ----------------------------------------------
        
// 		calendar = new FullCalendar.Calendar( document.getElementById( "poojaCalendar" ), {
//         			height: 350,
//                     timeZone: "UTC",
//                     editable: true,
//                     droppable: true, // this allows things to be dropped onto the calendar
//                     dayMaxEvents: true, // allow "more" link when too many events
//                     headerToolbar: {
//                         left: "prev,next today",
//                         center: "title",
//                         right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
//                     },
//             		eventBackgroundColor: "red",
//                     themeSystem: "bootstrap",
            
//                     bootstrapFontAwesome: {
//                         close: " fa fa-times",
//                         prev: " demo-psi-arrow-left",
//                         next: " demo-psi-arrow-right",
//                         prevYear: " demo-psi-arrow-left-2",
//                         nextYear: " demo-psi-arrow-right-2"
//                     },
//                     events: events,
//                     dayRender: function (date, cell) {
// 						cell.css("background-color", "yellow");
// 					} 
//                 });

// 		calendar.render();
//     }
    
//     $('#language-switch').click(function() {
//         var newLanguage = '<?php echo ($this->session->userdata('language') == 'english') ? 'malayalam' : 'english'; ?>';
//         $.ajax({
//             url: '<?php echo base_url(); ?>index.php/welcome/set_language',
//             type: 'POST',
//             data: {language: newLanguage},
//             success: function(response) {
//                 window.location.reload();
//             }
//         });
//     });
  
//   	$('#availability_calendar').on('click', () => {
//     	$('#calendarModal').show();
//     	$('#search-input').empty()
//     	var events = [];
//     var calendar = ''
//     // Demo purpose - Set the event based on the current year and month.
//     // ----------------------------------------------
//     loadCalendar(events)
//     })
  </script>
							</div><!-- Color LOGO -->
                        	
							<div class="d-flex order-lg-2 ml-auto header-right-icons header-search-icon mr-3">
							    <div class="dropdown header-user">
									<a href="#" class="nav-link icon px-0" data-toggle="dropdown">
										<span><img src="<?php echo base_url(); ?>/assets/new_style/images/users/male/2.jpg" alt="profile-user" class="avatar brround cover-image mb-0 ml-0"></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<div class=" dropdown-header noti-title text-center border-bottom p-3">
											<div class="header-usertext">
												<h5 class="mb-1"><?php echo $name;?></h5>
												<p class="mb-0"><?php echo $role;?></p>
											</div>
										</div>
                                    	<?php if ($role=="superadmin"){?>
										<a class="dropdown-item" href="<?php echo base_url();?>index.php/admin/admin/temple_view">
											<i class="mdi mdi-settings mr-2"></i> <span>Temple Settings</span>
										</a>
                                    	<?php }?>
                                    	<?php if ($role=="superadmin" || $role=="admin"){?>
										<a class="dropdown-item" href="<?php echo base_url();?>index.php/admin/admin/user_view">
											<i class="mdi mdi-account-outline mr-2"></i> <span>User Settings</span>
										</a>
                                    	<?php }?>
                                    	<?php if ($role=="superadmin"){?>
										<a class="dropdown-item" href="<?php echo base_url();?>index.php/admin/admin/add_role">
											<i class="mdi mdi-account-key mr-2"></i> <span>Role Management</span>
										</a>
                                    	<?php }?>
										<a class="dropdown-item" id="logout-btn" href="<?php echo base_url();?>index.php/admin/admin/logout" onclick="event.preventDefault()">
											<i class="mdi  mdi-logout-variant mr-2"></i> <span>Logout</span>
										</a>
									</div>
								</div>
								<!--<div class="dropdown  header-fullscreen">-->
								<!--	<a class="nav-link icon sidebar-right-mobile" data-toggle="sidebar-right" data-target=".sidebar-right">-->
								<!--		<i class="fe fe-align-right" ></i>-->
								<!--	</a>-->
								<!--</div>--><!-- Side menu -->
							</div>
						</div>
					</div>
				</div>
				<!-- HEADER END -->
				<!-- HORIZONTAL-MENU -->
             	<div class="header pt-3">
                     <h3 class="mx-auto text-center"> <?php echo $temple->templename_eng;?> - <?php echo $temple->templename_mal; ?> </h3>
                 </div>
            <div class="sticky">
					<div class="horizontal-main hor-menu clearfix ">
						<div class="horizontal-mainwrapper container-fluid clearfix">
							<nav class="horizontalMenu clearfix">
								<ul class="horizontalMenu-list">
									<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/dashboard" class=""><i class="fe fe-home"></i> Dashboard</a></li>
									<?php 
									if (in_array("add_diety", $pemission)
									    ||in_array("diety_view", $pemission)
									    ||in_array("pooja_assign",$pemission)
									    ||in_array("add_pooja", $pemission)
									    ||in_array("pooja_view", $pemission)
									    ||in_array("kooru_usr", $pemission)
									    ||in_array("kooru_mng", $pemission)
									    ||in_array("kooru_rpt", $pemission)
										||in_array("add_cat", $pemission)
										||in_array("cat_view", $pemission)
									    ||in_array("birth_star", $pemission)){
									?>
									<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-settings"></i> Master &nbsp;&nbsp;<i class="fa fa-angle-down horizontal-icon"></i></a>
										
										<ul class="sub-menu">
										<?php if (in_array("inv_product", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/inv_product">Product</a></li>
        											<?php 
                                                    }if (in_array("supplier", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/supplier">Supplier</a></li>
        											<?php 
                                                    }
													?>
										<?php 
											if (in_array("addLedgerGroup", $pemission)||
											    in_array("viewLedger", $pemission)){
    									    ?>
    										<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Account Settings</a>
    											<ul class="sub-menu">
    											<?php 
    											if (in_array("addLedgerGroup", $pemission)){
											    ?>
    											<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/addLedgerGroup"> Group</a></li>
    											<?php 
    											}if (in_array("viewLedger", $pemission)){
											    ?>
    											<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/viewLedger"> Ledger</a></li>
    											<?php 
    											}if ($role == 'superadmin'){
											    ?>
    											<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/createBanks"> Banks </a></li>
                                                <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/createCounterBanks"> Counter Banks </a></li>
                                                <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/mapLedgerModes"> Ledger Modes </a></li>
                                                <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/mapLedgerCategory"> Ledger Categories</a></li>
    											<?php 
    											}
    											?>
    										    </ul>
    										</li>
												<?php } ?>
											<?php 
        									if (in_array("add_diety", $pemission)
        									    ||in_array("diety_view", $pemission)
        									    ||in_array("pooja_assign", $pemission)){
        									?>
										    <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Diety Management</a>
												<ul class="sub-menu">
													<?php 
													if (in_array("add_diety", $pemission)){
												    ?>
														<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/add_diety">Add New</a></li>
													<?php 
													}if (in_array("diety_view", $pemission)){
													?>
														<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/diety_view">View</a></li>
													<?php 
													}if (in_array("pooja_assign", $pemission)){
													?>
														<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/pooja_assign">Assign Pooja</a></li>
													<?php 
													}if (in_array("pooja_assign", $pemission)){
													?>
														<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/pooja_assign">Assign Pooja</a></li>
													<?php 
													}
													?>
												</ul>
											</li>
											<?php }
											if (in_array("add_pooja", $pemission)
											    ||in_array("pooja_view", $pemission)){
											?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Pooja Management</a>
												<ul class="sub-menu">
													<?php 
													if (in_array("add_pooja", $pemission)){
												    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/add_pooja">Add New</a></li>
													<?php 
													}if (in_array("pooja_view", $pemission)){
												    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/pooja_view">View</a></li>
													<?php 
													}if (in_array("muthalkoottu", $pemission)){
													?>
														<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/pooja/pooja_muthalkootu">Add Muthalkoottu</a></li>
                                                		<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/pooja/muthalkootu_list">View Muthalkoottu</a></li>
                                                		<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/pooja/muthalkootu_report">Muthalkoottu Report</a></li>
													<?php }
												    ?>
												</ul>
											</li>
											<?php }
											if (in_array("kooru_usr", $pemission)
											    ||in_array("kooru_mng", $pemission)
											    ||in_array("kooru_rpt", $pemission)){
											?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#"><?php echo $this->lang->line('Kooru') ?? 'Kooru'; ?> Management</a>
												<ul class="sub-menu">
													<?php 
													if (in_array("kooru_usr", $pemission)){
												    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/kooru_usr">User</a></li>
													<?php 
													}if (in_array("kooru_usr", $pemission)){
												    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/kooru_mng"><?php echo $this->lang->line('Kooru') ?? 'Kooru'; ?></a></li>
													<?php 
													}if (in_array("kooru_rpt", $pemission)){
												    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/kooru_rpt">Report (Pooja Date )</a></li>
                                                	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/date_wise_kooru_rpt">Report (Bill Date)</a></li>
                                                	<?php 
													}
												    ?>
												</ul>
											</li>
											<?php }
											
											 if (in_array("add_cat", $pemission)
											     ||in_array("cat_view", $pemission)){
											?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Category Management</a>
												<ul class="sub-menu">
													<?php 
													if (in_array("add_cat", $pemission)){
												    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/add_cat">Add New</a></li>
													<?php 
													}if (in_array("cat_view", $pemission)){
												    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/cat_view">View</a></li>
													<?php 
													}
												    ?>
												</ul>
											</li>


											<?php }
											if (in_array("birth_star", $pemission)){
											?>
											<li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/admin/admin/birth_star">Birth Star</a></li>
											<li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/admin/admin/gothra">Gothra</a></li>
											<li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/admin/admin/rashi">Rashi</a></li>
											<?php }?>
										</ul>
									</li>
									<?php 
									}
									if (in_array("add_customer", $pemission)
									    ||in_array("customer_view", $pemission)
                                        ||in_array("marriage_registration", $pemission)
									    ||in_array("customer_search", $pemission)){
									?>
									<li aria-haspopup="true">
            							<a href="#" class="sub-icon"><i class="fe fe-codepen"></i>Devotee &nbsp;&nbsp;<i class="fa fa-angle-down horizontal-icon"></i></a>
            							<ul class="sub-menu">
											<?php 
								            if (in_array("add_customer", $pemission)){
										    ?>
                                            <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/Devoteetype">Devotee Type </a></li>
											<?php 
								            }
										    ?>
            								<?php 
								            if (in_array("add_customer", $pemission)){
										    ?>
                                            <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/add_customer">Add New </a></li>
											<?php 
								            }if (in_array("customer_view", $pemission)){
										    ?>
            							    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/customer_view">View</a></li>
											<?php 
											}if (in_array("customer_search", $pemission)){
												?>
												<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/customer_search">Search</a></li>
												<?php
				 
											}if (in_array("marriage_registration", $pemission)){
												?>
												<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/marriage_registration_add">Marriage Registration</a></li>
												<?php 
											}if (in_array("add_room", $pemission)){
                                            ?>
                                            <li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/admin/admin/add_room">Room Details</a></li>
                                            <?php 
        									}if (in_array("add_cust", $pemission)){
        									?>
											<li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/admin/admin/add_cust">Room Customer</a></li>
											<?php 
        									}if (in_array("rend_post", $pemission)){
        									?>
											<li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/admin/admin/rend_post">Rent Post</a></li>
											<?php 
        									}if (in_array("room_trans", $pemission)){
        									?>
											<li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/admin/admin/room_trans">Room Transaction</a></li>
											<?php 
        									} if ($this->db->table_exists('room_bookings')){
										    ?>
                                        	<li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/admin/admin/room_enquiries">Room Enquiries</a></li>
            								<?php 
        									} 
										    ?>
                                    	</ul>
            						</li>
            						<?php 
									}
            						?>
            						<li aria-haspopup="true">
            							<a href="#" class="sub-icon"><i class="fe fe-codepen"></i>Billing &nbsp;&nbsp;<i class="fa fa-angle-down horizontal-icon"></i></a>
            							<ul class="sub-menu">
            								<?php 
								            if (in_array("billing", $pemission)){
										    ?>
            							    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/billing">Counter Billing </a></li>
            								<?php 
								            } if ($this->db->table_exists('memberships')){
										    ?>
            							    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/membership">Add Membership </a></li>
            								<?php 
								            } if (in_array("schedule", $pemission)){
										    ?>
                                            <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/schedule">Schedule Billing</a></li>
                                          <?php 
								            } if (in_array("other_billing", $pemission)){
										    ?>  <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/other_billing">Other Billing</a></li><?php 
								            } if (in_array("customer_payments", $pemission)){?>
            								<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/customerpayments">Customer Payments</a></li>
                                        	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/billing/captured_payments">Captured Payments</a></li>
                                            <?php 
								            }if (in_array("multy_schedule", $pemission)){
                                            	if($code_settings == 5 || $code_settings == 7) {
                                                	$href = 'index.php/admin/schedulebilling/multy_schedule_hierarchical_pooja'; 
                                                } else {
                                                	$href = 'index.php/admin/billing/multy_schedule'; 
                                                }
										    ?>
                                           <li aria-haspopup="true"><a href="<?php echo base_url().$href;?>">Multy Schedule </a></li>
            								<?php 
								            }if (in_array("fpooja", $pemission)){
										    ?>
                                            <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/fpooja">Family Pooja</a></li>
											<?php 
								            }if (in_array("add_pooja", $pemission)){
										    ?>
										<?php 
								            }if (in_array("billing", $pemission)){
										    ?>	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/deleted_bill">Deleted Bills</a></li>
            								<?php 
								            }if (in_array("donation", $pemission)||in_array("donation_view", $pemission)){
										    ?>
                                        	<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Donation &amp; Register</a>
                                        		<ul class="sub-menu">
                    								<?php 
        								            if (in_array("donation", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/donation">Add New</a></li>
                    								<?php 
        								            }if (in_array("donation_view", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/donation_view">View</a></li>
													<?php 
        								            }
													?>
												</ul>
											</li>
											<?php 
								            }if (in_array("billing_view/1", $pemission)||
								                 in_array("billing_view/2", $pemission)||
								                 in_array("billing_view/3", $pemission)||
								                 in_array("user_wise", $pemission)||
								                 in_array("user_wise_pooja", $pemission)||
								                 in_array("detail_view", $pemission)||
								                 in_array("daily_summary", $pemission)){
											?>
                                            <li aria-haspopup="true" class="sub-menu-sub"><a href="#">View Bills &amp; Reports</a>
												<ul class="sub-menu">
                    								<?php 
        								            if (in_array("billing_view/1", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/billing_view/1">Bill Printing</a></li>
                    								<?php 
        								            }if (in_array("billing_view/2", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/billing_view/2">Bill wise totals</a></li>
                    								<?php 
        								            }if (in_array("billing_view/3", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/billing_view/3">Daily pooja details</a></li>
                    								<?php 
        								            } ?>
                                                	<?php if ($this->db->table_exists('memberships')): ?>
                                        			<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/membership_report">Membership Report</a></li>
                                        			<?php endif; ?>
                                        			<?php if($this->db->field_exists('appearance', 'billing')): ?>
                                        			<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/poojaParticipationReport">Bill Date wise Participation Report </a></li>
                                        			<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/poojaParticipationReportByPoojaDate">Pooja Date wise Participation Report </a></li>
<!--                                         		<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/membershipReport">Membership Report </a></li> -->
                                        			<?php endif; ?>
                                                	<?php if (in_array("user_wise", $pemission)){
        								                ?>
                                                	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/billing/online_bills">Online Bills</a></li>
                                                	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/bill_report">Date Wise Report</a></li>
                                                	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/counter_wise">Counter Wise Report</a></li>
                                                	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/counter_wise_pooja">Counter Wise Detail</a></li>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/user_wise">User Wise Report</a></li>
                                                    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/schedule_billing_report">Schedule Pooja Report</a></li>
                                                	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/schedule_bills">Print Schedule Pooja</a></li>
                                                	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/billing/bill_report_poojawise">Deity wise Single Pooja Report</a></li>
                                                	<?php 
        								            }if (in_array("user_wise_pooja", $pemission)){
        								                ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/user_wise_pooja">User Wise Pooja Report</a></li>
                    								<?php 
        								            }if (in_array("detail_view", $pemission)){
        								                ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/detail_view">Daily Pooja wise summary
                                                    </a></li>
                                     
                    								<?php 
        								            }if (in_array("detail_view", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/daily_summary">Daily pooja collection summary</a></li>
                    							  	
                                                  <?php 
        								            }
        										    ?>
                                                    
												</ul>
											</li>
											<?php 
								            }if (in_array("pooja_view", $pemission)||
								                in_array("bill_report", $pemission)||
								                in_array("bill_summary", $pemission)||
								                in_array("detail_summary", $pemission)){
											?>
                                           <?php 
								            }if (in_array("billing", $pemission)){
										    ?> <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Pooja Reports</a>
												<ul class="sub-menu">
                    								<?php 
        								            if (in_array("billing", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/pooja_view">Pooja List</a></li>
                    								
                                                <?php 
                                                    }if (in_array("billing", $pemission)){
													?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/pooja_register">Pooja Register</a></li>
													<?php
        								            }if (in_array("bill_report", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/bill_report_important">Important Pooja Report</a></li>
                                                	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/billing/important_pooja_report">Important Pooja(Credits)</a></li>
                                                	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/bill_report">Deity wise Pooja wise List</a></li>
                                                 	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/pooja/bill_report_poojawise">Deity wise Single Pooja Report</a></li>
                    								<?php 
        								            }if (in_array("bill_summary", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/bill_summary">Daily Pooja wise Summary</a></li>
                    								<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/bill_summary_bytime">Prasadam Distribution List</a></li>	
                                                	<?php 
        								            }if (in_array("daily_pooja_mode_wise_summary", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/daily_pooja_mode_wise_summary">Daily Pooja Wise Summary</a></li>
                    								<?php 
        								            }if (in_array("detail_summary", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/detail_summary">Future Pooja Detailes</a></li>
                    								<?php 
        								            }if ($role=="superadmin"){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/cust_search">Future Pooja Balance</a></li>
                    								<?php 
        								            }
        										    ?>
												</ul>
											</li>
											<?php 
								            }if (in_array("deposite", $pemission)||
								                in_array("view_deposite", $pemission)||
								                in_array("fd_report", $pemission)){
											?>
                                            <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Deposit</a>
												<ul class="sub-menu">
                    								<?php 
        								            if (in_array("deposite", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/deposite">Add New</a></li>
                    								<?php 
        								            }if (in_array("view_deposite", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/view_deposite">View</a></li>
                    								<?php 
        								            }if (in_array("fd_report", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/fd_report">FD Report</a></li>
                    								<?php 
        								            }
        										    ?>
												</ul>
											</li>
											<?php 
								            }if (in_array("dittum_mstr", $pemission)||
								                in_array("dittum_list", $pemission)||
								                in_array("dittum_rprt", $pemission)||
								                in_array("dittum_summary", $pemission)){
											?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Dittum</a>
												<ul class="sub-menu">
                    								<?php 
        								            if (in_array("dittum_mstr", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/dittum_mstr">Add New</a></li>
                    								<?php 
        								            }if (in_array("dittum_list", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/dittum_list">View</a></li>
                    								<?php 
        								            }if (in_array("dittum_rprt", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/dittum_rprt">Report</a></li>
                    								<?php 
        								            }if (in_array("dittum_summary", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/dittum_summary">Summary</a></li>
                    								<?php 
        								            }
        										    ?>
												</ul>
											</li>
											<?php 
								            }if (in_array("dittum_mstr", $pemission)||
								                in_array("amount", $pemission)||
								                in_array("transaction", $pemission)||
								                in_array("bandaram_report", $pemission)||
								                in_array("bandaram_summary", $pemission)){
											?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#"><?php echo $this->lang->line('treasure') ?? 'Bandaram'; ?></a>
												<ul class="sub-menu">
                    								<?php 
        								            if (in_array("bandaram", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/bandaram"><?php echo $this->lang->line('treasure') ?? 'Bandaram'; ?></a></li>
                    								<?php 
        								            }if (in_array("amount", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/amount">Amount</a></li>
                    								<?php 
        								            }if (in_array("transaction", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/transaction">Transaction</a></li>
                    								<?php 
        								            }if (in_array("bandaram_report", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/bandaram_report">Transaction Report</a></li>
                    								<?php 
        								            }if (in_array("bandaram_summary", $pemission)){
        										    ?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/bandaram_summary">Transaction Summary</a></li>
                    								<?php 
        								            }
        										    ?>
												</ul>
                                                
											</li>
                                             <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/counter_settings">Counter Settings</a></li>
											<?php 
								            }
											?>
            							</ul>
            						</li>
            						<?php 
									if (in_array("addLedgerGroup", $pemission)
									    ||in_array("viewLedger", $pemission)
									    ||in_array("viewReceipt", $pemission)
									    ||in_array("viewPayment", $pemission)
									    ||in_array("viewjournal", $pemission)
									    ||in_array("viewcontra", $pemission)
									    ||in_array("dayclosing", $pemission)
									    ||in_array("dayBook", $pemission)
									    ||in_array("cashbook", $pemission)
									    ||in_array("ledgerWise", $pemission)
									    ||in_array("report", $pemission)
									    ||in_array("incomeExpense_rprt", $pemission)
									    ||in_array("cash_bank", $pemission)
									    ||in_array("ass_cat", $pemission)
									    ||in_array("ass_subcat", $pemission)
									    ||in_array("add_loc", $pemission)
									    ||in_array("add_asset", $pemission)
									    ||in_array("view_asset", $pemission)
									    ||in_array("inv_cat", $pemission)
									    ||in_array("inv_unit", $pemission)
									    ||in_array("inv_product", $pemission)
									    ||in_array("supplier", $pemission)
									    ||in_array("inv_opening", $pemission)
									    ||in_array("purchase", $pemission)
									    ||in_array("purchase_view", $pemission)
									    ||in_array("issue_product", $pemission)
									    ||in_array("adjustment_view", $pemission)
									    ||in_array("stock_report", $pemission)){
									?>
            						<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-inr"></i> Accounts &nbsp;&nbsp;<i class="fa fa-angle-down horizontal-icon"></i></a>
										<ul class="sub-menu">
											<?php 
											if (in_array("addLedgerGroup", $pemission)||
											    in_array("viewLedger", $pemission)){
    									    ?>
    										<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Account Settings</a>
    											<ul class="sub-menu">
    											<?php 
    											if (in_array("addLedgerGroup", $pemission)){
											    ?>
    											<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/addLedgerGroup"> Group</a></li>
    											<?php 
    											}if (in_array("viewLedger", $pemission)){
											    ?>
    											<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/viewLedger"> Ledger</a></li>
    											<?php 
    											}if ($role == 'superadmin'){
											    ?>
    											<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/createBanks"> Banks </a></li>
                                                <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/createCounterBanks"> Counter Banks </a></li>
                                                <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/mapLedgerModes"> Ledger Modes </a></li>
                                                <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/mapLedgerCategory"> Ledger Categories</a></li>
    											<?php 
    											}
    											?>
    										    </ul>
    										</li>
    										<?php 
											}if (in_array("viewReceipt", $pemission)){
    										?>
    										<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/viewReceipt">Receipt</a></li>
    										<?php 
											}if (in_array("viewPayment", $pemission)){
    										?>
    										<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/viewPayment">Payment</a></li>
    										<?php 
											}if (in_array("viewjournal", $pemission)){
    										?>
                                            <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/viewjournal">Journal</a></li>
    										<?php 
											}if (in_array("viewcontra", $pemission)){
    										?>
                                            <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/viewcontra">Contra</a></li>
    										<?php 
											}if (in_array("dayclosing", $pemission)){
    										?>
    										<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/dayclosing">Day Closing</a></li>
    										<?php 
											}if (in_array("dayBook", $pemission)
											    ||in_array("cashbook", $pemission)
											    ||in_array("ledgerWise", $pemission)
											    ||in_array("report", $pemission)
											    ||in_array("incomeExpense_rprt", $pemission)
											    ||in_array("cash_bank", $pemission)){
    										?>
										    <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Report</a>
												<ul class="sub-menu">
        										<?php 
    											if (in_array("dayBook", $pemission)){
        										?>
												<!--<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/dayBook">Day Book</a></li>-->
        										<?php 
    											}if (in_array("cashbook", $pemission)){
        										?>
												<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/cashbook">Cash Book</a></li>
        										<?php 
    											}if (in_array("cashbook", $pemission)){
													?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/cashbook_twodays">CashBook Between 2 Days</a></li>
													<?php 
													}if (in_array("ledgerWise", $pemission)){
        										?>
											<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/ledgerWise">Ledger Wise</a></li>
        										<?php 
    											}if (in_array("report", $pemission)){
        										?>
											<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/report">Reciepts & Payments</a></li>
        										<?php 
    											}if (in_array("incomeExpense_rprt", $pemission)){
        										?>
												<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/incomeExpense_rprt">Income Expense Report</a></li>
        										<?php 
    											}if (in_array("cash_bank", $pemission)){
        										?>
										 <!-- <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/cash_bank">Cash &amp; Bank</a></li>-->
											    <?php 
    											}
											    ?>
												</ul>
											</li>
											<?php 
        									}if (in_array("ass_cat", $pemission)
        									    ||in_array("ass_subcat", $pemission)
        									    ||in_array("add_loc", $pemission)
        									    ||in_array("add_asset", $pemission)
        									    ||in_array("view_asset", $pemission)){
    										?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Asset Register</a>
												<ul class="sub-menu">
        											<?php 
                									if (in_array("ass_cat", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/ass_cat">Category</a></li>
        											<?php 
                									}if (in_array("ass_subcat", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/ass_subcat">Sub Category</a></li>
													
        											<?php 
                									}if (in_array("add_loc", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/ass_loc">Location</a></li>
        											<?php 
                									}if (in_array("add_asset", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/add_asset">Add Asset</a></li>
        											<?php 
                									}if (in_array("view_asset", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/view_asset">View</a></li>
													<?php 
                									}
													?>
												</ul>
											</li>
											<?php 
                                            }if (in_array("inv_cat", $pemission)
                                                ||in_array("inv_unit", $pemission)
                                                ||in_array("inv_product", $pemission)
                                                ||in_array("supplier", $pemission)
                                                ||in_array("inv_opening", $pemission)
                                                ||in_array("purchase", $pemission)
                                                ||in_array("purchase_view", $pemission)
                                                ||in_array("issue_product", $pemission)
                                                ||in_array("adjustment_view", $pemission)
                                                ||in_array("stock_report", $pemission)){
    										?>
										
											<?php 
                                            }
											?>
										</ul>
									</li>
                           	<?php if ($role!="Webuser"){?>   
                                
                                <li aria-haspopup="true"><a href="#" class="sub-icon">
                                <i class="fa fa-cat"></i> Inventory &nbsp;&nbsp;<i class="fa fa-angle-down horizontal-icon"></i></a>
												<ul class="sub-menu">
        											<?php 
                                                    if (in_array("inv_cat", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/inv_cat">Product Category</a></li>
        											<?php 
                                                    }if (in_array("inv_unit", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/inv_unit">Unit</a></li>
        											<?php 
                                                    }if (in_array("inv_product", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/inv_product">Product</a></li>
        											<?php 
                                                    }if (in_array("supplier", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/supplier">Supplier</a></li>
        											<?php 
                                                    }if (in_array("inv_opening", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/inv_opening">Opening Stock</a></li>
        											<?php 
                                                    }if (in_array("purchase", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/purchase">Purchase</a></li>
        											<?php 
                                                    }if (in_array("purchase_view", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/purchase_view">Manage Purchases</a></li>
        											<?php 
                                                    }if (in_array("issue_product", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/issue_product">Issue Product</a></li>
        											<?php 
                                                    }if (in_array("adjustment_view", $pemission)){
            										?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/adjustment_view">Adjustment</a></li>
        											<?php 
                                                    }if (in_array("stock_report", $pemission)){
            										?>
                                                	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/stock_report">Stock Report</a></li>
                                                	<?php 
                                                    }if (in_array("assign_products_to_pooja", $pemission)){
            										?>
                                                	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/inventory/assign_products_to_pooja">Assign Products to Pooja</a></li>
                                                	<?php 
                                                    }
                                                    ?>
												</ul>
											</li> <?php }?>
									<?php 
									}if (in_array("addPriest", $pemission)
									    ||in_array("viewPriest", $pemission)
									    ||in_array("addTrustee", $pemission)
									    ||in_array("viewTrustee", $pemission)
									    ||in_array("addFestivalCommittee", $pemission)
									    ||in_array("viewFestivalCommittee", $pemission)
									    ||in_array("addParipalanaSamithi", $pemission)
									    ||in_array("viewParipalanaSamithi", $pemission)){
									?>
									<li aria-haspopup="true">
            							<a href="#" class="sub-icon"><i class="fa fa-cogs"></i>The Temple &nbsp;&nbsp;<i class="fa fa-angle-down horizontal-icon"></i></a>
        								<ul class="sub-menu">
        									<?php 
        									if (in_array("addPriest", $pemission)
        									    ||in_array("viewPriest", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Priest Management</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addPriest", $pemission)){
                									?>
                                                    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addPriest">Add New </a></li>
                									<?php 
                									}if (in_array("viewPriest", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewPriest">View</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addTrustee", $pemission)
        									    ||in_array("viewTrustee", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Trustee Board</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addTrustee", $pemission)){
                									?>
                                                    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addTrustee">Add New </a></li>
                									<?php 
                									}if (in_array("viewTrustee", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewTrustee">View</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addFestivalCommittee", $pemission)
        									    ||in_array("viewFestivalCommittee", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Festival Committee</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addFestivalCommittee", $pemission)){
                									?>
                                                    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addFestivalCommittee">Add New </a></li>
                									<?php 
                									}if (in_array("viewFestivalCommittee", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewFestivalCommittee">View</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addParipalanaSamithi", $pemission)
        									    ||in_array("viewParipalanaSamithi", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Paripalana Samithi</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addParipalanaSamithi", $pemission)){
                									?>
                                                    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addParipalanaSamithi">Add New </a></li>
                									<?php 
                									}if (in_array("viewParipalanaSamithi", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewParipalanaSamithi">View</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
											<?php 
        									}if (in_array("add_book", $pemission)){
											?>
											<li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/admin/admin/add_book">Book Master</a></li>
											<?php 
											}if (in_array("book_issue", $pemission)){
											?>
											<li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/admin/admin/book_issue">Issue Book</a></li>
											<?php 
											}
        									?>
										</ul>
									</li>
									<?php 
									}if (in_array("addContent", $pemission)
									    ||in_array("viewContent", $pemission)
									    ||in_array("addBanner", $pemission)
									    ||in_array("viewBanner", $pemission)
									    ||in_array("addAdvertisement", $pemission)
									    ||in_array("viewAdvertisement", $pemission)
									    ||in_array("addGallery", $pemission)
									    ||in_array("viewGallery", $pemission)
									    ||in_array("addEventFestival", $pemission)
									    ||in_array("viewEventFestival", $pemission)
									    ||in_array("addNews", $pemission)
									    ||in_array("viewNews", $pemission)
									    ||in_array("addAnnouncements", $pemission)
									    ||in_array("viewAnnouncements", $pemission)
									    ||in_array("addTempleRules", $pemission)
									    ||in_array("viewTempleRules", $pemission)
									    ||in_array("addTempleTiming", $pemission)
									    ||in_array("addContact", $pemission)){
									?>
            						<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-settings"></i> CMS &nbsp;&nbsp;<i class="fa fa-angle-down horizontal-icon"></i></a>
										<ul class="sub-menu">
        									<?php 
        									if (in_array("addContent", $pemission)
        									    ||in_array("viewContent", $pemission)){
        									?>
										    <li aria-haspopup="true" class="sub-menu-sub"><a href="#">About Us</a>
												<ul class="sub-menu">
                									<?php 
    									            if (in_array("addContent", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addContent">Add New</a></li>
                									<?php 
    									            }if (in_array("viewContent", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewContent">View</a></li>
													<?php 
    									            }
    									            ?>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addBanner", $pemission)
        									    ||in_array("viewBanner", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Banner</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addBanner", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addBanner">Add New</a></li>
                									<?php 
                									}if (in_array("viewBanner", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewBanner">View</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addAdvertisement", $pemission)
        									    ||in_array("viewAdvertisement", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Advertisement</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addAdvertisement", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addAdvertisement">Add New</a></li>
                									<?php 
                									}if (in_array("viewAdvertisement", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewAdvertisement">View Advertisement</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addGallery", $pemission)
        									    ||in_array("viewGallery", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Gallery</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addGallery", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addGallery">Add New</a></li>
                									<?php 
                									}if (in_array("viewGallery", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewGallery">View</a></li>
													<?php 
                									} if ($this->db->table_exists('image_categories')){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addImageCategory">Add Image Category</a></li>
													<?php 
                									} if ($this->db->table_exists('image_categories')){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewImageCategories">View Image Category</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
											<?php
											}if ($this->db->table_exists('slider')){
											?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Slider</a>
												<ul class="sub-menu">
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addSlider">Add New</a></li>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewSlider">View</a></li>
												</ul>
											</li>
                                        	<?php
        									}if (in_array("addVideo", $pemission)
        									    ||in_array("viewVideo", $pemission)){
        									?>
                                        	<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Video</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addVideo", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addVideo">Add New</a></li>
                									<?php 
                									}if (in_array("viewVideo", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewVideo">View</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addEventFestival", $pemission)
        									    ||in_array("viewEventFestival", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Event Festival</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addEventFestival", $pemission)){
                									?>
                                                    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addEventFestival">Add New </a></li>
                									<?php 
                									}if (in_array("viewEventFestival", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewEventFestival">View</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addNews", $pemission)
        									    ||in_array("viewNews", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">News</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addNews", $pemission)){
                									?>
                                                    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addNews">Add New </a></li>
                									<?php 
                									}if (in_array("viewNews", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewNews">View</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addAnnouncements", $pemission)
        									    ||in_array("viewAnnouncements", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Announcements</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addAnnouncements", $pemission)){
                									?>
                                                    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addAnnouncements">Add New </a></li>
                									<?php 
                									}if (in_array("viewAnnouncements", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewAnnouncements">View</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
        									<?php 
        									}
											if (in_array("addAnnouncements", $pemission)
        									    ||in_array("viewAnnouncements", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Slider</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addAnnouncements", $pemission)){
                									?>
                                                    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addSlider">Add New </a></li>
                									<?php 
                									}if (in_array("viewAnnouncements", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewSlider">View</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addTempleRules", $pemission)
        									    ||in_array("viewTempleRules", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Temple Rules</a>
												<ul class="sub-menu">
                									<?php 
                									if (in_array("addTempleRules", $pemission)){
                									?>
                                                    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addTempleRules">Add New </a></li>
                									<?php 
                									}if (in_array("viewTempleRules", $pemission)){
                									?>
													<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewTempleRules">View</a></li>
													<?php 
                									}
                									?>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addTempleTiming", $pemission)){
        									?>
											<li aria-haspopup="true" class="sub-menu-sub"><a href="#">Temple Timing</a>
												<ul class="sub-menu">
													<!--<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/viewTempleTiming">View</a></li>-->
                                                    <li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/cms/addTempleTiming">Add New </a></li>
												</ul>
											</li>
        									<?php 
        									}if (in_array("addContact", $pemission)){
        									?>
											<li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/cms/addContact">Contact</a></li>
											<?php 
        									}if (in_array("viewSitesetting", $pemission)){
        									?>
											<li aria-haspopup="true" ><a href="<?php echo base_url();?>index.php/cms/viewSitesetting"><?php echo ($this->session->userdata('language') == 'english') ? 'Site Setting ' : 'സൈറ്റ് ക്രമീകരണങ്ങൾ' ?></a></li>
											<?php 
        									}
        									?>
										</ul>
									</li>
									<?php 
									} 
									?>
                                <?php if ($role!='Webuser'){?>
									<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-file"></i> Reports &nbsp;&nbsp;<i class="fa fa-angle-down horizontal-icon"></i></a>
										<ul class="sub-menu">
											<?php if (in_array("nadavaravu_statement", $pemission)){?><li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/adjustment_report">Nadavaravu Statement</a></li><?php } ?>
                                        	<?php if (in_array("pos_userwise_report", $pemission)){?><li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/pos_user_wise_report">POS User Wise Report</a></li><?php } ?>
                                        	<?php if (in_array("pooja_availability_log", $pemission)){?><li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/poojaAvailabilityLog">Pooja Availability Log</a></li><?php } ?>
                                        	<?php if (in_array("postal_address", $pemission)){?><li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/postalAddresses">Postal Addresses</a></li><?php } ?>
                                        	<?php if (in_array("monthly_expenditure_report", $pemission)){?><li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/accounts/expenditureReport">Monthly Expenditure  Statement</a></li><?php } ?>
                                        	<?php if ($this->db->table_exists('custom_booking_details')): ?>
                                        	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/customBookings">Custom Booking Report</a></li>
                                        	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/admin/counter_wise_category">Counter wise Category Report</a></li>
                                    <!--    	<?php endif; ?>-->
<!--                                         	<?php if ($this->db->table_exists('memberships')): ?>
                                        	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/membership_report">Membership Report</a></li>
                                        	<?php endif; ?>
                                        	<?php if($this->db->field_exists('appearance', 'billing')): ?>
                                        	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/poojaParticipationReport">Bill Date wise Participation Report </a></li>
                                        	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/poojaParticipationReportByPoojaDate">Pooja Date wise Participation Report </a></li>
<!--                                         	<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/report/membershipReport">Membership Report </a></li> -->
                                        <!--	<?php endif; ?> -->
										</ul>
									</li> <?php } ?>
              
                                	<?php if ($this->db->table_exists('memberships')): ?>
                                	<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-file"></i> Email &nbsp;&nbsp;<i class="fa fa-angle-down horizontal-icon"></i></a>
										<ul class="sub-menu">
											<li aria-haspopup="true"><a href="<?php echo base_url();?>index.php/admin/email">Draft Email</a></li>
										</ul>
									</li>
                                	<?php endif; ?>
                                	<?php if ($_SERVER['HTTP_HOST']=='kaladyshankaramadomts.org'){ ?>
                                	<li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-file"></i> Kaladay Adi Shankara Madom Devaswom &nbsp;&nbsp;<i class="fa fa-angle-down horizontal-icon"></i></a>
										<ul class="sub-menu">
											<li aria-haspopup="true"><a href="https://ayyappadevalayamtaramattipeta.com/index.php/admin/"  target="_blank">AyyappaTemple TaramattiPet</a></li>
                                        <li aria-haspopup="true"><a href="http://sdasds.org/index.php/admin"  target="_blank">SDSADS</a></li>
                                         <li aria-haspopup="true"><a href="https://ayb.kaladyshankaramadomts.org/index.php/admin/"  target="_blank">AYB</a></li>
										
                                    
                                    
                                    </ul>
									</li>
                                	<?php } ?>
								</ul>
								</ul>
							</nav>
							<!-- NAV END -->
						</div>
					</div>
				</div><!-- Sicky-->
				<div class="container-fluid  content-area">
					<div class="section">
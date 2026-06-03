<!-- CONTAINER -->

						<div class="page-header">
						    <?php //date_default_timezone_set('Africa/Kampala'); echo date("F j, Y"); ?>
						</div>
						<!-- PAGE-HEADER END -->
                        <?php
 						date_default_timezone_set('Asia/Calcutta');
                        $today=date('Y-m-d');
						
						$this->db->select_sum('billing_dtls.amount');
						$this->db->from('billing_dtls');
						$this->db->join('billing', 'billing_dtls.bill_id = billing.id');
						$this->db->where('billing.date', $today);
						$this->db->where('billing.deleted', 0);
						$query = $this->db->get();
						$todays_collection = $query->row()->amount;

                        $this->db->select('billing.id');
						$this->db->from('billing');
						$this->db->where('billing.date', $today);
						$this->db->where('billing.deleted', 0);
						$this->db->where('billing.status', 2);
						$online_query = $this->db->get();

                        $total_online_bookings = $online_query->num_rows();
                     	
						$this->db->select('billing.id');
						$this->db->from('billing');
						$this->db->where('billing.date', $today);
						$this->db->where('billing.deleted', 0);
						$this->db->where('billing.status', 1);
						$counter_query = $this->db->get();

                        $total_counter_bookings = $counter_query->num_rows();

						$query4 = $this->db->query("SELECT image FROM  banner where is_delete='0' and display_order=4");
						if($query4->num_rows() > 0) {
                        	$result4 = $query4->result_array();
							$adminimage=@$result4['0']['image'];
                        } else {
                        	$query5 = $this->db->query("SELECT image FROM  banner where is_delete='0' limit 3,4");
                        	$result5 = $query5->result_array();
							$adminimage=@$result5['0']['image'];
                        }
                        

       					if(isset($this->loggedIn)){
    						$name=$this->loggedIn['name'];
    						$email=$this->loggedIn['username'];
    						$role=$this->loggedIn['role'];
    					}                 
				?>
						<!-- ROW -->
			<?php if ($role=="superadmin"){?>						
						<div class="row">
							<div class="col-sm-12 col-lg-3 col-md-6" onClick="location='<?php echo base_url();?>index.php/admin/admin/customer_view'" style="cursor: pointer;">
								<div class="card card-img-holder text-default bg-color">
									<div class="row">
										<div class="col-4">
											<div class="circle-icon bg-primary-gradient text-center align-self-center shadow-primary"><img src="<?php echo base_url(); ?>/assets/new_style/images/svgs/circle.svg" alt="img" class="card-img-absolute"><i class= "lnr lnr-user fs-30  text-white mt-4"></i></div>
										</div>
										<div class="col-8">
											<div class="card-body p-4">
												<h1 class="mb-3 number-font">Devotee</h1>
												<h5 class="font-weight-normal mb-0">&nbsp;</h5>
											</div>
										</div>
									</div>
							   </div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-lg-3 col-md-6" onClick="location='<?php echo base_url();?>index.php/admin/admin/pooja_view'" style="cursor: pointer;">
								<div class="card card-img-holder text-default">
									<div class="row">
										<div class="col-4">
											<div class="card-img-absolute circle-icon bg-secondary-gradient align-items-center text-center shadow-warning"><img src="<?php echo base_url(); ?>/assets/new_style/images/svgs/circle.svg" alt="img" class="card-img-absolute"><i class= "lnr fe fe-command fs-30 text-white mt-4"></i></div>
										</div>
										<div class="col-8">
											<div class="card-body p-4">
												<h1 class="mb-3 number-font">Pooja</h1>
												<h5 class="font-weight-normal mb-0">Management</h5>
											</div>
										</div>
									</div>
							   </div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-lg-3 col-md-6" onClick="location='<?php echo base_url();?>index.php/admin/admin/bill_summary'" style="cursor: pointer;">
								<div class="card card-img-holder text-default">
									<div class="row">
										<div class="col-4">
											<div class="card-img-absolute  circle-icon bg-info-gradient align-items-center text-center shadow-info"><img src="<?php echo base_url(); ?>/assets/new_style/images/svgs/circle.svg" alt="img" class="card-img-absolute"><i class= "lnr fe fe-grid fs-30 text-white mt-4"></i></div>
										</div>
										<div class="col-8">
											<div class="card-body p-4">
												<h1 class="mb-3 number-font">Daily</h1>
												<h5 class="font-weight-normal mb-0">Summary</h5>
											</div>
										</div>
									</div>
							   </div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-lg-3 col-md-6" onClick="location='<?php echo base_url();?>index.php/admin/admin/billing'" style="cursor: pointer;">
								<div class="card card-img-holder text-default">
									<div class="row">
										<div class="col-4">
											<div class="card-img-absolute circle-icon bg-success-gradient align-items-center text-center shadow-success"><img src="<?php echo base_url(); ?>/assets/new_style/images/svgs/circle.svg" alt="img" class="card-img-absolute"><i class= " lnr fe fe-codepen fs-30 text-white mt-4 "></i></div>
										</div>
										<div class="col-8">
											<div class="card-body p-4">
												<h1 class="mb-3 number-font">Billing</h1>
												<h5 class="font-weight-normal mb-0">&nbsp;</h5>
											</div>
										</div>
									</div>
							   </div>
							</div>
						</div> <?php } ?>
						<!-- END ROW -->

						<!-- ROW-1 -->
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-5 col-xl-4">
								<div class="card">
									<div class="card-body d-flex">
										<div class="card-order">
											<h6 class="mb-2">Today's Collection</h6>
											<h2 class="mb-1"><i class="fa fa-inr"></i><span class="number-font counter"><?php echo $todays_collection;?></span></h2>
											<!--<p class="text-muted fs-12 mb-0">The daily changes of bookings report<a href="<?php echo base_url();?>index.php/admin/admin/bill_summary"> View Details..</a></p>-->
										</div>
										<div class="ml-auto">
											<a href="<?php echo base_url();?>index.php/admin/admin/detail_view"><span class="bg-primary-transparent icon-service text-primary"><i class="mdi mdi-av-timer  fs-2"></i> </span></a>
										</div>
									</div>
								</div>
								<div class="card ">
									<div class="card-body d-flex">
										<div class="card-order">
											<h6 class="mb-2">Todays online Bookings</h6>
											<h2 class="mb-1"><span class="number-font"><span class="counter"><?php echo $total_online_bookings;?></span></span></h2>
											<!--<p class="text-muted fs-12 mb-0">The daily online bookings report<a href="<?php echo base_url();?>index.php/admin/admin/billing_view"> View Details..</a></p>-->
										</div>
										<div class="ml-auto">
											<a href="<?php echo base_url();?>index.php/admin/billing/online_bills/2/<?php echo date('Y-m-d'); ?>"><span class="bg-secondary-transparent icon-service text-secondary"><i class="mdi mdi-cube  fs-2"></i> </span></a>
										</div>
									</div>
								</div>
                            	
								<div class="card">
									<div class="card-body d-flex">
										<div class="card-order">
											<h6 class="mb-2">Today's Counter bookings</h6>
											<h2 class="mb-1"><span class="number-font counter"><?php echo $total_counter_bookings; ?></span></h2>
											<!--<p class="text-muted fs-12 mb-0">The daily changes of online bookings report<a href="<?php echo base_url();?>index.php/admin/admin/bill_summary"> View Details..</a></p>-->
										</div>
										<div class="ml-auto">
											<a href="<?php echo base_url();?>index.php/admin/admin/detail_view"><span class="bg-primary-transparent icon-service text-danger"><i class="mdi mdi-atom  fs-2"></i> </span></a>
										</div>
									</div>
								</div>
                            	<div class="card">
									<div class="card-body d-flex">
										<div class="card-order">
											<h6 class="mb-2">Today's Stock</h6>
											
										</div>
										<div class="ml-auto">
											<a href="<?php echo base_url();?>index.php/admin/admin/stock_report"><span class="bg-primary-transparent icon-service text-primary"><i class="fa fa-truck  fs-2"></i> </span></a>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							<div class="col-sm-12 col-md-12 col-lg-7 col-xl-8">
								<div class="card">
									<div class="card-body">
										<div class="mb-0">
										    <img src="<?php echo base_url(); ?>/uploads/banner/<?php print @$adminimage;?>" alt="img" class="overflow-hidden">
										</div>
									</div>
								</div>
							</div><!-- COL END -->
						</div>
					</div>
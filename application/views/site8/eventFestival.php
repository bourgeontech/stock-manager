        <main>
            <!-- page-ttle-area start  -->
            <div class="page-ttle-area text-center" data-background="<?php echo base_url(); ?>/assets/site8/img/bg/page-title-bg.jpg" style="height: 40px;">
                <div class="container">
                    <div class="page-title">
                        <h3 style="color: aliceblue; font-size: 40px;"> EVENTS</h3>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="<?php echo base_url(); ?>index.php/welcome/">home</a></li>
                                <li><span>News/Events</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-ttle-area start -->
            

        	
            <div class="team_details_area pt-5 pb-120">
            	<div class="container d-flex flex-row justify-content-end p-5">
                    <?php 
                    	$this->db->select('*');
                    	$this->db->from('event_brochure');
                		$brochure = $this->db->get()->row();
                    	$event_brochure   = $brochure->brochure;
                		$downloadLinkText = $brochure->title ?? 'Download Upcoming Event Brochure';
                    ?>
                    <a href="<?php echo base_url().$event_brochure; ?>" class="btn btn-outline-secondary"> <?php echo $downloadLinkText; ?> </a>
                	</div>
                <div class="container custome-container">
                	
                   <div class="row align-items-center">
                    <div class="row align-items-center">
                     <?php
                     if($eventFestival != 0):
                      foreach ($eventFestival as $value) {
                        $originalDate = $value['created'];
                        $newDate = date("d-m-Y", strtotime($originalDate));
                        $id=$value['id'];
                      ?>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="single-news mb-50">
                                    <div class="news-thumb">
                                       <img src="../../uploads/events/<?PHP echo $value['image']; ?>" alt="blog" class="img-fluid">
                                    </div>
                                    <div class="news-detalis-content">
<!--                                        <ul class="blog-meta mb-20">
                                          <li><a href="#"><i class="fal fa-user"></i>Narayan</a></li>
                                        
                                          <li><a href="#"><i class="fal fa-calendar-alt"></i> 24th March 2021</a></li>
                                       </ul> -->
                                       <h2 class="mt-2"><?php echo $value['title'];?></h2>
                                       <p><?php echo $value['description'];?></p>
<!--                                        <div class="read-button mt-30">
                                          <a href="#" class="sb-btn">Read More</a>
                                       </div>     -->
                                    </div>
                                </div>
                               
                              
                            </div>
                            
                        </div>
                    <?php
                        } 
                    else: ?>
                    <div class="text-center">No Events Found!</div>
                   <?php  endif; ?>
                        
                      
                       
                       
                     </div>
                     
                   
                        
                      </div>
                     
                   </div>
                  
                
                  

                </div>
            </div>
            <!-- causes-details-area-start -->
         
            <!-- causes-details-end -->

            <!-- related-causes-start -->
           
            <!-- related-causes-end -->

        </main>
      
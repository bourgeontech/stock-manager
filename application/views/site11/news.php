
  

        <main>
            <!-- page-ttle-area start  -->
            <div class="page-ttle-area text-center" data-background="<?php echo base_url(); ?>/assets/site8/img/bg/page-title-bg.jpg" style="height: 40px;">
                <div class="container">
                    <div class="page-title">
                        <h3 style="color: aliceblue; font-size: 40px;">     NEWS</h3>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="<?php echo base_url(); ?>index.php/welcome/">home</a></li>
                                <li><span>news/events</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-ttle-area start -->
            

            <div class="team_details_area pt-120 pb-120">
                <div class="container custome-container">
                   <div class="row align-items-center">
                    <div class="row align-items-center">
                    <?php
                      foreach ($news as $value) {
                        $originalDate = $value['created'];
                        $newDate = date("d-m-Y", strtotime($originalDate));
                        $id=$value['id'];
                      ?>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="fnservices mb-40">
                                <div class="fnservices__img">
                                    <a href="#"><img src="../../uploads/news/<?PHP echo $value['image']; ?>" alt=""></a>
                                </div>
                                <div class="fnservices__content">
<!--                                     <div class="sv-meta">
                                        <span><i class="fal fa-calendar-alt"></i> September 15, 2018</span>
                                    </div> -->
                                    <h3><?php echo $value['title'];?></h3>
                                    <p><?php echo $value['description'];?></p>
                                    
                                </div>
                            </div>
                        </div>
                    
                    <?php
                        }
                        ?>

                        
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
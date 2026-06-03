        <style>
        	.card img {
        		height: 240px !important;
        	}
		</style>
		<main>
            <!-- page-ttle-area start  -->
            <div class="page-ttle-area text-center" data-background="<?php echo base_url(); ?>/assets/site8/img/bg/page-title-bg.jpg" style="height: 40px;">
                <div class="container">
                    <div class="page-title">
                        <h3 style="color: aliceblue; font-size: 40px;"> Trust Board</h3>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="<?php echo base_url(); ?>index.php/welcome/">home</a></li>
                                <li><span>About</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-ttle-area start -->
           



            <div class="team-area pt-120 pb-80">
                <div class="container">
                    <div class="row">
                        <div class="news-info text-center mb-60">
                            <h4>Kalady Sri Adi Shankara Madom Trust - Telangana <br>
                            Regd NO- 172/BK-IV/2024
                                </h4>
                        </div>  
                    	<div class="row">
                    		<?php if(!empty($trustees)) { ?>
                         	<?php foreach($trustees as $trustee) { ?>
                    		<div class="col-md-3 mb-5">
                                <div class="card p-0 h-100">
                                	<img class="h-100" src="<?php echo base_url().'uploads/trustee/'.$trustee->image; ?>" />
                                	<div class="p-3 text-center align-center" style="vertical-align: middle;">
                                    	<h6> <?php echo $trustee->name; ?> </h6>
                                    	<p class="text-uppercase mb-0"> <?php echo $trustee->designation; ?> </p>
                                	</div>
                                </div> 
                        	</div>
                            <?php } ?>
                            <?php } ?>
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
    
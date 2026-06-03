   
        <main>
            <!-- page-ttle-area start  -->
            <div class="page-ttle-area text-center" data-background="<?php echo base_url(); ?>/assets/site8/img/bg/page-title-bg.jpg" style="height: 40px;">
                <div class="container">
                    <div class="page-title">
                        <h3 style="color: aliceblue; font-size: 40px;"> PHOTOS</h3>
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="<?php echo base_url(); ?>index.php/welcome/">home</a></li>
                                <li><span>Gallery</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page-ttle-area start -->
            <div class="team-area pt-120 pb-80">
                <div class="container">
                    <div class="row">
<?php
foreach ($gallery as $value) {
    $category = $value['category'];
	if($this->db->table_exists('image_categories')) {
    	$categoryName = $this->db->select('name')->from('image_categories')->where('id', $category)->get()->row()->name;
    } else {
    	$categoryName = "";
    	if ($category == 1) {
        	$categoryName = "Temple Images";
    	} elseif ($category == 2) {
        	$categoryName = "Festival Images";
    	} elseif ($category == 3) {
        	$categoryName = "Event Images";
    	} elseif ($category == 4) {
        	$categoryName = "Other Images";
    	}
    }
?>
    <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="team-item team-item-2 text-center mb-40">
            <div class="team-thumb w-img" style="height: 200px; overflow: hidden;">
                <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/galleryDetails/<?= $category; ?>' title='gallery'>
                    <img alt='' title='' src='../../uploads/gallery/<?PHP echo $value['image']; ?>' style="height: 100%;" />
                </a>
            </div>
            <div class="team-content">
                <h4 class="tp-el-title"><?php echo $categoryName; ?></h4>
                <!-- <span class="tp-el-subtitle mb-20">Founder</span> -->
                <div class="team-social">
                  
                </div>
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
            <!-- causes-details-area-start -->
         
            <!-- causes-details-end -->

            <!-- related-causes-start -->
           
            <!-- related-causes-end -->

        </main>
        
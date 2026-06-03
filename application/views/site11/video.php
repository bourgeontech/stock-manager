<main>
    <!-- page-ttle-area start  -->
    <div class="page-ttle-area text-center" data-background="<?php echo base_url(); ?>/assets/site8/img/bg/page-title-bg.jpg" style="height: 40px;">
        <div class="container">
            <div class="page-title">
                <h3 style="color: aliceblue; font-size: 40px;"> VIDEOS</h3>
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
                <?php if (empty($video)) { ?>
                    <div class="col-lg-12">
                        <p>No videos found.</p>
                    </div>
                <?php } else {
                    foreach ($video as $value) { ?>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <?php echo $value['link']; ?>
                        	<h3 class="mt-3 mb-5"> <?php echo $value['description']; ?></h3>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</main>

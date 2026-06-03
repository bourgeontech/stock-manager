    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-12">
             <div class="home_about_block">
             <h2 class="title1 title1_left">Gallery</h2>
             
               <div class='inner_pak'>
               <ul class='gallery_body'>
               <?php
                      foreach ($gallery as $value) {
                      ?>
                    <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/galleryDetails/<?= $value['category']; ?>' title='gallery'><img alt='' title='' src='../../uploads/gallery/<?PHP echo $value['image']; ?>' /></a>
                      <p><center> <h3><?php echo $value['description'];?></h3><center></p>
                    </li>
                    <?php
                        }
                        ?>
                </ul>
                 

                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-12">
              <div class="home_about_block">
                <h2 class="title1 title1_left">About Temple</h2>
                <div class='inner_pak'>
                <?php
                      foreach ($aboutus as $value) {
                       
                      ?>
                  <div class='news_more'> <img class='news_moreimg' src='../../uploads/aboutus/<?PHP echo $value['image']; ?>'>
                    <h3 class='mb-3'> <?php echo $value['title'];?></h3>
                    <!-- <div class='date'> <?php echo $newDate;?></div> -->
                    <p>
                    <div>  <?php echo nl2br($value['content']);?></div>
                    </p>
                  </div>
                  <?php
                        }
                        ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

 
    <div class="clearfix"></div>

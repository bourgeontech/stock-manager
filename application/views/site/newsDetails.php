    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_about_block">
          <div class="row">
            <div class="col-lg-12">
              <div>
                <h2 class="title1 title1_left">News Details</h2>
                <div class='inner_pak'>
                <?php
                      foreach ($newsDetails as $value) {
                        $originalDate = $value['created'];
                        $newDate = date("d-m-Y", strtotime($originalDate));
                        $id=$value['id'];
                      ?>
                  <div class='news_more'> <img class='news_moreimg' src='../../../uploads/news/<?PHP echo $value['image']; ?>'>
                    <h3 class='mb-3'> <?php echo $value['title'];?></h3>
               
                    <p>
                    <div>  <?php echo $value['description'];?></div>
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

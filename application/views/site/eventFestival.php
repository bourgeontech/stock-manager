    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-12">
              <div class="home_about_block">
                <h2 class="title1 title1_left">Event Festival</h2>
                <div class="inner_pak">
                  <div class="row">
                  <?php
                 if($eventFestival!=0){
                      foreach ($eventFestival as $value) {
                        $originalDate = $value['created'];
                        $newDate = date("d-m-Y", strtotime($originalDate));
                        $id=$value['id'];
                      ?>
                    <div class='col-lg-4 col-md-6  col-sm-12'>
                      <div class='news_block'> <a href='<?php echo base_url(); ?>index.php/welcome/eventDetails/<?= $value['id']; ?>'>
                        <figure>
                          <div class='date'><?php //echo $newDate;?></div>
                          <img src='../../uploads/events/<?PHP echo $value['image']; ?>' title='Events' alt='' width='' height=''> </figure>
                        <figcaption>
                        <center><h3><?php echo $value['title'];?></h3></center>
                        
                          <!-- <p> <?php echo $value['description'];?></p> -->
                        </figcaption>
                        </a> 
                    </div>
                    </div>
                    
                    <?php
                        }
                 }
                        ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>

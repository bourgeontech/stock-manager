<?php ini_set('display_errors', 0);?>
<div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_about_block">
          <div class="row">
            <div class="col-lg-12">
              <div>
                <h2 class="title1 title1_left">Event Details</h2>
                <div class='inner_pak'>
                <?php
                      foreach ($eventDetails as $value) {
                        //$originalDate = $value['event_date'];
                        //$newDate = date("d-m-Y", strtotime($originalDate));
                        $id=$value['id'];
                      ?>
                  <div class='news_more'> <img class='news_moreimg' src='../../../uploads/events/<?PHP echo $value['image']; ?>' width="400px">
                    <h3 class='mb-3'> <?php echo $value['title'];?></h3>
                  <?php /*
                    <div class='date'> <?php echo $newDate;?></div>
                    
                    */ ?>
                    <p>
                    <div>  <?php echo $value['description'];?></div>
                    </p>

                 
                  </div>
                   <?php if (!empty($value['pdf_file'])) { ?>
                    <div>
                      <a href="../../../uploads/events/<?php echo $value['pdf_file']; ?>" class="btn btn-primary btn-sm" download>Download PDF</a>
                      <iframe src="../../../uploads/events/<?php echo $value['pdf_file']; ?>" width="350" height="300"></iframe>
                    </div>
                  <?php } ?>
              
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

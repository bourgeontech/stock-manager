
    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-12">
              <div class="home_about_block">
                <h2 class="title1 title1_left">Announcements</h2>
                <div class="inner_pak">
                <ul>
                <?php
                      foreach ($announcements as $value) {
                      ?>
                    <li>
                      <div class='block_event'>
                      <h3> <?php echo $value['title'];?></h3>
                      <div class='event_text'>
                        <div>
                          <h3 style="box-sizing: border-box; margin: 0px 0px 8px; font-weight: 500; line-height: 1.2; font-size: 23px; padding: 0px; border: 0px; list-style-type: none; vertical-align: baseline; font-family: Lobster, cursive; color: rgb(33, 37, 41);">
                          <span style="font-family: &quot;Open Sans&quot;, sans-serif; font-size: 13px;"><?php echo $value['description'];?></span></h3>
                        </div>
                        <div> &nbsp;</div>
                      </div>
                    </li>
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

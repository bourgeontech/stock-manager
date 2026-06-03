
    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-12">
              <div class="home_about_block">
                <h2 class="title1 title1_left">Temple Rules</h2>
                <div class="inner_pak">
               

                    <ul>
                    <?php
                      foreach ($rules as $value) {
                      ?>
                    <li>
                      <div class='block_event'>
                      <h3><?php echo $value['title'];?></h3>
                      <div class='event_text'>
                        <div><?php echo $value['rules'];?></div>
                      </div>
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

    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-12">
             <div class="home_about_block">
             <h2 class="title1 title1_left">Paripalana Samithi</h2>
             
               <div class='inner_pak'>
               
                      <div class="board depat">
                      
                      <ul class="list clearfix ">
                      <?php
                      foreach ($paripalanaSamithi as $value) {
                      ?>
                      <li>   
                     <div class='image-block'><img src='../../uploads/paripalanaSamithi/<?PHP echo $value['image']; ?>' width='263' height='157' alt='' title=''></div>
                        <div class='person_info'>
                          <h4 class='name'><?php echo $value['name'];?></h4>
                          <div class='desig'><?php echo $value['designation'];?></div>
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
      </div>
    </section>
    <div class="clearfix"></div>
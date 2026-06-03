    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-12">
             <div class="home_about_block">
             <h2 class="title1 title1_left">Festival/Working Committee</h2>
             
               <div class='inner_pak'>
               
                      <div class="board depat">
                      
                      <ul class="list clearfix ">
                      <?php
                      foreach ($festivalCommittee as $value) {
                      ?>
                      <li>   
                   <?php if($value['image']!=""){?>  <div class='image-block'><img src='../../uploads/festivalCommittee/<?PHP echo $value['image']; ?>' width='263' height='157' alt='' title=''></div><?php } ?>
                        <div class='person_info' style="padding:10px;">
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
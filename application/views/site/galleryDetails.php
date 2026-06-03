    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_about_block">
          <div class="row">
            <div class="col-lg-12">
              <div>
                <h2 class="title1 title1_left">Gallery Details</h2>
                <div class='inner_pak'>
                 <ul class='gallery_body'>
                 <?php
                if(!empty($galleryDetails)){ 
                      foreach ($galleryDetails as $value) {
                        $originalDate = $value['created'];
                        $newDate = date("d-m-Y", strtotime($originalDate));
                        
                      ?>
                <li> 
             <a class='sb' href='../../../uploads/gallery/<?PHP echo $value['image']; ?>' title='gallery'>
             <img alt='' title='' src='../../../uploads/gallery/<?PHP echo $value['image']; ?>' /></a> </li>
             <?php
                        }}
                        else {?>
                  <li> 
             <a class='sb' href='../../uploads/gallery/<?PHP echo $value['image']; ?>' title='gallery'>
             <img alt='' title='' src='../../uploads/gallery/<?PHP echo $value['image']; ?>' /></a> </li>
                     <?php   }
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

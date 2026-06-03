<style>
    /* .title1_left::before {
    content: "";
    background: url(assets/images/icon/icons2.png);
    width: 32px;
    height: 25px;
    float: right;
    position: absolute;
    right: .0;
    top: 12px;
}
.title1_left::after {
    content: "";
    width: 70%;
    background: #a06262;
    height: 1px;
    display: inline-block;
    float: right;
    margin-top: 24px;
} */
.board .list li {
    /* float: left; */
    text-align: center;
    margin-bottom: 20px;
    display: inline-block;
    vertical-align: top;
}

.inner_pak {
    margin-top: 40px;
    margin-bottom: 100px;
    position: absolute; 
    left: -230px;
    top: -110px;
}

.board .list li .image-block {
    width: 190px;
    height: 190px;
    overflow: hidden;
    border: 3px solid white;
    margin: 28px 35px;
    border-radius: 17px;
}

.image-block img {
    width: 195px;
    height: 195px;
}
.list li h4 {
    color: #000;
    margin-bottom: 0px;
    font-family: 'Helvetica', cursive;
    position: relative; 
    left: -8px;
    text-transform: uppercase;
}
.desig {
    font-size: 16px;
    position: relative; 
    left: -10px;
    text-transform: uppercase;
}


</style> 
 
 <!--slider section end-->
           <div class=" white-bg">
<div class="container">
 <h2 class="templeh1 text-center mt-20">Temple Priest</h2>
 
 
  <div class="owl-carousel pt-30 pb-20"> 
    
    
  </div>
</div>
</div>




            <!--Gallery section start-->
            <div class="galllery ptb-100 temple-bg">
<!-- 
<span style="content: '';width: 30%; background: #a06262; height: 1px;display: inline-block;margin-top: 24px;position: absolute; right: 580px; top: 264px;float: center;"></span>

<span style="content: '';width: 32px;  height: 25px; float: right;position: relative; right: 576px; bottom: 98px;">

<img src="<?php echo base_url(); ?>assets/images/icon/icons2.png"></span>  -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="section-title text-center">
                            
                                <!-- <h1 class="templeh1">Our Latest Gallery</h1>
                                <p>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>
                            -->


                            <div class="clearfix"></div>
  <section class="site_inner">
    <div class="container">
      <div class="home_welcome">
        <div class="row">
          <div class="col-lg-12">
            <div class="home_about_block">
              <!-- <h2 class="title1 title1_left">Temple Priest</h2> -->
				
				<div class="inner_pak">
				
              <div class="board depat">
                <ul class="list clearfix ">
                
            
                <?php if(!empty($priest)){
	                      $i=0;
	                       foreach($priest as $val){ 
                              //  $image=$val['image'];
                               ?>            
              
		
					<li>
                    <div class='image-block'> <img src='<?php echo base_url(); ?>assets/images/others/om4.jpg'></div>
                    <div class='person_info'>
                      <h4 class='name'><?= $val['name']; ?></h4>
                      <div class='desig'><?= $val['designation']; ?></div>
                    </div>
                  </li>
                  <?php } } 
					      else{ ?>
						 
						     <span class="text-center" colspan="6">No Data Found</span>
						  
				    <?php } ?>	
  
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


                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--Gallery section end-->

<!--welcome section start-->
<div class="galllery ptb-100 temple-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="section-title text-center">
                                
                                </div>
                        </div>
                    </div>
                </div>

            </div>
            
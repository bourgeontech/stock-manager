<?php 
$site_settings=$this->site_model->settings();
$asideimage=$site_settings['asideimage'];
$videolink=$site_settings['video_link'];
$smbanner=$site_settings['small_banner'];
?>
    <section class="slide_part">
      <div class="container">
        <div class="row">
          <div class='col-md-12'>
            <div class='homeslider'>
                <img class='img-fluid maxheight' title='' alt='' src='<?php echo $smbanner ?>'> 
            </div>
          </div>
        </div>  
      </div>
    </section>
    
    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-9">
              <div class="home_main_block mb-4">
                <!-- <h2 class="inner-title ">worship</h2> -->
                <div class='inner_pak'>
                  <div class='row'>
                    <div class='col-md-12'>
                        <img alt="" src="<?php echo base_url(); ?>/assets/site3/images/img6.jpg" width="250" height="167" class="img02"> 
                        <p>Sree Wadakkunnathan Temple stands in the centre of a very large square plot which is cut off from the outside world by tall and thick walls built around. Between the outer sanctum and inner sanctum of the temple there is a spacious compound the entrance to which is through four gopuras. Of these, the gopuras,on the south and north are not open to the public, who have to enter either through the east or west gopura. In the outer temple there are shrines for Krishna (Goshala Krishna or Krishna as Cowherd) , Nandikeshwara, Parasurama, Simhodara, Ayyappa (Sastha), Sankaracharya. The inner temple is separated from the outer temple by a broader circular granite wall enclosing a board corridor called the CHUTTAMBALAM. Entrance in to the inner temple is through a passage through the corridor, in the inner temple the chief and central shrine that of Shiva where the LINGA transferred from the SREEMOOLASTHANA is installed. Then there are shrine of Parvathy, Ganapathy, Sankaranarayan and Sree Rama.
                            Traditionally, the devotees follow a special order for praying in the inner and outer sanctums of the temple.
                        </p>
                        <h5 class="m-2 mt-4 ">Order of visiting in the outer sanctum</h5>
			            <table class="common-txt">
                            <tr>
                                <td width="190">1. Sreemoolasthanam</td>
                                <td width="190">2. Goshalakrishnan</td>
                                <td width="190">3. Nandikeshwara</td>
                                <td width="190">4. Parashurama</td>
                            </tr>
                            <tr>
                                <td>5. Simhodara</td>
                                <td colspan="3">6. Kashivishwanatha- to be viewed from the altar placed a little to the north of Simhodara</td>
                            </tr>
                            <tr>
                                <td>7. Sambhukumbham</td> 
                                <td colspan="3">8. Pray to Chidambaranadha at the small platform at the south-east corner.</td>
                            </tr>
                            <tr>
                                <td colspan="2">9. Pray to Sethunadha of Rameshwaram looking Eastwards.</td>
                                <td colspan="2">10. From the south gopura pray to Kodungallur Bhagavathi.</td>
                            </tr>
                            <tr>
                                <td colspan="4">11. From the platform ath the south- west corner look south and pray to Sangameshwara of Koodalmanikyam</td>
                            </tr>
                            <tr>
                                <td colspan="4">12. From the same platform pray to Oorakathamma Thiruvadi</td>
                            </tr>
                            <tr>
                                <td colspan="4">13. Look at the domes/ thazhikakkudam of Wadakkunnathan, Shankaranarayanan and Sri Rama and pray</td>
                            </tr>
                            <tr>
                                <td colspan="4">14. The one comes upon a flat granite slab called Vyasashila on a platform on which one must write 'Hari Sree Ganapathaye Namah'</td>
                            </tr>
                            <tr>
                                <td>15. Ayyappa or Shastha</td> 
                                <td colspan="3">16. Samadhi of Adi Shankaracharya marked by a Shankha and Chakra</td>
                            </tr>
                            <tr>
                                <td >17. Adi Shankara.</td> 
                                <td colspan="3">18. Vrishabha</td>
                            </tr>
                                <td colspan="4">19. Vasukishayanam painting. Also known as Phanivarashayana. One of the rarest murals in which Lord Shiva is depicted resembling Lord Vishnu's Ananthashayana form.</td>
                            </tr>
                                <td colspan="4">20. Nruthanadha painting</td>
                            <tr>
                        </table>
			            <h5 class="m-2 mt-4">The order of praying in the inner sanctum of the temple</h5>
                        <table class="common-txt">
                            <tr>
                                <td width="250">1. Lord Wadakkunnathan</td>
                                <td width="250">2. Devi Sri Parvati</td>
                                <td width="250">3. Lord Ganapathy</td>
                            </tr> 
                                <td>4. Lord Shankaranarayana</td>				
                                <td>5. Lord Sri Rama</td>
                                <td>6. Lord Shankaranarayana</td>
                            </tr> 
                                <td>7. Lord Ganapathy</td>
                                <td>8. Devi Sri Parvati</td>
                                <td>9. Lord Wadakkunnathan</td>
                            </tr> 
                                <td>10. Lord Ganapathy</td>
                                <td>11. Lord Shankaranarayana</td>
                                <td>12. Lord Sri Rama</td>
                            </tr> 
                                <td>13. Lord Shankaranarayana</td>
                                <td>14. Lord Sri Rama</td>
                                <td>15. Lord Shankaranarayana</td>
                            </tr> 
                                <td>16. Lord Ganapathy</td>
                                <td>17. Devi Sri Parvati</td>
                                <td>18. Lord Wadakkunnathan</td>
                            </tr>  
                        </table>
                    </div>  
                  </div>
                </div>
              </div>
              <div class="home_gallery">
                <div class="gallery-bgm">
                      <ul id='gallery' class='owl-carousel owl-theme dotte_slider'>
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery' title='gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/01.jpg' /></a> </li>
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery' title='gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/02.jpg' /></a> </li>
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/03.jpg' /></a> </li>
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/04.jpg' /></a> </li>
    
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/05.jpg' /></a> </li>
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/07.jpg' /></a> </li>
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/08.jpg' /></a> </li>
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/10.jpg' /></a> </li>
    
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/11.jpg' /></a> </li>
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/12.jpg' /></a> </li>
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/13.jpg' /></a> </li>
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/14.jpg' /></a> </li>
    
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/15.jpg' /></a> </li>
                        <li> <a class='sb' href='<?php echo base_url(); ?>index.php/welcome/gallery'><img alt='' title='' src='<?php echo base_url(); ?>/assets/site3/images/gallery/17.jpg' /></a> </li>
                      </ul>
                </div>
              </div>
            </div>
        <!-- ASIDE START-->
        <?php $this->load->view('site3/layouts/aside'); ?>   
        <!-- ASIDE END-->
          </div>
        </div>
      </div>
    </section>  

    <div class="clearfix"></div>
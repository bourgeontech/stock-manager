<?php 
$aboutus=$this->site_model->aboutus_home();
$aboutus=$this->site_model->getaboutus();
$site_settings=$this->site_model->settings();
?>

<style>
    .team-card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 15px; 
        margin-bottom: 20px; 
    }

    .team2-card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 15px; 
        margin-bottom: 20px; 
    }
</style>

<div class="owl-carousel owl-theme hero-slider">
    <?php foreach ($banner as $value) { ?>
        <div class="slide" style="background-image: url('../../uploads/banner/<?php echo $value['image']; ?>');">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <h6 class="text-white text-uppercase"><?php echo $temple_list[0]['name']; ?></h6>
                        <h1 class="display-3 my-4"><?php echo $value['title']; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>



    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 py-5">
                    <div class="row">

                        <div class="col-12">
                            <div class="info-box">
                                <img src="<?php echo base_url(); ?>/assets/parakkunnath/img/icon6.png" alt="">
                                <div class="ms-4">
                                    <h5>About Us</h5>
                                    <p> <?php print_r($aboutus[0]['short_content']);?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                   <img src="<?php echo base_url(); ?>/uploads/aboutus/<?php  echo $aboutus['0']['image']; ?>" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- MILESTONE -->
    <section id="milestone">
        <div class="container">
            <div class="row text-center justify-content-center gy-4">
              <div class="col-12">
                <h1 class="display-4"> <?php print_r($site_settings['templename_mal']);?></h1>

            </div>
        </div>
    </section>
<!-- 
<section id="services" class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro">
                    <h1>Poojas</h1>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($pooja_list as $pooja): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="card" style="width:200px">
                        <img src='<?php echo base_url(); ?>/assets/new_site/images/icons4.png' >
                        <h5><?php echo $pooja['name']; ?></h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section> -->


<section class="bg-light" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro">
                    <h1>Festivals</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($events as $event): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="project">
                        <div class="overlay"></div>
                        <img src="<?php echo base_url(); ?>/uploads/events/<?php echo $event['image']; ?>" alt="">
                        <div class="content">
                            <h2><?php echo $event['title']; ?></h2>
                            <!-- If you have a date field in your database, you can format and display it here -->
                            <!-- <h6><?php //echo date("d-m-Y", strtotime($event['created'])); ?></h6> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<section id="team">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro">
                    <h2>Meet our Team Members</h2>
                </div>
            </div>
        </div>
        <div class="row team-members">
            <?php foreach ($trusteeboard as $member): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="team-card">
                        <div class="image">
                            <img src="../../uploads/trustee/<?php echo $member['image']; ?>" width="150" height="270" alt="<?php echo $member['name']; ?>" title="<?php echo $member['name']; ?>">
                            <div class="overlay"></div>
                        </div>
                        <div class="intro">
                            <h4><?php echo $member['name']; ?></h4>
                            <p><?php echo $member['designation']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
    
    
<section id="team2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro">
                    <h2>About the Trust</h2>
                	<h5>
                    	The Trust was started in 2008 with the ambition to construct a new temple to Goddess Kamakshi who was residing in just 40 SFT small temple and to serve the community through the temple by establishing School, College, Hospitals and Veda Padashala etc.
                </h5>
                </div>
            </div>
        </div>
    </div>
</section>
    
    
    
    
 <section id="team2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro">
                    <h2>Trust Staff and Charity Members</h2>
                </div>
            </div>
        </div>
        <div class="row team-members">
            <?php foreach ($paripalanaSamithi as $member): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="team2-card">
                        <div class="image">
                            <img src="../../uploads/paripalanaSamithi/<?php echo $member['image']; ?>" width="150" height="270" alt="<?php echo $member['name']; ?>" title="<?php echo $member['name']; ?>">
                            <div class="overlay"></div>
                        </div>
                        <div class="intro">
                            <h4><?php echo $member['name']; ?></h4>
                            <p><?php echo $member['designation']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>



    
    
<section id="team">
    <div class="container">
    	<div class="row">
            <div class="col-12">
                <div class="intro">
                    <h1>Gallery</h1>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-4">
            <?php $count = 0; ?>
            <?php foreach ($gallery_list as $value): ?>
                <div class="col mb-4">
                    <img class="d-block w-100" src="<?php echo base_url(); ?>uploads/gallery/<?php echo $value['image']; ?>" alt="">
                </div>
                <?php 
                $count++;
                if ($count % 4 == 0): ?>
                    <div class="w-100"></div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

</section>











    
    
<section class="site_inner" id="diety">
    <div class="container">
        <div class="home_welcome">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home_about_block">
                        <h2 class="title1 title1_left">Deities</h2>
                        <br>
                        <br>
                        <div class='inner_pak'>
                            <?php 
                            $a=$this->db->query("SELECT * From diety WHERE online='1' ORDER BY order_ ASC ");
                            $diety_id=$a->result_array();

                            foreach ($diety_id as $did){
                                $diety=$did['name'];
                                $id=$did['id'];
                                $this->db->select('diety_pooja.*,pooja.name_mal as pooja_nm,pooja.rate as pooja_rt');
                                $this->db->from('diety_pooja');
                                $this->db->join('pooja','pooja.id = diety_pooja.pooja_id');
                                $this->db->where('diety_pooja.temple_id', $id);
                                $query = $this->db->get()->result_array();

                                if(count($query)>0){
                            ?>
                            <div class='pooja_sub showSingle' style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;"> <?php echo $diety;?> </div>
                            <div class='pooja_ctbook' style="display: none; border: 1px solid #ccc; padding: 10px;">
                            	<?php if($this->db->field_exists('description', 'diety')): ?>
	 							<div class="mb-3"><?= $did['description']; ?></div>
    				  			<?php endif; ?>	
                                <table class='pooja_list table table-hover' width='100%' border='0' cellspacing='0' cellpadding='0'>
                                    <tbody>
                                        <?php
                                        foreach($query as $val){ 
                                        ?>
                                        <tr>
                                            <td><?php echo $val['pooja_nm'];?></td>
                                            <td align='center'>Rs <?php echo $val['pooja_rt'];?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
</section>


<section class="site_inner" id="diety">
    <div class="container">
        <div class="home_welcome">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home_about_block">
                        <h2 class="title1 title1_left">How to Reach</h2>
                    	<h5 class="title1 title1_left">By Bus</h5>
                    	<h6>From Kanchipuram </h6>
						<p> Board in any bus going to Vandavasi from Kanchipuram and get down at Koozhamandal bus stop. From there take one Auto and ask for Madaavalam Kamakshi Ambal Temple. Distance in Auto travel is  only 1.5 Kms.</p>
						
                    	<h5 class="title1 title1_left">By Air</h5>
						<p> The nearest Airport is Chennai. From Chennai you can book a Taxi and reach temple. The distance from Chennai to Temple is only 75 Kms.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<section id="room-booking">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h4 class="text-center">Darshan Timings	6 AM to 12 PM & 4 PM to 8 PM </h4>
        	</div>
    	</div>
	</div>
            
</section>


    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $(".pooja_sub").click(function(){
            $(this).next(".pooja_ctbook").slideToggle();
        });
    });
</script>

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3892.494137115855!2d79.67262339999999!3d12.681138499999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a52debd7ff6f107%3A0x7cc06c16ef231116!2sMadaavalam%20Sri%20Kamakshi%20Temple!5e0!3m2!1sen!2sin!4v1714712226223!5m2!1sen!2sin" width="1250" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    </main>

    
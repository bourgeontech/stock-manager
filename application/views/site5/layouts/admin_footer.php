<?php 
$temple_list=$this->general_model->gettemples();
$getcontact=$this->site_model->getcontact();
$site_settings=$this->site_model->settings();
$bgimage=$site_settings['bgimage'];
?>
<footer>
        <div class="footer-top text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h4 class="navbar-brand"><?php print_r($temple_list[0]['name']);?></h4>
                    <p> <?php print_r($getcontact[0]['address']);?>. </p>
                    <div class="text-white">
    <i class='fa fa-phone-square'></i>&nbsp;&nbsp;
    <a class="phone-link" href="tel:<?php echo $getcontact[0]['land_ph']; ?>">
        <?php echo $getcontact[0]['land_ph']; ?>
    </a>,
    <a class="phone-link" href="tel:<?php echo $getcontact[0]['mob_ph']; ?>">
        <?php echo $getcontact[0]['mob_ph']; ?>,
    </a>
    <a class="phone-link" href="tel:+91 8940421814">
        					 +91 8940421814
    					</a>
</div>
                	<div class="text-white"><i class='fa fa-envelope'></i>&nbsp;&nbsp;<?php print_r($getcontact[0]['email']);?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <p class="mb-0"> All rights Reserved</p>
        </div>
    </footer>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="container-fluid">
                        <div class="row gy-4">
                            <div class="col-lg-4 col-sm-12 bg-cover"
                                style="background-image: url(<?php echo base_url(); ?>/assets/parakkunnath/img/c2.jpg); min-height:300px;">
                                <div>

                                </div>
                            </div>
                            <div class="col-lg-8">
                                <form class="p-lg-5 col-12 row g-3">
                                    <div>
                                        <h1>Get in touch</h1>
                                    <p>Fell free to contact us and we will get back to you as soon as possible</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="userName" class="form-label">First name</label>
                                        <input type="text" class="form-control" placeholder="Jon" id="userName"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="userName" class="form-label">Last name</label>
                                        <input type="text" class="form-control" placeholder="Doe" id="userName"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-12">
                                        <label for="userName" class="form-label">Email address</label>
                                        <input type="email" class="form-control" placeholder="Johndoe@example.com" id="userName"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-12">
                                        <label for="exampleInputEmail1" class="form-label">Enter Message</label>
                                        <textarea name="" placeholder="This is looking great and nice." class="form-control" id=""  rows="4"></textarea>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-brand">Send Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>









    <script src="<?php echo base_url(); ?>/assets/parakkunnath/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/parakkunnath/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/parakkunnath/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/parakkunnath/js/app.js"></script>
</body>

</html>
 
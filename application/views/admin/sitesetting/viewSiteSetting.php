<div class="side_right">
    <div class="mt-2"></div>
    <div class="clearfix"></div>
    <div class="page-header">
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <h2 class="page_txt"> Site Settings </h2>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 ">
          <ul class="btn_ul" style="float:right;">
            <li style="margin:1px;"> <a href="<?php echo base_url();?>index.php/cms/uploadImage" class="btn btn-primary">Update Background image&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
          <ul class="btn_ul" style="float:right;">
            <li style="margin:1px;"> <a href="<?php echo base_url();?>index.php/cms/uploadSong" class="btn btn-primary">Update Opening Song&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
          <ul class="btn_ul" style="float:right;">
            <li style="margin:1px;"> <a href="<?php echo base_url();?>index.php/cms/uploadAsideimage" class="btn btn-primary">Update Aside Image&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
          <ul class="btn_ul" style="float:right;">
            <li style="margin:1px;"> <a href="<?php echo base_url();?>index.php/cms/uploadVideolink" class="btn btn-primary">Update Video Link&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
          <ul class="btn_ul" style="float:right;">
            <li style="margin:1px;"> <a href="<?php echo base_url();?>index.php/cms/uploadSmallbanner" class="btn btn-primary">Update Small banner&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
          <ul class="btn_ul" style="float:right;">
            <li style="margin:1px;"> <a href="<?php echo base_url();?>index.php/cms/uploadTypingtext" class="btn btn-primary">Update Typing Text&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
          <ul class="btn_ul" style="float:right;">
            <li style="margin:1px;"> <a href="<?php echo base_url();?>index.php/cms/updatePaymentgateway" class="btn btn-primary">Update Payment Gateway&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
          <ul class="btn_ul" style="float:right;">
            <li style="margin:1px;"> <a href="<?php echo base_url();?>index.php/cms/updateSmsSettings" class="btn btn-primary">SMS Setting&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a> </li>
          </ul>
        </div>

    </div>
        <div class="row">
	     <div class="col-lg-12 col-md-12 col-sm-12 ">
		  <div class="shadow-sm p-3 mb-2 bg-white" style="position:relative" >
			<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 ">
                <h2 class="page_txt"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;Site Settings </h2>
              </div>
			 </div>		
	       <div class="table-responsive">
				<table class="table table-bordered table-hover text-nowrap" width="100%">
				  <thead>
					<tr>
					  <th scope="col" width="">Name</th>
					  <th scope="col" width="">Background Image</th>
					  <th scope="col" width="">Opening Song </th>
					  <th scope="col" width="">Payment Gateway </th>
					  <th scope="col" width="">SMS Notification </th>
                      <th scope="col" width="">Show Text</th>
					  <th scope="col" width="">Aside Image</th>
					  <th scope="col" width="">Small Banner</th>
					  <th scope="col" width="">Video</th>
					</tr>
				  </thead>
					<?php if(!empty($site_settings)){   ?>

				  <tbody>
					<tr>
					    <td><a href="#"> <strong style="margin-bottom: 5px;display: block;color: #ea6227;"><?= $site_settings[0]->templename_eng; ?> <br> <?= $site_settings[0]->templename_mal; ?></strong></a></td>
                        <td>
                            <a href="#">
                                <img src="<?= $site_settings[0]->bgimage; ?>" alt="Background Image" style="max-width: 500px;">
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                <audio controls>
                                    <source src="<?= $site_settings[0]->opening_song; ?>" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </a>
                        </td>
                        <td>
                            <h5><?= $site_settings[0]->payment_gateway == 1 ? 'Razorpay' : ( $site_settings[0]->payment_gateway == 2 ? 'ICICI Eazypay' : 'Worldline' ); ?></h5>
                        </td>
						<td>
                            <h5><?= $site_settings[0]->sms_notification == 0 ? 'Disabled' : 'Enabled'; ?></h5>
                        </td>
                  		<td><a href="#"> <?= $site_settings[0]->typing_text; ?></a></td>

                        <td>
                            <a href="#">
                                <img src="<?= $site_settings[0]->asideimage; ?>" alt="Aside Image" style="max-width: 300px;">
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                <img src="<?= $site_settings[0]->small_banner; ?>" alt="Small Banner" style="max-width: 300px;">
                            </a>
                        </td>
                        <td>
                          <div class="responsive-iframe-container"  >
                            <span style="max-width: 300px;"><?= $site_settings[0]->video_link; ?></span>
                          </div>
                        </td>



					</tr>
				  </tbody>
					<?php }  
					      else{ ?>
						  <tr>
						     <td class="text-center" colspan="6">No Data Found</td>
						  </tr>
				    <?php } ?>	  
				</table>
             </div>
			</div> 
          </div>
	    </div>
       </div>
	</div>
    <div class="clearfix"></div>
    <br>
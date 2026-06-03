    <style>
        .my-div-quick{
            max-height:14cm;
            overflow-y:scroll; 
			overflow-x:hidden; 
        }
		.my-div-quick::-webkit-scrollbar {
			width: 10px;
		}

		/* Track */
		.my-div-quick::-webkit-scrollbar-track {
			background: #f1f1f1; 
		}

		/* Handle */
		.my-div-quick::-webkit-scrollbar-thumb {
			background: #888; 
		}

		/* Handle on hover */
		.my-div-quick::-webkit-scrollbar-thumb:hover {
			background: #555; 
		}
    </style>
    <div class="clearfix"></div>
    <section class="site_inner">
      <div class="container">
        <div class="home_welcome">
          <div class="row">
            <div class="col-lg-12">
             <div class="home_about_block">
             <h2 class="title1 title1_left">Cancellation & Refund Policy</h2>
             
               <div class='inner_pak'>
               
                      <div class="board depat">
                      
<!--                      <iframe src="<?php echo base_url(); ?>/assets/new_site/docs/cancellationpolicy.pdf" width="100%" height="320px">
                      </iframe> -->
    
                    <hr>
                    <h4>
                    	Cancellation Policy
                    </h4>
                    <br>
                    <p>
                        &#8226; As per <?php print_r($temple_list[0]['name']);?> rules devotee will not be able to cancel a
                        puja booking. However <?php print_r($temple_list[0]['name']);?> Temple will be happy to talk to
                        devotee on alternate measures or changes to booking and do the needful to devotee's
                        satisfaction. Devotees are requested to call the temple at the numbers provided below and
                        we will help you.
                    </p>
                    <br>
                    <p>
                    	Contact number: <?php print $getcontact[0]['mob_ph']; ?>
                	</p>
                	<br>
                    <h4>
                    	&#8226; Issues while paying online
                    </h4>
                    <br>
                    <p>
                    	In cases where devotee made the payment and money got debited from devotee account,
                        but transaction didn't complete and/or devotee didn't receive any mails, the money will be
                        refunded in 4-5 working days
                	</p>
                	<br>
                    <h4>
                    	&#8226; After successful booking
                    </h4>
                    <br>
                    <p>
                    	Once the booking is successfully completed, the <?php print_r($temple_list[0]['name']);?>
 will
                        do the puja or service on the requested date with the given details. As per temple rules
                        devotee will not be able to cancel a booking or request for refund. However <?php print_r($temple_list[0]['name']);?>
will be happy to talk to devotee on alternate measures or
                        changes to the booking and do the needful to devotee's satisfaction. Devotees are
                        requested to call the temple directly at the numbers provided below and we will try to help
                        you.
                	</p>
                	<br>
                	<p>
                    	Contact number: <?php print $getcontact[0]['mob_ph']; ?>
                	</p>
                	<br>
                	<h4>
                    	&#8226; After Puja completion
                    </h4>
                    <br>
                    <p>
                    	<?php print_r($temple_list[0]['name']);?> Temple will update the devotee via mail of the status.
                        Prasadam/offerings will be sent to devotee if requested and paid for. Once the puja is done,
                        temple will not be able to postpone, refund or cancel under any circumstances.
                	</p>
                    <hr>
                    
                  </div>
                 

                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="clearfix"></div>
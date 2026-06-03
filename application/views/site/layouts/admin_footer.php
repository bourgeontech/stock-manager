<?php 
$temple_list=$this->general_model->gettemples();
$getcontact=$this->site_model->getcontact();
$site_settings=$this->site_model->settings();
?>
<!--<footer style="background: <?php echo $site_settings['menucolor']; ?>;">
      <div class="container" >
        <div class="row">
          <div class="col-md-4">
          
           <h3 style="">Contact Us</h3>
            <div class="inofo_ct">
              <div> <img src="<?php echo base_url(); ?>/assets/new_site/images/icons/icons5.png" width="72px" height="86px"> </div>
              <div style=''>
                  <!--<div> <?php print_r($temple_list[0]['name']);?></div>-->
                <!--<p> <?php print_r($temple_list[0]['address']);?>, -->
                <!--  <?php print_r($temple_list[0]['location']);?>,-->
                <!--  <?php print_r($temple_list[0]['pincode']);?>. </p>-->
                <!--<div><i class='fa fa-phone-square'></i>&nbsp;&nbsp;<?php print_r($temple_list[0]['contact']." , ".$temple_list[0]['phone']);?> </div>-->
                <!--<div><i class='fa fa-envelope'></i>&nbsp;&nbsp;<?php print_r($temple_list[0]['email']);?></div>-->
                <!--<p> <?php print_r($getcontact[0]['address']);?>. </p>
                <div><i class='fa fa-phone-square'></i>&nbsp;&nbsp;<?php print_r($getcontact[0]['land_ph']." , ".$getcontact[0]['mob_ph']);?> </div>
                <div><i class='fa fa-envelope'></i>&nbsp;&nbsp;<?php print_r($getcontact[0]['email']);?></div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
          <div class="footer_outer">
            <h3 style="">Quick Links</h3>
            <style>
				  footer a { color: #fff}
				  footer a:hover { color: #eee}
			  </style>
            <ul>
              <li><a href="<?php echo base_url(); ?>index.php/welcome/termsandconditions">Terms and Conditions</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/welcome/disclaimer">Disclaimer</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/welcome/privacypolicy">Privacy Policy</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/welcome/cancellationpolicy">Cancellation & Refund Policy</a></li>
            </ul>
          </div>
          </div>
          <div class="col-md-4">
          <div class="footer_outer">
            <p>
           <img src="<?php echo base_url(); ?>/assets/new_site/images/logo/logo.png" ><br>
            � 2021  All rights reserved.
          </p>
          </div>
          </div>
        </div>
      </div>
    </footer>-->
  </main>
</form>
</body>
<script src="<?php echo base_url(); ?>/assets/new_site/js/jquery.min.js"></script>
<!-- JQUERY.MIN JS -->
<script src="<?php echo base_url(); ?>/assets/new_site/js/popper.min.js"></script>
<!-- BOOTSTRAP.MIN JS -->
<script src="<?php echo base_url(); ?>/assets/new_site/js/bootstrap.min.js"></script>
<!-- BOOTSTRAP.MIN JS -->
<script src="<?php echo base_url(); ?>/assets/new_site/js/menu_jquery.js"></script>
<script src="<?php echo base_url(); ?>/assets/new_site/js/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>/assets/new_site/js/datepicker2/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/new_site/js/moment.js"></script>
<script src="<?php echo base_url(); ?>/assets/new_site/js/custom.js"></script>
<script src="<?php echo base_url(); ?>/assets/new_site/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/new_site/js/jquery-ui.min.js"></script>
 <script src="<?= base_url() ?>assets/js/shared.js"></script>
<script>
$(document).ready(function() {
    $("#dvPassport").hide();
});


$(function () {
    $("#chkPassport").click(function () {
    	if ($(this).is(":checked")) {
    	    $("#dvPassport").show();
        } else {
            $("#dvPassport").hide();
        }
    });
});
$(document).ready(function() {
    $("#checkAll").change(function() {
        if (this.checked) {
            $(".week").each(function() {
                this.checked=true;
            });
        } else {
            $(".week").each(function() {
                this.checked=false;
            });
        }
    });

    $(".week").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".week").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#checkAll").prop("checked", true);
            }     
        }
        else {
            $("#checkAll").prop("checked", false);
        }
    });
});
$(document).ready(function() {
    $("#checkAll1").change(function() {
        if (this.checked) {
            $(".month").each(function() {
                this.checked=true;
            });
        } else {
            $(".month").each(function() {
                this.checked=false;
            });
        }
    });

    $(".month").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".month").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#checkAll1").prop("checked", true);
            }     
        }
        else {
            $("#checkAll1").prop("checked", false);
        }
    });
});
  $( function() {
    $( ".accordion_d" ).accordion({
		heightStyle: "content"
    });


    $(".datepicker_new").datepicker({
        minDate: 0,
        dateFormat: 'dd/mm/yy',
        changeYear: true,
        yearRange: "2020:2080"
    });
	  
    $(".datepicker").datepicker();

    //$(".datepickernew").datepicker({
    //    maxDate: new Date(),
    //    dateFormat: 'dd-mm-yy',
    //    changeYear: true,
    //    changeMonth: true,
    //    yearRange: "2020:2080"
    //});
	  
  } );
	
	
	jQuery(function() {
 
	    jQuery('.showSingle').click(function () {
	        //$(this).$('.pooja_ctbook').first().toggle(); 
	        //$(this).find('.pooja_ctbook').toggle();
	        $(this).next("div").toggle();
	        //$('.pooja_ctbook').toggle();
	     //$('.pooja_ctbook').first().toggle();
	        $(this).toggleClass("ltopen");
    
  });
});
	
	$( function() {
    $( ".ct_tab" ).tabs({
		active: 0
	});
		
  } );
	
  </script>

</html>
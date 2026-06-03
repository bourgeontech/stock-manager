<?php 
$temple_list=$this->general_model->gettemples();
$getcontact=$this->site_model->getcontact();
$site_settings=$this->site_model->settings();
?>
    <footer style="background: <?php echo $site_settings['menucolor']; ?>;">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
           <h3 style="">Contact Us</h3>
            <div class="inofo_ct">
              <div> <img src="<?php echo base_url(); ?>/assets/site3/images/icons5.png" width="72px" height="86px"> </div>
              <div style=''>
                <div> <?php print_r($temple_list[0]['name']);?></div>
                <p> <?php print_r($getcontact[0]['address']);?></p>
                <div><i class='fa fa-phone-square'></i>&nbsp;&nbsp;<?php print_r($getcontact[0]['land_ph']." , ".$getcontact[0]['mob_ph']);?></div>
                <div><i class='fa fa-envelope'></i>&nbsp;&nbsp;<?php print_r($getcontact[0]['email']);?></div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
          <div class="footer_outer">
            <h3 style="">Other Links</h3>
            <ul>
              <li><a href="<?php echo base_url(); ?>index.php/welcome/termsandconditions">Terms and Conditions</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/welcome/disclaimer">Disclaimer</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/welcome/privacypolicy">Privacy Policy</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/welcome/cancellationpolicy">Cancellation & Refund Policy</a></li>
            </ul>
          </div>
          </div>
          <div class="col-md-3">
            <div class="imggcenter" style='footer_right_logo '>
              <img src="<?php echo base_url(); ?>/assets/site3/images/footer_logo.png">
            </div>
          </div>
        </div>
      </div>
        
      <div class="footer_outer_new">
        <div class="col-md-12">
          <p>© <?php print date('Y') ?>  BOURGEON INNOVATIONS PVT LTD | UL CYBERPARK| All rights reserved.</p>
        </div>
      </div>
        
    </footer>
  </main>


</body>

<script src="<?php echo base_url(); ?>/assets/site3/js/jquery.min.js"></script>
<!-- JQUERY.MIN JS -->
<script src="<?php echo base_url(); ?>/assets/site3/js/popper.min.js"></script>
<!-- BOOTSTRAP.MIN JS -->
<script src="<?php echo base_url(); ?>/assets/site3/js/bootstrap.min.js"></script>
<!-- BOOTSTRAP.MIN JS -->
<script src="<?php echo base_url(); ?>/assets/site3/js/menu_jquery.js"></script>
<script src="<?php echo base_url(); ?>/assets/site3/js/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>/assets/site3/js/datepicker2/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/site3/js/moment.js"></script>
<script src="<?php echo base_url(); ?>/assets/site3/js/custom.js"></script>
<script src="<?php echo base_url(); ?>/assets/site3/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/site3/js/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>

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

<script>

  var splide = new Splide("#main-slider", {
    width: '100%',
    height: 400,
    pagination: false,
    cover: true,
    autoplay: true,
    interval: 3000,
    rewind: true, 
    perMove: 1, 
    perPage: 1, 
    gap: 0, 
  });

  var thumbnails = document.getElementsByClassName("thumbnail");
  var current;

  for (var i = 0; i < thumbnails.length; i++) {
    initThumbnail(thumbnails[i], i);
  }

  function initThumbnail(thumbnail, index) {
    thumbnail.addEventListener("click", function () {
      splide.go(index);
    });
  }

  splide.on("mounted move", function () {
    var thumbnail = thumbnails[splide.index];

    if (thumbnail) {
      if (current) {
        current.classList.remove("is-active");
      }

      thumbnail.classList.add("is-active");
      current = thumbnail;
    }
  });

  splide.mount();


</script>

<script>
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev',
        center: 'title',
        right: 'next'
        
      },
      defaultView: 'month',
      events: [
        // Sample event data
        {
          title: 'Event 1',
          start: '2023-07-15',
          end: '2023-07-16',
          description: 'Event 2 details'
        },
        {
          title: 'Event 2',
          start: '2023-07-20T10:30:00',
          end: '2023-07-20T12:30:00',
          description: 'Event 2 details'
        }
        // Add more events as needed
      ],
      eventClick: function(event) {
        Swal.fire({
            title: event.title,
            text: event.description,
          });
      }
    });
  });
</script>



<script>
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
<script>
	var myAudio = document.getElementById("tempAudio");
	var isPlaying = false;

	function togglePlay() {
	  if (isPlaying) {
		myAudio.pause()
	  } else {
		myAudio.play();
	  }
	};
	myAudio.onplaying = function() {
	  isPlaying = true;
	};
	myAudio.onpause = function() {
	  isPlaying = false;
	};
		
	
		$(".atd_btn").click(function(){
		  $(this).toggleClass("play");
		});
	</script>
	    <script>
        document.getElementById('content1').classList.remove('hiddencontent');

        function showContent(contentNumber) {
        const contentElements = document.querySelectorAll('.content div');
        contentElements.forEach(element => element.classList.add('hiddencontent'));

        const selectedContent = document.getElementById(`content${contentNumber}`);
        selectedContent.classList.remove('hiddencontent');

        const buttons = document.querySelectorAll('.buttons button');
        buttons.forEach(button => button.classList.remove('activecontent'));
        buttons[contentNumber - 1].classList.add('activecontent');
        }
    </script>
    
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
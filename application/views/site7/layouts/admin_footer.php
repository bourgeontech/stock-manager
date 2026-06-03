<!--Footer-->

<div class="container-fluid footerBg">
  <div class="row">
    <div class="col-sm-12 text-center">

      
      <ul class="listBotNav">
          <li><a href="<?php echo base_url(); ?>index.php/welcome/index">Home</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/temple">The Temple</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/poojas">Poojas</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/festivals">Festivals</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/news">News</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/welcome/contact">Administrative</a></li>      </ul>
      <a href="link to fb page" target="_blank"><img src="<?php echo base_url(); ?>/assets/site6/images/facebook2.png" alt="Facebook"></a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="link to yt" target="_blank"><img src="<?php echo base_url(); ?>/assets/site6/images/youtube2.png" alt="You Tube"></a>
      <p class="txtCopyright">Copy right © <?php print_r($temple_list[0]['name']);?>. All rights reserved.</p>
    </div>
  </div>
</div>
<script>
function message(){
$("#msg").html("Successfully subscribed");
$("#msg").show();
}
</script><script src="<?php echo base_url(); ?>/assets/site6/js/jquery-3.2.1.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('#menu').slicknav();
});
</script>
<script>
$(function() {
  $('a[href*=#]').on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 500, 'linear');
  });
});
</script>
<script src="<?php echo base_url(); ?>/assets/site6/js/responsive-slider.js"></script>
<script src="<?php echo base_url(); ?>/assets/site6/themes/user/js/website/main.js"></script>
<script src="<?php echo base_url(); ?>/assets/site6/js/prefixfree.min.js"></script>
<script>
$(document).ready(function(){
	var touch 	= $('#resp-menu');
	var menu 	= $('.menu');

	$(touch).on('click', function(e) {
		e.preventDefault();
		menu.slideToggle();
	});

	$(window).resize(function(){
		var w = $(window).width();
		if(w > 767 && menu.is(':hidden')) {
			menu.removeAttr('style');
		}
	});

});
</script>
<script src="<?php echo base_url(); ?>/assets/site6/js/owl.carousel.js"></script>
<script>

    $(document).ready(function() {

      $("#owl-news").owlCarousel({
        navigation : true,
			items: 1,
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [989,1],
		itemsTablet: [767,1],
		 itemsMobile : false,
		autoPlay: true,


		 navigationText: ["<img src='<?php echo base_url(); ?>/assets/site6/images/arrow-left.png'>","<img src='<?php echo base_url(); ?>/assets/site6/images/arrow-right.png'> <input name='' value='View All News' class='btnDonations' onclick='url_redirect_news()' type='button' style='font-size:16px;padding:5px 11px'>"]
      });

	     $("#owl-gallary").owlCarousel({
        navigation : true,
			items: 1,
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [989,1],
		itemsTablet: [767,1],
		 itemsMobile : false,
		autoPlay: true,


		 navigationText: ["<img src='<?php echo base_url(); ?>/assets/site6/themes/user/img/website/arrow-left.png'>","<img src='<?php echo base_url(); ?>/assets/site6/themes/user/img/website/arrow-right.png'>"]
      });




	  });
	  </script>

      <script src="<?php echo base_url(); ?>/assets/site6/js/effects.js"></script>
<script type="text/javascript">
function url_redirect() {


window.open(
  '<?php echo base_url(); ?>index.php/worldline/booking',
  '_blank' // <- This is what makes it open in a new window.
);


}
function url_redirect2() {


window.open(
  '<?php echo base_url(); ?>index.php/worldline/booking',
  '_blank' // <- This is what makes it open in a new window.
);


}
function url_redirect3() {


window.open(
  '<?php echo base_url(); ?>index.php/worldline/booking',
  '_blank' // <- This is what makes it open in a new window.
);


}
function url_redirect4() {


window.open(
  '<?php echo base_url(); ?>index.php/worldline/booking',
  '_blank' // <- This is what makes it open in a new window.
);


}
function url_redirect_common(val) {

window.location = "/"+val;


}
function url_redirect_news() {

window.location = "/news";


}
</script>


  <script src="<?php echo base_url(); ?>/assets/site6/js/bootstrap.min.js"></script>
  <script type="text/javascript">

    $(document).ready(function(){

        $("#myModal2").modal('show');

    });

</script>
<style>
.modal-header{
border-bottom:0px;
}
</style>



</body></html>
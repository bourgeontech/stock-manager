// JavaScript Document

 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $(this).toggleClass('active');
 });
 $('#sidebarCollapse_b').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $(this).toggleClass('active');
 });
 
 /////Fix - Header /////
 $(window).load(function(){
      $("#header").sticky({ topSpacing: 0 });
	  $("#fix_nav").sticky({ topSpacing: 50 });
 });
 /////Fix - Header /////
	 $(document).ready(function() {
			if ( $(window).width() > 790 ) {
			$("#luca_head").sticky({ topSpacing: 50 });
			}
		
			else {
			$("#luca_head").sticky({ topSpacing: 0 });
			}	
	});

 







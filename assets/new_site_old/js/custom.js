// JavaScript Document

 
 $("#pooja_items").owlCarousel({
      
	  loop:true,
	  autoplay:true,
	  margin:30,
	 //width:117,
	 //mouseDrag:false,
	  //stagePadding: 50,
	 autoplayTimeout:4000,
	 //autoWidth: true,
	 nav:false,
	 
	  responsive:{
        300:{
            items:1,
            
        },
        600:{
            items:3,
			 //width:false,
			 //autoWidth: true,
             
        },
        1000:{
            items:5,
			
			 
 
        }
    }
	   
  }); 
 
 
/////////////////////////////////////////////
$("#gallery").owlCarousel({
      
	  loop:true,
	  autoplay:true,
	  margin:30,
	 //width:117,
	 //mouseDrag:false,
	  //stagePadding: 50,
	 autoplayTimeout:5000,
	 //autoWidth: true,
	 nav:false,
	 
	  responsive:{
        300:{
            items:1,
            
        },
        600:{
            items:3,
			 //width:false,
			 //autoWidth: true,
             
        },
        1000:{
            items:4,
			
			 
 
        }
    }
	   
  }); 
  

/////////Service Slider ////////////
 $('#slider').owlCarousel({
    loop:true,
	autoplay:true,
    margin:0,
    nav:false,
    items:1,
	autoplayTimeout:4000,
});
 
 
/////////Service Slider ////////////
 $('#ad_slider').owlCarousel({
    loop:true,
	animateOut: 'fadeOut',
	autoplay:true,
    margin:0,
    nav:false,
    items:1,
	autoplayTimeout:6000,
});
  

 //////////////wow//////////////
   new WOW().init();
 

 
 
 
 
 
 
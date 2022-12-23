$(document).ready(function(){


  //=================================== Nav Responsive ===================================//
    $('#menu').tinyNav({
       active: 'selected'
    });
  

  //=================================== Slide Border  =================================//
    $('#dg-container').gallery();

 //=================================== Nav Superfish ===============================//
    jQuery(document).ready(function() {
		jQuery('ul.sf-menu').superfish();
	});

  //=================================== Last version of Fancybox V2  ===================================//
	
	$('.fancybox').fancybox();
	  jQuery("a[class*=fancybox]").fancybox({
		'overlayOpacity'	:	0.7,
		'overlayColor'		:	'#000000',
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'easingIn'      	: 'easeOutBack',
		'easingOut'     	: 'easeInBack',
		'speedIn' 			: '700',
		'centerOnScroll'	: true,
		'titlePosition'     : 'over'
	});
		
     
});


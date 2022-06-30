(function($) {

	"use strict";

	$( document ).ready(function() {

		$('#header-spacer').height( $('#header-main-fixed').height() );

		if ($('#wpadminbar').length > 0) {
		
			$('#header-main-fixed').css('top', $('#wpadminbar').height() + 'px');
			$('#wpadminbar').css('position', 'fixed');
		}

		$(window).on('scroll', function () {

			if ($(this).scrollTop() > 100) {

				$('.scrollup').fadeIn();

			} else {

				$('.scrollup').fadeOut();

			}
		});

		$('.scrollup').on('click', function () {
			
			$("html, body").animate({
				  scrollTop: 0
			  }, 600);

			return false;
		});

		hospitallight_mainMenuInit();

		$('#navmain > div').on('click', function(e) {

			e.stopPropagation();

			// toggle main menu
			if ( $(window).width() < 800 ) {

				var parentOffset = $(this).parent().offset(); 
				
				var relY = e.pageY - parentOffset.top;
			
				if (relY < 36) {
				
					var firstChild = $('ul:first-child', this);

        if (firstChild.css('right') == '-99999px')
            firstChild.css({'right': 'auto'});
        else
            firstChild.css({'right': '-99999px'});

        firstChild.parent().toggleClass('mobile-menu-expanded');
				}
			}
		});

		// re-init main menu on screen resize
		$(window).on('resize', function () {
	       
	    	hospitallight_mainMenuClear();
	    	hospitallight_mainMenuInit();
		});
	});

	function hospitallight_mainMenuClear() {

		if ( $(window).width() >= 800 ) {
		
			$('#navmain > div > ul > li').has('ul').removeClass('level-one-sub-menu');
			$('#navmain > div > ul li ul li').has('ul').removeClass('level-two-sub-menu');										
		}

		if ( $('ul:first-child', $('#navmain > div') ).is( ":visible" ) ) {

			$('ul:first-child', $('#navmain > div') ).css('display', '');
		}
	}

	function hospitallight_mainMenuInit() {

		if ( $(window).width() >= 800 ) {
		
			$('#navmain > div > ul > li').has('ul').addClass('level-one-sub-menu');
			$('#navmain > div > ul li ul li').has('ul').addClass('level-two-sub-menu');

    // add support of browsers which don't support focus-within
    $('#navmain > div > ul > li > a:not(.search-form-icon), #navmain > div > ul > li > ul > li > a, #navmain > div > ul > li > ul > li > ul > li > a, .mega-menu-sub-menu')
      .on('mouseenter focus', function() {
        $(this).closest('li.level-one-sub-menu').addClass('menu-item-focused');
        $(this).closest('li.level-two-sub-menu').addClass('menu-item-focused');

        if (!$(this).parent().find('#cart-popup-content').length && $('#cart-popup-content').css('right') != '-99999px')
          $('#cart-popup-content').css('right', '-99999px');
      }).on('mouseleave blur', function() {
        $(this).closest('li.level-one-sub-menu').removeClass('menu-item-focused');
        $(this).closest('li.level-two-sub-menu').removeClass('menu-item-focused');
    });
			
		} else {

			$('#navmain > div > ul > li').each(
		       function() {
		         if ($(this).find('> ul.sub-menu').length > 0) {

		           $(this).prepend('<span class="sub-menu-item-toggle"></span>');
		         }
		       }
		     );

		   $('#navmain').on('focusin', function(){

      if ($('#navmain > div > ul').css('right') == '-99999px') {

        $('#navmain > div > ul').css({'right': 'auto'});
        $('#navmain ul ul').css({'right': 'auto'}).css({'position': 'relative'});

        $('.sub-menu-item-toggle').addClass('sub-menu-item-toggle-expanded');
      }
    });

	$('#main-content-wrapper, #home-content-wrapper').on('focusin', function(){
    
      if ($('#cart-popup-content').css('right') != '-99999px')
        $('#cart-popup-content').css('right', '-99999px');

      if ($('#navmain > div > ul').css('right') != '-99999px') {
        $('#navmain > div > ul').css({'right': ''});  
      }

    });

   $('.sub-menu-item-toggle').on('click', function(e) {

		     e.stopPropagation();

		     var subMenu = $(this).parent().find('> ul.sub-menu');

		     $('#navmain ul ul.sub-menu').not(subMenu).css('right', '-99999px').css('position', 'absolute');
		     $(this).toggleClass('sub-menu-item-toggle-expanded');
		     if (subMenu.css('right') == '-99999px') {

        subMenu.css({'right': 'auto'}).css({'position': 'relative'});
        subMenu.find('ul.sub-menu').css({'right': 'auto'}).css({'position': 'relative'});

     } else {

        subMenu.css({'right': '-99999px'}).css({'position': 'absolute'});
        subMenu.find('ul.sub-menu').css({'right': '-99999px'}).css({'position': 'absolute'});
     }
		   });
		}
	}

})(jQuery);
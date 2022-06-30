(function($) {

	"use strict";

	$( document ).ready(function() {

      	$("#cloud9-carousel").Cloud9Carousel( {
		    yOrigin: 42,
		    yRadius: 40,
		    itemClass: "cloud9-item",
		    buttonLeft: $(".cloud9-nav.left"),
		    buttonRight: $(".cloud9-nav.right"),
		    bringToFront: true,
		        onLoaded: function() {/*
		          showcase.css( 'visibility', 'visible' )
		          showcase.css( 'display', 'none' )
		          showcase.fadeIn( 1500 ) */
		        },
		} );

	    // Simulate physical button click effect
	    $('.nav').on('click', function( e ) {
	        var b = $(e.target).addClass( 'down' )
	        setTimeout( function() { b.removeClass( 'down' ) }, 80 )
	      } );

	      $(document).on('keydown',  function( e ) {

	        switch( e.keyCode ) {
	          /* left arrow */
	          case 37:
	            $('.nav.left').click()
	            break

	          /* right arrow */
	          case 39:
	            $('.nav.right').click()
	        }
	      } );


	    // Init WooCommerce mini-basket
	    $('a.cart-contents-icon').on('mouseenter focusin', function(){
		
			// display mini-cart if it's not visible
			if ( $('#cart-popup-content').css('z-index') == '-1' ) {

				var rightPos = ($(window).width() - ($(this).offset().left + $(this).outerWidth()));
				var topPos = $(this).offset().top - $(window).scrollTop() + $(this).outerHeight(); 

				$('#cart-popup-content').css('right', rightPos).css('top', topPos).fadeIn();
			}
		});
		
		$('#cart-popup-content').on('mouseleave', function(){
    
      $('#cart-popup-content').css('z-index', '-1').css('right', '-99999px');
    });

    $('#main-content-wrapper, #home-content-wrapper').on('focusin', function(){
    
      $('#cart-popup-content').css('z-index', '-1').css('right', '-99999px');

      $('#navmain > div > ul').css('z-index', '-1').css('right', '-99999px');

    });
		
 });

})(jQuery);
// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
	window.getComputedStyle = function(el, pseudo) {
		this.el = el;
		this.getPropertyValue = function(prop) {
			var re = /(\-([a-z]){1})/g;
			if (prop == 'float') prop = 'styleFloat';
			if (re.test(prop)) {
				prop = prop.replace(re, function () {
					return arguments[2].toUpperCase();
				});
			}
			return el.currentStyle[prop] ? el.currentStyle[prop] : null;
		}
		return this;
	}
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {
	
  $('body').bind('touchstart', function() {});

	/* getting viewport width */
	var responsive_viewport = $(window).width();
	
	/* if is below 481px */
	if (responsive_viewport < 481) {
	
	} /* end smallest screen */
	
	/* if is larger than 481px */
	if (responsive_viewport > 481) {
	
	
	} /* end larger than 481px */
	
	/* if is above or equal to 768px */
	if (responsive_viewport >= 768) {
	
		/* load gravatars */
		$('.comment img[data-gravatar]').each(function(){
			$(this).attr('src',$(this).attr('data-gravatar'));
		});
		
		// controls the one-page nav jquery
		
		$('.sub-nav').onePageNav({scrollThreshold: 0.25});
		
	}
	
	/* off the bat large screen actions */
	if (responsive_viewport > 1030) {
	
	}
	
	//Responsive Collapsing Nav
	
	$(function() {
		var mobileToggle = $('.mobile-toggle');
		var menu = $('nav.mobile > ul');
		var menuHeight = menu.height();
		
		$(mobileToggle).on('click', function(e) {
			e.preventDefault();
			menu.slideToggle();
		});
			
		$(window).resize(function() {
			var w = $(window).width();
			if(w > 768 && menu.is(':hidden')) {
				menu.removeAttr('style');
			}
		});
	});
	
	//Simple Weather
		
		$.simpleWeather({
	    
	    woeid: '2424766',
	    unit: 'f',
	    success: function(weather) {
	      html = '<i class="icon-'+weather.code+'"></i><span>' + weather.currently + ' and ' + weather.temp + '&deg;' + weather.units.temp + ' currently in ' + weather.city + ', ' + weather.region + '<span class="attribution">from <a href="' + weather.link + '">Yahoo! Weather</a></span>' + '</span>';
	  
	      $("#weather").html(html);
	    },
	    error: function(error) {
	      $("#weather").html('<p>'+error+'</p>');
	    }
	  });
	
	$("#weather").hover(function(){
  	$(".attribution").delay(250).fadeIn(); },
  	function() { $(".attribution").fadeOut();  
	});

	
	// adds button styling to tribe_the_prev_event_link and tribe_the_next_event_link since those output the url with the anchor tag.
	
	$('.single .tribe-events-nav-previous a').addClass('gray clear button left');
	$('.single .tribe-events-nav-next a').addClass('gray clear button right');
	
	
	//back to top button
	
	var offset = 220;
	var duration = 500;
	$(window).scroll(function() {
  	if($(this).scrollTop() > offset) {
    	$('.back-to-top').fadeIn(duration);
    	} else {
      	$('.back-to-top').fadeOut(duration);
  	}
  	
	});
	$('.back-to-top').click(function(event) {
  	event.preventDefault();
  	jQuery('html, body').animate({scrollTop: 0}, duration);
  	return false;
	});
	
	
	// add all your scripts here
 
}); /* end of as page load scripts */

//Scroll to anchor on new page load
  

var mainNav = jQuery('nav.main-nav'),
		mainNavOffset = jQuery('nav.main-nav').offset().top,
		mainNavHeight = jQuery('nav.main-nav').height();

if( jQuery('nav.sub-nav').length ) {
	var subNav = jQuery('nav.sub-nav'),
			subNavOffset = jQuery('nav.sub-nav').offset().top;
}

jQuery(window).scroll(function() {
		mainNav.toggleClass('sticky', jQuery(window).scrollTop() > mainNavOffset);
		
		if( jQuery('nav.sub-nav').length ) {
			subNav.toggleClass('sticky', jQuery(window).scrollTop() > (subNavOffset - 52));

		}
});


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
	var doc = w.document;
	if( !doc.querySelector ){ return; }
	var meta = doc.querySelector( "meta[name=viewport]" ),
		initialContent = meta && meta.getAttribute( "content" ),
		disabledZoom = initialContent + ",maximum-scale=1",
		enabledZoom = initialContent + ",maximum-scale=10",
		enabled = true,
		x, y, z, aig;
	if( !meta ){ return; }
	function restoreZoom(){
		meta.setAttribute( "content", enabledZoom );
		enabled = true; }
	function disableZoom(){
		meta.setAttribute( "content", disabledZoom );
		enabled = false; }
	function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
		if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );

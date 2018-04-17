jQuery(document).ready(function($) {

	var homepageOwl = $('#home-owl-carousel');
      
      homepageOwl.owlCarousel({
      	navigation : true,
      	slideSpeed : 1000,
      	paginationSpeed : 1000,
      	singleItem: true,
      	navigation: false,
      	stopOnHover: false,
      	autoPlay: true,
      	transitionStyle: "fade"
      	   
      });
      
      $(".owl-navigation .next").click(function(){
		    homepageOwl.trigger('owl.next');
		  });
		  $(".owl-navigation .prev").click(function(){
		    homepageOwl.trigger('owl.prev');
		  });
	 
});
jQuery(document).ready(function(){

	// featured slider
	if(jQuery('#hero-slider .featured-slider'))
	{
		jQuery('#hero-slider .featured-slider').slick({
	    	centerMode: true,
			centerPadding: '250px',
			slidesToShow: 1,
			infinite: true,
			speed:300,
			autoplay: true,
	  		autoplaySpeed: 5000,
	  		focusOnSelect:false,
	  		arrows: true,
	  		dots: false,
			responsive: [
				{
				  breakpoint: 768,
				  settings: {
				    arrows: false,
				    centerMode: true,
				    centerPadding: '80px',
				    slidesToShow: 1
				  }
				},
				{
				  breakpoint: 480,
				  settings: {
				    arrows: false,
				    centerMode: true,
				    centerPadding: '40px',
				    slidesToShow: 1
				  }
				}
			]
	  	});
	}
  	

  	//tv-series slider
  	if (jQuery('#tv-series .featured-slider'))
  	{
  		jQuery('#tv-series .featured-slider').slick({
			slidesToShow: 1,
			// infinite: false,
			// speed:500,
			// autoplay: false,
	  		// autoplaySpeed: 5000,
	  		// focusOnSelect:false,
	  		// arrows: true,
	  		// dots: false
	  	});
  	}

  	//tv-series featured slider
  	if (jQuery('.featured-tv-series'))
  	{
  		jQuery('.featured-tv-series').slick({
			slidesToShow: 1,
	  		arrows: true,
	  		dots: false
	  	});
  	}
  	
  	//tv-series archive slider
  	if (jQuery('.tv-list'))
  	{
  		jQuery('.tv-list').slick({
			slidesToShow: 3,
			infinite: true,
			autoplay: false,
	  		arrows: true,
	  		responsive: [
				{
				  breakpoint: 768,
				  settings: {
				    arrows: false,
				    centerMode: true,
				    centerPadding: '80px',
				    slidesToShow: 1
				  }
				},
				{
				  breakpoint: 480,
				  settings: {
				    arrows: false,
				    centerMode: true,
				    centerPadding: '40px',
				    slidesToShow: 1
				  }
				}
			]
	  	});
  	}

  	//contributor slider
  	if (jQuery('.contributed-slider'))
  	{
  		jQuery('.contributed-slider').slick({
			slidesToShow: 3,
			infinite: true,
			// speed:500,
			autoplay: false,
	  		// autoplaySpeed: 5000,
	  		// focusOnSelect:false,
	  		arrows: true,
	  		dots: false
	  	});
  	}
  	

  	//widget slider
  	if(jQuery('.widget-slider'))
  	{
  		jQuery('.widget-slider').slick({
	  		slidesToShow: 1,
			infinite: true,
			autoplay: true,
	  		arrows: true
	  	});
  	}
  	



  	// when hiro video player started, handle it
  	jQuery(document).on("hiro_started", function (evt) {
		jQuery('.featured-slider').slick('slickPause');
		// jQuery('.featured-slider').slick("slickSetOption", "draggable", false, false);
  		hiro_event_handler();
  	});

  	var hiro_event_handler = function() {

  		var hiro_player = hiro(jQuery('#hiro_player'));

  		if (hiro_player)
  		{
			hiro_player.on("load", function( event ) {
				//on load, remove loader and slide title
				//change spinner icon back to normal
				jQuery('.slick-active').find('.play-btn').css('opacity','0');
				jQuery('.slick-active').find('.play-btn i').removeClass();
				jQuery('.slick-active').find('.play-btn i').addClass('fa fa-play fa-5x');
				jQuery('.slick-active').find('.slide-title').css('bottom', '-20px');
				jQuery('.slick-active').find('.slide-title').css('opacity','0');

				jQuery('.course-video').find('.play-btn').css('opacity','0');
				jQuery('.course-video').find('.play-btn i').removeClass();
				jQuery('.course-video').find('.play-btn i').addClass('fa fa-play fa-5x');
		    });

		    hiro_player.on('moviecomplete', function(event) {
		    	//on complete, set loader and slide title back to normal position and reattach the mouseover and mouseout event
		    	//remove the hiro player also
		    	jQuery('.slick-active').unbind('mouseover mouseout');
		    	jQuery('.slick-active').find('#hiro_player').remove();

		    	jQuery('.course-video').find('#hiro_player').remove();
		    	jQuery('.course-video').find('.play-btn').css('opacity','1');

		    	jQuery('.featured-slider').slick('slickPlay');
		    	jQuery('.featured-slider').slick("slickSetOption", "draggable", true, false);
		    });
  		}
  	}
  	

  	// var slide_active_hover_animation = function() {
  	// 	jQuery('.slick-active')
	  // 		.mouseover(function(){
	  // 			jQuery(this).find('.play-btn').css('opacity', 1);
		 //  		jQuery(this).find('.slide-title').css('bottom', '-10px');
		 //  		jQuery(this).find('.slide-title').css('opacity', 1);
	  // 		})
	  // 		.mouseout(function(){
	  // 			jQuery(this).find('.play-btn').css('opacity', 0);
		 //  		jQuery(this).find('.slide-title').css('bottom', '-20px');
		 //  		jQuery(this).find('.slide-title').css('opacity', 0);
	  // 		});
  	// }

  	// jQuery('.slick-slider')
	  // 	.mouseover(function(){
	  // 		jQuery('.slick-prev, .slick-next').css('opacity', 1);
	  // 	})
	  // 	.mouseout(function(){
	  // 		jQuery('.slick-prev, .slick-next').css('opacity', 0);
	  // 	});

	// slide_active_hover_animation();

	/**** 
		- fires after each slide change 
		- on each change, check if hiro_player exist and remove
		- perform whatever hiro_player video complete and video load event perform
	****/
  	jQuery('.featured-slider').on('afterChange', function(event, slick, currentSlide){
	 	jQuery('.slick-slide').find('#hiro_player').remove();
	 	jQuery('.slick-slide').unbind('mouseover mouseout');
	 	// jQuery('.slick-slide').find('.play-btn').css('opacity','0');
		jQuery('.slick-slide').find('.play-btn i').removeClass();
		jQuery('.slick-slide').find('.play-btn i').addClass('fa fa-play fa-5x');
		// jQuery('.slick-slide').find('.slide-title').css('bottom', '-20px');
		// jQuery('.slick-slide').find('.slide-title').css('opacity','0');
    	jQuery('.featured-slider').slick('slickPlay');
    	jQuery('.featured-slider').slick("slickSetOption", "draggable", true, false);
    	// slide_active_hover_animation();
	});

  	jQuery('.featured-slider .play-btn').click(function(evt) {

  		evt.preventDefault();
  		jQuery(".slick-active").unbind('mouseover mouseout');

  		var videoUrl = jQuery(this).parent().find('#videoUrl').val();
  		var videoPoster = jQuery(this).parent().find('#videoPoster').val();

  		init_hiro_player(videoUrl, videoPoster, jQuery(this).parent());

  		jQuery(this).css('opacity', 1);
  		jQuery(this).find('i').removeClass();
  		jQuery(this).find('i').addClass('fa fa-spinner fa-spin fa-5x');
  		jQuery(this).parent().find('.slide-title').css('opacity', 1);
  		
  	});

});
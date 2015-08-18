(function($) {

	var all_slider = $('.featured-slider');
	var slick_slide = $('.slick-slide');
	var featured_slider = $('#hero-slider .featured-slider');
	var tv_series_slider = $('#tv-series .featured-slider');
	var single_video_btn = $('.single-video .play-btn');
	var featured_video_btn = $('.featured-slider .play-btn');
	var slick_active = $(".slick-active");
	var hiro_player = $('#hiro_player');
	var home = $('.home');

	var main = {

		init: function(){

			// init slider on homepage
			
			this.initFeaturedSlickSlider();
			// this.initSlickSlider(tv_series_slider, false);
			 
			if (single_video_btn)
				this.singleVideoPlayHandler();

			// if (featured_video_btn)
				this.featuredVideoPlayHandler();

			if (all_slider) //handle event for all sliders
				this.sliderEventHandler();
			
		},

		initFeaturedSlickSlider: function() {

			$('#hero-slider .featured-slider').slick({
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
		},

		// initTVSlickSlider: function

		singleVideoPlayHandler: function() {

			single_video_btn.on('click', function(evt) {

			    evt.preventDefault();

			    var videoUrl = $(this).parent().find('#videoUrl').val();
			    var videoPoster = $(this).parent().find('#videoPoster').val();

			    init_hiro_player(videoUrl, videoPoster, $(this).parent());

			    $(this).css('opacity', 1);
			    $(this).find('i').removeClass();
			    $(this).find('i').addClass('fa fa-spinner fa-spin fa-5x');
			    
			});

			
		},

		featuredVideoPlayHandler: function() {

			featured_video_btn.on('click', function(evt) {

		  		evt.preventDefault();
		  		slick_active.unbind('mouseover mouseout');

		  		var videoUrl = jQuery(this).parent().find('#videoUrl').val();
		  		var videoPoster = jQuery(this).parent().find('#videoPoster').val();

		  		init_hiro_player(videoUrl, videoPoster, $(this).parent());

		  		$(this).css('opacity', 1);
		  		$(this).find('i').removeClass();
		  		$(this).find('i').addClass('fa fa-spinner fa-spin fa-5x');
		  		$(this).parent().find('.slide-title').css('opacity', 1);
		  		
		  	});
		},

		sliderEventHandler: function() {

			all_slider.on('afterChange', function(event, slick, currentSlide){
			 	slick_slide.find('#hiro_player').remove();
			 	slick_slide.unbind('mouseover mouseout');
			 	// slick_slide.find('.play-btn').css('opacity','0');
				slick_slide.find('.play-btn i').removeClass();
				slick_slide.find('.play-btn i').addClass('fa fa-play fa-5x');
				// slick_slide.find('.slide-title').css('bottom', '-20px');
				// slick_slide.find('.slide-title').css('opacity','0');
		    	all_slider.slick('slickPlay');
		    	all_slider.slick("slickSetOption", "draggable", true, false);
		    	// slide_active_hover_animation();
			});
		},

		hiroEventHandler: function() {
			var hiroPlayer = hiro(hiro_player);

	  		if (hiroPlayer)
	  		{
				hiroPlayer.on("load", function( event ) {
					//on load, remove loader and slide title
					//change spinner icon back to normal
					if (slick_active)
					{
						slick_active.find('.play-btn').css('opacity','0');
						slick_active.find('.play-btn i').removeClass();
						slick_active.find('.play-btn i').addClass('fa fa-play fa-5x');
						slick_active.find('.slide-title').css('bottom', '-20px');
						slick_active.find('.slide-title').css('opacity','0');
					}
					
			    });

			    hiro_player.on('moviecomplete', function(event) {
			    	//on complete, set loader and slide title back to normal position and reattach the mouseover and mouseout event
			    	//remove the hiro player also
			    	if (slick_active)
			    	{
			    		slick_active.unbind('mouseover mouseout');
			    		slick_active.find('#hiro_player').remove();
			    	}
			    	all_slider.slick('slickPlay');
			    	all_slider.slick("slickSetOption", "draggable", true, false);
			    });
	  		}
		}
	}

	$(document).on("hiro_started", function (evt) {

		if (all_slider)
		{
			all_slider.slick('slickPause');
		} 

		if (single_video_btn)
		{
			single_video_btn.remove();
		}
		
		main.hiroEventHandler();
		
		// jQuery('.featured-slider').slick("slickSetOption", "draggable", false, false);
  	});

	setTimeout(function(){
		main.init();
	},500);
	
	
	

})( jQuery );
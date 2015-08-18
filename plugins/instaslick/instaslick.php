<?php 
    /*
    Plugin Name: InstaSlick
    Plugin URI: http://www.ongzx.com
    Description: Plugin for displaying instagram feed using Instafeed.js with Slick.js
    Author: ongzx
    Version: 1.0
    Author URI: http://www.ongzx.com
    */
?>
<?php 
	
	// add_action('wp_footer', 'mp_footer'); 

	function instaslick_admin() {
	    include('instaslick_admin.php');
	}

	function instaslick_admin_actions() {
	    add_options_page("InstaSlick Setting", "InstaSlick Setting", 1, "InstaSlick_Setting", "instaslick_admin");
	}
	 
	add_action('admin_menu', 'instaslick_admin_actions');

	// add_shortcode('instaslick', 'instaslick_display');

	function instaslick_display() {

		// extract( shortcode_atts( array(
		// 	'accessibility' => 'true',
		// 	'adaptiveHeight' => 'false',
		// 	'autoplay' => 'false',
		// 	'autoplaySpeed' => '3000',
		// 	'arrows' => 'true',
		// 	'asNavFor' => '',
		// 	'appendArrows' => '',
		// 	'prevArrow' => '',
		// 	'nextArrow' => '',
		// 	'centerMode' => 'false',
		// 	'centerPadding' => '',
		// 	'cssEase' => 'ease',
		// 	'dots' => 'false',
		// 	'draggable' => 'true',
		// 	'fade' => 'true',
		// 	'focusOnSelect' => 'false',
		// 	'easing' => 'linear',
		// 	'edgeFriction' => '0.15',
		// 	'infinite' => 'true',
		// 	'initialSlide' => '0',
		// 	'lazyLoad' => 'ondemand',
		// 	'mobileFirst' => 'false',
		// 	'pauseOnHover' => 'true',
		// 	'pauseOnDotsHover' => 'false'
		// 	), $atts) 
		// );

    	$userId = get_option('instaslick_userId');
        $accessToken = get_option('instaslick_accessToken');
        $speed = get_option('instaslick_speed');
        $autoplaySpeed = get_option('instaslick_autoplaySpeed');

        return '<div id="instafeed" class="instafeed"></div>
        	<script type="text/javascript">
	        var userFeed = new Instafeed({
			    get: "user",
			    userId: '.$userId.',
			    accessToken: "'.$accessToken.'",
			    resolution: "low_resolution",
			    after: function()
			    {	
			    	jQuery("#instafeed a").append("<div class=\'overlay img-responsive\'><label class=\'overlay-text\'></label></div>");
			    	
			        jQuery(".instafeed").slick({
			        	slidesToShow: 5,
				        dots: false,
				        arrows: false,
				        infinite: true,
				        speed: 1000,
				        // slidesToScroll: 1,
				        autoplay: true,
				        autoplaySpeed: 2000,
				        arrows: false,
				        responsive: [
				          {
				            breakpoint: 768,
				            settings: {
				              arrows: false,
		               		  infinite: true,
				              centerMode: true,
				              centerPadding: "40px",
				              slidesToShow: 3
				            }
				          },
				          {
				            breakpoint: 480,
				            settings: {
				              arrows: false,
				              centerMode: true,
				              infinite: true,
				              centerPadding: "40px",
				              slidesToShow: 1
				            }
				          }
				        ]

			            // dots: false,
			            // arrows: false,
			            // infinite: true,
			            // variableWidth: true,
			            // speed: 1000,
			            // autoplay: true,
			            // autoplaySpeed: 2000,
			            // infinite: true,
			            // // slidesToShow: 3,
			            // // slidesToScroll: 3,
			            // easing: "easeInOut"
			        });
			    }
			});
			userFeed.run();</script>';
	}
?>
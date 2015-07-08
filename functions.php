<?php 

//************************************************//
// -> START Redux embed
//************************************************//

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}

if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/sample/sample-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/config/sample-config.php' );
}

global $mothernist_config; 

add_action( 'after_setup_theme', 'mothernist_setup' );

if ( ! function_exists( 'mothernist_setup' ) ):
    function mothernist_setup() {  
        register_nav_menu( 'primary', __( 'Primary navigation', 'mothernist-menu' ) );
    } endif;

require_once(dirname( __FILE__ ) . '/includes/template/wp_bootstrap_navwalker.php');

//************************************************//
// -> START enqueing required styles and scripts
//************************************************//

function mothernist_scripts_with_jquery()
{
	
	wp_register_style('reset', get_template_directory_uri() . '/includes/css/reset.min.css', null, null, null);
	wp_register_style('bootstrap-style', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css', null, null, null);
	wp_register_style('mailchimp', '//cdn-images.mailchimp.com/embedcode/slim-081711.css', null, null, null);
	wp_register_style('slick', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css', null, null, null);
	wp_register_style('slick-theme', get_template_directory_uri() . '/includes/css/slick-theme.css', null, null, null);
	wp_register_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css', null, null, null);
	wp_register_style('mobile-style', get_template_directory_uri() . '/includes/css/mobile-style.css', null, null, null);
	wp_register_style('main', get_template_directory_uri() . '/style.css', null, null, null);

	wp_register_script( 'bootstrap-script', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array( 'jquery' ), null, null );
	wp_register_script( 'slick-script', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js', array( 'jquery' ), null, null );
	wp_register_script( 'slick-slider', get_template_directory_uri(). '/includes/js/slick-slider.js', array( 'jquery' ), null, null );
	wp_register_script( 'instafeed', get_template_directory_uri(). '/includes/js/vendor/instafeed.min.js', array( 'jquery' ), null, null );
	wp_register_script( 'hiro-player-init', '//tag.mothernist.hiro.tv/premium/scripts_test/hiro_dynamic_player.js?config=conf1&amp;autoInit=false', array( 'jquery' ), null, null );
	wp_register_script( 'hiro-player', get_template_directory_uri(). '/includes/js/hiro-player.js', array( 'jquery' ), null, null );
	// wp_register_script( 'main', get_template_directory_uri(). '/includes/js/main.js', array( 'jquery' ), null, null );


	wp_enqueue_style( 'reset' );
	wp_enqueue_style( 'bootstrap-style' );
	wp_enqueue_style( 'mailchimp' );
	wp_enqueue_style( 'slick' );
	wp_enqueue_style( 'slick-theme' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'mobile-style' );
	wp_enqueue_style( 'main' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap-script' );
	wp_enqueue_script( 'hiro-player-init' );
	wp_enqueue_script( 'hiro-player' );
	wp_enqueue_script( 'slick-script' );
	wp_enqueue_script( 'slick-slider' );
	wp_enqueue_script( 'instafeed' );
	// wp_enqueue_script( 'main' );
}

add_action( 'wp_enqueue_scripts', 'mothernist_scripts_with_jquery' );

//************************************************//
// -> START registering custom post types
//************************************************//
add_theme_support( 'post-thumbnails' ); 

add_action('init', 'article_register');
add_action('init', 'video_register');


function article_register() {
 
    $labels = array(
        'name' => _x('Article', 'post type general name'),
        'singular_name' => _x('Article', 'post type singular name'),
        'add_new' => _x('Add New', 'Article'),
        'add_new_item' => __('Add New Article'),
        'edit_item' => __('Edit Article'),
        'new_item' => __('New Article'),
        'view_item' => __('View Article'),
        'search_items' => __('Search Article'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array
    (
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-format-aside',
        'rewrite' => array('slug' => 'articles', 'with_front' => FALSE),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 4,
        'taxonomies' => array('post_tag'),
        'has_archive' => true,
        'supports' => array(
			'title',
			'editor',
			'excerpt',
			'custom-fields',
			'tags',
			'revisions',
			'thumbnail',
			'author'
		),
		'cptp_permalink_structure' => '/%category%/%postname%/'
	);

    register_post_type( 'articles' , $args );
    flush_rewrite_rules();
    register_taxonomy_for_object_type( 'category', 'articles' );

}

function video_register() {
 
    $labels = array(
        'name' => _x('Video', 'post type general name'),
        'singular_name' => _x('video', 'post type singular name'),
        'add_new' => _x('Add New', 'Video'),
        'add_new_item' => __('Add New Video'),
        'edit_item' => __('Edit Video'),
        'new_item' => __('New Video'),
        'view_item' => __('View Video'),
        'search_items' => __('Search Video'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array
    (
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-video-alt2',
        'rewrite' => array('slug' => 'videos', 'with_front' => FALSE),
        'capability_type' => 'post',
        'hierarchical' => false,
        'taxonomies' => array('post_tag'),
        'menu_position' => 5,
        'has_archive' => true,
        'supports' => array(
			'title',
			'editor',
			'excerpt',
			'tags',
			'custom-fields',
			'revisions',
			'thumbnail',
			'author'
		),
		'cptp_permalink_structure' => '/%category%/%postname%/'
	);

    register_post_type( 'videos' , $args );
    flush_rewrite_rules();
    register_taxonomy_for_object_type( 'category', 'videos' );
}

function event_register() {
 
    $labels = array(
        'name' => _x('Events', 'post type general name'),
        'singular_name' => _x('Event', 'post type singular name'),
        'add_new' => _x('Add New', 'Event'),
        'add_new_item' => __('Add New Event'),
        'edit_item' => __('Edit Event'),
        'new_item' => __('New Event'),
        'view_item' => __('View Event'),
        'search_items' => __('Search Event'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );

    $args = array
    (
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-location-alt',
        'rewrite' => array('slug' => 'events', 'with_front' => FALSE),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 7,
        'has_archive' => true,
        'taxonomies' => array('post_tag'),
        'supports' => array(
			'title',
			'editor',
			'excerpt',
			'custom-fields',
			'tags',
			'revisions',
			'thumbnail',
			'author'
		),
		'cptp_permalink_structure' => '/%category%/%postname%/'
	);
    
    register_post_type( 'events' , $args );
    flush_rewrite_rules();
    register_taxonomy_for_object_type( 'category', 'events' );
}

//************************************************//
// -> START creating custom sidebars
//************************************************//

add_action( 'widgets_init', 'custom_sidebars_register' );

function custom_sidebars_register() {

	register_sidebar(
		array(
			'id' => 'sidebar',
			'name' => __( 'Sidebar' ),
			'description' => __( 'Place for widgets that will be shown on sidebar across pages.' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
}

//************************************************//
// -> START general functionalities
//************************************************//

function get_theme_title() {

	global $mothernist_config; 
	$site_title = "";

	if (isset($mothernist_config['opt-title']))
      $site_title = $mothernist_config['opt-title'];
    if (isset($mothernist_config['opt-subtitle']))
      $site_title = $site_title." | ".$mothernist_config['opt-subtitle'];

  	return $site_title;
}

function get_theme_description() {

	global $mothernist_config; 
	$site_desc = "";

	if (isset($mothernist_config['opt-description']))
      $site_desc = $mothernist_config['opt-description'];

  	return $site_desc;
}

function get_theme_logo() {
	
	global $mothernist_config; 
	$site_logo = "";

	if (isset($mothernist_config['opt-logo']['url']))
      $site_logo = $mothernist_config['opt-logo']['url'];

  	return $site_logo;
}

?>
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

//************************************************//
// -> START enqueing required styles and scripts
//************************************************//

function mothernist_scripts_with_jquery()
{
	
	wp_register_style('reset', get_template_directory_uri() . '/css/reset.min.css', null, null, null);
	wp_register_style('bootstrap-style', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css', null, null, null);
	wp_register_style('mailchimp', '//cdn-images.mailchimp.com/embedcode/slim-081711.css', null, null, null);
	wp_register_style('main', get_template_directory_uri() . '/style.css', null, null, null);

	wp_register_script( 'bootstrap-script', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array( 'jquery' ), null, null );

	wp_enqueue_style( 'reset' );
	wp_enqueue_style( 'bootstrap-style' );
	wp_enqueue_style( 'mailchimp' );
	wp_enqueue_style( 'main' );

	wp_enqueue_script("jquery");
	wp_enqueue_script( 'bootstrap-script' );
}

add_action( 'wp_enqueue_scripts', 'mothernist_scripts_with_jquery' );

//************************************************//
// -> START registering custom post types
//************************************************//

add_action('init', 'article_register');
add_action('init', 'video_register');
add_action('init', 'event_register');

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
            'rewrite' => array('slug' => 'mothernist_article'),
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
			)
		);

    register_post_type( 'mothernist_article' , $args );
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
            'rewrite' => array('slug' => 'mothernist_video'),
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
			)
		);

    register_post_type( 'mothernist_video' , $args );
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
            'rewrite' => array('slug' => 'mothernist_event'),
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 7,
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
			)
		);

    register_post_type( 'mothernist_event' , $args );
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
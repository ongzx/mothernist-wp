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
    wp_register_style('main-mobile', get_template_directory_uri() . '/style-mobile.css', null, null, null);


	wp_register_script( 'bootstrap-script', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array( 'jquery' ), null, null );
	wp_register_script( 'slick-script', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js', array( 'jquery' ), null, null );
	wp_register_script( 'slick-slider', get_template_directory_uri(). '/includes/js/slick-slider.js', array( 'jquery' ), null, null );
	wp_register_script( 'instafeed', get_template_directory_uri(). '/includes/js/vendor/instafeed.min.js', array( 'jquery' ), null, null );
	wp_register_script( 'hiro-player-init', '//tag.mothernist.hiro.tv/premium/scripts_test/hiro_dynamic_player.js?config=conf1&amp;autoInit=false', array( 'jquery' ), null, null );
	wp_register_script( 'hiro-player', get_template_directory_uri(). '/includes/js/hiro-player.js', array( 'jquery' ), null, null );
	wp_register_script( 'main', get_template_directory_uri(). '/includes/js/main.js', array( 'jquery' ), null, null );

	wp_enqueue_style( 'reset' );
	wp_enqueue_style( 'bootstrap-style' );
	wp_enqueue_style( 'mailchimp' );
	wp_enqueue_style( 'slick' );
	wp_enqueue_style( 'slick-theme' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'mobile-style' );
	wp_enqueue_style( 'main' );
    wp_enqueue_style( 'main-mobile' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap-script' );
	wp_enqueue_script( 'hiro-player-init' );
	wp_enqueue_script( 'hiro-player' );
	wp_enqueue_script( 'slick-script' );
	wp_enqueue_script( 'slick-slider' );
	wp_enqueue_script( 'instafeed' );
	wp_enqueue_script( 'main' );
}

add_action( 'wp_enqueue_scripts', 'mothernist_scripts_with_jquery' );

//************************************************//
// -> START registering custom post types
//************************************************//
add_theme_support( 'post-thumbnails' ); 

add_action('init', 'article_register');
add_action('init', 'video_register');
add_action('init', 'tv_series_register');
add_action('init', 'video_course_register');
add_action('init', 'didyouknow_register');
add_action('init', 'contributor_register');
add_action('init', 'partner_register');
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
        'rewrite' => array('slug' => 'articles','permastruct' => '/%category%/%postname%/'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 4,
        'taxonomies' => array('category', 'post_tag'),
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
		// 'cptp_permalink_structure' => '/%category%/%postname%/'
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
        'rewrite' => array('slug' => 'videos','permastruct' => '/%category%/%postname%/'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'taxonomies' => array('category', 'post_tag') ,
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
		// 'cptp_permalink_structure' => '/%category%/%postname%/'
	);

    register_post_type( 'videos' , $args );
    flush_rewrite_rules();
    register_taxonomy_for_object_type( 'category', 'videos' );
}

function video_course_register() {
 
    $labels = array(
        'name' => _x('Video Courses', 'post type general name'),
        'singular_name' => _x('Video Course', 'post type singular name'),
        'add_new' => _x('Add New', 'Video Course'),
        'add_new_item' => __('Add New Video Course'),
        'edit_item' => __('Edit Video Course'),
        'new_item' => __('New Video Course'),
        'view_item' => __('View Video Course'),
        'search_items' => __('Search Video Course'),
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
        'menu_icon' => 'dashicons-media-interactive',
        'rewrite' => array('slug' => 'video-courses','permastruct' => '/%category%/%postname%/'),
        'capability_type' => 'post',
        'hierarchical' => true,
        'taxonomies' => array('category', 'post_tag') ,
        'menu_position' => 6,
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
        // 'cptp_permalink_structure' => '/%category%/%postname%/'
    );

    register_post_type( 'video-courses' , $args );
    flush_rewrite_rules();
    register_taxonomy_for_object_type( 'category', 'video-courses' );
}

function tv_series_register() {
 
    $labels = array(
        'name' => _x('TV Series', 'post type general name'),
        'singular_name' => _x('TV Series', 'post type singular name'),
        'add_new' => _x('Add New', 'TV Series'),
        'add_new_item' => __('Add New TV Series'),
        'edit_item' => __('Edit TV Series'),
        'new_item' => __('New TV Series'),
        'view_item' => __('View TV Series'),
        'search_items' => __('Search TV Series'),
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
        'menu_icon' => 'dashicons-format-video',
        'rewrite' => array('slug' => 'tv-series','permastruct' => '/%postname%/'),
        'capability_type' => 'post',
        'hierarchical' => true,
        'taxonomies' => array('category', 'post_tag') ,
        'menu_position' => 7,
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
        // 'cptp_permalink_structure' => '/%postname%/'
    );

    register_post_type( 'tv-series' , $args );
    flush_rewrite_rules();
    register_taxonomy_for_object_type( 'category', 'tv-series' );
}

function didyouknow_register() {
 
    $labels = array(
        'name' => _x('Did You Know', 'post type general name'),
        'singular_name' => _x('Did You Know', 'post type singular name'),
        'add_new' => _x('Add New', 'Did You Know'),
        'add_new_item' => __('Add New Did You Know'),
        'edit_item' => __('Edit Did You Know'),
        'new_item' => __('New Did You Know'),
        'view_item' => __('View Did You Know'),
        'search_items' => __('Search Did You Know'),
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
        'menu_icon' => 'dashicons-editor-help',
        'rewrite' => array('slug' => 'did-you-know','permastruct' => '/%postname%/'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'taxonomies' => array('category', 'post_tag') ,
        'menu_position' => 8,
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
        // 'cptp_permalink_structure' => '/%postname%/'
    );

    register_post_type( 'did-you-know' , $args );
    flush_rewrite_rules();
    register_taxonomy_for_object_type( 'category', 'did-you-know' );
}

function contributor_register() {
 
    $labels = array(
        'name' => _x('Contributors', 'post type general name'),
        'singular_name' => _x('Contributor', 'post type singular name'),
        'add_new' => _x('Add New', 'Contributor'),
        'add_new_item' => __('Add New Contributor'),
        'edit_item' => __('Edit Contributor'),
        'new_item' => __('New Contributor'),
        'view_item' => __('View Contributor'),
        'search_items' => __('Search Contributor'),
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
        'menu_icon' => 'dashicons-groups',
        'rewrite' => array('slug' => 'contributors','permastruct' => '/%postname%/'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 9,
        'has_archive' => true,
        'taxonomies' => array('category', 'post_tag') ,
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
        // 'cptp_permalink_structure' => '/%postname%/'
    );
    
    register_post_type( 'contributors' , $args );
    flush_rewrite_rules();
    register_taxonomy_for_object_type( 'category', 'contributors' );
}

function partner_register() {
 
    $labels = array(
        'name' => _x('Partners', 'post type general name'),
        'singular_name' => _x('Partner', 'post type singular name'),
        'add_new' => _x('Add New', 'Partner'),
        'add_new_item' => __('Add New Partner'),
        'edit_item' => __('Edit Partner'),
        'new_item' => __('New Partner'),
        'view_item' => __('View Partner'),
        'search_items' => __('Search Partner'),
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
        'menu_icon' => 'dashicons-businessman',
        'rewrite' => array('slug' => 'partners','permastruct' => '/%postname%/'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 10,
        'has_archive' => true,
        'taxonomies' => array('category', 'post_tag') ,
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
        // 'cptp_permalink_structure' => '/%postname%/'
    );
    
    register_post_type( 'partners' , $args );
    flush_rewrite_rules();
    register_taxonomy_for_object_type( 'category', 'partners' );
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
        'rewrite' => array('slug' => 'events','permastruct' => '/%postname%/'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 11,
        'has_archive' => true,
        'taxonomies' => array('category', 'post_tag') ,
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
		// 'cptp_permalink_structure' => '/%category%/%postname%/'
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
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>'
		)
	);

    register_sidebar( array(
        'name' => __( 'Event Header'),
        'id' => 'event-header',
        'description' => __( 'Event image for event page' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ) );
}


function register_footer_menu() {
  register_nav_menus(
    array(
      'new-menu' => __( 'Footer Menu' )
    )
  );
}

add_action( 'init', 'register_footer_menu' );

//************************************************//
// -> START custom widgets
//************************************************//
class Slick_Slider_Widget extends WP_Widget
{
    private $post_types = array();
    function __construct() {
        parent::WP_Widget(false, $name = 'Slick Slider');
    }
    
    function form($instance) {
        $title = esc_attr($instance['title']);
        $type = esc_attr($instance['post_type']);
        $num = (int)esc_attr($instance['num']);
        $this->post_types = get_post_types(array(
            '_builtin' => false,
        ) , 'names', 'or');
        $this->post_types['post'] = 'post';
        $this->post_types['page'] = 'page';
        ksort($this->post_types);
        echo "<p>";
        echo "<label for=\"" . $this->get_field_id('title') . "\">";
        echo _e('Title:');
        echo "</label>";
        echo "<input class=\"widefat\" id=\"" . $this->get_field_id('title') . "\" name=\"" . $this->get_field_name('title') . "\" type=\"text\" value=\"" . $title . "\" />";
        echo "</p>";
        echo "<p>";
        echo "<label for=\"" . $this->get_field_id('post_type') . "\">";
        echo _e('Post Type:');
        echo "</label>";
        echo "<select name = \"" . $this->get_field_name('post_type') . "\" id=\"" . $this->get_field_id('title') . "\" >";
        foreach ($this->post_types as $key => $post_type) {
            echo '<option value="' . $key . '"' . ($key == $type ? " selected" : "") . '>' . $key . "</option>";
        }
        
        echo "</select>";
        echo "</p>";
        echo "<p>";
        echo "<label for=\"" . $this->get_field_id('num') . "\">";
        echo _e('Number To show:');
        
        echo "</label>";
        echo "<input id = \"" . $this->get_field_id('num') . "\" class = \"widefat\" name = \"" . $this->get_field_name('num') . "\" type=\"text\" value =\"" . $num . "\" / >";
        echo "</p>";
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['num'] = (int)strip_tags($new_instance['num']);
        $instance['post_type'] = strip_tags($new_instance['post_type']);
        if ($instance['num'] < 1) {
            $instance['num'] = 10;
        }
        return $instance;
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        wp_reset_query();
        wp_reset_postdata();
        global $wp_query;
        $old_query = $wp_query;
        $custom_query = new WP_Query(array(
            'post_type' => $instance['post_type'],
            'showposts' => $instance['num']
            // 'featured' => 'yes',
            // 'paged' => 1
        ));

        if ($instance['post_type'] == 'partners')
        {
            echo '<div class="row">';
        }
        else
        {
            echo '<div class="widget-slider">';
        }

        while ($custom_query->have_posts()) {
            $custom_query->the_post();

            //my custom overrides
           

            if ($instance['post_type'] == 'partners')
            {
                echo '<div class="col-xs-4">';
                $partnerUrl =  types_render_field("partner-website", array("output"=>"raw")); 
                echo '<a href="'.$partnerUrl.'" target="_blank">';
                if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                  the_post_thumbnail(array(300, 300), array('class' => 'img-responsive'));
                } 
                echo '</a>';
                echo '</div>';
            }
            else
            {
                echo '<div class="widget-slider-content">';
                echo '<a href="'.get_the_permalink() .'">';
                if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                  the_post_thumbnail(array(300, 300), array('class' => 'img-responsive'));
                } 
                echo '</a>';
                echo '<h2 class="contributor-title text-uppercase"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
                echo '</div>';
            }

            

            // echo "<li><a href=\"" . get_permalink() . "\">";
            // echo get_the_title();
            // echo "</a>";
            // echo "</li>";
        }
        
        echo '</div>';

        wp_reset_query();
        wp_reset_postdata();
        $wp_query = $old_query;
        echo $after_widget;
        // outputs the content of the widget
    }
}

// Register and load the widget
function mothernist_load_widget() {
    register_widget( 'Slick_Slider_Widget' );
}

add_action( 'widgets_init', 'mothernist_load_widget' );

//************************************************//
// -> START general functionalities
//************************************************//

function is_subcategory (){
    $cat = get_query_var('cat');
    $category = get_category($cat);
    $category->parent;
    return ( $category->parent == '0' ) ? false : true;
}

function custom_link_overlay() {
    $post_type = get_post_type( get_the_ID());
    $html = '<div class="overlay img-responsive">';

    if ($post_type == 'videos' || $post_type == 'tv-series')
    {
        $html .= '<label class="overlay-text">Watch Video</label>';
    }
    else if ($post_type == 'articles')
    {
        $html .= '<label class="overlay-text">Read Article</label>';
    }
    else if ($post_type == 'video-courses')
    {
        $html .= '<label class="overlay-text">Take Course</label>';
    }
    else if ($post_type == 'contributors')
    {
        $html .= '<label class="overlay-text">Read More</label>';
    }
    else
    {
        $html .= '<label class="overlay-text">&nbsp;</label>';
    }

    $html .= '</div>';

    return $html;
}


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

function get_theme_logo_footer() {
    global $mothernist_config; 
    $footer_logo = "";

    if (isset($mothernist_config['opt-logo-footer']['url']))
      $footer_logo = $mothernist_config['opt-logo-footer']['url'];

    return $footer_logo;
}

function get_footer_copyright() {
    global $mothernist_config; 

    $copyright = "";

    if (isset($mothernist_config['opt-footer-left']))
      $copyright = $mothernist_config['opt-footer-left'];

    return $copyright;

}

function get_social_link() {
    global $mothernist_config; 

    $social_menu = "<ul class='footer-nav social-nav'>";

    if ($mothernist_config['opt-facebook']!= ''){
        $social_menu .="<li class='social-link'><a href='". $mothernist_config['opt-facebook']. "' target='_blank'><i class='fa fa-2x fa-facebook'></i></a></li>";
    }
    
    if ($mothernist_config['opt-twitter']!= '') {
        $social_menu .="<li class='social-link'><a href='". $mothernist_config['opt-twitter'].  "' target='_blank'><i class='fa fa-2x fa-twitter'></i></a></li>";
    }
    
    if ($mothernist_config['opt-pinterest'] != '') {
        $social_menu .="<li class='social-link'><a href='". $mothernist_config['opt-pinterest'].  "' target='_blank'><i class='fa fa-2x fa-pinterest'></i></a></li>";
    }
    
    if ($mothernist_config['opt-instagram'] != '') {
        $social_menu .="<li class='social-link'><a href='". $mothernist_config['opt-instagram'].  "' target='_blank'><i class='fa fa-2x fa-instagram'></i></a></li>";
    }
    
    if ($mothernist_config['opt-googleplus'] != '') {
        $social_menu .="<li class='social-link'><a href='". $mothernist_config['opt-googleplus'].  "' target='_blank'><i class='fa fa-2x fa-google-plus'></i></a></li>";
    }

    $social_menu .= '</ul>';

    return $social_menu;

}

function mothernist_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
	}

	return $title;
}



//************************************************//
// -> START custom filter
//************************************************//

add_filter( 'wp_title', 'mothernist_wp_title', 10, 2 );

function baw_hack_wp_title_for_home( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return $site_title." | ".$mothernist_config['opt-subtitle'];
  }
  return $title;
}

add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );


function wptp_add_categories_to_attachments() {
      register_taxonomy_for_object_type( 'category', 'attachment' );  
}  

add_action( 'init' , 'wptp_add_categories_to_attachments' ); 


function my_query_post_type($query) {
    if ( is_category() &&  $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'video', 'attachment','videos','articles','tv-series','video-courses') );
    return $query;
}
add_filter('pre_get_posts', 'my_query_post_type');

function show_all_contributors( $query ) {
    if ( is_post_type_archive( 'contributors' ) ) {
        $query->set( 'posts_per_page', -1 );
    }
}
add_action( 'pre_get_posts', 'show_all_contributors' );


?>
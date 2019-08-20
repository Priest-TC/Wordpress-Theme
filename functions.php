<?php

remove_filter('template_redirect', 'redirect_canonical');

function bootstrapstarter_enqueue_styles() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css' );
    $dependencies = array('bootstrap');
    wp_enqueue_style( 'my-theme-style', get_stylesheet_uri(), $dependencies );
}

function bootstrapstarter_enqueue_scripts() {
    $dependencies = array('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/bootstrap/js/bootstrap.min.js', $dependencies, '3.3.6', true );
}

function bootstrapstarter_wp_setup() {
    add_theme_support( 'title-tag' );
}

function bootstrapstarter_register_menu() {
    register_nav_menu('header-menu', ('Header Menu'));
}

function bootstrapstarter_widgets_init() {

    register_sidebar( array(
        'name'          => 'Footer - Copyright Text',
        'id'            => 'footer_copyright_text',
        'before_widget' => '<div class="footer_copyright_text">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => 'Sidebar - Inset',
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="sidebar-module sidebar-module-inset">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => 'Sidebar - Default',
        'id'            => 'sidebar-2',
        'before_widget' => '<div class="sidebar-module">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
}

/*
* Defines the path to the single folder
*/
// define(SINGLE_PATH, TEMPLATEPATH . '/single');

/*
* Filter the single_template with a custom function
*/
// add_filter('single_template', 'my_single_template');

/*
* Single template function which will choose my template
*/
/** function my_single_template($single) {
	global $wp_query, $post;


	/*
	* Checks for single template by category
	* Check by category slug and ID
	*/
/**	foreach((array)get_the_category() as $cat) :

		if(file_exists(SINGLE_PATH . '/single-cat-' . $cat->slug . '.php'))
		return SINGLE_PATH . '/single-cat-' . $cat->slug . '.php';

		elseif(file_exists(SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php'))
		return SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php' ;

	endforeach;
} */

// custom comments
require_once get_parent_theme_file_path( '/parts/better-comments.php');

function theme_prefix_rewrite_flush() {
	flush_rewrite_rules();
}

function exclude_category($query) {
	if ($query->is_home() ) {
		$query->set('cat', '-14' );
	}
	return $query;
}

function my_wp_nav_menu_args( $args = '') {
	if( !is_user_logged_in() ) {
		$args['menu'] = 'logged-in';
	}
	else {
		$args['menu'] = 'logged-out';
	}
	return $args;
}

function set_content_width( $args = '' ) {
	if( ! isset( $content_width ) )
		$content_width = 640;
}

function enqueue_comments_reply() {
	if( get_option('thread_comments') ) {
		wp_enqueue_script('comment-reply');
	}
}

function mytheme_add_editor_styles() {
	add_editor_style ( 'custom-editor-style.css' );
}

add_action( 'widgets_init', 'bootstrapstarter_widgets_init' );
add_action( 'after_setup_theme', 'bootstrapstarter_wp_setup' );
add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_scripts' );
add_action( 'init', 'bootstrapstarter_register_menu' );
add_action( 'after_switch_theme', 'theme_prefix_rewrite_flush' );
add_action( 'template_redirect', 'set_content_width' );
add_action( 'comment_form_before', 'enqueue_comments_reply' );
add_action( 'admin_init', 'mytheme_add_editor_styles' );

add_filter( 'pre_get_posts', 'exclude_category' );
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
?>

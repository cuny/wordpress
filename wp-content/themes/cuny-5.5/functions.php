<?php

// Register Navigation Placeholders
register_nav_menu( 'sidenav', 'Side Navigation' );

// Register sidebars used within posts, archives, etc
register_sidebar( array(
	'name' => 'Breadcrumb Bar',
	'id' => 'cuny_breadcrumb_bar',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' )
);
register_sidebar( array(
	'name' => 'Left Sidebar',
	'id' => 'cuny_left_sidebar',
  'class'         => 'sidebar',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' )
);
register_sidebar( array(
	'name' => 'Right Sidebar',
	'id' => 'cuny_right_sidebar',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' )
);

// Enqueue styles
function cuny_enqueue_styles_and_scripts(){
	if (!wp_style_is( 'js_composer_front', 'enqueued') ) {
	  wp_enqueue_style( 'js_composer_front', plugins_url( 'js_composer/assets/css/js_composer_front.css' ), array(), null );
	}
	wp_enqueue_style( 'cuny55_style', get_stylesheet_uri(), array( 'js_composer_front' ), null );

  wp_enqueue_script( 'cuny55_script', get_template_directory_uri() . '/js/functions.js', array('jquery', 'jquery-ui-core', 'jquery-effects-core', 'wpb_composer_front_js'), null, true );

	if ( function_exists( 'get_field' ) && !empty( $GLOBALS[ 'post' ] ) ) {
		$custom = get_field( 'page_custom_css', $GLOBALS[ 'post' ]->ID );
		if ( !empty( $custom ) ) {
			wp_enqueue_style( 'cuny55_custom_style', '/wp-content/custom'.$custom, array( 'cuny55_style' ), null );
		}
		$custom = get_field( 'page_custom_js', $GLOBALS[ 'post' ]->ID );
		if ( !empty( $custom ) ) {
			wp_enqueue_script( 'cuny55_custom_js', '/wp-content/custom'.$custom, 'cuny55_script', null, true );
		}
		$custom = get_field( 'page_libraries', $GLOBALS[ 'post' ]->ID );
		if ( !empty( $custom ) && is_array( $custom ) ) {
			foreach ( $custom as $a_library ) {
				switch ( $a_library ) {
					case 'nacho-lightbox':
						wp_enqueue_script('ts-extend-hammer');
						wp_enqueue_script('ts-extend-nacho');
						wp_enqueue_style('ts-extend-nacho');
						break;

					default:
						break;
				}
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'cuny_enqueue_styles_and_scripts' );

function cuny_http_request_local_rss_fix( $args ) {
	$args['reject_unsafe_urls'] = false;
	return $args;
}
add_filter( 'http_request_args', 'cuny_http_request_local_rss_fix' );

// Grid System - Image Sizes
// Horizontal
add_image_size( 'horizontal-9', 891, 567, true );
add_image_size( 'horizontal-8', 788, 501, true );
add_image_size( 'horizontal-6', 582, 370, true );
add_image_size( 'horizontal-4', 376, 239, true );
add_image_size( 'horizontal-3', 273, 174, true );
add_image_size( 'horizontal-2', 170, 108, true );

// Vertical
add_image_size( 'vertical-6', 582, 701, true );
add_image_size( 'vertical-4', 376, 453, true );
add_image_size( 'vertical-3', 273, 328, true );
add_image_size( 'vertical-2', 170, 204, true );
add_image_size( 'vertical-1', 67, 80, true );

// Square
add_image_size( 'square-6', 582, 582, true );
add_image_size( 'square-4', 376, 376, true );
add_image_size( 'square-3', 273, 273, true );
add_image_size( 'square-2', 170, 170, true );
add_image_size( 'square-1', 67, 67, true );

function cuny_custom_image_sizes( $sizes ) {
    return array(
        'horizontal-9' => 'Horizontal 9',
        'horizontal-8' => 'Horizontal 8',
        'horizontal-6' => 'Horizontal 6',
        'horizontal-4' => 'Horizontal 4',
        'horizontal-3' => 'Horizontal 3',
        'horizontal-2' => 'Horizontal 2',
        'vertical-6' => 'Vertical 6',
        'vertical-4' => 'Vertical 4',
        'vertical-3' => 'Vertical 3',
        'vertical-2' => 'Vertical 2',
        'vertical-1' => 'Vertical 1',
        'square-6' => 'Square 6',
        'square-4' => 'Square 4',
        'square-3' => 'Square 3',
        'square-2' => 'Square 2',
        'square-1' => 'Square 1'
    );
}
add_filter( 'image_size_names_choose', 'cuny_custom_image_sizes' );
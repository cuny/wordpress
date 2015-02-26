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

// Safe URL fix
function cuny_http_request_local_rss_fix( $args ) {
	$args['reject_unsafe_urls'] = false;
	return $args;
}
add_filter( 'http_request_args', 'cuny_http_request_local_rss_fix' );

// Add custom image sizes to the media dropdown
function cuny_custom_image_sizes( $sizes ) {
		return array(
			'full' => 'Full Size'
		);
}
add_filter( 'image_size_names_choose', 'cuny_custom_image_sizes' );

// Remove default image sizes
function cuny_remove_built_in_image_sizes( $_sizes ) {
    unset( $_sizes['thumbnail'] );
    unset( $_sizes['medium'] );
    unset( $_sizes['large'] );
     
    return $_sizes;
}
add_filter('intermediate_image_sizes_advanced', 'cuny_remove_built_in_image_sizes');

// Do not allow the upload of images that don't have one of the approved image ratios
function cuny_block_images_upload_wrong_ratio( $file ){
    // Mime type with dimensions, check to exit earlier
    $mimes = array( 'image/jpeg', 'image/png', 'image/gif' );

    if( !in_array( $file['type'], $mimes ) )
        return $file;

    $img = getimagesize( $file['tmp_name'] );
    $minimum = array( 'width' => 67, 'height' => 67 );
    $ratio = round($img[0] / $img[1], 2);

    if ( $img[0] < $minimum['width'] ){
			$file['error'] = "Image too small. Minimum width is {$minimum['width']}px. Uploaded image width is {$img[0]}px";    }
    elseif ( $img[1] < $minimum['height'] ){
			$file['error'] = "Image too small. Minimum height is {$minimum['height']}px. Uploaded image height is {$img[1]}px";
  	}
    elseif ( !in_array( $ratio, array( 2.71, 1.57, 1, 0.83 ) ) ) {
    	$file['error'] = "Image out of ratio. Allowed ratios are w/h = 2.71 (banner, billboard), 1.57 (horizontal), 1 (square, circle), 0.83 (vertical). Uploaded image ratio is {$ratio}";
    }

    // Grid System - Image Sizes
		// Only generate the sizes associated to the corresponding ratio
    switch ( $ratio ){
    	case 2.71:
				add_image_size( 'banner-full', 1920, 708, true );
				add_image_size( 'banner-12', 1200, 442, true );
				add_image_size( 'banner-9', 891, 329, true );
				add_image_size( 'banner-6', 582, 215, true );
				break;

    	case 1.57:
				// Horizontal
				add_image_size( 'horizontal-9', 891, 567, true );
				add_image_size( 'horizontal-8', 788, 501, true );
				add_image_size( 'horizontal-6', 582, 370, true );
				add_image_size( 'horizontal-4', 376, 239, true );
				add_image_size( 'horizontal-3', 273, 174, true );
				add_image_size( 'horizontal-2', 170, 108, true );
				break;

			case 1:
				// Square
				add_image_size( 'square-6', 582, 582, true );
				add_image_size( 'square-4', 376, 376, true );
				add_image_size( 'square-3', 273, 273, true );
				add_image_size( 'square-2', 170, 170, true );
				add_image_size( 'square-1', 67, 67, true );
				break;

			case 0.83:
				// Vertical
				add_image_size( 'vertical-4', 376, 451, true );
				add_image_size( 'vertical-3', 273, 327, true );
				add_image_size( 'vertical-2', 170, 204, true );
				add_image_size( 'vertical-1', 67, 80, true );
				break;

			default:
				break;
		}

    return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'cuny_block_images_upload_wrong_ratio' ); 

// Remove WordPress' default inline padding on images with captions
function remove_caption_padding( $width ){
	return $width - 10;
}
add_filter( 'img_caption_shortcode_width', 'remove_caption_padding' );

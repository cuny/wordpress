<?php
// Enqueue styles
function cuny_mpt_enqueue_styles(){
    if (!wp_style_is( 'js_composer_front', 'enqueued') ) {
        wp_enqueue_style( 'js_composer_front', plugins_url( 'js_composer/assets/css/js_composer_front.css' ), array(), null );
    }
    wp_enqueue_style( 'cuny_style', get_stylesheet_uri(), array('js_composer_front'), null );
    wp_enqueue_script( 'cuny_script', get_template_directory_uri() . '/js/functions.js', array('jquery', 'jquery-ui-core', 'jquery-effects-core', 'wpb_composer_front_js'), null, true );

    // Custom Inline CSS - Defined in the Theme Settings
    $cuny_mpt_theme_settings = get_option( 'cuny_mpt_settings' );
    if ( !empty( $cuny_mpt_theme_settings['custom_css'] ) ) {
        wp_add_inline_style( 'cuny_style', $cuny_mpt_theme_settings['custom_css'] );
    }
}
add_action( 'wp_enqueue_scripts', 'cuny_mpt_enqueue_styles' );

// Enqueue HTML5 Shiv for IE7 and IE8
add_action( 'wp_print_scripts', create_function( '',
   'echo \'<!--[if lt IE 9]><script src="\'.get_template_directory_uri().\'/js/html5shiv-printshiv.js"></script><![endif]-->\'."\n";'
) );

// Sidebars
function cuny_mpt_register_sidebars(){
    register_sidebar( array(
        'name' => 'Top Band',
        'id' => 'top-sidebar',
        'description' => 'Widgets in this area will be shown in the top bar',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ) );
    register_sidebar( array(
        'name' => 'Header',
        'id' => 'header-sidebar',
        'description' => 'Widgets in this area will be shown in the brand bar.',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ) );
    register_sidebar( array(
        'name' => __( 'Post Left' ),
        'id' => 'left-sidebar',
        'description' => __( 'Widgets in this area will be shown in the left-hand side of single posts.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Post Right' ),
        'id' => 'right-sidebar',
        'description' => __( 'Widgets in this area will be shown in the right-hand side of single posts.' ),
        'before_widget' => '<aside id="%1$s" class="wpb_content_element widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ) );
    register_sidebar( array(
        'name' => 'Footer Area 1',
        'id' => 'footer-sidebar-1',
        'description' => 'Appears in the footer widget area (top)',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '',
        'after_title' => '',
    ) );
    register_sidebar( array(
        'name' => 'Footer Area 2',
        'id' => 'footer-sidebar-2',
        'description' => 'Appears in the footer widget area (bottom)',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '',
        'after_title' => '',
    ) );
    register_sidebar( array(
        'name' => 'Footer Area 3',
        'id' => 'footer-sidebar-3',
        'description' => 'Appears in the footer widget area (basement)',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '',
        'after_title' => '',
    ) );
}
add_action( 'widgets_init', 'cuny_mpt_register_sidebars' );

// Navigation Placeholders
function cuny_mpt_register_nav(){
    register_nav_menu( 'mainnav', 'Main Nav' );
    register_nav_menu( 'socialmedia', 'Social Media Links' );
    register_nav_menu( 'footertoplinks', 'Footer Top Links' );
    register_nav_menu( 'footerbottomlinks', 'Footer Bottom Links' );
}
add_action( 'after_setup_theme', 'cuny_mpt_register_nav' );

// Inject "News" page in breadcrumbs
function cuny_filter_breadcrumbs( $items, $args ){
    $cuny_mpt_theme_settings = get_option( 'cuny_mpt_settings' );

    if ( empty( $cuny_mpt_theme_settings['news_page_id'] ) ) {
        return $items;
    }

    if ( is_single() || is_archive() ) {
        $news_page_obj = get_post( $cuny_mpt_theme_settings['news_page_id'] );
        $news_page_link = '<a href="'.get_permalink($cuny_mpt_theme_settings['news_page_id']).'">'.$news_page_obj->post_title.'</a>';

        array_splice( $items, 1, 0, array( $news_page_link ) );
    }

    $new_items = array();
    foreach ( $items as $a_item ) {
        $item_no_tags = strip_tags( $a_item );
        if ( !empty( $item_no_tags ) ) {
            $new_items[] = $a_item;
        }
    }
    return $new_items;
}
add_filter('breadcrumb_trail_items', 'cuny_filter_breadcrumbs', 10, 2);

// Exclude post category from list
function cuny_exclude_widget_category( $cat_args ) {
    $cuny_mpt_theme_settings = get_option( 'cuny_mpt_settings' );
    $categories_to_hide = explode( ',', $cuny_mpt_theme_settings['categories_to_hide'] );

    if ( !empty( $categories_to_hide ) && !empty( $categories_to_hide[0] ) ) {
        $cat_args['exclude'] = array();
        foreach ( $categories_to_hide as $a_category_slug ) {
            $cat_obj = get_category_by_slug( trim( $a_category_slug ) );
            $cat_args['exclude'][] = $cat_obj->term_id;
        }
    }
    return $cat_args;
}
add_filter( 'widget_categories_args', 'cuny_exclude_widget_category' );

// Grid System - Image Sizes
// Horizontal
function cuny_mpt_image_sizes(){
    add_image_size( 'horizontal-10', 994, 633, true );
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
}
add_action( 'after_setup_theme', 'cuny_mpt_image_sizes' );

function cuny_custom_image_sizes( $sizes ) {
    return array(
        'horizontal-9' => 'Horizontal 10',
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

// Theme Settings
class cuny_mpt_theme_settings{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private static $settings;

    /**
     * Start up
     */
    public static function init() {
        add_action( 'admin_menu', array( __CLASS__, 'add_settings_page' ) );
        add_action( 'admin_init', array( __CLASS__, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public static function add_settings_page() {
        // This page will be under "Settings"
        add_theme_page(
            'MPT Settings', 
            'MPT Settings', 
            'manage_options', 
            'cuny-mpt-settings', 
            array( __CLASS__, 'create_settings_page' )
        );
    }

    /**
     * Options page callback
     */
    public static function create_settings_page() {
        // Set class property
        self::$settings = get_option( 'cuny_mpt_settings' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>CUNY MPT - Multipurpose Theme for WordPress</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'cuny_mpt_settings' );   
                do_settings_sections( 'cuny-mpt-settings' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public static function page_init() {        
        register_setting(
            'cuny_mpt_settings',
            'cuny_mpt_settings'
        );

        // Layout
        add_settings_section(
            'cuny_mpt_layout_settings', // ID
            'Layout', // Title
            '', // Callback
            'cuny-mpt-settings' // Page
        );

        add_settings_field(
            'logo_url',
            'Logo URL',
            array( __CLASS__, 'textfield_value_callback' ),
            'cuny-mpt-settings',
            'cuny_mpt_layout_settings',
            'logo_url'
        );

        add_settings_field(
            'custom_css',
            'Custom CSS',
            array( __CLASS__, 'textarea_value_callback' ),
            'cuny-mpt-settings',
            'cuny_mpt_layout_settings',
            'custom_css'
        );

        // News
        add_settings_section(
            'cuny_mpt_news_settings',
            'News page, widget and breadcrumbs',
            '',
            'cuny-mpt-settings'
        );  

        add_settings_field(
            'news_page_id',
            'News Page ID',
            array( __CLASS__, 'textfield_value_callback' ),
            'cuny-mpt-settings',
            'cuny_mpt_news_settings',
            'news_page_id'
        );      

        add_settings_field(
            'categories_to_hide', 
            'Categories To Hide', 
            array( __CLASS__, 'textfield_value_callback' ), 
            'cuny-mpt-settings', 
            'cuny_mpt_news_settings',
            'categories_to_hide'
        );

        // Miscellaneous
        add_settings_section(
            'cuny_mpt_misc_settings',
            'Miscellaneous',
            '',
            'cuny-mpt-settings'
        );  

        add_settings_field(
            'google_analytics',
            'Google Analytics Code',
            array( __CLASS__, 'textarea_value_callback' ),
            'cuny-mpt-settings',
            'cuny_mpt_misc_settings',
            'google_analytics'
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public static function textfield_value_callback( $label ) {
        printf(
            '<input type="text" id="%s" name="cuny_mpt_settings[%s]" value="%s" size="50" />',
            $label, $label, isset( self::$settings[$label] ) ? esc_attr( self::$settings[$label]) : ''
        );
    }

    public static function textarea_value_callback( $label ) {
        printf(
            '<textarea id="%s" name="cuny_mpt_settings[%s]" cols="100" rows="10" />%s</textarea>',
            $label, $label, isset( self::$settings[$label] ) ? esc_attr( self::$settings[$label]) : ''
        );
    }
}
if ( is_admin() ){
    add_action( 'init', array( 'cuny_mpt_theme_settings', 'init' ) );
}







// TO BE CLEANED UP
// first let's get our social media nav menu using the regular wp_nav_menu() function with special parameters
function cuny_socialmenu(){
    $socialmenu = wp_nav_menu( array('menu' => 'Social Media Nav',
    'container' => false, // this is usually a div outside the menu ul, we don't need it
    'items_wrap' => '<nav id="%1$s" class="social-media-menu">%3$s</nav>', // replacing the ul with nav
    'echo' => false, // don't display it just yet
    ) );
     
    // now we're ready to display, but when we do we'll replace the li elements with is
    $socialmenu = str_replace( '<li', '<i',$socialmenu);
    echo str_replace('</li', '</i',$socialmenu);
}

//Remove WordPress's default padding on images with captions
//@param int $width Default WP .wp-caption width (image width + 10px)
//@return int Updated width to remove 10px padding
function remove_caption_padding( $width ) {
return $width - 10;
}
add_filter( 'img_caption_shortcode_width', 'remove_caption_padding' );


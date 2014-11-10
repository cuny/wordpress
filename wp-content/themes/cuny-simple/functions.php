<?php
// Enqueue styles
function cuny_enqueue_styles(){
    if (!wp_style_is( 'js_composer_front', 'enqueued') ) {
        wp_enqueue_style( 'js_composer_front', plugins_url( 'js_composer/assets/css/js_composer_front.css' ), array(), null );
    }
    wp_enqueue_style( 'cuny_style', get_stylesheet_uri(), array('js_composer_front'), null );
    wp_enqueue_script( 'cuny_script', get_template_directory_uri() . '/js/functions.js', array('jquery', 'jquery-ui-core', 'jquery-effects-core', 'wpb_composer_front_js'), null, true );
}
add_action( 'wp_enqueue_scripts', 'cuny_enqueue_styles' );

// Enqueue HTML5 Shiv for IE7 and IE8
add_action( 'wp_print_scripts', create_function( '',
   'echo \'<!--[if lt IE 9]><script src="\'.get_template_directory_uri().\'/js/html5shiv-printshiv.js"></script><![endif]-->\'."\n";'
) );


// Sidebars
register_sidebar( array(
    'name' => 'Header Sidebar',
    'id' => 'header-sidebar',
    'description' => 'Appears in the header widget area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
) );
register_sidebar( array(
    'name' => __( 'Right Sidebar' ),
    'id' => 'right-sidebar',
    'description' => __( 'Widgets in this area will be shown on the right-hand side.' ),
    'before_widget' => '<div id="%1$s" class="wpb_content_element widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => '</h2>',
) );
register_sidebar( array(
    'name'         => __( 'Left Sidebar' ),
    'id'           => 'left-sidebar',
    'description'  => __( 'Widgets in this area will be shown on the leftt-hand side.' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="widgettitle">',
    'after_title'  => '</h2>',
) );
register_sidebar( array(
    'name' => 'Footer Sidebar',
    'id' => 'footer-sidebar',
    'description' => 'Appears in the footer widget area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s vc_col-sm-3 wpb_column">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="footer-title">',
    'after_title' => '</h3>',
) );

// Main Navigation
register_nav_menu( 'mainnav', 'Main Nav' );

// Social  Media
register_nav_menu( 'socialmedia', 'Social Media Links' );

//Footer Links 
register_nav_menu( 'footertoplinks', 'Footer Top Links' );
register_nav_menu( 'footerbottomlinks', 'Footer Bottom Links' );

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

// Actions and Filters
function cuny_filter_breadcrumbs( $items, $args ){
    if ( is_single() || is_archive() ) {
        $theme_options = get_option( 'cuny_iss_options' );
        $news_page_obj = get_post( $theme_options['news_page_id'] );
        $news_page_link = '<a href="'.get_permalink($theme_options['news_page_id']).'">'.$news_page_obj->post_title.'</a>';

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

function cuny_exclude_widget_category( $cat_args ) {
    $theme_options = get_option( 'cuny_iss_options' );
    $categories_to_hide = explode( ',', $theme_options['categories_to_hide'] );

    $cat_args['exclude'] = array();
    foreach ( $categories_to_hide as $a_category_slug ) {
        $cat_obj = get_category_by_slug( trim( $a_category_slug ) );
        $cat_args['exclude'][] = $cat_obj->term_id;
    }
    return $cat_args;
}
add_filter( 'widget_categories_args', 'cuny_exclude_widget_category' );

class cuny_iss_theme_settings_admin{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private static $options;

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
            'Theme Settings', 
            'Theme Settings', 
            'manage_options', 
            'cuny-theme-options', 
            array( __CLASS__, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public static function create_admin_page() {
        // Set class property
        self::$options = get_option( 'cuny_iss_options' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>CUNY ISS Theme</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'cuny_iss_theme_options' );   
                do_settings_sections( 'cuny-theme-options' );
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
            'cuny_iss_theme_options',
            'cuny_iss_options'
        );

        add_settings_section(
            'cuny_iss_global_settings', // ID
            'Global Settings', // Title
            '', // Callback
            'cuny-theme-options' // Page
        );

        add_settings_field(
            'logo_url',
            'Logo URL',
            array( __CLASS__, 'value_callback' ),
            'cuny-theme-options',
            'cuny_iss_global_settings',
            'logo_url'
        );

        /* add_settings_field(
            'title', 
            'Title', 
            array( __CLASS__, 'value_callback' ), 
            'cuny-theme-options', 
            'cuny_iss_global_settings',
            'title'
        ); */

        add_settings_section(
            'cuny_iss_news_settings',
            'News Settings',
            '',
            'cuny-theme-options'
        );  

        add_settings_field(
            'news_page_id',
            'News Page ID',
            array( __CLASS__, 'value_callback' ),
            'cuny-theme-options',
            'cuny_iss_news_settings',
            'news_page_id'
        );      

        add_settings_field(
            'categories_to_hide', 
            'Categories To Hide', 
            array( __CLASS__, 'value_callback' ), 
            'cuny-theme-options', 
            'cuny_iss_news_settings',
            'categories_to_hide'
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public static function value_callback( $label ) {
        printf(
            '<input type="text" id="%s" name="cuny_iss_options[%s]" value="%s" size="50" />',
            $label, $label, isset( self::$options[$label] ) ? esc_attr( self::$options[$label]) : ''
        );
    }
}

if( is_admin() ) {
    cuny_iss_theme_settings_admin::init();
}


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


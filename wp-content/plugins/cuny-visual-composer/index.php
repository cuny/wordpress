<?php
/**
 * Plugin Name: CUNY Visual Composer Elements
 * Description: Customize the behavior of Visual Composer
 * Version: 3.3
 * Author: CUNY Office Of Communications and Marketing
 * License: GPL2
 */

// Don't load directly
if (!defined('ABSPATH')) die('-1');

class cuny_contextual_navigation_walker extends Walker_Page {
	function start_el(&$output, $page, $depth = 0, $args = array(), $current_page_id = 0) {
		if ($page->menu_order > 9000) {
			return;
		} 

		parent::start_el($output, $page, $depth, $args, $current_page_id);
	}
}

class cuny_breadcrumbs_widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'cuny_breadcrumbs_widget',
			'CUNY Breadcrumbs',
			array( 'description' => "Defines the breadcrumbs path for a given section of the website." )
		);
	}

	public function widget( $args, $instance ) {
		$breadcrumbs = wp_nav_menu( array( 'menu' => $instance[ 'menu_id' ], 'menu_class' => 'breadcrumbs inline', 'echo' => false ) );
		echo str_replace('</ul>', '<li class="last">'.$instance[ 'page_title' ].'</li></ul>', $breadcrumbs);
	}

	public function form( $instance ) {
		extract( shortcode_atts( array(
		  'menu_id' => 0,
		  'page_title' => get_bloginfo( 'name' )
		), $instance ) );

		$all_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'menu_id' ); ?>"><?php _e( 'Menu' ); ?></label> 
		<select id="<?php echo $this->get_field_id( 'menu_id' ); ?>" name="<?php echo $this->get_field_name( 'menu_id' ); ?>"><?php
			foreach( $all_menus as $a_menu ) {
				$selected = ( $a_menu->term_id == $menu_id ) ? ' selected="selected"' : '';
				echo "<option$selected value='{$a_menu->term_id}'>{$a_menu->name}</option>";
			}
		?></select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'page_title' ); ?>"><?php _e( 'Page Title' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'page_title' ); ?>" name="<?php echo $this->get_field_name( 'page_title' ); ?>" type="text" value="<?php echo esc_attr( $page_title ); ?>">
		</p>
		<p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['menu_id'] = intval( $new_instance['menu_id'] );
		$instance['page_title'] = strip_tags( $new_instance['page_title'] );

		return $instance;
	}
}

class cuny_contextual_menu_widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'cuny_contextual_menu_widget',
			'CUNY Contextual Nav',
			array( 'description' => "List a page's child pages, siblings or ancestors" )
		);
	}

	public function widget( $args, $instance ) {
		echo cuny_visual_composer::contextual_menu_shortcode( $instance, '' );
	}

	public function form( $instance ) {
		extract( shortcode_atts( array(
		  'page_id' => 0,
		  'level' => 1,
		  'depth' => 1,
		  'el_class' => ''
		), $instance ) );

		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Page ID' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'page_id' ); ?>" name="<?php echo $this->get_field_name( 'page_id' ); ?>" type="text" value="<?php echo esc_attr( $page_id ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'level' ); ?>"><?php _e( 'Level' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'level' ); ?>" name="<?php echo $this->get_field_name( 'level' ); ?>" type="text" value="<?php echo esc_attr( $level ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'depth' ); ?>"><?php _e( 'Depth' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'depth' ); ?>" name="<?php echo $this->get_field_name( 'depth' ); ?>" type="text" value="<?php echo esc_attr( $depth ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'el_class' ); ?>"><?php _e( 'Extra Class' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'el_class' ); ?>" name="<?php echo $this->get_field_name( 'el_class' ); ?>" type="text" value="<?php echo esc_attr( $el_class ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['page_id'] = intval( $new_instance['page_id'] );
		$instance['level'] = intval( $new_instance['level'] );
		$instance['depth'] = intval( $new_instance['depth'] );
		$instance['el_class'] = strip_tags( $new_instance['el_class'] );

		return $instance;
	}
}

class cuny_logo_widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'cuny_logo_widget',
			'CUNY Logo'
		);
	}

	public function widget( $args, $instance ) {
		echo cuny_visual_composer::logo_shortcode( $instance, '' );
	}
}

class cuny_media_links_widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'cuny_media_links_widget',
			'CUNY Media Links'
		);
	}

	public function widget( $args, $instance ) {
		echo cuny_visual_composer::media_links_shortcode( $instance, '' );
	}
}

class cuny_reusable_component_widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'cuny_reusable_component_widget',
			'CUNY Reusable Component',
			array( 'description' => "Place a Visual Composer reusable component inside a widget sidebar area" )
		);
	}

	public function widget( $args, $instance ) {
		echo cuny_visual_composer::reusable_component_shortcode( $instance, '' );
	}

	public function form( $instance ) {
		extract( shortcode_atts( array(
		  'post_id' => 0,
		  'el_class' => ''
		), $instance ) );

		$components = get_posts( array( 'posts_per_page' => -1, 'post_type' => 'cuny_reusable_comp') );
		$components_dropdown = '';
		foreach($components as $a_component){
			$is_selected = ($a_component->ID == $post_id)?' selected="selected"':'';
			$components_dropdown .= "<option value='{$a_component->ID}'{$is_selected}>$a_component->post_title</option>";
		}

		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e( 'Component' ); ?></label> 
		<select class="widefat" id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>"><?php echo $components_dropdown; ?></select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'el_class' ); ?>"><?php _e( 'Extra Class' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'el_class' ); ?>" name="<?php echo $this->get_field_name( 'el_class' ); ?>" type="text" value="<?php echo esc_attr( $el_class ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['post_id'] = intval( $new_instance['post_id'] );
		$instance['el_class'] = strip_tags( $new_instance['el_class'] );

		return $instance;
	}
}

class cuny_visual_composer{
  public static function init(){

  	// Display notice if Visual Composer is not installed or activated.
  	if ( !defined('WPB_VC_VERSION') ) { 
  		add_action('admin_notices', array( __CLASS__, 'vc_required_notice' ) );
  		return;
  	}

    add_action( 'init', array( __CLASS__, 'reusable_component_post_type' ) );

    add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_enqueue_scripts_and_styles' ) );
    add_action( 'wp_enqueue_scripts', array( __CLASS__, 'move_visual_composer_styles_to_head' ) );

    // CUNY VC Elements
    add_shortcode( 'cuny_carousel', array( __CLASS__, 'carousel_shortcode' ) );
    add_shortcode( 'cuny_reusable_component', array( __CLASS__, 'reusable_component_shortcode' ) );
    add_shortcode( 'cuny_contextual_menu', array( __CLASS__, 'contextual_menu_shortcode' ) );
		add_shortcode( 'cuny_logo', array( __CLASS__, 'logo_shortcode' ) );
    add_shortcode( 'cuny_media_links', array( __CLASS__, 'media_links_shortcode' ) );
    add_shortcode( 'cuny_post_list', array( __CLASS__, 'post_list_shortcode' ) );
    add_shortcode( 'cuny_page_title', array( __CLASS__, 'page_title_shortcode' ) );
    add_shortcode( 'cuny_section_header', array( __CLASS__, 'section_header_shortcode' ) );

    // Map shortcodes in Visual Composer
    add_action( 'vc_after_mapping', array( __CLASS__, 'shortcode_map' ) );

    // Remove shortcodes from excerpts
    add_filter( 'the_excerpt', array( __CLASS__, 'display_text_box_content_as_excerpt' ), 1 );

    // Register widgets
    add_action( 'widgets_init', array( __CLASS__, 'register_widgets' ) );

    // Set RSS Widget Refresh Rate to 15 minutes
    add_filter( 'wp_feed_cache_transient_lifetime', create_function('$a', 'return 900;') );

    // Avoid autop (affects reusable components)
 		add_action( 'wp', array( __CLASS__, 'remove_autop' ) );

    // Fix a compatibility issue between our Events RSS feed and WP RSS
    add_filter( 'http_request_args', array( __CLASS__, 'http_request_local_rss_fix' ) );

		if ( is_admin() ) {
	    // Remove Rev Slider meta-box from posts and pages
	    add_action( 'do_meta_boxes', array( __CLASS__, 'remove_rev_slider_from_components' ) );
	  }

    // Add the current user's role to the body classes
    if ( is_user_logged_in() ) {
    	add_filter( 'body_class', array( __CLASS__, 'admin_body_class' ) );	
    }
    add_filter( 'admin_body_class', array( __CLASS__, 'admin_body_class' ) );
  }

  public static function vc_required_notice() {
	  $plugin_data = get_plugin_data(__FILE__);
	  echo '
	  <div class="updated">
	    <p>'.sprintf('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> to be installed and activated on your site.', $plugin_data['Name']).'</p>
	  </div>';
	}

	public static function remove_autop() {
		if ( !is_singular() ) {
			return;
		}

		// Remove WordPress' autop function for CPTs that use Visual Composer
		$vc_post_types = vc_manager()->editorPostTypes();
 		if ( in_array( $GLOBALS['post']->post_type, $vc_post_types ) ) {
 			remove_filter('the_content','wpautop');
 		}
	}

  public static function admin_enqueue_scripts_and_styles( $hook ) {
  	wp_register_style( 'cuny_vc_style', plugins_url( 'css/admin-style.css', __FILE__ ), array( 'js_composer' ), null );
  	wp_enqueue_style( 'cuny_vc_style' );

  	if ( $hook == 'post.php' ) {
	  	wp_register_script( 'cuny_vc_script', plugins_url( '/js/admin-functions.js', __FILE__ ), array( 'wpb_js_composer_js_view' ), null, true );
	  	$cuny_vc_params = array(
	  		'disable_sortable' => var_export( !current_user_can( 'delete_pages' ) && !current_user_can( 'cuny_editor_vc' ), true )
	  	);
	  	wp_localize_script( 'cuny_vc_script', 'cuny_vc_params', $cuny_vc_params );
	  	wp_enqueue_script( 'cuny_vc_script' );
	  }
	}

	// Enqueued styles in the HEAD section of the page
	public static function move_visual_composer_styles_to_head(){
	  wp_enqueue_style( 'js_composer_front' );
	  wp_enqueue_style('js_composer_custom_css');

	  // Front-end editor
	  if ( !empty( $_GET['vc_editable'] ) && $_GET['vc_editable'] == 'true' ) {
	  	wp_register_style( 'cuny_vc_front', plugins_url('css/style.css', __FILE__), array( 'js_composer_front' ), null );
	  	wp_enqueue_style( 'cuny_vc_front' );
	  }
  	
	}

	// [cuny_carousel cuny_title="" ]
	public static function carousel_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
		  'header' => '',
			'header_link' => '',
			'items' => '3',
			'autoplay' => '5000'
		), $atts ) );

		wp_enqueue_style( 'cuny_carousel', plugins_url( 'css/slick/cuny-slick.css', __FILE__ ), array(), null );
		wp_enqueue_script( 'cuny_carousel', plugins_url( 'js/slick/slick.min.js', __FILE__ ), array( 'jquery' ), null, true );
		wp_enqueue_script( 'cuny_vc_script', plugins_url( 'js/functions.js', __FILE__ ), array( 'cuny_carousel' ), null, true );

		$converted_content = do_shortcode( $content );

		// Remove empty DIVs, if needed
		$converted_content = str_replace( '<div class="vc_row-full-width"></div>', '', $converted_content );

		if ( !empty( $header_link ) ) {
			$header = "<a href='{$header_link}'>{$header}</a>";
		}

		$output .= '
		<div class="cuny-carousel-container">
			<h1>'.$header.'</h1>

			<div class="cuny-carousel cuny-carousel-items-'.$items.'"
				data-autoplay="' . esc_attr( empty( $autoplay ) || $autoplay == '0' ? 'false' : $autoplay ) . '"
				data-items="' . esc_attr( $items ) . '">'.$converted_content.' 
			</div>
		</div>';

		return $output;
	}

	// [cuny_contextual_menu level="1" depth="1" el_class="class_name"]
	public static function contextual_menu_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
		  'page_id' => $GLOBALS['post']->ID,
		  'level' => 1,
		  'depth' => 1,
		  'el_class' => ''
		), $atts ) );

		$output = '';
		$cuny_contextual_navigation_walker = new cuny_contextual_navigation_walker;
		if ($level == 1) {
			$output = wp_list_pages( array( 'child_of' => $page_id, 'title_li' => '', 'echo' => false, 'depth' => abs( $depth ) + 1, 'walker' => $cuny_contextual_navigation_walker ) );
		}
		else{
			$ancestors = get_ancestors( $page_id, 'page' );
			if (!empty($ancestors)) {
				$output = wp_list_pages( array( 'child_of' => $ancestors[abs($level)], 'title_li' => '', 'echo' => false, 'depth' => abs( $depth ) + 1, 'walker' => $cuny_contextual_navigation_walker ) );
			}
			else{ // Top Level Pages
				$output = wp_list_pages( array( 'child_of' => 0, 'title_li' => '', 'echo' => false, 'depth' => abs( $depth ) + 1, 'walker' => $cuny_contextual_navigation_walker ) );
			}
		}

		$el_class = !empty($el_class)?" $el_class":'';
		if (!empty($output)) {
			$output = "<ul class='navigation$el_class'>$output</ul>";
		}
		return $output;
	}

	// [cuny_logo]
	public static function logo_shortcode( $atts, $content = null ) {
		return '
			<h1 id="logo">
				<a class="no-bg" href="http://www.cuny.edu/" title="CUNY Home Page">&#59399;</a>
			</h1>';
	}

	// [cuny_media_links]
	public static function media_links_shortcode( $atts, $content = null ) {
		return '
			<ul class="media-links">
				<li><i class="cuny-icon-right"></i> <a href="http://www.youtube.com/user/CUNYMedia" title="Watch CUNY Channel">Watch <span>CUNY CHANNEL</span></a></li>
				<li><i class="cuny-icon-right"></i> <a href="http://www1.cuny.edu/mu/forum/index.php" title="Read CUNY Newswire">Read <span>CUNY NEWSWIRE</span></a></li>
				<li><i class="cuny-icon-right"></i> <a href="http://www.cuny.edu/radio" title="Listen CUNY Radio">Listen <span>CUNY RADIO</span></a></li>
				<li><i class="cuny-icon-right"></i> <a href="http://www.cuny.edu/itunes" title="Inside CUNY Radio">Inside <span>CUNY iTUNES U</span></a></li>
			</ul>';
	}

	// [cuny_page_title ancestor_level="0" el_class="class_name"]
	public static function page_title_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
		  'ancestor_level' => 0,
		  'link_to_page' => 'no',
		  'el_class' => ''
		), $atts ) );

		if ($ancestor_level < 0){
			$ancestors = get_ancestors( $GLOBALS['post']->ID, 'page' );
			if (!empty($ancestors)){
				$page_id = $ancestors[abs($ancestor_level) - 1];
			}
		}
		else{
			$page_id = $GLOBALS['post']->ID;
		}

		$el_class = !empty( $el_class ) ? " $el_class" : '';
		$output = get_the_title( $page_id );

		if ( $link_to_page == 'yes' ) {
			$output = "<a href='".get_permalink($page_id)."'>$output</a>";
		}

		return "<h1 class='section-title$el_class'>$output</h1>";
	}

	// [cuny_post_list ancestor_level="0" el_class="class_name"]
	public static function post_list_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
		  'title' => '',
		  'loop' => '',
		  'grid_columns' => 1,
		  'grid_layout' => '',
		  'el_class' => ''
		), $atts ) );

		if ( empty( $loop ) ) {
			return;
		}

		$output = '';

		if ( is_int( $grid_columns ) ) {
			$grid_columns -= 1;
		}
		$grid_column_classnames = array( 0, 'vc_col-sm-12', 'vc_col-sm-6', 'vc_col-sm-4', 'vc_col-sm-3' );

		list( $loop_args, $query_results ) = vc_build_loop_query( $loop, get_the_ID() );
		$teaser_blocks = vc_sorted_list_parse_value( $grid_layout );

		if ( $query_results->have_posts() ) {
			$output = wpb_widget_title( array( 'title' => $title ) );
			$counter = 1;
			while ( $query_results->have_posts() ) {
				$query_results->the_post();
				$output .= "<li class='{$grid_column_classnames[$grid_columns]}'>";
				foreach ( $teaser_blocks as $a_block ){
					switch ( $a_block[0] ) {
						case 'category':
							$categories = get_the_category();
							$list_categories = array();
							foreach( $categories as $id => $category ) {
								$list_categories[$id] = $category->cat_name;
								if ( !empty($a_block[1][0]) && $a_block[1][0] == 'link_category' ) {
									$list_categories[$id] = '<a class="category-item" href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">' . $list_categories[$id] . '</a>';
								}
							}
							$output .= implode( $list_categories, ', ' );
							break;
						case 'content':
							$content = ( !empty($a_block[1][0]) && $a_block[1][0] == 'full' ) ? str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', get_the_content() ) ) : apply_filters( 'the_excerpt', get_the_excerpt() );
							$output .= '<div class="entry-content">' . wpautop( $content ) . '</div>';
							break;
						case 'date':
							$date_format = ( !empty($a_block[1][0]) && $a_block[1][0] == 'm_d_Y' ) ? 'm-d-Y' : 'F j, Y';
							$output .= '<span class="date">' . get_the_date( $date_format ) . '</span>';
							break;
						case 'image':
							$thumbnail = wpb_getImageBySize( array( 'post_id' => get_the_ID(), 'thumb_size' => 'thumbnail' ) );
							$output .= $thumbnail['thumbnail'];
							break;
						case 'link':
							switch ( $a_block[1][0] ) {
								case 'more_raquo':
									$a_block[1][1] = 'More &raquo;';
									break;
								case 'more':
									$a_block[1][1] = 'More';
									break;
								case 'read_more_raquo':
									$a_block[1][1] = 'Read More &raquo;';
									break;
								case 'read_more':
									$a_block[1][1] = 'Read More';
									break;
								default:
									$a_block[1][1] = '&raquo;';
									break;
							}
							$output .= '<a href="' . get_the_permalink() . '">' . $a_block[1][1] . '</a>';
							break;
						case 'title':
							$post_title = the_title( "", "", false );
							if ( empty( $a_block[1][0] ) || strpos( $a_block[1][0], 'no_link' ) === false ) {
								$post_title = '<a href="' . get_the_permalink() . '">' . $post_title . '</a>';
							}
							if ( strpos( $a_block[1][0], 'plain' ) === false ) {
								$post_title = '<h3>' . $post_title . '</h3>';
							}
							$output .= $post_title;
							break;
						default:
							break;
					}
				}
				$output .= '</li>';

				if ( $grid_columns > 1 && $counter % $grid_columns == 0 ) {
					$output .= "</ul><ul class='wpb_row vc_row-fluid post-list-container$el_class'>";
				}

				$counter++;
			}

			$el_class = !empty($el_class)?" $el_class":'';
			if (!empty($output)){
				$output = "<ul class='wpb_row vc_row-fluid post-list-container$el_class'>$output</ul>";
			}
		}
		wp_reset_query();

		return $output;
	}

	// [cuny_reusable_component post_id="foo-value" el_class="class_name"]
	public static function reusable_component_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
		  'post_id' => '0',
		  'el_class' => ''
		), $atts ) );

		$reusable_component_obj = get_post( $post_id );

		if (!is_object($reusable_component_obj)){
		 return '';
		}

		// Remove the row/column wrappers, if only one is present
		preg_match_all('~\[[/]?(vc_row|vc_column)[\] ][^\[]*~i', $reusable_component_obj->post_content, $matches);

		$count_rows_columns = array_count_values($matches[1]);
		if (!empty($count_rows_columns['vc_row']) && !empty($count_rows_columns['vc_column']) && $count_rows_columns['vc_row'] == 2 && $count_rows_columns['vc_column'] == 2){
			$reusable_component_obj->post_content = preg_replace('~\[[/]?(vc_row|vc_column)[\] ][^\[]*~i', '', $reusable_component_obj->post_content);
		}

		$reusable_component_obj->post_content = apply_filters('the_content', $reusable_component_obj->post_content);
		$reusable_component_obj->post_content = str_replace(']]>', ']]&gt;', $reusable_component_obj->post_content);

		if (!empty($el_class)){
			return "<div class='$el_class'>{$reusable_component_obj->post_content}</div>";
		}

		return $reusable_component_obj->post_content;
	}

	// [cuny_section_header title="section title" follow_url="http://twitter.com/" level="2" icon="rss" el_class="class_name"]
	public static function section_header_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
		  'title' => '',
		  'heading_url' => '',
		  'follow_url' => '',
		  'level' => '2',
		  'icon' => '',
		  'el_class' => ''
		), $atts ) );

		$output = '';

		if (!empty($heading_url)){
			$title = "<a href='$heading_url'>$title</a>";
		}

		$el_class = !empty($el_class)?" $el_class":'';
		if (!empty($title)){
			$output = "<div class='section_header wpb_content_element'><div class='wpb_wrapper'><h$level class='btn$el_class'>$title <a class='follow' href='$follow_url'>Follow <i class='$icon'></i></a></h$level></div></div>";
		}
		return $output;
	}

	public static function shortcode_map(){

		vc_map( array(
		  'name' => 'Carousel',
		  'base' => 'cuny_carousel',
			'icon' => 'icon-wpb-cuny',
			'description' => 'A flexible content carousel system.',
			'as_parent' => array( 'only' => 'vc_row, vc_row_inner' ),
		  'js_view' => 'VcColumnView',
			'content_element' => true,
			'is_container' => true,
			'container_not_allowed' => false,
			'default_content' => '[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]',
	    'params' => array(
				array(
					'type' => 'textfield',
					'heading' => 'Title',
					'param_name' => 'header',
					'value' => '',
				  'description' => 'Header to be displayed above the carousel. Leave empty for no header.',
				),
				array(
					'type' => 'textfield',
					'heading' => 'Link Title to (optional)',
					'param_name' => 'header_link',
					'value' => '',
				  'description' => "Target URL for the header. Leave empty if you don't need to link the header.",
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Items to display',
					'param_name' => 'items',
					'value' => array(2, 3, 4, 6),
				  'description' => 'Max items to display at a time.',
				),
				array(
					'type' => 'textfield',
					'heading' => 'Autoplay',
					'param_name' => 'autoplay',
					'value' => '10000',
					'description' => 'Enter an amount in milliseconds for the carousel to move. Leave blank or set to zero to disable autoplay.',
				)
	    )
		) );

		// Reusable Component Widget
		$components = get_posts( array( 'posts_per_page' => -1, 'post_type' => 'cuny_reusable_comp') );
		$components_dropdown = array();
		foreach($components as $a_component){
			$components_dropdown[$a_component->post_title] = $a_component->ID;
		}
		vc_map( array(
		  'name' => 'Component',
		  'base' => 'cuny_reusable_component',
		  'description' => 'Reuse custom elements (aka Components)',
		  'class' => '',
		  'category' => 'Content',
		  'controls' => 'full',
		  'icon' => 'icon-wpb-cuny',
		  'params' => array(
		    array(
		      'type' => 'dropdown',
		      'holder' => 'div',
		      'heading' => 'Component',
		      'param_name' => 'post_id',
		      'value' => $components_dropdown,
		      'description' => 'Select a component you would like to use',
		      'admin_label' => true
		    ),
		    array(
			    'type' => 'textfield',
			    'heading' => 'Extra class name',
			    'param_name' => 'el_class',
			    'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.'
			  )
		  )
		) );

		// Contextual Navigation Widget
		vc_map( array(
		  'name' => 'Contextual Nav',
		  'base' => 'cuny_contextual_menu',
		  'description' => 'List this page\'s relatives (children & ancestors)',
		  'class' => '',
		  'category' => 'Structure',
		  'controls' => 'full',
		  'icon' => 'icon-wpb-cuny',
		  'params' => array(
		    array(
		      'type' => 'textfield',
		      'holder' => 'div',
		      'heading' => 'Level',
		      'param_name' => 'level',
		      'value' => 1,
		      'description' => 'Specify the navigation level you want to display (0: siblings, 1: child pages, negative value: ancestors at that level).',
		      'admin_label' => true
		    ),
		    array(
		      'type' => 'textfield',
		      'holder' => 'div',
		      'heading' => 'Depth',
		      'param_name' => 'depth',
		      'value' => 1,
		      'description' => 'Indicate the number of descendants you want to display (0: siblings only, no children, 1: siblings and children, etc).',
		      'admin_label' => true
		    ),
		    array(
		      'type' => 'textfield',
		      'holder' => 'div',
		      'heading' => 'Page ID',
		      'param_name' => 'page_id',
		      'value' => !empty( $GLOBALS['post']->ID )?$GLOBALS['post']->ID:'',
		      'description' => 'Optional: enter the ID of the node you want to use as a starting point.',
		      'admin_label' => true
		    ),
		    array(
			    'type' => 'textfield',
			    'heading' => 'Extra class name',
			    'param_name' => 'el_class',
			    'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.'
			  )
		  )
		) );

		// Logo
		vc_map( array(
		  'name' => 'CUNY Logo',
		  'base' => 'cuny_logo',
		  'description' => 'Displays the CUNY Logo (font icon)',
		  'class' => '',
		  'category' => 'Content',
		  'show_settings_on_create' => false,
		  'icon' => 'icon-wpb-cuny'
		) );

		// Media Links
		vc_map( array(
		  'name' => 'Media Links',
		  'base' => 'cuny_media_links',
		  'description' => 'Displays the CUNY Media Links Widget',
		  'class' => '',
		  'category' => 'Content',
		  'show_settings_on_create' => false,
		  'icon' => 'icon-wpb-cuny',
		) );

		// Post List
		vc_map( array(
		  'name' => 'Post List',
		  'base' => 'cuny_post_list',
		  'description' => 'Displays a list of filtered posts',
		  'category' => 'Content',
		  'icon' => 'icon-wpb-cuny',
		  'params' => array(
		    array(
					'type' => 'textfield',
					'heading' => 'Widget title',
					'param_name' => 'title',
					'description' => 'Leave blank if no title is needed.'
				),
		    array(
		      'type' => 'loop',
		      'heading' => 'Criteria',
		      'param_name' => 'loop',
		      'settings' => array(
						'size' => array( 'hidden' => false, 'value' => 10 ),
						'order_by' => array( 'value' => 'date' ),
					)
		    ),
		   	array(
		      'type' => 'dropdown',
		      'holder' => 'div',
		      'heading' => 'Columns',
		      'param_name' => 'grid_columns',
		      'value' => array(1, 2, 3, 4),
		      'description' => 'Number of columns to use',
		      'admin_label' => false
		    ),
		    array(
					'type' => 'sorted_list',
					'heading' => 'Layout',
					'param_name' => 'grid_layout',
					'description' => '',
					'value' => 'title,date,image,excerpt',
					'options' => array(
						array(
							'image',
							'Thumbnail',
							array(
								array( 'link_post', 'Link to post' ),
								array( 'no_link', 'No link' )
							) 
						),
						array(
							'title',
							'Title',
							array(
								array( 'link_post', 'Link to post (H3)' ),
								array( 'link_post_plain', 'Link to post (plain)' ),
								array( 'no_link', 'No link (H3)' ),
								array( 'no_link_plain', 'No link (plain)' )
							)
						),
						array(
							'date',
							'Date',
							array(
								array( 'F_j_Y', 'July 1, 2000' ),
								array( 'm_d_Y', '07-01-2000' )
							)
						),
						array( 
							'category',
							'Categories (Posts Only)',
							array(
								array( 'no_link', 'No link' ),
								array( 'link_category', 'Link to category' )
							)
						),
						array(
							'content',
							'Content',
							array(
								array( 'excerpt', 'Excerpt' ),
								array( 'full', 'Full content' )
							) 
						),
						array(
							'link',
							'Read more link',
							array(
								array( 'raquo', '&raquo;' ),
								array( 'more_raquo', 'More &raquo;' ),
								array( 'more', 'More' ),
								array( 'read_more_raquo', 'Read More &raquo;' ),
								array( 'read_more', 'Read More' )
							) 
						),
					)
				),
				array(
			    "type" => "textfield",
			    "heading" => "Extra class name",
			    "param_name" => "el_class",
			    "description" => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
			  )
		  )
		) );

		// Section Title Widget
		vc_map( array(
		  'name' => 'Section Title',
		  'base' => 'cuny_page_title',
		  'description' => 'Displays this page\'s section title',
		  'class' => '',
		  'category' => 'Content',
		  'controls' => 'full',
		  'icon' => 'icon-wpb-cuny',
		  'params' => array(
		    array(
		      'type' => 'textfield',
		      'holder' => 'div',
		      'heading' => 'Ancestor Level',
		      'param_name' => 'ancestor_level',
		      'value' => -1,
		      'description' => 'Specify the ancestor level you want to use (0: page itself, -1: parent, -2: grandparent, etc).',
		      'admin_label' => true
		    ),
		    array(
		      'type' => 'dropdown',
		      'holder' => 'div',
		      'heading' => 'Link to Page',
		      'param_name' => 'link_to_page',
		      'value' => array('Yes' => 'yes', 'No' => 'no'),
		      'description' => 'Link section title to its target page.',
		      'admin_label' => false
		    ),
		    array(
			    'type' => 'textfield',
			    'heading' => 'Extra class name',
			    'param_name' => 'el_class',
			    'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.'
			  )
		  )
		) );

		// Section Header
		vc_map( array(
		  'name' => 'Sidebar Header',
		  'base' => 'cuny_section_header',
		  'description' => 'Displays a section heading',
		  'class' => '',
		  'category' => 'Content',
		  'controls' => 'full',
		  'icon' => 'icon-wpb-cuny',
		  'params' => array(
		    array(
		      'type' => 'textfield',
		      'holder' => 'div',
		      'heading' => 'Text',
		      'param_name' => 'title',
		      'value' => '',
		      'description' => 'Text to be displayed by the section heading.',
		      'admin_label' => true
		    ),
		    array(
		      'type' => 'textfield',
		      'holder' => 'div',
		      'heading' => 'Heading Link',
		      'param_name' => 'heading_url',
		      'value' => 'http://',
		      'description' => 'Target associated to the heading.',
		      'admin_label' => false
		    ),
		    array(
		      'type' => 'textfield',
		      'holder' => 'div',
		      'heading' => 'Follow Link',
		      'param_name' => 'follow_url',
		      'value' => 'http://',
		      'description' => 'Target associated to the FOLLOW link.',
		      'admin_label' => false
		    ),
		    array(
		      'type' => 'dropdown',
		      'holder' => 'div',
		      'heading' => 'Heading Tag',
		      'param_name' => 'level',
		      'value' => array('H2' => 2, 'H3' => 3, 'H4' => 4, 'H5' => 5),
		      'description' => 'Choose what heading level to use for your section heading.',
		      'admin_label' => true
		    ),
		    array(
		      'type' => 'dropdown',
		      'holder' => 'div',
		      'heading' => 'Follow Icon',
		      'param_name' => 'icon',
		      'value' => array('RSS' => 'cuny-icon-rss', 'Twitter' => 'cuny-icon-twitter', 'Facebook' => 'cuny-icon-facebook'),
		      'description' => 'Select the icon to display next to the FOLLOW link.',
		      'admin_label' => true
		    ),
		    array(
			    'type' => 'textfield',
			    'heading' => 'Extra class name',
			    'param_name' => 'el_class',
			    'description' => 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.'
			  )
		  )
		) );
		
    // Customize some of the built-in shortcodes

		// Separator
		self::remove_vc_element_params( 'vc_separator', array( 'color' ) );
	}

	public function remove_vc_element_params( $_shortcode = '', $_params = array() ){
		$shortcode_data = WPBMap::getShortCode( $_shortcode );
    
    // Loop over the parameters to find the ones we want to remove
    foreach( $shortcode_data['params'] as $a_id => $a_shortcode_param ) {
      foreach ( $_params as $a_value ) {
        // We found our parameter to change
        if( $a_shortcode_param['param_name'] == $a_value ) {
        	unset ( $shortcode_data['params'][$a_id] );
        	break;
        }
      }
    }
    unset( $shortcode_data['base'] ); // VC complains if this is set
		vc_map_update( $_shortcode, $shortcode_data );
	}

	public static function reusable_component_post_type() {
		register_post_type( 'cuny_reusable_comp',
			array(
				'capabilities' 	 => array(
	        'publish_posts' 			=> 'manage_options',
	        'edit_posts' 					=> 'manage_options',
	        'edit_others_posts' 	=> 'manage_options',
	        'delete_posts' 				=> 'manage_options',
	        'delete_others_posts' => 'manage_options',
	        'read_private_posts' 	=> 'manage_options',
	        'edit_post' 					=> 'manage_options',
	        'delete_post' 				=> 'manage_options',
	        'read_post' 					=> 'manage_options',
		    ),
				'labels' 					=> array(
					'name' 					=> 'Components',
					'singular_name' => 'Component',
					'all_items' 		=> 'All Components',
					'add_new_item' 	=> 'Add New Component'
				),
				'public'					=> true,
				'has_archive' 		=> true,
				'supports' 				=> array( 'title', 'editor' )
			)
		);

		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => 'Categories',
			'singular_name'     => 'Category',
			'all_items'         => 'All Categories',
			'parent_item'       => 'Parent Category',
			'parent_item_colon' => 'Parent Category:',
			'edit_item'         => 'Edit Category',
			'update_item'       => 'Update Category',
			'add_new_item'      => 'Add New Category',
			'new_item_name'     => 'New Category Name',
			'menu_name'         => 'Categories',
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => false
		);

		register_taxonomy( 'cuny_rc_tax', array( 'cuny_reusable_comp' ), $args );
	}

	public static function remove_rev_slider_from_components(){
		$all_post_types = get_post_types( array( 'show_in_menu' => true ) );
		foreach ($all_post_types as $a_post_type) {
			remove_meta_box( 'mymetabox_revslider_0', $a_post_type, 'normal' );
			remove_meta_box( 'vc_teaser', 'page', 'side' );
		}
	}

	public static function display_text_box_content_as_excerpt( $content ) {
    if ( !empty( $content ) ) {
    	return $content;
    }
    $content = $GLOBALS[ 'post' ]->post_content;
    preg_match_all('@\[vc_column_text.*?\](.*?)\[/vc_column_text\]@sim', $content, $match);

    if ( count( $match[0] ) == 1 ) {
    	$content = $match[1][0];
    }
    else { // find the one that has the 'use-as-excerpt' class
    	foreach ( $match[0] as $i => $a_match ){
    		if ( strpos( $a_match, 'use-as-excerpt' ) !== false ){
    			$content = $match[1][$i];
    		}
    	}
    }

    $content = wp_trim_words( strip_tags( strip_shortcodes( $content ) ), ' [..]' );

    if (strpos($content, '<p') !== 0){
      $content = "<p>$content</p>";
    }

	  return $content;
	}

	public static function register_widgets() {
		register_widget( 'cuny_breadcrumbs_widget' );
		register_widget( 'cuny_contextual_menu_widget' );
		register_widget( 'cuny_logo_widget' );
		register_widget( 'cuny_media_links_widget' );
		register_widget( 'cuny_reusable_component_widget' );
	}

	// Fix a compatibility issue between our RSS feed and the WP RSS widget
	public static function http_request_local_rss_fix( $args ) {
		$args['reject_unsafe_urls'] = false;
		return $args;
	}

	public static function admin_body_class( $classes ) {
		$vc_access_level = array();
		if ( current_user_can( 'manage_options' ) || current_user_can( 'cuny_full_vc' ) ) {
			$vc_access_level[] = 'cuny-full-vc';
		}
		if ( current_user_can( 'delete_pages' ) || current_user_can( 'cuny_editor_vc' ) ) {
			$vc_access_level[] = 'cuny-editor-vc';
		}
		$vc_access_level = implode(' ', $vc_access_level);

		if ( is_array( $classes ) ) {
			$classes[] = $vc_access_level;
		}
		else {
			$classes .= $vc_access_level;
		}

		return $classes;
	}
}

function init_cuny_carousel_class(){
	//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	    class WPBakeryShortCode_Cuny_Carousel extends WPBakeryShortCodesContainer {
	    }
	}
}

// Init the plugin
add_action( 'plugins_loaded', array('cuny_visual_composer', 'init'), 10 );
add_action( 'vc_after_mapping', 'init_cuny_carousel_class');

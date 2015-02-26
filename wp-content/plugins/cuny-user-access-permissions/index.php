<?php
/**
 * Plugin Name: CUNY User Access Permissions
 * Description: Restrict access to certain pages (requires ACF)
 * Version: 1.3
 * Author: CUNY Office Of Communications and Marketing
 * License: GPL2
 */

class cuny_user_access_permissions{
	public static $restrict_pages = array();
	public static $user_pages = array();

  public static function init(){
  		// This plugin needs ACF to be enabled
			if ( !function_exists('get_field') ) {
				return true;
			}

  		// Users can edit their own pages and the ones assigned to them via the ACF field
  		self::$restrict_pages = get_field( 'user_access_pages', 'user_'.get_current_user_id() );

  		if ( !is_array(self::$restrict_pages) ) {
  			self::$restrict_pages = array();
  		}
  		$user_posts = get_posts( array( 'author' => get_current_user_id(), 'post_type' => 'page' ) );
			
  		self::$user_pages = self::$restrict_pages;
			foreach ($user_posts as $value) {
				if ( !in_array( $value->ID, self::$restrict_pages ) ) {
					self::$user_pages[] = $value->ID;
				}
			}

      add_action( 'pre_get_posts', array( __CLASS__, 'user_access_filter_pages' ) );
      add_filter( 'user_has_cap', array( __CLASS__, 'edit_page_capability' ), 10, 3 );
      
      // Show the Page ID on the relationship field
			add_filter( 'acf/fields/relationship/result/name=user_access_pages', array( __CLASS__, 'add_page_id_to_field' ), 10, 2 );

			// Use CMS Tree Page View filters
			add_filter( 'cms_tree_page_view_post_user_can_add_inside', array( __CLASS__, 'can_insert_page_inside' ), 10, 2 );
			add_filter( 'cms_tree_page_view_post_user_can_add_after', array( __CLASS__, 'can_insert_page_after' ), 10, 2 );

			// Tweak the output of the Page Properties / Parent dropdown
			add_filter( 'page_attributes_dropdown_pages_args' , array( __CLASS__, 'page_attributes_dropdown_pages_args' ) );

			// Remove unwanted menu entries (based on user's role)
			add_action('admin_menu', array( __CLASS__, 'remove_admin_menu_items' ) );

			// Add drafts to Page Attributes / Page Parent dropdown
			add_filter( 'page_attributes_dropdown_pages_args', array( __CLASS__, 'enable_drafts_in_parent_dropdown' ) );
			add_filter( 'quick_edit_dropdown_pages_args', array( __CLASS__, 'enable_drafts_in_parent_dropdown' ) );
  }

  public static function user_access_filter_pages( $query ) {
		if ( is_admin() && $query->query_vars['post_type'] == 'page' && !current_user_can( 'manage_options' ) && $_GET['page'] != 'cms-tpv-page-page' ) {
			$query->set( 'post__in', self::$user_pages );
		}
	}

	public static function edit_page_capability( $allcaps, $caps, $args ) {
		if ( !empty($args[2]) && !empty( self::$restrict_pages ) && !in_array( $args[2], self::$user_pages ) ) {
			$allcaps['edit_others_pages'] = false;
		}
		return $allcaps;
	}

	public static function add_page_id_to_field( $html, $post ) {
		$parent_title = !empty( $post->post_parent )?get_the_title( $post->post_parent ).', ':'';
	  return $html." ({$parent_title}ID:{$post->ID})";
	}

	public static function can_insert_page_inside( $is_user_allowed, $post_id ) {
		// Only admins can create new pages outside of their "section"
		return in_array( $post_id, self::$user_pages );
	}

	public static function can_insert_page_after( $is_user_allowed, $post_id ) {
		// Only admins can create new pages outside of their "section"
		return current_user_can( 'manage_options' );
	}

	public static function page_attributes_dropdown_pages_args( $args = array(), $post = 0 ) {
		$args[ 'walker' ] = new cuny_page_dropdown();
		return $args;
	}

	public static function remove_admin_menu_items() {
		if ( !current_user_can( 'manage_options' ) ) {
			remove_submenu_page( 'edit.php?post_type=page', 'edit.php?post_type=page' );
		}
	}

	public static function enable_drafts_in_parent_dropdown( $args ) {
	    $args['post_status'] = 'draft,publish,pending';
	    return $args;
	}


}
add_action( 'plugins_loaded', array( 'cuny_user_access_permissions', 'init' ), 20 );

class cuny_page_dropdown extends Walker_PageDropdown {
	function start_el(&$output, $page, $depth, $args) {
		if ( !empty( cuny_user_access_permissions::$user_pages ) && !in_array( $page->ID, array_merge( cuny_user_access_permissions::$user_pages, array( $GLOBALS['post']->post_parent ) ) ) ) {
			return 0;
		}

		return parent::start_el($output, $page, $depth, $args);
	}
}
<?php
/*
Plugin Name: CUNY Tree View
Description: Adds a CMS-like tree view of all your pages, like the view often found in a page-focused CMS. Use the tree view to edit, view, add pages and search pages (very useful if you have many pages). And with drag and drop you can rearrange the order of your pages. Page management won't get any easier than this!
Version: 1.4.2
Author: CUNY Office Of Communications and Marketing
License: GPL2
*/

define( "CMS_TPV_VERSION", "1.2.27");
define( "CMS_TPV_NAME", "CUNY Tree View");

require(dirname(__FILE__) . "/functions.php");

// Find the plugin directory URL
$aa = __FILE__;
if ( isset( $mu_plugin ) ) {
	$aa = $mu_plugin;
}
if ( isset( $network_plugin ) ) {
	$aa = $network_plugin;
}
if ( isset( $plugin ) ) {
	$aa = $plugin;
}
$plugin_dir_url = plugin_dir_url(basename($aa)) . 'cuny-tree-view/';

// There! Now we should have it.
define( "CMS_TPV_URL", $plugin_dir_url);
// define( "CMS_TPV_PLUGIN_FOLDERNAME_AND_FILENAME", basename(dirname(__FILE__)) . "/" . basename(__FILE__) );

add_action( 'init', 'cms_tpv_load_textdomain' );

// on admin init: add styles and scripts
add_action( 'admin_init', 'cms_tpv_admin_init' );
add_action( 'admin_enqueue_scripts', 'cms_admin_enqueue_scripts' );
add_action( 'admin_init', 'cms_tpv_save_settings' );

// Hook onto dashboard and admin menu
add_action( 'admin_menu', "cms_tpv_admin_menu" );
add_action( 'admin_head', "cms_tpv_admin_head" );
add_action( 'wp_dashboard_setup', "cms_tpv_wp_dashboard_setup" );
add_action( 'add_meta_boxes', 'cms_tpv_replace_pageparent_metabox', 10, 2 );

// Ajax hooks
add_action( 'wp_ajax_cms_tpv_get_childs', 'cms_tpv_get_childs' );
add_action( 'wp_ajax_cms_tpv_move_page', 'cms_tpv_move_page' );
add_action( 'wp_ajax_cms_tpv_add_page', 'cms_tpv_add_page' );
add_action( 'wp_ajax_cms_tpv_add_pages', 'cms_tpv_add_pages' );

// activation
define( "CMS_TPV_MOVE_PERMISSION", "move_cms_tree_view_page" );

register_activation_hook( WP_PLUGIN_DIR . "/cms-tree-page-view/index.php" , 'cms_tpv_install' );
register_uninstall_hook( WP_PLUGIN_DIR . "/cms-tree-page-view/index.php" , 'cms_tpv_uninstall' );

// catch upgrade. moved from plugins_loaded to init to be able to use wp_roles
add_action( 'init', 'cms_tpv_plugins_loaded' );
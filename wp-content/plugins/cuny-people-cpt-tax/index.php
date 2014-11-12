<?php
/**
 * Plugin Name: CUNY CPT: People
 * Description: Defines a custom post type and its taxonomies for listing profiles
 * Version: 1.1
 * Author: CUNY Office Of Communications and Marketing
 * License: GPL2
 */

class cuny_people_cpt_tax{
    public static function init(){
        add_action( 'init', array( __CLASS__, 'register_cpt' ) );
        add_action( 'init', array( __CLASS__, 'register_tax' ) );
    }

    public static function register_cpt() {
        register_post_type( 'people', array(
            'label' => 'People',
            'description' => 'Profiles',
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'capability_type' => 'people',
            'capabilities' => array(
                // meta caps (don't assign these to roles)
                'edit_post'              => 'edit_person',
                'read_post'              => 'read_person',
                'delete_post'            => 'delete_person',

                // primitive/meta caps
                'create_posts'           => 'create_people',

                // primitive caps used outside of map_meta_cap()
                'edit_posts'             => 'edit_people',
                'edit_others_posts'      => 'manage_people',
                'publish_posts'          => 'manage_people',
                'read_private_posts'     => 'read',

                // primitive caps used inside of map_meta_cap()
                'read'                   => 'read',
                'delete_posts'           => 'manage_people',
                'delete_private_posts'   => 'manage_people',
                'delete_published_posts' => 'manage_people',
                'delete_others_posts'    => 'manage_people',
                'edit_private_posts'     => 'edit_people',
                'edit_published_posts'   => 'edit_people'
            ),
            'map_meta_cap' => true,
            'hierarchical' => false,
            'rewrite' => array( 'slug' => 'profile', 'with_front' => true ),
            'query_var' => true,
            'supports' => array( 'title', 'editor', 'excerpt', 'revisions', 'thumbnail', 'page-attributes' ),
            'taxonomies' => array( ),
            'labels' => array (
              'name' => 'People',
              'singular_name' => 'Person',
              'menu_name' => 'People',
              'add_new' => 'Add Person',
              'add_new_item' => 'Add New Person',
              'edit' => 'Edit',
              'edit_item' => 'Edit Person',
              'new_item' => 'New Person',
              'view' => 'View',
              'view_item' => 'View',
              'search_items' => 'Search',
              'not_found' => 'No Person Found',
              'not_found_in_trash' => 'No Person Found in Trash'
            )
        ) );
    }

    public static function register_tax() {
        register_taxonomy( 'person_type', 
            array (
                0 => 'people',
            ),
            array( 
                'hierarchical' => true,
                'label' => 'Profile Types',
                'show_ui' => true,
                'query_var' => false,
                'show_admin_column' => false,
                'capabilities'    => array(
                    'manage_terms' => 'manage_categories',
                    'edit_terms' => 'manage_categories',
                    'delete_terms' => 'manage_categories',
                    'assign_terms' => 'manage_categories'
                ),
                'labels' => array (
                    'search_items' => 'Profile Types',
                    'all_items' => 'All Types'
                )
            )
        );

        register_taxonomy( 'research_area', 
            array (
                0 => 'people',
            ),
            array( 
                'hierarchical' => true,
                'label' => 'Research Areas',
                'show_ui' => true,
                'query_var' => false,
                'show_admin_column' => false,
                'capabilities'    => array(
                    'manage_terms' => 'manage_categories',
                    'edit_terms' => 'manage_categories',
                    'delete_terms' => 'manage_categories',
                    'assign_terms' => 'manage_categories'
                ),
                'labels' => array (
                    'search_items' => 'Research Areas',
                    'all_items' => 'All Areas'
                )
            )
        );
      }
}
add_action( 'plugins_loaded', array('cuny_people_cpt_tax', 'init') );

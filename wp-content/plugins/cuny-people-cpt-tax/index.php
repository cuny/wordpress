<?php
/**
 * Plugin Name: CUNY CPT/T: People
 * Description: Defines CPT and Taxonomies for listing people's profiles
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
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'hierarchical' => false,
            'rewrite' => array( 'slug' => 'profile', 'with_front' => true ),
            'query_var' => true,
            'supports' => array( 'revisions', 'thumbnail', 'page-attributes' ),
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

        register_taxonomy( 'campus', 
            array (
                0 => 'people',
            ),
            array( 
                'hierarchical' => true,
                'label' => 'College Affiliation',
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
                    'search_items' => 'College Affiliations',
                    'all_items' => 'All Colleges'
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

        register_taxonomy( 'line_of_work', 
            array (
                0 => 'people',
            ),
            array( 
                'hierarchical' => true,
                'label' => 'Professional Area',
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
                    'search_items' => 'Professional Areas',
                    'all_items' => 'All Areas'
                )
            )
        );
      }
}
add_action( 'plugins_loaded', array('cuny_people_cpt_tax', 'init') );

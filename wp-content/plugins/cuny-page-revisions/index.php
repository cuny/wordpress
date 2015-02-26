<?php
/**
 * Plugin Name: CUNY Page Revisions
 * Description: Clone an existing page to create drafts for preview
 * Version: 1.0
 * Author: CUNY Office Of Communications and Marketing
 * License: GPL2
 */

class cuny_page_revisions{
    public static function init(){
        add_action( 'post_submitbox_misc_actions', array( __CLASS__, 'add_revision_button' ) );
        add_filter( 'user_has_cap', array( __CLASS__, 'hide_update_button' ), 10, 3 );
    }

    public static function hide_update_button( $allcaps, $caps, $args ) {
        $allcaps['edit_page'] = false;
        return $allcaps;
    }

    public static function add_revision_button() {
        echo '<div class="misc-pub-section misc-pub-section-last" style="border-top: 1px solid #eee; text-align: center;">';

        // Does this page have existing unpublished drafts?
        // if ( post_type == page ) {
            if (true) {
                echo 'This page has a <a href="">pending draft</a>.';

            }
            else {
                echo wp_nonce_field( 'cuny_page_revisions', 'cuny_page_revisions_nonce', false );
                echo '<a class="button button-secondary" href="'.wp_nonce_url(admin_url()).'" id="post-new-draft">New Draft</a>';
            }
        // }
        // else { // post_type = cuny_revision
        //    if ( there are revisions to the live page newer than this draft ){
        //      echo 'There is a newer revision of the original page. Please make sure to compare the changes before overriding its content.'
        //    }
        // }
        echo '</div>';
    }
}
add_action( 'plugins_loaded', array('cuny_page_revisions', 'init') );

add_action( 'save_post', 'save_article_or_box' );
function save_article_or_box($post_id) {

    if (!isset($_POST['post_type']) )
        return $post_id;

    if ( !wp_verify_nonce( $_POST['article_or_box_nonce'], plugin_basename(__FILE__) ) )
        return $post_id;

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
        return $post_id;

    if ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
        return $post_id;
    
    if (!isset($_POST['article_or_box']))
        return $post_id;
    else {
        $mydata = $_POST['article_or_box'];
        update_post_meta( $post_id, '_article_or_box', $_POST['article_or_box'], get_post_meta( $post_id, '_article_or_box', true ) );
    }

}
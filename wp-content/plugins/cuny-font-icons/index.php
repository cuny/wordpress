<?php
/**
 * Plugin Name: CUNY Font Icons
 * Description: Adds support for the CUNY font icons to the active theme
 * Version: 1.1
 * Author: CUNY Office Of Communications and Marketing
 * License: GPL2
 */

class cuny_web_font{
    public static function init(){
        add_action( 'wp_enqueue_scripts', array( __CLASS__ , 'enqueue_styles' ) );
    }

    public static function enqueue_styles() {
        wp_enqueue_style( 'cuny_web_font', plugins_url( 'cuny-font-icons.css' , __FILE__ ), array(), null );
    }
}
add_action( 'plugins_loaded', array('cuny_web_font', 'init') );
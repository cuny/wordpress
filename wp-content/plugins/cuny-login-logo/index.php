<?php
/**
 * Plugin Name: CUNY Logo on Login
 * Description: Replace the default WordPress Logo on the login screen
 * Version: 1.0
 * Author: CUNY Office Of Communications and Marketing
 * License: GPL2
 */

class cuny_login_logo{
    public static function init(){
        add_action( 'login_enqueue_scripts', array(__CLASS__, 'login_logo') );
        add_filter( 'login_headerurl', array(__CLASS__, 'login_logo_url') );
        add_filter( 'login_headertitle', array(__CLASS__, 'login_logo_url_title') );
    }

    public static function login_logo() { ?>
        <style type="text/css">
            body.login form{
                border-radius: 5px;
            }
            body.login div#login{
                padding-top: 4%;
            }
            body.login div#login h1 a {
                background-image: url(<?php echo plugins_url('cuny-logo.png', __FILE__); ?>);
                background-size: 330px 200px;
                height: 200px;
                width: 330px;
            }
        </style>
    <?php }

    public static function login_logo_url_title() {
        return 'The City University of New York';
    }
    public static function login_logo_url() {
        return 'http://www.cuny.edu/';
    }
}
add_action( 'plugins_loaded', array('cuny_login_logo', 'init') );
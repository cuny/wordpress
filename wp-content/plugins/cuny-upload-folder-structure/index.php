<?php
/**
 * Plugin Name: CUNY Upload Folder Structure 
 * Description: Change the media library upload folder organization to reflect the site's permalink structure
 * Version: 1.0
 * Author: CUNY Office Of Communications and Marketing
 * License: GPL2
 */

class cuny_upload_folder_structure{
		public static $post_id = 0;
		public static $file_extension = '';

    public static function init(){
			add_filter( 'wp_handle_upload_prefilter', array( __CLASS__, 'upload_prefilter' ) );	
			add_action( 'xmlrpc_call', array( __CLASS__, 'xmlrpc_call' ) );
			add_filter( 'wp_handle_upload', array( __CLASS__, 'remove_upload_handle' ) );	
    }

    public static function xmlrpc_call( $_call ){
			if($_call !== 'metaWeblog.newMediaObject'){
				return false;
			}		
			
			$data = $GLOBALS['wp_xmlrpc_server']->message->params[3];

			if( !empty( $data['post_id'] ) ){
				self::$post_id = (int) $data['post_id'];
			}

			self::upload_prefilter( $data );
		}

		public static function upload_prefilter( $_file ){
			if( !empty( $_file['name'] ) ){
				$wp_filetype = wp_check_filetype( $_file['name'] ); 
				self::$file_extension = !empty( $wp_filetype['ext'] ) ? $wp_filetype['ext'] : '';
			}
			add_filter( 'upload_dir', array( __CLASS__, 'custom_upload_dir' ) );
			return $_file;
		}

		public static function custom_upload_dir( $_path ){		
			if( !empty( $_path['error'] ) ){
				return $_path;
			}

			$customdir = self::generate_dir();

			$_path['path'] = str_replace( $_path['subdir'], '', $_path['path'] ); //remove default subdir (year/month)
			$_path['url'] = str_replace( $_path['subdir'], '', $_path['url'] );
			$_path['subdir'] = $customdir;
			$_path['path'] .= $customdir;
			$_path['url'] .= $customdir;

			return $_path;
		}

		public static function generate_dir(){	
			$my_post_id = (!empty($post_id) ? $GLOBALS['post']->ID : (!empty($_REQUEST['post_id']) ? $_REQUEST['post_id'] : (!empty(self::$post_id) ? self::$post_id : 0)));

			if ( empty( $my_post_id ) ){
				return '/assets/';
			}
			else{
				return wp_make_link_relative( str_replace( get_option( 'home' ), '', get_permalink( $my_post_id ) ) );	
			}
		}

		public static function remove_upload_handle( $_fileinfo ){	
			remove_filter( 'upload_dir', array( __CLASS__, 'upload_dir' ) );
			return $_fileinfo;
		}
}
add_action( 'plugins_loaded', array('cuny_upload_folder_structure', 'init') );
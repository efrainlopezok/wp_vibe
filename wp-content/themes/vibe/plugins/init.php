<?php

add_filter('acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_path( $path ) {

   // update path
   $path = get_stylesheet_directory() . '/plugins/acf/';
   
   // return
   return $path;
   
}


//  customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir( $dir ) {

   // update path
   $dir = get_stylesheet_directory_uri() . '/plugins/acf/';
   
   // return
   return $dir;
   
}


//  Hide ACF field group menu item
// add_filter('acf/settings/show_admin', '__return_false');


//  Include ACF
include_once( get_stylesheet_directory() . '/plugins/acf/acf.php' );

// include_once( get_stylesheet_directory() . '/plugins/acf/helpers.php' );

//  Include ACF Content
// include_once( get_stylesheet_directory() . '/plugins/acf-flexible-content-blocks/acf-flexible-content-blocks.php' );
//  Add theme settings
function mtm_options_page() {
	
		
		acf_add_options_page( array(
			'page_title' 	=> 'Theme Settings',
			'menu_title'	=> 'Theme Settings',
			'menu_slug' 	=> 'theme-general-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> true // false gives this its own page
		) );
		

}
add_action( 'init', 'mtm_options_page' );

//Visual Columns
include_once( CHILD_DIR . '/plugins/visual-columns/righthere-columns.php' );

//Duplicate Post
include_once( CHILD_DIR . '/plugins/duplicate-page/duplicatepage.php' );
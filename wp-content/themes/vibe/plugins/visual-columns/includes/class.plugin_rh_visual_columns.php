<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/

class plugin_rh_visual_columns {
	function plugin_rh_visual_columns(){
		add_action('after_setup_theme', array(&$this,'after_setup_theme'), 20);
	}
	
	function after_setup_theme(){
		if(!class_exists('sws_visual_columns')):
			require_once RHCOL_PATH.'includes/class.sws_visual_columns.php';
			new sws_visual_columns(RHCOL_URL);
		endif;
	}
}
?>
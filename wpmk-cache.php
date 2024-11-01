<?php
/*
Plugin Name: WPMK Cache
Plugin URI: http://www.wpmk.org/plugins/wpmk-cache
Description: The easiest and fastest WordPress Cache plugin.
Version: 1.0.1
Author: Mubeen Khan
Author URI: http://www.wpmk.org/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: wpcache
Domain Path: /lang
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/


/**
 * THERE IS NO WARRANTY FOR THIS PLUGIN, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT 
 * WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE 
 * PLUGIN "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, 
 * BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A 
 * PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PLUGIN IS 
 * WITH YOU. SHOULD THE PLUGIN PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY 
 * SERVICING, REPAIR OR CORRECTION.
 * 
 */


// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// enqueue css
function wpmk_cache_admin_style(){
    wp_register_style( 'wpmk_cache_admin_css', plugins_url( 'css/style.css' , __FILE__ ), false, '1.0.0' );
    wp_enqueue_style( 'wpmk_cache_admin_css' );
}
add_action('admin_enqueue_scripts', 'wpmk_cache_admin_style');

// Add required includes
include_once(ABSPATH . 'wp-admin/includes/misc.php');
require_once(dirname(__FILE__)."/inc/cache-functions.php");
$wpmk_cache = new WPMK_Cache();

if(is_admin()){
    $wpmk_cache->add_options_panel();
}else{
    $wpmk_cache->startCache();
}
register_deactivation_hook( __FILE__, array( $wpmk_cache , 'deactivate') );
?>
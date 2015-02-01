<?php
/**
 * Plugin Name: Custom Post Type Locations
 * Plugin URI: http://horttcore.de
 * Description: Manage locations
 * Version: 0.4
 * Author: Ralf Hortt
 * Author URI: http://horttcore.de
 * Text Domain: custom-post-type-locations
 * Domain Path: /languages/
 * License: GPL2
 */

require( 'classes/custom-post-type-locations.php' );
require( 'classes/custom-post-type-locations.widget.php' );
require( 'inc/template-tags.php' );

if ( is_admin() )
	require( 'classes/custom-post-type-locations.admin.php' );

<?php
/*
Plugin Name: Floorplan
Plugin URI: http://www.wptooling.com
Description: Upload a floorplan and add position markers to show (room) images.
Version: 0.2.3
Author: Maarten Hemmes - WPTooling
Author URI: http://www.wptooling.com
License: A "Slug" license name e.g. GPL2
*/

//ini_set( 'display_errors', 1 );
//error_reporting( E_ERROR | E_WARNING | E_PARSE | E_NOTICE );

#INCLUDES#
include('includes/admin.class.php');
include('includes/frontend.class.php');
include('includes/settings.class.php');
include('includes/resize.php');
include('includes/functions.php');
include('includes/wptooling.class.php');

##INITIATE CLASSES##
$settings = new floorplan_settings();
$frontend = new floorplan_frontend();
$admin = new admin_floorplan();
$wp_tooling = new wp_tooling();

<?php
/**
 * Plugin Name:       Cawoy Frontend Dashboard
 * Plugin URI:        https://cawoy.com/
 * Description:       This plugin provides you a frontend dashboard to post and manage profile.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Awais Ahmad
 * Author URI:        https://cawoy.com/itsahmadawaiswebdev/
 * Text Domain:       cawoy-frontend
 */

if(!defined('ABSPATH'))
    die;

if(!defined('Cawoy_Frontend_DIR'))
{
    define('Cawoy_Frontend_DIR',plugin_dir_url(__FILE__));
}

if(!defined('Cawoy_PLUG_PATH'))
{
    define('Cawoy_PLUG_PATH', plugin_dir_path( __FILE__ ));
}
require_once('activation.php');

$customMessage = array();
$activeMenu="dashboard";

if(!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php"); 
}
/*Template Loader*/
require_once('includes/fileLoader.php');
/*Functions and hooks regisration*/
require_once('functions.php');

/*Manage All POST REQUESTS*/
require_once('includes/requests.php');

/*User Post Bookmarking System*/
require_once('includes/activity_system.php');
/*For Admin Pages*/
require_once('admin.php');

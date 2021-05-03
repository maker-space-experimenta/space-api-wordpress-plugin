<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/maker-space-experimenta/space-api-wordpress-plugin
 * @since             1.0.0
 * @package           ms_devices
 *
 * @wordpress-plugin
 * Plugin Name:       Space API
 * Plugin URI:        https://github.com/maker-space-experimenta/space-api-wordpress-plugin
 * Description:       Plugin to provide a space api endpoint for your makerspace, Fablab, Hackspace, ...
 * Version:           1.0.0
 * Author:            Jonathan Günz
 * Author URI:        https://hmnd.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ms-device-management
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}


// the main plugin class
require_once dirname(__FILE__) . '/src/space-api.class.php';

SpaceAPI::instance();

register_activation_hook(__FILE__, array('SpaceAPI', 'activate'));
register_deactivation_hook(__FILE__, array('SpaceAPI', 'deactivate'));

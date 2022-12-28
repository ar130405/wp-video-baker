<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wpvideobaker.com
 * @since             1.0
 * @package           Wp_Video_Baker
 *
 * @wordpress-plugin
 * Plugin Name:       WPVideoBaker
 * Plugin URI:        https://wpvideobaker.com
 * Description:       WPVideoBaker allows you to quickly and easily convert blog posts into stunning videos. It will break down any blog post into separate video sections, and automatically generate voice-over to accompany the visual content. All you have to do is add images to the video sections, and the plugin takes care of the rest. 
 * Version:           1.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-video-baker
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_VIDEO_BAKER_VERSION', '1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-video-baker-activator.php
 */
function activate_wp_video_baker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-video-baker-activator.php';
	Wp_Video_Baker_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-video-baker-deactivator.php
 */
function deactivate_wp_video_baker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-video-baker-deactivator.php';
	Wp_Video_Baker_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_video_baker' );
register_deactivation_hook( __FILE__, 'deactivate_wp_video_baker' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-video-baker.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0
 */
function run_wp_video_baker() {

	$plugin = new Wp_Video_Baker();
	$plugin->run();

}
run_wp_video_baker();

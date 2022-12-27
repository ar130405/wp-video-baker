<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wpvideobaker.com
 * @since      1.0.0
 *
 * @package    Wp_Video_Baker
 * @subpackage Wp_Video_Baker/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Video_Baker
 * @subpackage Wp_Video_Baker/includes
 * @author     WP Video Baker <wpgeekil@gmail.com>
 */
class Wp_Video_Baker_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-video-baker',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://rahicodes.wordpress.com
 * @since      1.0.0
 *
 * @package    Rahi_wpbook
 * @subpackage Rahi_wpbook/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Rahi_wpbook
 * @subpackage Rahi_wpbook/includes
 * @author     Rahi <rahi.prajapati1811@gmail.com>
 */
class Rahi_wpbook_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'rahi_wpbook',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

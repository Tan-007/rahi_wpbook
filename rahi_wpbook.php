<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://rahicodes.wordpress.com
 * @since             1.0.0
 * @package           Rahi_wpbook
 *
 * @wordpress-plugin
 * Plugin Name:       Wp Book
 * Plugin URI:        https://rahicodes.wordpress.com
 * Description:       The plugin comes bundled with two widgets and whole setup for you to create, publish and manage books.
 * Version:           1.1.0
 * Author:            Rahi
 * Author URI:        https://rahicodes.wordpress.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rahi_wpbook
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('RAHI_WPBOOK_VERSION', '1.1.0');

/**
 * Global variables
 */
$defaults = array(
    'currency' => 'INR',
    'num_of_books' => '10',
);
$book_options = get_option( 'book_settings', $defaults );

if ( $book_options == '' ) {
    update_option( 'book_settings', $defaults );
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rahi_wpbook-activator.php
 */
function rahi_wpbook_activate() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-rahi_wpbook-activator.php';
    Rahi_wpbook_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rahi_wpbook-deactivator.php
 */
function rahi_wpbook_deactivate() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-rahi_wpbook-deactivator.php';
    Rahi_wpbook_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'rahi_wpbook_activate' );
register_deactivation_hook( __FILE__, 'rahi_wpbook_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rahi_wpbook.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function rahi_wpbook_run() {

    $plugin = new Rahi_wpbook();
    $plugin->run();
}
rahi_wpbook_run();

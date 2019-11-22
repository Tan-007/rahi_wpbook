<?php

/**
 * Fired during plugin activation
 *
 * @link       https://rahicodes.wordpress.com
 * @since      1.0.0
 *
 * @package    Rahi_wpbook
 * @subpackage Rahi_wpbook/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rahi_wpbook
 * @subpackage Rahi_wpbook/includes
 * @author     Rahi <rahi.prajapati1811@gmail.com>
 */
class Rahi_wpbook_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate() {

        // flush rewrite rules on plugin activation
        flush_rewrite_rules();

        // create custom table on plugin activation
        $version = '1.0.0';

        if ( defined( 'RAHI_WPBOOK_VERSION' ) ) {
            $version = RAHI_WPBOOK_VERSION;
        }
        $rahi_wpbook_admin = new Rahi_wpbook_Admin( 'rahi_wpbook', $version );
        $rahi_wpbook_admin->book_create_custom_table();

    }

}

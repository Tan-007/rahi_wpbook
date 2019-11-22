<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://rahicodes.wordpress.com
 * @since      1.0.0
 *
 * @package    Rahi_wpbook
 * @subpackage Rahi_wpbook/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Rahi_wpbook
 * @subpackage Rahi_wpbook/includes
 * @author     Rahi <rahi.prajapati1811@gmail.com>
 */
class Rahi_wpbook_Deactivator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function deactivate() {
        // flush the rewrite rules on deactivation
        flush_rewrite_rules();
    }

}

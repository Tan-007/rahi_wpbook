<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://rahicodes.wordpress.com
 * @since      1.0.0
 *
 * @package    Rahi_wpbook
 */

function delete_custom_posts() {

    // Cleanup db on uninstall
    // method-1: manually deleting every post from db
    $books = get_posts(array('post_type' => 'book', 'numberposts' => -1));

    foreach ($books as $book) {
        wp_delete_post($book->ID, true);
    }

    // method-2: Directly accessing db and deleting every post using SQL
    // Directly accessing database
    // global $wpdb;
    // $wpdb->query("DELETE FROM wp_posts WHERE post_type = 'book'");

}

function drop_custom_tables() {

    // drop table containing meta data on uninstall
    global $wpdb;
    $table_name = $wpdb->prefix . 'book_info_meta';

    $wpdb->query( "DROP TABLE IF EXISTS " . $table_name . ";" );

}


// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
} else {
    drop_custom_tables();
    delete_custom_posts();
}
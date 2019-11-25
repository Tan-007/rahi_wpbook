<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://rahicodes.wordpress.com
 * @since      1.0.0
 *
 * @package    Rahi_wpbook
 * @subpackage Rahi_wpbook/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rahi_wpbook
 * @subpackage Rahi_wpbook/admin
 * @author     Rahi <rahi.prajapati1811@gmail.com>
 */

/**
 * includes
 */
// for rendering shortcode's front-end and custom option page
require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/rahi_wpbook-admin-display.php' );
 
// for widget class
require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets.php' );

class Rahi_wpbook_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Rahi_wpbook_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Rahi_wpbook_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rahi_wpbook-admin.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Rahi_wpbook_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Rahi_wpbook_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rahi_wpbook-admin.js', array( 'jquery' ), $this->version, false );

    }

    /**
     * ADD-ON FUNCTIONS START HERE
     */

    /*
     * Function that registers the 'book' post type
     *
     * @since    1.0.1
     */
    public function add_custom_post_type() {

        $labels = array(
            'name'          => __( 'Books', 'rahi_wpbook' ),
            'singular_name' => __( 'Book', 'rahi_wpbook' ),
            'add_new'       => __( 'Add Book', 'rahi_wpbook' ),
            'all_items'     => __( 'All Books', 'rahi_wpbook' ),
            'edit_item'     => __( 'Edit Book', 'rahi_wpbook' ),
            'add_new_item'  => __( 'Add New Book', 'rahi_wpbook' ),
            'new_item'      => __( 'Add Book', 'rahi_wpbook' ),
            'view_item'     => __( 'View Book', 'rahi_wpbook' ),
            'search_item'   => __( 'Search Book', 'rahi_wpbook' ),
        );

        $args = array(
            'labels'          => $labels,
            'public'          => true,
            'capability_type' => 'post',
            'menu_icon'       => 'dashicons-book',
            'has_archive'     => true,
            'hierarchical'    => false,
            'supports'        => array(
                                    'title', 
                                    'editor',
                                    'excerpt',
                                    'thumbnail',
                                    'revisions',
                                    'comments',
                                ),
        );

        register_post_type( 'book', $args );

    }

    /**
     * Function to add custom taxonomy 'Book Category'
     * This one is hierarchical taxonomy
     * 
     * @since    1.0.2
     */
    public function hi_add_custom_taxonomy() {
        $labels = array(
            'name'               => __( 'Book Categories', 'rahi_wpbook' ),
            'singular_name'      => __( 'Book Category', 'rahi_wpbook' ),
            'search_items'       => __( 'Search Book Categories', 'rahi_wpbook' ),
            'all_items'          => __( 'All Book Categories', 'rahi_wpbook' ),
            'parent_item'        => 'Parent Type',
            'parent_item_column' => 'Parent Type:',
            'edit_item'          => __( 'Edit Book Category', 'rahi_wpbook' ),
            'update_item'        => __( 'Update Book Category', 'rahi_wpbook' ),
            'add_new_item'       => __( 'Add New Book Category', 'rahi_wpbook' ),
            'new_item_name'      => __( 'New Category Name', 'rahi_wpbook' ),
            'menu_name'          => __( 'Book Categories', 'rahi_wpbook' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'rewrite'           => array( 'slug' => 'book_category' ),
        );
            
        // register taxonomy
        register_taxonomy('book_category', array('book'), $args);
    }

    /**
     * Function to add custom taxonomy 'Book Tags'
     * This one is non-hierarchical taxonomy
     * 
     * @since    1.0.2
     */
    public function add_custom_taxonomy() {
        $labels = array(
            'name'          => __( 'Book Tags', 'rahi_wpbook' ),
            'singular_name' => __( 'Book Tag', 'rahi_wpbook' ),
            'all_items'     => __( 'All Book Tags', 'rahi_wpbook' ),
            'edit_item'     => __( 'Edit Book Tag', 'rahi_wpbook' ),
            'update_item'   => __( 'Update Book Tag', 'rahi_wpbook' ),
            'add_new_item'  => __( 'Add New Book Tag', 'rahi_wpbook' ),
            'new_item_name' => __( 'New Tag Name', 'rahi_wpbook' ),
            'menu_name'     => __( 'Book Tags', 'rahi_wpbook' ),
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'rewrite'           => array( 'slug' => 'book_tag' ),
        );
            
        // register taxonomy
        register_taxonomy('book_tag', array('book'), $args);
    }


    /**
     * Function to add custom meta boxes
     * 
     * @since    1.0.3
     */
    public function book_create_meta_box() {

        /**
         *  add_meta_box(String id, String title, function callback, mixed screen, String context, String priority,
         *      Array callback_args);
         * id -> used to store and retrive your meta data
         * title -> what user sees
         * callback -> function called
         * screen -> used to indicate where the metabox is to be displayed
         * context -> (normal, side) show on right side or in editor column
         * priority -> (high, default, low) gives priority to display
         * These four args are enough, rest are optional
         */

        add_meta_box( 'details', __( 'Additional Information',  'rahi_wpbook' ), array( $this, 'book_meta_info_callback' ), 'book' );

    }

    public function book_meta_info_callback( $post ) {

        /**
         *  Use nonce for verification
         * 
         * wp_nonce_field( String $action, String $name )
         * 
         * $action -> Action name. Should give the context to what is taking place. Optional but recommended.
         * $name ->  Nonce name. This is the name of the nonce hidden form field to be created.
         */
        wp_nonce_field( 'book_save_meta_info', 'book_additional_info_nonce' );

        // retrive all information
        $all_info = get_metadata( 'bookinfo', $post->ID, '_additional_info_key' )[0];

        // RENDER HTML
        render_custom_metadata( $all_info );

    }

    // support function to save meta info
    public function book_save_meta_info( $post_id ) {

        // Nonce verification. If nonce does not match, return
        if ( ! wp_verify_nonce( $_POST[ 'book_additional_info_nonce' ], 'book_save_meta_info' ) ) {
            return;
        }

        // If post is being auto saved by wordpress, no need to save meta data
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // make sure user has permission to change meta data
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // collect and sanitize data
        $author_name = sanitize_text_field( $_POST[ 'book_author_name_field' ] );
        $price       = sanitize_text_field( $_POST[ 'book_price_field' ] );
        $publisher   = sanitize_text_field( $_POST[ 'book_publisher_field' ] );
        $year        = sanitize_text_field( $_POST[ 'book_year_field' ] );
        $edition     = sanitize_text_field( $_POST[ 'book_edition_field' ] );
        $url         = sanitize_text_field( $_POST[ 'book_url_field' ] );

        // push all info to db as an array
        $all_info = array(
            'author_name' => $author_name,
            'price'       => $price,
            'publisher'   => $publisher,
            'year'        => $year,
            'edition'     => $edition,
            'url'         => $url,
        );

        // update the data to db
        update_metadata( 'bookinfo', $post_id, '_additional_info_key', $all_info );
    }

    /**
     * Function to create a custom table when plugin is loaded
     * 
     * Function is being called by activation hook registered in 'rahi_wpbook.php'
     * 
     * @since    1.0.4
     */
    public function book_create_custom_table() {

        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'book_info_meta';

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        
        if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
            $query = "CREATE TABLE " . 
                $table_name . "(
                meta_id bigint(20) NOT NULL AUTO_INCREMENT,
                bookinfo_id bigint(20) NOT NULL DEFAULT '0',
                meta_key varchar(255) DEFAULT NULL,
                meta_value longtext,
                PRIMARY KEY  (meta_id),
                KEY bookinfo_id (bookinfo_id),
                KEY meta_key (meta_key)
            )" . $charset_collate . ";";

            dbDelta( $query );
        }

    }

   
    /**
     * Function to register custom table when plugin is loaded
     * 
     * @since    1.0.4
     */
    public function book_register_custom_table() {
        // global $wpdb;

        // $wpdb->bookinfometa = $wpdb->prefix . "bookinfometa";
        // $wpdb->tables[] = 'bookinfometa';

        global $wpdb;

        $wpdb->bookinfometa = $wpdb->prefix . 'book_info_meta';
        $wpdb->tables[] = 'book_info_meta';
        
        return;
    }

    /**
     * Function for our settings page
     * 
     * @since    1.0.5
     */
    public function book_settings_page() {

        /**
         * for adding the settings page under "Settings" menu
         * add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function );
        */

        /**
         * for adding the page under root menu
         * add_menu_page( string $page_title, string $menu_title, string $capability,
         *  string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
         */

        //'book_render_settings_page' function in : .../admin/partials/rahi_wpbook-admin-display.php   
        add_menu_page( __( 'Book Settings', 'rahi_wpbook' ), __( 'Book Settings', 'rahi_wpbook' ), 'manage_options', 'book-settings', 'book_render_settings_page',
            'dashicons-chart-pie', '59' );
    }

    /**
     * Function for registering settings
     * 
     * @since    1.0.5
     */
    function book_register_settings() {
        // options page settings
        register_setting( 'book-settings-group', 'book_settings' );

        // custom widget settings
        register_setting( 'book-widget-settings-group', 'book_widget_settings' );
    }

    /**
     * Function for adding short code
     * 
     * @since    1.0.6
     * @param $atts passed by wordpress. contains user passed shortcode attributes
     */
    public function book_add_shortcode( $atts ) {

        global $book_options;

        $atts = shortcode_atts(
            array( 
                'id'          => '',
                'author_name' => '',
                'year'        => '',
                'category'    => '',
                'tag'         => '',
                'publisher'   => '',
            ), $atts
        );

        // I probably messed it up here
        $args = array(
            'post_type'      => 'book',
            'post_status'    => 'publish',
            'posts_per_page' => $book_options[ 'num_of_books' ],
            'author'         => $atts[ 'author_name' ],
        );

        if ( $atts[ 'id' ] != '' ) {
            $args[ 'id' ] = $atts[ 'id' ];
        }

        if ( $atts[ 'category' ] != '' ) {
            $args[ 'tax_query' ] = array(
                array(
                    'taxonomy' => 'book_category',
                    'terms'    => array( $atts[ 'category' ] ),
                    'field'    => 'name',
                    'operator' => 'IN',
                ),
            );
        }

        if ( $atts[ 'tag' ] != '' ) {
            $args[ 'tax_query' ] = array(
                array(
                    'taxonomy' => 'book_tag',
                    'terms'    => array( $atts[ 'tag' ] ),
                    'field'    => 'name',
                    'operator' => 'IN',
                ),
            );
        }

        // function in : .../admin/partials/rahi_wpbook-admin-display.php        
        return render_book_info_shortcode( $args );

    }

    function book_register_shortcodes() {
        add_shortcode( 'book', array( $this, 'book_add_shortcode' ) );
    }

    /**
     * Function for registering custom widget
     * 
     * @since    1.1.0
     */
    function book_register_widget() {
        // class in : .../includes/widgets.php
        register_widget( 'Rahi_WPBook_Widget' );
    }

    /**
     * Function for registering dashboard widget
     * 
     * @since    1.1.0
     */
    function booK_register_dash_widget() {
        // function in : .../admin/partials/rahi_wpbook-admin-display.php
        wp_add_dashboard_widget( 'book_dash_cat_widget', __( 'Top 5 Book Categories', 'rahi_wpbook' ), 'book_render_dash_widget' );
    }


}
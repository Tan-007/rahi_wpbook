<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://rahicodes.wordpress.com
 * @since      1.0.0
 *
 * @package    Rahi_wpbook
 * @subpackage Rahi_wpbook/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Rahi_wpbook
 * @subpackage Rahi_wpbook/includes
 * @author     Rahi <rahi.prajapati1811@gmail.com>
 */
class Rahi_wpbook {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Rahi_wpbook_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        if ( defined( 'RAHI_WPBOOK_VERSION' ) ) {
            $this->version = RAHI_WPBOOK_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'rahi_wpbook';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Rahi_wpbook_Loader. Orchestrates the hooks of the plugin.
     * - Rahi_wpbook_i18n. Defines internationalization functionality.
     * - Rahi_wpbook_Admin. Defines all hooks for the admin area.
     * - Rahi_wpbook_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-rahi_wpbook-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-rahi_wpbook-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-rahi_wpbook-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-rahi_wpbook-public.php';

        $this->loader = new Rahi_wpbook_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Rahi_wpbook_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Rahi_wpbook_i18n();

        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new Rahi_wpbook_Admin( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        
        // Hook for registering 'book' custom post type
        $this->loader->add_action( 'init', $plugin_admin, 'add_custom_post_type' );

        // Hook for registering 'Book Category' hierarchical taxonomy
        $this->loader->add_action( 'init', $plugin_admin, 'hi_add_custom_taxonomy' );
        
        // Hook for registering 'Book Tags' non-hierarchical taxonomy
        $this->loader->add_action( 'init', $plugin_admin, 'add_custom_taxonomy' );

        // Hook for registering function to add custom Meta Box
        $this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'book_create_meta_box' );
        
        // Hook for saving meta information on every post save
        $this->loader->add_action( 'save_post', $plugin_admin, 'book_save_meta_info' );
        
        // Hook for registering custom table to metadata api
        $this->loader->add_action( 'init', $plugin_admin, 'book_register_custom_table' );
        $this->loader->add_action( 'switch_blog', $plugin_admin, 'book_register_custom_table' );
        
        // Hook for custom admin options page
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'book_settings_page' );
        
        // Hook for registering settings
        $this->loader->add_action( 'admin_init', $plugin_admin, 'book_register_settings' );
        
        // Hook for registering shortcode
        $this->loader->add_action( 'init', $plugin_admin, 'book_register_shortcodes' );

        // Hook for registering widgets
        $this->loader->add_action( 'widgets_init', $plugin_admin, 'book_register_widget' );

        // Hook for registering custom dashboard widget
        $this->loader->add_action( 'wp_dashboard_setup', $plugin_admin, 'book_register_dash_widget' );

    }
    
    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new Rahi_wpbook_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Rahi_wpbook_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

}

<?php
/**
 * Plugin Name: Classic Editor & Widgets
 * Plugin URI: https://github.com/ghouliaras/classic-editor-widgets
 * Description: Enables the classic editor and classic widgets in WordPress. Restores the previous "classic" editor with TinyMCE and the old-style widget management screens.
 * Version: 1.0.0
 * Author: ghouliaras
 * Author URI: https://github.com/ghouliaras
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: classic-editor-widgets
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 * Network: false
 *
 * @package ClassicEditorWidgets
 * @version 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants
define( 'CEW_VERSION', '1.0.0' );
define( 'CEW_PLUGIN_FILE', __FILE__ );
define( 'CEW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CEW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CEW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Include required files
require_once CEW_PLUGIN_DIR . 'includes/class-classic-editor.php';
require_once CEW_PLUGIN_DIR . 'includes/class-classic-widgets.php';

/**
 * Main plugin class
 */
class Classic_Editor_Widgets {

	/**
	 * Plugin instance
	 *
	 * @var Classic_Editor_Widgets
	 */
	private static $instance = null;

	/**
	 * Get plugin instance
	 *
	 * @return Classic_Editor_Widgets
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	private function __construct() {
		$this->init_hooks();
	}

	/**
	 * Initialize hooks
	 */
	private function init_hooks() {
		// Load text domain
		add_action( 'init', array( $this, 'load_textdomain' ) );

		// Initialize classic editor and widgets
		CEW_Classic_Editor::init();
		CEW_Classic_Widgets::init();

		// Admin hooks
		if ( is_admin() ) {
			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		}

		// Activation and deactivation hooks
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
	}

	/**
	 * Load plugin textdomain
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'classic-editor-widgets',
			false,
			dirname( CEW_PLUGIN_BASENAME ) . '/languages'
		);
	}



	/**
	 * Admin initialization
	 */
	public function admin_init() {
		// Add admin notices if needed
		if ( ! $this->is_classic_editor_plugin_active() ) {
			add_action( 'admin_notices', array( $this, 'classic_editor_notice' ) );
		}
	}

	/**
	 * Admin scripts
	 */
	public function admin_scripts() {
		// Add any custom admin scripts if needed
		wp_enqueue_script(
			'classic-editor-widgets-admin',
			CEW_PLUGIN_URL . 'assets/js/admin.js',
			array( 'jquery' ),
			CEW_VERSION,
			true
		);
	}

	/**
	 * Check if classic editor plugin is active
	 *
	 * @return bool
	 */
	private function is_classic_editor_plugin_active() {
		return function_exists( 'classic_editor_init' );
	}

	/**
	 * Admin notice for classic editor plugin
	 */
	public function classic_editor_notice() {
		$message = sprintf(
			/* translators: %s: Classic Editor plugin URL */
			__( 'For the best experience with Classic Editor & Widgets, we recommend installing the <a href="%s" target="_blank">Classic Editor plugin</a>.', 'classic-editor-widgets' ),
			'https://wordpress.org/plugins/classic-editor/'
		);

		printf(
			'<div class="notice notice-info is-dismissible"><p>%s</p></div>',
			wp_kses_post( $message )
		);
	}

	/**
	 * Plugin activation
	 */
	public function activate() {
		// Set default options
		update_option( 'classic_editor_widgets_version', CEW_VERSION );

		// Flush rewrite rules
		flush_rewrite_rules();
	}

	/**
	 * Plugin deactivation
	 */
	public function deactivate() {
		// Clean up if needed
		delete_option( 'classic_editor_widgets_version' );

		// Flush rewrite rules
		flush_rewrite_rules();
	}
}

// Initialize the plugin
Classic_Editor_Widgets::get_instance();

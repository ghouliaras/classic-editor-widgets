<?php
/**
 * Plugin Name: Classic Editor & Widgets
 * Plugin URI: https://github.com/ghouliaras/classic-editor-widgets
 * Description: Enables the classic editor and classic widgets in WordPress. Restores the previous "classic" editor with TinyMCE and the old-style widget management screens.
 * Version: 1.1.0
 * Author: ghouliaras
 * Author URI: https://github.com/ghouliaras
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: classic-editor-widgets-1.1.0
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 *
 * @package ClassicEditorWidgets
 * @version 1.1.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants
define( 'CEW_VERSION', '1.1.0' );
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
	 * Admin initialization
	 */
	public function admin_init() {
		// Admin initialization tasks can be added here
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

<?php
/**
 * Classic Widgets Handler
 *
 * @package ClassicEditorWidgets
 * @version 1.1.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Classic Widgets Handler Class
 */
class CEW_Classic_Widgets {

	/**
	 * Initialize the classic widgets functionality
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'setup_classic_widgets' ) );
		add_action( 'admin_init', array( __CLASS__, 'admin_setup' ) );
		add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
		add_filter( 'use_widgets_block_editor', '__return_false' );
		add_action( 'widgets_init', array( __CLASS__, 'ensure_classic_widgets' ) );
	}

	/**
	 * Setup classic widgets
	 */
	public static function setup_classic_widgets() {
		// Remove block widget support
		remove_theme_support( 'widgets-block-editor' );
		
		// Ensure classic widgets are available
		add_action( 'widgets_init', array( __CLASS__, 'register_default_widgets' ) );
	}

	/**
	 * Admin setup
	 */
	public static function admin_setup() {
		// Add widget management styles
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_widget_styles' ) );
		
		// Add widget management scripts
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_widget_scripts' ) );
	}

	/**
	 * Ensure classic widgets are available
	 */
	public static function ensure_classic_widgets() {
		// This ensures that classic widgets are properly registered
		// WordPress core handles the actual widget registration
		
		// Add any custom widget registration here if needed
	}

	/**
	 * Register default widgets
	 */
	public static function register_default_widgets() {
		// Ensure all default WordPress widgets are available
		// This is handled by WordPress core, but we can add custom widgets here
	}

	/**
	 * Enqueue widget styles
	 */
	public static function enqueue_widget_styles() {
		$screen = get_current_screen();
		
		if ( $screen && in_array( $screen->base, array( 'widgets', 'customize' ) ) ) {
			wp_enqueue_style(
				'classic-editor-widgets-admin',
				CEW_PLUGIN_URL . 'assets/css/admin.css',
				array(),
				CEW_VERSION
			);
		}
	}

	/**
	 * Enqueue widget scripts
	 */
	public static function enqueue_widget_scripts() {
		$screen = get_current_screen();
		
		if ( $screen && in_array( $screen->base, array( 'widgets', 'customize' ) ) ) {
			wp_enqueue_script(
				'classic-editor-widgets-admin',
				CEW_PLUGIN_URL . 'assets/js/admin.js',
				array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-draggable', 'jquery-ui-droppable' ),
				CEW_VERSION,
				true
			);

			// Localize script
			wp_localize_script(
				'classic-editor-widgets-admin',
				'classicEditorWidgets',
				array(
					'nonce' => wp_create_nonce( 'classic_editor_widgets_nonce' ),
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'strings' => array(
						'widgetSaved' => __( 'Widget saved successfully.', 'classic-editor-widgets-1.1.0' ),
						'widgetError' => __( 'Error saving widget.', 'classic-editor-widgets-1.1.0' ),
					),
				)
			);
		}
	}

	/**
	 * Add widget management enhancements
	 */
	public static function enhance_widget_management() {
		// Add custom widget management features
		add_action( 'widgets_admin_page', array( __CLASS__, 'add_widget_management_info' ) );
	}

	/**
	 * Add widget management info
	 */
	public static function add_widget_management_info() {
		echo '<div class="notice notice-info inline">';
		echo '<p>' . esc_html__( 'You are using the classic widgets interface. All classic widgets and their settings are fully supported.', 'classic-editor-widgets-1.1.0' ) . '</p>';
		echo '</div>';
	}

	/**
	 * Disable block widgets in customizer
	 */
	public static function disable_block_widgets_customizer() {
		// Remove block widget support from customizer
		remove_theme_support( 'widgets-block-editor' );
		
		// Ensure classic widgets are used in customizer
		add_filter( 'customize_loaded_components', array( __CLASS__, 'filter_customize_components' ) );
	}

	/**
	 * Filter customize components
	 *
	 * @param array $components Components array.
	 * @return array
	 */
	public static function filter_customize_components( $components ) {
		// Ensure classic widgets are used
		return $components;
	}
}

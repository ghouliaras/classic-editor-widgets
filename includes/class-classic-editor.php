<?php
/**
 * Classic Editor Handler
 *
 * @package ClassicEditorWidgets
 * @version 1.1.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Classic Editor Handler Class
 */
class CEW_Classic_Editor {

	/**
	 * Initialize the classic editor functionality
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'setup_classic_editor' ) );
		add_action( 'admin_init', array( __CLASS__, 'admin_setup' ) );
		add_filter( 'use_block_editor_for_post', array( __CLASS__, 'disable_block_editor' ), 10, 2 );
		add_filter( 'use_block_editor_for_post_type', array( __CLASS__, 'disable_block_editor_for_post_type' ), 10, 2 );
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'remove_block_editor_assets' ) );
	}

	/**
	 * Setup classic editor
	 */
	public static function setup_classic_editor() {
		// Remove block editor support from post types
		$post_types = get_post_types( array( 'public' => true ) );
		
		foreach ( $post_types as $post_type ) {
			remove_post_type_support( $post_type, 'editor' );
			add_post_type_support( $post_type, 'editor' );
		}

		// Ensure TinyMCE is loaded
		add_filter( 'user_can_richedit', '__return_true' );
	}

	/**
	 * Admin setup
	 */
	public static function admin_setup() {
		// Add classic editor styles
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_classic_editor_styles' ) );
		
		// Add meta boxes support
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
	}

	/**
	 * Disable block editor for posts
	 *
	 * @param bool    $use_block_editor Whether to use block editor.
	 * @param WP_Post $post             Post object.
	 * @return bool
	 */
	public static function disable_block_editor( $use_block_editor, $post ) {
		// Always return false to disable block editor
		return false;
	}

	/**
	 * Disable block editor for post types
	 *
	 * @param bool   $use_block_editor Whether to use block editor.
	 * @param string $post_type        Post type.
	 * @return bool
	 */
	public static function disable_block_editor_for_post_type( $use_block_editor, $post_type ) {
		// Always return false to disable block editor
		return false;
	}

	/**
	 * Remove block editor assets
	 */
	public static function remove_block_editor_assets() {
		// Remove block editor scripts
		wp_dequeue_script( 'wp-block-library' );
		wp_dequeue_script( 'wp-format-library' );
		wp_dequeue_script( 'wp-editor' );
		wp_dequeue_script( 'wp-edit-post' );
		wp_dequeue_script( 'wp-edit-site' );
		wp_dequeue_script( 'wp-components' );
		wp_dequeue_script( 'wp-blocks' );
		wp_dequeue_script( 'wp-data' );
		wp_dequeue_script( 'wp-element' );
		wp_dequeue_script( 'wp-i18n' );
		wp_dequeue_script( 'wp-keycodes' );
		wp_dequeue_script( 'wp-url' );
		wp_dequeue_script( 'wp-viewport' );

		// Remove block editor styles
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-format-library' );
		wp_dequeue_style( 'wp-edit-post' );
		wp_dequeue_style( 'wp-edit-site' );
		wp_dequeue_style( 'wp-components' );
	}

	/**
	 * Enqueue classic editor styles
	 */
	public static function enqueue_classic_editor_styles() {
		$screen = get_current_screen();
		
		if ( $screen && in_array( $screen->base, array( 'post', 'post-new' ) ) ) {
			wp_enqueue_style(
				'classic-editor-widgets-admin',
				CEW_PLUGIN_URL . 'assets/css/admin.css',
				array(),
				CEW_VERSION
			);
		}
	}

	/**
	 * Add meta boxes
	 */
	public static function add_meta_boxes() {
		// Add custom meta boxes if needed
		add_meta_box(
			'classic-editor-info',
			__( 'Classic Editor Active', 'classic-editor-widgets-1.1.0' ),
			array( __CLASS__, 'meta_box_callback' ),
			'post',
			'side',
			'high'
		);
	}

	/**
	 * Meta box callback
	 *
	 * @param WP_Post $post Post object.
	 */
	public static function meta_box_callback( $post ) {
		echo '<p>' . esc_html__( 'You are using the classic editor with TinyMCE.', 'classic-editor-widgets-1.1.0' ) . '</p>';
		echo '<p><small>' . esc_html__( 'All classic editor plugins and meta boxes are supported.', 'classic-editor-widgets-1.1.0' ) . '</small></p>';
	}
}

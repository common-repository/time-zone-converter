<?php
/**
 * Timezone_Converter class
 *
 * @package USERLOGS
 */

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

/**
 * Class Timezone_Converter
 */
class Timezone_Converter {

	static $plugin_name         = 'Time Zone Converter';
	static $plugin_slug         = 'time-zone-converter';
	static $plugin_post_type    = 'time-zone-converter';

	public $error_message   = '';
	public $success_message = '';

	public function __construct() {

		add_action( 'init', [ $this, 'define_post_type' ] );

		if ( is_admin() ) {
			// Activation and Deactivation hooks
			register_activation_hook( __FILE__, [ $this, 'plugin_activation' ] );
			register_deactivation_hook( __FILE__, [ $this, 'plugin_deactivation' ] );
			add_action( 'admin_init', [ $this, 'do_activation_redirect' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts_and_styles' ] );
			add_action( 'admin_notices', [ $this, 'notice_welcome' ] );
			add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );

			$plugin = plugin_basename(__FILE__);
			add_filter( "plugin_action_links_$plugin", [ $this, 'plugin_settings_link' ] );
			add_action( 'save_post', [ $this, 'save_post_meta' ], 10, 2 );
		}

		// Add shortcode
		add_shortcode( 'time-zone-converter', [ $this, 'time_zone_converter_shortcode' ], 10, 1 );
	}

	/**
	 * Activate the plugin
	 */
	public function plugin_activation() {
		set_transient( 'tzc_activation_redirect_transient', true, 30 );
	}

	/**
	 * Deactivate the plugin
	 */
	public function plugin_deactivation() {
		// To Do:
	}

	public function do_activation_redirect() {
		// Bail if no activation redirect
		if ( ! get_transient( 'tzc_activation_redirect_transient' ) ) {
			return;
		}

		// Delete the redirect transient
		delete_transient( 'tzc_activation_redirect_transient' );

		// Bail if activating from network, or bulk
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
			return;
		}

		// Redirect to plugin page
		wp_safe_redirect( add_query_arg( array( 'post_type' => self::$plugin_post_type ), admin_url( 'edit.php' ) ) );
	}

	/**
	 * Sets up the custom post type
	 */
	public function define_post_type() {
		$labels = array(
			'name'               => self::$plugin_name,
			'singular_name'      => self::$plugin_name,
			'menu_name'          => self::$plugin_name,
			'name_admin_bar'     => self::$plugin_name,
			'add_new'            => 'Add New Converter',
			'add_new_item'       => 'Add ' . self::$plugin_name,
			'new_item'           => 'New ' . self::$plugin_name,
			'edit_item'          => 'Edit ' . self::$plugin_name,
			'view_item'          => 'View ' . self::$plugin_name,
			'all_items'          => 'View All Converters',
			'search_items'       => 'Search ' . self::$plugin_name,
			'parent_item_colon'  => 'Parent ' . self::$plugin_name,
			'not_found'          => 'No ' . self::$plugin_name . ' found.',
			'not_found_in_trash' => 'No ' . self::$plugin_name . ' found in Trash.',
		);
		$args   = array(
			'labels'            => $labels,
			'public'            => true,
			'supports'          => array( 'title' ),
			'menu_icon'         => 'dashicons-clock',
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_in_admin_bar' => false,
			'show_in_rest'      => false,
		);

		\register_post_type( self::$plugin_post_type, $args );
	}

	/**
	 * Plugin settings link.
	 * @param $links
	 * @return mixed
	 */
	public function plugin_settings_link( $links ) {
		$settings_link = sprintf( '<a href="edit.php?post_type=%s">Settings</a>', self::$plugin_post_type );

		array_unshift($links, $settings_link);
		return $links;
	}

	/**
	 * Enqueue CSS for ou plugin in admin area.
	 */
	public function enqueue_admin_scripts_and_styles(){

		// Enqueue these scripts only if we are on the plugin settings page.
		if ( self::is_plugin_page() ) {

			wp_enqueue_style('tzc_style', dirname( plugin_dir_url(__FILE__) ) . '/assets/css/styles.css');
			wp_enqueue_style('tzc_admin_style', dirname( plugin_dir_url(__FILE__) ) . '/assets/css/admin-styles.css');
			wp_enqueue_style('jquery-ui-datepicker', dirname( plugin_dir_url(__FILE__) ) . '/assets/css/jquery-ui.min.css');
			wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_script( 'tzc_admin_script', dirname( plugin_dir_url(__FILE__) ) . '/assets/js/admin-scripts.js', ['jquery', 'wp-color-picker', 'jquery-ui-datepicker'], '1.0.0', true );
			wp_enqueue_script( 'tzc-scripts', dirname( plugin_dir_url(__FILE__) ) . "/assets/js/scripts.js", ['jquery'], '', true );
		}
	}

	/**
	 * Display welcome messages
	 */
	public function notice_welcome() {
		if ( self::is_plugin_page() ) {
			if ( ! get_option( 'tzc_welcome' ) ) {
				?>
				<div class="notice notice-success is-dismissible">
					<p><?php echo __( 'Thank you for installing Time Zone Converter.', 'time-zone-converter' ) ?></p>
				</div>
				<?php
				update_option( 'tzc_welcome', 1 );
			}
		}
	}

	// Add the UI for meta box
	function add_meta_boxes() {
		if ( self::is_plugin_page() ) {
			add_meta_box( self::$plugin_post_type . 'converter-settings', 'Settings', [ $this, 'converter_settings' ], null, 'normal', 'high' );
		}
	}

	/**
	 * Settings
	 */
	public function converter_settings(){
		global $post;

		if ( empty( $post->ID ) ) {
			return;
		}

		$current_post_id = $post->ID;

		// if the form was submitted
		if ( isset( $_POST[ self::$plugin_slug . '-nonce' ] ) ) { // Input var okay.

			// Verify the nonce before proceeding.
			if ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ self::$plugin_slug . '-nonce' ] ) ), self::$plugin_slug ) ) { // Input var okay.

				echo '<div class="notice notice-success is-dismissible"><p>' . __( 'Success! data saved successfully.', 'time-zone-converter' ) . '</p></div>';

			} else {
				echo '<div class="notice notice-error is-dismissible"><p>' . __( 'Error: Invalid nonce, data not saved, please try again!', 'time-zone-converter' ) . '</p></div>';
			}
		}

		// Display the plugin page
		include_once( TIMEZONE_PLUGIN_DIR . '/templates/admin-panel.php' );
	}

	public function save_post_meta( $post_id, $post ) {
		if ( ! current_user_can( 'edit_posts', $post_id ) || wp_is_post_autosave( $post ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) {
			return;
		}

		// if the form was submitted
		if ( isset( $_POST[ self::$plugin_slug . '-nonce' ] ) ) { // Input var okay.

			// Verify the nonce before proceeding.
			if ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ self::$plugin_slug . '-nonce'] ) ), self::$plugin_slug ) ) { // Input var okay.

				$widget_settings = [
					'tzc_show_title1'           => ! empty( $_POST['tzc_show_title1'] ) ? sanitize_text_field( $_POST['tzc_show_title1'] ) : '',
					'tzc_title1'                => ! empty( $_POST['tzc_title1'] ) ? sanitize_text_field( $_POST['tzc_title1'] ) : '',
					'tzc_title1_font_size'      => ! empty( $_POST['tzc_title1_font_size'] ) ? sanitize_text_field( $_POST['tzc_title1_font_size'] ) : '',
					'tzc_title1_font_weight'    => ! empty( $_POST['tzc_title1_font_weight'] ) ? sanitize_text_field( $_POST['tzc_title1_font_weight'] ) : 'normal',
					'tzc_title1_font_color'     => ! empty( $_POST['tzc_title1_font_color'] ) ? sanitize_text_field( $_POST['tzc_title1_font_color'] ) : '',
					'tzc_title1_bgcolor'        => ! empty( $_POST['tzc_title1_bgcolor'] ) ? sanitize_text_field( $_POST['tzc_title1_bgcolor'] ) : '',
					'tzc_label1'                => ! empty( $_POST['tzc_label1'] ) ? sanitize_text_field( $_POST['tzc_label1'] ) : '',
					'tzc_label2'                => ! empty( $_POST['tzc_label2'] ) ? sanitize_text_field( $_POST['tzc_label2'] ) : '',
					'tzc_label3'                => ! empty( $_POST['tzc_label3'] ) ? sanitize_text_field( $_POST['tzc_label3'] ) : '',
					'tzc_label1_font_size'      => ! empty( $_POST['tzc_label1_font_size'] ) ? sanitize_text_field( $_POST['tzc_label1_font_size'] ) : '',
					'tzc_label1_font_weight'    => ! empty( $_POST['tzc_label1_font_weight'] ) ? sanitize_text_field( $_POST['tzc_label1_font_weight'] ) : '',
					'tzc_label1_font_color'     => ! empty( $_POST['tzc_label1_font_color'] ) ? sanitize_text_field( $_POST['tzc_label1_font_color'] ) : '',
					'tzc_date1_font_size'       => ! empty( $_POST['tzc_date1_font_size'] ) ? sanitize_text_field( $_POST['tzc_date1_font_size'] ) : '',
					'tzc_date1_font_weight'     => ! empty( $_POST['tzc_date1_font_weight'] ) ? sanitize_text_field( $_POST['tzc_date1_font_weight'] ) : 'normal',
					'tzc_date1_font_color'      => ! empty( $_POST['tzc_date1_font_color'] ) ? sanitize_text_field( $_POST['tzc_date1_font_color'] ) : '',
					'tzc_dropdown1_font_size'   => ! empty( $_POST['tzc_dropdown1_font_size'] ) ? sanitize_text_field( $_POST['tzc_dropdown1_font_size'] ) : '',
					'tzc_dropdown1_font_weight' => ! empty( $_POST['tzc_dropdown1_font_weight'] ) ? sanitize_text_field( $_POST['tzc_dropdown1_font_weight'] ) : 'normal',
					'tzc_dropdown1_font_color'  => ! empty( $_POST['tzc_dropdown1_font_color'] ) ? sanitize_text_field( $_POST['tzc_dropdown1_font_color'] ) : '',
					'tzc_dropdown2_font_size'   => ! empty( $_POST['tzc_dropdown2_font_size'] ) ? sanitize_text_field( $_POST['tzc_dropdown2_font_size'] ) : '',
					'tzc_dropdown2_font_weight' => ! empty( $_POST['tzc_dropdown2_font_weight'] ) ? sanitize_text_field( $_POST['tzc_dropdown2_font_weight'] ) : 'normal',
					'tzc_dropdown2_font_color'  => ! empty( $_POST['tzc_dropdown2_font_color'] ) ? sanitize_text_field( $_POST['tzc_dropdown2_font_color'] ) : '',
					'tzc_output_font_size'      => ! empty( $_POST['tzc_output_font_size'] ) ? sanitize_text_field( $_POST['tzc_output_font_size'] ) : '',
					'tzc_output_font_weight'    => ! empty( $_POST['tzc_output_font_weight'] ) ? sanitize_text_field( $_POST['tzc_output_font_weight'] ) : 'normal',
					'tzc_output_font_color'     => ! empty( $_POST['tzc_output_font_color'] ) ? sanitize_text_field( $_POST['tzc_output_font_color'] ) : '',
					'tzc_border1_color'         => ! empty( $_POST['tzc_border1_color'] ) ? sanitize_text_field( $_POST['tzc_border1_color'] ) : '',
					'tzc_show_b1'               => ! empty( $_POST['tzc_show_b1'] ) ? sanitize_text_field( $_POST['tzc_show_b1'] ) : '',
					'tzc_bgcolor1'              => ! empty( $_POST['tzc_bgcolor1'] ) ? sanitize_text_field( $_POST['tzc_bgcolor1'] ) : '',
				];

				update_post_meta( $post_id, 'settings', $widget_settings, false );
			}
		}
	}

	/**
	 * Shortcode
	 * @param $atts
	 * @return false|string
	 */
	public function time_zone_converter_shortcode( $atts ) {

		if ( empty( $atts['id'] ) ) {
			return '';
		}

		wp_enqueue_style('jquery-ui-datepicker', dirname( plugin_dir_url(__FILE__) ) . '/assets/css/jquery-ui.min.css');
		wp_enqueue_style( 'tzc-styles', dirname( plugin_dir_url( __FILE__ ) ) . "/assets/css/styles.css", [], '1.1' );
		wp_enqueue_script( 'tzc-scripts', dirname( plugin_dir_url( __FILE__ ) ) . "/assets/js/scripts.js", ['jquery', 'jquery-ui-datepicker'], '', true );

		$current_post_id = intval( $atts['id'] );

		ob_start();
		include( TIMEZONE_PLUGIN_DIR . '/templates/converter-template1.php' );
		return ob_get_clean();
	}

	/**
	 * Are we on our plugin page?
	 * @return bool
	 */
	public static function is_plugin_page() {
		global $post;

		if ( is_admin() ) {

			// if we are on post edit page.
			if ( ! empty( $post->post_type ) && self::$plugin_post_type === $post->post_type ) {
				return true;
			}

			// if our taxonomy exists in URL.
			if ( ! empty( $_GET['taxonomy'] ) && self::$taxonomy_ingredient === $_GET['taxonomy'] ) {
				return true;
			}

			// if our post type exists in URL.
			if ( ! empty( $_GET['post_type'] ) && ( self::$plugin_post_type === $_GET['post_type'] )  ) {
				return true;
			}
		}

		return false;
	}
}
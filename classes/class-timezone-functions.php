<?php
/**
 * Timezone Functions Class
 */

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

/**
 * Class Timezone_Functions
 */
class Timezone_Functions {

	/**
	 * Timezone_Controller constructor.
	 */
	public function __construct() {
		add_action( "wp_ajax_convert_time_zone", array( $this, "convert_time_zone") );
		add_action( "wp_ajax_nopriv_convert_time_zone", array( $this, "convert_time_zone") );
	}

	public function convert_time_zone() {

		if ( ! check_ajax_referer( 'tzc-nonce', 'security', false ) ) {
			wp_send_json_error( new WP_Error( '001', 'Error: security check failed.', 'Error' ) );
		}

		$tzc_hours   = ( ! empty( $_POST['tzc_hours'] ) ) ? sanitize_text_field( wp_unslash( $_POST['tzc_hours'] ) ) : ''; // Input var okay.
		$tzc_minutes = ( ! empty( $_POST['tzc_minutes'] ) ) ? sanitize_text_field( wp_unslash( $_POST['tzc_minutes'] ) ) : ''; // Input var okay.
		$tzc_ampm    = ( ! empty( $_POST['tzc_ampm'] ) ) ? sanitize_text_field( wp_unslash( $_POST['tzc_ampm'] ) ) : ''; // Input var okay.
		$tzc_date    = ( ! empty( $_POST['tzc_date'] ) ) ? sanitize_text_field( wp_unslash( $_POST['tzc_date'] ) ) : ''; // Input var okay.
		$tzc_from    = ( ! empty( $_POST['tzc_from'] ) ) ? sanitize_text_field( wp_unslash( $_POST['tzc_from'] ) ) : ''; // Input var okay.
		$tzc_to      = ( ! empty( $_POST['tzc_to'] ) ) ? sanitize_text_field( wp_unslash( $_POST['tzc_to'] ) ) : ''; // Input var okay.

		if ( 'PM' === $tzc_ampm && $tzc_hours <= 12 ) {
			$tzc_hours += 12;
		}

		if ( empty( $tzc_from ) || empty( $tzc_to ) ) {
			wp_send_json_error( new WP_Error( '002', 'Please select a valid time zone.', 'Error' ) );
		}
		if ( empty( $tzc_date ) ) {
			wp_send_json_error( new WP_Error( '003', 'Please select a valid date.', 'Error' ) );
		}

		try {
			date_default_timezone_set( $tzc_from );
		} catch (Exception $e) {
			wp_send_json_error( new WP_Error( '004', 'Please select a valid time zone.', 'Error' ) );
		}

		try {
			$new_time_zone = new DateTimeZone( $tzc_to );
		} catch (Exception $e) {
			wp_send_json_error( new WP_Error( '005', 'Please select a valid time zone.', 'Error' ) );
		}

		$input_date_format    = date( 'Y-m-d', strtotime( $tzc_date ) ). ' ' . $tzc_hours . ':' . $tzc_minutes . ':00';

		try {
			$datetime_object = new DateTime( $input_date_format );
		} catch (Exception $e) {
			wp_send_json_error( new WP_Error( '006', 'Please select a valid date and time.', 'Error' ) );
		}

		$datetime_object->setTimezone( $new_time_zone );

		if ( 24 === intval( $tzc_ampm ) ) {
			$input_date_format  = date( 'H:i, D M j, Y', strtotime( $input_date_format ) );
			$output_date_format = $datetime_object->format('H:i, D M j, Y');
		} else {
			$input_date_format  = date( 'h:i a, D M j, Y', strtotime( $input_date_format ) );
			$output_date_format = $datetime_object->format('h:i a, D M j, Y');
		}

		$output_text = "{$input_date_format} in '{$tzc_from}' converts to <br /> {$output_date_format} in '{$tzc_to}'";

		wp_send_json_success( $output_text );
	}

	public static function get_timezone_list() {
		static $timezones = null;

		if ( $timezones === null ) {
			$timezones   = [];
			$offsets     = [];
			$now         = new DateTime( 'now', new DateTimeZone( 'UTC' ) );
			$identifiers = DateTimeZone::listIdentifiers();

			foreach ( $identifiers as $timezone ) {
				$now->setTimezone( new DateTimeZone( $timezone ) );

				$offset    = $now->getOffset();
				$offsets[] = $offset;

				$timezones[ $timezone ] = self::format_timezone_name( $timezone );

			}

			array_multisort( $offsets, $timezones );
		}

		asort( $timezones );

		return $timezones;
	}

	public static function format_GMT_offset( $offset ) {
		$hours = intval( $offset / 3600 );
		$minutes = abs( intval( $offset % 3600 / 60 ) );
		return 'GMT' . ( $offset ? sprintf( '%+03d:%02d', $hours, $minutes ) : '' );
	}

	public static function format_timezone_name( $name ) {
		if ( strpos( $name, '/' ) === FALSE ) {
			return $name;
		}

		$name = strstr( $name, '/', false );
		$name = str_replace( '/', '', $name );
		$name = str_replace( '_', ' ', $name );
		$name = str_replace( 'St ', 'St. ', $name );
		return $name;
	}
}
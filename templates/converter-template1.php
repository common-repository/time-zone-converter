<?php
if ( empty( $current_post_id ) ) {
	return;
}

$widget_settings = get_post_meta( $current_post_id, 'settings', true );
$random_number   = rand( 100, 99999 );

$tzc_show_title1           = isset( $widget_settings['tzc_show_title1'] ) ? sanitize_text_field( $widget_settings['tzc_show_title1'] ) : 1;
$tzc_title1                = isset( $widget_settings['tzc_title1'] ) ? sanitize_text_field( $widget_settings['tzc_title1'] ) : 'Timezone Converter';
$tzc_title1_font_size      = isset( $widget_settings['tzc_title1_font_size'] ) ? sanitize_text_field( $widget_settings['tzc_title1_font_size'] ) : 16;
$tzc_title1_font_weight    = isset( $widget_settings['tzc_title1_font_weight'] ) ? sanitize_text_field( $widget_settings['tzc_title1_font_weight'] ) : 'normal';
$tzc_title1_font_color     = isset( $widget_settings['tzc_title1_font_color'] ) ? sanitize_text_field( $widget_settings['tzc_title1_font_color'] ) : '#000';
$tzc_title1_bgcolor        = isset( $widget_settings['tzc_title1_bgcolor'] ) ? sanitize_text_field( $widget_settings['tzc_title1_bgcolor'] ) : '#f0f0f0';
$tzc_label1                = isset( $widget_settings['tzc_label1'] ) ? sanitize_text_field( $widget_settings['tzc_label1'] ) : 'Select Date:';
$tzc_label2                = isset( $widget_settings['tzc_label2'] ) ? sanitize_text_field( $widget_settings['tzc_label2'] ) : 'Select Time:';
$tzc_label3                = isset( $widget_settings['tzc_label3'] ) ? sanitize_text_field( $widget_settings['tzc_label3'] ) : 'Convert From:';
$tzc_label1_font_size      = isset( $widget_settings['tzc_label1_font_size'] ) ? sanitize_text_field( $widget_settings['tzc_label1_font_size'] ) : 16;
$tzc_label1_font_weight    = isset( $widget_settings['tzc_label1_font_weight'] ) ? sanitize_text_field( $widget_settings['tzc_label1_font_weight'] ) : 'normal';
$tzc_label1_font_color     = isset( $widget_settings['tzc_label1_font_color'] ) ? sanitize_text_field( $widget_settings['tzc_label1_font_color'] ) : '#000';
$tzc_date1_font_size       = isset( $widget_settings['tzc_date1_font_size'] ) ? sanitize_text_field( $widget_settings['tzc_date1_font_size'] ) : 16;
$tzc_date1_font_weight     = isset( $widget_settings['tzc_date1_font_weight'] ) ? sanitize_text_field( $widget_settings['tzc_date1_font_weight'] ) : 'normal';
$tzc_date1_font_color      = isset( $widget_settings['tzc_date1_font_color'] ) ? sanitize_text_field( $widget_settings['tzc_date1_font_color'] ) : '#000';
$tzc_dropdown1_font_size   = isset( $widget_settings['tzc_dropdown1_font_size'] ) ? sanitize_text_field( $widget_settings['tzc_dropdown1_font_size'] ) : 16;
$tzc_dropdown1_font_weight = isset( $widget_settings['tzc_dropdown1_font_weight'] ) ? sanitize_text_field( $widget_settings['tzc_dropdown1_font_weight'] ) : 'normal';
$tzc_dropdown1_font_color  = isset( $widget_settings['tzc_dropdown1_font_color'] ) ? sanitize_text_field( $widget_settings['tzc_dropdown1_font_color'] ) : '#000';
$tzc_dropdown2_font_size   = isset( $widget_settings['tzc_dropdown2_font_size'] ) ? sanitize_text_field( $widget_settings['tzc_dropdown2_font_size'] ) : 16;
$tzc_dropdown2_font_weight = isset( $widget_settings['tzc_dropdown2_font_weight'] ) ? sanitize_text_field( $widget_settings['tzc_dropdown2_font_weight'] ) : 'normal';
$tzc_dropdown2_font_color  = isset( $widget_settings['tzc_dropdown2_font_color'] ) ? sanitize_text_field( $widget_settings['tzc_dropdown2_font_color'] ) : '#000';
$tzc_output_font_size      = isset( $widget_settings['tzc_output_font_size'] ) ? sanitize_text_field( $widget_settings['tzc_output_font_size'] ) : 16;
$tzc_output_font_weight    = isset( $widget_settings['tzc_output_font_weight'] ) ? sanitize_text_field( $widget_settings['tzc_output_font_weight'] ) : 'normal';
$tzc_output_font_color     = isset( $widget_settings['tzc_output_font_color'] ) ? sanitize_text_field( $widget_settings['tzc_output_font_color'] ) : '#000';
$tzc_show_b1               = isset( $widget_settings['tzc_show_b1'] ) ? sanitize_text_field( $widget_settings['tzc_show_b1'] ) : 1;
$tzc_border1_color         = isset( $widget_settings['tzc_border1_color'] ) ? sanitize_text_field( $widget_settings['tzc_border1_color'] ) : '#f0f0f0';
$tzc_bgcolor1              = isset( $widget_settings['tzc_bgcolor1'] ) ? sanitize_text_field( $widget_settings['tzc_bgcolor1'] ) : '#fff';

$header_css = "background-color:{$tzc_title1_bgcolor};color:{$tzc_title1_font_color};border-bottom:1px solid {$tzc_border1_color};font-size:{$tzc_title1_font_size}px;font-weight:{$tzc_title1_font_weight}";
$label_css  = "color:{$tzc_label1_font_color};font-size:{$tzc_label1_font_size}px;font-weight:{$tzc_label1_font_weight}";
$date_css   = "color:{$tzc_date1_font_color};font-size:{$tzc_date1_font_size}px;font-weight:{$tzc_date1_font_weight}";
$time_css   = "color:{$tzc_dropdown1_font_color};font-size:{$tzc_dropdown1_font_size}px;font-weight:{$tzc_dropdown1_font_weight}";
$zone_css   = "color:{$tzc_dropdown2_font_color};font-size:{$tzc_dropdown2_font_size}px;font-weight:{$tzc_dropdown2_font_weight}";
$output_css = "color:{$tzc_output_font_color};font-size:{$tzc_output_font_size}px;font-weight:{$tzc_output_font_weight}";
$button_css = "border:1px solid {$tzc_border1_color};";

if ( 1 !== intval( $tzc_show_title1 ) ) {
	$header_css = 'display:none';
}

if ( ! empty( $tzc_show_b1 ) && 1 === intval( $tzc_show_b1 ) ) {
	$layout_css = "border:1px solid {$tzc_border1_color}; background-color:{$tzc_bgcolor1};";
} else {
	$layout_css = "border:none; background-color:{$tzc_bgcolor1};";
}

$timezones = Timezone_Functions::get_timezone_list();
?>
<p>
	<input type="hidden" id="tzc-nonce-<?php echo esc_attr( $random_number ); ?>" value="<?php echo esc_attr( wp_create_nonce( 'tzc-nonce' ) ); ?>" />

	<div id="tzc-layout1" class="tzc-layout1" data-number="<?php echo esc_html( $random_number ); ?>" style="<?php echo esc_attr( $layout_css ); ?>">

		<div class="tzc-header1" style="<?php echo esc_attr( $header_css ); ?>">
			<?php echo esc_html( $tzc_title1 ); ?>
		</div>

		<div class="tzc-row">
			<div class="tzc-contents">
				<div class="tzc-label1" style="<?php echo esc_attr( $label_css ); ?>">
					<?php echo esc_html( $tzc_label1 ); ?>
				</div>
			</div>
		</div>

		<div class="tzc-row">
			<div class="tzc-contents">
				<div class="datetime-container">
					<select class="tzc-hours" id="tzc-hours-<?php echo esc_attr( $random_number ); ?>" style="<?php echo esc_attr( $time_css ); ?>">
						<?php
						for ( $i = 0; $i <= 12; $i ++ ) {
							printf( '<option value="%s">%s</option>', sprintf( "%02d", $i ), sprintf( "%02d", $i ) );
						}
						for ( $i = 13; $i <= 24; $i ++ ) {
							printf( '<option value="%s" class="tzc-24-hour-options">%s</option>', sprintf( "%02d", $i ), sprintf( "%02d", $i ) );
						}
						?>
					</select><select class="tzc-minutes" id="tzc-minutes-<?php echo esc_attr( $random_number ); ?>" style="<?php echo esc_attr( $time_css ); ?>">
						<?php
						for ( $i = 0; $i <= 60; $i ++ ) {
							printf( '<option value="%s">%s</option>', sprintf( "%02d", $i ), sprintf( "%02d", $i ) );
						}
						?>
					</select><select class="tzc-ampm" id="tzc-ampm-<?php echo esc_attr( $random_number ); ?>" onchange="tzc_update_hours( <?php echo esc_attr( $random_number ); ?> )" style="<?php echo esc_attr( $time_css ); ?>">
						<option value="AM">AM</option>
						<option value="PM">PM</option>
						<option value="24" selected="selected">24-Hours</option>
					</select>
					<input type="text" placeholder="mm/dd/yy" class="tzc-date" id="tzc-date-<?php echo esc_attr( $random_number ); ?>" style="<?php echo esc_attr( $date_css ); ?>">
				</div>
			</div>
		</div>

		<div class="tzc-row">
			<div class="tzc-contents">
				<div class="tzc-label2" style="<?php echo esc_attr( $label_css ); ?>">
					<?php echo esc_html( $tzc_label2 ); ?>
				</div>
			</div>
		</div>

		<div class="tzc-row">
			<div class="tzc-contents">
				<select class="tzc-from" id="tzc-from-<?php echo esc_attr( $random_number ); ?>" data-number="<?php echo esc_attr( $random_number ); ?>" style="<?php echo esc_attr( $zone_css ); ?>">
					<option value="">--Select--</option>
					<?php
					foreach ( $timezones as $timezone => $label ) {
						printf( '<option value="%s">%s</option>', $timezone, $label );
					}
					?>
				</select>
			</div>
		</div>

		<div class="tzc-row">
			<div class="tzc-contents">
				<div class="tzc-label3" style="<?php echo esc_attr( $label_css ); ?>">
					<?php echo esc_html( $tzc_label3 ); ?>
				</div>
			</div>
		</div>

		<div class="tzc-row">
			<div class="tzc-contents">
				<select class="tzc-to" id="tzc-to-<?php echo esc_attr( $random_number ); ?>" data-number="<?php echo esc_attr( $random_number ); ?>" style="<?php echo esc_attr( $zone_css ); ?>">
					<option value="">--Select--</option>
					<?php
					foreach ( $timezones as $timezone => $label ) {
						printf( '<option value="%s">%s</option>', $timezone, $label );
					}
					?>
				</select>
			</div>
		</div>

		<div class="tzc-row">
			<div class="tzc-contents">
				<div class="tzc-right tzc-message" id="tzc-message-<?php echo esc_attr( $random_number ); ?>" style="<?php echo esc_attr( $output_css ); ?>"></div>
			</div>
		</div>

		<div class="tzc-row">
			<div class="tzc-contents">
				<a class="button tzc-button" style="<?php echo esc_attr( $button_css ); ?>" onclick="tzc_reset( <?php echo intval( $random_number ); ?> );">Reset</a>
				<a class="button tzc-button" style="<?php echo esc_attr( $button_css ); ?>" onclick="tzc_convert( <?php echo intval( $random_number ); ?> );">Convert Time</a>
			</div>
		</div>
	</div>
	<div class="tzc-clear"></div>
</p>

<script language="JavaScript">
	if ( typeof tzc_plugin_url === 'undefined' ) {
		var tzc_plugin_url = '<?php echo plugins_url(); ?>';
		var tzc_ajax_url   = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
	}
</script>
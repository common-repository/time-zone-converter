<?php

$current_post_id = ! empty( $current_post_id ) ? $current_post_id : 0;
$widget_settings = [];

if ( $current_post_id ) {
	$widget_settings = get_post_meta( $current_post_id, 'settings', true );
}

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
?>

<div id="tzc-message"></div>

<p>
	<b>Use the following shortcode</b>
</p>

<input type="text" class="tzc-input" value="[time-zone-converter id=<?php echo esc_attr( $current_post_id ); ?>]" id="tzc-shortcode1">
<a class="button" onclick="tzc_copy_shortcode( 'tzc-shortcode1' )">Copy Shortcode</a>

<div class="wrap" id="tzc-admin">

	<div class="tzc-settings">
		<form method="post">

			<input type="hidden" name="<?php echo esc_attr( self::$plugin_slug . '-nonce' ); ?>" value="<?php echo esc_attr( wp_create_nonce( self::$plugin_slug ) ); ?>" />

			<div class="tzc-spacer-10"></div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Show Title</b></div>

				<div class="tzc-settings-right">
					<input type="radio" name="tzc_show_title1" value="1" id="tzc_show_title11" <?php echo checked( $tzc_show_title1, 1 ); ?>>
					<label for="tzc_show_title11">Show</label>

					<input type="radio" name="tzc_show_title1" value="2" id="tzc_show_title12" <?php echo checked( $tzc_show_title1, 2 ); ?>>
					<label for="tzc_show_title12">Hide</label>
				</div>

			</div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Title</b></div>

				<div class="tzc-settings-right">
					<input type="text" name="tzc_title1" id="tzc_title1" class="tzc-input" value="<?php echo esc_attr( $tzc_title1 ); ?>">
				</div>
			</div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Title Font Size/Color</b></div>

				<div class="tzc-settings-right">
					<select name="tzc_title1_font_size" id="tzc_title1_font_size">
						<optgroup label="Font Size">
							<?php
							for ( $i = 5; $i <= 50; $i++ ) {
								printf( "<option value='%s' %s>%s</option>", $i, selected( $i, $tzc_title1_font_size ), $i );
							}
							?>
						</optgroup>
					</select>

					<select name="tzc_title1_font_weight" id="tzc_title1_font_weight">
						<optgroup label="Font Weight">
							<option value="normal" <?php echo selected( 'normal', $tzc_title1_font_weight ); ?> >Normal</option>
							<option value="bold" <?php echo selected( 'bold', $tzc_title1_font_weight ); ?>>Bold</option>
						</optgroup>
					</select>

					<input type="text" name="tzc_title1_font_color" id="tzc_title1_font_color" class="tzc-input"  value="<?php echo esc_attr( $tzc_title1_font_color ); ?>" data-default-color="#000" />
				</div>
			</div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Title BG Color</b></div>

				<div class="tzc-settings-right">
					<input class="widefat" type="text" name="tzc_title1_bgcolor" id="tzc_title1_bgcolor" value="<?php echo esc_attr( $tzc_title1_bgcolor ); ?>" data-default-color="#f0f0f0" />
				</div>
			</div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Label 1</b></div>

				<div class="tzc-settings-right">
					<input type="text" name="tzc_label1" id="tzc_label1" class="tzc-input" value="<?php echo esc_attr( $tzc_label1 ); ?>">
				</div>
			</div>
			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Label 2</b></div>

				<div class="tzc-settings-right">
					<input type="text" name="tzc_label2" id="tzc_label2" class="tzc-input" value="<?php echo esc_attr( $tzc_label2 ); ?>">
				</div>
			</div>
			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Label 3</b></div>

				<div class="tzc-settings-right">
					<input type="text" name="tzc_label3" id="tzc_label3" class="tzc-input" value="<?php echo esc_attr( $tzc_label3 ); ?>">
				</div>
			</div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Label Font Size/Color</b></div>

				<div class="tzc-settings-right">
					<select name="tzc_label1_font_size" id="tzc_label1_font_size">
						<optgroup label="Font Size">
							<?php
							for ( $i = 5; $i <= 50; $i++ ) {
								printf( "<option value='%s' %s>%s</option>", $i, selected( $i, $tzc_label1_font_size ), $i );
							}
							?>
						</optgroup>
					</select>
					<select name="tzc_label1_font_weight" id="tzc_label1_font_weight">
						<optgroup label="Font Weight">
							<option value="normal" <?php echo selected( 'normal', $tzc_label1_font_weight ); ?>>Normal</option>
							<option value="bold" <?php echo selected( 'bold', $tzc_label1_font_weight ); ?>>Bold</option>
						</optgroup>
					</select>

					<input class="widefat" type="text" name="tzc_label1_font_color" id="tzc_label1_font_color" value="<?php echo esc_attr( $tzc_label1_font_color ); ?>" data-default-color="#000" />
				</div>
			</div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Date</b></div>

				<div class="tzc-settings-right">
					<select name="tzc_date1_font_size" id="tzc_date1_font_size">
						<optgroup label="Font Size">
							<?php
							for ( $i = 5; $i <= 50; $i++ ) {
								printf( "<option value='%s' %s>%s</option>", $i, selected( $i, $tzc_date1_font_size ), $i );
							}
							?>
						</optgroup>
					</select>

					<select name="tzc_date1_font_weight" id="tzc_date1_font_weight">
						<optgroup label="Font Weight">
							<option value="normal" <?php echo selected( 'normal', $tzc_date1_font_weight ); ?>>Normal</option>
							<option value="bold" <?php echo selected( 'bold', $tzc_date1_font_weight ); ?>>Bold</option>
						</optgroup>
					</select>

					<input class="widefat" type="text" name="tzc_date1_font_color" id="tzc_date1_font_color" value="<?php echo esc_attr( $tzc_date1_font_color ); ?>" data-default-color="#000" />
				</div>
			</div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Time Dropdown</b></div>

				<div class="tzc-settings-right">
					<select name="tzc_dropdown1_font_size" id="tzc_dropdown1_font_size">
						<optgroup label="Font Size">
							<?php
							for ( $i = 5; $i <= 50; $i++ ) {
								printf( "<option value='%s' %s>%s</option>", $i, selected( $i, $tzc_dropdown1_font_size ), $i );
							}
							?>
						</optgroup>
					</select>

					<select name="tzc_dropdown1_font_weight" id="tzc_dropdown1_font_weight">
						<optgroup label="Font Weight">
							<option value="normal" <?php echo selected( 'normal', $tzc_dropdown1_font_weight ); ?>>Normal</option>
							<option value="bold" <?php echo selected( 'bold', $tzc_dropdown1_font_weight ); ?>>Bold</option>
						</optgroup>
					</select>

					<input class="widefat" type="text" name="tzc_dropdown1_font_color" id="tzc_dropdown1_font_color" value="<?php echo esc_attr( $tzc_dropdown1_font_color ); ?>" data-default-color="#000" />
				</div>
			</div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Time Zone Dropdown</b></div>

				<div class="tzc-settings-right">
					<select name="tzc_dropdown2_font_size" id="tzc_dropdown2_font_size">
						<optgroup label="Font Size">
							<?php
							for ( $i = 5; $i <= 50; $i++ ) {
								printf( "<option value='%s' %s>%s</option>", $i, selected( $i, $tzc_dropdown2_font_size ), $i );
							}
							?>
						</optgroup>
					</select>

					<select name="tzc_dropdown2_font_weight" id="tzc_dropdown2_font_weight">
						<optgroup label="Font Weight">
							<option value="normal" <?php echo selected( 'normal', $tzc_dropdown2_font_weight ); ?>>Normal</option>
							<option value="bold" <?php echo selected( 'bold', $tzc_dropdown2_font_weight ); ?>>Bold</option>
						</optgroup>
					</select>

					<input class="widefat" type="text" name="tzc_dropdown2_font_color" id="tzc_dropdown2_font_color" value="<?php echo esc_attr( $tzc_dropdown2_font_color ); ?>" data-default-color="#000" />
				</div>
			</div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Output Text</b></div>

				<div class="tzc-settings-right">
					<select name="tzc_output_font_size" id="tzc_output_font_size">
						<optgroup label="Font Size">
							<?php
							for ( $i = 5; $i <= 50; $i++ ) {
								printf( "<option value='%s' %s>%s</option>", $i, selected( $i, $tzc_output_font_size ), $i );
							}
							?>
						</optgroup>
					</select>

					<select name="tzc_output_font_weight" id="tzc_output_font_weight">
						<optgroup label="Font Weight">
							<option value="normal" <?php echo selected( 'normal', $tzc_output_font_weight ); ?>>Normal</option>
							<option value="bold" <?php echo selected( 'bold', $tzc_output_font_weight ); ?>>Bold</option>
						</optgroup>
					</select>

					<input class="widefat" type="text" name="tzc_output_font_color" id="tzc_output_font_color" value="<?php echo esc_attr( $tzc_output_font_color ); ?>" data-default-color="#000" />
				</div>
			</div>


			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Show Borders</b></div>

				<div class="tzc-settings-right">
					<input type="radio" name="tzc_show_b1" value="1" id="tzc_show_b11" <?php echo checked( $tzc_show_b1, 1 ); ?>>
					<label for="tzc_show_b11">Show</label>

					<input type="radio" name="tzc_show_b1" value="2" id="tzc_show_b12" <?php echo checked( $tzc_show_b1, 2 ); ?>>
					<label for="tzc_show_b12">Hide</label>
				</div>

			</div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Border Color</b></div>

				<div class="tzc-settings-right">
					<input class="widefat" type="text" name="tzc_border1_color" id="tzc_border1_color" value="<?php echo esc_attr( $tzc_border1_color ); ?>" data-default-color="#f0f0f0" />
				</div>
			</div>

			<div class="tzc-settings-section">
				<div class="tzc-settings-left"><b>Background Color</b></div>

				<div class="tzc-settings-right">
					<input class="widefat" type="text" name="tzc_bgcolor1" id="tzc_bgcolor1" value="<?php echo esc_attr( $tzc_bgcolor1 ); ?>" data-default-color="#ffffff" />
				</div>
			</div>


			<div class="tzc-spacer-10"></div>

		</form>
	</div>
	<div class="tzc-preview">
		<b>Preview</b>
		<?php
		include_once __DIR__ . '/converter-template1.php';
		?>
	</div>



</div>




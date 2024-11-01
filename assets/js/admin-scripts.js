(function($) {
	$(document).on( 'click', '.tzc-tabs a', function() {
		// To Do
		return false;
	})

	// Template 1
	// -------------------------------------------------------------
	// Show Title
	$("#tzc_show_title11, #tzc_show_title12").click(function () {
		if ( $( "#tzc_show_title11" ).is( ':checked' ) ) {
			$('.tzc-header1').show();
			$(".tzc-header1").css('font-size', $('#tzc_title1_font_size').val() + 'px');
			$(".tzc-header1").css('font-weight', $("#tzc_title1_font_weight").val() );
			$('.tzc-header1').css('color', $('#tzc_title1_font_color').val() );
			$('.tzc-header1').css('background-color', $('#tzc_title1_bgcolor').val() );
		}
		if ( $( "#tzc_show_title12" ).is( ':checked' ) ) {
			$('.tzc-header1').hide();
		}
	});

	// Title Text
	$("#tzc_title1").on("input", function(){
		$(".tzc-header1").html($(this).val());
	});

	// Title Font Size
	$("#tzc_title1_font_size").change(function(){
		$(".tzc-header1").css('font-size', $(this).val() + 'px');
	});

	// Title Font Weight
	$("#tzc_title1_font_weight").change(function(){
		$(".tzc-header1").css('font-weight', $(this).val() );
	});

	// Title color
	$('#tzc_title1_font_color').wpColorPicker({
		change: function(event, ui){
			var theColor = ui.color.toString();
			$('.tzc-header1').css('color', theColor);
		}
	});

	// Title BG Color
	$('#tzc_title1_bgcolor').wpColorPicker({
		change: function(event, ui){
			var theColor = ui.color.toString();
			$('.tzc-header1').css('background-color', theColor);
		}
	});

	// Label Text
	$("#tzc_label1").on("input", function(){
		$(".tzc-label1").html($(this).val());
	});
	$("#tzc_label2").on("input", function(){
		$(".tzc-label2").html($(this).val());
	});
	$("#tzc_label3").on("input", function(){
		$(".tzc-label3").html($(this).val());
	});

	// Label Font Size
	$("#tzc_label1_font_size").change(function(){
		$(".tzc-label1, .tzc-label2, .tzc-label3").css('font-size', $(this).val() + 'px');
	});

	// Label Font Weight
	$("#tzc_label1_font_weight").change(function(){
		$(".tzc-label1, .tzc-label2, .tzc-label3").css('font-weight', $(this).val() );
	});

	// Label Color
	$('#tzc_label1_font_color').wpColorPicker({
		change: function(event, ui){
			var theColor = ui.color.toString();
			$(".tzc-label1, .tzc-label2, .tzc-label3").css('color', theColor);
		}
	});

	// Label Font Size
	$("#tzc_date1_font_size").change(function(){
		$(".tzc-date").css('font-size', $(this).val() + 'px');
	});

	// Label Font Weight
	$("#tzc_date1_font_weight").change(function(){
		$(".tzc-date").css('font-weight', $(this).val() );
	});

	// Label Color
	$('#tzc_date1_font_color').wpColorPicker({
		change: function(event, ui){
			var theColor = ui.color.toString();
			$(".tzc-date").css('color', theColor);
		}
	});

	// Dropdown Font Size
	$("#tzc_dropdown1_font_size").change(function(){
		$("#tzc-layout1 .tzc-hours, #tzc-layout1 .tzc-minutes, #tzc-layout1 .tzc-ampm ").css('font-size', $(this).val() + 'px');
	});
	$("#tzc_dropdown2_font_size").change(function(){
		$("#tzc-layout1 .tzc-from, #tzc-layout1 .tzc-to").css('font-size', $(this).val() + 'px');
	});

	// Dropdown Font Weight
	$("#tzc_dropdown1_font_weight").change(function(){
		$("#tzc-layout1 .tzc-hours, #tzc-layout1 .tzc-minutes, #tzc-layout1 .tzc-ampm ").css('font-weight', $(this).val() );
	});
	$("#tzc_dropdown2_font_weight").change(function(){
		$("#tzc-layout1 .tzc-from, #tzc-layout1 .tzc-to").css('font-weight', $(this).val() );
	});

	// Text Color
	$('#tzc_dropdown1_font_color').wpColorPicker({
		change: function(event, ui){
			var theColor = ui.color.toString();
			$("#tzc-layout1 .tzc-hours, #tzc-layout1 .tzc-minutes, #tzc-layout1 .tzc-ampm ").css('color', theColor);
		}
	});

	$('#tzc_dropdown2_font_color').wpColorPicker({
		change: function(event, ui){
			var theColor = ui.color.toString();
			$("#tzc-layout1 .tzc-from, #tzc-layout1 .tzc-to").css('color', theColor);
		}
	});

	// ---------
	$("#tzc_output_font_size").change(function(){
		$(".tzc-message").css('font-size', $(this).val() + 'px');
	});

	$("#tzc_output_font_weight").change(function(){
		$(".tzc-message").css('font-weight', $(this).val() );
	});

	// Text Color
	$('#tzc_output_font_color').wpColorPicker({
		change: function(event, ui){
			var theColor = ui.color.toString();
			$(".tzc-message").css('color', theColor);
		}
	});


	// ------------

	// Show Borders
	$("#tzc_show_b11, #tzc_show_b12").click(function () {
		if ( $( "#tzc_show_b11" ).is( ':checked' ) ) {
			$('#tzc-layout1').css( 'border', '1px solid ' + $('#tzc_border1_color').val() );
			$('.tzc-header1').css( 'border-bottom', '1px solid ' + $('#tzc_border1_color').val() );
		}
		if ( $( "#tzc_show_b12" ).is( ':checked' ) ) {
			$('#tzc-layout1').css('border', 'none');
			$('.tzc-header1').css('border', 'none');
		}
	});

	// Border Color
	$('#tzc_border1_color').wpColorPicker({
		change: function(event, ui){
			var theColor = ui.color.toString();
			$('#tzc-layout1').css('border', '1px solid '+ theColor);
			$('.tzc-header1').css('border-bottom', '1px solid '+ theColor);
		}
	});

	// BG Color
	$('#tzc_bgcolor1').wpColorPicker({
		change: function(event, ui){
			var theColor = ui.color.toString();
			$('#tzc-layout1').css('background-color', theColor);
		}
	});

})( jQuery );

function tzc_copy_shortcode( id ) {
	var copyText = document.getElementById( id );

	/* Select the text field */
	copyText.select();
	copyText.setSelectionRange(0, 99999); /* For mobile devices */

	/* Copy the text inside the text field */
	navigator.clipboard.writeText(copyText.value);

	jQuery('#tzc-message').html( '<div class="notice notice-success is-dismissible"><p>Shortcode Copied!</p></div>' ).show(500);
}


(function($) {
	$(document).ready(function() {
		$( ".tzc-date" ).datepicker({
			showOn: "button",
			buttonImage: tzc_plugin_url + "/time-zone-converter/assets/images/calendar_icon.png",
			buttonImageOnly: true,
			dateFormat: 'mm/dd/yy',
			buttonText: "Select date"
		});

		$('.tzc-layout1').each(function(i, obj) {
			tzc_reset( $(this).data('number') );
		});
	});

})(jQuery);


function tzc_is_empty( value ){
	return ( typeof value === 'undefined' || value === '' || value === null || value === '0' || value === 0 || value.length === 0 );
}

function tzc_reset( random_number ) {

	var now     = new Date();
	var date    = (((now.getMonth()+1) < 10)?"0":"") + (now.getMonth()+1) + "/" + ((now.getDate() < 10)?"0":"") + now.getDate() + "/" + now.getFullYear();
	var hours   = now.getHours();
	var minutes = now.getMinutes();

	hours = hours > 12 ? hours - 12 : hours;
	hours = hours < 10 ? "0" + hours : hours;
	minutes = minutes < 10 ? "0" + minutes : minutes;

	jQuery( '#tzc-hours-' + random_number ).val( hours );
	jQuery( '#tzc-minutes-' + random_number ).val( minutes );
	jQuery( '#tzc-date-' + random_number ).val( date );
	jQuery( '#tzc-from-' + random_number ).val( '' );
	jQuery( '#tzc-to-' + random_number ).val( '' );

	if ( now.getHours() >= 12 ) {
		jQuery( '#tzc-ampm-' + random_number ).val( 'PM' );
	} else {
		jQuery( '#tzc-ampm-' + random_number ).val( 'AM' );
	}
}

function tzc_update_hours( random_number ) {
	if ( '24' === jQuery( '#tzc-ampm-' + random_number ).val() ) {
		jQuery( '.tzc-24-hour-options' ).show();
	}  else {
		jQuery( '.tzc-24-hour-options' ).hide();
		jQuery( '#tzc-hours-' + random_number ).val( '00' );
	}
}

function tzc_convert( random_number ) {

	if ( typeof tzc_ajax_url === 'undefined' ) {
		return;
	}

	var nonce   = jQuery( '#tzc-nonce-' + random_number ).val();
	var hours   = jQuery( '#tzc-hours-' + random_number ).val();
	var minutes = jQuery( '#tzc-minutes-' + random_number ).val();
	var ampm    = jQuery( '#tzc-ampm-' + random_number ).val();
	var date    = jQuery( '#tzc-date-' + random_number ).val();
	var from    = jQuery( '#tzc-from-' + random_number ).val();
	var to      = jQuery( '#tzc-to-' + random_number ).val();

	if ( tzc_is_empty( date ) ) {
		jQuery( '#tzc-message-' + random_number ).html( "Please select a date." );
		return;
	}
	if ( tzc_is_empty( from ) ) {
		jQuery( '#tzc-message-' + random_number ).html( "Please select a timezone." );
		return;
	}
	if ( tzc_is_empty( to ) ) {
		jQuery( '#tzc-message-' + random_number ).html( "Please select a timezone." );
		return;
	}

	jQuery.ajax(
		{
			url: tzc_ajax_url + '?v=1',
			dataType: 'json',
			type: "POST",
			data: {
				action: 'convert_time_zone',
				tzc_hours: jQuery( '#tzc-hours-' + random_number ).val(),
				tzc_minutes: jQuery( '#tzc-minutes-' + random_number ).val(),
				tzc_ampm: jQuery( '#tzc-ampm-' + random_number ).val(),
				tzc_date: jQuery( '#tzc-date-' + random_number ).val(),
				tzc_from: jQuery( '#tzc-from-' + random_number ).val(),
				tzc_to: jQuery( '#tzc-to-' + random_number ).val(),
				security: nonce
			},
			success: function( results ) {
				if ( results.success ) {
					jQuery( '#tzc-message-' + random_number ).html( results.data );
				} else {
					jQuery( '#tzc-message-' + random_number ).html( results.data[0].message );
				}
			},
			error: function(data) {
				jQuery( '#tzc-message-' + random_number ).html( "There was an error processing your request! Please try again later!" );
			}
		}
	);
}

import jQuery from 'jquery';

jQuery( function( $ ) {
	$( '[type="checkbox"]' ).on( 'click', function() {
		const that = this as HTMLInputElement
		if ( that.checked ) {
			$( that ).val( 'on' );
		} else {
			$( that ).removeAttr( 'value' );
			$( that ).removeAttr( 'checked' );
		}
	} );
} );
/*
	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License
*/

'use strict';

;( function( $, window, document, undefined )
{
	$( '.inputfile' ).each( function()
	{
		var $input	 = $( this ),
			$label	 = $input.next( 'label' ),
			labelVal = $label.html();

		$input.on( 'change', function( e )
		{
			var fileName = '';

			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else if( e.target.value )
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				$label.find( 'span' ).html( fileName );
			else
				$label.html( labelVal );
		});

		// Firefox bug fix
		$input
		.on( 'focus', function(){ $input.addClass( 'has-focus' ); })
		.on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
	});
})( jQuery, window, document );

$(document).ready(function() {
    $('#supplier').DataTable();
		$('#buyer').DataTable();

		$('.get_email').click(function(){
			var email = $(this).html();

			$('#client_email').html(email);
			//append email to buttons
			$('#contract_t').attr('href','/get_message/contract/' + email );
			$('#loi_t').attr('href','/get_message/loi/' + email );
			$('#custom_t').attr('href','/get_message/custom/' + email );
			$('#pol_t').attr('href','/get_message/pol/' + email );
			$('#pof_t').attr('href','/get_message/pof/' + email );
		})

		$('.delete_product').click(function(){
			var id = $(this).attr('id');
			$('#delete_product').attr('href','/delete_product/'+id);
		})
} );

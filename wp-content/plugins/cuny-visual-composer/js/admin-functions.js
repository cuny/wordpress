jQuery(function( $ ) {
	if ( cuny_vc_params.disable_sortable == 'true' ) {
		setTimeout( function(){ $( '.ui-sortable' ).not('.wpb_column_container').sortable( 'disable' ); }, 3000 );
	}
});
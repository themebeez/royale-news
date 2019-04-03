// Customizer JS

( function( $ ) {

	jQuery( document ).ready( function() {
		//Chosen JS
	    $( ".hs-chosen-select" ).chosen( {
	        width: "100%"
	    } );
	} );

} ) ( jQuery );



// Upsell JS

( function( api ) {

	api.sectionConstructor['upsell'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
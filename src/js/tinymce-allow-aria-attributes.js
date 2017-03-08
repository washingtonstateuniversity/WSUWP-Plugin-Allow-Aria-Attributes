( function( tinymce ) {
	tinymce.PluginManager.add( "allow_aria_attributes", function( editor ) {
		editor.on( "preInit", function() {
			var validElementsSetting = "";

			// Loop through each existing element to create a long list of new valid attributes.
			Object.keys( editor.schema.elements ).forEach( function( key ) {
				validElementsSetting += key + "[aria-describedby|aria-hidden|aria-label|aria-labelledby],";
			} );

			// Merge our list of valid element attributes with the existing configuration.
			editor.schema.addValidElements( validElementsSetting );
		} );
	} );
}( window.tinymce ) );

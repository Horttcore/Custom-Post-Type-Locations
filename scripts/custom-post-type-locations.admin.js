jQuery(document).ready(function() {

	Plugin = {

		init:function(){

			// Cache
			Plugin.street = jQuery('#location-street');
			Plugin.streetnumber = jQuery('#location-street-number');
			Plugin.zip = jQuery('#location-zip');
			Plugin.city = jQuery('#location-city');
			Plugin.country = jQuery('#location-country');
			Plugin.latitude = jQuery('#location-latitude');
			Plugin.longitude = jQuery('#location-longitude');
			Plugin.getLatLngButton = jQuery('.get-lat-long');

			// Bootstrap
			Plugin.bindEvents();
		},

		bindEvents:function(){

			// Location
			Plugin.getLatLngButton.click(function(e){
				e.preventDefault();
				Plugin.getLatLng();
			});

		},

		getLatLng:function(){

			var data = {
				action: 'get_location_lat_long',
				street: Plugin.street.val(),
				streetnumber: Plugin.streetnumber.val(),
				zip: Plugin.zip.val(),
				city: Plugin.city.val(),
				country: Plugin.country.val(),
			};

			jQuery.post(ajaxurl, data, function( response ){
				Plugin.latitude.val( response.latitude );
				Plugin.longitude.val( response.longitude );
			}, 'json' );

		},

	};

	Plugin.init();

});

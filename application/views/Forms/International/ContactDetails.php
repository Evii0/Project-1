<div class="containerContainer" id="contactDetails">
	<h1 class="page-header" id="title">Contact details</h1>
	<div class="contentContainer">
		<div class="">
			<p class="help-block col-lg-offset-2 col-lg-10">Please complete this section with your contact details. All fields marked with an * are compulsory</p>

			<form id="contactForm" class="form-horizontal" action="form.php?form=ContactDetails" method="post">
		  	<div class="form-group">
					<label for="autocomplete" class="col-lg-2 control-label">Address Search</label>
					<div class="col-lg-10">
			  		<input type="text" class="form-control" name="autocomplete" id="autocomplete" placeholder="Search for your address here..." />
					</div>
		  	</div>
		  	<p class="help-block col-lg-offset-2 col-lg-10">If google cannot correctly find your address please type it in below</p>

				<script>
      		var placeSearch;
      		var componentForm = {
        		street_number: 'short_name',
        		route: 'long_name',
        		locality: 'long_name',
        		administrative_area_level_1: 'short_name',
        		country: 'long_name',
        		postal_code: 'short_name'
      		};

      		function initAutocomplete() {
        		// Create the autocomplete object, restricting the search to geographical
        		// location types.
        		var autocomplete = new google.maps.places.Autocomplete(
            	/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            	{types: ['geocode']});

        		// When the user selects an address from the dropdown, populate the address
        		// fields in the form.
        		//autocomplete.addListener('place_changed', fillInAddress(autocomplete));
						google.maps.event.addListener(autocomplete, 'place_changed',
               	function () {
                	fillInAddress(autocomplete);
            	});
      		}

      		function fillInAddress(ac) {
        		// Get the place details from the autocomplete object.
        		var place = ac.getPlace();

        		for (var component in componentForm) {
		  				document.getElementById(component).value = '';
          		document.getElementById(component).disabled = false;
        		}

        		// Get each component of the address from the place details
        		// and fill the corresponding field on the form.
						if(place.address_components == null) {
							alert("Sorry, we could not format your address properly\nPlease type it directly into the form");
						} else {
							for (var i = 0; i < place.address_components.length; i++) {
			  				var addressType = place.address_components[i].types[0];
			  				if (componentForm[addressType]) {
									var val = place.address_components[i][componentForm[addressType]];
									document.getElementById(addressType).value = val;
			  				}
							}
						}
      		}
    		</script>
    		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKRhNKbQ5FenPajhUyvBBemUoOwXKsTpE&libraries=places&callback=initAutocomplete" async defer></script>

				<div class="form-group">
					<label for="street_number" class="col-lg-2 control-label">Street Number</label>
					<div class="col-lg-10">
			  		<input type="text" class="form-control" name="streetNum" id="streetNum" placeholder="Street number" value=""  />
					</div>
				</div>
				<div class="form-group">
					<label for="route" class="col-lg-2 control-label">Street Name *</label>
					<div class="col-lg-10">
			  		<input type="text" class="form-control" name="streetName" id="streetName" placeholder="Street address" value="" />
					</div>
				</div>

				<div class="form-group">
					<label for="locality" class="col-lg-2 control-label">City / Town *</label>
					<div class="col-lg-10">
			  		<input type="text" class="form-control" name="city" id="city" placeholder="City / Town" value="" />
					</div>
				</div>

				<div class="form-group">
					<label for="region" class="col-lg-2 control-label">Region</label>
					<div class="col-lg-10">
			  		<input type="text" class="form-control" name="region" id="region" placeholder="Region" value="" />
					</div>
				</div>

				<div class="form-group">
					<label for="postal_code" class="col-lg-2 control-label">Post code *</label>
					<div class="col-lg-10">
			  		<input type="text" class="form-control" name="postCode" id="postCode" placeholder="Post code" value="" />
					</div>
				</div>

				<div class="form-group">
					<label for="postal_code" class="col-lg-2 control-label">Country *</label>
					<div class="col-lg-10">
			  		<input type="text" class="form-control" name="country" id="country" placeholder="Country" value="" />
					</div>
				</div>

				<p class="help-block col-lg-offset-2 col-lg-10">Ensure all phone numbers have the country code (select with the arrow below) and then enter in both the area code and phone number</p>
				<p class="help-block col-lg-offset-2 col-lg-10">Select<br />Country</p>
				<div class="form-group">
					<label for="workPhone" class="col-lg-2 control-label">Work phone</label>
					<div class="col-lg-10">
			  		<input type="text" class="form-control" id="workPhone" name="workPhone" value="" />
					</div>
				</div>

				<div class="form-group">
					<label for="homePhone" class="col-lg-2 control-label">Home phone</label>
					<div class="col-lg-10">
			  		<input type="text" class="form-control" id="homePhone" name="homePhone" value="" />
					</div>
				</div>

				<div class="form-group">
					<label for="mobilePhone" class="col-lg-2 control-label">Mobile *</label>
					<div class="col-lg-10">
			  		<input type="text" class="form-control" id="mobilePhone" name="mobilePhone" value="" />
					</div>
				</div>

				<div class="form-group">
					<label for="emailAddress" class="col-lg-2 control-label">Email address *</label>
					<div class="col-lg-10">
			  		<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="" />
					</div>
				</div>

				<script src="../dist/js/intlTelInput.js"></script>

  			<script>
  				var workPhone = $("#workPhone");
  				var homePhone = $("#homePhone");
  				var mobilePhone = $("#mobilePhone");

					workPhone.intlTelInput({
      			geoIpLookup: function(callback) {
      				$.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        				var countryCode = (resp && resp.country) ? resp.country : "";
        				callback(countryCode);
      				});
      			},
      			initialCountry: "auto",
      			preferredCountries: ['nz', 'za'],
      			utilsScript: "../dist/js/utils.js"
  				});
   				homePhone.intlTelInput({
      			geoIpLookup: function(callback) {
      				$.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        				var countryCode = (resp && resp.country) ? resp.country : "";
        				callback(countryCode);
      				});
      			},
      			initialCountry: "auto",
      			preferredCountries: ['nz', 'za'],
      			utilsScript: "../dist/js/utils.js"
  				});
   				mobilePhone.intlTelInput({
      			geoIpLookup: function(callback) {
      				$.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        				var countryCode = (resp && resp.country) ? resp.country : "";
        				callback(countryCode);
      				});
      			},
      			initialCountry: "auto",
      			preferredCountries: ['nz', 'za'],
      			utilsScript: "../dist/js/utils.js"
  				});

					$("form").submit(function() {
						workPhone.val(workPhone.intlTelInput("getNumber"));
						homePhone.val(homePhone.intlTelInput("getNumber"));
						mobilePhone.val(mobilePhone.intlTelInput("getNumber"));
					});
				</script>

				<div class="input-group col-lg-offset-2 col-lg-10">
					<button class="btn btn-default" type="submit">Save Form</button>
				</div>
			</form>
		</div>
	</div>
</div>

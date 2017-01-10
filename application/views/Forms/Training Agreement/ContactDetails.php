<div class="containerContainer" id="contactDetails">
    <h1 class="page-header" id="title">Contact details</h1>
    <div class="contentContainer">
        
			<div class="panel-body">
			<p class="help-block col-lg-offset-2 col-lg-10">Please complete this section with your contact details. All fields marked with an * are compulsory</p>

			<form id="contactForm" class="form-horizontal" action="form.php?form=ContactDetails" method="post">
			  
			  
			  <div class="form-group">
					<label for="postalAddress" class="col-lg-2 control-label">Address*</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="postalAddress" id="postalAddress" placeholder="Address" />
					</div>
				  </div>
			  <p class="help-block col-lg-offset-2 col-lg-10">If google cannot correctly find your address please type it in below</p>
			      <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
                      
                        //NOTE: the auto complete for this page is declared in the employerInformation file
                        //NOTE: Yes it should be moved somewhere sensible
                        //NOTE: Yes I know I'm lazy.
                        //NOTE: on the plus side it works :)

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = postalAddress.getPlace();

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKRhNKbQ5FenPajhUyvBBemUoOwXKsTpE&libraries=places&callback=initAutocomplete"
        async defer></script>

			  
			  
			  
			  
			  
			  <div class="form-group">
				<label for="street_number" class="col-lg-2 control-label">Street Number</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" name="street_number" id="street_number" placeholder="Street number"  />
				</div>
			  </div>
			  <div class="form-group">
				<label for="route" class="col-lg-2 control-label">Street Name *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" name="route" id="route" placeholder="Street address" />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="locality" class="col-lg-2 control-label">City / Town *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" name="locality" id="locality" placeholder="City / Town" />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="region" class="col-lg-2 control-label">Region</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" name="administrative_area_level_1" id="administrative_area_level_1" placeholder="Region" />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="postal_code" class="col-lg-2 control-label">Post code *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Post code" />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="postal_code" class="col-lg-2 control-label">Country *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" name="country" id="country" placeholder="Country" />
				</div>
			  </div>
			  
			  <p class="help-block col-lg-offset-2 col-lg-10">Ensure all phone numbers have the country code (select with the arrow below) and then enter in both the area code and phone number</p>
			  <p class="help-block col-lg-offset-2 col-lg-10">Select<br />Country</p>
			  <div class="form-group">
				<label for="workPhone" class="col-lg-2 control-label">Work phone</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" id="workPhone" name="workPhone"/>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="homePhone" class="col-lg-2 control-label">Home phone</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" id="homePhone" name="homePhone" />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="mobilePhone" class="col-lg-2 control-label">Mobile *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" id="mobilePhone" name="mobilePhone" id="mobile"/>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="emailAddress" class="col-lg-2 control-label">Email address *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" name="emailAddress" placeholder="Email" id="email"/>
				</div>
			  </div>  				 				
				<div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" id="nextButton" type="button" onclick="contactDetails()">Next Section</button></div>
				</form>
			</div>
    </div>
</div>
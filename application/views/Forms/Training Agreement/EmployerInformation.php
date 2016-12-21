<div class="containerContainer" id="employerInfo">
    <h1 class="page-header">Employer Information</h1>
    <div class="contentContainer">
        <form class="form-horizontal" action="form.php?form=EmployerInformation" method="post">
				  <div class="form-group">
					<label for="companyName" class="col-lg-2 control-label">Company name*</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="companyName" placeholder="Company name" id="companyName" />
					</div>
				  </div>
				  <div class="form-group">
					<label for="tradingAs" class="col-lg-2 control-label">Trading as</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" id="tradingAs" placeholder="Trading as" />
					</div>
				  </div>
				  <div class="form-group">
					<label for="postalAddress" class="col-lg-2 control-label">Postal address*</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" id="postalAddress" id="postalAddress" placeholder="Postal address" />
					</div>
				  </div>
  
				  <script type="text/javascript">
				  function copyAddress() {
					  document.getElementById("streetAddress").value = document.getElementById("postalAddress").value;
				  }
				  </script>
            
				  <p class="help-block col-lg-offset-2 col-lg-10"><a href="#" id="copyAddress" onclick="copyAddress()">Copy postal address to street address</a></p>
				  <div class="form-group">
					<label for="streetAddress" class="col-lg-2 control-label">Street address*</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="streetAddress" id="streetAddress" placeholder="Street address" />
					</div>
				  </div>
				  
				  	<script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, postalAddress, streetAddress;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };
			  
      function initAutocomplete() {
        // Create the postalAddress object, restricting the search to geographical
        // location types.
        postalAddress = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('postalAddress')),
            {types: ['geocode'], componentRestrictions: {country: "nz"}});
		streetAddress = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('streetAddress')),
            {types: ['geocode'], componentRestrictions: {country: "nz"}});
      }

    </script>
				  <div class="form-group">
					<label for="mainContact" class="col-lg-2 control-label">Employer contact name*</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" id="mainContact" placeholder="Main contact name" />
					</div>
				  </div>
				  <div class="form-group">
					<label for="contactDDI" class="col-lg-2 control-label">Employer contact DDI*</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" id="contactDDI" placeholder="Main contact DDI"  />
					</div>
				  </div>
				  <div class="form-group">
					<label for="contactMobile" class="col-lg-2 control-label">Employer contact mobile</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" id="contactMobile" placeholder="Main contact mobile"  />
					</div>
				  </div>
				  <div class="form-group">
					<label for="contactEmail" class="col-lg-2 control-label">Employer contact email*</label>
					<div class="col-lg-10">
					  <input type="email" class="form-control" id="contactEmail" placeholder="Main contact email" />
					</div>
                  </div>
				    <div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" id="nextButton" type="button" onclick="employerInfo()">Next Section</button></div>
				</form>
        
    </div>
</div>
<div class="containerContainer" id="employerInfo">
    <h1 class="page-header">Employer Information</h1>
    <div class="contentContainer">
        <form class="form-horizontal" action="form.php?form=EmployerInformation" method="post">
				  <div class="form-group <?php if (isset($companyNameError)) print "has-error"; ?>">
					<label for="companyName" class="col-lg-2 control-label">Company name*</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="companyName" placeholder="Company name" />
					</div>
				  </div>
				  <div class="form-group">
					<label for="tradingAs" class="col-lg-2 control-label">Trading as</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="tradingAs" placeholder="Trading as" />
					</div>
				  </div>
				  <div class="form-group">
					<label for="postalAddress" class="col-lg-2 control-label">Postal address*</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="postalAddress" id="postalAddress" placeholder="Postal address" />
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
				  <div class="form-group <?php if (isset($mainContactError)) print "has-error"; ?>">
					<label for="mainContact" class="col-lg-2 control-label">Employer contact name*</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="mainContact" placeholder="Main contact name" value="<?php if(isset($mainContact)) {print $mainContact;} ?>" />
					</div>
				  </div>
				  <div class="form-group <?php if (isset($contactDDIError)) print "has-error"; ?>">
					<label for="contactDDI" class="col-lg-2 control-label">Employer contact DDI*</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="contactDDI" placeholder="Main contact DDI" value="<?php if(isset($contactDDI)) {print $contactDDI;} ?>" />
					</div>
				  </div>
				  <div class="form-group <?php if (isset($contactMobileError)) print "has-error"; ?>">
					<label for="contactMobile" class="col-lg-2 control-label">Employer contact mobile</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="contactMobile" placeholder="Main contact mobile" value="<?php if(isset($contactMobile)) {print $contactMobile;} ?>" />
					</div>
				  </div>
				  <div class="form-group <?php if (isset($contactEmailError)) print "has-error"; ?>">
					<label for="contactEmail" class="col-lg-2 control-label">Employer contact email*</label>
					<div class="col-lg-10">
					  <input type="email" class="form-control" name="contactEmail" placeholder="Main contact email" value="<?php if(isset($contactEmail)) {print $contactEmail;} ?>" />
					</div>
				  </div>
				  <?php if(isset($formError)) { ?>
				  <div class="alert alert-warning col-lg-offset-2 col-lg-10">
					Form saved but not completed. Please ensure you have filled in all fields <?php if(isset($emailError)) print "and that Contact email is a valid address"; ?>
				  </div>
				  <?php } ?>
				  <?php if(!isset($formError) && isset($emailError)) { ?>
				  <div class="alert alert-warning col-lg-offset-2 col-lg-10">
					Form saved but not completed. Please enter a valid email address
				  </div>
				  <?php } ?>
				    <div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" id="nextButton" type="button" onclick="employerInfo()">Next Section</button></div>
				</form>
        
    </div>
</div>
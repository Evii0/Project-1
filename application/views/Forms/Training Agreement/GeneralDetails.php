<div class="containerContainer" id="generalDetails">
    <h1 class="page-header">Trainee Information</h1>
    <div class="contentContainer">
        <form class="form-horizontal" action="form.php?form=TraineeInformation" method="post" enctype="multipart/form-data">
            <div class="form-group">
				<label for="primaryEthnicity" class="col-lg-2 control-label">Title *</label>
				<div class="col-lg-10">
				  <select class="form-control" name="salutation" id="salutation">
                                      <option value="Mr">Mr</option>
                                      <option value="Mrs">Mrs</option>
                                      <option value="Miss">Miss</option>
                                      <option value="Ms">Ms</option>
                                      <option value="Dr">Dr</option>
				  </select>
				</div>
			  </div>
    
    <div class="form-group">
			  <p class="help-block col-lg-offset-2 col-lg-10">Enter your <b><i><u>full legal name</u></i></b> as it appears on your birth certificate or passport</p>
				<label for="traineeFirstName" class="col-lg-2 control-label">First name *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" id="traineeFirstName" placeholder="First name" />
				</div>
			  </div>
			  <div class="form-group">
				<label for="traineeMiddleName" class="col-lg-2 control-label">Middle name</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" id="traineeMiddleName" placeholder="Middle name" />
				</div>
			  </div>
			  <div class="form-group">
				<label for="traineeLastName" class="col-lg-2 control-label">Last name *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" id="traineeLastName" placeholder="Last name" />
				</div>
			  </div>
            
            
            <div class="form-group">
				<label for="traineePreferredName" class="col-lg-2 control-label">Preferred name</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" id="traineePreferredName" placeholder="Preferred name" />
				</div>
			  </div>
			  
			  <div class="form-group">
			  <p class="help-block col-lg-offset-2 col-lg-10">If you have changed your name by marriage, civil union, deed poll, or statutory declaration, you may be registered with the New Zealand Qualifications Authority under your previous name.<br />Please state your previous name(s) and upload a supporting document</p>
				<label for="traineePreviousName" class="col-lg-2 control-label">Previous name</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" id="traineePreviousName" name="traineePreviousName" placeholder="Previous name" onchange="prevNameChange()"/>
				</div>
			  </div>
			  <script type="text/javascript">
			  function prevNameChange() {
				  var value = document.getElementById("traineePreviousName").value;
				  if(value == "") document.getElementById("traineePreviousNameDoc").disabled = true;
				  else document.getElementById("traineePreviousNameDoc").disabled = false;
			  }
			  </script>
			  
			  <div class="form-group">
				<label for="traineePreviousNameDoc" class="col-lg-2 control-label">Supporting document</label>
				<div class="col-lg-3">
				  <input type="file" name="traineePreviousNameDoc" id="traineePreviousNameDoc" />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="traineeGender" class="col-lg-2 control-label">Gender *</label>
				<div class="col-lg-10">
				  <select class="form-control" id="traineeGender">
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                      <option value="Gender diverse">Gender diverse</option>
				  </select>
				</div>
			  </div> 
			  
			  
			  <div class="form-group">
				<label for="traineeDOB" class="col-lg-2 control-label">Date of birth *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="generalDetailsDate" />
				</div>
			  </div>
            <br>
            
            <div class="form-group">
			  <p class="help-block col-lg-offset-2 col-lg-10">Please enter your NZQA number or National Student Number (NSN) if known</p>
				<label for="traineeNSN" class="col-lg-2 control-label">NZQA # or National Student Number (NSN)</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" id="traineeNSN" placeholder="NZQA number or National Student Number (NSN)"/>
				</div>
			  </div>
			  
			  
			  <div class="form-group">
			  <p class="help-block col-lg-offset-2 col-lg-10">If you are under 16 please enter your MOE Exemption number</p>
				<label for="traineeMOEEN" class="col-lg-2 control-label">MOE exemption #</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" id="traineeMOEEN" placeholder="MOE Exemption #" />
				</div>
			  </div>
            
            <div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" id="nextButton" type="button" onclick="generalDetails()">Next Section</button></div>
        </form>
    </div>
</div>
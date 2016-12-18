<div class="containerContainer" id="generalDetails">
    <h1 class="page-header">Trainee Information</h1>
    <div class="contentContainer">
        <form class="form-horizontal" action="form.php?form=TraineeInformation" method="post" enctype="multipart/form-data">
            <div class="form-group <?php if (isset($salutationError)) print "has-error"; ?>">
				<label for="primaryEthnicity" class="col-lg-2 control-label">Title *</label>
				<div class="col-lg-10">
				  <select class="form-control" name="salutation" id="salutation">
                                      <option>Mr</option>
                                      <option>Mrs</option>
                                      <option>Miss</option>
                                      <option>Ms</option>
                                      <option>Dr</option>
				  </select>
				</div>
			  </div>
    
    <div class="form-group">
			  <p class="help-block col-lg-offset-2 col-lg-10">Enter your <b><i><u>full legal name</u></i></b> as it appears on your birth certificate or passport</p>
				<label for="traineeFirstName" class="col-lg-2 control-label">First name *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" name="traineeFirstName" placeholder="First name" value="<?php if(isset($traineeFirstName)) {print $traineeFirstName;} ?>" />
				</div>
			  </div>
			  <div class="form-group">
				<label for="traineeMiddleName" class="col-lg-2 control-label">Middle name</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" name="traineeMiddleName" placeholder="Middle name" value="<?php if(isset($traineeMiddleName)) {print $traineeMiddleName;} ?>" />
				</div>
			  </div>
			  <div class="form-group">
				<label for="traineeLastName" class="col-lg-2 control-label">Last name *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" name="traineeLastName" placeholder="Last name" value="<?php if(isset($traineeLastName)) {print $traineeLastName;} ?>" />
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="traineeGender" class="col-lg-2 control-label">Gender *</label>
				<div class="col-lg-10">
				  <select class="form-control" name="traineeGender">
                                      <option>Male</option>
                                      <option>Female</option>
                                      <option>Gender diverse</option>
				  </select>
				</div>
			  </div> 
			  
			  
			  <div class="form-group">
				<label for="traineeDOB" class="col-lg-2 control-label">Date of birth *</label>
				<div class="col-lg-10">
				  <input type="text" class="form-control" name="traineeDOB" placeholder="dd/mm/yyyy" id="generalDetailsDate" />
				</div>
			  </div>
            <div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" id="nextButton" type="button" onclick="generalDetails()">Next Section</button></div>
        </form>
    </div>
</div>
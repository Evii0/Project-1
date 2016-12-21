<div class="containerContainer" id="traineeInformation">
	<h1 class="page-header" id="title">Trainee information</h1>
	<div class="contentContainer">
		<div class="">
			<p class="help-block col-lg-offset-2 col-lg-10">Please complete this section with your details. All fields marked with an * are compulsory</p>

			<form class="form-horizontal" action="form.php?form=TraineeInformation" method="post" enctype="multipart/form-data">
			  <div class="form-group">
					<label for="primaryEthnicity" class="col-lg-2 control-label">Title *</label>
					<div class="col-lg-10">
				  	<select class="form-control" name="title" id="title">
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
				  	<input type="text" class="form-control" name="traineeFirstName" id="traineeFirstName" placeholder="First name" value="" />
					</div>
			  </div>

				<div class="form-group">
					<label for="traineeMiddleName" class="col-lg-2 control-label">Middle name</label>
					<div class="col-lg-10">
				  	<input type="text" class="form-control" name="traineeMiddleName" id="traineeMiddleName" placeholder="Middle name" value="" />
					</div>
			  </div>

				<div class="form-group">
					<label for="traineeLastName" class="col-lg-2 control-label">Last name *</label>
					<div class="col-lg-10">
				  	<input type="text" class="form-control" name="traineeLastName" id="traineeLastName" placeholder="Last name" value="" />
					</div>
			  </div>

			  <div class="form-group">
					<label for="traineeGender" class="col-lg-2 control-label">Gender *</label>
					<div class="col-lg-10">
				  	<select class="form-control" name="traineeGender" id="traineeGender">
							<option>Male</option>
							<option>Female</option>
							<option>Gender diverse</option>
				  	</select>
					</div>
			  </div>

			  <div class="form-group">
					<label for="traineeDOB" class="col-lg-2 control-label">Date of birth *</label>
					<div class="col-lg-10">
				  	<input type="text" class="form-control" name="traineeDOB" id="traineeDOB" placeholder="dd/mm/yyyy" value="" />
					</div>
			  </div>
				<div class="input-group col-lg-offset-2 col-lg-10">
					<button class="btn btn-default" type="submit">Save Form</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="containerContainer" id="proofIdentity">
	<h1 class="page-header" id="title">Proof of identity</h1>
	<div class="contentContainer">
		<div class="">
			ID Method
		</div>

		<form class="form-horizontal" action="form.php?form=ProofIdentity" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="idMethod" class="help-block col-lg-offset-2 col-lg-10">Select an identification method</label>
				<p class="help-block col-lg-offset-2 col-lg-10">Please upload a copy of your passport, birth certificate or government issued photo identification (e.g. drivers licence).</p>
		  </div>

		  <div class="form-group">
				<label for="traineePreviousNameDoc" class="col-lg-2 control-label">Verification <span class="text-nowrap">document A</span></label>
				<div class="col-lg-3">
			  	<input type="file" id="verification_document_a" name="verification_document_a"/>
				</div>
		  </div>

		  <div class="form-group">
				<label for="traineePreviousNameDoc" class="col-lg-2 control-label">Verification <span class="text-nowrap">document B</span></label>
				<div class="col-lg-3">
			  	<input type="file" id="verification_document_b" name="verification_document_b" />
				</div>
		  </div>

			<div class="input-group col-lg-offset-2 col-lg-10">
				<button class="btn btn-default" type="submit">Save Form</button>
			</div>
		</form>
	</div>
</div>

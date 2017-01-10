<?php
$idOptions = array(
	"Passport",
	"Birth Certificate",
	"Government Issued Photo Identification"
);
?>

<div class="containerContainer" id="proofIdentity">
	<h1 class="page-header" id="title">Proof of identity</h1>
	<div class="contentContainer">
			<form class="form-horizontal" action="upload.php" method="post" enctype="multipart/form-data">
			
			<div class="form-group">
			
				<label for="idMethod" class="help-block col-lg-offset-2 col-lg-10">Select an identification method</label>
				<p class="help-block col-lg-offset-2 col-lg-10">Please upload a copy of your passport, birth certificate or government issued photo identification (e.g. drivers licence).</p>
				<div class="col-lg-offset-2 col-lg-10">
				  <select class="form-control" name="idMethod" id="idMethod">
					<?php
						$arrayLength = count($idOptions);
						for($x = 0; $x < $arrayLength; $x++) {
							print '<option id="'.$idOptions[$x].'" ';
							//if($idMethod == $idOptions[$x]) print 'selected="selected"';
							print '>'.$idOptions[$x].'</option>';
						}
					?>
				  </select>
				</div>
			  </div>
                <div><p class="help-block col-lg-offset-2 col-lg-10" id="verificationDocumentAUploaded"></p></div>
                <div><p class="help-block col-lg-offset-2 col-lg-10" id="verificationDocumentBUploaded"></p></div>
			  <div class="form-group">
				<label for="traineePreviousNameDoc" class="col-lg-2 control-label">Verification <span class="text-nowrap">document A</span></label>
				<div class="col-lg-3">
				  <input type="file" id="verificationDocumentA" name="verificationDocumentA"/>
				</div>
			  </div>
			  <div class="form-group">
				<label for="traineePreviousNameDoc" class="col-lg-2 control-label">Verification <span class="text-nowrap">document B</span></label>
				<div class="col-lg-3">
				  <input type="file" id="verificationDocumentB" name="verificationDocumentB" data-buttonText="Your label here."/>
				</div>
			  </div>
				<div class="input-group col-lg-offset-2 col-lg-10">
                    <button class="btn btn-default" id="nextButton" type="button" onclick="proofIdentity()">Next Section</button>
                </div>
				</form>
	</div>
</div>
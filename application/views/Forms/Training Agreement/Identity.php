<?php
$idMethods = array(
    "Overseas passport AND permanent residency or working visa",
    "Overseas birth certificate AND photo ID AND permanent residency or working visa",
    "NZ citizenship certificate AND photo ID",
    "New Zealand birth certificate (issued before 1998) AND photo ID"
);
?>

<div class="containerContainer" id="identity">
<h1 class="page-header">Proof of Identity</h1>
<div class="contentContainer">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-primary">You must fill out only ONE of the below sections</h3>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Section 1 - Do you have a New Zealand passport?
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="form.php?form=ProofIdentity" method="post">
                        <input type="hidden" name="idMethod" value="New Zealand passport number">
                        <div class="form-group">
                            <label for="passportNumber" class="col-lg-2 control-label">NZ passport number</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="passportNumber" placeholder="NZ passport number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="passportExpiry" class="col-lg-2 control-label">Passport expiry</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="passportExpiry" placeholder="dd/mm/yyyy" id="passportExpiry" />
                            </div>
                        </div>
                        <p class="help-block col-lg-offset-2 col-lg-10">Your passport must not be expired by more than 2 years. If it is please use another identification method</p>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Section 2 - Do you have a New Zealand birth certificate (issued after 1998)?
                </div>
                <div class="panel-body">
                    <p class="help-block col-lg-offset-2 col-lg-10">Birth certificate must be issued after 1998</p>
                    <form class="form-horizontal" action="form.php?form=ProofIdentity" method="post">
                        <input type="hidden" name="idMethod" value="New Zealand birth certificate (issued after 1998)">
                        <div class="form-group">
                            <label for="birthCertificate" class="col-lg-2 control-label">Birth certificate ID number</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="birthCertificate" name="birthCertificate" placeholder="NZ birth certificate unique ID number" />
                            </div>
                        </div>
                        <p class="help-block col-lg-offset-2 col-lg-10">If your birth certificate is issued before 1998 please use another identification method</p>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Section 3 - Manual ID Methods
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="form.php?form=ProofIdentity" method="post" enctype="multipart/form-data">
                        <div class="form-group">   
                            <p class="help-block col-lg-offset-2 col-lg-10">You will be required to upload a digital copy of these documents which must already be verified prior to being uploaded.</p>
                            <p class="help-block col-lg-offset-2 col-lg-10">A verified document is a photocopy signed as a true and accurate copy of the original. This can be verified by a Justice of the Peace, NZ Police, Skills staff member or a Skills authorised verifier only.</p> 
                            <label for="idMethod" class="help-block col-lg-offset-2 col-lg-10">Select an identification method</label>
                            <div class="col-lg-offset-2 col-lg-10">
                                <select class="form-control" name="idMethod" id="idMethod">
                                    <?php
                                            $arrayLength = count($idMethods);
                                            for($x = 1; $x < $arrayLength; $x++) {
                                                print '<option value="'.$idMethods[$x].'" ';
                                                //if($schoolCountry == $schoolCountries[$x]) print 'selected="selected"';
                                                print '>'.$idMethods[$x].'</option>';
                                            }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div><p class="help-block col-lg-offset-2 col-lg-10" id="verificationDocumentUploaded"></p></div>
                        <div class="form-group">
                            <label for="traineePreviousNameDoc" class="col-lg-2 control-label">Verification document A</label>
                            <div class="col-lg-3">
                                <input type="file" id="verificationDocumentA" name="verificationDocumentA"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="traineePreviousNameDoc" class="col-lg-2 control-label">Verification document B</label>
                            <div class="col-lg-3">
                                <input type="file" id="verificationDocumentB" name="verificationDocumentB" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="traineePreviousNameDoc" class="col-lg-2 control-label">Verification document C</label>
                            <div class="col-lg-3">
                                <input type="file" id="verificationDocumentC" name="verificationDocumentC"/>
                            </div>
                        </div>
                        <p class="col-lg-offset-2 col-lg-10 text-primary">These are valid forms of photo ID: Drivers License, 18+ Card, or NZ Student ID</p>                        
                    </form>
                </div>
                
            </div>
            <div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" id="nextButton" type="button" onclick="identity()">Next Section</button></div>
        </div>
    </div>
    </div>
</div>
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
                        <div class="form-group <?php if(isset($passportNumberError)) print "has-error"; ?>">
                            <label for="passportNumber" class="col-lg-2 control-label">NZ passport number</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="passportNumber" placeholder="NZ passport number" value="<?php if(isset($passportNumber)) {print $passportNumber;} ?>" />
                            </div>
                        </div>
                        <div class="form-group <?php if(isset($passportExpiryError)) print "has-error"; ?>">
                            <label for="passportExpiry" class="col-lg-2 control-label">Passport expiry</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="passportExpiry" placeholder="dd/mm/yyyy" value="<?php if(isset($passportExpiry)) {print $passportExpiry;} ?>" />
                            </div>
                        </div>
                        <p class="help-block col-lg-offset-2 col-lg-10">Your passport must not be expired by more than 2 years. If it is please use another identification method</p>
                        <div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" type="submit">Save passport details</button></div>
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
                        <div class="form-group <?php if(isset($birthCertificateError)) print "has-error"; ?>">
                            <label for="birthCertificate" class="col-lg-2 control-label">Birth certificate ID number</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="birthCertificate" name="birthCertificate" placeholder="NZ birth certificate unique ID number" value="<?php if(isset($birthCertificate)) {print $birthCertificate;} ?>" />
                            </div>
                        </div>
                        <p class="help-block col-lg-offset-2 col-lg-10">If your birth certificate is issued before 1998 please use another identification method</p>
                        <div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" type="submit">Save birth certificate number</button></div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Section 3 - Manual ID Methods
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="form.php?form=ProofIdentity" method="post" enctype="multipart/form-data">
                        <div class="form-group <?php if (isset($idMethodError)) print "has-error"; ?>">
                            <label for="idMethod" class="help-block col-lg-offset-2 col-lg-10">Select an identification method</label>
                            <p class="help-block col-lg-offset-2 col-lg-10">You will be required to upload a digital copy of these documents which must already be verified prior to being uploaded.</p>
                            <div class="col-lg-offset-2 col-lg-10">
                                <select class="form-control" name="idMethod" id="idMethod" onchange="inputChanged()">
                                <?php
                                    $arrayLength = count($idOptions);
                                    for($x = $arrayLength-1; $x >= 0; $x--) {
                                    print '<option value="'.$idOptions[$x].'" ';
                                    if($idMethod == $idOptions[$x]) print 'selected="selected"';
                                    print '>'.$idOptions[$x].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <p class="help-block col-lg-offset-2 col-lg-10" id="aussieRules"></p>
                        <script type="text/javascript">
                        </script>
                        <div class="form-group <?php if(isset($documentAError) || isset($documentError)) {print "has-error";} ?>">
                            <label for="traineePreviousNameDoc" class="col-lg-2 control-label">Verification document A</label>
                            <div class="col-lg-3">
                                <input type="file" id="verificationDocumentA" name="verificationDocumentA"/>
                            </div>
                            <?php 
                                if(isset($documentAErrorMessage))
                                print '<p class="col-lg-7 text-danger">'.$documentAErrorMessage.'</p>';
                                else if(isset($documentAError))
                                print '<p class="col-lg-7 text-danger">You must upload a document</p>';
                                else if(isset($documentA) && $documentA != "")
                                print '<p class="col-lg-7 text-success">We already have a file on record. You can upload another file and overwrite it.</p>';
                                else
                                print '<p class="col-lg-7"></p>';
                                ?>
                        </div>
                        <div class="form-group <?php if(isset($documentBError)) {print "has-error";} ?>">
                            <label for="traineePreviousNameDoc" class="col-lg-2 control-label">Verification document B</label>
                            <div class="col-lg-3">
                                <input type="file" id="verificationDocumentB" name="verificationDocumentB" />
                            </div>
                            <?php 
                                if(isset($documentBErrorMessage))
                                print '<p class="col-lg-7 text-danger">'.$documentBErrorMessage.'</p>';
                                else if(isset($documentBError))
                                print '<p class="col-lg-7 text-danger">You must upload a document</p>';
                                else if(isset($documentB) && $documentB != "")
                                print '<p class="col-lg-7 text-success">We already have a file on record. You can upload another file and overwrite it.</p>';
                                else
                                print '<p class="col-lg-7"></p>';
                                ?>
                        </div>
                        <div class="form-group <?php if(isset($documentCError)) {print "has-error";} ?>">
                            <label for="traineePreviousNameDoc" class="col-lg-2 control-label">Verification document C</label>
                            <div class="col-lg-3">
                                <input type="file" id="verificationDocumentC" name="verificationDocumentC"/>
                            </div>
                            <?php 
                                if(isset($documentCErrorMessage))
                                print '<p class="col-lg-7 text-danger">'.$documentCErrorMessage.'</p>';
                                else if(isset($documentCError))
                                print '<p class="col-lg-7 text-danger">You must upload a document</p>';
                                else if(isset($documentC) && $documentC != "")
                                print '<p class="col-lg-7 text-success">We already have a file on record. You can upload another file and overwrite it.</p>';
                                else
                                print '<p class="col-lg-7"></p>';
                                ?>
                        </div>
                        <p class="help-block col-lg-offset-2 col-lg-10">A verified document is a photocopy signed as a true and accurate copy of the original. This can be verified by a Justice of the Peace, NZ Police, Skills staff member or a Skills authorised verifier only.</p>
                        <p class="col-lg-offset-2 col-lg-10 text-primary">These are valid forms of photo ID: Drivers License, 18+ Card, or NZ Student ID</p>
                        <?php if(isset($formError)) { ?>
                        <div class="alert alert-warning col-lg-offset-2 col-lg-10">
                            Form saved but not completed. Please ensure you have completed this section correctly
                        </div>
                        <?php } ?>
                        
                    </form>
                </div>
                
            </div>
            <div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" id="nextButton" type="button" onclick="identity()">Next Section</button></div>
        </div>
    </div>
    </div>
</div>
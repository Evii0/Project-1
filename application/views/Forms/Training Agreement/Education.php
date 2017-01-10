<?php

include "application/views/Forms/Training Agreement/assets/Arrays.php";
$schoolCountries =$countries;
$schools = $nzSchools;
array_unshift($schoolCountries, "");
array_unshift($schools, "");

?>

<div class="containerContainer" id="education">
    <h1 class="page-header">Education</h1>
    <div class="contentContainer">
        <div class="row">
            <div class="col-lg-12">
                        <form class="form-horizontal" action="form.php?form=Education" method="post">
                            <div class="form-group">
                                <label for="schoolCountry" class="col-lg-2 control-label">Secondary school country*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="schoolCountry" name="schoolCountry" onChange="changeCountry()">
                                        <?php
                                            $arrayLength = count($schoolCountries);
                                            for($x = 1; $x < $arrayLength; $x++) {
                                                print '<option value="'.$schoolCountries[$x].'" ';
                                                //if($schoolCountry == $schoolCountries[$x]) print 'selected="selected"';
                                                print '>'.$schoolCountries[$x].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function changeCountry() {
                                    if(document.getElementById("schoolCountry").value == "New Zealand") {
                                        document.getElementById("secondarySchool").disabled = false;
                                    } else {
                                        document.getElementById("secondarySchool").selectedIndex = 0;
                                        document.getElementById("secondarySchool").disabled = true;
                                    }
                                }
                            </script>

                            <div class="form-group">
                                <label for="secondarySchool" class="col-lg-2 control-label">Secondary school*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="secondarySchool" name="secondarySchool" disabled="true">
                                        <?php
                                            $arrayLength = count($schools);
                                            for($x = 1; $x < $arrayLength; $x++) {
                                                print '<option value="'.$schools[$x].'" ';
                                                print '>'.$schools[$x].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastYearAtSchool" class="col-lg-2 control-label">Last year at school*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="lastYearAtSchool" placeholder="Year" id="lastSchoolYear" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mainLanguage" class="col-lg-2 control-label">Main language*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="mainLanguage" placeholder="Language" id="language" />
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="HighestSecondryQual" class="col-lg-2 control-label">Highest secondary qualification</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="HighestSecondryQual">
                                        <?php
                                            $arrayLength = count($secondaryQual);
                                            for($x = 1; $x < $arrayLength; $x++) {
                                                print '<option value="'.$secondaryQual[$x].'" ';
                                                //if($schoolCountry == $schoolCountries[$x]) print 'selected="selected"';
                                                print '>'.$secondaryQual[$x].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="HighestTertiaryQual" class="col-lg-2 control-label">Highest tertiary qualification</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="HighestTertiaryQual" id="HighestTertiaryQual" onChange="HighestTertiaryQualChanged()">
                                        <?php
                                            $arrayLength = count($tertiaryQual);
                                            for($x = 1; $x < $arrayLength; $x++) {
                                                print '<option value="'.$tertiaryQual[$x].'" ';
                                                //if($schoolCountry == $schoolCountries[$x]) print 'selected="selected"';
                                                print '>'.$tertiaryQual[$x].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="qualificationLevel" class="col-lg-2 control-label">Qualification level</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="qualificationLevel" id="qualificationLevel" disabled = "true">
                                        <?php
                                            $arrayLength = count($level);
                                            for($x = 1; $x < $arrayLength; $x++) {
                                                print '<option value="'.$level[$x].'" ';
                                                //if($schoolCountry == $schoolCountries[$x]) print 'selected="selected"';
                                                print '>'.$level[$x].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function HighestTertiaryQualChanged() {
                                    console.log("test");
                                    document.getElementById("qualificationLevel").disabled = true;
                                    var value = document.getElementById("HighestTertiaryQual");
                                    if(value.selectedIndex > 2 && value.selectedIndex < 9) {
                                        document.getElementById("qualificationLevel").disabled = false;
                                    }
                                }
                            </script>


                            <div class="form-group">
                                <label for="firstYearAtTertiary" class="col-lg-2 control-label">First year at tertiary</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="firstYearAtTertiary" placeholder="YYYY" id="tertiaryYear" />
                                </div>
                            </div>
                            <hr />

                            <div class="form-group">
                                <p class="help-block col-lg-offset-2 col-lg-10">Please select your occupation or activity before you started with your employer</p>
                                <label for="previousEmployment" class="col-lg-2 control-label">Prior activity</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="previousEmployment" id="priorActivity">
                                        <?php
                                            $arrayLength = count($priorActivity);
                                            for($x = 1; $x < $arrayLength; $x++) {
                                                print '<option value="'.$priorActivity[$x].'" ';
                                                //if($schoolCountry == $schoolCountries[$x]) print 'selected="selected"';
                                                print '>'.$priorActivity[$x].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    
                
                <div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" id="nextButton" type="button" onclick="education()">Next Section</button></div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
</div>
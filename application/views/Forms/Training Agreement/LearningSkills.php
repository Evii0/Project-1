<?php
$jobs = array(
	"Secondary school student",
	"Polytechnic student",
	"College of Education student",
	"Private training student",
	"Wananga student",
	"University student",
	"Wage or salary worker",
	"House-person or retired",
	"Overseas",
	"Self-employed",
	"Non-employed or beneficiary"
);

?>

<div class="containerContainer" id="learningSkills">
    <h1 class="page-header">Employment and Skills</h1>
    <div class="contentContainer">
        
        <div class="row">
	<div class="col-lg-12">
		<h2>Previous employment or activity</h2>
		<div class="panel panel-default">
			<div class="panel-body">

			<form class="form-horizontal" action="form.php?form=PreviousEmployment" method="post">
				<div class="form-group col-lg-12">
					<label for="completedAssessment" class="control-label">Please select your occupation or activity before you started with this employer</label>
					<select class="form-control" id="previousEmployment">
						<?php
                            $arrayLength = count($jobs);
                            for($x = 1; $x < $arrayLength; $x++) {
                                print '<option value="'.$jobs[$x].'" ';
                                print '>'.$jobs[$x].'</option>';
                            }
                        ?>
					</select>
				</div>	
				</form>
			</div>
		</div>
	</div>
	<!-- /.col-lg-12 -->
</div>
        
        <div class="row">
	<div class="col-lg-12">
        <h2>Learning Skills</h2>
		<div class="panel panel-default">
			<div class="panel-body">
			<p class="help-block">The training will contain some learning skills assessments that may include literacy and numeracy</p>

			<form class="form-horizontal" action="form.php?form=LearningSkills" method="post">
			
			
			<div class="form-group col-lg-12">
				<label for="completedAssessment" class="control-label">Have you completed a reading or numeracy assessment</label>
				<select class="form-control" name="completedAssessment" id="completedAssessment" onchange="updateCompletedAssessment()">
					<option value="Yes">Yes</option>
					<option value="No">No</option>
					<option value="Don't Know">Don't Know</option>
				</select>
			</div>
			
			<script type="text/javascript">
			 function updateCompletedAssessment() {
				var value = document.getElementById("completedAssessment").value;
				 if(value == "Yes") {
					 document.getElementById("typeOfAssessment").disabled = false;
					 document.getElementById("assessmentProvider").disabled = false;
				}
				else {
					document.getElementById("typeOfAssessment").disabled = true;
					document.getElementById("typeOfAssessment").selectedIndex = 0;
					document.getElementById("assessmentProvider").disabled = true;
					document.getElementById("assessmentProvider").value = "";
				}
				}
			</script>
			
			<div class="form-group col-lg-12">
				<label for="typeOfAssessment" class="control-label">If yes, please specify</label>
				<select class="form-control" name="typeOfAssessment" id="typeOfAssessment">
					<option value="Not Specified">Not Specified</option>
					<option value="Reading">Reading</option>
					<option value="Numeracy">Numeracy</option>
					<option value="Both">Both</option>
					<option value="Other">Other</option>
				</select>
			</div>
			
			<div class="form-group col-lg-12">
				<label class="control-label" for="assessmentProvider">Who with?</label>
				<input class="form-control" name="assessmentProvider" id="assessmentProvider" />
			</div>
	
			<div class="form-group col-lg-12">
				<label>Do you have a difficulty that may affect your ability to learn</label>
				<select class="form-control" name="learningDifficulty" id="learningDifficulty" onchange="updateLearningDifficulty()">
					<option value="No">No</option>
					<option value="Yes">Yes</option>
				</select>
			</div>
			
			<script type="text/javascript">
			 function updateLearningDifficulty() {
				 var value = document.getElementById("learningDifficulty").value;
				 if(value == "Yes") document.getElementById("learningDifficultyDescription").disabled = false;
				 else {
					 document.getElementById("learningDifficultyDescription").disabled = true;
					 document.getElementById("learningDifficultyDescription").value = "";
				 }
			 }
			</script>
			
			<div class="form-group col-lg-12">
				<label for="learningDifficultyDescription" class="control-label">If yes, please specify</label>
				<input placeholder="Learning Difficulty" class="form-control" name="learningDifficultyDescription" id="learningDifficultyDescription" />
			</div>
			
			<div class="alert alert-info col-lg-6">
				If you have difficulties, extra learning support may be available.
			</div>

				</form>
            </div>     
		</div>
        <div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" id="nextButton" type="button" onclick="learningSkills()">Next Section</button></div>
	</div>
	<!-- /.col-lg-12 -->
</div>
    </div>
</div>
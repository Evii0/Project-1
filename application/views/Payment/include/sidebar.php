<?php
if($_SESSION['Check-TrainingAgreement'] == 1) $TrainingAgreementIcon = '<font color="green"><i class="fa fa-check fa-fw"></i></font>';
else $TrainingAgreementIcon = '<i class="fa fa-pencil fa-fw"></i>';

if($_SESSION['Check-TraineeInformation'] == 1) $TraineeInformationIcon = '<font color="green"><i class="fa fa-check fa-fw"></i></font>';
else $TraineeInformationIcon = '<i class="fa fa-pencil fa-fw"></i>';

if($_SESSION['Check-ContactDetails'] == 1) $ContactDetailsIcon = '<font color="green"><i class="fa fa-check fa-fw"></i></font>';
else $ContactDetailsIcon = '<i class="fa fa-pencil fa-fw"></i>';

if($_SESSION['Check-ProofIdentity'] == 1) $ProofIdentityIcon = '<font color="green"><i class="fa fa-check fa-fw"></i></font>';
else $ProofIdentityIcon = '<i class="fa fa-pencil fa-fw"></i>';

if($_SESSION['Check-Payment'] == 1) $PaymentIcon = '<font color="green"><i class="fa fa-check fa-fw"></i></font>';
else $PaymentIcon = '<i class="fa fa-pencil fa-fw"></i>';

if($_SESSION['Check-Terms'] == 1) $TermsIcon = '<font color="green"><i class="fa fa-check fa-fw"></i></font>'; else
$TermsIcon = '<i class="fa fa-pencil fa-fw"></i>';

?>
<li>
	<a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
</li>
<li>
	<a href="#"><?php print $TrainingAgreementIcon; ?> Registration Form<span class="fa arrow"></span></a>
	<ul class="nav nav-second-level">
		<li>
			<a href="form.php?form=TraineeInformation"><?php print $TraineeInformationIcon; ?> Trainee information</a>
		</li>
		<li>
			<a href="form.php?form=ContactDetails"><?php print $ContactDetailsIcon; ?> Contact details</a>
		</li>
		<li>
			<a href="form.php?form=ProofIdentity"><?php print $ProofIdentityIcon; ?> Proof of identification</a>
		</li>
		<li>
			<a href="form.php?form=Terms"><?php print $TermsIcon; ?> T&Cs</a>
		</li>
		<li>
			<a href="Payment.php"><?php print $PaymentIcon; ?> Payment</a>
		</li>
	</ul>
	<!-- /.nav-second-level -->
</li>
<!--
<li>
	<a href="#"><i class="fa fa-pencil fa-fw"></i> Real Estate<span class="fa arrow"></span></a>
	<ul class="nav nav-second-level">
		<li>
			<a href="#"><i class="fa fa-ban fa-fw"></i> Details</a>
		</li>
		<li>
			<a href="#"><i class="fa fa-ban fa-fw"></i> Qualification</a>
		</li>
		<li>
			<a href="#"><i class="fa fa-ban fa-fw"></i> Other Qualifications</a>
		</li>
		
	</ul>
	<!-- /.nav-second-level -->
<!--</li>-->
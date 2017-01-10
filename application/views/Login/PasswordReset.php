<?php
$page = "login.php";
include "include/header.php";

$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['email'])) {
	$sql = $conn->prepare("SELECT NZPrintUserID FROM Users WHERE EmailAddress=? AND Locked=0");
	$sql->bind_param("s", $_POST['email']);
	$sql->execute();
	$sql->bind_result($id);
	if($sql->fetch()) {
		$UserID = $id;
	}
	$sql->close();
	if(isset($UserID)) {
		//generate a random reset key
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$numOfChars = strlen($chars);
		$resetKey = "";
		for($i = 0; $i < 64; $i++) {
			$resetKey .= $chars[rand(0,$numOfChars-1)];
		}
		$stmt = $conn->prepare("INSERT INTO PasswordResets(NZPrintUserID, ResetCode) VALUES (?,?)");
		$stmt->bind_param("is", $UserID, $resetKey);
		$stmt->execute();
		$stmt->close();
		//SEND EMAIL TO USER
		$resetLink = "https://skillsenrolment.co.nz/realestateint/pages/passwordReset.php?reset=".$resetKey;
		$sendMailTo = $_POST['email'];
		$sendMailSubject = "Skills International Password Reset";
		// $sendMailMessage = '
// <html>
// <head><title>Training Agreement Password Reset</title></head>
// <body>
// <p>We have been asked to allow you to reset you password.<br />If you did not request this please ignore this email</p>
// <p>To reset your password please go to the link below. If you cannot click on the link, copy and paste it into your web browser</p>
// <p><a href="'.$resetLink.'">'.$resetLink.'</a></p>
// </body>
// </html>
// ';

		  $sendMailMessage = '
<html>
<head><title>Skills International Password Reset</title></head>
<body>
<p>We have been asked to allow you to reset your password.<br />If you did not request this please ignore this email</p>
<p>To reset your password please go to the link below. If you cannot click on the link, copy and paste it into your web browser</p>
<p><a href="'.$resetLink.'">'.$resetLink.'</a></p>

<p><img src="http://persona.perceptiongroup.co.nz/resource/skills/skillsIntLogo.png" height="50"/><br /><br />Phone: +64 9 525 2590<br />
Email: <a href="mailto:info@skillsinternational.co.nz">info@skillsinternational.co.nz</a><br />
<a href="http://skillsinternational.co.nz" />skillsinternational.co.nz</a>
</p>
</body>
</html>
';


		// To send HTML mail, the Content-type header must be set
		$sendMailHeaders  = 'MIME-Version: 1.0' . "\r\n";
		$sendMailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$sendMailHeaders .= 'From: Skills International <no-reply@skillsinternational.co.nz>' . "\r\n";
		//TODO IMPLEMENT THIS
		mail($sendMailTo, $sendMailSubject, $sendMailMessage, $sendMailHeaders);
	}
	
	
} else if(isset($_GET['reset'])) {
	//check if key is valid
	$sql = $conn->prepare("SELECT Users.NZPrintUserID, Users.EmailAddress FROM Users INNER JOIN PasswordResets ON Users.NZPrintUserID = PasswordResets.NZPrintUserID WHERE PasswordResets.ResetCode=? AND PasswordResets.ResetDate >= DATE_SUB(NOW(), INTERVAL 1 DAY)");
	$sql->bind_param("s", $_GET['reset']);
	$sql->execute();
	$sql->bind_result($id, $email);
	if($sql->fetch()) {
		$validCode = true;
	}
	$sql->close();
	$inputResetCode = $_GET['reset'];
} else if(isset($_POST['resetCode'])) {
	$inputResetCode = $_POST['resetCode'];
	$email = $_POST['hiddenEmail'];
	if($_POST['pass1'] != $_POST['pass2']) {
		$formError = true;
		$passwordError = "Passwords do not match";
	} else if($_POST['pass1'] == "") {
		$formError = true;
		$passwordError = "You must have a password";
	} else {
		$passHash = password_hash($_POST['pass1'], PASSWORD_BCRYPT);
		$stmt = $conn->prepare("UPDATE Users INNER JOIN PasswordResets ON Users.NZPrintUserID=PasswordResets.NZPrintUserID SET PasswordHash=? WHERE PasswordResets.ResetCode=?");
		$stmt->bind_param("ss", $passHash, $_POST['resetCode']);
		$stmt->execute();
		$stmt->close();
	}
	$stmt = $conn->prepare("DELETE FROM PasswordResets WHERE ResetCode=?");
	$stmt->bind_param("s", $_POST['resetCode']);
	$stmt->execute();
	$stmt->close();
	//delete this and any other keys that may be listed for this user
	$resetSuccess = true;
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Training Agreement Password Reset</h1>
		
		<?php if(isset($_POST['email'])) { ?>
		<div class="panel panel-success">
			<div class="panel-heading">
				Email Sent
			</div>
			<div class="panel-body">
				<p>If your email address was in our system we have emailed a reset link to you. This link is valid for 24 hours.</p>
			</div>
		</div>
		
		<?php } else if((isset($_GET['reset']) && isset($validCode)) || (isset($_POST['resetCode']) && isset($formError)))  { //let the user reset their password?>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				Please select a new password
			</div>
			<div class="panel-body">
				
				<form action="passwordReset.php" method="POST">
				<div class="form-group input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="text" name="email2" placeholder="Email Address" class="form-control" value="<?php print $email; ?>" disabled="true" />
				</div>
				<div class="form-group input-group<?php if(isset($loginError)) {print " has-error";} ?>">
					<span class="input-group-addon"><i class="fa fa-key"></i></span>
					<input type="password" name="pass1" placeholder="Password" class="form-control">
				</div>
				<div class="form-group input-group<?php if(isset($loginError)) {print " has-error";} ?>">
					<span class="input-group-addon"><i class="fa fa-key"></i></span>
					<input type="password" name="pass2" placeholder="Password" class="form-control">
				</div>
				<?php if(isset($passwordError)) {print '<div class="alert alert-danger">'.$passwordError.'</div>'; } ?>
				<input type="hidden" name="resetCode" value="<?php print $inputResetCode; ?>" />
				<input type="hidden" name="hiddenEmail" value="<?php print $email; ?>" />
				<button class="btn btn-default" type="submit">Change Password</button>
				</form>
			</div>
		</div>
		
		<?php } else if(isset($_GET['reset'])) { //Reset Code is not valid?>
		
		<div class="panel panel-danger">
			<div class="panel-heading">
				Invalid Code
			</div>
			<div class="panel-body">
				<p>Sorry that link is invalid</p>
			</div>
		</div>
	
		<?php } else if(isset($resetSuccess)) { ?>
		
		<div class="panel panel-success">
			<div class="panel-heading">
				Password Reset
			</div>
			<div class="panel-body">
				<p>Your password has been reset. You can now <a href="login.php">login</a></p>
			</div>
		</div>
		
		<?php } else { //first visit to this page ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				Enter your email address to reset your password
			</div>
			<div class="panel-body">
				
				<form action="" method="POST">
				<div class="form-group input-group">
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
					<input type="text" name="email" placeholder="Email Address" class="form-control" />
				</div>
				<button class="btn btn-default" type="submit">Send Email</button>
				</form>
			</div>
		</div>
		
		<?php } ?>
		
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->				
<?php
include "include/footer.php";
?>
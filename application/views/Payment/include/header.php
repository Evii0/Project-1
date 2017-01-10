<?php
ob_start();
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
//mysqli_report(MYSQLI_REPORT_ALL);
session_start();

//check user is secure
/*if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}



if(!isset($page) || ($page != "error.php" && $page != "export.php")) {
	if(!isset($_SESSION['userEmail']) && (!isset($page) || $page != "login.php")) {
		header ("Location: login.php");
		exit();
	}
}*/

//include 'database.php';

if(!isset($_SESSION['userLock'])) {
	if(isset($_SESSION['userEmail'])) {
		$sql = $conn->prepare("SELECT Locked FROM Users WHERE NZPrintUserID=?");
		$sql->bind_param("i", $_SESSION['NZPrintUserID']);
		$sql->execute();
		$sql->bind_result($locked);
		if(!$sql->fetch()) {
			$locked = 0;
		}
		$_SESSION['userLock'] = $locked;
		$sql->close();
	}
}
if(isset($_SESSION['userLock']) && $_SESSION['userLock'] == 1 && !isset($reviewPage)) {
	header ("Location: review.php");
}


function validateDate($date) {
    $d = DateTime::createFromFormat('d/m/Y', $date);
    return $d && $d->format('d/m/Y') === $date;
}

function fileUpload($postName, $fileName) {
	try {
		// Undefined | Multiple Files | $_FILES Corruption Attack
		// If this request falls under any of them, treat it invalid.
		if (
			!isset($_FILES[$postName]['error']) ||
			is_array($_FILES[$postName]['error'])
		) {
			return 'Error: Invalid parameters.';
		}

		// Check $_FILES[$postName]['error'] value.
		switch ($_FILES[$postName]['error']) {
			case UPLOAD_ERR_OK:
				break;
			case UPLOAD_ERR_NO_FILE:
				return 'Error: No file sent.';
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				return 'Error: Exceeded filesize limit.';
			default:
				return 'Error: Unknown errors.';
		}

		// You should also check filesize here.
		if ($_FILES[$postName]['size'] > 5000000) {
			return 'Error: Exceeded filesize limit.';
		}

		$name = $_FILES[$postName]["name"];
		$ext = end((explode(".", $name))); # extra () to prevent notice
		// DO NOT TRUST $_FILES[$postName]['mime'] VALUE !!
		// Check MIME Type by yourself.
		//finfo is having problems on the PLESK server
		// $finfo = new finfo(FILEINFO_MIME_TYPE);
		// if (false === $ext = array_search(
			// $finfo->file($_FILES[$postName]['tmp_name']),
			// array(
				// 'pdf' => 'application/pdf',
				// 'jpg' => 'image/jpeg',
				// 'png' => 'image/png',
				// 'gif' => 'image/gif',
			// ),
			// true
		// )) {
			// return 'Error: Invalid file format.';
		// }

		// You should name it uniquely.
		// DO NOT USE $_FILES[$postName]['name'] WITHOUT ANY VALIDATION !!
		if (!move_uploaded_file(
			$_FILES[$postName]['tmp_name'],
			sprintf('./uploads/%s.%s',
				$fileName,
				$ext
			)
		)) {
			return 'Error: Failed to move uploaded file.';
		}

		return $fileName . '.' . $ext;

	} catch (RuntimeException $e) {

		return 'Error: ' . $e->getMessage();

	}
} 
function updateProgressFromDatabase() {

}
function updateProgressFromSession() {
	$totalSum = $_SESSION['Check-TraineeInformation'] + 
				$_SESSION['Check-ContactDetails'] +
				$_SESSION['Check-ProofIdentity'] + 
				$_SESSION['Check-Terms'];
	if($totalSum == 4) {
		$_SESSION['Check-TrainingAgreement'] = 1;
	} else {
		$_SESSION['Check-TrainingAgreement'] = 0;
	}
}


if(!isset($_SESSION['Check-TrainingAgreement']) && isset($_SESSION['NZPrintUserID'])) {
	//UPDATE PROGRESS FROM DATABASE
	$sql = $conn->prepare("SELECT SectionCompleted FROM TraineeInformation WHERE NZPrintUserID=?");
	$sql->bind_param("i", $_SESSION['NZPrintUserID']);
	$sql->execute();
	$sql->bind_result($TraineeInformation);
	if(!$sql->fetch()) $TraineeInformation = 0;
	$_SESSION['Check-TraineeInformation'] = $TraineeInformation;
	$sql->close();
	
	$sql = $conn->prepare("SELECT SectionCompleted FROM ContactDetails WHERE NZPrintUserID=?");
	$sql->bind_param("i", $_SESSION['NZPrintUserID']);
	$sql->execute();
	$sql->bind_result($ContactDetails);
	if(!$sql->fetch()) $ContactDetails = 0;
	$_SESSION['Check-ContactDetails'] = $ContactDetails;
	$sql->close();
	
	$sql = $conn->prepare("SELECT SectionCompleted FROM ProofIdentity WHERE NZPrintUserID=?");
	$sql->bind_param("i", $_SESSION['NZPrintUserID']);
	$sql->execute();
	$sql->bind_result($ProofIdentity);
	if(!$sql->fetch()) $ProofIdentity = 0;
	$_SESSION['Check-ProofIdentity'] = $ProofIdentity;
	$sql->close();
	
	$sql = $conn->prepare("SELECT NZPrintPaymentID FROM PaymentLog WHERE NZPrintUserID=? AND Success=1");
	$sql->bind_param("i", $_SESSION['NZPrintUserID']);
	$sql->execute();
	$sql->bind_result($Payment);
	if(!$sql->fetch()) $Payment = 0;
	$_SESSION['Check-Payment'] = $Payment;
	$sql->close();
	
	$sql = $conn->prepare("SELECT SectionCompleted FROM Terms WHERE NZPrintUserID=?");
	$sql->bind_param("i", $_SESSION['NZPrintUserID']);
	$sql->execute();
	$sql->bind_result($Terms);
	if(!$sql->fetch()) $Terms = 0;
	$_SESSION['Check-Terms'] = $Terms;
	$sql->close();
	
	$totalSum = $_SESSION['Check-TraineeInformation'] + 
				$_SESSION['Check-ContactDetails'] +
				$_SESSION['Check-ProofIdentity'] + 
				$_SESSION['Check-Terms'];
	
	if($totalSum == 4) {
		$_SESSION['Check-TrainingAgreement'] = 1;
	} else {
		$_SESSION['Check-TrainingAgreement'] = 0;
	}
} else if(isset($_SESSION['NZPrintUserID'])) {
	updateProgressFromSession();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Skills Enrolment</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

	<script src="../bower_components/jquery/dist/jquery.min.js"></script>
	
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../dist/css/intlTelInput.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link rel="icon" href="../favicon.ico" sizes="16x16 32x32" type="image/png">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style type="text/css">
		.valueName {
			width: 200px;
		}
		.ft {
			font-weight: bold;
		}
	</style>
	
	
	<?php if(isset($xmpie)) { ?>
	<link href="https://ajax.xmcircle.com/ajax/libs/xmpl/1.8/xmp/css/xmp.css" rel="stylesheet" media="screen">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://ajax.xmcircle.com/ajax/libs/xmpl/1.8/xmp/js/xmp.min.js"></script>
	<script src="../bower_components/xmpie/xmpcfg.js"></script>
	<?php } ?>
	
</head>

<body <?php if(isset($xmpie)) { print $xmpie; } ?> onload="load()">
    <script type="text/javascript">
        function load(){
            document.getElementById("logo").src = "../application/views/Login/logos/" + localStorage.getItem("logo");
        }
    </script>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" name="top">
				<?php if(isset($_SESSION['userEmail'])) { print $_SESSION['userEmail']; } else print 'Skills International Enrolment'; ?>
				</a>
            </div>
            <!-- /.navbar-header -->
			<?php if(isset($_SESSION['userEmail'])) { ?>
            <ul class="nav navbar-top-links navbar-right">
				
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>-->
                        <li><a href="login.php?logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
				
                <!-- /.dropdown -->
            </ul><?php } ?>
            <!-- /.navbar-top-links -->
			
			
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
					
						<li class="sidebar-search">
                            <center><img src="" height="50px" width="135px" id="logo"/></center>
                        </li>
                        <?php
						 if(isset($_SESSION['userEmail'])) { 
							include "sidebar.php";
						 } else {
						?>
						<li>
							<a href="login.php"><i class="fa fa-user fa-fw"></i> Login</a>
						</li>
						 <?php } ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
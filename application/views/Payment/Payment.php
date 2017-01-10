<?php
include "include/header.php";
include "include/PxPay_OpenSSL.inc.php";

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

//$PxPay_Url    = "https://sec.paymentexpress.com/pxaccess/pxpay.aspx";
$PxPay_Url    = "https://uat.paymentexpress.com/pxaccess/pxpay.aspx";
$PxPay_Userid = "PerceptionGroup_Dev"; #Important! Update with your UserId
$PxPay_Key    =  "840924266bd01037e9eb601de911c3d5cb4e2e2e51d3fd03d85b9e63c5957ff4"; #Important! Update with your Key

#
# MAIN
#

$pxpay = new PxPay_OpenSSL( $PxPay_Url, $PxPay_Userid, $PxPay_Key );

/*$totalSum = $_SESSION['Check-TraineeInformation'] + $_SESSION['Check-EmployerInformation'] + 
	$_SESSION['Check-ContactDetails'] + $_SESSION['Check-Education'] + 
	$_SESSION['Check-LearningSkills'] +
	$_SESSION['Check-ProofIdentity'] + $_SESSION['Check-Citizenship'] + $_SESSION['Check-Terms'];

if($totalSum != 8) {
	header ("Location: index.php");
}*/

echo ($_GET["form"] . " - " . $_GET['uid']);

$sql = $conn->prepare("SELECT firstName, lastName FROM " . $_GET["form"] . " WHERE uid=?");
$sql->bind_param("s", $_GET["uid"]);
$sql->execute();
$sql->bind_result($FirstName, $LastName);
if(!$sql->fetch()) header ("Location: index.php/Dashboard");
else {
		$ref = "PG1 " . strtoupper(substr($FirstName, 0, 1).substr($LastName, 0, 1)."-".$_GET["uid"]);
}
$sql->close();

if(isset($_GET['submitter'])) { //form submitted... send to payments page
	 //global $pxpay;
  $request = new PxPayRequest();

  $http_host   = getenv("HTTP_HOST");
  $request_uri = getenv("SCRIPT_NAME");
  $server_url  = "http://$http_host";
  #$script_url  = "$server_url/$request_uri"; //using this code before PHP version 4.3.4
  #$script_url  = "$server_url$request_uri"; //Using this code after PHP version 4.3.4
  $script_url = (version_compare(PHP_VERSION, "4.3.4", ">=")) ?"$server_url$request_uri" : "$server_url/$request_uri";
  
  
  
  //$address1 = $_POST['addr1'];
  //$address2 = $_POST['addr2'];
  //$address3 = $_POST['addr3'];
  $address1 = "";
  $address2 = "";
  $address3 = "";
  $TxnId = uniqid("ID");
  
  $request->setMerchantReference($ref);
  $request->setAmountInput($_GET["amount"]);
  $request->setTxnData1($address1);
  $request->setTxnData2($address2);
  $request->setTxnData3($address3);
  $request->setTxnType("Purchase");
  $request->setCurrencyInput("NZD");
  $request->setEmailAddress($_GET["uid"]);
  $request->setUrlFail($script_url);			# can be a dedicated failure page
  $request->setUrlSuccess($script_url);			# can be a dedicated success page
  $request->setTxnId($TxnId);  
  #Call makeRequest function to obtain input XML
  $request_string = $pxpay->makeRequest($request);
   
  #Obtain output XML
  $response = new MifMessage($request_string);
  
  #Parse output XML
  $url = $response->get_element_text("URI");
  $valid = $response->get_attribute("valid");
   
  #Redirect to payment page
  header("Location: ".$url);
} else if (isset($_REQUEST["result"])) {
    # this is a redirection from the payments page.
	$enc_hex = $_REQUEST["result"];
  #getResponse method in PxPay object returns PxPayResponse object
  #which encapsulates all the response data
  $rsp = $pxpay->getResponse($enc_hex);

  # the following are the fields available in the PxPayResponse object
  $Success           = $rsp->getSuccess();   # =1 when request succeeds
  $AmountSettlement  = $rsp->getAmountSettlement();
  $AuthCode          = $rsp->getAuthCode();  # from bank
  $CardName          = $rsp->getCardName();  # e.g. "Visa"
  $CardNumber        = $rsp->getCardNumber(); # Truncated card number
  $DateExpiry        = $rsp->getDateExpiry(); # in mmyy format
  $DpsBillingId      = $rsp->getDpsBillingId();
  $BillingId    	 = $rsp->getBillingId();
  $CardHolderName    = $rsp->getCardHolderName();
  $DpsTxnRef	     = $rsp->getDpsTxnRef();
  $TxnType           = $rsp->getTxnType();
  $TxnData1          = $rsp->getTxnData1();
  $TxnData2          = $rsp->getTxnData2();
  $TxnData3          = $rsp->getTxnData3();
  $CurrencySettlement= $rsp->getCurrencySettlement();
  $ClientInfo        = $rsp->getClientInfo(); # The IP address of the user who submitted the transaction
  $TxnId             = $rsp->getTxnId();
  $CurrencyInput     = $rsp->getCurrencyInput();
  $EmailAddress      = $rsp->getEmailAddress();
  $MerchantReference = $rsp->getMerchantReference();
  $ResponseText		 = $rsp->getResponseText();
  $TxnMac            = $rsp->getTxnMac(); # An indication as to the uniqueness of a card used in relation to others
  
  $stmt = $conn->prepare("INSERT INTO PaymentLog (NZPrintUserID, Success, AmountSettlement, AuthCode, CardName, CardNumber, DateExpiry, DpsBillingId, BillingId, CardHolderName, DpsTxnRef, TxnType, TxnData1, TxnData2, TxnData3, CurrencySettlement, ClientInfo, TxnId, CurrencyInput, PaymentEmailAddress, MerchantReference, ResponseText, TxnMac) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
  $stmt->bind_param("sssssssssssssssssssssss", $_GET['uid'], $Success, $AmountSettlement, $AuthCode, $CardName, $CardNumber, $DateExpiry, $DpsBillingId, $BillingId, $CardHolderName, $DpsTxnRef, $TxnType, $TxnData1, $TxnData2, $TxnData3, $CurrencySettlement, $ClientInfo, $TxnId, $CurrencyInput, $EmailAddress, $MerchantReference, $ResponseText, $TxnMac);
  $stmt->execute();
  $stmt->close();
  
  if($Success == "1") {
	  $stmt = $conn->prepare("UPDATE Users SET Locked=1 WHERE NZPrintUserID=?");
	  $stmt->bind_param("i", $_GET['uid']);
	  $stmt->execute();
	  $stmt->close();
	  $_SESSION['userLock'] = 1;
	  
	  $sendMailTo = $_GET['uid'];
	  $sendMailSubject = "Skills Enrolment Complete";
	  $sendMailMessage = '
<html>
<head><title>Skills Enrolment Complete</title></head>
<body>
<p>Dear '.FirstName.'</p>
<p>Welcome to The Skills Organisation and thank you for enrolling in the National Certificate in Real Estate (Salesperson). We thank you for your payment.</p>
<p>Once your enrolment is processed, including proof of identification verification, you will receive an email with details for access to the Real Estate assessment material. This will be within 3 business days.</p>
<p>If you have any further enquiries in the meantime please email <a href="mailto:support@skills.org.nz">support@skills.org.nz</a>, complete the contact us form on our website, or call us on 0508 754 557 (Monday to Thursday 7am to 7pm, Friday 7am to 5pm), and a Customer Service Representative will be available to help you.</p>
<p>We wish you all the best with your training programme.<br /><br />The Skills team</p>
</body>
</html>
';
		// To send HTML mail, the Content-type header must be set
		$sendMailHeaders  = 'MIME-Version: 1.0' . "\r\n";
		$sendMailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$sendMailHeaders .= 'From: Perception Group <no-reply@perceptiongroup.co.nz>' . "\r\n";
		//TODO IMPLEMENT THIS
		mail($sendMailTo, $sendMailSubject, $sendMailMessage, $sendMailHeaders);
	  
	  
	  
	  
	  header ("Location: review.php");
  } else {
	  $formError = true;
  }
}





?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Payment</h1>
		<div class="panel panel-default">
			<div class="panel-body">
			
			
				<form class="form-horizontal" action="Payment.php" method="post">
				  <div class="form-group <?php if (isset($companyNameError)) print "has-error"; ?>">
					<label for="companyName" class="col-lg-2 control-label">Total Cost</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="cost" value="$1095.00 (This includes GST of $142.83)" disabled="true"/>
					</div>
				  </div>
				  <input type="hidden" name="submitter" value="3456g34624g2352351as2433578" />
				  <div class="form-group">
					<label for="ref" class="col-lg-2 control-label">Reference</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="ref" placeholder="Trading As" value="<?php if(isset($ref)) {print $ref;} ?>" disabled="true" />
					</div>
				  </div>
				  <!--
				  <div class="form-group">
					<label for="addr1" class="col-lg-2 control-label">Address 1</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="addr1" placeholder="Address Line 1" />
					</div>
				  </div>
				  <div class="form-group">
					<label for="addr2" class="col-lg-2 control-label">Address 2</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="addr2" placeholder="Address Line 2" />
					</div>
				  </div>
				  <div class="form-group">
					<label for="addr3" class="col-lg-2 control-label">Address 3</label>
					<div class="col-lg-10">
					  <input type="text" class="form-control" name="addr3" placeholder="Address Line 3" />
					</div>
				  </div>-->
				  <?php if(isset($formError)) { ?>
				  <div class="alert alert-danger col-lg-offset-2 col-lg-10">
					Your payment was not accepted, please try again
				  </div>
				  <?php } ?>
				  
				  <p class="help-block col-lg-offset-2 col-lg-10">You are about to be redirected to our payment gateway. The total cost you are required to pay is $1095.00</p>
				  <p class="help-block col-lg-offset-2 col-lg-10">If you need a printed record of this transaction please print the confirmation page after payment</p>
				  <p class="help-block col-lg-offset-2 col-lg-10">We will send you an email confirming that your enrolment is complete after payment has been made</p>
				  
				<div class="input-group col-lg-offset-2 col-lg-10"><button class="btn btn-default" type="submit">Pay with Credit Card</button></div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?php
include "include/footer.php";
?>
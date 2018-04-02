<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery-3.3.1.js" ></script>
<script src="js/bootstrap.js" ></script>

<title>Home</title>
</head>

<body>
<?php 
	include('head.php');
	include('Connection.php');
	session_start();
	/*if($_SESSION['user']=="")
		header("Location:login.php");
	*/

	$referenceNumber = $_SESSION['referenceNumber'];
	$date = $_SESSION['date'];
	$patientName = $_SESSION['patientName'];
	$age = $_SESSION['age'];
	$gender = $_SESSION['gender'];
	$address = $_SESSION['address'];
	$mobileNumber = $_SESSION['mobileNumber'];
	$registrationNumber = $_SESSION['registrationNumber'];
	$deliveryDate = $_SESSION['deliveryDate'];
	$frameCode = $_SESSION['frameCode'];
	$leftEyeCompanyName = $_SESSION['leftEyeCompanyName'];
	$leftEyeLensType = $_SESSION['leftEyeLensType'];
	$leftEyeSubLensType = $_SESSION['leftEyeSubLensType'];
	$leftEyeGlassColor = $_SESSION['leftEyeGlassColor'];
	$leftEyeSphPower = $_SESSION['leftEyeSphPower'];
	$leftEyeCylPower = $_SESSION['leftEyeCylPower'];
	$leftEyeAxis = $_SESSION['leftEyeAxis'];
	$rightEyeCompanyName = $_SESSION['rightEyeCompanyName'];
	$rightEyeLensType = $_SESSION['rightEyeLensType'];
	$rightEyeSubLensType = $_SESSION['rightEyeSubLensType'];
	$rightEyeGlassColor = $_SESSION['rightEyeGlassColor'];
	$rightEyeSphPower = $_SESSION['rightEyeSphPower'];
	$rightEyeCylPower = $_SESSION['rightEyeCylPower'];
	$rightEyeAxis = $_SESSION['rightEyeAxis'];
	$frameAmount = $_SESSION['frameAmount'];
	$glassAmount = $_SESSION['glassAmount'];
	$spll = $_SESSION['spll'];
	$advance = $_SESSION['advance'];
	
?>
	
</body>
</html>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sale</title>
<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery-3.3.1.js" ></script>
<script src="js/bootstrap.js" ></script>
</head>
<script>
	function copy(){
		
		var leftEyeLensName = document.forms["saleForm"]["leftEyeLensName"].value;
		var leftEyeSphPower = document.forms["saleForm"]["leftEyeSphPower"].value;
		var leftEyeCylPower = document.forms["saleForm"]["leftEyeCylPower"].value;
		var leftEyeAxis = document.forms["saleForm"]["leftEyeAxis"].value;
		
		document.forms["saleForm"]["rightEyeLensName"].value = leftEyeLensName;
		document.forms["saleForm"]["rightEyeSphPower"].value = leftEyeSphPower;
		document.forms["saleForm"]["rightEyeCylPower"].value = leftEyeCylPower;
		document.forms["saleForm"]["rightEyeAxis"].value = leftEyeAxis;
		
	}
	function calculate(){
		var frameAmount = parseInt( document.forms["saleForm"]["frameAmount"].value);
		var glassAmount = parseInt( document.forms["saleForm"]["glassAmount"].value);
		var spll = parseInt( document.forms["saleForm"]["spll"].value);
		var advance = parseInt( document.forms["saleForm"]["advance"].value);
		if((frameAmount + glassAmount - spll - advance)<0){
			
			document.getElementById("bills").disabled = true;
			document.getElementById("sales").disabled = true;
			
		}
		else{
			document.getElementById("bills").disabled = false;
			document.getElementById("sales").disabled = false;
		}
		var balance = frameAmount + glassAmount - spll - advance;
		document.forms["saleForm"]["balance"].value = balance;
		
	}
</script>
<body>
	<?php 
		include('head.php');
		include('Connection.php');
		/*session_start();
		if($_SESSION['user']=="")
			header("Location:login.php");*/
		$insertionError ="";
		function insertToDB($sql){
			include('Connection.php');
			$insertionError ="";
				if($db->query($sql)=== TRUE)
				{
					
					$insertionError = "<font  size='+5' color=#00ff00>Insertion Successfully.</font>";
				}
				else{
					$insertionError = "<font size='+5' color=#FF0000>Insertion Failed please enter correct information.</font>";
					echo "<script>console.log(Error: " . $sql . "<br>" . $db->error .");</script>";
					break;
				}
		}
		$maxReferenceNumber = 0;
		//fetch max reference number from db of sale
			$sql = "SELECT MAX(RefenceNumber) as maxRefernceNumber from sale";
			$query=mysqli_query($db,$sql);
			$count = mysqli_num_rows($query);
			if($count>0)
				while($row= mysqli_fetch_assoc($query))
					$maxReferenceNumber = $row['maxRefernceNumber'];
			$maxReferenceNumber++;
		if(isset($_POST['sale'])){
			$referenceNumber = $_POST['referenceNumber'];
			$date = $_POST['date'];
			$patientName = $_POST['patientName'];
			$age = $_POST['age'];
			$gender = $_POST['gender'];
			$address = $_POST['address'];
			$mobileNumber = $_POST['mobileNumber'];
			$registrationNumber = $_POST['registrationNumber'];
			$deliveryDate = $_POST['deliveryDate'];
			$frameCode = $_POST['frameCode'];
			$leftEyeLensName = $_POST['leftEyeLensName'];
			$leftEyeSphPower = $_POST['leftEyeSphPower'];
			$leftEyeCylPower = $_POST['leftEyeCylPower'];
			$leftEyeAxis = $_POST['leftEyeAxis'];
			$rightEyeLensName = $_POST['rightEyeLensName'];
			$rightEyeSphPower = $_POST['rightEyeSphPower'];
			$rightEyeCylPower = $_POST['rightEyeCylPower'];
			$rightEyeAxis = $_POST['rightEyeAxis'];
			$frameAmount = $_POST['frameAmount'];
			$glassAmount = $_POST['glassAmount'];
			$spll = $_POST['spll'];
			$advance = $_POST['advance'];
			// Fetch total quantity of particular lens for left eye
		/*	$sql = "SELECT SUM(Quantity) AS totalQuantity FROM lens WHERE LensName='$leftEyeLensName' and LensType='$leftEyeLensType' AND SubLensType='$leftEyeSubLensType' and GlassColor='$leftEyeGlassColor' and PowerSph='$leftEyeSphPower' and PowerCyl='$leftEyeCylPower'";
			// get total Quantity
			$query=mysqli_query($db,$sql);
			if($data  = mysqli_fetch_assoc($query) )
				$totalQuantityLeft = $data['totalQuantity'];
			
			// fetch used quantity of lens for left eye
			$sql = "SELECT COUNT(*) as usedQuantity FROM sale WHERE CompanyName='$leftEyeCompanyName' and LensType='$leftEyeLensType' AND SubLensType='$leftEyeSubLensType' and GlassColor='$leftEyeGlassColor' and PowerSph='$leftEyeSphPower' and PowerCyl='$leftEyeCylPower'";		
			$query=mysqli_query($db,$sql);
			if($data  = mysqli_fetch_assoc($query) )
				$usedQuantityLeft = $data['usedQuantity'];
			
			
			// Fetch total quantity of particular lens for right eye
			$sql = "SELECT SUM(Quantity) AS totalQuantity FROM lens WHERE CompanyName='$rightEyeCompanyName' and LensType='$rightEyeLensType' AND SubLensType='$rightEyeSubLensType' and GlassColor='$rightEyeGlassColor' and PowerSph='$rightEyeSphPower' and PowerCyl='$rightEyeCylPower'";
			// get total Quantity
			$query=mysqli_query($db,$sql);
			if($data  = mysqli_fetch_assoc($query) )
				$totalQuantityRight = $data['totalQuantity'];
			
			// fetch used quantity of lens for right eye
			$sql = "SELECT COUNT(*) as usedQuantity FROM sale WHERE CompanyName='$rightEyeCompanyName' and LensType='$rightEyeLensType' AND SubLensType='$rightEyeSubLensType' and GlassColor='$rightEyeGlassColor' and PowerSph='$rightEyeSphPower' and PowerCyl='$rightEyeCylPower'";		
			$query=mysqli_query($db,$sql);
			if($data  = mysqli_fetch_assoc($query) )
				$usedQuantityRight = $data['usedQuantity'];
			*/
			// inserting if lens available for left lens
					$sql = "INSERT INTO sale(UniqueCode, LensName, PowerSph, PowerCyl, RefenceNumber, Date, Age, Gender, PatientName, Address, MobileNumber, DeliveryDate, RegistrationNumber, FrameAmount, GlassAmount, SPLL, Advance, Eye, Axis, isDeliver)  VALUES('$frameCode','$rightEyeLensName','$rightEyeSphPower','$rightEyeCylPower',$maxReferenceNumber,'$date',$age,'$gender','$patientName','$address','$mobileNumber','$deliveryDate','$registrationNumber',$frameAmount,$glassAmount,$spll,$advance,'right',$rightEyeAxis,0)";
					insertToDB($sql);
				
					$sql = "INSERT INTO sale(UniqueCode, LensName, PowerSph, PowerCyl, RefenceNumber, Date, Age, Gender, PatientName, Address, MobileNumber, DeliveryDate, RegistrationNumber, FrameAmount, GlassAmount, SPLL, Advance, Eye, Axis, isDeliver) VALUES ('$frameCode','$leftEyeLensName','$leftEyeSphPower','$leftEyeCylPower',$maxReferenceNumber,'$date',$age,'$gender','$patientName','$address','$mobileNumber','$deliveryDate','$registrationNumber',$frameAmount,$glassAmount,$spll,$advance,'left',$leftEyeAxis,0)";
					insertToDB($sql);
					$sql = "UPDATE frame SET IsUsed=1 WHERE UniqueCode = '$frameCode'";
					insertToDB($sql);	
		}
	
		if(isset($_POST['bill'])){
			$referenceNumber = $_POST['referenceNumber'];
			$date = $_POST['date'];
			$patientName = $_POST['patientName'];
			$age = $_POST['age'];
			$gender = $_POST['gender'];
			$address = $_POST['address'];
			$mobileNumber = $_POST['mobileNumber'];
			$registrationNumber = $_POST['registrationNumber'];
			$deliveryDate = $_POST['deliveryDate'];
			$frameCode = $_POST['frameCode'];
			$leftEyeLensName = $_POST['leftEyeLensName'];
			$leftEyeSphPower = $_POST['leftEyeSphPower'];
			$leftEyeCylPower = $_POST['leftEyeCylPower'];
			$leftEyeAxis = $_POST['leftEyeAxis'];
			$rightEyeLensName = $_POST['rightEyeLensName'];
			$rightEyeSphPower = $_POST['rightEyeSphPower'];
			$rightEyeCylPower = $_POST['rightEyeCylPower'];
			$rightEyeAxis = $_POST['rightEyeAxis'];
			$frameAmount = $_POST['frameAmount'];
			$glassAmount = $_POST['glassAmount'];
			$spll = $_POST['spll'];
			$advance = $_POST['advance'];
			// Fetch total quantity of particular lens for left eye
/*			$sql = "SELECT SUM(Quantity) AS totalQuantity FROM lens WHERE CompanyName='$leftEyeCompanyName' and LensType='$leftEyeLensType' AND SubLensType='$leftEyeSubLensType' and GlassColor='$leftEyeGlassColor' and PowerSph='$leftEyeSphPower' and PowerCyl='$leftEyeCylPower'";
			// get total Quantity
			$query=mysqli_query($db,$sql);
			if($data  = mysqli_fetch_assoc($query) )
				$totalQuantityLeft = $data['totalQuantity'];
			
			// fetch used quantity of lens for left eye
			$sql = "SELECT COUNT(*) as usedQuantity FROM sale WHERE CompanyName='$leftEyeCompanyName' and LensType='$leftEyeLensType' AND SubLensType='$leftEyeSubLensType' and GlassColor='$leftEyeGlassColor' and PowerSph='$leftEyeSphPower' and PowerCyl='$leftEyeCylPower'";		
			$query=mysqli_query($db,$sql);
			if($data  = mysqli_fetch_assoc($query) )
				$usedQuantityLeft = $data['usedQuantity'];
			
			
			// Fetch total quantity of particular lens for right eye
			$sql = "SELECT SUM(Quantity) AS totalQuantity FROM lens WHERE CompanyName='$rightEyeCompanyName' and LensType='$rightEyeLensType' AND SubLensType='$rightEyeSubLensType' and GlassColor='$rightEyeGlassColor' and PowerSph='$rightEyeSphPower' and PowerCyl='$rightEyeCylPower'";
			// get total Quantity
			$query=mysqli_query($db,$sql);
			if($data  = mysqli_fetch_assoc($query) )
				$totalQuantityRight = $data['totalQuantity'];
			
			// fetch used quantity of lens for right eye
			$sql = "SELECT COUNT(*) as usedQuantity FROM sale WHERE CompanyName='$rightEyeCompanyName' and LensType='$rightEyeLensType' AND SubLensType='$rightEyeSubLensType' and GlassColor='$rightEyeGlassColor' and PowerSph='$rightEyeSphPower' and PowerCyl='$rightEyeCylPower'";		
			$query=mysqli_query($db,$sql);
			if($data  = mysqli_fetch_assoc($query) )
				$usedQuantityRight = $data['usedQuantity'];
*/			
			// inserting if lens available for left lens
//			if($totalQuantityLeft>$usedQuantityLeft){
//				if($totalQuantity>$usedQuantity){     // totalQuantity variable is for right 
					$sql = "INSERT INTO sale(UniqueCode, LensName, PowerSph, PowerCyl, RefenceNumber, Date, Age, Gender, PatientName, Address, MobileNumber, DeliveryDate, RegistrationNumber, FrameAmount, GlassAmount, SPLL, Advance, Eye, Axis, isDeliver)  VALUES('$frameCode','$rightEyeLensName','$rightEyeSphPower','$rightEyeCylPower',$maxReferenceNumber,'$date',$age,'$gender','$patientName','$address','$mobileNumber','$deliveryDate','$registrationNumber',$frameAmount,$glassAmount,$spll,$advance,'right',$rightEyeAxis,0)";
					insertToDB($sql);
				
					$sql = "INSERT INTO sale(UniqueCode, LensName, PowerSph, PowerCyl, RefenceNumber, Date, Age, Gender, PatientName, Address, MobileNumber, DeliveryDate, RegistrationNumber, FrameAmount, GlassAmount, SPLL, Advance, Eye, Axis, isDeliver) VALUES ('$frameCode','$leftEyeLensName','$leftEyeSphPower','$leftEyeCylPower',$maxReferenceNumber,'$date',$age,'$gender','$patientName','$address','$mobileNumber','$deliveryDate','$registrationNumber',$frameAmount,$glassAmount,$spll,$advance,'left',$leftEyeAxis,0)";
					insertToDB($sql);
					$sql = "UPDATE frame SET IsUsed=1 WHERE UniqueCode = '$frameCode'";
					insertToDB($sql);	
					
					// reflect to new page for bill printing
					session_start();
					$_SESSION['referenceNumber'] = $referenceNumber;
					$_SESSION['date'] = $date;
					$_SESSION['patientName'] = $patientName;
					$_SESSION['age'] = $age;
					$_SESSION['gender'] = $gender;
					$_SESSION['address'] = $address;
					$_SESSION['mobileNumber'] = $mobileNumber;
					$_SESSION['registrationNumber'] = $registrationNumber;
					$_SESSION['deliveryDate'] = $deliveryDate;
					$_SESSION['frameCode'] = $frameCode;
					$_SESSION['leftEyeCompanyName'] = $leftEyeCompanyName;
					$_SESSION['leftEyeLensType'] = $leftEyeLensType;
					$_SESSION['leftEyeSubLensType'] = $leftEyeSubLensType;
					$_SESSION['leftEyeGlassColor'] = $leftEyeGlassColor;
					$_SESSION['leftEyeSphPower'] = $leftEyeSphPower;
					$_SESSION['leftEyeCylPower'] = $leftEyeCylPower;
					$_SESSION['leftEyeAxis'] = $leftEyeAxis;
					$_SESSION['rightEyeCompanyName'] = $rightEyeCompanyName;
					$_SESSION['rightEyeLensType'] = $rightEyeLensType;
					$_SESSION['rightEyeSubLensType'] = $rightEyeSubLensType;
					$_SESSION['rightEyeGlassColor'] = $rightEyeGlassColor;
					$_SESSION['rightEyeSphPower'] = $rightEyeSphPower;
					$_SESSION['rightEyeCylPower'] = $rightEyeCylPower;
					$_SESSION['rightEyeAxis'] = $rightEyeAxis;
					$_SESSION['frameAmount'] = $frameAmount;
					$_SESSION['glassAmount'] = $glassAmount;
					$_SESSION['spll'] = $spll;
					$_SESSION['advance'] = $advance;
					header('location:bill.php');
					
//				}
//				else{
//					$insertionError = "<font size='+5' color=#FF0000>Lens of right eye are not available.</font>";	
//				}
//			}
//			else{
//				$insertionError = "<font size='+5' color=#FF0000>Lens of left eye are not available.</font>" + $insertionError;	
//			}
			
	
		}
	?>
	<div class="container">
		<?php echo $insertionError; ?>
		<form  class="form-horizontal" method="post" name="saleForm">
			<div class="form-group">
				<label class="control-label col-sm-2">Reference Number:</label>
				<div class="col-sm-3">
					<input type="number" required class="form-control"  value="<?php echo $maxReferenceNumber;?>" min="<?php echo $maxReferenceNumber;?>"  name="referenceNumber">
				</div>
				<label class="control-label col-sm-2">Date:</label>
				<div class="col-sm-3">
					<input type="date" class="form-control" required name="date" value="<?php echo date("Y-m-d");?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Registration Number:</label>
				<div class="col-sm-3">
					<input type="text" required class="form-control" maxlength="20" name="registrationNumber">
				</div>
				<label class="control-label col-sm-2">Delivery Date:</label>
				<div class="col-sm-3">
					<input type="date" class="form-control" name="deliveryDate" required value="<?php echo date("Y-m-d");?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Patient Name:</label>
				<div class="col-sm-8">
					<input type="text" maxlength="50" required class="form-control" name="patientName">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Age:</label>
				<div class="col-sm-3">
					<input type="number" required class="form-control" min="1" max="110" name="age">
				</div>
				<label class="control-label col-sm-2">Gender:</label>
				<div class="col-sm-3">
					<input type="radio" name="gender" checked value="Male">Male &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="gender" value="Female">Female
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Address:</label>
				<div class="col-sm-8">
					<input type="text" maxlength="100" required class="form-control" name="address">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Mobile Number:</label>
				<div class="col-sm-8">
					<input type="number" maxlength="10" min="999999999" max="10000000000" required class="form-control" name="mobileNumber">
				</div>
			</div>
			
			
			
			<div class="form-group">
				<label class="control-label col-sm-2">Frame Code:</label>
				<div class="col-sm-8">
					<input type="text" maxlength="50" required class="form-control" name="frameCode">
					<input list="frameCode" maxlength="50" name="frameCode" class="form-control" required>
				</div>
				<dataList id="frameCode">
			  <?php
					$query=mysqli_query($db,"Select DISTINCT(UniqueCode)  From lens");
					while($row = mysqli_fetch_assoc($query)){
						$List = $row['UniqueCode'];
						echo "<option value=$List>$List</option>";
					}
				?>
				</dataList>
				</div>
			
			
			<div class="col-sm-5" style="border: groove;">
				<label>Left Eye Lens</label>
				<div class="form-group">
				<label class="control-label col-sm-1">Power</label><br>
				<div class="col-lg-5">
					<label class="control-label col-sm-2">Sph</label>
					<div class="col-sm-10">
						<input type="number" name="leftEyeSphPower" maxlength="10" class="form-control" required>
					</div>
				</div>
				<div class="col-lg-5">
					<label class="control-label col-sm-2">Cyl</label>
					<div class="col-sm-10">
						<input type="number" name="leftEyeCylPower" maxlength="10" class="form-control" required>
					</div>
				</div>
				</div>
				<div class="form-group">
				<label class="control-label col-sm-2">Axis:</label>
				<div class="col-sm-8">
					<input type="number" required class="form-control" name="leftEyeAxis">
				</div>
				</div>
			
				<div class="form-group">
				<label class="control-label col-sm-2">Lens Name</label>
				<div class="col-sm-10">
					<input list="leftEyeLensName" maxlength="50" name="leftEyeLensName" class="form-control" required>
				</div>
				<dataList id="leftEyeLensName">
			  <?php
					$query=mysqli_query($db,"Select DISTINCT(LensName)  From lens");
					while($row = mysqli_fetch_assoc($query)){
						$List = $row['LensName'];
						echo "<option value=$List>$List</option>";
					}
				?>
				</dataList>
				
			</div>		
			
			
			
			
			
			
			</div>
			<div class="col-sm-2" >
				<br><br><br><br><br><br>
				<center><a style="border: groove;" onClick="copy();"><span class="glyphicon glyphicon-transfer" style="font-size: 40px;"></span></a></center>
			</div>
			<div class="col-sm-5" style="border: groove;">
				<label>Right Eye Lens</label>
				<div class="form-group">
					<label class="control-label col-sm-1">Power</label><br>
					<div class="col-lg-5">
						<label class="control-label col-sm-2">Sph</label>
						<div class="col-sm-10">
							<input type="number" name="rightEyeSphPower" maxlength="10" class="form-control" required>
						</div>
					</div>
					<div class="col-lg-5">
						<label class="control-label col-sm-2">Cyl</label>
						<div class="col-sm-10">
							<input type="number" name="rightEyeCylPower" maxlength="10" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Axis:</label>
					<div class="col-sm-8">
						<input type="number" maxlength="30" required class="form-control" name="rightEyeAxis">
					</div>
				</div>
				
				<div class="form-group">
				<label class="control-label col-sm-2">Lens Name</label>
				<div class="col-sm-10">
					<input list="rightEyeLensName" maxlength="50" name="rightEyeLensName" class="form-control" required>
				</div>
				<dataList id="rightEyeLensName">
			    <?php
					$query=mysqli_query($db,"Select DISTINCT(LensName)  From lens");
					$count=mysqli_num_rows($query);
					while($row = mysqli_fetch_assoc($query)){
						$List = $row['LensName'];
						echo "<option value=$List>$List</option>";
					}
				?>
				</dataList>
				
				</div>		
				

				
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Frame Amount:</label>
				<div class="col-sm-8">
					<input type="number" required class="form-control" value="0" onKeyUp="calculate();" name="frameAmount">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Glass Amount:</label>
				<div class="col-sm-8">
					<input type="number" maxlength="30" value="0" onKeyUp="calculate();" required class="form-control" name="glassAmount">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">SPLL:</label>
				<div class="col-sm-8">
					<input type="number" maxlength="30" value="0" onKeyUp="calculate();" required class="form-control" name="spll">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Advance:</label>
				<div class="col-sm-8">
					<input type="number" maxlength="30" value="0" onKeyUp="calculate();" required class="form-control" name="advance">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Balance:</label>
				<div class="col-sm-8">
					<input type="number" maxlength="30" required class="form-control" name="balance">
				</div>
			</div>
				<input type="submit"  name="sale" id="sales" value="Submit" class="btn btn-lg btn-primary">
				<input type="reset"  name="reset" class="btn btn-lg btn-danger">
				<input type="button"  name="bill" id="bills" value="Bill" class="btn btn-lg btn-primary">
		</form>
		
	</div>
</body>
</html>

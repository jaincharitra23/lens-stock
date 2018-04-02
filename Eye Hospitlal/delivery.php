<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delivery</title>
<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery-3.3.1.js" ></script>
<script src="js/bootstrap.js" ></script>
<script>
	var xmlHttp;
	function showDetails(str){
		if(typeof XMLHttpRequest != "undefined"){
			xmlHttp= new XMLHttpRequest();
		}
		else if(window.ActiveXObject){
			xmlHttp = new ActiveXObject("MicrosoftXMLHTTP");
		}
		if(xmlHttp == null){
			alert("Browser does not support XMLHTTP request");
			return;
		}
		var url = "delivery_xml.php";
		url += "?value=" + str;
		xmlHttp.onreadystatechange = stateChange;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
		
	}
	function stateChange(){
		if(xmlHttp.readyState==4||xmlHttp.readyState=='complete'){
			myObj = JSON.parse(xmlHttp.responseText);
			if(myObj == "noRecord"){
				alert("This is delivered or wrong record");
				document.getElementById("update").disabled = true;
				
			}
			else{
				document.getElementById("update").disabled = false;
			
				document.getElementById("patientName").innerHTML = myObj['PatientName'];
				document.getElementById("mobileNumber").innerHTML = myObj['MobileNumber'];
				frameAmount = parseInt( myObj['FrameAmount']);
				glassAmount = parseInt( myObj['GlassAmount']);
				spll = parseInt( myObj['SPLL']);
				advance = parseInt( myObj['Advance']);
				totalAmount = frameAmount + glassAmount - spll;
				balance = totalAmount - advance;
				document.getElementById("totalAmount").innerHTML = totalAmount;
				document.getElementById("balance").innerHTML = balance;
			}
		}
	}
</script>
</head>
<body>
	<?php
		include('head.php');
		include('Connection.php');
		/*session_start();
		if($_SESSION['user']=="")
			header("Location:login.php");*/
		$insertionError="";
		if(isset($_POST['refrenence'])){
			$referenceNumber = $_POST['refenceNumber'];
			$sql = "SELECT * FROM sale WHERE RefenceNumber = $referenceNumber";
			$query=mysqli_query($db,$sql);
			$count=mysqli_num_rows($query);
			if($data = mysqli_fetch_assoc($query)){
				
				
				$frameAmount = $data['FrameAmount'];
				$glassAmount = $data['GlassAmount'];
				$spll = $data['SPLL'];
				$advance = $data['Advance'];
				$totalAmount = $frameAmount + $glassAmount -$spll;
				$balance = $totalAmount - $advance;
			}
		}
		if(isset($_POST['update'])){
			$referenceNumber = $_POST['refenceNumber'];
			$sql = "UPDATE sale SET isDeliver = 1  WHERE RefenceNumber = $referenceNumber";
				if($db->query($sql)=== TRUE)
				{
					//$insertionError = "<font  size='+5' color=#00ff00>Update Successfully.</font>";
				}
				else{
					$insertionError = "<font size='+5' color=#FF0000>Update Failed please enter correct information.</font>";
					echo "Error: " . $sql . "<br>" . $db->error;
				}
		}
		echo $insertionError;
	$patientName=$mobileNumber=$totalAmount=$balance=$referenceNumber="";
	?>
	<div class="container">
	
		<form name="delivery" class="form-horizontal" method="post">
			<div class="form-group">
				<label class="control-label col-sm-2">Refernce Number</label>
				<div class="col-sm-3">
					<input list="refenceNumber" name="refenceNumber" value="<?php echo $referenceNumber; ?>" maxlength="30" class="form-control" onChange="showDetails(this.value)" required>
				</div>
				<datalist id="refenceNumber">
				  <?php
					$query=mysqli_query($db,"Select DISTINCT(RefenceNumber)  From sale where isDeliver = 0");
					while($row = mysqli_fetch_assoc($query)){
						$List = $row['RefenceNumber'];
						echo "<option value=$List>$List</option>";
					}
				?>
				</datalist>
				
			</div>
			<br><label>Patient Name:&nbsp;&nbsp;&nbsp;&nbsp;</label><span id="patientName"></span>
			<br><label>Mobile Number:&nbsp;</label><span id="mobileNumber"></span>
			<br><label>Total Amount:&nbsp;&nbsp;&nbsp;&nbsp;</label><span id="totalAmount"></span>
			<br><label>Balance:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><span id="balance"></span><br>
			<input type="submit" value="Deliver" id="update" name="update">
		</form>
	</div>
</body>
</html>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery-3.3.1.js" ></script>
<script src="js/bootstrap.js" ></script>
	
<title>Purchase Frame</title>
</head>

<body>
	<?php 
		include('head.php');
		include('Connection.php');
		/*session_start();
		if($_SESSION['user']=="")
			header("Location:login.php");*/
		$insertionError=$uniqueCodeError="";
		if(isset($_POST['submitFrame'])){
			$uniqueCode = $_POST['uniqueCode'];
			$frameType = $_POST['frameType'];
			$material = $_POST['material'];
			$companyName = $_POST['companyName'];
			date_default_timezone_set('UTC');
			$timestamp = strtotime($_POST['dateOfPurchase']);
			$dateOfPurchase=date("Y-m-d", $timestamp);
			$purchaseRate = $_POST['purchaseRate'];
			$status = 0;
			$query=mysqli_query($db,"Select * From frame Where UniqueCode = '$uniqueCode'");
			$count=mysqli_num_rows($query);
			if($count>0){
				$uniqueCodeError = "Please Enter Unique Code This code is already used";
			}	
			else{
				$sql = "insert into frame values ('$uniqueCode','$dateOfPurchase','$frameType','$material','$companyName',$purchaseRate,$status)";
				if($db->query($sql)=== TRUE)
				{
					$insertionError = "<font  size='+5' color=#00ff00>Insertion Successfully.</font>";
				}
				else{
					$insertionError = "<font size='+5' color=#FF0000>Insertion Failed please enter correct information.</font>";
					//echo "Error: " . $sql . "<br>" . $db->error;
				}
			}
		}
	?>
	<form name="PurchaseFrame" class="form-horizontal" method="post" >
		<div class="container">
			<?php echo $insertionError; ?>
			<div class="form-group">
				<label class="control-label col-sm-2">Unique code:</label>
				<div class="col-sm-10">
					<input type="text" name="uniqueCode" class="form-control col-sm-10" maxlength="50" required>
				</div>
				
				<font color="#FF0004"><?php echo $uniqueCodeError; ?></font>
			</div>		
			<div class="form-group">
				<label class="control-label col-sm-2">Frame Type:</label>
				<div class="col-sm-10">
					<input list="FrameType" name="frameType" class="form-control" maxlength="20" required>
				</div>
				<dataList id="FrameType">
			  <?php
					$query=mysqli_query($db,"Select DISTINCT(FrameType)  From frame");
					$count=mysqli_num_rows($query);
					while($row = mysqli_fetch_assoc($query)){
						$frameTypeList = $row['FrameType'];
						echo "<option value=$frameTypeList>$frameTypeList</option>";
					}
				?>
			  
				</dataList>
			</div>	
			
			<div class="form-group">
				<label class="control-label col-sm-2">Material:</label>
				<div class="col-sm-10">
					<input list="Material" name="material" class="form-control" maxlength="20" required>
				</div>
				<datalist id="Material">
				  <?php
					$query=mysqli_query($db,"Select DISTINCT(Material)  From frame");
					$count=mysqli_num_rows($query);
					while($row = mysqli_fetch_assoc($query)){
						$frameTypeList = $row['Material'];
						echo "<option value=$frameTypeList>";
					}
				?>
				</datalist>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Company Name:</label>
				<div class="col-sm-10">
					<input list="Company_Name" name="companyName" class="form-control" maxlength="50" required>
				</div>
				<datalist id="Company_Name">
				  <?php
					$query=mysqli_query($db,"Select DISTINCT(CompanyName)  From frame");
					$count=mysqli_num_rows($query);
					while($row = mysqli_fetch_assoc($query)){
						$frameTypeList = $row['CompanyName'];
						echo "<option value=$frameTypeList>";
					}
				?>
				</datalist>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Date of purchase:</label>
				<div class="col-sm-6">
					<input type="date" name="dateOfPurchase" value="<?php echo date("Y-m-d");?>" class="form-control" required>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Purchase Rate:</label>
				<div class="col-sm-10">
					<input type="number" name="purchaseRate" class="form-control" required>
				</div>
			</div>
			
			<input type="submit"  name="submitFrame" class="btn btn-lg btn-primary">  	
			<input type="reset" class="btn btn-lg btn-danger">
		</div>
	</form>
</body>
</html>
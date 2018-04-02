<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery-3.3.1.js" ></script>
<script src="js/bootstrap.js" ></script>
	
<title>Purchase Lens</title>
</head>

<body>
	<?php 
		include('head.php');
		include('Connection.php');
		/*session_start();
		if($_SESSION['user']=="")
			header("Location:login.php");*/
		$insertionError = "";
		if(isset($_POST["submitLens"])){
			$companyName = $_POST["companyName"];
			$lensName = $_POST["lensName"];
			date_default_timezone_set("UTC");
			$timestamp = strtotime($_POST["dateOfPurchase"]);
			$dateOfPurchase=date("Y-m-d", $timestamp);
			$purchaseRate = $_POST["purchaseRate"];
			$lensType = $_POST["lensType"];
			$subLensType = $_POST["subLensType"];
			$glassColor = $_POST["glassColor"];
			$sphPower = $_POST["sphPower"];
			$cylPower = $_POST["cylPower"];
			$quantity = $_POST["quantity"];
			$width = $_POST["width"];
			$dimention = $_POST["dimention"];
			
			$sql = "INSERT INTO lens VALUES('$companyName','$lensName','$lensType','$subLensType','$glassColor','$sphPower','$cylPower',$quantity,$purchaseRate,'$width','$dimention','$dateOfPurchase')";
				
				if($db->query($sql)=== TRUE)
				{
					$insertionError = "<font  size='+5' color=#00ff00>Insertion Successfully.</font>";
				}
				else{
					$insertionError = "<font size='+5' color=#FF0000>Insertion Failed please enter correct information.</font>";
					echo "Error: " . $sql . "<br>" . $db->error;
				}
			
		}
	?>
	<form name="PurchaseFrame" method="post" class="form-horizontal" >
		<div class="container">
			<font color="#FF0004"><?php echo $insertionError;?></font>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Date of purchase</label>
				<div class="col-sm-10">
					<input type="date" name="dateOfPurchase" value="<?php echo date("Y-m-d");?>" class="form-control" required>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Company Name</label>
				<div class="col-sm-10">
					<input list="companyName" maxlength="40" name="companyName" class="form-control" required>
				</div>
				<dataList id="companyName">
			  <?php
					$query=mysqli_query($db,"Select DISTINCT(CompanyName)  From lens");
					$count=mysqli_num_rows($query);
					while($row = mysqli_fetch_assoc($query)){
						$List = $row['CompanyName'];
						echo "<option value=$List>$List</option>";
					}
				?>
				</dataList>
				
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Lens Name</label>
				<div class="col-sm-10">
					<input list="lensName" maxlength="50" name="lensName" class="form-control" required>
				</div>
				<dataList id="lensName">
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
					
			<div class="form-group">
				<label class="control-label col-sm-2">Lens Type</label>
				<div class="col-sm-10">	
					<input list="LensType" name="lensType" maxlength="30" class="form-control" required>
				</div>
				<dataList id="LensType">
			  <?php
					$query=mysqli_query($db,"Select DISTINCT(LensType)  From lens");
					$count=mysqli_num_rows($query);
					while($row = mysqli_fetch_assoc($query)){
						$List = $row['LensType'];
						echo "<option value=$List>$List</option>";
					}
				?>
			  
				</dataList>
			</div>	
			
			<div class="form-group">
				<label class="control-label col-sm-2">Sub Lens Type</label>
				<div class="col-sm-10">
					<input list="subLensType" name="subLensType" maxlength="30" class="form-control" required>
				</div>
			  	<datalist id="subLensType">
				  <?php
					$query=mysqli_query($db,"Select DISTINCT(SubLensType)  From lens");
					$count=mysqli_num_rows($query);
					while($row = mysqli_fetch_assoc($query)){
						$List = $row['SubLensType'];
						echo "<option value=$List>$List</option>";
					}
				?>
				</datalist>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Glass Color</label>
				<div class="col-sm-10">
					<input list="glassColor" name="glassColor" maxlength="30" class="form-control" required>
				</div>
				<datalist id="glassColor">
				  <?php
					$query=mysqli_query($db,"Select DISTINCT(GlassColor)  From lens");
					$count=mysqli_num_rows($query);
					while($row = mysqli_fetch_assoc($query)){
						$List = $row['GlassColor'];
						echo "<option value=$List>$List</option>";
					}
				?>
				</datalist>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-sm-1">Power</label><br>
				<div class="col-lg-5">
					<label class="control-label col-sm-2">Sph</label>
					<div class="col-sm-10">
						<input type="number" name="sphPower" maxlength="10" class="form-control" required>
					</div>
				</div>
				<div class="col-lg-5">
					<label class="control-label col-sm-2">Cyl</label>
					<div class="col-sm-10">
						<input type="number" name="cylPower" maxlength="10" class="form-control" required>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Quantity</label>
				<div class="col-sm-10">
					<input type="number" name="quantity" class="form-control" required>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Purchase Rate</label>
				<div class="col-sm-10">
					<input type="number" name="purchaseRate" class="form-control" required>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">Width</label>
				<div class="col-sm-10">
					<input type="number" name="width" value="0" maxlength="10" class="form-control" required>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-2">dimention</label>
				<div class="col-sm-10">
					<input type="number" name="dimention" value="0" maxlength="10" class="form-control" required>
				</div>
			</div>
			
			<input type="submit"  name="submitLens" class="btn btn-lg btn-primary">
			<input type="reset" name="submitLens" class="btn btn-lg btn-danger">  	
		</div>
	</form>
</body>
</html>
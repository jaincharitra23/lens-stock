<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery-3.3.1.js" ></script>
<script src="js/bootstrap.js" ></script>

<title>Login</title>
</head>

<body>
	<?php 
		include('head.php');
		include('Connection.php');
		$userError = $passwordError = "";
	
		if(isset($_POST['submit'])){
			$user = $_POST['userName'];
			$password = $_POST['password'];
			$query=mysqli_query($db,"Select * From login Where UserName='$user' and Password='$password'");
			$count=mysqli_num_rows($query);
			if($count>0){
				session_start();
				$_SESSION['user']=$user;
				header('location:home.php');
			}	
			else{
				$userError = "Invalid user Name";
				$PasswordError = "Invalid password";
			}
		}
		
	?>
	<form method="post"  >
		
		<div class="container-fluid">
		
				<div class="form-group">
				<label>User Name</label>
				<input type="text" name="userName" class="form-control">
				<font color="#FF0004"><?php echo $userError; ?></font>
			</div>		
			
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control">
				<font color="#FF0004"><?php echo $passwordError; ?></font>
			</div>	
			
			<input type="submit" name="submit" class="btn btn-primary">  	
		</div>
	</form>
</body>
</html>

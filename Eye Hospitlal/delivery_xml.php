<?php
	$un=$_GET['value'];
	include("connection.php");
	$query=mysqli_query($db,"SELECT * FROM sale WHERE RefenceNumber = $un AND isDeliver = 0");
	$count=mysqli_num_rows($query);
	if($count){
			$List = mysqli_fetch_all($query,MYSQLI_ASSOC);
	}
	else{
		$List = "noRecord";
	}
	$outp = array();
	$outp = $List;
	echo json_encode($outp);
?>

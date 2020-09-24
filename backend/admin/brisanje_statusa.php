<?php

	include '../../connect.php';
	include '../../funkcije.php';
	ini_set("display_errors", "on");

	if(isset($_POST['status_id']) && is_numeric($_POST['status_id'])){
		$status_id = $_POST['status_id'];
	}else{
		exit("err1");
	}

	$sql = "
				UPDATE status SET 
							aktivno = 0
				WHERE id = $status_id ";
	$res = mysqli_query($dbconn, $sql);
	
	if($res){
		exit('OK');
	}else{
		exit('err2');
	}

?>
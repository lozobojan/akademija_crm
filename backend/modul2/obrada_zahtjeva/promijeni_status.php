<?php

	include '../../../connect.php';
	include '../../../funkcije.php';

	
	isset($_POST['zahtjev_id']) ? $zahtjev_id = $_POST['zahtjev_id'] : exit("ERR1");
	isset($_POST['status_id']) ? $status_id = $_POST['status_id'] : exit("ERR2");

	$sql = "
			UPDATE zahtjev 
					SET status_id = $status_id
			WHERE id = $zahtjev_id
			";

	$res = mysqli_query($dbconn, $sql);

	if($res){
		exit("OK");
	}else{
		exit("ERR3");
	}
	
?>
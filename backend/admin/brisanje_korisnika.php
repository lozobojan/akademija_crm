<?php

	include '../../connect.php';
	include '../../funkcije.php';
	ini_set("display_errors", "on");

	if(isset($_POST['korisnik_id']) && is_numeric($_POST['korisnik_id'])){
		$korisnik_id = $_POST['korisnik_id'];
	}else{
		exit("err1");
	}

	$sql = "
				UPDATE korisnik SET 
							aktivan = 0
				WHERE id = $korisnik_id ";
	$res = mysqli_query($dbconn, $sql);
	
	if($res){
		exit('OK');
	}else{
		exit('err2');
	}

?>
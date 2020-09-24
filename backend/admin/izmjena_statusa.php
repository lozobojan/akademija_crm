<?php

	include '../../connect.php';
	include '../../funkcije.php';
	ini_set("display_errors", "on");

	// var_dump($_POST);
	// exit;

	if(isset($_POST['status_id']) && is_numeric($_POST['status_id'])){
		$status_id = $_POST['status_id'];
	}else{
		exit("err1");
	}
	if(isset($_POST['naziv']) && !empty($_POST['naziv'])){
		$naziv = $_POST['naziv'];
	}else{
		exit("err2");
	}
	if(isset($_POST['obavjestenje']) && $_POST['obavjestenje'] == 'true' ){
		$obavjestenje = 1;
	}else{
		$obavjestenje = 0;
	}
	if(isset($_POST['obavjestenje_tekst']) && !empty($_POST['obavjestenje_tekst'])){
		$obavjestenje_tekst = $_POST['obavjestenje_tekst'];
	}else{
		$obavjestenje_tekst = '';
	}

	$sql = "
				UPDATE status SET 
							naziv = '$naziv', 
							obavjestenje = $obavjestenje, 
							obavjestenje_tekst = '$obavjestenje_tekst' 
				WHERE id = $status_id ";
	// exit("<pre>".$sql."</pre>");
	$res = mysqli_query($dbconn, $sql);
	
	if($res){
		exit('OK');
	}else{
		exit('err3');
	}

?>
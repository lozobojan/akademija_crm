<?php

	include '../../connect.php';
	include '../../funkcije.php';
	ini_set("display_errors", "on");

	// var_dump($_POST);
	// exit;

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
				INSERT INTO status
					( naziv, obavjestenje, obavjestenje_tekst )
				VALUES
					( '$naziv', $obavjestenje, '$obavjestenje_tekst' )

			";
	$res = mysqli_query($dbconn, $sql);
	
	if($res){
		exit('OK');
	}else{
		exit('err3');
	}

?>
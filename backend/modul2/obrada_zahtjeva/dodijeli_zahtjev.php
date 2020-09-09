<?php

	include '../../../connect.php';
	include '../../../funkcije.php';

	
	isset($_POST['zahtjev_id']) ? $zahtjev_id = $_POST['zahtjev_id'] : exit("err1");
	isset($_POST['operater_id']) ? $operater_id = $_POST['operater_id'] : exit("err2");

	$sql = "
			UPDATE zahtjev 
					SET za_korisnika = $operater_id, 
					status_id = 2 
			WHERE id = $zahtjev_id

			";

	$res = mysqli_query($dbconn, $sql);

	if($res){
		exit("Zahtjev dodijeljen operateru!");
	}else{
		exit("Greska! Zahtjev nije dodijeljen operateru!");
	}
	
?>
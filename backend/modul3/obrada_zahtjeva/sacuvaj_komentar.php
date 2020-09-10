<?php

	include '../../../connect.php';
	include '../../../funkcije.php';

	$korisnik_id = $_SESSION['prijava']['korisnik_id'];
	
	isset($_POST['zahtjev_id']) ? $zahtjev_id = $_POST['zahtjev_id'] : exit("ERR1");
	isset($_POST['komentar']) ? $komentar = $_POST['komentar'] : exit("ERR2");

	$sql = "
			UPDATE zahtjev 
					SET komentar_operatera = '$komentar',
					dodao_komentar = $korisnik_id
			WHERE id = $zahtjev_id
			";

	$res = mysqli_query($dbconn, $sql);

	if($res){
		exit("OK");
	}else{
		exit("ERR3");
	}
	
?>
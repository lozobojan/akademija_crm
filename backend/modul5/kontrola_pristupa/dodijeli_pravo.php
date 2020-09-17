<?php

	include '../../../connect.php';
	include '../../../funkcije.php';

	
	isset($_POST['korisnik_id']) ? $korisnik_id = $_POST['korisnik_id'] : exit("ERR1");
	isset($_POST['modul_id']) ? $modul_id = $_POST['modul_id'] : exit("ERR2");
	isset($_POST['pravo']) ? $pravo = $_POST['pravo'] : exit("ERR3");

	$cnt = mysqli_fetch_row(mysqli_query($dbconn, "SELECT count(*) FROM korisnik_modul WHERE korisnik_id=$korisnik_id AND modul_id = $modul_id"))[0];

	$sql = false;
	if( intval($cnt) > 0 && $pravo == 'false'){
		// postoji pravo, brisemo ga
		$sql = "DELETE FROM korisnik_modul WHERE korisnik_id=$korisnik_id AND modul_id = $modul_id";
	}elseif($cnt == 0 && $pravo == true){
		// dodajemo ga
		$sql = "INSERT INTO korisnik_modul(korisnik_id, modul_id) VALUES ($korisnik_id, $modul_id)";
	}

	if($sql){
		$res = mysqli_query($dbconn, $sql);
		if($res){
			exit("OK");
		}else{
			exit("ERR3");
		}
	}
	else{
		exit("Nije potrebna akcija");
	}
	
?>
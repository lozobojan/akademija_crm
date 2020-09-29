<?php

	include '../../connect.php';
	include '../../funkcije.php';
	ini_set("display_errors", "on");

	if(isset($_GET['korisnik_id']) && !empty($_GET['korisnik_id'])){
		$korisnik_id = $_GET['korisnik_id'];
	}else{
		exit("err1");
	}


	$sql = "SELECT * FROM korisnik WHERE id = $korisnik_id";
	$res = mysqli_query($dbconn, $sql);
	$row = mysqli_fetch_assoc($res);

	$korisnik = [
				'ime' => $row['ime'],
				'prezime' => $row['prezime'],
				'username' => $row['username'],
				'sektor_id' => $row['sektor_id'],
				'uloga_id' => $row['uloga_id'],
				'spec' => korisnik_specijalizacije_id($row['id'])
				];

	echo json_encode($korisnik);

?>
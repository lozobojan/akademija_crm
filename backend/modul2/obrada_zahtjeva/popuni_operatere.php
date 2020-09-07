<?php

	include '../../../connect.php';
	include '../../../funkcije.php';

	ini_set("display_errors", "on");

	$zahtjev_id = $_GET['zahtjev_id'];
	$sql = "
			SELECT * FROM 
				korisnik 
			WHERE uloga_id = 2
			AND sektor_id = (SELECT kategorija_id FROM zahtjev WHERE id = $zahtjev_id)
			AND spec_id = (SELECT potkategorija_id FROM zahtjev WHERE id = $zahtjev_id)
			ORDER BY ime ASC
			";
	$res = mysqli_query($dbconn, $sql);
	$operateri = [];
	while($row = mysqli_fetch_assoc($res)){
		$operateri[] = [ 'id' => $row['id'], 'ime' => $row['ime']." ".$row['prezime'] ];
	}

	if(mysqli_num_rows($res) == 0)
		$operateri[] = [ 'id' => "", 'ime' => "Nema dostupnih operatera" ];

	echo json_encode($operateri);
?>
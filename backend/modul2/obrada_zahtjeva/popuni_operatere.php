<?php

	include '../../../connect.php';
	include '../../../funkcije.php';

	ini_set("display_errors", "on");

	$zahtjev_id = $_GET['zahtjev_id'];
	$sql = "
			SELECT 
				id,
				ime,
				prezime,
				(SELECT count(*) FROM zahtjev WHERE za_korisnika = korisnik.id ) as cnt
			FROM korisnik 
			WHERE uloga_id = 2
			AND sektor_id = (SELECT kategorija_id FROM zahtjev WHERE id = $zahtjev_id)
			AND EXISTS 
					( 
					SELECT * FROM korisnik_specijalizacija ks 
					WHERE ks.korisnik_id = korisnik.id
					AND ks.spec_id = (SELECT potkategorija_id FROM zahtjev WHERE id = $zahtjev_id)
					)
			ORDER BY ime ASC
			";
	// exit("<pre>".$sql."</pre>");
	$res = mysqli_query($dbconn, $sql);
	$operateri = [];
	while($row = mysqli_fetch_assoc($res)){
		// $sql_cnt = "SELECT count(*) FROM zahtjev WHERE za_korisnika =".$row['id'];
		// $cnt = mysqli_fetch_row(mysqli_query($dbconn,$sql_cnt))[0];
		$operateri[] = [ 'id' => $row['id'], 'ime' => $row['ime']." ".$row['prezime'], 'cnt' => $row['cnt'] ];
	}

	if(mysqli_num_rows($res) == 0)
		$operateri[] = [ 'id' => "", 'ime' => "Nema dostupnih operatera", 'cnt' => -1 ];

	echo json_encode($operateri);
?>
<?php

	include '../../../connect.php';
	include '../../../funkcije.php';

	// privremeno
	$korisnik_id = 1;

	$uloga_korisnika = uloga_korisnika($korisnik_id);
	$uloga_id = $uloga_korisnika['id'];
	$uloga_naziv = $uloga_korisnika['naziv'];

	$where_uslov = " 1=1 ";
	// ako je administrator
	if($uloga_id == 1){
		$where_uslov .= " AND za_korisnika is null ";
	}else{
		$where_uslov .= " AND za_korisnika = $korisnik_id ";
	}

	$niz_zahtjeva = [];
	$sql_tabela = "
					SELECT 
						z.id as id,
						CONCAT(z.ime, ' ', z.prezime) as korisnik,
						k.naziv as kategorija,
						pk.naziv as potkategorija,
						p.naziv as prioritet,
						s.naziv as status,
						z.datum as datum
					FROM zahtjev z
					JOIN kategorija k on k.id = z.kategorija_id
					JOIN potkategorija pk on pk.id = z.potkategorija_id
					JOIN prioritet p on p.id = z.prioritet_id
					JOIN status s on s.id = z.status_id
					WHERE $where_uslov
					ORDER BY datum ASC
	";
	// exit("<pre>".$sql_tabela."</pre>");
	$res_tabela = mysqli_query($dbconn, $sql_tabela);
	while($row = mysqli_fetch_assoc($res_tabela)){

		$id = $row['id'];
		$korisnik = $row['korisnik'];
		$kategorija = $row['kategorija'];
		$potkategorija = $row['potkategorija'];
		$prioritet = $row['prioritet'];
		$status = $row['status'];
		$datum = $row['datum'];

		$datum = date('d.m.Y [H:i]', strtotime($datum) );

		$niz_zahtjeva[] = 
						[
							'id' => $id,
							'korisnik' => $korisnik,
							'kategorija' => $kategorija,
							'potkategorija' => $potkategorija,
							'prioritet' => $prioritet,
							'status' => $status,
							'datum' => $datum
						];
	}

	echo json_encode($niz_zahtjeva);

?>
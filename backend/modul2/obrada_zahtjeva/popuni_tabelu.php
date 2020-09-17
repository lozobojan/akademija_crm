<?php

	include '../../../connect.php';
	include '../../../funkcije.php';

	ini_set("display_errors", "on");

	$korisnik_id = $_SESSION['prijava']['korisnik_id'];

	$uloga_korisnika = uloga_korisnika($korisnik_id);
	$uloga_id = $uloga_korisnika['id'];
	$uloga_naziv = $uloga_korisnika['naziv'];

	$dodijeljeni = false;
	if(isset($_GET['prikazi_dodijeljene']) && $_GET['prikazi_dodijeljene'] == true ){
		$dodijeljeni = true;
	}

	$where_uslov = " 1=1 ";
	// ako je administrator
	if($uloga_id == 1){
		if($dodijeljeni){
			// prikazujemo one koji su dodijeljeni
			$where_uslov .= " AND za_korisnika is not null ";
		}else{
			// prikazujemo one koji su nedodijeljeni
			$where_uslov .= " AND za_korisnika is null ";
		}
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
						z.datum as datum,
						CONCAT(op.ime, ' ', op.prezime ) as operater
					FROM zahtjev z
					JOIN kategorija k on k.id = z.kategorija_id
					JOIN potkategorija pk on pk.id = z.potkategorija_id
					JOIN prioritet p on p.id = z.prioritet_id
					JOIN status s on s.id = z.status_id
					LEFT JOIN korisnik op on op.id = z.za_korisnika 
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
		$operater = $row['operater'];

		$datum = date('d.m.Y [H:i]', strtotime($datum) );

		$link = "";
		if($uloga_id == 1){
			$link = "<a href=\"#\" onclick=\"modalDodijeli($id)\" ><i class=\"fas fa-users\" ></i></a>";
		}elseif($uloga_id == 2){
			$link = "<a href=\"./detalji_zahtjeva.php?id=$id\" ><i class=\"fas fa-list-alt\" ></i></a>";
		}

		$niz_zahtjeva[] = 
						[
							'id' => $id,
							'korisnik' => $korisnik,
							'kategorija' => $kategorija,
							'potkategorija' => $potkategorija,
							'prioritet' => $prioritet,
							'status' => $status,
							'datum' => $datum,
							'operater' => $operater,
							'link' => $link
						];
	}

	echo json_encode($niz_zahtjeva);

?>
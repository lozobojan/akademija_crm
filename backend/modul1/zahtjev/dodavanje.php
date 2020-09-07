<?php


	include '../../../connect.php';
	include '../../../funkcije.php';

	$greske = [];

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if(isset($_POST['ime']) && $_POST['ime'] != '')
			$ime = $_POST['ime'];
		else
			$greske[] = "Ime je obavezno polje!"; 

		if(isset($_POST['prezime']) && $_POST['prezime'] != '')
			$prezime = $_POST['prezime'];
		else
			$greske[] = "Prezime je obavezno polje!";

		if(isset($_POST['pretplatnicki_broj']) && $_POST['pretplatnicki_broj'] != '')
			$pretplatnicki_broj = $_POST['pretplatnicki_broj'];
		else
			$greske[] = "Pretplatnicki broj je obavezno polje!";

		if(isset($_POST['kategorija']) &&  is_numeric($_POST['kategorija']))
			$kategorija = $_POST['kategorija'];
		else
			$greske[] = "Kategorija je obavezno polje!";

		if(isset($_POST['potkategorija']) &&  is_numeric($_POST['potkategorija']))
			$potkategorija = $_POST['potkategorija'];
		else
			$greske[] = "Potkategorija je obavezno polje!";

		if(isset($_POST['prioritet']) &&  is_numeric($_POST['prioritet']))
			$prioritet = $_POST['prioritet'];
		else
			$greske[] = "Prioritet je obavezno polje!";

		if(isset($_POST['opis']) && $_POST['opis'] != '')
			$opis = $_POST['opis'];
		else
			$greske[] = "Opis je obavezno polje!";

		if(isset($_POST['telefon']) && $_POST['telefon'] != '')
			$telefon = $_POST['telefon'];
		else
			$greske[] = "Telefon je obavezno polje!";

		if(isset($_POST['mail']) && $_POST['mail'] != '')
			$mail = $_POST['mail'];
		else
			$greske[] = "Mail je obavezno polje!";

		if(isset($_POST['obavjestenje_saglasnost']))
			$obavjestenje_saglasnost = 1;
		else
			$obavjestenje_saglasnost = 0;

		$jedinstveni_kod = generisi_string(6);
		while(postoji_kod($jedinstveni_kod)){
			$jedinstveni_kod = generisi_string(6);
		}
		
		$sql_insert = "INSERT INTO `zahtjev`
								(
								  `ime`,
								  `prezime`,
								  `pretplatnicki_broj`,
								  `kategorija_id`,
								  `potkategorija_id`,
								  `opis`,
								  `prioritet_id`,
								  `telefon`,
								  `mail`,
								  `obavjestenje_saglasnost`,
								  `jedinstveni_kod`
								) 
								VALUE 
								(
								  '$ime',
								  '$prezime',
								  '$pretplatnicki_broj',
								  $kategorija,
								  $potkategorija,
								  '$opis',
								  $prioritet,
								  '$telefon',
								  '$mail',
								  $obavjestenje_saglasnost,
								  '$jedinstveni_kod'
								)";
		$res_insert = mysqli_query($dbconn, $sql_insert);

		if(!$res_insert){
			$greske[] = "Greska pri izvrsavanju upita!";
		}

		$ok = count($greske) == 0;
		echo json_encode([ "greske" => $greske, "ok" => $ok, "kod" => $jedinstveni_kod ]);

	}else{
		$greske[] = "Nedozovoljen metod!";
		echo json_encode([ "greske" => $greske, "ok" => $ok, "kod" => "" ]);
	}

?>
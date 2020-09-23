<?php

	include '../../connect.php';
	include '../../funkcije.php';

	if(isset($_GET['kod']) && strlen($_GET['kod']) == 6){
		$kod = $_GET['kod'];
	}else{
		echo json_encode(['ok' => false, 'err' => '1', 'data' => null ]);
		exit;
	}

	$vrijeme = microtime(true);
	$dozvoljeno_pokusaja = 5;
	$limit_sekundi = 300; // 5 pokusaja za 5 minuta

	// provjera limita
	if(isset($_SESSION['vrijeme_poslijednjeg_pokusaja'])){

		$vr_pos_pok = $_SESSION['vrijeme_poslijednjeg_pokusaja'];
		$_SESSION['vrijeme_poslijednjeg_pokusaja'] = microtime(true);
		$broj_pokusaja = $_SESSION['broj_pokusaja'];
		$_SESSION['broj_pokusaja'] = $_SESSION['broj_pokusaja'] + 1;

		$razlika_sekundi = microtime(true) - $vr_pos_pok;
		// greska na predavanju je bila u znaku izmedju razlika_sekundi i limit_sekundi
		if($broj_pokusaja > $dozvoljeno_pokusaja && $razlika_sekundi < $limit_sekundi){
			echo json_encode(['ok' => false, 'err' => '3', 'data' => null ]);
			exit;
		}elseif($broj_pokusaja > $dozvoljeno_pokusaja && $razlika_sekundi > $limit_sekundi){
			$_SESSION['vrijeme_poslijednjeg_pokusaja'] = $vrijeme;
			$_SESSION['broj_pokusaja'] = 1;
		}
		
	}else{
		$_SESSION['vrijeme_poslijednjeg_pokusaja'] = $vrijeme;
		$_SESSION['broj_pokusaja'] = 1;
	}

	$sql = "
			SELECT 

					z.id as zahtjev_id,
					z.pretplatnicki_broj as pretplatnicki_broj,
					k.naziv as kategorija,
					pk.naziv as potkategorija,
					s.naziv as status,
					CONCAT(op.ime, ' ', op.prezime) as operater

				FROM zahtjev z
				JOIN kategorija k on k.id = z.kategorija_id
				JOIN potkategorija pk on pk.id = z.potkategorija_id
				JOIN status s on s.id = z.status_id
				JOIN korisnik op on op.id = z.za_korisnika
			WHERE jedinstveni_kod = '$kod' 
			";
	$res = mysqli_query($dbconn, $sql);

	if(mysqli_num_rows($res) == 1){

		$row = mysqli_fetch_assoc($res);
		echo json_encode(['ok' => true, 'err' => null, 'data' => $row ]);
		exit;

	}else{
		echo json_encode(['ok' => false, 'err' => '2', 'data' => null, 'cnt' => $_SESSION['broj_pokusaja'] ]);
		exit;
	}

?>
<?php
	
	function popuni_sifarnik($sifranik){
		global $dbconn;
		$sql = "SELECT * FROM $sifranik ORDER BY naziv ASC ";
		$res = mysqli_query($dbconn, $sql);
		while($row = mysqli_fetch_assoc($res)){
			$id_temp = $row['id'];
			$naziv_temp = $row['naziv'];
			echo "<option value=\"$id_temp\" >$naziv_temp</option>";
		}
	}

	function generisi_string($length = 4) {
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	function postoji_kod($kod){
		global $dbconn;
		$cnt = mysqli_fetch_row(mysqli_query("SELECT count(*) FROM zahtjev WHERE jedinstveni_kod = '$kod'"))[0];
		return $cnt > 0;
	}

	function uloga_korisnika($korisnik_id){
		global $dbconn;
		$sql = "
					SELECT 
						u.id,
						u.naziv 
					FROM uloga u 
					JOIN korisnik k on k.uloga_id = u.id 
					WHERE k.id = $korisnik_id
				";
		$res = mysqli_query($dbconn, $sql);
		$row = mysqli_fetch_assoc($res);

		return $row;
	}

	function autorizacija($redirect = "../login.html"){
		if(!$_SESSION['prijava']['ok']){
			header("Location: $redirect");
			exit;
		}
	}

?>
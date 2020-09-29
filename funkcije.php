<?php
	
	function popuni_sifarnik($sifranik, $sel = null){
		global $dbconn;
		$sql = "SELECT * FROM $sifranik ORDER BY naziv ASC ";
		$res = mysqli_query($dbconn, $sql);
		while($row = mysqli_fetch_assoc($res)){
			$id_temp = $row['id'];
			$naziv_temp = $row['naziv'];
			($sel == $id_temp) ? $selected = "selected" : $selected = "";
			echo "<option value=\"$id_temp\" $selected >$naziv_temp</option>";
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

	function prijavljeni_korisnik(){
		global $dbconn;

		$korisnik_id = $_SESSION['prijava']['korisnik_id'];
		if(is_null($korisnik_id))
			return false;

		$sql = "SELECT ime, prezime, username FROM korisnik WHERE id = $korisnik_id";
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

	function saglasnostObavjestenje($zahtjev_id){
		global $dbconn;
		$sql = "SELECT obavjestenje_saglasnost FROM zahtjev WHERE id = $zahtjev_id";
		$s = mysqli_fetch_row(mysqli_query($dbconn, $sql))[0];
		return ($s == 1);
	}

	function statusObavjestenje($status_id){
		global $dbconn;
		$sql = "SELECT obavjestenje, obavjestenje_tekst FROM status WHERE id = $status_id";
		$res = mysqli_query($dbconn, $sql);
		$row = mysqli_fetch_assoc($res);
		$ob = $row['obavjestenje'];
		$txt = $row['obavjestenje_tekst'];
		if($ob == 1){
			return $txt;
		}else{
			return false;
		}
	}

	function mailAdresaKorisnika($zahtjev_id){
		global $dbconn;
		return mysqli_fetch_row(mysqli_query($dbconn, "SELECT mail FROM zahtjev WHERE id = $zahtjev_id"))[0];
	}

	function obavijesti($zahtjev_id, $novi_status_id){
		global $dbconn;
		$saglasnost = saglasnostObavjestenje($zahtjev_id);
		$obavjestenje = statusObavjestenje($novi_status_id);

		if($saglasnost && $obavjestenje){
			posaljiMail(mailAdresaKorisnika($zahtjev_id), $obavjestenje);
		}

	}

	function posaljiMail($mail_adresa, $tekst){
		global $mail;
		try {
		    // Server settings
		    $mail->isSMTP();
		    $mail->Host       = 'smtp.gmail.com';                    
		    $mail->SMTPAuth   = true;                                  
		    $mail->Username   = 'akademijatest2020@gmail.com';                   
		    $mail->Password   = 'pass12345678';
		    $mail->Port       = 587;

		    //Recipients
		    $mail->setFrom('crm_aplikacija@gmail.com', 'CRM Automatski mail');
		    $mail->addAddress($mail_adresa);

		    // Content
		    $mail->isHTML(true);
		    $mail->Subject = 'Obavjestenje o zahtjevu';
		    $mail->Body    = $tekst;
		    $mail->send();

		    return true;
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}

	function pristupModulu($sistemski_naziv, $korisnik_id){
		global $dbconn;
		$sql = "
				SELECT count(*) FROM korisnik_modul 
				WHERE korisnik_id = $korisnik_id 
				AND modul_id = (SELECT id FROM modul WHERE sistemski_naziv = '$sistemski_naziv' )
			  ";
		$cnt = mysqli_fetch_row(mysqli_query($dbconn, $sql))[0];
		return ($cnt > 0);
	}

	function korisnik_specijalizacije($korisnik_id){
		global $dbconn;
		$specijalizacije = [];
		$sql_spec = "
						SELECT s.naziv FROM korisnik_specijalizacija ks
						LEFT JOIN specijalizacija s ON ks.spec_id = s.id
						WHERE ks.korisnik_id = $korisnik_id
					";
		$res_spec = mysqli_query($dbconn, $sql_spec);
		while($row_spec = mysqli_fetch_assoc($res_spec)){
			$specijalizacije[] = $row_spec['naziv'];
		}
		return implode(', ', $specijalizacije);
	}

	function korisnik_specijalizacije_id($korisnik_id){
		global $dbconn;
		$specijalizacije = [];
		$sql_spec = "
						SELECT spec_id FROM korisnik_specijalizacija ks
						WHERE ks.korisnik_id = $korisnik_id
					";
		$res_spec = mysqli_query($dbconn, $sql_spec);
		while($row_spec = mysqli_fetch_assoc($res_spec)){
			$specijalizacije[] = $row_spec['spec_id'];
		}
		return $specijalizacije;
	}

	function sledeci_id($tabela){
		global $dbconn;
		$sql = "SELECT COALESCE(max(id),0)+1 FROM $tabela ";
		return mysqli_fetch_row(mysqli_query($dbconn,$sql))[0];
	}

	function dodaj_spec($spec_id, $korisnik_id){
		global $dbconn;
		$sql = "INSERT INTO korisnik_specijalizacija (korisnik_id, spec_id) VALUES ($korisnik_id, $spec_id)";
		return mysqli_query($dbconn,$sql);
	}
?>
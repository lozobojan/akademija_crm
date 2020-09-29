<?php 

	include '../../connect.php';
	include '../../funkcije.php';
	ini_set("display_errors", "on");

	// var_dump($_POST);
	// exit;

	if(isset($_POST['korisnik_id']) && is_numeric($_POST['korisnik_id'])){
		$korisnik_id = $_POST['korisnik_id'];
	}else{
		exit("err0");
	}
	if(isset($_POST['ime']) && !empty($_POST['ime'])){
		$ime = $_POST['ime'];
	}else{
		exit("err1");
	}
	if(isset($_POST['prezime']) && !empty($_POST['prezime'])){
		$prezime = $_POST['prezime'];
	}else{
		exit("err2");
	}
	if(isset($_POST['username']) && !empty($_POST['username'])){
		$username = $_POST['username'];
	}else{
		exit("err3");
	}

	if(isset($_POST['uloga']) && is_numeric($_POST['uloga'])){
		$uloga = $_POST['uloga'];
	}else{
		exit("err4");
	}

	if(isset($_POST['sektor']) && is_numeric($_POST['sektor'])){
		$sektor = $_POST['sektor'];
	}else{
		$sektor = 'Null';
	}
	// niz
	if( isset($_POST['spec']) ){
		$spec = $_POST['spec'];
	}else{
		$spec = [];
	}

	mysqli_query($dbconn, "BEGIN");

	// generisi novi default password
	$password = md5(strtolower($ime).'123');
	$id = sledeci_id('korisnik');

	$sql = "
				UPDATE korisnik SET
								ime = '$ime',
								prezime = '$prezime',
								username = '$username',
								sektor_id = $sektor,
								uloga_id = $uloga
				WHERE id = $korisnik_id
			";
	$res = mysqli_query($dbconn, $sql);

	if($res){

		if(!mysqli_query($dbconn, "DELETE FROM korisnik_specijalizacija WHERE korisnik_id = $korisnik_id")){
			mysqli_query($dbconn, "ROLLBACK");
			exit('err7');
		}

		for($i = 0; $i<count($spec); $i++){
			$spec_temp = $spec[$i];
			if(!dodaj_spec($spec_temp, $korisnik_id)){
				mysqli_query($dbconn, "ROLLBACK");
				exit('err6');
			}
		}

		mysqli_query($dbconn, "COMMIT");
		exit('OK');
	}else{
		mysqli_query($dbconn, "ROLLBACK");
		exit('err5');
	}

?>
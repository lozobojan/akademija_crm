<?php

	include '../connect.php';
	include '../funkcije.php';

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if(isset($_POST['username']) && $_POST['username'] != ""){
			$username = $_POST['username'];
		}else{
			header("Location: ../login.html?msg=err1");
			exit;
		}
		if(isset($_POST['password']) && $_POST['password'] != ""){
			$password = $_POST['password'];
		}else{
			header("Location: ../login.html?msg=err2");
			exit;
		}

		$sql = "SELECT * FROM korisnik WHERE username = '$username' AND password = md5('$password') ";
		$res = mysqli_query($dbconn, $sql);

		if(mysqli_num_rows($res) == 1){
			$row = mysqli_fetch_assoc($res);
			// ako je prosla prijava, cuvamo podatke o prijavljenom korisniku
			$uloga = uloga_korisnika($row['id']);
			$_SESSION['prijava']['ok'] = true;
			$_SESSION['prijava']['korisnik_id'] = $row['id'];
			$_SESSION['prijava']['uloga_id'] = $uloga['id'];
			$_SESSION['prijava']['uloga_naziv'] = $uloga['naziv'];
			// preusmjeravamo na pocetnu stranicu za prijavljenog korisnika
			header("Location: ../obrada_zahtjeva/index.php");
			exit;
		}else{
			header("Location: ../login.html?msg=err3");
			exit;
		}
 
	}else{
		exit("Nedozvoljen metod!");
	}

?>
<?php

	ini_set("display_errors", "on");

	require '../../../vendor/autoload.php';
	include '../../../connect.php';
	include '../../../funkcije.php';

	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	$mail = new PHPMailer(true);
	$korisnik_id = $_SESSION['prijava']['korisnik_id'];
	
	isset($_POST['zahtjev_id']) ? $zahtjev_id = $_POST['zahtjev_id'] : exit("ERR1");
	isset($_POST['status_id']) ? $status_id = $_POST['status_id'] : exit("ERR2");

	$sql = "
			UPDATE zahtjev 
					SET status_id = $status_id,
					promijenio_status = $korisnik_id
			WHERE id = $zahtjev_id
			";

	$res = mysqli_query($dbconn, $sql);

	if($res){
		obavijesti($zahtjev_id, $status_id);
		exit("OK");
	}else{
		exit("ERR3");
	}
	
?>
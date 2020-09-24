<?php

	include '../../connect.php';
	include '../../funkcije.php';
	ini_set("display_errors", "on");

	if(isset($_GET['status_id']) && !empty($_GET['status_id'])){
		$status_id = $_GET['status_id'];
	}else{
		exit("err1");
	}


	$sql = "SELECT * FROM status WHERE id = $status_id";
	$res = mysqli_query($dbconn, $sql);
	$row = mysqli_fetch_assoc($res);

	$status = [
				'naziv' => $row['naziv'],
				'obavjestenje' => $row['obavjestenje'],
				'obavjestenje_tekst' => $row['obavjestenje_tekst'],
				];

	echo json_encode($status);

?>
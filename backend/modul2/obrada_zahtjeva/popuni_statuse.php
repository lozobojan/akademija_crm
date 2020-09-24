<?php

	include '../../../connect.php';
	include '../../../funkcije.php';

	ini_set("display_errors", "on");

	$zahtjev_id = $_GET['zahtjev_id'];

	$sql_status = "SELECT status_id FROM zahtjev WHERE id = $zahtjev_id";
	$trenutni_status = mysqli_fetch_row(mysqli_query($dbconn, $sql_status))[0];

	$sql = " SELECT * FROM status WHERE aktivno = 1 ORDER BY id ASC ";
	$res = mysqli_query($dbconn, $sql);
	$statusi = [];

	while($row = mysqli_fetch_assoc($res)){

		$row['id'] == $trenutni_status ? $selected = true : $selected = false;
		$statusi[] = [ 'id' => $row['id'], 'naziv' => $row['naziv'], 'selected' => $selected ];

	}

	echo json_encode($statusi);
?>
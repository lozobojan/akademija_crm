<?php

	$dbconn = mysqli_connect('localhost', 'root', '');
	mysqli_select_db($dbconn, 'crm');

	// startuj sesiju ako vec nije startovana
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}

?>
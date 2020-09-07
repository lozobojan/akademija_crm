<?php

	include '../connect.php';
	include '../funkcije.php';

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		session_destroy();
		header("Location: ../login.html");
		exit;
 
	}else{
		exit("Nedozvoljen metod!");
	}

?>
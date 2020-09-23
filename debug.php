<?php
	
	session_start();
	var_dump(microtime(true) - $_SESSION['vrijeme_poslijednjeg_pokusaja']);
	echo "<br/>";
	var_dump($_SESSION);
	exit;

?>
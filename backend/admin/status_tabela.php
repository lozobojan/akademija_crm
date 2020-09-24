<?php

	include '../../connect.php';
	include '../../funkcije.php';

	ini_set("display_errors", "on");

	$sql_tabela = "SELECT * FROM status WHERE aktivno = 1 ORDER BY naziv ASC";
	$res_tabela = mysqli_query($dbconn, $sql_tabela);

	$niz_statusa = [];
	while($row = mysqli_fetch_assoc($res_tabela)){

		$id = $row['id'];
		$naziv = $row['naziv'];
		$obavjestenje = $row['obavjestenje'];
		$obavjestenje_tekst = $row['obavjestenje_tekst'];

		if($obavjestenje == 0){
			$obavjestenje = "<i class=\"fas fa-times\" style=\"color:red;\" ></i>";
		}else{
			$obavjestenje = "<i class=\"fas fa-check\" style=\"color:green;\" ></i>";
		}

		if(is_null($obavjestenje_tekst))
			$obavjestenje_tekst = "";

		$link_edit = "<a href=\"#\" onclick=\"izmjena_statusa_modal($id)\"><i class=\"fas fa-edit\" ></i></a>";
		$link_delete = "<a href=\"#\" onclick=\"brisanje_statusa_modal($id)\"><i class=\"fas fa-times\" ></i></a>";

		$niz_statusa[] = 
						[
							'id' => $id,
							'naziv' => $naziv,
							'obavjestenje' => $obavjestenje,
							'obavjestenje_tekst' => $obavjestenje_tekst,
							'link_edit' => $link_edit,
							'link_delete' => $link_delete
						];
	}

	echo json_encode($niz_statusa);

?>
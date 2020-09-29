<?php

	include '../../connect.php';
	include '../../funkcije.php';

	ini_set("display_errors", "on");

	$sql_tabela = "SELECT 
			    		k.id as korisnik_id,
			            k.ime as ime,
			            k.prezime as prezime,
			            k.username as username,
			            COALESCE(s.naziv,'nedefinisano') as sektor,
			            COALESCE(u.naziv, 'nedefinisano') as uloga
			    from korisnik k
			    left join sektor s on s.id = k.sektor_id
			    left join uloga u on u.id = k.uloga_id

			    WHERE k.aktivan = 1
			    ";

	$res_tabela = mysqli_query($dbconn, $sql_tabela);

	$niz_korisnika = [];
	while($row = mysqli_fetch_assoc($res_tabela)){

		$id = $row['korisnik_id'];
		$ime = $row['ime'];
		$prezime = $row['prezime'];
		$username = $row['username'];
		$sektor = $row['sektor'];
		$uloga = $row['uloga'];

		$link_edit = "<a href=\"#\" onclick=\"izmjena_korisnika_modal($id)\"><i class=\"fas fa-edit\" ></i></a>";
		$link_delete = "<a href=\"#\" onclick=\"brisanje_korisnika_modal($id)\"><i class=\"fas fa-times\" ></i></a>";

		$spec_string = korisnik_specijalizacije($id);

		$niz_korisnika[] = 
						[
							'id' => $id,
							'ime' => $ime,
							'prezime' => $prezime,
							'username' => $username,
							'sektor' => $sektor,
							'uloga' => $uloga,
							'spec' => $spec_string,
							'link_edit' => $link_edit,
							'link_delete' => $link_delete
						];
		
	}

	echo json_encode($niz_korisnika);

?>
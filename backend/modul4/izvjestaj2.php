<?php

	include '../../connect.php';
	include '../../funkcije.php';

	autorizacija();

	// Include the main TCPDF library (search for installation path).
	require_once('../../tcpdf/examples/tcpdf_include.php');

	$order_by = " uk_zahtjeva ";
	$order_type = " DESC ";
	$ponaslov1 = " Sortirano po polju ukupno";
	$ponaslov2 = " opadajuce";

	if(isset($_GET['polje_sort']) && is_numeric($_GET['polje_sort']) ){
		$polje_sort = $_GET['polje_sort'];
		switch ($polje_sort) {
			case '1':
				$order_by = " br_probl ";
				$ponaslov1 = " Sortirano po polju broj problema";
				break;
			case '2':
				$order_by = " br_podrska ";
				$ponaslov1 = " Sortirano po polju broj zahtjeva za podrsku";
				break;
			case '3':
				$order_by = " uk_zahtjeva ";
				$ponaslov1 = " Sortirano po polju ukupno";
				break;
			default:
				break;
		}
	}
	if(isset($_GET['tip_sort']) && is_numeric($_GET['tip_sort']) ){
		$tip_sort = $_GET['tip_sort'];
		switch ($tip_sort) {
			case '1':
				$order_type = " ASC ";
				$ponaslov2 = " rastuce";
				break;
			case '2':
				$order_type = " DESC ";
				$ponaslov2 = " opadajuce";
				break;
			default:
				break;
		}
	}

	// create new PDF document
	$pdf = new TCPDF("P", "mm", "A4", true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator("maxISP software");
	$pdf->SetAuthor('Bojan Lozo');
	$pdf->SetTitle('TCPDF izvjestaj');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}

	// set default font subsetting mode
	$pdf->setFontSubsetting(true);
	// Add a page
	$pdf->AddPage();

	$pdf->Ln(10);
	$pdf->SetFont('dejavusans', 'B', 12, '', true);
	$pdf->MultiCell(190, 5, "Izvjestaj o potkategorijama", 0, 'C', 0, 1, '', '', true);
	$pdf->SetFont('dejavusans', '', 10, '', true);
	$pdf->MultiCell(190, 5, $ponaslov1.$ponaslov2.".", 0, 'C', 0, 1, '', '', true);

	$sirine = [50,50,45,45];
	$visina = 5;

	$pdf->Ln(10);
	$pdf->SetFont('dejavusans', 'B', 12, '', true);
	$pdf->MultiCell($sirine[0], $visina, "Potkategorija", 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($sirine[1], $visina, "Podrska", 1, 'R', 0, 0, '', '', true);
	$pdf->MultiCell($sirine[2], $visina, "Problem", 1, 'R', 0, 0, '', '', true);
	$pdf->MultiCell($sirine[3], $visina, "Ukupno", 1, 'R', 0, 1, '', '', true);

	$sql = "SELECT 
			pk.id as id,
		    pk.naziv as naziv,
		    (select count(*) from zahtjev where potkategorija_id = pk.id) as uk_zahtjeva,
		    (select count(*) from zahtjev where potkategorija_id = pk.id and kategorija_id = 1) as br_podrska,
		    (select count(*) from zahtjev where potkategorija_id = pk.id and kategorija_id = 2) as br_probl
			FROM potkategorija pk
			ORDER BY $order_by $order_type
			";
	$res = mysqli_query($dbconn, $sql);

	$pdf->SetFont('dejavusans', '', 10, '', true);
	$ukupno1 = 0;
	$ukupno2 = 0;
	$ukupno3 = 0;
	while($row = mysqli_fetch_assoc($res)){

		$naziv = $row['naziv'];
		$uk_zahtjeva = $row['uk_zahtjeva'];
		$br_podrska = $row['br_podrska'];
		$br_probl = $row['br_probl'];

		$pdf->MultiCell($sirine[0], $visina, $naziv, 1, 'L', 0, 0, '', '', true);
		$pdf->MultiCell($sirine[1], $visina, $br_podrska, 1, 'R', 0, 0, '', '', true);
		$pdf->MultiCell($sirine[2], $visina, $br_probl, 1, 'R', 0, 0, '', '', true);
		$pdf->MultiCell($sirine[3], $visina, $uk_zahtjeva, 1, 'R', 0, 1, '', '', true);

		$ukupno1 += $br_podrska;
		$ukupno2 += $br_probl;
		$ukupno3 += $uk_zahtjeva;
	}
	$pdf->Ln(5);
	$pdf->MultiCell($sirine[0], $visina, "Ukupno", 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($sirine[1], $visina, $ukupno1, 1, 'R', 0, 0, '', '', true);
	$pdf->MultiCell($sirine[2], $visina, $ukupno2, 1, 'R', 0, 0, '', '', true);
	$pdf->MultiCell($sirine[3], $visina, $ukupno3, 1, 'R', 0, 1, '', '', true);

	// Close and output PDF document
	// This method has several options, check the source code documentation for more information.
	$pdf->Output('izvjestaj2.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

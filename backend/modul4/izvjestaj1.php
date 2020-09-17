<?php

	include '../../connect.php';
	include '../../funkcije.php';

	autorizacija();
	
	// Include the main TCPDF library (search for installation path).
	require_once('../../tcpdf/examples/tcpdf_include.php');

	$where = " 1=1 ";
	$where .= " AND uloga_id = 2 "; // da bude operater
	$podnaslov = false;

	if(isset($_GET['operater']) && is_numeric($_GET['operater'])){
		$operater = $_GET['operater'];
		$where .= " AND op.id = $operater ";
		$op_naziv = mysqli_fetch_row(mysqli_query($dbconn, "SELECT CONCAT(ime, ' ', prezime) FROM korisnik WHERE id = $operater"))[0];
		$podnaslov = " Za operatera: ".$op_naziv;
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
	$pdf->MultiCell(190, 5, "Izvjestaj o ucinku operatera", 0, 'C', 0, 1, '', '', true);
	if($podnaslov){
		$pdf->SetFont('dejavusans', '', 10, '', true);
		$pdf->MultiCell(190, 5, $podnaslov, 0, 'C', 0, 1, '', '', true);
	}

	$sirine = [50,50,45,45];
	$visina = 5;

	$pdf->Ln(10);
	$pdf->SetFont('dejavusans', 'B', 12, '', true);
	$pdf->MultiCell($sirine[0], $visina, "Ime", 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($sirine[1], $visina, "Prezime", 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($sirine[2], $visina, "Ukupno", 1, 'R', 0, 0, '', '', true);
	$pdf->MultiCell($sirine[3], $visina, "Zavrseno", 1, 'R', 0, 1, '', '', true);

	$sql = "SELECT 
				op.id as id,
				op.ime as ime,
			    op.prezime as prezime, 
			    (select count(*) from zahtjev where za_korisnika = op.id ) as uk_zahtjeva,
			    (select count(*) from zahtjev where za_korisnika = op.id and status_id = 3 ) as zav_zahtjeva
			from korisnik op 
			where $where
			";
	$res = mysqli_query($dbconn, $sql);

	$pdf->SetFont('dejavusans', '', 10, '', true);
	$ukupno1 = 0;
	$ukupno2 = 0;
	while($row = mysqli_fetch_assoc($res)){

		$ime = $row['ime'];
		$prezime = $row['prezime'];
		$uk_zahtjeva = $row['uk_zahtjeva'];
		$zav_zahtjeva = $row['zav_zahtjeva'];

		$pdf->MultiCell($sirine[0], $visina, $ime, 1, 'L', 0, 0, '', '', true);
		$pdf->MultiCell($sirine[1], $visina, $prezime, 1, 'L', 0, 0, '', '', true);
		$pdf->MultiCell($sirine[2], $visina, $uk_zahtjeva, 1, 'R', 0, 0, '', '', true);
		$pdf->MultiCell($sirine[3], $visina, $zav_zahtjeva, 1, 'R', 0, 1, '', '', true);

		$ukupno1 += $uk_zahtjeva;
		$ukupno2 += $zav_zahtjeva;
	}
	$pdf->Ln(5);
	$pdf->MultiCell($sirine[0] + $sirine[1], $visina, "Ukupno", 1, 'L', 0, 0, '', '', true);
	$pdf->MultiCell($sirine[2], $visina, $ukupno1, 1, 'R', 0, 0, '', '', true);
	$pdf->MultiCell($sirine[3], $visina, $ukupno2, 1, 'R', 0, 1, '', '', true);

	// Close and output PDF document
	// This method has several options, check the source code documentation for more information.
	$pdf->Output('izvjestaj1.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

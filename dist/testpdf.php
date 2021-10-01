
<?php
	require('fpdf.php');

	define('FPDF_FONTPATH','font/');

	$pdf=new FPDF();
	$pdf->AddPage();
	$pdf->AddFont('angsa','','angsa.php');
	$pdf->SetFont('angsa','',36);
	$pdf->Cell(0,20,iconv( 'UTF-8','TIS-620','สวัสดี ชาวไทยครีเอท'),0,1,"C");
	$pdf->Output();
?>

	

<?php

require('fpdf.php');

$con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com", "", "", "");



// echo $_GET["startdate"]; 

// echo $_GET["enddate"]; 

//$sdate = date("yy-m-d");

//$ldate = date("yy-m-d", strtotime("-1 days", strtotime($sdate)));



//$sdate = date($_GET["startdate"]);

//$ldate = date($_GET["enddate"]);



class PDF extends FPDF {

	function Header(){

		$this->SetFont('Arial','B',15);

		

		//dummy cell to put logo

		//$this->Cell(12,0,'',0,0);

		//is equivalent to:

		$this->Cell(12);

		

		//put logo

		$this->Image('picreport/ethlogo.jpg',10,10,10);

		

        $this->Cell(100,10,'SEMs Report',0,1);

        

		

		//dummy cell to give line spacing

		//$this->Cell(0,5,'',0,1);

		//is equivalent to:

        $this->Ln(5);

        

        

		

		$this->SetFont('Arial','B',11);

		

		$this->SetFillColor(180,180,255);

		$this->SetDrawColor(180,180,255);

		$this->Cell(40,8,'DateTime',1,0,'C',true);

		$this->Cell(25,8,'Active Power(W)',1,0,'C',true);

		$this->Cell(65,8,'Energy Today(kWh)',1,0,'C',true);

		$this->Cell(60,8,'Energy Total(kWh)',1,1,'C',true);

		

	}

	function Footer(){

		//add table's bottom line

		$this->Cell(190,0,'','T',1,'',true);

		

		//Go to 1.5 cm from bottom

		$this->SetY(-15);

				

		$this->SetFont('Arial','',8);

		

		//width = 0 means the cell is extended up to the right margin

		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');

	}

}









//A4 width : 219mm

//default margin : 10mm each side

//writable horizontal : 219-(10*2)=189mm



$pdf = new PDF('P','mm','A4'); //use new class



//define new alias for total page numbers

$pdf->AliasNbPages('{pages}');



$pdf->SetAutoPageBreak(true,15);

$pdf->AddPage();



$pdf->SetFont('Arial','',9);

$pdf->SetDrawColor(180,180,255);



$query=mysqli_query($con,"select * from data where date_time BETWEEN '" .$_GET["startdate"]. "' and '" .$_GET["enddate"]. "'");

while($data=mysqli_fetch_array($query)){

	$pdf->Cell(40,8,$data['date_time'],'LR',0 ,'C');

	$pdf->Cell(25,8,$data['inv_p'],'LR',0,'C');

	

	if($pdf->GetStringWidth($data['inv_ed']) > 65){

		$pdf->SetFont('Arial','',7);

		$pdf->Cell(65,8,$data['inv_ed'],'LR',0,'C');

		$pdf->SetFont('Arial','',9);

	}else{

		$pdf->Cell(65,8,$data['inv_ed'],'LR',0,'C');

	}

	$pdf->Cell(60,8,$data['inv_et'],'LR',1,'C');

}



$this->Cell(190,0,'','T',1,'',true);

		

//Go to 1.5 cm from bottom

$this->SetY(-15);

		

$this->SetFont('Arial','',8);



//width = 0 means the cell is extended up to the right margin

$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');



$pdf->Output();

?>




















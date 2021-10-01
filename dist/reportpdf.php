<?php

require('fpdf.php');

$db = new PDO('mysql:host=cpanel13wh.bkk1.cloud.z.com;dbname=','','');





$sdate = date("yy-m-d");

$ldate = date("yy-m-d", strtotime("-1 days", strtotime($sdate)));





$query = "SELECT * FROM `data` where date_time >= '" . $sdate . "' ";





class PDF extends FPDF{

    function header(){

        $this->Image('picreport/ethlogo.jpg',10,6);

        $this->SetFont('Arial','B',14);

        $this->Cell(276,5,'Report Documents',0,0,'C');

        $this->Ln();

        $this->SetFont('Times','',12);

        $this->Cell(276,10,'www.ethernet.co.th',0,0,'C');

        $this->Ln(20);   

    }

    function footer(){

        $this->SetY(-15);

        $this->SetFont('Arial','',8);

        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

    }

    function headerTable(){

        $this->SetFont('Times','B',12);

        $this->Cell(50,10,'date_time',1,0,'C');

        $this->Cell(60,10,'Active Power (W)',1,0,'C');

        $this->Cell(70,10,'Energy Today (kWh)',1,0,'C');

        $this->Cell(80,10,'Energy Total (kWh)',1,0,'C');

    //    $this->Cell(20,10,'ID',1,0,'C');

    //    $this->Cell(20,10,'ID',1,0,'C');

    //    $this->Cell(20,10,'ID',1,0,'C');

    //    $this->Cell(20,10,'ID',1,0,'C');

    //   $this->Cell(20,10,'ID',1,0,'C');

        $this->Ln();

    }



    



    function viewTable($db){

        

        

        $this->SetFont('Times','',12);

        $stmt = $db->query('select * from data' );

        $stmt1 = $db->query('SELECT * FROM `data` where date_time >=  . $sdate . ' );

        while($data = $stmt->fetch(PDO::FETCH_OBJ)){

            $this->Cell(50,10,$data->date_time,1,0,'C');

            $this->Cell(60,10,$data->inv_p,1,0,'L');

            $this->Cell(70,10,$data->inv_ed,1,0,'L');

            $this->Cell(80,10,$data->inv_et,1,0,'L');

            $this->Ln(); 

        }



       

    }



}



$pdf =new PDF();

$pdf->AliasNbPages();

$pdf->AddPage('L','A4','0');

$pdf->headerTable();

$pdf->viewTable($db);

$pdf->Output();

?>
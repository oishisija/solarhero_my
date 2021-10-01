<?php

require('fpdf.php');

$con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com", "", "", "");

$con->set_charset("utf8");



$strDate1 = $_GET["startdate"];

$strDate2 = $_GET["enddate"];

//echo $strDate1;

//echo $strDate2;





function DateTimeDiff($strDate1, $strDate2)

{

	return (strtotime($strDate2) - strtotime($strDate1)) /  (60 * 60 * 24);  // 1 day = 60*60*24

}





//$con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com", "cp705245_tded", "tded2020@peasolarhero", "cp705245_pea17002766") or die("Error: " . mysqli_error($con));

//mysqli_query($con1, "SET NAMES 'utf8' ");



//echo "Date Diff = ".DateDiff($_GET["startdate"],$_GET["enddate"])."<br>";



$timegg = DateTimeDiff($_GET["startdate"], $_GET["enddate"]);



$sdate = date("d-m-Y");

//$ldate = date("yy-m-d", strtotime("-1 days", strtotime($sdate)));

//DATE_FORMAT($_GET["startdate"], '%d-%m-%Y'); 



$queryid = "SELECT * FROM customer where customer.id = 1 ";





// date_format($_GET["startdate"], "d-m-Y H:II");

//$_GET["enddate"] = DateTime("d-m-Y H:II");

// echo $_GET["startdate"]; 

// echo $_GET["enddate"]; 

//$sdate = date("yy-m-d");

//$ldate = date("yy-m-d", strtotime("-1 days", strtotime($sdate)));



//$sdate = date($_GET["startdate"]);

//$ldate = date($_GET["enddate"]);



class PDF extends FPDF

{





	function Header()

	{



	//	$this->Image('picreport/ethlogo.jpg',10,50,'200', '200',);

    //    $this->SetFont('Arial','B',14);

    //    $this->Cell(276,5,'Report Documents',0,0,'C');

    //    $this->Ln();

    //    $this->SetFont('Times','',12);

    //    $this->Cell(276,10,'www.ethernet.co.th',0,0,'C');

    //    $this->Ln(20);   









		//	$this->SetFont('Arial', 'B', 15);



		//dummy cell to put logo

		//$this->Cell(12,0,'',0,0);

		//is equivalent to:

		//	$this->Cell(12);



		//put logo

		//	$this->Image('picreport/ethlogo.jpg', 10, 10, 10);



		//	$this->Cell(100, 10, 'SEMs Report', 0, 1);





		//dummy cell to give line spacing

		//$this->Cell(0,5,'',0,1);

		//is equivalent to:

		//	$this->Ln(5);







		//	$this->SetFont('Arial', 'B', 11);



		//	$this->SetFillColor(180, 180, 255);

		//	$this->SetDrawColor(180, 180, 255);

		//	$this->Cell(40, 8, 'DateTime', 1, 0, 'C', true);

		//	$this->Cell(25, 8, 'Active Power(W)', 1, 0, 'C', true);

		//	$this->Cell(65, 8, 'Energy Today(kWh)', 1, 0, 'C', true);

		//	$this->Cell(60, 8, 'Energy Total(kWh)', 1, 1, 'C', true);



	}

	function Footer()

	{

		//add table's bottom line

		//$this->Cell(190, 0, '', 'T', 1, '', true);



		//Go to 1.5 cm from bottom

		$this->SetY(-15);



		$this->SetFont('Arial', '', 8);



		//width = 0 means the cell is extended up to the right margin

		$this->Cell(0, 10, 'Page ' . $this->PageNo() . " / {pages}", 0, 0, 'C');

	}

}











//A4 width : 219mm

//default margin : 10mm each side

//writable horizontal : 219-(10*2)=189mm

define('FPDF_FONTPATH', 'font/');



$pdf = new PDF('P', 'mm', 'A4'); //use new class



//$pdf->Image('picreport/ethlogo.jpg',10,6,30);









//define new alias for total page numbers

$pdf->AliasNbPages('{pages}');



//$pdf->SetAutoPageBreak(true, 15);

//$pdf->AddPage();



//$pdf = new FPDF('P', 'mm', 'A4');



$pdf->AddPage();



//set font to arial, bold, 14pt

$pdf->SetFont('Arial', 'B', 15);



//Cell(width , height , text , border , end line , [align] )

$pdf->SetTextColor(100, 150, 255);

$pdf->Cell(120, 5, 'Energy Genrated Report', 0, 0);

$pdf->Cell(59, 5, 'SEMs', 0, 1); //end of line

$pdf->SetTextColor(0, 0, 0);

$queryid = mysqli_query($con, "SELECT * FROM customer where customer.id = 1 ");

$minus_sign = "-";

while ($row = mysqli_fetch_array($queryid)) {



	$pdf->SetFont('Arial', 'B', 12);

	$pdf->Cell(120, 5, 'Site Name : ' . $row["firstname"] . " " . $row["lastname"], 0, 0);



	$pdf->Cell(59, 5, 'Solar Energy Management System', 0, 1); //end of line





	//set font to arial, regular, 12pt

	//$pdf->SetFont('Arial', '', 10);





	$pdf->Cell(59, 5, '', 0, 1); //end of line



	$pdf->AddFont('angsa', '', 'angsa.php');

	$pdf->SetFont('angsa', '', 16);

	$pdf->Cell(120, 5, iconv('UTF-8', 'TIS-620', '' . $row["address"] . ''), 0, 0);

	$pdf->Cell(25, 5, 'Date :', 0, 0);

	$pdf->Cell(34, 5, $sdate, 0, 1); //end of line



	$pdf->Cell(120, 5, 'Meter ID : ' . $row["id_meter"] . ' Customer ID : ' . $row["id"], 0, 0);

	$pdf->Cell(25, 5, 'Date Period :', 0, 0);

	$pdf->Cell(34, 5, date("d-m-yy h:i", strtotime($_GET['startdate'])), 0, 1); //end of line



	//	$pdf->Cell(120, 5, 'Phone: '.$row["tel"], 0, 0);

	$pdf->Cell(120, 5, 'Phone: ' . substr($row["tel"], 0, -7) . $minus_sign . substr($row["tel"], 3, -4) . $minus_sign . substr($row["tel"], 6), 0, 0);

	//	$pdf->Cell(120, 5, 'Phone: '.substr($row["tel"],0,-7).$minus_sign.substr($row["tel"],3,-4).$minus_sign.substr($row["tel"],6). 0);

	//	str_pad($input, 10, "-=", STR_PAD_LEFT);

	$pdf->Cell(25, 5, 'To Date :', 0, 0);

	$pdf->Cell(34, 5, date("d-m-yy H:i", strtotime($_GET['enddate'])), 0, 1); //end of line



	$pdf->Cell(120, 5, 'Capactiy : ' . $row["capactiy"] . ' K ', 0, 0);

	$pdf->Cell(25, 5, 'COD Date :', 0, 0);

	$pdf->Cell(34, 5, 'xxxxx', 0, 1); //end of line







	//make a dummy empty cell as a vertical spacer

	$pdf->Cell(189, 5, '', 0, 1); //end of line



	//billing address

	//	$pdf->Cell(100, 5, 'Summary Area', 0, 1); //end of lin



	//$pdf->Cell(40,8,$data1['date_time'],'LR',0 ,'C');

	//$pdf->Cell(25,8,$data1['inv_p'],'LR',0,'C');



	//	if($pdf->GetStringWidth($data1['inv_ed']) > 65){

	$pdf->SetFont('Arial', '', 7);

	//		$pdf->Cell(65,8,$row['inv_ed'],'LR',0,'C');

	$pdf->SetFont('Arial', '', 9);

	//	}else{

	//		$pdf->Cell(65,8,$data1['inv_ed'],'LR',0,'C');

	///	}

	//	$pdf->Cell(60,8,$data1['inv_et'],'LR',1,'C');

}





//DATE_FORMAT($_GET["startdate"], '%d-%m-%Y'); 



//set font to arial, regular, 12pt

$pdf->SetFont('Arial', '', 12);





$pdf->Cell(59, 5, '', 0, 1); //end of line

$query1 = mysqli_query($con, "select AVG(inv_et) as avget from data where date_time BETWEEN '" . $_GET["startdate"] . "' and '" . $_GET["enddate"] . "'");

while ($data = mysqli_fetch_array($query1)) {

	$pdf->Cell(120, 5, 'Avg .(Energy Total) : ' . number_format($data['avget']) . ' kWh', 0, 0);

}

//$pdf->Cell(25, 5, 'Date_Diff :', 0, 0);

//$pdf->Cell(34, 5, $timegg. ' day', 0, 1); //end of line

$query2 = mysqli_query($con, "select AVG(inv_p) as avgac from data where date_time BETWEEN '" . $_GET["startdate"] . "' and '" . $_GET["enddate"] . "'");

while ($data = mysqli_fetch_array($query2)) {

	$pdf->Cell(130, 5, 'Avg .(Active Power) : ' . number_format($data['avgac']) . ' w', 0, 1);

}

//$pdf->Cell(25, 5, 'Invoice :', 0, 0);

//$pdf->Cell(34, 5, 'xxxxxx', 0, 1); //end of line

$query3 = mysqli_query($con, "select AVG(inv_ed) as avged from data where date_time BETWEEN '" . $_GET["startdate"] . "' and '" . $_GET["enddate"] . "'");

while ($data = mysqli_fetch_array($query3)) {

	$pdf->Cell(130, 5, 'Avg .(Energy Today) : ' . number_format($data['avged']) . ' kWh', 0, 0);

}

//$pdf->Cell(25, 5, 'Energy produced', 0, 0);

$pdf->Cell(34, 5, "", 0, 1); //end of line



//make a dummy empty cell as a vertical spacer

$pdf->Cell(189, 10, '', 0, 1); //end of line



//billing address

$pdf->Cell(100, 5, 'Date Period ' . date("d-m-yy h:i", strtotime($_GET['startdate'])) . ' To ' . date("d-m-yy H:i", strtotime($_GET['enddate'])) . ' (' . ceil($timegg) . ' day)', 0, 1); //end of line



//add dummy cell at beginning of each line for indentation

//$pdf->Cell(10, 5, '', 0, 0);

//$pdf->Cell(90, 5, $_GET["startdate"], 0, 1);



//$pdf->Cell(10, 5, '', 0, 0);

//$pdf->Cell(90, 5, $_GET["startdate"], 0, 1);



//make a dummy empty cell as a vertical spacer

$pdf->Cell(189, 3, '', 0, 1); //end of line



//invoice contents

$pdf->SetFont('Arial', 'B', 12);



$pdf->Cell(40, 8, 'DateTime', 1, 0, 'C');

$pdf->Cell(40, 8, 'Active Power(W)', 1, 0, 'C');

$pdf->Cell(60, 8, 'Energy Today(kWh)', 1, 0, 'C'); //end of line

$pdf->Cell(50, 8, 'Energy Total(kWh)', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);



///Active Power Average







$pdf->SetFont('Arial', '', 9);

//$pdf->SetDrawColor(180, 180, 255);



$query = mysqli_query($con, "select * from data where date_time BETWEEN '" . $_GET["startdate"] . "' and '" . $_GET["enddate"] . "'");



while ($data = mysqli_fetch_array($query)) {



	$pdf->Cell(40, 7, $data['date_time'], '1', 0, 'C');

	$pdf->Cell(40, 7, $data['inv_p'], '1', 0, 'C');



	if ($pdf->GetStringWidth($data['inv_ed']) > 60) {

		$pdf->SetFont('Arial', '', 7);

		$pdf->Cell(60, 8, $data['inv_ed'], '1', 0, 'C');

		$pdf->SetFont('Arial', '', 9);

	} else {

		$pdf->Cell(60, 7, $data['inv_ed'], '1', 0, 'C');

	}

	$pdf->Cell(50, 7, $data['inv_et'], '1', 1, 'C');

}





$pdf->Output();


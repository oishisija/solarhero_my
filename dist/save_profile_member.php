<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>





<?php

session_start();

//if($_SESSION['UserID'] == "")

//{

//	echo "Please Login!";

//	exit();

//}

//$p_id = $_GET["ID"];

$con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com", "", "", "");

mysqli_query($con, "SET NAMES 'utf8' ");



//if($_POST["txtPassword"] != $_POST["txtConPassword"])

//{

//	echo "Password not Match!";

//	exit();

//}



//	$sql="UPDATE student set card_id='".$card_id."',gender='".$gender."',full_name='".$full_name."',class='".$class."',Email='".$Email."',birthdate='".$birthdate."',timein='".$timein."',std_pic='".$std_pic."',std_file='".$std_file."',cn_id='".$cn_id."',subject1='".$subject1."',subject2='".$subject2."'

//	,subject3='".$subject3."',subject4='".$subject4."',remark='".$remark."'  WHERE std_id='".$Select_ID."'" ;

$strSQL = "UPDATE users SET email = '" . trim($_POST['email']) . "' 

	,password = '" . trim($_POST['password']) . "'

	,firstname = '" . trim($_POST['firstname']) . "'

	,lastname = '" . trim($_POST['lastname']) . "' 

	,Status = '" . trim($_POST['Status']) . "' 





	 WHERE id = '" . $_SESSION['id'] . "' ";

//echo $strSQL;

$objQuery = mysqli_query($con, $strSQL);



echo "Save Completed!<br>

	<a href='index.php' class='btn btn-warning btn-xs'>Update Sussces Back To list </a>";







error_reporting(error_reporting() & ~E_NOTICE);

if ($_FILES["file"] != "") {





	if ($file !="null") {

		include "imager.php";

		$img = image_upload('file');

		$img = image_to_jpg($img);

		//$img = image_resize_max($img, 300, 300); 

		$file = image_store_db($img, "image/jpeg");

		$sql = "INSERT INTO images VALUES('" . $_SESSION['id'] . "',  '$file')";

		mysqli_query($con, $sql);

		echo "Save Pic";



		if($file !=""){

		$strpic = "UPDATE images SET img_content = '$file' 

		,img_id = '" . $_SESSION['id'] . "'

		WHERE img_id = '" . $_SESSION['id'] . "' ";

	

	

		//echo $strpic;

		$objQuery = mysqli_query($con, $strpic);

		$error =  $_FILES['file']['error'];

	

		 

		echo "Upload Complete<br>";

		//echo "<a href='Img_show.php'>View_img </a> ";

		}

	}



	else{



		echo "kyt123132";

	}





}





mysqli_close($con);

?>
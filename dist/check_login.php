<?php

	session_start();



	$con= mysqli_connect("cpanel13wh.bkk1.cloud.z.com","","","") or die("Error: " . mysqli_error($con)); 

    mysqli_query($con, "SET NAMES 'utf8' ");



    $strSQL = "SELECT * FROM users WHERE email = '".trim($_POST['email'])."' 

	and password = '".trim($_POST['password'])."' and Active = 'Yes' ";

	//echo $strSQL;

	



	$objQuery = mysqli_query($con, $strSQL);

	$objResult = mysqli_fetch_array($objQuery);

	if(!$objResult)

	{	

			echo "Username and Password Incorrect! and Not Active Please Check Email";

	}

	else

	{

			$_SESSION["id"] = $objResult["id"];

			$_SESSION["Status"] = $objResult["Status"];



			session_write_close();

			

			if($objResult["Status"] == "ADMIN")

			{

				header("location:index.php");

			}

			else

			{

				header("location:login.php");

			}

	}

	mysqli_close($con);





?>
<?php

	$con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com","","","");

	mysqli_query($con, "SET NAMES 'utf8' ");

	



	$strSQL = "SELECT * FROM users WHERE SID = '".trim($_GET['sid'])."' AND id = '".trim($_GET['id'])."' ";

//	echo $strSQL;

	$objQuery = mysqli_query($con ,$strSQL);

	$objResult = mysqli_fetch_array($objQuery);

	if(!$objResult)

	{

			echo "Activate Invalid !";

	}

	else

	{	

			$strSQL = "UPDATE users SET Active = 'Yes'  WHERE SID = '".trim($_GET['sid'])."' AND id = '".trim($_GET['id'])."' ";

			$objQuery = mysqli_query($con ,$strSQL);

		

		$link = '<a href="http://solarhero.link/dashboard/dist/login.php">Login</a>';



		echo "Activate Successfully ! <br>";

		echo "Please login again.";

		echo $link;

	}



	mysqli_close($con);

?>
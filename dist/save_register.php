

<?php



session_start();

$con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com", "", "", "");

mysqli_query($con, "SET NAMES 'utf8' ");







if (trim($_POST["password_1"]) == "") {

	echo "<h1>Please input Password!</h1>";

	exit();

}



if ($_POST["password_1"] != $_POST["password_2"]) {

	echo "<h1>Password not Match!</h1>";

	exit();

}



if (trim($_POST["firstname"]) == "") {

	echo "<h1>Please input firstname!</h1>";

	exit();

}





if (trim($_POST["lastname"]) == "") {

	echo "<h1>Please input lastname!</h1>";

	exit();

}



if (trim($_POST["email"]) == "") {

	echo "<h1>Please input Email!</h1>";

	exit();

}







$strSQL = "SELECT * FROM users WHERE email='" . trim($_POST['email']) . "' ";





$objQuery = mysqli_query($con, $strSQL);

$objResult = mysqli_fetch_array($objQuery);



if ($objResult) {



	echo "<h1> Email already exists!</h1>";

} else {



	$strSQL = "INSERT INTO users (firstname,lastname,email,password,Status,SID,Active) VALUES ('" . $_POST["firstname"] . "', 

	'" . $_POST["lastname"] . "','" . $_POST["email"] . "' ,'" . $_POST["password_1"] . "','ADMIN','" . session_id() . "','No')";

	$objQuery = mysqli_query($con, $strSQL);

	//echo $strSQL;

	$id = mysqli_insert_id($con);

	//	echo $id;

//	echo "Register Completed!<br>Please check your email to activate account";

}





$strTo = $_POST["email"];

$strSubject = "Activate Member Account";

$strHeader  = "Content-type: text/html; charset=windows-874"; // or UTF-8 //

$strHeader  .= "From: ethernet.ns@solarhero.link\nReply-To: ethernet.ns@solarhero.link";







$strMessage = "";

$strMessage .= "Welcome : " . $_POST["firstname"] . "<br>";

$strMessage .= "=================================<br>";

$strMessage .= "Activate account click here.<br>";

$strMessage .=	"http://solarhero.link/dashboard/dist/activate.php?sid=" . session_id() . "&id=" . $id . "<br>";

$strMessage .= "====If you can't click on the link, you have to copy the link to be blank in Bowser and login again as confirmation.====<br>";

$strMessage .= "Contact 096-1528846  Ethernet Thailand <br>";

$strMessage .= "https://www.facebook.com/ethernetthai/";



//*** Files 1 ***//

//	$strFilesName1 = "data.csv";



//	$strContent1 = chunk_split(base64_encode(file_get_contents($strFilesName1)));



//$strMessage .= "--".$strSid."";

//	$strMessage .= "Content-Type: application/octet-stream; name=" . $strFilesName1;

//	$strMessage .= "Content-Transfer-Encoding: base64";

//	$strMessage .= "Content-Disposition: attachment; filename=" . $strFilesName1;

//	$strMessage .= $strContent1;







$flgSend = mail($strTo, $strSubject, $strMessage, $strHeader);

if ($flgSend) {

//	echo "Email Sending." . $strTo . "<br/>";

	

} else {

//	echo "Email Can not Send." . $strTo . "<br/>";

}



?>







<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <meta name="description" content="" />

        <meta name="author" content="" />

        <title>Save register</title>

        <link href="css/styles.css" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

    </head>

    <body class="bg-primary">

        <div id="layoutAuthentication">

            <div id="layoutAuthentication_content">

                <main>

                    <div class="container">

                        <div class="row justify-content-center">

                            <div class="col-lg-5">

                                <div class="card shadow-lg border-0 rounded-lg mt-5">

                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register Successful</h3></div>

                                    <div class="card-body">

                                        <a href="login.php">Register Successful Go to Login</a>

                                        <br>

                                        <a href="login.php">สมัครสมาชิกเรียบร้อย</a>

                                        <br>

                                        <a>Please check your email to activate account</a>

                                    </div>

                                    <div class="card-footer text-center">

                                        <div class="small"><a href="login.php"> login up!</a></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </main>

            </div>

            <div id="layoutAuthentication_footer">

                <footer class="py-4 bg-light mt-auto">

                    <div class="container-fluid">

                        <div class="d-flex align-items-center justify-content-between small">

                            <div class="text-muted">Copyright &copy; Your Website 2019</div>

                            <div>

                                <a href="#">Privacy Policy</a>

                                &middot;

                                <a href="#">Terms &amp; Conditions</a>

                            </div>

                        </div>

                    </div>

                </footer>

            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <script src="js/scripts.js"></script>

    </body>



</html>
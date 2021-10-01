<?php



session_start();



// initializing variables



//$username = "";



//$email    = "";



$errors = array();



// connect to the database



$db = mysqli_connect('cpanel13wh.bkk1.cloud.z.com', '', '', '');















// REGISTER USER



    if (isset($_POST['reg_user'])) {



    // receive all input values from the form

    

    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);



    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);

    

    $email = mysqli_real_escape_string($db, $_POST['email']);

    

    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);

    

    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    

    // form validation: ensure that the form is correctly filled ...

    

    // by adding (array_push()) corresponding error unto $errors array

    

    if (empty($firstname)) { array_push($errors, "firstname is required"); }



    if (empty($lastname)) { array_push($errors, "lastname is required"); }

    

    if (empty($email)) { array_push($errors, "Email is required"); }

    

    if (empty($password_1)) { array_push($errors, "Password is required"); }

    

    if ($password_1 != $password_2) {

    

    array_push($errors, "The two passwords do not match");

    

    }

    

    // first check the database to make sure

    

    // a user does not already exist with the same username and/or email

    

    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";

    

    

    $result = mysqli_query($db, $user_check_query);

    

    $user = mysqli_fetch_array($result);

    

    if ($user) { // if user exists

    

    if ($user['email'] === $email) {

    

    array_push($errors, "email already exists");

    

    }

    

    }

    

    

    // Finally, register user if there are no errors in the form

    

    if (count($errors) == 0) {

    

    $password = $password_1;//encrypt the password before saving in the database

    

    //echo $password ;

    

    $query = "INSERT INTO users(firstname, lastname, email, password,Status,SID,Active)

    

    VALUES('$firstname', '$lastname', '$email', '$password','USER','".session_id()."','No')";

    

    $objQuery = mysqli_query($db, $query);

    $Uid = mysqli_insert_id($db);

   // echo $query;

    

   echo "Register Completed!<br>Please check your email to activate account";	



  

    $_SESSION['email'] = $email;

    

    $_SESSION['success'] = "You are now logged in";



 //   echo"<script language=\"JavaScript\">";

 //   echo"alert('Register Successful')";    

 //   echo"</script>";

 //    echo "Register Completed!<br>	

 //   <a href='login.php' class='btn btn-warning btn-xs'>Go To login</a>";



   // sleep(1);

    

    echo"<script language=\"JavaScript\">";

    echo"alert('Register Successful')";

    echo"</script>";





    

    }

    

    }







    

/////////////////////////////////////////////////// OLD ///////////////////////////////////////





		$strTo = $_POST["txtEmail"];

		$strSubject = "Activate Member Account";

		$strHeader  = "Content-type: text/html; charset=windows-874"; // or UTF-8 //

		$strHeader  .= "From: ethernet.ns@solarhero.link\nReply-To: ethernet.ns@solarhero.link";

		





		$strMessage = "";

		$strMessage .= "Welcome : ".$_POST["txtName"]."<br>";

		$strMessage .= "=================================<br>";

		$strMessage .= "Activate account click here.<br>";

		$strMessage .=	"http://solarhero.link/dashboard/dist/activate.php?sid=".session_id()."&uid=".$Uid."<br>";

	//	$strMessage .= "https://www.thaicreate.com/activate.php?sid=".session_id()."&uid=".$Uid."<br>";

		$strMessage .= "====If you can't click on the link, you have to copy the link to be blank in Bowser and login again as confirmation.====<br>";

		$strMessage .= "Contact 096-1528846  Ethernet Thailand <br>";

		$strMessage .= "https://www.facebook.com/ethernetthai/";

		

					//*** Files 1 ***//

	//	$strFilesName1 = "data.csv";

					

	//	$strContent1 = chunk_split(base64_encode(file_get_contents($strFilesName1)));

				

		//$strMessage .= "--".$strSid."";

	//	$strMessage .= "Content-Type: application/octet-stream; name=".$strFilesName1; 

	//	$strMessage .= "Content-Transfer-Encoding: base64";

	//	$strMessage .= "Content-Disposition: attachment; filename=".$strFilesName1;

	//	$strMessage .= $strContent1;

	







		$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader); 

		if($flgSend)

		{

			echo"Email Sending.". $strTo ."<br/>";

		}

		else

		{

			echo"Email Can not Send.".$strTo."<br/>";

		}



		

	





























    // ...





    // LOGIN USER



    if (isset($_POST['login_user'])) {



    $email = mysqli_real_escape_string($db, $_POST['email']);

    

    $password = mysqli_real_escape_string($db, $_POST['password']);

    

    if (empty($email)) {

    

    array_push($errors, "email is required");

    

    }

    

    if (empty($password)) {

    

    array_push($errors, "Password is required");

    

    }

    

    if (count($errors) == 0) {

    

    $password = md5($password);

    

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    

    $results = mysqli_query($db, $query);

    

    if (mysqli_num_rows($results) == 1) {

    

    $_SESSION['email'] = $email;

    

    $_SESSION['success'] = "You are now logged in";

    

    header('location: index.php');

    

    }else {

    

    array_push($errors, "Wrong email/password combination");

    

    }

    

    }

    

    }?>
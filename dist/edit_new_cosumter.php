<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>





<?php

session_start();

//	if($_SESSION['ID'] == "")

//	{

//		echo "Please Login!";

//		exit();

//	}

$p_id = $_GET["ID"];

$con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com", "", "", "");





$strSQL = "SELECT * FROM new_customer WHERE id = '" . $_GET["ID"] . "' ";

// echo $strSQL;

$objQuery = mysqli_query($con, $strSQL);

$objResult = mysqli_fetch_array($objQuery);

?>





<?php

//$p_id = $_GET["ID"];

//$con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com","cp705245_tded","tded2020@peasolarhero","cp705245_solar_customer");

// $id = $_GET['id'];

//$sql = "SELECT img_content FROM images WHERE img_id =$p_id ";

// echo $sql;

//$result = mysqli_query($con, $sql);

//$data = mysqli_fetch_array($result);





?>



<?php



// while($objpicResult = mysqli_fetch_array($result)){

//$id = $objpicResult['img_id'];

//$img_con = $objpicResult['img_content'];



//echo'<img src="data:image/jpg;base64,'.base64_encode( $objpicResult['img_content'] ).'" height="150" width="150" >'









?>









<?php

//}

?>

<html>



<head>

  <title>Edit profile Cosumter</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>



<body>



  <div class="jumbotron jumbotron-fluid">

    <div class="container">

      <h1 class="display-4">Edit Profile Cosumter</h1>





      <div class="card-body">

        <form method="post" action="save_profile_cosumter.php">



          <div class="form-row">

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputFirstName">ID</label><input class="form-control py-4"name="txtid" type="text"  value="<?php echo $objResult["id"]; ?>" /></div>

            </div>

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputLastName">Owner Type:</label><input class="form-control py-4" id="inputLastName" type="text" name="txtownertype" value="<?php echo $objResult["ownertype"]; ?>" /></div>

            </div>

          </div>

          <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Business Type:</label><input class="form-control py-4" id="inputEmailAddress" type="text" name="txtbusinesstype"  value="<?php echo $objResult["businesstype"]; ?>" /></div>

          <div class="form-row">

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputPassword">First Name:</label><input class="form-control py-4" id="inputPassword" type="text" name="txtfirstname" placeholder="Enter First Name" value="<?php echo $objResult["firstname"]; ?>" /></div>

            </div>

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Last Name:</label><input class="form-control py-4" id="inputConfirmPassword" type="password" name="txtlastname" placeholder="Enter First Name" value="<?php echo $objResult["lastname"]; ?>"  /></div>

            </div>

          </div>

          <div class="form-row">

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputPassword">Address:</label><input class="form-control py-4" id="inputPassword" type="text" name="txtaddress"  value="<?php echo $objResult["address"]; ?>" /></div>

            </div>

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Telephone:</label>2<input class="form-control py-4" id="inputConfirmPassword" type="text" name="txttel"  value="<?php echo $objResult["tel"]; ?>" /></div>

            </div>

          </div>

          <div class="form-row">

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputPassword">Email:</label><input class="form-control py-4" id="inputPassword" type="text" name="txtemail"  value="<?php echo $objResult["email"]; ?>" /></div>

            </div>

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">line ID:</label><input class="form-control py-4" id="inputConfirmPassword" type="password" name="txtline_id"  value="<?php echo $objResult["line_id"]; ?>" /></div>

            </div>

          </div>

          <div class="form-row">

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputPassword">location lat:</label><input class="form-control py-4" id="inputPassword" type="text" name="txtlocation_lat"  value="<?php echo $objResult["location_lat"]; ?>" /></div>

            </div>

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">localtion long:</label><input class="form-control py-4" id="inputConfirmPassword" type="text" name="txtlocaltion_long"  value="<?php echo $objResult["localtion_long"]; ?>" /></div>

            </div>

          </div>

          <div class="form-row">

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputPassword">Roof leyout:</label><input class="form-control py-4" id="inputPassword" type="text" name="txtroof_leyout"  value="<?php echo $objResult["roof_leyout"]; ?>" /></div>

            </div>

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Roof_area:</label><input class="form-control py-4" id="inputConfirmPassword" type="text" name="txtroof_area"  value="<?php echo $objResult["roof_area"]; ?> "/></div>

            </div>

          </div>

          <div class="form-row">

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputPassword">Metertype:</label><input class="form-control py-4" id="inputPassword" type="text" name="txtmetertype"  value="<?php echo $objResult["metertype"]; ?>" /></div>

            </div>

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Peameter_id:</label><input class="form-control py-4" id="inputConfirmPassword" type="text" name="txtpeameter_id"  value="<?php echo $objResult["peameter_id"]; ?>" /></div>

            </div>

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Electrical_bill:</label><input class="form-control py-4" id="inputConfirmPassword" type="text" name="txtelectrical_bill"  value="<?php echo $objResult["electrical_bill"]; ?>" /></div>

            </div>

          </div>

          <div class="form-row">

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputPassword">Brand:</label><input class="form-control py-4" id="inputPassword" type="text" name="txtbrand"  value="<?php echo $objResult["brand"]; ?>" /></div>

            </div>

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">model:</label><input class="form-control py-4" id="inputConfirmPassword" type="text" name="txtmodel"  value="<?php echo $objResult["model"]; ?>" /></div>

            </div>

            <div class="col-md-6">

              <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">capacity:</label><input class="form-control py-4" id="inputConfirmPassword" type="text" name="txtcapacity" value="<?php echo $objResult["capacity"]; ?>" /></div>

            </div>

          </div>

          <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" href="#" type="submit" name="reg_user">Save</button></div>

        </form>

      </div>



 <!--     <form name="form1" method="post" action="save_profile_cosumter.php">

        <p class="lead">

          <table width="400" border="1" style="width: 400px">

            <hr>

            <tbody class="table-responsive">



              <tr>

                <td width="125"> &nbsp;ID</td>

                <td width="180"><?php echo $objResult["id"]; ?>

                </td>

              </tr>

              <tr>

                <td> &nbsp;Owner Type:</td>

                <td>

                  <input name="txtownertype" type="text" id="txtownertype" value="<?php echo $objResult["ownertype"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;Business Type:</td>

                <td><input name="txtbusinesstype" type="text" id="txtbusinesstype" value="<?php echo $objResult["businesstype"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;First Name:</td>

                <td><input name="txtfirstname" type="text" id="txtfirstname" value="<?php echo $objResult["firstname"]; ?>">

                </td>

              </tr>

              <tr>

                <td>&nbsp;Last Name:</td>

                <td><input name="txtlastname" type="text" id="txtlastname" value="<?php echo $objResult["lastname"]; ?>"></td>

              </tr>

              <tr>

                <td> &nbsp;Address:</td>

                <td>

                  <input name="txtaddress" type="text" id="txtaddress" value="<?php echo $objResult["address"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;Telephone</td>

                <td>

                  <input name="txttel" type="text" id="txttel" value="<?php echo $objResult["tel"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;email</td>

                <td>

                  <input name="txtemail" type="text" id="txtemail" value="<?php echo $objResult["email"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;line id</td>

                <td>

                  <input name="txtline_id" type="text" id="txtline_id" value="<?php echo $objResult["line_id"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;location lat</td>

                <td>

                  <input name="txtlocation_lat" type="text" id="txtlocation_lat" value="<?php echo $objResult["location_lat"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;localtion long</td>

                <td>

                  <input name="txtlocaltion_long" type="text" id="txtlocaltion_long" value="<?php echo $objResult["localtion_long"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;roof leyout</td>

                <td>

                  <input name="txtroof_leyout" type="text" id="txtroof_leyout" value="<?php echo $objResult["roof_leyout"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;roof_area</td>

                <td>

                  <input name="txtroof_area" type="text" id="txtroof_area" value="<?php echo $objResult["roof_area"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;metertype</td>

                <td>

                  <input name="txtmetertype" type="text" id="txtmetertype" value="<?php echo $objResult["metertype"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;electrical_bill</td>

                <td>

                  <input name="txtelectrical_bill" type="text" id="txtelectrical_bill" value="<?php echo $objResult["electrical_bill"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;brand</td>

                <td>

                  <input name="txtbrand" type="text" id="txtbrand" value="<?php echo $objResult["brand"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;model</td>

                <td>

                  <input name="txtmodel" type="text" id="txtmodel" value="<?php echo $objResult["model"]; ?>">

                </td>

              </tr>

              <tr>

                <td> &nbsp;capacity</td>

                <td>

                  <input name="txtcapacity" type="text" id="txtcapacity" value="<?php echo $objResult["capacity"]; ?>">

                </td>

              </tr>



            </tbody>

          </table>

          <br>

          <input class="btn btn-info btn-lg" type="submit" name="Submit" value="Save">



          <a class="btn btn-secondary btn-lg" role="button" onclick="goBack()">Cancel</a>

          <script>

            function goBack() {

              window.history.back();

            }

          </script>

      </form> -->

      </p>

    </div>

  </div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>





<?php

session_start();

if ($_SESSION['id'] == "") {

  echo "Please Login!";

  exit();

}

$p_id = $_GET["ID"];

$con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com", "", "", "");





$strSQL = "SELECT * FROM users WHERE id = '" . $_GET["ID"] . "' ";

// echo $strSQL;

$objQuery = mysqli_query($con, $strSQL);

$objResult = mysqli_fetch_array($objQuery);

?>

<html>



<head>

  <title>Profile Cosumter</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>



<body>



  <div class="jumbotron jumbotron-fluid">

    <div class="container">

      <h1 class="display-4">Profile Member</h1>







      <?php

      $p_id = $_GET["ID"];

      $con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com", "cp705245_Nitipat", "ethernet", "cp705245_dash_board");

      //   $id = $_GET['id'];

      $sql = "SELECT img_content FROM images WHERE img_id = $p_id ";

    //  echo $sql;

      $resultpic = mysqli_query($con, $sql);

      //$data = mysqli_fetch_array($resultpic);





      ?>



      <?php



   //   while ($objpicResult = mysqli_fetch_array($resultpic)) {

        //$id = $objpicResult['img_id'];

   //     $img_con = $objpicResult['img_content'];



   //     echo '<img src="data:image/jpg;base64,' . base64_encode($objpicResult['img_content']) . '" height="150" width="150" >'



      ?>



      <?php

  //    }

      ?>



      <script type='text/javascript'>

        function preview_image(event) {

          var reader = new FileReader();

          reader.onload = function() {

            var output = document.getElementById('showimg');

            output.src = reader.result;

          }

          reader.readAsDataURL(event.target.files[0]);

        }

      </script>





      <hr>

      <div class="container bootstrap snippet">

        <div class="row">

          <div class="col-sm-9">

            <h1><?php echo $objResult["firstname"]; ?> <?php echo $objResult["lastname"]; ?></h1>

          </div>

          <div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="picreport/ethlogo.jpg"></a></div>

        </div>

        <div class="row">

          <div class="col-sm-3">

            <!--left col-->





            <div class="text-center">

              <!--   <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" id="showimg" class="avatar img-circle img-thumbnail" alt=""> -->

              <?php



              while ($objpicResult = mysqli_fetch_array($resultpic)) {

                //$id = $objpicResult['img_id'];

                $img_con = $objpicResult['img_content'];



                echo '<img class="avatar img-circle img-thumbnail" src="data:image/jpg;base64,' . base64_encode($objpicResult['img_content']) . '" height="150" width="150" >'



              ?>



              <?php

              }

              ?>

              <h6>Upload a different photo...</h6>

              <!--  <form class="form" action="save_profile_member.php" method="post" id="registrationForm"> -->

              <form name="form1" method="post" action="save_profile_member.php" enctype="multipart/form-data">

                <input type="file" name="file" onchange="preview_image(event)" class="text-center center-block file-upload">

                <!--  <input type="submit" name="Submit" value="Submit"> 

              </form>  -->

            </div>

            </hr><br>







          </div>

          <!--/col-3-->

          <div class="col-sm-9">

            <!--    <ul class="nav nav-tabs">

                <li class="active"><a data-toggle="tab" href="#home">Home</a></li>

                <li><a data-toggle="tab" href="#messages">Menu 1</a></li>

                <li><a data-toggle="tab" href="#settings">Menu 2</a></li>

              </ul> -->











            <div class="tab-content">

              <div class="tab-pane active" id="home">

                <hr>

                <!--   <form class="form" action="##" method="post" id="registrationForm"> -->

                <div class="form-group">



                  <div class="col-xs-6">

                    <label for="first_name">

                      <h4>First name</h4>

                    </label>

                    <input type="text" value="<?php echo $objResult["firstname"]; ?>" class="form-control" name="firstname" id="first_name" placeholder="first name" title="enter your first name if any.">

                  </div>

                </div>

                <div class="form-group">



                  <div class="col-xs-6">

                    <label for="last_name">

                      <h4>Last name</h4>

                    </label>

                    <input type="text" value="<?php echo $objResult["lastname"]; ?>" class="form-control" name="lastname" id="last_name" placeholder="last name" title="enter your last name if any.">

                  </div>

                </div>





                <div class="form-group">



                  <div class="col-xs-6">

                    <label for="email">

                      <h4>Email</h4>

                    </label>

                    <input type="email" value="<?php echo $objResult["email"]; ?>" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">

                  </div>

                </div>

                <div class="col-xs-6">

                  <label for="email">

                    <h4>Status</h4>

                  </label>

                  <input type="text" value="<?php echo $objResult["Status"]; ?>" class="form-control" name="Status" id="Status" title="enter your email.">

                </div>

              </div>



              <div class="form-group">



                <div class="col-xs-6">

                  <label for="password">

                    <h4>Password</h4>

                  </label>

                  <input type="password" value="<?php echo $objResult["password"]; ?>" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">

                </div>

              </div>



              <div class="form-group">

                <div class="col-xs-12">

                  <br>

                  <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>  

                  </form>               

                  

                 <button class="btn btn-lg"  ><a class="glyphicon" href=javascript:history.back(1)>Cancel</a> </button>

                </div>

              </div>

              

                  



              <hr>

            </div>





          </div>

          <!--/col-9-->

        </div>

        <!--/row-->













        <hr>

        <!--    <form name="form1" method="post" action="save_profile_member.php">

            <p class="lead">

              <table width="400" border="1" style="width: 600px">

                <hr>

                <tbody class="table table-dark">

                  <tr>

                    <td width="125"> &nbsp;ID</td>

                    <td width="180"><?php echo $objResult["id"]; ?>

                    </td>

                  </tr>

                  <tr>

                    <td> &nbsp;Email:</td>

                    <td>

                      <input class="form-control py-4" name="email" type="text" id="txtemail" value="<?php echo $objResult["email"]; ?>">

                    </td>

                  </tr>

                  <tr>

                    <td> &nbsp;Password:</td>

                    <td><input class="form-control py-4" name="password" type="text" id="txtpassword" value="<?php echo $objResult["password"]; ?>">

                    </td>

                  </tr>

                  <tr>

                    <td> &nbsp;First Name:</td>

                    <td><input class="form-control py-4" name="firstname" type="text" id="txtfirstname" value="<?php echo $objResult["firstname"]; ?>">

                    </td>

                  </tr>

                  <tr>

                    <td>&nbsp;Last Name:</td>

                    <td><input class="form-control py-4" name="lastname" type="text" id="txtlastname" value="<?php echo $objResult["lastname"]; ?>"></td>

                  </tr>

                  <tr>

                    <td> &nbsp;Status:</td>

                    <td>

                      <input class="form-control py-4" name="Status" type="text" id="txtStatus" value="<?php echo $objResult["Status"]; ?>">

                    </td>

                  </tr>

                  <tr>







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
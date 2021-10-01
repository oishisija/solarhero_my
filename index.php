<link rel="stylesheet" type="text/css" href="jquery.datetimepicker.css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.datetimepicker.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
$_SESSION["time"] = date("Y-m-d H:i:s");

echo $_SESSION["time"];

if ($_SESSION['id'] == "") {
    echo "Please Login!!<br>	
		<a href='login.php' class='btn btn-warning btn-xs'>Go To Login</a>";
    exit();
}

if ($_SESSION['Status'] != "ADMIN") {
    echo "This page for Admin only!";
    exit();
}


$con = mysqli_connect("", "", "", "");
//	mysql_select_db("mydatabase");
mysqli_query($con, "SET NAMES 'utf8' ");
$strSQL = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "' ";
echo $strSQL;
$objQuery = mysqli_query($con, $strSQL);
$objResult = mysqli_fetch_array($objQuery);



//Step1
$db = mysqli_connect('', '', '', '')
    or die('Error connecting to MySQL server.');
mysqli_query($db, "SET NAMES 'utf8' ");


$sdate = date("yy-m-d");
$ldate = date("yy-m-d", strtotime("-1 days", strtotime($sdate)));


$query = "SELECT * FROM `data` where date_time >= '" . $sdate . "' ";


//$query = "SELECT * FROM `data` ";
// echo $query;
$result = mysqli_query($db, $query);
/////View details card Active Power
$resultac = mysqli_query($db, $query);
///View details card engery today
$resulted = mysqli_query($db, $query);
///View details card engery total
$resultet = mysqli_query($db, $query);








?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<?php

$con = mysqli_connect("", "", "", "") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");


$sdate = date("yy-m-d");
$ldate = date("yy-m-d", strtotime("-1 days", strtotime($sdate)));


$query = "SELECT * FROM `data` where date_time >= '" . $sdate . "' ";

//echo  $query;

if (isset($_POST['but_search'])) {
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    //echo("text1");

    if (!empty($startdate) && !empty($enddate)) {
        $query = " SELECT date_time ,id ,inv_ed , inv_et ,inv_f ,inv_i ,inv_op ,inv_p ,inv_pf ,inv_st ,inv_tm ,inv_v ,inv_va ,site_location_x ,site_location_y ,site_postcode FROM `data` WHERE  date_time  BETWEEN '" . $startdate . "' and '" . $enddate . "' ";
        //  $query = " SELECT date_format(date_time,'%Y-%m-%d') , inv_p  FROM `data` WHERE  date_time  BETWEEN '".$startdate."' and '".$enddate."' ";
    }
}

if (isset($_POST['submitlastday'])) {
    $sdate = date("yy-m-d h:i:s ");
    $ldate = date("yy-m-d 00:00:00 ", strtotime("-1 days", strtotime($sdate)));
    $ldate1 = date("yy-m-d 23:59:00 ", strtotime("-1 days", strtotime($sdate)));
    $query = "SELECT * FROM `data` where date_time BETWEEN '" . $ldate . "' and '" . $ldate1 . "' ";

    //$query = "SELECT * FROM `data` where date_time BETWEEN '".$ldate."' and '".$ldate."' ";
    //  echo $query;
}

//////////////////// select today
if (isset($_POST['submittoday'])) {
    $sdate = date("yy-m-d  ");
    $ldate = date("yy-m-d  ", strtotime("-1 days", strtotime($sdate)));
    // $ldate1 = date("yy-m-d 23:59:00 ",strtotime("-1 days",strtotime($sdate)));
    $query = "SELECT * FROM `data` where date_time >= '" . $sdate . "'";

    //$query = "SELECT * FROM `data` where date_time BETWEEN '".$ldate."' and '".$ldate."' ";
    //  echo $query;
}
////////////////// select Lasy 7 day

if (isset($_POST['submitlast7day'])) {
    $sdate = date("yy-m-d 23:59:00 ");
    $ldate = date("yy-m-d 00:00:00 ", strtotime("-7 days", strtotime($sdate)));
    $ldate1 = date("yy-m-d 23:59:00 ", strtotime("-7 days", strtotime($sdate)));
    $query = "SELECT * FROM `data` where date_time BETWEEN '" . $ldate . "' and '" . $sdate . "' ";

    //$query = "SELECT * FROM `data` where date_time BETWEEN '".$ldate."' and '".$ldate."' ";
    //echo $query;

}
////////////////// select Lasy Month

if (isset($_POST['submittastmonth'])) {
    $sdate = date("yy-m-d h:i:s ");
    $ldate = date("yy-m-d 00:00:00 ", strtotime("-1 month", strtotime($sdate)));
    $ldate1 = date("yy-m-d 23:59:00 ", strtotime("", strtotime($sdate)));

    $query = "SELECT * FROM `data` where date_time BETWEEN '" . $ldate . "' and '" . $ldate1 . "' ";
}

$resultchart1 = mysqli_query($con, $query);
//$resultchart = mysqli_query($db, $query1);

$inv_ed = array();
$inv_et = array();
$date_time = array();
$inv_p = array();
$site_postcode = array();

while ($row = mysqli_fetch_array($resultchart1)) {

    $date_time[] = "\"" . $row['date_time'] . "\"";

    $inv_p[] = "\"" . $row['inv_p'] . "\"";

    $inv_ed[] = "\"" . $row['inv_ed'] . "\"";

    $inv_et[] = "\"" . $row['inv_et'] . "\"";
}

mysqli_close($con);
$date_time = implode(",", $date_time);
$inv_p = implode(",", $inv_p);
$inv_ed = implode(",", $inv_ed);
$inv_et = implode(",", $inv_et);

?>



<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Ethernet Thailand</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button><!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ProfileModal">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsModal">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>


    <!-- Profile Modal-->

    <div class="modal fade" id="ProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">My Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <!--   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a> -->
                </div>
            </div>
        </div>
    </div>


    <!-- settings Modal-->

    <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Setting</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <!--   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="layout-static.php">Static Navigation</a><a class="nav-link" href="layout-sidenav-light.php">Light Sidenav</a></nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="login.php">Login</a><a class="nav-link" href="register.php">Register</a><a class="nav-link" href="password.php">Forgot Password</a></nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="401.html">401 Page</a><a class="nav-link" href="404.html">404 Page</a><a class="nav-link" href="500.html">500 Page</a></nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a><a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                        </a><a class="nav-link" href="profile.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Profile
                        </a><a class="nav-link" href="member.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Member
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Admin
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <a href="reportpdf.php" title="PDF [new window]" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active" id="timer"></li>
                    </ol>


                    <script>
                        setInterval(function() {

                            var day = "Date";
                            var currentTime = new Date();
                            var currentday = currentTime.getUTCDate();
                            var currentMouth = currentTime.getMonth() + 1;
                            var currentyear = currentTime.getFullYear();
                            var currentday = currentTime.getDate();
                            var currentHours = currentTime.getHours();
                            var currentMinutes = currentTime.getMinutes();
                            var currentSeconds = currentTime.getSeconds();
                            currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
                            currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
                            var timeOfDay = (currentHours < 12) ? "AM" : "PM";
                            currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
                            currentHours = (currentHours == 0) ? 12 : currentHours;
                            var currentTimeString = day + " " + currentday + " " + currentMouth + " " + currentyear + " " + currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
                            document.getElementById("timer").innerHTML = currentTimeString;
                        }, 1000);
                    </script>



                    <?php

                    $db = mysqli_connect('cpanel13wh.bkk1.cloud.z.com', 'cp705245_Nitipat', 'ethernet', 'cp705245_pea17002766')
                        or die('Error connecting to MySQL server.');
                    mysqli_query($db, "SET NAMES 'utf8' ");
                    // Create connection

                    $sqll = "SELECT * FROM `data` ORDER BY date_time DESC LIMIT 0,1";

                    //activepower inv_p
                    $result1 = mysqli_query($db, $sqll);
                    //inv_ed
                    $result2 = mysqli_query($db, $sqll);
                    //inv_et
                    $result3 = mysqli_query($db, $sqll);
                    //time
                    $result4 = mysqli_query($db, $sqll);

                    $result5 = mysqli_query($db, $sqll);
                    //update time
                    $result6 = mysqli_query($db, $sqll);
                    ?>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body h5 mb-0 font-weight-bold text-gray-800  ">Active Power (W) <?php while ($row = mysqli_fetch_array($result1)) { ?>
                                        <br>
                                        <a><?php echo number_format($row['inv_p'], 2); ?></a>


                                    <?php } ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#" data-toggle="modal" data-target="#ACModal">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>


                        <!-- Active Power View Details Modal-->
                        <div class="modal fade" id="ACModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Active Power (W)</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <table class="table table-bordered" id="test1" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Date Time</th>
                                                    <th>Active Power (W)</th>

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Date Time</th>
                                                    <th>Active Power (W)</th>

                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($resultac)) { ?>
                                                    <tr>

                                                        <td><?php echo date('d-m-Y h:i A ', strtotime($row['date_time'])); ?></td>
                                                        <td><?php echo number_format($row['inv_p'], 2); ?></td>


                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>



                                    </div>
                                    <div class="modal-footer">
                                        <!--      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-primary" href="login.php">Logout</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body h5 mb-0 font-weight-bold text-gray-800 ">Energy Today (kWh) <?php while ($row = mysqli_fetch_array($result2)) { ?>
                                        <br>
                                        <a><?php echo number_format($row['inv_ed'], 2); ?></a>


                                    <?php } ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#" data-toggle="modal" data-target="#EDModal">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>


                        <!-- Energy Today (kWh) View Details Modal-->
                        <div class="modal fade" id="EDModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Energy Today (kWh)</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <table class="table table-bordered" id="test2" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Date Time</th>
                                
                                                    <th>Energy Today (kWh)</th>
                                                 
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Date Time</th>
                                              
                                                    <th>Energy Today (kWh)</th>
                                               

                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($resulted)) { ?>
                                                    <tr>

                                                        <td><?php echo date('d-m-Y h:i A ', strtotime($row['date_time'])); ?></td>
                                                    
                                                        <td><?php echo number_format($row['inv_ed'], 2); ?></td>
                                                     

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>


                                    </div>
                                    <div class="modal-footer">
                                        <!--    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-primary" href="login.php">Logout</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body h5 mb-0 font-weight-bold text-gray-800 ">Energy Total (kWh) <?php while ($row = mysqli_fetch_array($result3)) { ?>
                                        <br>
                                        <a><?php echo number_format($row['inv_et'], 2); ?></a>


                                    <?php } ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#" data-toggle="modal" data-target="#ETModal">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <!-- Energy Total (kWh) View Details Modal-->
                        <div class="modal fade" id="ETModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Energy Today (kWh)</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <table class="table table-bordered" id="test3" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Date Time</th>
                                                    <th>Energy Total (kWh)</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Date Time</th>                     
                                                    <th>Energy Total (kWh)</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($resultet)) { ?>
                                                    <tr>
                                                        <td><?php echo date('d-m-Y h:i A ', strtotime($row['date_time'])); ?></td>
                                                        <td><?php echo number_format($row['inv_et'], 2); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>




                                    </div>

                                    <div class="modal-footer">
                                        <!--     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-primary" href="login.php">Logout</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" data-toggle="modal" data-target="#SVModal">Saveing (Total)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">฿ <?php while ($row = mysqli_fetch_array($result5)) { ?>

                                                    <a><?php echo number_format($row['inv_et'] * 2, 2); ?></a>


                                                <?php } ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Saveing (Total)  View Details Modal-->
                        <div class="modal fade" id="SVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Energy Today (kWh)</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                                    <div class="modal-footer">
                                        <!--    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-primary" href="login.php">Logout</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>






                        <!--                <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Date Time <?php while ($row = mysqli_fetch_array($result4)) { ?>
                                        <br>
                                        <a><?php echo date('d-m-Y h:i A ', strtotime($row['date_time'])); ?></a>


                                    <?php } ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                        <div class="row">
                            <div class="col-xl-8 col-lg-7">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Area Chart</div>
                                    <div class="">
                                        <form name="itoffside" method="POST" action=''>
                                            Start <input style="margin-top: 25;" type="text" size="7" name="startdate" value='<?php if (isset($_POST['startdate'])) echo $_POST['startdate']; ?>' id="startdate" />

                                            End <input style="margin-top: 25;" type="text" size="7" name="enddate" value='<?php if (isset($_POST['enddate'])) echo $_POST['enddate']; ?>' id="enddate" />
                                            <script type="text/javascript">
                                                jQuery('#startdate').datetimepicker({
                                                    lang: 'th'
                                                });
                                            </script>
                                            <script type="text/javascript">
                                                jQuery('#enddate').datetimepicker({
                                                    lang: 'th'
                                                });
                                            </script>
                                            <input style="margin-top: -5;" type='submit' name='but_search' value='Submit' class="btn btn-info btn-sm">
                                        </form>
                                    </div>
                                    <div class="">
                                        <form method="post">
                                            <input type="submit" name="submitlastday" value="Last Day" class="btn btn-info btn-sm" role="button" />
                                            <input type="submit" name="submittoday" value="To Day" class="btn btn-info btn-sm" role="button" />
                                            <input type="submit" name="submitlast7day" value="Last 7 Day" class="btn btn-info btn-sm" role="button" />
                                            <input type="submit" name="submittastmonth" value="Last Month" class="btn btn-info btn-sm" role="button" />
                                        </form>
                                    </div>

                                    <canvas id="myChart" width="100%" height="60%"></canvas>
                                    <script>
                                        $scope.width = '100';
                                        $scope.height = '120';
                                        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                                            $scope.width = '100';
                                            $scope.height = '100';
                                        }
                                    </script>
                                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>

                                    <script>
                                        var ctx = document.getElementById("myChart").getContext('2d');
                                        var myChart = new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                                labels: [<?php echo $date_time; ?>],
                                                datasets: [{
                                                        label: 'Active Power (W)',
                                                        data: [<?php echo $inv_p; ?>],
                                                        backgroundColor: [
                                                            'rgba(255, 99, 132, 0.2)',
                                                            'rgba(54, 162, 235, 0.2)',
                                                            'rgba(255, 206, 86, 0.2)',
                                                            'rgba(75, 192, 192, 0.2)',
                                                            'rgba(153, 102, 255, 0.2)',
                                                            'rgba(255, 159, 64, 0.2)'
                                                        ],
                                                        borderColor: [
                                                            'rgba(255,99,132,1)',
                                                            'rgba(54, 162, 235, 1)',
                                                            'rgba(255, 206, 86, 1)',
                                                            'rgba(75, 192, 192, 1)',
                                                            'rgba(153, 102, 255, 1)',
                                                            'rgba(255, 159, 64, 1)'
                                                        ],
                                                        borderWidth: 2
                                                    }, {
                                                        data: [<?php echo $inv_ed; ?>],
                                                        label: "Energy Today (kWh)",
                                                        borderColor: "#c45850",
                                                        borderWidth: 2
                                                        // fill: false
                                                    }, {
                                                        data: [<?php echo $inv_et; ?>],
                                                        label: "Energy Total (kWh)",
                                                        borderColor: "rgba(54, 162, 235, 1)",
                                                        borderWidth: 2
                                                        // fill: false
                                                    }

                                                ]
                                            },

                                            options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: false
                                                        }
                                                    }]
                                                },
                                                //   responsive: true,
                                                //    title: {
                                                //          display: true,
                                                //         text: 'ค่า'
                                                //  }
                                            }
                                        });
                                    </script>


                                </div>
                            </div>



                            <div class="col-xl-4 col-lg-5">


                                <script type="text/javascript">
                                    var i = 0;

                                    function makeProgress() {
                                        if (i < 100) {
                                            i = i + 1;
                                            $(".progress-bar").css("width", i + "%").text(i + " %");
                                        }
                                        // Wait for sometime before running this script again
                                        setTimeout("makeProgress()", 100);
                                    }
                                    makeProgress();
                                </script>

                                <!-- Project Card Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="small font-weight-bold">Active Power <span class="float-right"></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Performance (%) <span class="float-right"></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Customer Database <span class="float-right"></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Payout Details <span class="float-right"></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Email Active <span class="float-right">Complete!</span></h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-4 col-md-6">
                                    <div class="card bg-danger text-white mb-4">
                                        <div class="card-body">Last Date Time <?php while ($row = mysqli_fetch_array($result6)) { ?>
                                                <br>
                                                <a><?php echo date('d-m-Y h:i A ', strtotime($row['date_time'])); ?></a>


                                            <?php } ?></div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">

                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>


                            </div>



                            <div class="col-xl-12">
                                <div class="card-header"><i class="fas fa-table mr-1"></i>Thailand Map </div>
                                <div class="card-body">

                                    <svg>Map</svg>

                                </div>
                            </div>

                            <!--       <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Bar Chart </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div> -->
                            <div class="col-xl-12">
                                <div class="card-header"><i class="fas fa-table mr-1"></i>Productions </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Date Time</th>
                                                    <th>Active Power (W)</th>
                                                    <th>Energy Today (kWh)</th>
                                                    <th>Energy Total (kWh)</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Date Time</th>
                                                    <th>Active Power (W)</th>
                                                    <th>Energy Today (kWh)</th>
                                                    <th>Energy Total (kWh)</th>

                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                    <tr>

                                                        <td><?php echo date('d-m-Y h:i A ', strtotime($row['date_time'])); ?></td>
                                                        <td><?php echo number_format($row['inv_p'], 2); ?></td>
                                                        <td><?php echo number_format($row['inv_ed'], 2); ?></td>
                                                        <td><?php echo number_format($row['inv_et'], 2); ?></td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
            </main>
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


    <!--Map -->



    <!-- Mappppp-->

    <style>
        @import url(http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Josefin+Slab|Arvo|Lato|Vollkorn|Abril+Fatface|Old+Standard+TT|Droid+Sans|Lobster|Inconsolata|Montserrat|Playfair+Display|Karla|Alegreya|Libre+Baskerville|Merriweather|Lora|Archivo+Narrow|Neuton|Signika|Questrial|Fjalla+One|Bitter|Varela+Round);

        .background {
            fill: #eee;
            pointer-events: all;
        }

        .map-layer {
            fill: #fff;
            stroke: #aaa;
        }

        .effect-layer {
            pointer-events: none;
        }

        text {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-weight: 300;
        }

        text.big-text {
            font-size: 30px;
            font-weight: 400;
        }

        .effect-layer text,
        text.dummy-text {
            font-size: 12px;
        }
    </style>

    <body>

        <svg></svg>

        <script src="http://d3js.org/d3.v3.min.js"></script>
        <script>
            var width = 960,
                height = 500,
                centered;

            // Define color scale
            var color = d3.scale.linear()
                .domain([1, 20])
                .clamp(true)
                .range(['#fff', '#409A99']);

            var projection = d3.geo.mercator()
                .scale(1700)
                // Customize the projection to make the center of Thailand become the center of the map
                .rotate([-100.6331, -13.2])
                .translate([width / 2, height / 2]);

            var path = d3.geo.path()
                .projection(projection);

            // Set svg width & height
            var svg = d3.select('svg')
                .attr('width', width)
                .attr('height', height);

            // Add background
            svg.append('rect')
                .attr('class', 'background')
                .attr('width', width)
                .attr('height', height)
                .on('click', clicked);

            var g = svg.append('g');

            var effectLayer = g.append('g')
                .classed('effect-layer', true);

            var mapLayer = g.append('g')
                .classed('map-layer', true);

            var dummyText = g.append('text')
                .classed('dummy-text', true)
                .attr('x', 10)
                .attr('y', 30)
                .style('opacity', 0);

            var bigText = g.append('text')
                .classed('big-text', true)
                .attr('x', 20)
                .attr('y', 45);

            // Load map data
            d3.json('thailand.json', function(error, mapData) {
                var features = mapData.features;

                // Update color scale domain based on data
                color.domain([0, d3.max(features, nameLength)]);

                // Draw each province as a path
                mapLayer.selectAll('path')
                    .data(features)
                    .enter().append('path')
                    .attr('d', path)
                    .attr('vector-effect', 'non-scaling-stroke')
                    .style('fill', fillFn)
                    .on('mouseover', mouseover)
                    .on('mouseout', mouseout)
                    .on('click', clicked);
            });

            // Get province name
            function nameFn(d) {
                return d && d.properties ? d.properties.CHA_NE : null;
            }

            // Get province name length
            function nameLength(d) {
                var n = nameFn(d);
                return n ? n.length : 0;
            }

            // Get province color
            function fillFn(d) {
                return color(nameLength(d));
            }

            // When clicked, zoom in
            function clicked(d) {
                var x, y, k;

                // Compute centroid of the selected path
                if (d && centered !== d) {
                    var centroid = path.centroid(d);
                    x = centroid[0];
                    y = centroid[1];
                    k = 4;
                    centered = d;
                } else {
                    x = width / 2;
                    y = height / 2;
                    k = 1;
                    centered = null;
                }

                // Highlight the clicked province
                mapLayer.selectAll('path')
                    .style('fill', function(d) {
                        return centered && d === centered ? '#D5708B' : fillFn(d);
                    });

                // Zoom
                g.transition()
                    .duration(750)
                    .attr('transform', 'translate(' + width / 2 + ',' + height / 2 + ')scale(' + k + ')translate(' + -x + ',' + -y + ')');
            }

            function mouseover(d) {
                // Highlight hovered province
                d3.select(this).style('fill', 'orange');

                // Draw effects
                textArt(nameFn(d));
            }

            function mouseout(d) {
                // Reset province color
                mapLayer.selectAll('path')
                    .style('fill', function(d) {
                        return centered && d === centered ? '#D5708B' : fillFn(d);
                    });

                // Remove effect text
                effectLayer.selectAll('text').transition()
                    .style('opacity', 0)
                    .remove();

                // Clear province name
                bigText.text('');
            }

            // Gimmick
            // Just me playing around.
            // You won't need this for a regular map.

            var BASE_FONT = "'Helvetica Neue', Helvetica, Arial, sans-serif";

            var FONTS = [
                "Open Sans",
                "Josefin Slab",
                "Arvo",
                "Lato",
                "Vollkorn",
                "Abril Fatface",
                "Old StandardTT",
                "Droid+Sans",
                "Lobster",
                "Inconsolata",
                "Montserrat",
                "Playfair Display",
                "Karla",
                "Alegreya",
                "Libre Baskerville",
                "Merriweather",
                "Lora",
                "Archivo Narrow",
                "Neuton",
                "Signika",
                "Questrial",
                "Fjalla One",
                "Bitter",
                "Varela Round"
            ];

            function textArt(text) {
                // Use random font
                var fontIndex = Math.round(Math.random() * FONTS.length);
                var fontFamily = FONTS[fontIndex] + ', ' + BASE_FONT;

                bigText
                    .style('font-family', fontFamily)
                    .text(text);

                // Use dummy text to compute actual width of the text
                // getBBox() will return bounding box
                dummyText
                    .style('font-family', fontFamily)
                    .text(text);
                var bbox = dummyText.node().getBBox();

                var textWidth = bbox.width;
                var textHeight = bbox.height;
                var xGap = 3;
                var yGap = 1;

                // Generate the positions of the text in the background
                var xPtr = 0;
                var yPtr = 0;
                var positions = [];
                var rowCount = 0;
                while (yPtr < height) {
                    while (xPtr < width) {
                        var point = {
                            text: text,
                            index: positions.length,
                            x: xPtr,
                            y: yPtr
                        };
                        var dx = point.x - width / 2 + textWidth / 2;
                        var dy = point.y - height / 2;
                        point.distance = dx * dx + dy * dy;

                        positions.push(point);
                        xPtr += textWidth + xGap;
                    }
                    rowCount++;
                    xPtr = rowCount % 2 === 0 ? 0 : -textWidth / 2;
                    xPtr += Math.random() * 10;
                    yPtr += textHeight + yGap;
                }

                var selection = effectLayer.selectAll('text')
                    .data(positions, function(d) {
                        return d.text + '/' + d.index;
                    });

                // Clear old ones
                selection.exit().transition()
                    .style('opacity', 0)
                    .remove();

                // Create text but set opacity to 0
                selection.enter().append('text')
                    .text(function(d) {
                        return d.text;
                    })
                    .attr('x', function(d) {
                        return d.x;
                    })
                    .attr('y', function(d) {
                        return d.y;
                    })
                    .style('font-family', fontFamily)
                    .style('fill', '#777')
                    .style('opacity', 0);

                selection
                    .style('font-family', fontFamily)
                    .attr('x', function(d) {
                        return d.x;
                    })
                    .attr('y', function(d) {
                        return d.y;
                    });

                // Create transtion to increase opacity from 0 to 0.1-0.5
                // Add delay based on distance from the center of the <svg> and a bit more randomness.
                selection.transition()
                    .delay(function(d) {
                        return d.distance * 0.01 + Math.random() * 1000;
                    })
                    .style('opacity', function(d) {
                        return 0.1 + Math.random() * 0.4;
                    });
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!--   <script src="assets/demo/chart-area-demo1.js"></script> -->
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">



    </body>

</html>
<link rel="stylesheet" type="text/css" href="jquery.datetimepicker.css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.datetimepicker.js"></script>


<?php
//Step1


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





$db = mysqli_connect('cpanel13wh.bkk1.cloud.z.com', '', '', '')
    or die('Error connecting to MySQL server.');
mysqli_query($db, "SET NAMES 'utf8' ");


$sdate = date("yy-m-d");
$ldate = date("yy-m-d", strtotime("-1 days", strtotime($sdate)));


$query = "SELECT * FROM `data` where date_time >= '" . $sdate . "' ";


//$query = "SELECT * FROM `data` ";
// echo $query;
$result = mysqli_query($db, $query);




$con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com", "", "", "");
mysqli_query($con, "SET NAMES 'utf8' ");
$strSQL = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "' ";
echo $strSQL;
$objQuery = mysqli_query($con, $strSQL);
$objResult = mysqli_fetch_array($objQuery);

/////View details card Active Power
$resultac = mysqli_query($db, $query);
///View details card engery today
$resulted = mysqli_query($db, $query);
///View details card engery total
$resultet = mysqli_query($db, $query);
// echo $Profile ;
$resultProfile = mysqli_query($con, $strSQL);


?>





<?php

$con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com", "cp705245_tded", "tded2020@peasolarhero", "cp705245_pea17002766") or die("Error: " . mysqli_error($con));
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



////////////////// select Lasy year

if (isset($_POST['submittastyear'])) {
    $sdate = date("yy-m-d h:i:s ");
    $ldate = date("yy-m-d 00:00:00 ", strtotime("-1 year", strtotime($sdate)));
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





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Charts - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">My Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered" id="profile" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($row = mysqli_fetch_array($resultProfile)) { ?>
                                <tr>

                                    <td><?php echo ($row['id']); ?></td>
                                    <td><?php echo ($row['firstname']); ?></td>
                                    <td><?php echo ($row['lastname']); ?></td>
                                    <td><?php echo ($row['email']); ?></td>
                                    <?php echo "<td><a href='edit_new_member.php?act=edit&ID=$row[0]' class='btn btn-warning btn-xs'>แก้ไข</a></td> "; ?>
                                    
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

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
                                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="login.php">Login</a><a class="nav-link" href="register.php
                                        ">Register</a><a class="nav-link" href="password.php">Forgot Password</a></nav>
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
                        </a><a class="nav-link" href="member.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Profile
                        </a><a class="nav-link" href="customer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Member
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start admin
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Charts</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Charts</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">Power</div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-chart-area mr-1"></i>Area Chart</div>
                        
                        <div class="col-xl-12 col-lg-7">
                            <form method="post">
                                <img src="pic/solar-panel.png" alt="..." class="rounded float-right" width="100" height="100">
                                Start <input width="276" style="margin-top: 25;" class="form-group pmd-textfield pmd-textfield-floating-label" type="text" name="startdate" value='<?php if (isset($_POST['startdate'])) echo $_POST['startdate']; ?>' id="startdate" />

                                End <input width="276" style="margin-top: 25;" type="text" name="enddate" value='<?php if (isset($_POST['enddate'])) echo $_POST['enddate']; ?>' id="enddate" />
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
                                </div>
                        <div class="col-xl-8 col-lg-7" style="margin-top: -25px">
                                <input type="submit" name="submitlastday" value="Last Day" class="btn btn-info btn-sm" role="button" />
                                <input type="submit" name="submittoday" value="ToDay" class="btn btn-info btn-sm" role="button" />
                                <input type="submit" name="submitlast7day" value="Week" class="btn btn-info btn-sm" role="button" />
                                <input type="submit" name="submittastmonth" value="Last Month" class="btn btn-info btn-sm" role="button" />
                                <input type="submit" name="submittastyear" value="Last Year" class="btn btn-info btn-sm" role="button" />
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



                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Bar Chart </div>


                                <canvas id="myChart1" width="100%" height="60%"></canvas>
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
                                    var ctx = document.getElementById("myChart1").getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'bar',
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


                                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header"><i class="fas fa-chart-pie mr-1"></i>Pie Chart </div>

                                <canvas id="PieChart" width="100%" height="60%"></canvas>
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
                                    var ctx = document.getElementById("PieChart");
                                    var myPieChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: [<?php echo $date_time; ?>],
                                            datasets: [{
                                                data: [<?php echo $inv_p; ?>],
                                                backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
                                            }],
                                        },
                                    });
                                </script>


                                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <!--  <script src="assets/demo/chart-area-demo.js"></script>-->
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script>
</body>

</html>
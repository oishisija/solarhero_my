<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="jquery.datetimepicker.css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.datetimepicker.js"></script>

<?php


$con = mysqli_connect("localhost", "root", "", "cp705245_pea17002766");
//	mysql_connect("localhost","root","root");
mysqli_query($con, "SET NAMES 'utf8' ");

?>
<html>

<head>
  <title>Welcome</title>
</head>

<body>


  <?php
  $con = mysqli_connect("cpanel13wh.bkk1.cloud.z.com", "cp705245_tded", "tded2020@peasolarhero", "cp705245_pea17002766") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");

  $sdate = date("yy-m-d ");
  $ldate = date("yy-m-d ", strtotime("-1 days", strtotime($sdate)));

  //echo $sdate ;
  //echo $ldate ;


  //$query = "SELECT * FROM `data` ORDER BY date_time DESC LIMIT 0,1" ;
  $query = "SELECT * FROM `data` where date_time >= '" . $sdate . "' ";

  //debug select // //echo $query;

  $query1 = "SELECT * FROM `data` ORDER BY date_time DESC LIMIT 0,1";


  if (isset($_POST['but_search'])) {
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    //echo("text1");

    if (!empty($startdate) && !empty($enddate)) {
      $query = " SELECT date_time ,id ,inv_ed , inv_et ,inv_f ,inv_i ,inv_op ,inv_p ,inv_pf ,inv_st ,inv_tm ,inv_v ,inv_va ,site_location_x ,site_location_y ,site_postcode FROM `data` WHERE  date_time  BETWEEN '" . $startdate . "' and '" . $enddate . "' ";
      //  $query = " SELECT date_format(date_time,'%Y-%m-%d') , inv_p  FROM `data` WHERE  date_time  BETWEEN '".$startdate."' and '".$enddate."' ";
    }
  }


  ///////////// select last day

  if (isset($_POST['submitlastday'])) {
    $sdate = date("yy-m-d h:i:s ");
    $ldate = date("yy-m-d 00:00:00 ", strtotime("-1 days", strtotime($sdate)));
    $ldate1 = date("yy-m-d 23:59:00 ", strtotime("-1 days", strtotime($sdate)));



    $query = "SELECT * FROM `data` where date_time BETWEEN '" . $ldate . "' and '" . $ldate1 . "' ";

    //$query = "SELECT * FROM `data` where date_time BETWEEN '".$ldate."' and '".$ldate."' ";
    // echo $query;

  }

  //////////////////// select today
  if (isset($_POST['submittoday'])) {
    $sdate = date("yy-m-d  ");
    $ldate = date("yy-m-d  ", strtotime("-1 days", strtotime($sdate)));
    // $ldate1 = date("yy-m-d 23:59:00 ",strtotime("-1 days",strtotime($sdate)));



    $query = "SELECT * FROM `data` where date_time >= '" . $sdate . "'";

    //$query = "SELECT * FROM `data` where date_time BETWEEN '".$ldate."' and '".$ldate."' ";
    //echo $query;

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
    $ldate1 = date("yy-m-d 23:59:00 ", strtotime("-1 month", strtotime($sdate)));



    $query = "SELECT * FROM `data` where date_time BETWEEN '" . $ldate . "' and '" . $ldate1 . "' ";

    //$query = "SELECT * FROM `data` where date_time BETWEEN '".$ldate."' and '".$ldate."' ";
    // echo $query;

  }





  $resultmap = mysqli_query($con, $query1);

  $result = mysqli_query($con, $query);
  $resultchart = mysqli_query($con, $query);

  while ($r = mysqli_fetch_array($resultmap)) {
    //  $date_time[] = "\"".$r['date_time']."\""; 
    //  $id[] = "\"".$r['id']."\"";
    //  $inv_ed[] = "\"".$r['inv_ed']."\""; 
    //  $inv_et[] = "\"".$r['inv_et']."\""; 
    //  $inv_f[] = "\"".$r['inv_f']."\""; 
    //  $inv_i[] = "\"".$r['inv_i']."\""; 
    //  $inv_op[] = "\"".$r['inv_op']."\""; 
    //  $v = substr($rs['inv_p'], 0, -10); 
    //  echo($v);
    $inv_p1[] = "\"" . $r['inv_p'] . "\"";
    // returns "abcde"
    //  $inv_pf[] = "\"".$r['inv_pf']."\""; 
    //  $inv_st[] = "\"".$r['inv_st']."\""; 
    //  $inv_tm[] = "\"".$r['inv_tm']."\""; 
    //  $inv_v[] = "\"".$rs['inv_v']."\"";  
    //  $inv_va[] = "\"".$r['inv_va']."\""; 
    //  $site_location_x[] = "\"".$r['site_location_x']."\"";  
    //  $site_location_y[] = "\"".$r['site_location_y']."\""; 
    //  $site_postcode[] = "\"".$r['site_postcode']."\"";  
  }






  //for chart

  $inv_ed = array();
  $inv_et = array();
  $date_time = array();
  $inv_p = array();
  $site_postcode = array();

  while ($rs = mysqli_fetch_array($resultchart)) {
    $date_time[] = "\"" . $rs['date_time'] . "\"";
    $id[] = "\"" . $rs['id'] . "\"";
    $inv_ed[] = "\"" . $rs['inv_ed'] . "\"";
    $inv_et[] = "\"" . $rs['inv_et'] . "\"";
    $inv_f[] = "\"" . $rs['inv_f'] . "\"";
    $inv_i[] = "\"" . $rs['inv_i'] . "\"";
    $inv_op[] = "\"" . $rs['inv_op'] . "\"";
    //  $v = substr($rs['inv_p'], 0, -10); 
    //  echo($v);
    $inv_p[] = "\"" . $rs['inv_p'] . "\"";
    // returns "abcde"
    $inv_pf[] = "\"" . $rs['inv_pf'] . "\"";
    $inv_st[] = "\"" . $rs['inv_st'] . "\"";
    $inv_tm[] = "\"" . $rs['inv_tm'] . "\"";
    $inv_v[] = "\"" . $rs['inv_v'] . "\"";
    $inv_va[] = "\"" . $rs['inv_va'] . "\"";
    $site_location_x[] = "\"" . $rs['site_location_x'] . "\"";
    $site_location_y[] = "\"" . $rs['site_location_y'] . "\"";
    $site_postcode[] = "\"" . $rs['site_postcode'] . "\"";
  }

  $date_time = implode(",", $date_time);
  $inv_p = implode(",", $inv_p);
  $inv_ed = implode(",", $inv_ed);
  $inv_et = implode(",", $inv_et);
  $site_postcode = implode(",", $site_postcode);


  ?>

  <form method="post">
    <input type="submit" name="submitlastday" value="Last Day" class="btn btn-primary btn-sm" role="button" />
    <input type="submit" name="submittoday" value="To Day" class="btn btn-primary btn-sm" role="button" />
    <input type="submit" name="submitlast7day" value="Last 7 Day" class="btn btn-primary btn-sm" role="button" />
    <input type="submit" name="submittastmonth" value="Last Month" class="btn btn-primary btn-sm" role="button" />
  </form>
  </div>
  </div>

  <?php
  if (array_key_exists('last_Day_btn', $_POST)) {
    $sdate = date("yy-m-d ");
    $ldate = date("yy-m-d ", strtotime("-1 days", strtotime($sdate)));
    $query = "SELECT * FROM `data` where date_time >= '" . $ldate . "' ";
    echo $query;
  } else if (array_key_exists('button2', $_POST)) {
    button2();
  }
  function button1()
  {
    echo "This is Button1 that is selected";
    $sdate = date("yy-m-d ");
    $ldate = date("yy-m-d ", strtotime("-1 days", strtotime($sdate)));
    $query = "SELECT * FROM `data` where date_time >= '" . $ldate . "' ";
    echo $query;
  }
  function button2()
  {
    echo "This is Button2 that is selected";
  }
  ?>



  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
  <hr>

  <p align="center">

    </div>


    <div class="container">

      <canvas id="myChart" width="auto" height="auto"></canvas>
      <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: [<?php echo $date_time; ?>


            ],
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
                  beginAtZero: true
                }
              }]
            }
          }
        });
      </script>
    </div>


    </form>
    </div>


    </div>
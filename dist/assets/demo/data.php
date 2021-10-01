<?php
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'cp705245_pea17002766');

//get connection

$con = mysqli_connect("localhost", "root", "", "cp705245_pea17002766");


$sdate = date("yy-m-d  ");
$ldate = date("yy-m-d  ", strtotime("-1 days", strtotime($sdate)));
//query to get data from the table
$query = sprintf("SELECT * FROM `data` where date_time >= '" . $sdate . "'");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);

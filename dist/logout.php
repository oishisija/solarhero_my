<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["Status"]);
header("Location:login.php");
?>
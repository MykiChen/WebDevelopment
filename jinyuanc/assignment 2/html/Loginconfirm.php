<?php
include("session.php");
include("function.php");
include("db_conn.php");

$servername = "127.0.0.1";
$username = "jinyuanc";
$password = "518389";
$dbname = "jinyuanc";

$username = $_POST["account"];
$password = $_POST["password"]; 

$username = userValidate($username, $password);
$_SESSION['user'] = $username;

$mysqli->close();
?>
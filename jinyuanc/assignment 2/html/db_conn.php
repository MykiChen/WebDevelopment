<?php
//connect to mysql
$mysqli = new mysqli('localhost', 'jinyuanc', '518389', 'jinyuanc');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
?>
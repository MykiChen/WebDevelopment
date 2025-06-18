<?php
include("db_conn.php");
include("session.php");
global $mysqli;

$query = "INSERT INTO users (username, password) VALUES ('Myki', '123')";

if($mysqli->query($query) === TRUE) {
    //Get last in in the database
    $last_id = $mysqli->insert_id;
    $last_name = $mysqli->insert_username;
    $last_password = $mysqli->insert_password;
    
    echo "New record created successfully. Last inserted ID is: " . $last_id . "<br>";
    echo $last_name . "test";
    echo $last_password . "<br>";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
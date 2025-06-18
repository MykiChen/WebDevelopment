<?php
include("session.php");
include("db_conn.php");
global $mysqli;

$query = "INSERT INTO BankAccess (name, type) VALUE ('$session_user', 'logout')";
$result = $mysqli->query($query);

$query = "SELECT * FROM BankAccess WHERE type = 'logout' ORDER BY access_id DESC";
$result = $mysqli->query($query);
if($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $accesstime = $row['AccessTime'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Secure Bank</title>
</head>

<body style="text-align: center; background-image:url(../pic/logout.jpg);background-repeat:no-repeat;background-size:100%; color:white;">
    <h2>We will miss you. <?php echo $session_user;?> <br>Hope to see you next time.<br>
     ——— From: Secure Bank!</h2>
    <h3>The time you log out is: <br><?php echo $accesstime ; ?></h3>
    <h3>If you want to Log in again. <a href="Login.html" style="text-decoration:none; color: tomato; font-size:30px;"> Click here.</a></h3>
    
</body>
</html>
<?php 
session_destroy();
?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="jquery.validate.js"></script>
    <title>NetBank - Registration</title>
    <style>
        .error {
            color: #FF0000
        }

    </style>
    <link href="../css/registration.css" type="text/css" rel="stylesheet">

</head>

<body>
<form>
<div style="width:400px; height: 400px; text-align:center">
<?php
include("session.php");
$servername = "127.0.0.1";
$username = "jinyuanc";
$password = "518389";
$dbname = "jinyuanc";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 

$mysqli->query('SET autocommit = OFF');
$mysqli->query('START TRANSACTION');

$name = $_POST["account"];
$password = $_POST["password"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$type = $_POST["type"];
$_SESSION['type'] = $type;

//judge whether the name is exist before
$query = "SELECT * FROM BankAccounts WHERE account LIKE '$name'";
$result = $mysqli->query($query);

if($row = $result->fetch_array(MYSQLI_ASSOC) > 0) {
    echo "<br><br><br><br><br><br><br><br>Sorry, your name has been registered before.<br><br>";
    echo "<a href = 'registration.html'>Back to the Log up</a><br><br>";
    return false;
} else {
    //if no exist before, insert the name to the database
    $sql = "INSERT INTO BankAccounts (account, password, email, phone, access_type)
    VALUES ('$name', '$password', '$email', '$phone', '$type')";

    if ($mysqli->query($sql) === TRUE) {
        echo "<br><br><br><br>New record created successfully<br>";
        echo "You have successfully registered your account<br>";
        echo "Account: " . $_POST["account"] . "<br>"; 
        echo "Password: " . $_POST["password"] . "<br>";
        echo "Email: " . $_POST["email"] . "<br>";
        echo "Phone Number: " . $_POST["phone"] . "<br>";
        echo "Account type: " . $_POST["type"] . "<br><br>";
        echo "<a href = 'registration.html'>Back to the Log up</a><br><br>";
        echo "<a href = 'Login.html'>Back to the Log in</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error . "<br>";
    }
    
    //generate the  ACC auto increase 
    $query = "SELECT * FROM BankBSB ORDER BY ACC DESC";
    /*if(!$result = $mysqli->query($query)) {
    $mysqli->query('ROLLBACK');
    }
    break; */
    $result = $mysqli->query($query);
    if($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $bsb = $row['BSB'];
        $bsb = intval($bsb) + 1;

        $query = "INSERT INTO BankBSB (name, BSB)
        VALUES ('$name', '$bsb')";
        if(!$result = $mysqli->query($query)) {
            $mysqli->query('ROLLBACK');
            exit;
        } else {
            $mysqli->query('COMMIT');
        }
    }
}

$mysqli->close();
?>
</div>
    </form>
</body>

</html>

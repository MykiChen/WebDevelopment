<?php
/*
    function userValidate($username, $password);
    function balance($username);
    function today($username)；
    function week1($username)；
    function month1($username);
    function month3($username);
    function month6($username)；
    function currencytrans($amount, $currency);
    function transcation($to_bsb, $to_acc, $username, $amount, $amounttrans, $currency, $reason)；  
    function statement($period, $username);
    function account($bsb, $acc);
    function manage_delete($name, $bsb, $acc);
*/

function userValidate($username, $password) {
    global $mysqli;
    $username = $mysqli->real_escape_string($username);
    /*$md5_password = MD5($password);*/
    $query = "SELECT * FROM BankAccounts WHERE account LIKE '$username' AND password ='$password' ";
    
    //judge whether we found the result 
    $result = $mysqli->query($query);
    if($row = $result->fetch_array(MYSQLI_ASSOC) > 0) {
        $session_user = $username;
        $_SESSION['session_user'] = $session_user; 
        header('location:banklogin.php');
    } else {
        header('location:LoginFail.html');
    }
}

function balance($username) {
    global $mysqli;
    
    //get information form database
    $query = "SELECT * FROM BankBSB WHERE name LIKE '$username'";
    $result = $mysqli->query($query);
    $printKey = false;
    
    //if we searched the information from database, display them in a table
    if($row_cnt = $result->num_rows >= 1) {
        echo "<form method = 'post' style = 'margin-left:12%'>";
        echo "<table border = '1' style = 'padding: 3%;'>";
        while($arr = $result->fetch_array(MYSQLI_ASSOC)) {
            if(!$printKey) {
                print("<tr>\r\n");
                foreach($arr as $key=>$value) {
                    printf("<td>%s</td>\r\n", $key);
                }
                print("</tr>\r\n");
                $printKey = true;
            }
            print("<tr>\r\n");
            foreach($arr as $key=>$value) {
                printf("<td>%s</td>\r\n", $arr[$key]);
            }
            print("</tr>\r\n");
        }
        echo "</table>";
    }
}

function today($username) {
    global $mysqli;
    $query = "SELECT * FROM banktransfer WHERE name LIKE '$username' AND transtime > DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY transtime";
    $result = $mysqli->query($query);
    $printKey = false;
    
    if($row_cnt = $result->num_rows >= 1) {
        echo "<form method = 'post' style = 'margin-left: 11%; margin-bottom: 5%;'>";
        echo "<table border = '1' style = 'padding: 5%;'>";
        while($arr = $result->fetch_array(MYSQLI_ASSOC)) {
            if(!$printKey) {
                print("<tr>\r\n");
                foreach($arr as $key=>$value) {
                    printf("<td>%s</td>\r\n", $key);
                }
                print("</tr>\r\n");
                $printKey = true;
            }
            print("<tr>\r\n");
            foreach($arr as $key=>$value) {
                printf("<td>%s</td>\r\n", $arr[$key]);
            }
            print("</tr>\r\n");
        }
        echo "</table>";
    }
}

function week1($username) {
    global $mysqli;
    $query = "SELECT * FROM banktransfer WHERE name LIKE '$username' AND transtime > DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY transtime";
    $result = $mysqli->query($query);
    $printKey = false;
    
    if($row_cnt = $result->num_rows >= 1) {
        echo "<form method = 'post' style = 'margin-left: 11%; margin-bottom: 5%;'>";
        echo "<table border = '1' style = 'padding: 5%;'>";
        while($arr = $result->fetch_array(MYSQLI_ASSOC)) {
            if(!$printKey) {
                print("<tr>\r\n");
                foreach($arr as $key=>$value) {
                    printf("<td>%s</td>\r\n", $key);
                }
                print("</tr>\r\n");
                $printKey = true;
            }
            print("<tr>\r\n");
            foreach($arr as $key=>$value) {
                printf("<td>%s</td>\r\n", $arr[$key]);
            }
            print("</tr>\r\n");
        }
        echo "</table>";
    }
}

function month1($username) {
    global $mysqli;
    $query = "SELECT * FROM banktransfer WHERE name LIKE '$username' AND transtime > DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ORDER BY transtime";
    $result = $mysqli->query($query);
    $printKey = false;
    
    if($row_cnt = $result->num_rows >= 1) {
        echo "<form method = 'post' style = 'margin-left: 11%; margin-bottom: 5%;'>";
        echo "<table border = '1' style = 'padding: 5%;'>";
        while($arr = $result->fetch_array(MYSQLI_ASSOC)) {
            if(!$printKey) {
                print("<tr>\r\n");
                foreach($arr as $key=>$value) {
                    printf("<td>%s</td>\r\n", $key);
                }
                print("</tr>\r\n");
                $printKey = true;
            }
            print("<tr>\r\n");
            foreach($arr as $key=>$value) {
                printf("<td>%s</td>\r\n", $arr[$key]);
            }
            print("</tr>\r\n");
        }
        echo "</table>";
    }
}

function month3($username) {
    global $mysqli;
    $query = "SELECT * FROM banktransfer WHERE name LIKE '$username' AND transtime > DATE_SUB(CURDATE(), INTERVAL 3 MONTH) ORDER BY transtime";
    $result = $mysqli->query($query);
    $printKey = false;
    
    if($row_cnt = $result->num_rows >= 1) {
        echo "<form method = 'post' style = 'margin-left:11%; margin-bottom: 5%;'>";
        echo "<table border = '1' style = 'padding: 5%;'>";
        while($arr = $result->fetch_array(MYSQLI_ASSOC)) {
            if(!$printKey) {
                print("<tr>\r\n");
                foreach($arr as $key=>$value) {
                    printf("<td>%s</td>\r\n", $key);
                }
                print("</tr>\r\n");
                $printKey = true;
            }
            print("<tr>\r\n");
            foreach($arr as $key=>$value) {
                printf("<td>%s</td>\r\n", $arr[$key]);
            }
            print("</tr>\r\n");
        }
        echo "</table>";
    }
}

function month6($username) {
    global $mysqli;
    $query = "SELECT * FROM banktransfer WHERE name LIKE '$username' AND transtime > DATE_SUB(CURDATE(), INTERVAL 6 MONTH) ORDER BY transtime";
    $result = $mysqli->query($query);
    $printKey = false;
    
    if($row_cnt = $result->num_rows >= 1) {
        echo "<form method = 'post' style = 'margin-left:11%; margin-bottom: 5%;'>";
        echo "<table border = '1' style = 'padding: 5%;'>";
        while($arr = $result->fetch_array(MYSQLI_ASSOC)) {
            if(!$printKey) {
                print("<tr>\r\n");
                foreach($arr as $key=>$value) {
                    printf("<td>%s</td>\r\n", $key);
                }
                print("</tr>\r\n");
                $printKey = true;
            }
            print("<tr>\r\n");
            foreach($arr as $key=>$value) {
                printf("<td>%s</td>\r\n", $arr[$key]);
            }
            print("</tr>\r\n");
        }
        echo "</table>";
    }
}

function statement($period, $username) {
    global $mysqli;
    switch ($period) {
        case "balance":
            balance($username);
            break;
        case "today":
            today($username);
            break;
        case "1week":
            week1($username);
            break;
        case "1month":
            month1($username);
            break;
        case "3month":
            month3($username);
            break;
        case "6month":
            month6($username);
            break;
    }
}

function currencytrans($amount, $currency) {
    switch($currency) {
        case "AUD":
            $amount = $amount;
            break;
        case "CAD":
            $amount = $amount * 0.94;
            break;
        case "CNY":
            $amount = $amount * 5;
            break;
        case "EUR":
            $amount = $amount * 0.62;
            break;
        case "GBP":
            $amount = $amount * 0.53;
            break;
        case "JPY":
            $amount = $amount * 80;
            break;
        case "NZD":
            $amount = $amount * 1.05;
            break;
        case "USD":
            $amount = $amount * 0.7;
            break;
    }
    return $amount;   
}

function transcation($to_bsb, $to_acc, $username, $amount, $amounttrans, $currency, $reason) {
    global $mysqli;
    $mysqli->query('SET autocommit = OFF');
    $mysqli->query('START TRANSACTION');

    //search for the name who the user want to transfer
    $query = "SELECT * FROM BankBSB WHERE BSB = '$to_bsb' AND ACC = '$to_acc'";
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $row_cnt = $result->num_rows;
    //if we can not find the result
    if( $row_cnt == 0) {
        header('Location: transfail2.php');
    } else {
        //if we have found the result, save the name and saving amount
        $toname = $row['name'];
        $tosaving = $row['saving_amount'];
        $to_cad = $row['CAD'];
        $to_cny = $row['CNY'];
        $to_eur = $row['EUR'];
        $to_gbp = $row['GBP'];
        $to_jpy = $row['JPY'];
        $to_nzd = $row['NZD'];
        $to_usd = $row['USD'];
        $to_other = $row['other'];
        
        //get myself account, BSB, ACC and saving amount 
        $query = "SELECT * FROM BankBSB WHERE name LIKE '$username' ";
        $result = $mysqli->query($query);
        
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $yourbsb = $row['BSB'];
            $youracc = $row['ACC'];
            $saving_amount = $row['saving_amount'];
            $saving_amount = $saving_amount - $amount;
        
            //judge whether the account's saving is enough 
            if($saving_amount < 0) {
                header('Location: transfail.php');
            } else {
                //if enough, update yourself saving
                $query = "UPDATE BankBSB SET saving_amount = '$saving_amount' WHERE name = '$username'";
                /*$result = $mysqli->query($query);*/    
            
                if(!$result = $mysqli->query($query)) {
                    $mysqli->query('ROLLBACK');
                    header('Location: transfail.php');
                }
                
                //match the currency and update the people's saving who we want to transfer
                switch($currency) {
                    case "AUD" :                
                        $tosaving = $tosaving + $amount;
                        $query = "UPDATE BankBSB SET saving_amount = '$tosaving' WHERE name LIKE '$toname'";
                        /*$result = $mysqli->query($query);*/
                        if(!$result = $mysqli->query($query)) {
                            $mysqli->query('ROLLBACK');
                        }
                        break;
                    case "CAD":
                        $to_cad = $to_cad + $amounttrans;
                        $query = "UPDATE BankBSB SET CAD = '$to_cad' WHERE name LIKE '$toname'";
                        if(!$result = $mysqli->query($query)) {
                            $mysqli->query('ROLLBACK');
                        }
                        break;
                    case "CNY":
                        $to_cny = $to_cny + $amounttrans;
                        $query = "UPDATE BankBSB SET CNY = '$to_cny' WHERE name LIKE '$toname'";
                        if(!$result = $mysqli->query($query)) {
                            $mysqli->query('ROLLBACK');
                        }
                        break;
                    case "EUR":
                        $to_eur = $to_eur + $amounttrans;
                        $query = "UPDATE BankBSB SET EUR = '$to_eur' WHERE name LIKE '$toname'";
                        if(!$result = $mysqli->query($query)) {
                            $mysqli->query('ROLLBACK');
                        }
                        break;
                    case "GBP":
                        $to_gbp = $to_gbp + $amounttrans;
                        $query = "UPDATE BankBSB SET GBP = '$to_gbp' WHERE name LIKE '$toname'";
                        if(!$result = $mysqli->query($query)) {
                            $mysqli->query('ROLLBACK');
                        }
                        break;
                    case "JPY":
                        $to_jpy = $to_jpy + $amounttrans;
                        $query = "UPDATE BankBSB SET JPY = '$to_jpy' WHERE name LIKE '$toname'";
                        if(!$result = $mysqli->query($query)) {
                            $mysqli->query('ROLLBACK');
                        }
                        break;
                    case "NZD":
                        $to_nzd = $to_nzd + $amounttrans;
                        $query = "UPDATE BankBSB SET NZD = '$to_nzd' WHERE name LIKE '$toname'";
                        if(!$result = $mysqli->query($query)) {
                            $mysqli->query('ROLLBACK');
                        }
                        break;
                    case "USD":
                        $to_usd = $to_usd + $amounttrans;
                        $query = "UPDATE BankBSB SET USD = '$to_usd' WHERE name LIKE '$toname'";
                        if(!$result = $mysqli->query($query)) {
                            $mysqli->query('ROLLBACK');
                        }
                        break;   
                }
                
                //insert into the transaction in the datebase of banktransfer
                $query = "INSERT INTO banktransfer (name, amount, currency, reason, to_bsb, to_acc) VALUES ('$username', '$amounttrans', '$currency', '$reason', '$to_bsb', '$to_acc')";
                /*$result = $mysqli->query($query);*/
                      
                if(!$result = $mysqli->query($query)) {
                    $mysqli->query('ROLLBACK');
                    exit;
                } else {
                    $mysqli->query('COMMIT');
                }
                
                echo $error;
                echo "Transfer successful<br>";
                echo "Amount: " . $amount . " (AUD)<br>";
                echo "Currency: in " . $currency . "<br>";
                echo "Amount: " . $amounttrans . " (". $currency . ")" . "<br><br>";
                echo "From: " . $session_user . "<br>";
                echo "Your BSB is: " . $yourbsb . "<br>"; 
                echo "Your ACC is : " . $youracc . "<br><br>";
                echo "To: " . $toname . "<br>";
                echo "BSB: " . $to_bsb . "<br>";
                echo "ACC: " . $to_acc . "<br>";
                echo "Description: " . $reason . "<br><br>";
                echo "<a href='banklogin.php'>Back to secure bank</a>";
            }
        }
    }
}

function account($name, $bsb, $acc) {
    global $mysqli;
    
    //select all the information we want to use from database
    $query = "SELECT BankBSB.name, BankBSB.BSB, BankBSB.ACC, BankBSB.saving_amount, BankAccounts.access_type FROM BankBSB INNER JOIN BankAccounts ON BankAccounts.account = BankBSB.name WHERE BankBSB.BSB = '$bsb' || BankBSB.ACC = '$acc' || BankBSB.name = '$name'";
    $result = $mysqli->query($query);
    $printKey = false;
    
    //if we found the information, display them in a table
    if($row_cnt = $result->num_rows >= 1) {
        echo "<form method = 'post' style = 'margin-left: 27%; margin-top: 5%; margin-bottom: 5%;'>";
        echo "<table border = '1' style = 'padding: 2%;'>";
        while($arr = $result->fetch_array(MYSQLI_ASSOC)) {
            if(!$printKey) {
                print("<tr>\r\n");
                foreach($arr as $key=>$value) {
                    printf("<td>%s</td>\r\n", $key);
                }
                print("</tr>\r\n");
                $printKey = true;
            }
            print("<tr>\r\n");
            foreach($arr as $key=>$value) {
                printf("<td>%s</td>\r\n", $arr[$key]);
            }
            print("</tr>\r\n");
        }
        echo "</table>";
        echo "</form>";
    } else {
        echo "<br><br>Sorry, no record about this Name or BSB or ACC.<br>";
        echo "<br>Please check once again.";
    }
}

function manage_delete($name, $bsb, $acc) {
    global $mysqli;
    $mysqli->query('SET autocommit = OFF');
    $mysqli->query('START TRANSACTION');
    
    //match the name or BSB or ACC from database
    $query = "SELECT * FROM BankBSB WHERE BSB = '$bsb' || ACC = '$acc' || name = '$name' || ACC = '$acc'";
    if(!$result = $mysqli->query($query)) {
        $mysqli->query('ROLLBACK');
    }
    
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if($row_cnt = $result->num_rows >= 1) {
        $name = $row['name'];
        
        //delete account form BankAccounts
        $query = "DELETE FROM BankAccounts WHERE account = '$name'";
        if(!$result = $mysqli->query($query)) {
            $mysqli->query('ROLLBACK');
        }
        
        //delete account from BankBSB
        $query = "DELETE FROM BankBSB WHERE BSB = '$bsb' || ACC = '$acc' || name = '$name'";
    
        if(!$result = $mysqli->query($query)) {
            $mysqli->query('ROLLBACK');
            exit;
        } else {
            $mysqli->query('COMMIT');
        }
        if ($mysqli->query($query) === TRUE) {        
            echo "<br><br>You have successfully deleted this account!<br>";
        } 
    } else {
        echo "<br><br>Sorry, your can't delete this account.<br><br>";
        echo "No record about this Name or BSB or ACC.<br>";
        echo "<br>Please input once again.";
    } 
}

/*function manage_add($name, $password, $saving, $email, $phone, $type){
if(isset($_POST['submit'])) {

$mysqli->query('SET autocommit = OFF');
$mysqli->query('START TRANSACTION');

$name = $_POST["name"];
$password = $_POST["password"];
$saving = $_POST["saving"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$type = $_POST["type"];

//judge if the name is exist before
$query = "SELECT * FROM BankAccounts WHERE account LIKE '$name'";
$result = $mysqli->query($query);

if($row = $result->fetch_array(MYSQLI_ASSOC) > 0) {
    echo "<br>Sorry, the name has been registered before.";
} else {
    //if no exist before, insert the name to the database
    $sql = "INSERT INTO BankAccounts (account, password, email, phone, access_type)
    VALUES ('$name', '$password', '$email', '$phone', '$type')";

    if ($mysqli->query($sql) === TRUE) {        
        echo "<br>You have successfully add this account<br>";
        echo "Name: " . $_POST["name"] . "<br>"; 
        echo "Password: " . $_POST["password"] . "<br>";
        echo "Email: " . $_POST["email"] . "<br>";
        echo "Phone Number: " . $_POST["phone"] . "<br>";
        echo "Acount type: " . $_POST["type"] . "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error . "<br>";
    }
    $query = "SELECT * FROM BankBSB WHERE name = '$name' ";
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $bsb = $row['BSB'];
    $acc = $row['ACC'];
    echo "This your new BSB: " . $bsb . "<br>";
    echo "This your new ACC: " . $acc . "<br>";
    
    //generate the  ACC auto increase 
    $query = "SELECT * FROM BankBSB ORDER BY ACC DESC";
    if(!$result = $mysqli->query($query)) {
    $mysqli->query('ROLLBACK');
    }
    break; 
    $result = $mysqli->query($query);
    if($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $bsb = $row['BSB'];
        $bsb = intval($bsb) + 1;

        $query = "INSERT INTO BankBSB (name, BSB, saving_amount)
        VALUES ('$name', '$bsb', '$saving')";
        if(!$result = $mysqli->query($query)) {
            $mysqli->query('ROLLBACK');
            exit;
        } else {
            $mysqli->query('COMMIT');
        }
    }
}
}

$mysqli->close();

}
*/

/*function setting() {
    global $mysqli;
    $oldpassword = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $confirm = $_POST['confirmpassword'];
    $error ="";
    
    if($newpassword == "") {
        $error = "Sorry, your have to input your new password.";
    }
    
    if($confirmpassword != $newpassword) {
        $error = "Sorry, your newpassword and the confirm password is not match.";
    }
    
    if ($error != "") {
    
    if(isset($_POST['submit'])) {
        //search for the name who the user want to transfer
        $query = "SELECT * FROM BankAccounts WHERE account = '$session_user'";

        $result = $mysqli->query($query);
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            //if we have found the result, save the name and saving amount
            $email = $row['email'];
            $phone = $row['phone'];
            $password = $row['password'];
            
        }
    }
}
}*/
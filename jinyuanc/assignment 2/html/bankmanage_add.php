<?php
include("session.php");
include("db_conn.php");
include("function.php");
?>

<!DOCTYPE html>
<html>

<head>
    <link href="../css/bank.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div id="nav">
        <ul>
            <li><a href="1logout.php">Log out</a></li>
            <li><a href="banktransation.php">Transations</a></li>
            <li><a href="banktstatement.php">eStatements</a></li>
            <li><a href="banktransfer.php">Transfer & Pay</a></li>
            <li><a href="bankmanage.php">Manage</a></li>
            <li><a href="">Message</a></li>
            <li><a href="">About us</a></li>
            <li><a href="">Career</a></li>
        </ul>
    </div>
    <div id="all">
        <div class="content" id="class1">
            <div id="left1" class="left">
                <div id="left1top">
                    <p id="left1text">* Personal Information</p>
                </div>
                <div id="left1bottom">
                    <div id="left1bottom1" class="left1pic">
                        <a href="bankpersoninfo.php" style="text-decoration:none;"><img src="../pic/personal.jpg" class="left1pic1">
                            <p class="left1text">Personal</p></a>
                    </div>
                    <div id="left1bottom2" class="left1pic">
                        <a href="bankpersoninfo.php" style="text-decoration:none;"><img src="../pic/loan.jpg" class="left1pic1">
                            <p class="left1text">Loan</p></a>
                    </div>
                    <div id="left1bottom3" class="left1pic">
                        <a href="bankpersoninfo.php" style="text-decoration:none;"><img src="../pic/home.jpg" class="left1pic1">
                            <p class="left1text">Business</p></a>
                    </div>
                    <div id="left1bottom4" class="left1pic">
                        <a href="banksetting.php" style="text-decoration:none;"><img src="../pic/setting.jpg" class="left1pic1">
                            <p class="left1text">Setting</p></a>
                    </div>
                </div>
            </div>
            <div id="left2" class="left">
                <div id="left2top">
                    <p><a href="~" class="news" id="news">News</a> <a href="!" class="news">Notification</a> more...</p>
                </div>
                <div id="left2bottom">
                    <ul>
                        <li><span class="date">[04.08]</span> New bank is opened...</li>
                        <li><span class="date">[04.07]</span> Mobile App is launched...</li>
                        <li><span class="date">[04.06]</span> New service for customers...</li>
                        <li><span class="date">[04.04]</span> Cooperation with China...</li>
                    </ul>
                </div>
            </div>
            <div id="left3" class="left">
                <div id="sbank">| SBANK |</div>
                <div id="left3middle">
                    <p><span id="rate">
                            <div id="array"></div>0.52%
                        </span><span id="stock">3422.08</span></p>
                </div>
                <div id="left3bottom">+ 2.3% - 3.8%</div>
            </div>
        </div>
        <div class="content" id="class2">
            <div id="middle" class="middle" style="text-align:center;">
                <h2 style="margin-top:5%">Welcome, <?php echo $session_user; ?></h2>
                <form method="post" action="">
                    <p>If you want to manage account, <a href="bankmanage.php">click here</a></p>
                    <p>Please input the details to add more account</p>
                    <p>Name <input type="text" name="name" required></p>
                    <p>Password <input type="text" name="password" required></p>
                    <p>Saving <input type="text" name="saving" placeholder="Saving amount"></p>
                    <p>E-mail <input type="email" name="email"></p>
                    <p>Phone <input type="text" name="phone" required></p>
                    <p>Type: <select name="type">
                        <option value="saving" name="saving">Saving</option>
                        <option value="business" name="business">Business</option>
                    </select></p>
                    <button type="submit" name="submit" value="submit">Add Account</button>
                </form>
                
<?php
if(isset($_POST['submit'])) {
    $query = "SELECT * FROM BankAccounts WHERE account = '$session_user'";
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $row_cnt = $result->num_rows;
    $type = $row['access_type'];
    
    //judge whether the account is a manager
    if($type == "manager") {
        $mysqli->query('SET autocommit = OFF');
        $mysqli->query('START TRANSACTION');
        
        //if yes, get all the post parameters from the form
        $name = $_POST["name"];
        $password = $_POST["password"];
        $saving = $_POST["saving"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $type = $_POST["type"];

        //judge if the name is exist before
        $query = "SELECT * FROM BankAccounts WHERE account LIKE '$name'";
        $result = $mysqli->query($query);
        
        //if existed, echo error
        if($row = $result->fetch_array(MYSQLI_ASSOC) > 0) {
            echo "<br>Sorry, the name has been registered before.";
            
            //if no existed, judge the format of password
        } else if (!preg_match("#[a-z]+#", $password)) {
            echo "<br>Sorry, your password mush be include at least one lower letter.";
        } else if (!preg_match("#[A-Z]+#", $password)) {
            echo "<br>Sorry, your password mush be include at least one upper letter.";
        } else if (!preg_match("#[0-9]+#", $password)) {
            echo "<br>Sorry, your password mush be include at least one number.";
        } else {
        //if the format of password is correct, insert the infromation to the database
        $sql = "INSERT INTO BankAccounts (account, password, email, phone, access_type)
        VALUES ('$name', '$password', '$email', '$phone', '$type')";

        if ($mysqli->query($sql) === TRUE) {        
            echo "<br>You have successfully add this account<br>";
            echo "Name: " . $_POST["name"] . "<br>"; 
            echo "Password: " . $_POST["password"] . "<br>";
            echo "Email: " . $_POST["email"] . "<br>";
            echo "Phone Number: " . $_POST["phone"] . "<br>";
            echo "Account type: " . $_POST["type"] . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error . "<br>";
        }
        
        //generate the  ACC auto increasely 
        $query = "SELECT * FROM BankBSB ORDER BY ACC DESC";
        /*if(!$result = $mysqli->query($query)) {
        $mysqli->query('ROLLBACK');
        }
        break; */
        $result = $mysqli->query($query);
        if($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $bsb = $row['BSB'];
            $bsb = intval($bsb) + 1;
            
            //insert your BSB and saving amount into the database
            $query = "INSERT INTO BankBSB (name, BSB, saving_amount)
            VALUES ('$name', '$bsb', '$saving')";
            if(!$result = $mysqli->query($query)) {
                $mysqli->query('ROLLBACK');
                exit;
            } else {
                $mysqli->query('COMMIT');
            }
        }
            
        //get the bsb and acc numbers from the database
        $query = "SELECT * FROM BankBSB WHERE name = '$name' ";
        $result = $mysqli->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $bsb = $row['BSB'];
        $acc = $row['ACC'];
        echo "<br>This your new BSB: " . $bsb . "<br>";
        echo "This your new ACC: " . $acc . "<br>";
    
    }
}  else {
    //if the account isn't a manager account
    echo "<br><br>Sorry, only manager can manipulate this function.";
}
}
    
$mysqli->close();
?>
            </div>
        </div>
        <div class="content" id="class3">
            <div id="right1" class="right">
                <div id="right1top">
                    <input type="text"> <button type="button" name="search" id="search">Search</button>
                    <p>New Services now <a href="" id="loan">Loan</a> <a href="Card" id="card">Card</a></p>
                </div>
                <div id="right1bottom">
                    <ul class="right1left">
                        <li><a href="" id="loan">Loan</a></li>
                        <li><a href="" id="insurance">Insurance</a></li>
                        <li><a href="" id="bankcard">Bank Card</a></li>
                        <li><a href="" id="super">Super</a></li>
                    </ul>
                    <ul class="right1left">
                        <li><a href="" id="mobileapp">Mobile App</a></li>
                        <li><a href="" id="business">Business</a></li>
                        <li><a href="" id="investing">Investing</a></li>
                        <li><a href="" id="comingsoon">More...</a></li>
                    </ul>
                </div>
            </div>
            <div id="right2" class="right">
                <div id="right2top">
                    <div id="right2toptext" class="right2top">
                        <p id="right2ana">Analytical Finance</p>
                        <p id="right2more"><a href="~">More analytical data click here</a></p>
                    </div>
                    <div class="right2top">
                        <img src="../pic/data2.jpg" ; id="right2toppic" ;>
                    </div>
                </div>
                <div id="right2bottom">
                    <div id="right2bottomtext" class="right2bottom">
                        <p id="good">Good News</p>
                        <p id="higher">Higher <span id="saving">Saving </span><br>rate now!</p>
                    </div>
                    <div class="right2bottom">
                        <img src="../pic/rate.jpg" id="right2bottompic" ;>
                    </div>
                </div>
            </div>
            <div id="right3" class="right">
                <div id="right3top">
                    <p>Line <span id="line"> 0481750422</span></p>
                </div>
                <div id="right3left" class="right3bottom">
                    <img id="right3pic" src="../pic/line.jpg">
                </div>
                <div id="right3right" class="right3bottom">
                    <div id="right3right1">Mon - Fri</div>
                    <div id="right3right2">09:00 - 22:00</div>
                </div>
                <div id="right3low">
                    <p><img src="../pic/email.jpg" id="right3lowpic"><span id="email">chenmyki@gmail.com</span></p>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <br><br>
        <p class="footertext"><img src="../pic/email.jpg" id="footerimg"> securitybank@gmail.com.au</p>
        <p class="footertext">Copyright (c) Jinyuan Chen </p>
        <p class="footertext">Student Number: 518389</p>
        <p class="footertext">University of Tasmania</p>
        <p class="footertext"><input type="text"><a href="" style="margin-left: 5%"> Searching</a> </p>
    </div>
</body>
</html>
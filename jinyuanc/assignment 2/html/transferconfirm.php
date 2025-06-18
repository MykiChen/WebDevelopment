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
                <h2 style="margin-top:15%">Welcome, <?php echo $session_user; ?></h2>
                <?php

                $username = $session_user;
                $amount = $_POST['amount'];
                $currency = $_POST['currency'];
                $reason = $_POST['purpose'];
                $to_bsb = $_POST['tobsb'];
                $to_acc = $_POST['toacc'];

                $error = "";

                if(isset($_POST['submit'])) {
                    global $mysqli;                    
                    //get the type of account 
                    $query = "SELECT * FROM BankAccounts WHERE account = '$username'";
                    $result = $mysqli->query($query);
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $row_cnt = $result->num_rows;
                    $type = $row['access_type'];
                    
                    //if the type of account is a saving, print error
                    if($type == "saving" && $currency != "AUD") {
                        echo "Sorry, saving account is only able to <br><br>send or receive in local currency(AUD)."; 
                        echo "<br><br>If you need to send in different currencies,";
                        echo "<br><br>please switch to a business account,";
                        echo "<br><br>or contact our manager.";
                        echo "<br><br><a href=''>0481750422</a>";
                        echo "<br><br><a href='banktransfer.php'>Come back to transfer</a>";
                    } else {
                        //get the total amount from database during today
                        $query = "SELECT SUM(amount) FROM banktransfer WHERE name LIKE '$username' AND transtime > DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
                        $result = $mysqli->query($query);
                        $row = $result->fetch_array(MYSQLI_ASSOC);
                        $sumamount = $row['SUM(amount)'] + $amount;
                        
                        //if the type of account is not a saving, limit the total amount is under 500000
                        if ($type != "saving" && $sumamount > 50000) {
                            echo "<br><br>Sorry, your account is business account,";
                            echo "<br><br>You can transfer amount up to $50000/day.";
                            echo "<br><br>The amount you transfered today has beyond $50000.";
                            echo "<br><br>If you still want to transfer the money,";
                            echo "<br><br>Please contact our manager.";
                            echo "<br><br><a href=''>0481750422</a>";
                            echo "<br><br><a href='banktransfer.php'>Come back to transfer</a>"; 
                            
                            //if the type of account is a saving, limit the total amount is under 100000
                        } else if ($type == "saving" && $sumamount > 10000) {
                            echo "<br><br>Sorry, your account is saving account,";
                            echo "<br><br>You can transfer amount up to $10000/day.";
                            echo "<br><br>The amount you transfered today has beyond $10000.";
                            echo "<br><br>If you still want to transfer the money,";
                            echo "<br><br>Please contact our manager.";
                            echo "<br><br><a href=''>0481750422</a>";
                            echo "<br><br><a href='banktransfer.php'>Come back to transfer</a>";
                        } else {
                    
                            //get the account's name you want to transfer from database
                            $query = "SELECT * FROM BankBSB WHERE BSB = '$to_bsb' AND ACC = '$to_acc'";
                            $result = $mysqli->query($query);
                            $row = $result->fetch_array(MYSQLI_ASSOC);
                            $row_cnt = $result->num_rows;
                            $to_name = $row['name'];
                    
                            //get the type of the account you want to transfer from database
                            $query = "SELECT * FROM BankAccounts WHERE account = '$to_name'";
                            $result = $mysqli->query($query);
                            $row = $result->fetch_array(MYSQLI_ASSOC);
                            $row_cnt = $result->num_rows;
                            $type = $row['access_type'];
                    
                            //judge whether the type of the account you want to transfer is a saving or business
                            //if the type is a saving and the currency is not AUD, print error
                            if ($type == "saving" && $currency != "AUD") {
                                echo "Sorry, the transaction is failed.";
                                echo "<br><br>The account you want to transfer is a saving account,";
                                echo "<br><br>only can receive in local currency(AUD).";
                                echo "<br><br>Please choose another business account to transfer.";
                                echo "<br><br>or choose the AUD as the currency.";
                                echo "<br><br>If you have any questions,";
                                echo "<br><br>please contact our manager.";
                                echo "<br><br><a href=''>0481750422</a>";
                                echo "<br><br><a href='banktransfer.php'>Come back to transfer</a>";
                            } else {
                                //if there are no any problem, implement the transaction function
                                currencytrans($amount, $currency);
                                $amounttrans = currencytrans($amount, $currency);
                            
                                transcation($to_bsb, $to_acc, $username, $amount, $amounttrans, $currency, $reason);
                            }
                        }
                    }
                }
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

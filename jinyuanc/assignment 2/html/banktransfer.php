<?php
include("session.php");
include("db_conn.php");
global $mysqli;

//get the information of BSB, ACC from database
$username = $session_user;
$query = "SELECT * FROM BankBSB WHERE name = '$username'";
$result = $mysqli->query($query);
if($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $bsb = $row['BSB'];
    $acc = $row['ACC'];
}
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
                <h2 style="margin-top:10%">Welcome, <?php echo $session_user; ?></h2>
                <form method="POST" name="transfer" action="transferconfirm.php">
                    <h2>Transfer & Pay</h2>
                    <p>Your BSB: <?php echo $bsb;?> </p>
                    <p>Your Account Number: <?php  echo $acc;?> </p>
                    <p>To someone new:</p>
                    <p>BSB: <input type="text" name="tobsb"></p>
                    <p>ACC: <input type="text" name="toacc"></p>
                    <p>amount: <input type="text" name="amount" placeholder="AUD"></p>
                    <p>Currency (transfer to) <select name="currency">
                        <option value="AUD" name="AUD">AUD</option>
                        <option value="CAD" name="CAD">CAD</option>
                        <option value="CNY" name="CNY">CNY</option>
                        <option value="EUR" name="EUR">EUR</option>
                        <option value="GBP" name="GBP">GBP</option>
                        <option value="JPY" name="JPY">JPY</option>
                        <option value="NZD" name="NZD">NZD</option>
                        <option value="USD" name="USD">USD</option>
                        <option value="OTHER" name="OTHER">Other</option>
                    </select> </p>
                    <p>Reason <select name="purpose">
                        <option value="loanpay" name="loan">loan payment</option>
                        <option value="familysup" name="familysup">family Support</option>
                        <option value="tuition" name="tuition">school tuition</option>
                        <option value="salary" name="salary">salary</option>
                        <option value="bill" name="bill">bill</option>
                        <option value="petrol" name="petrol">petrol</option>
                        <option value="shop" name="shop">shop</option>
                        <option value="saving" name="saving">saving</option>
                        <option value="other" name="other">Other</option>
                    </select> </p>
                    <button type="submit" name="submit">Confirm</button>
                </form>
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
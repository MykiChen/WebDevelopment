<?php

session_start();

if(!isset($_SESSION['session_user'])) {
    $_SESSION['session_user'] = "";
}

$session_user = $_SESSION['session_user'];

?>
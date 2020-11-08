<?php
require_once 'dbh.inc.php';
require_once 'res.inc.php';
if (isset($_POST["submit"])) {
    $username = $_POST["email"];
    $pwd = $_POST["pwd"];


    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyInput");
        exit();
    }

    loginUser($conn, $username, $pwd);
}

else {
    header("location: ../login.php?error=illigalAccessPath");
    die();
}
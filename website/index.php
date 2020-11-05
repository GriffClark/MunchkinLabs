<?php
include_once 'header.php';

if (isset($_SESSION["userId"])) {
    // We are logged in
    
}
else {
    header("location: login.php");
    exit();
}


include_once 'footer.php';


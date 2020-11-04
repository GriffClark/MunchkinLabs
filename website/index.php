<?php
include_once 'header.php';

if ((isset($_SESSION["userId"]))) {
    
}
else {
    header("location: signup.php");
    exit();
}


include_once 'footer.php';


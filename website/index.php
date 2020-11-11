<?php
include_once 'header.php';

if (isset($_SESSION["userId"])) {
    // We are logged in
    echo 'Logged in';
}
else {
    
}


include_once 'footer.php';


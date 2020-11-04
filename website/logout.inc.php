<?php

session_start(); //need to start a session to delete session variables
session_unset();
session_destroy();

header("location: index.php");
exit();
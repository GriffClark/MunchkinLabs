<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "loginDB";

$conn = mysqli_connect($serverName, $dBName, $dBUsername, $dBPassword);

if (!$conn) {
    die("Failed to connect to db: " .mysqli_connect_error());
}
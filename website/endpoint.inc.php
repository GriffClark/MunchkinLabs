<?php
require_once 'res.inc.php';
require_once 'dbh.inc.php';

if (isset($_POST["submit"])) {

    $errorRedirectPath = "endpoint.php";

    $title = $_POST["title"];
    $finance = $_POST["finance"];
    $active = $_POST["active"];
    $adventurous = $_POST["adventurous"];
    $length = $_POST["length"];
    $birdwatcher = $_POST["birdwatcher"];
    $groupsize = $_POST["groupsize"];
    $extravagant = $_POST["extravagant"];
    $culture = $_POST["culture"];


    $scores = array (
        "FINANCE" => floatval($finance),
        "ACTIVE" => floatval($active),
        "ADVENTUROUS" => floatval($adventurous),
        "LENGTH" => floatval($length),
        "BIRDWATCHER" => floatval($birdwatcher),
        "GROUPSIZE" => floatval($groupsize),
        "EXTRAVAGANT" => floatval($extravagant),
        "CULTURE" => floatval($culture)
    );

    createEndpoint($conn, $title, $scores);


}
else {
    // When I screwed with this filepath it changed, but none of the other ones did. No clue why though
    header("location: $errorRedirectPath?error=illigalPath");
    exit();
}
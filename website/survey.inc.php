<?php

session_start();

// TODO stop form submission if questions haven't been answered
// TODO save survey data

/*
Insert each answer into the answers table:

- pull user's id
- pull question id
- add a new row to 'answers' table 

*/
// if (isset($_POST["submit"])) {
    $userId = $_SESSION["userId"];

    foreach($_POST as $response){
        echo $response;
        echo "<br>";
    }

    // header("location: index.php?action=surveySubmissionRedirect");
    // exit();
// }
// else {
//     header("location: survey.php?error=illigalAccessPath");
//     die();
// }
<?php
include_once 'dbh.inc.php';
session_start();
if (isset($_POST["submit"])) {
    $sql = "SELECT * FROM questions WHERE intakeQuestion = 1;";
    $stmt = mysqli_stmt_init($conn);  

    if(!$conn){
        header("location: ../../index.php?error=noConn");
            exit();
    }

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_array($resultData)) {

        $userId = $_SESSION['userId'];
        $id = $row['id'];
        $answer = ($_POST["question$id"]);
        
        // DEBUG
        echo "for user $userId @ question$id, answer $answer ";

        $sql = "INSERT INTO answers (userId, questionId, answer) VALUES (?,?,?);";
        // $sql = "INSERT INTO users (usersFullName, usersEmail, usersPwd) VALUES (?,?,?);";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: index.php?error=stmtFailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sss",$userId, $id, $answer);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }

    header("location: index.php?error=none");
    exit();
}
else {
    echo "no post";
}
// TODO stop form submission if questions haven't been answered
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
        $rowId = $row['id'];
        $answer = ($_POST["question$rowId"]);
        
        // DEBUG
        // echo "for user $userId @ question$rowId, answer $answer ";

        $sql = "INSERT INTO answers (userId, questionId, answer) VALUES (?,?,?);";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: index.php?error=stmtFailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sss",$userId, $rowId, $answer);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }

    // Make sure we add our user to the dirtyUser table
    $sql = "INSERT INTO dirtyusers (userId) VALUES (?);"; //TODO: clean
    $stmt = mysqli_stmt_init($conn); 
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: index.php?error=dirtyTableFail");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s",$userId); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: index.php?error=none");
    exit();
}
else {
    echo "no post";
}
// TODO stop form submission if questions haven't been answered
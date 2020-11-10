<?php
include_once 'dbh.inc.php';
include_once 'res.inc.php';
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
        insertBinaryAnswer($conn, $row);
    }
    addDirtyUser($conn);

    header("location: index.php?error=none");
    exit();
}
else {
    echo "no post";
}
// TODO stop form submission if questions haven't been answered
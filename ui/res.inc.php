<?php

function emptyInputSignup($name, $email, $pwd, $pwdRepeat) {
    if(empty($name) || empty($email) || empty($pwd) || empty($pwdRepeat)){
        return true;
    }
    else return false;
}

function invalidEmail($email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else return false;
}

function invalidFields($name, $email) {
    if(!preg_match("/^[a-zA-Z0-9@-_]*$/", $name) || preg_match("/^[a-zA-Z0-9@]*$/", $email) ) {
        return true;
    }
    else return false;
}

function pwdMatch($pwd, $pwdRepeat) {
    if ($pwd !== $pwdRepeat) {
        return true;
    }
    else return false;
}

function emailExists($conn, $email) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);    

    if(!$conn){
        header("location: ../ui/signup.php?error=noConn");
          exit();
    }

    if (!mysqli_stmt_prepare($stmt, $sql)) {
           header("location: ../ui/signup.php?error=stmtfailed");
          exit();
    }
  
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
  
    // "Get result" returns the results from a prepared statement
    $resultData = mysqli_stmt_get_result($stmt);
  
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
  
    mysqli_stmt_close($stmt);
  }

function createUser($conn, $name, $email, $pwd) {
    $sql = "INSERT INTO users (usersFullName, usersEmail, usersPwd) VALUES (?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: signup.php?error=createUserStmtFailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss",$name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: index.php?error=none");
    exit();
}
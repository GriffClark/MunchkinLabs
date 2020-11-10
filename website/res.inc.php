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
    if(!preg_match("/^[a-zA-Z0-9@-_ ]*$/", $name) || preg_match("/^[a-zA-Z0-9@-_ ]*$/", $email) ) {
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

function emptyInputLogin($username, $pwd) {
    if(empty($username) || empty($pwd)){
        return true;
    }
    else return false;
}

function loginUser($conn, $username, $pwd) {
    $dbResponse = emailExists($conn, $username);

    if ($dbResponse === false) {
        header("location: login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $dbResponse["usersPwd"];  // Refrences assoc array returned from DB
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: login.php?error=wronglogin");
        exit();
    }

    else if ($checkPwd === true) {
        session_start();
        $_SESSION["userId"] = $dbResponse["usersId"];
        $_SESSION["email"] = $dbResponse["usersEmail"];
        $_SESSION["name"] = $dbResponse["usersFullName"];
        $_SESSION["personalityScore"] = $dbResponse["personalityScore"];
        header("location: index.php?error=none");
        exit();
    }
}

function insertBinaryAnswer($conn, $row) {
    //TODO: This should automatically delete all other answers for this question
    $userId = $_SESSION['userId'];
    $rowId = $row['id'];
    $answer = ($_POST["question$rowId"]);
    $timestamp = date('Y-m-d H:i:s');

    // Automatically change no/yes to TRUE/FALSE
    if($answer == "yes"){
        $binaryAnswer = 1;
    }
    elseif($answer == "no"){
        $binaryAnswer = 0;
    }
    else{
        header("location: index.php?error=badAnswer");
        exit();
    }
    
    // DEBUG
    // echo "for user $userId @ question$rowId, answer $answer ";

    $sql = "INSERT INTO answers (userId, questionId, binaryAnswer, createdAt) VALUES (?,?,$binaryAnswer,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: index.php?error=stmtFailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss",$userId, $rowId, $timestamp);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function addDirtyUser($conn){
    $userId = number_format($_SESSION['userId']);
    // Make sure we add our user to the dirtyUser table
    $sql = "INSERT INTO dirtyusers (userId) VALUES ($userId);"; 
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    $errorRedirectPath = "../../ui/signup.php";

    if (emptyInputSignup($name, $email, $pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyInput");
        die();
    }

    if (invalidEmail($email) !== false) {
        header("location: $errorRedirectPath?error=invalidEmail");
        die();
    }

    if (emailExists($conn, $email) !== false) {
        header("location: $errorRedirectPath?error=emailTaken");
        die();
    }


    if (invalidFields($name, $email) !== false) {
        header("location: $errorRedirectPath?error=nameOrEmailContainedBadCharacters");
        die();
    }

    if(pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: $errorRedirectPath?error=pwdsDontMatch");
        die();
    }

    createUser($conn, $name, $email, $pwd);

}
else {
    // When I screwed with this filepath it changed, but none of the other ones did. No clue why though
    header("location: $errorRedirectPath?error=illigalPath");
    die();
}

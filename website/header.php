<?php
session_start();
require_once "dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<header>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Fontawesome CDN -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Local styles -->
    <link rel="stylesheet" href="style.css">
</header>

<body>

<nav class="navbar navbar-expand-sm " id="navbar">

    <!-- Links -->
    <div class="container">
            <div class="row" id="leftNavbar">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="search.php">Search</a>
            </li>
            <?php
            if(isset($_SESSION["userId"])){
                if($_SESSION["personalityScore"] == null){
                    echo '<li class="nav-item"> <a class="nav-link" href="survey.php">Improve suggestion Accuracy</a> </li>';
                }
            }
            ?>
        </ul>

        </div>
        


        <div class="row" id="rightNavbar">
            <ul class="navbar-nav right-align">
                <?php
                if (isset($_SESSION["userId"])) {
                    echo '<li class="nav-item"><a class="nav-link" href="#">Profile</a></li>';
                    echo '<li class="nav-item"> <a class="nav-link" href="logout.inc.php">Log Out</a> </li>';
                }
                else {
                    echo '<li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>';
                    echo '<li class="nav-item"> <a class="nav-link" href="login.php">Log In</a> </li>';
                }

                
                ?>
            
        </ul>

        </div>
        
    </div>
    

  </nav>


</body>

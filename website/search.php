<?php
include_once 'header.php';
?>

<body>
<div class="container">
    <h1 style="padding-top: 3rem; color: #FFF;"> Search Friends List</h1>
    
    <div class="md-form active-pink active-pink-2 mb-3 mt-0" onKeyPress="return checkSubmit(event)">
    <form action="search.php" method="post">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" name="query" aria-label="Search">
        <button class="btn purple-gradient btn-rounded btn-sm my-0 login_btn" name="submit" type="submit" id="searchBtn">Search</button>
    </form>
    </div>

    <div class="row">
        <?php
        if (isset($_POST["submit"])) : ?> 
                <?php
                if($_POST['query'] !== '') {
                    // This will loop through each result
                    // Go through database and find all users that match searched substring (and Griffin, for default)
                    // Run a query to pull all users, then figure out which of them have names that are in the substring
                    $sql = "SELECT * FROM users;"; //TODO: There must be a better way to do this
                    $result = $conn->query($sql);
                    $userRows = array();

                    // Add each user who kinda matches our query to $users
                    while($row = mysqli_fetch_assoc($result)){
                        $username = strtolower($row["usersFullName"]);
                        if(strpos($username, strtolower($_POST['query'])) !== false|| strpos(strtolower($_POST['query']), $username) !== false){
                            array_push($userRows, $row);
                        }
                    }

                    // Loop through $users and add a tile for each one

                    foreach($userRows as $userRow) {
                        if($userRow['bio']) {
                            $bio = $userRow['bio'];
                        }
                        else {
                            $bio = "no bio";
                        }
                        $id = $userRow['usersId'];
                        $name = $userRow['usersFullName'];

                        echo ' <div class="card search-result-card" id='.$id.'>
                        <!-- Cant get CSS to apply to the card, so coded it into the HTML -->
                        <img src="../res/griffin-diving.jpg" alt="John" style="width:100%">
                        <h3 style="color: #ffe400; padding-top: 0.5rem;">'.$name.'</h3>
                        <p style="color: #FFF;">'.$bio.'</p>
                        <p><button class="search-result-card-btn" style="border: none; outline: 0; display: inline-block; padding: 8px; color: white; background-color: #14a76c; text-align: center; cursor: pointer; width: 100%; font-size: 18px;">Connect</button></p>
                        </div>';
                    }
                } 
                
                ?>



        <?php endif; ?>
    </div>
</div>

<script>
// Get the input field
$(document).ready(() =>{
    // TODO: There has to be a better way to do this than pressing a hidden button
    document.getElementById("searchBtn").style.display = "none";

    let input = document.getElementById("myInput");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("searchBtn").click();
  }
});

});
</script>
</body>
<?php
include_once 'footer.php';
?>

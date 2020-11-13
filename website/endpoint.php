<?php
include_once 'header.php';
?>


<div class="container">
<div class="headline-text-container" style="padding-top: 2rem; color: #ffe400">

<h1 class="headline" style="color : #FFF;"> Have More Fun Connecting in the Real World </h1>
</div>
<div class="row">

    <div class="col">
    <div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign Up</h3>
			</div>
			<div class="card-body">
                <form action="endpoint.inc.php" method="post">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="title" placeholder="Title">
                    </div>
                    <h3 style="color: white;">Enter scores 0-1</h3>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="finance" placeholder="Finance score">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="active" placeholder="Active score">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="adventurous" placeholder="Adventurous score">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="length" placeholder="Length score">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="birdwatcher" placeholder="Birdwatcher score">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="groupsize" placeholder="Groupsize score">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="extravagant" placeholder="Extravagant score">
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="culture" placeholder="Culture score">
                    </div>
                    
                    <div class="form-group">
						<input type="submit" value="Submit" name="submit" class="btn float-right login_btn">
					</div>
                </form>
            </div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Already have an account?<a href="login.php">Log In</a>
				</div>
			</div>
		</div>
	</div>
    </div>
  </div>
</div>

<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "") {
        // If the user put in empty input
        echo"<p>Empty input</p>";
    }

}
?>

<?php
include_once 'footer.php';
?>

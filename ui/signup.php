<?php
include_once 'header.php';
?>

<section class="signup-form">
    <h2>Sign Up</h2>
    <div class="signup-form">
        <form action="signup.inc.php" method="POST">
            <input type="text" name="name" placeholder="Full name">
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwdrepeat" placeholder="Confirm password">
            <button type="submit" name="submit">Sign Up!</button>
        </form>
    </div>
</section>

<?php
include_once 'footer.php';
?>

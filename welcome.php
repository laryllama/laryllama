<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome</title>
    <?php include ("header.php"); ?>
</head>
<body>
    <div class="welcome">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to your account.</h1>
        <p>
            <a href="reset-password.php" class="btn btn-primary">Reset Your Password</a>
            <div class="btn-divider"/>
            <a href="logout.php" class="btn btn-primary">Sign Out of Your Account</a>
        </p>
    </div>
</body>
</html>
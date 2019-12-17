<?php
	// Initialize the session
    session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>LaryLlama Forum</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="menu">
        <a href="https://www.laryllama.com/">Home</a>
        <a href="/forum/index.php">Forum Home</a>
        <a href="/forum/create_topic.php">Create A Topic</a>
        <a href="/forum/create_cat.php">Create A Category</a>
    <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            echo "<a href='https://www.laryllama.com/welcome.php'>Account</a>";
        }
        else{
            echo "<a href='https://www.laryllama.com/login.php'>Sign Up/Login</a>";
        }
    ?>
    </div>
    <h1>LaryLlama Forum</h1>
    <div class="content">
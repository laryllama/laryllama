<?php
ob_start();
include 'connect.php';
include 'header.php';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //someone is calling the file directly, which we don't want
    echo 'This file cannot be called directly.';
}
else
{
    //check for sign in status
    if(!$_SESSION['loggedin'])
    {
        echo 'You must be signed in to post a reply.';
    }
    else
    {
        //a real user posted a real reply
        $reply_content = mysqli_real_escape_string($link, $_POST['reply_content']);
        $sql = "INSERT INTO Posts (post_content, post_date, post_topic, post_by) VALUES ('$reply_content', NOW(), " . $_GET['id'] . ", " . $_SESSION['id'] . ")";
                         
        $result = mysqli_query($link, $sql);
                         
        if(!$result)
        {
            echo 'Your reply has not been saved, please try again later.';
        }
        else
        {
            header("location: http://www.laryllama.com/forum/topic.php?id=" . $_GET['id']);
            exit();
        }
    }
}
 
include 'footer.php';
?>
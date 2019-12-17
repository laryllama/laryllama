<?php
include 'connect.php';
include 'header.php';
 
//first select the category based on $_GET['cat_id']
$id = mysqli_real_escape_string($link, $_GET['id']);
$sql = "SELECT Topics.* FROM Topics WHERE Topics.topic_id='" . $_GET['id'] . "'";
 
$result = mysqli_query($link, $sql);
 
if(!$result)
{
    echo 'The topic could not be displayed, please try again later.' . mysqli_error();
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This topic does not exist.';
    }
    else
    {
        echo "<div style=' position: relative;'>
            <div style='padding-bottom: 30vw;'>";
        //display category data
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<table border="1">
              <tr>
                <th colspan="2">' . $row['topic_subject'] . '</th>
              </tr>';
        }
     
        //do a query for the posts
        $sql = "SELECT Posts.*, Users.id, Users.username FROM Posts LEFT JOIN Users ON Posts.post_by = Users.id WHERE Posts.post_topic ='" . $_GET['id'] . "'";
         
        $result = mysqli_query($link, $sql);
         
        if(!$result)
        {
            echo 'The posts could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo '<h2>There are no posts in this topic yet. <br> Add the first reply!</h2>';
            }
            else
            {
                //prepare the table
                while($row = mysqli_fetch_assoc($result))
                {               
                    echo '<tr>';
                        echo '<td class="created_by">';
                            echo $row['username'];
                            echo '<br>';
                            $t = time();
                            echo date('d/m/Y h:i:s', strtotime($row['post_date']));
                        echo '</td>';
                        echo '<td class="reply">';
                            echo $row['post_content'];
                        echo '</td>';
                    echo '</tr>';
                }
            }
        }
        echo "</div>
            <div style='position: absolute; bottom: 0;'>";
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
        {
            //the user is not signed in
            echo 'Sorry, you have to be <a href="../login.php">signed in</a> to post a reply.';
        }
        else
        {
            echo "<form method='post' action='reply.php?id=" . $_GET['id'] . "'>
                <div class='form-group'>
                    <textarea name='reply_content' class='form-control long-form'></textarea>
                </div>
                <input type='submit' value='Submit reply' class='btn btn-primary'/>
            </form>";
        }
        echo "</div>
        </div>";
    }
}
include 'footer.php';
?>
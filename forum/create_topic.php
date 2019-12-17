<?php
include 'connect.php';
include 'header.php';
 
echo '<h2>Create a topic</h2>';
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    //the user is not signed in
    echo 'Sorry, you have to be <a href="../login.php">signed in</a> to create a topic.';
}
else
{
    //the user is signed in
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {   
        //the form hasn't been posted yet, display it
        //retrieve the categories from the database for use in the dropdown
        $sql = "SELECT Categories.* FROM Categories";
         
        $result = mysqli_query($link, $sql);
         
        if(!$result)
        {
            //the query failed, uh-oh :-(
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                //there are no categories, so a topic can't be posted
                if($_SESSION['level'] == 1)
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                }
            }
            else
            {
                echo "<div class='wrapper'>";
                echo '<form method="post" action="">
                    <div class="form-group">
                    <label>Subject:</label><input type="text" name="topic_subject" class="form-control"/>
                    </div>
                    <div class="form-group">
                    <label>Category:</label>'; 
                 
                echo '<select name="topic_cat" class="form-control select-form">';
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select>
                    </div>'; 
                     
                echo '
                    <div class="form-group">
                    <lable>Message:</lable><textarea name="post_content" class="form-control long-form"/></textarea>
                    </div>
                    <input type="submit" value="Create topic" class="btn btn-primary"/>
                 </form>';
                echo "</div>";
            }
        }
    }
    else
    {
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysqli_query($link, $query);
         
        if(!$result)
        {
            //Damn! the query failed, quit
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
            //the form has been posted, so save it
            //insert the topic into the topics table first, then we'll save the post into the posts table
            
            $topic_subject = mysqli_real_escape_string($link, $_POST['topic_subject']);
            $topic_cat = mysqli_real_escape_string($link, $_POST['topic_cat']);
            $id = $_SESSION['id'];
            $sql = "INSERT INTO Topics (topic_subject, topic_date, topic_cat, topic_by) VALUES ('$topic_subject', NOW(), '$topic_cat', '$id')";
                      
            $result = mysqli_query($link, $sql);
            if(!$result)
            {
                //something went wrong, display the error
                echo 'An error occured while inserting your data. Please try again later.';
                $sql = "ROLLBACK;";
                $result = mysqli_query($sql);
            }
            else
            {
                //the first query worked, now start the second, posts query
                //retrieve the id of the freshly created topic for usage in the posts query
                $topicid = mysqli_insert_id($link);
                $post_content = mysqli_real_escape_string($link, $_POST['post_content']);
                
                $sql = "INSERT INTO Posts(post_content, post_date, post_topic, post_by) VALUES ('$post_content', NOW(), '$topicid', '$id')";
                $result = mysqli_query($link, $sql);
                 
                if(!$result)
                {
                    //something went wrong, display the error
                    echo 'An error occured while inserting your post. Please try again later.' . mysqli_error();
                    $sql = "ROLLBACK;";
                    $result = mysqli_query($sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = mysqli_query($link, $sql);
                     
                    //after a lot of work, the query succeeded!
                    echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
                }
            }
        }
    }
}
 
include 'footer.php';
?>
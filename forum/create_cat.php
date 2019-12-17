<?php
include ("connect.php");
include ("header.php");
echo "<h2>Create A Category</h2>";
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    //the user is not signed in
    echo 'Sorry, you have to be <a href="../login.php">signed in</a> and an admin to create a category.';
}
else
{
    if($_SESSION['level'] == 1)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            //the form hasn't been posted yet, display it
            echo "<div class='wrapper'>
                    <form method='post' action=''>
                        <div class='form-group'>
                            <lable>Category Name:</label>
                            <input type='text' name='cat_name' class='form-control'/>
                        </div>
                        <div class='form-group'>
                            <label>Category Description:</label>
                            <textarea name='cat_description' class='form-control long-form'/></textarea>
                        </div>
                        <input type='submit' value='Add category' class='btn btn-primary'/>
                    </form>
                </div>";
        }
        else
        {
            //the form has been posted, so save it
            $cat_name = mysqli_real_escape_string($link, $_POST['cat_name']);
            $cat_description = mysqli_real_escape_string($link, $_POST['cat_description']);
            $sql = "INSERT INTO Categories (cat_name, cat_description)
            VALUES ('$cat_name', '$cat_description')";
            $result = mysqli_query($link, $sql);
            if(!$result)
            {
                //something went wrong, display the error
                echo 'Error' . mysqli_error();
            }
            else
            {
                echo 'New category successfully added.';
            }
        }
    }
    else
    {
        echo "Only Admins can create categories.";
    }
}
include ("footer.php");
?>
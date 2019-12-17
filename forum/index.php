<?php
include("connect.php");
include("header.php");

$sql = "SELECT Categories.* FROM Categories";
$result = mysqli_query($link, $sql);

if($result == false)
{
    die("There was an error loading the Categories.");
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo "There are no Categories yet.";
    }
    else
    {
        //prepare the table
        echo '<table border="1">
              <tr>
                <th>Category</th>
                <th>Descripiton</th>
              </tr>'; 
        while($row = mysqli_fetch_assoc($result))
        {               
            echo '<tr>';
                echo '<td class="category">';
                    echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>';
                echo '</td>';
                echo '<td class="cat_desc">';
                            echo $row['cat_description'];
                echo '</td>';
            echo '</tr>';
        }

    }
}

include("footer");
?>
<?php 



function confirm($statement)
{
    global $connection;

    
    if (!$statement)
    {
        die("Query failed ". mysqli_error($connection));
    }
}


function insert ()
{

    global $connection;

    if(isset($_POST['submit']))
    {
        $cat_title = $_POST['cat-title'];

        if ($cat_title == "" || empty($cat_title))
        {
            echo "<h3> The field is empty</h3>";
        }
        else
        {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= " VALUE('{$cat_title}')";
            $category_query = mysqli_query($connection, $query);

            if (!$category_query)
            {
                die('QUERY FAILED ' . mysqli_error($connection));
            }
        }
    }
}


function getAllCategories()
{

    global $connection;

    $query = "SELECT * FROM categories";
    $select_all_categories_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_categories_query))
    {
        echo "<tr>";
        echo "<td>{$row['cat_id']}</td>";
        echo "<td>{$row['cat_title']}</td>";
        echo "<td><a href='categories.php?edit={$row['cat_id']}'>EDIT</a></td>";
        echo "<td><a href='categories.php?delete={$row['cat_id']}'>DELETE</a></td>";
        
        echo "</tr>";
    }

}

function delete_category()
{

    global $connection;

    if (isset($_GET['delete']))
    {
        $cat_del = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$cat_del}";

        $del_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

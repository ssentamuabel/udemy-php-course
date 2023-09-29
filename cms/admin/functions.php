<?php

function table_status($table, $status_name, $status)
{
    global $connection;
    $query = "SELECT * FROM $table where $status_name = '$status'";
    $status_count_query = mysqli_query($connection, $query);
    confirm($status_count_query);
    return  mysqli_num_rows($status_count_query);
}

function row_count($table)
{
    global $connection;

    $query = "SELECT * FROM $table";

    $count_query = mysqli_query($connection, $query);

    confirm($count_query);

    return mysqli_num_rows($count_query);
}


function escape($string)
{
    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}



function users_online()
{

    if (isset($_GET['onlineusers'])) {


        global $connection;


        if (!$connection) {
            session_start();
            include("../includes/db.php");


            $session = session_id();
            $time = time();
            $time_out_in_seconds = 60;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT *  FROM users_online WHERE  session = '$session'";
            $send_query = mysqli_query($connection, $query);
            confirm($send_query);

            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                $submit = mysqli_query($connection, "INSERT INTO users_online(session, time)VALUES('$session', '$time')");
                confirm($submit);
            } else {
                $submit = mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
                confirm($submit);
            }


            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo  $count_user = mysqli_num_rows($users_online_query);
        }
    }
}


users_online();



function confirm($statement)
{
    global $connection;


    if (!$statement) {
        die("Query failed " . mysqli_error($connection));
    }
}


function insert()
{

    global $connection;

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat-title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "<h3> The field is empty</h3>";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= " VALUE('{$cat_title}')";
            $category_query = mysqli_query($connection, $query);

            if (!$category_query) {
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

    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
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

    if (isset($_GET['delete'])) {
        $cat_del = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$cat_del}";

        $del_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

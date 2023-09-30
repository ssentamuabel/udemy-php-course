<?php



function login_user($username, $password)
{
    global $connection;

    $username = trim(mysqli_real_escape_string($connection, $username));
    $password = trim(mysqli_real_escape_string($connection, $password));


    $query = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_user_query = mysqli_query($connection, $query);

    while (!$select_user_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }


    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $db_user_id =  $row['user_id'];
        $db_user_firstname =  $row['user_firstname'];
        $db_user_lastname =  $row['user_lastname'];
        $db_username =  $row['username'];
        $db_user_password =  $row['user_password'];
        $db_user_role =  $row['user_role'];




        if ($username === $db_username && $password === $db_user_password) {

            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['username'] = $db_username;
            $_SESSION['user_role'] = $db_user_role;

            header("Location: index.php");
        } else {
            header("Location: index.php");
        }
    }
}

function register_user($username, $email, $password)
{
    global $connection;



    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    // $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
    $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber')";

    $register_user_query = mysqli_query($connection, $query);

    confirm($register_user_query);
}

function emailexists($email)
{
    global $connection;

    $query = "SELECT * FROM users WHERE user_email = '$email'";

    $email_check_query = mysqli_query($connection, $query);
    confirm($email_check_query);
    $count = mysqli_num_rows($email_check_query);

    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}





function userexists($username)
{
    global $connection;

    $query = "SELECT * FROM users WHERE username = '$username'";
    $user_check_query = mysqli_query($connection, $query);

    confirm($user_check_query);

    $count = mysqli_num_rows($user_check_query);

    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}


function is_admin($username = '')
{
    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $admin_check_query = mysqli_query($connection, $query);

    confirm($admin_check_query);

    $row = mysqli_fetch_array($admin_check_query);

    if ($row['user_role'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

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

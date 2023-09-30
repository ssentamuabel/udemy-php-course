<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Edit</th>
            <th>SubScriber</th>
            <th>Admin</th>
            <th>Delete</th>
            
            
        </tr>
    </thead>
    <tbody>


        <?php

        $query = "SELECT * FROM users";
        $users_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($users_query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            


            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";

            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?sub={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?admin={$user_id}'>Admin</a></td>";
            ?>

            <form action="" method="post">
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                <?php 
                    echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"/></td>';
                ?>
            </form>
            

            <?php 
            //echo "<td><a  onClick = \" javascript: return confirm('Are you sure you want to delete the field'); \" href='users.php?delete={$user_id}'>Delete</a></td>";


            echo "</tr>";
        }

        ?>

    </tbody>
</table>


<?php 


if (isset($_POST['delete']))
{

    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === "admin")
    {
        $the_user_id  = $_POST['user_id'];

        $query = "DELETE FROM users WHERE user_id = {$the_user_id}";

        $delete_query = mysqli_query($connection, $query);

        header("Location: users.php");
    }
    else
    {
        header("Location: ../index.php");
    }

    
}



if (isset($_GET['sub']))
{
    $query= "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$_GET['sub']}";

    $sub_query = mysqli_query($connection, $query);
    if (!$sub_query)
    {
        die("QUERY FAILED ". mysqli_error($connection));
    }
    header("Location: users.php");
}



if (isset($_GET['admin']))
{

    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === "admin")
    {
        $query= "UPDATE users SET user_role = 'admin' WHERE user_id = {$_GET['admin']}";

        $admin_query = mysqli_query($connection, $query);
        if (!$admin_query)
        {
            die("QUERY FAILED ". mysqli_error($connection));
        }
        header("Location: users.php");
    }
    else
    {
        header("Location: ../index.php");
    }
}

?>
<?php include "includes/admin_header.php" ?>
<?php session_start(); ?>


<?php

if (isset($_SESSION['username'])) {
    $username =  $_SESSION['username'];


    $query = "SELECT * FROM users WHERE username = '{$username}'";

    $user_profile_query = mysqli_query($connection, $query);

    confirm($user_profile_query);


    while ($row = mysqli_fetch_array($user_profile_query)) {
        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_password = $row['user_password'];
?>

        <div id="wrapper">

            <?php include "includes/admin_navigation.php" ?>

            <div id="page-wrapper">

                <div class="container-fluid">
                    <h1>
                        Welcome to Admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="user_firstname">First Name</label>
                            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
                        </div>
                        <div class="form-group">
                            <label for="title">Last Name</label>
                            <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                        </div>
                       
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                        </div>
                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
                        </div>
                        <div class="form-group">

                            <input type="submit" class="btn btn-primary" value="Update Profile" name="update_user">
                        </div>
                    </form>


            <?php
        }
    }


    if (isset($_POST['update_user'])) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        if ($user_password === $new_user_password)
        {
            // Update query
            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "username = '{$username}', ";
            $query .= "user_email = '{$user_email}' ";
       
    
        
    
        }
        else
        {
    
            $user_password = password_hash($user_password, PASSWORD_DEFAULT);
                // Update query
            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "username = '{$username}', ";
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_password = '{$user_password}' ";
        
        
    
        }
      
       
       
    
    
        $query .= "WHERE  user_id  =  {$the_user_id}";
    
        $update_query = mysqli_query($connection, $query);
    
        confirm($update_query);
    
      
    }



            ?>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

            <?php include "includes/admin_footer.php" ?>
<?php




if (isset($_GET['u_id'])) {

    $the_user_id = $_GET['u_id'];

  

    $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
    $post_query = mysqli_query($connection, $query);


    while ($row = mysqli_fetch_assoc($post_query)) {

        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_password = $row['user_password'];
       

?>



<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" value ="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" value ="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select class="form-control" name="user_role" id ="">

            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

            <?php 
            
            if ($user_role == "admin")
                echo "<option value='subscriber'>Subscriber</option>";
            
            
            ?>

           
        </select>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value ="<?php echo $username; ?>" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" value ="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input     autocapitalize="off" type="password" value = "<?php echo $user_password; ?>" class="form-control" name="user_password">
    </div>
    <div class="form-group">
       
        <input type="submit" class="btn btn-primary" value="Update User" name="update_user">
    </div>
</form>

<?php }
}




if (isset($_POST['update_user']))
{
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];    
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
   
    $new_user_password = $_POST['user_password'];


    if ($user_password === $new_user_password)
    {
        // Update query
        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_role = '{$user_role}', ";
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
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$user_password}' ";
    
    

    }
  
   
   


    $query .= "WHERE  user_id  =  {$the_user_id}";

    $update_query = mysqli_query($connection, $query);

    confirm($update_query);

    header("Location: users.php");

    

}


?>
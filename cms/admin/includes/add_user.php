<?php



if (isset($_POST['create_user'])) {

    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $username = escape($_POST['username']);    
    $user_email = escape($_POST['user_email']);

    $user_role = escape($_POST['user_role']);
    $user_password = escape($_POST['user_password']);
    
    // $post_comment_count = 4;


    $user_password = password_hash($user_email, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, user_password, user_firstname, 
                user_lastname,user_email, user_role)";

    $query .= "VALUES('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}',
                         '{$user_email}',  '{$user_role}')";


    $create_user_query = mysqli_query($connection, $query);

    confirm($create_user_query);

    

    header("Location: users.php");
}

?>


<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select class="form-control" name="user_role" id ="">

            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
       
        <input type="submit" class="btn btn-primary" value="create User" name="create_user">
    </div>
</form>
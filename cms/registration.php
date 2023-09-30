<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "admin/functions.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>



<?php


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $errors = [
        'username'=>'',
        'email'=>'',
        'password'=>''
    ];


    if (strlen($username) < 4)
    {
        $errors['username'] = 'Username is too small';
    }

    if ($username == '')
    {
        $errors['username'] = 'Username can not be empty';
    }

    if (userexists($username))
    {
        $errors['username'] = 'Username already exists';
    }

    if ($email == '')
    {
        $errors['email'] =  'Email can not be empty';
    }

    if (emailexists($email))
    {
        $errors['email'] = 'Email already exists, <a href="index.php"> Please login </a>';
    }

    if ($password == '')
    {
        $errors['password'] = 'Password can not be Empty';
    }

    foreach($errors as $key => $value)
    {
        if (empty($value))
        {
           unset($errors[$key]);

        }
    }

    if (empty($error))
    {
        register_user($username, $email, $password);
        login_user($username, $password);
    }


 
} else {
    $message = "";
}


?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input autocomplete="on" type="text" name="username" id="username" class="form-control"
                                         placeholder="Enter Desired Username"
                                         value="<?php  echo isset($username)? $username: '';  ?>">
                                         <p><?php  echo isset($errors['username'])? $errors['username']: '';  ?></p>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input autocomplete="on" type="email" name="email" id="email" class="form-control" 
                                value="<?php  echo isset($email)? $email: '';  ?>"
                                placeholder="somebody@example.com">
                                <p><?php  echo isset($errors['email'])? $errors['email']: '';  ?></p>
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input autocomplete="off" type="password" name="password" id="key" class="form-control" placeholder="Password">
                                <p><?php  echo isset($errors['password'])? $errors['password']: '';  ?></p>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>
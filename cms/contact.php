<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>



    <?php 
    
    
    if (isset($_POST['submit']))
    {
      $to = "ssentamuabel90@gmail.com";
      $header = "FROM: " . $_POST['email'];
      $subject = wordwrap($_POST['subject'], 70);
      $body = $_POST['body'];


      mail($to, $subject, $body, $header);


    }
   
    
    
    ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                <h6 class="text-center"></h6>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enteryour subject">
                        </div>
                         <div class="form-group">
                            <label for="body" class="sr-only">body</label>
                            <Textarea class="form-control" name="body" id="body"></Textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>

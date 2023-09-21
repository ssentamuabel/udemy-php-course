<?php  include "includes/db.php"?>
<?php  include "includes/header.php"?>



    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

            <?php 


                if(isset($_POST['submit']))
                {
                $search =  $_POST['search'];

                    $query = "SELECT * FROM posts WHERE post_tags LIKE  '%$search%' ";
                    $search_query = mysqli_query($connection, $query);


                    if(!$search_query)
                    {
                        die("QUERY FAILED " . mysqli_error($connection));
                    }

                    $count = mysqli_num_rows($search_query);

                    if ($count == 0)
                    {
                        echo "<h2>NO RESULT</h2>";
                    }
                    else
                    {

                       

                        
            
                        while($row = mysqli_fetch_assoc( $search_query))
                        {
            
            
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];
            
            
                            ?>
            
            
            
                            <!-- Title -->
                            <h1><?php echo $post_title;  ?></h1>
            
                            <!-- Author -->
                            <p class="lead">
                                by <a href="#"><?php echo $post_author; ?></a>
                            </p>
            
                            <hr>
            
                            <!-- Date/Time -->
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            
                            <hr>
            
                            <!-- Preview Image -->
                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            
                            <hr>
            
                            <!-- Post Content -->
                            <p class="lead"><?php echo $post_content ?></p>
                            
                            <hr>
            
                            <?php   }   
                    }

                }
           
           ?>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php"  ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php  include "includes/footer.php" ?>  
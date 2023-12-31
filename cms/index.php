<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php session_start(); ?>



<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <?php

            if (isset($_POST['submit'])) {
                $search =  $_POST['search'];

                $query = "SELECT * FROM posts WHERE post_tags LIKE  '%$search%' ";
                $search_query = mysqli_query($connection, $query);


                if (!$search_query) {
                    die("QUERY FAILED " . mysqli_error($connection));
                }

                $count = mysqli_num_rows($search_query);

                if ($count == 0) {
                    echo "<h2>NO RESULT</h2>";
                } else {
                }
            }


           


            if (isset($_SESSION['username'])) {

                $query = "SELECT * FROM posts";
                $post_query = mysqli_query($connection, $query);



                $post_count = mysqli_num_rows($post_query);
            } else {
                $query = "SELECT * FROM posts WHERE post_status = 'Publish'";
                $post_query = mysqli_query($connection, $query);



                $post_count = mysqli_num_rows($post_query);
            }

            if ($post_count > 0) {

                while ($row = mysqli_fetch_assoc($post_query)) {

                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_status = $row['post_status'];

            ?>

                        <!-- Title -->
                        <h1><a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title;  ?></a></h1>

                        <!-- Author -->
                        <p class="lead">
                            by <a href="#"><?php echo $post_author; ?></a>
                        </p>

                        <hr>

                        <!-- Date/Time -->
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

                        <hr>

                        <!-- Preview Image -->
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        </a>


                        <hr>

                        <!-- Post Content -->
                        <p class="lead"><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>"> Read More<span class="glyphicon glyphicon-chiveron-right"></span></a>

                        <hr>

            <?php
                    
                }
            } else {
                echo "<h2 class='text-center' > NO POSTS TO DISPLAY </h2>";
            } ?>

            <!-- Blog Comments -->





        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"  ?>

    </div>
    <!-- /.row -->

    <hr>




    <?php include "includes/footer.php" ?>
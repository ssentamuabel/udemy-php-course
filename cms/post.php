<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>



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


            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];




                $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";

                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {


                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 100);


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
            } ?>

            <!-- Blog Comments -->


            

            <?php 
            
            if (isset($_POST['create_comment']))
            {

                $the_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
               

                $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                $query .= " VALUES({$the_post_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved', now())";

                $comment_query = mysqli_query($connection, $query);
               
                if (!$comment_query)
                {
                    die("QUERY FAILED " . mysqli_error($connection));
                }
                
                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$the_post_id}";

                $update_count = mysqli_query($connection, $query);

                if (!$update_count)
                {
                    die("QUERY FAILED " . mysqli_error($connection));
                }

                
            }
            
            
            
            ?>
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for ="comment_author">Author</lable>
                        <input type="text" class="form-control" name="comment_author"/>
                    </div>
                    <div class="form-group">
                        <label for ="comment_email"> Email </label>
                        <input type="email"  class="form-control" name="comment_email"/>
                    </div>
                    <div class="form-group">
                        <label for ="comment_content">Comment</label>
                        <textarea name="comment_content" id="summernote" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit"  name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>



            <hr>

            <!-- Posted Comments -->
            

            
            <?php
            
            $query = "SELECT * FROM  comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'Approved' ";
            $query .= "ORDER BY  comment_id  DESC ";

            $select_post_comment_query = mysqli_query($connection, $query);
            if (!$select_post_comment_query)
            {
                die("QUERY FAILED " . mysqli_error($connection));
            }


            while ($row = mysqli_fetch_assoc($select_post_comment_query))
            {

            
            ?>


<!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php  echo $row['comment_author']; ?>
                        <small><?php  echo $row['comment_date']; ?></small>
                    </h4>
                    <?php  echo $row['comment_content']; ?>
                </div>
            </div>


            
            
            <?php } ?>




            
            

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"  ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php" ?>
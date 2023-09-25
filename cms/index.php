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


            if (isset($_GET['page']))
            {
                $page = $_GET['page'];


            }else{
                $page = "";
            }


            if ($page == "" || $page == 1 )
            {
                $page_1 = 0;
            }
            else
            {
                $page_1 = ($page * 3) - 3;
            }


            $count = "SELECT * FROM posts";
            $count_query = mysqli_query($connection, $count);

            $post_count = mysqli_num_rows($count_query);

            $post_count = ceil($post_count / 3);


            $query = "SELECT * FROM posts  LIMIT $page_1, 3";

            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {

                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_status = $row['post_status'];


                if ($post_status == 'Publish') {


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

            <?php   }
            }  ?>

            <!-- Blog Comments -->





        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"  ?>

    </div>
    <!-- /.row -->

    <hr>



    <ul class="pager">
        <?php
        for ($i = 1; $i <= $post_count; $i++) {
            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }
        ?>

    </ul>

    <?php include "includes/footer.php" ?>
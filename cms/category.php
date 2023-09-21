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
                        
                    }

                }
                

                if (isset($_GET['category']))
                {

                    $the_cat_id = $_GET['category'];
               

            
                $query = "SELECT * FROM posts WHERE post_category_id={$the_cat_id}";

                $select_posts = mysqli_query($connection, $query);


                if (!$select_posts)
                {
                    die("FAILED " . mysqli_error($connection));
                }


                

                while($row = mysqli_fetch_assoc($select_posts))
                {

                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];


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
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content ?></p>
                
                <hr>

                <?php   } }  ?>

                <!-- Blog Comments -->

                

               

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php"  ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php  include "includes/footer.php" ?>  
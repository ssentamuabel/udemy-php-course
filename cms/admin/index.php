<?php include "includes/admin_header.php" ?>
<?php session_start() ?>




<div id="wrapper">


    <?php include "includes/admin_navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome To Admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                  
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $query = "SELECT * FROM posts";

                                    $post_count_query = mysqli_query($connection, $query);

                                    confirm($post_count_query);

                                    $post_count = mysqli_num_rows($post_count_query);

                                    echo "<div class='huge'>{$post_count}</div>";

                                    ?>

                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $query = "SELECT * FROM comments";

                                    $comment_count_query = mysqli_query($connection, $query);

                                    confirm($comment_count_query);

                                    $comment_count = mysqli_num_rows($comment_count_query);

                                    echo "<div class='huge'>{$comment_count}</div>";

                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $query = "SELECT * FROM users";

                                    $user_count_query = mysqli_query($connection, $query);

                                    confirm($user_count_query);

                                    $user_count = mysqli_num_rows($user_count_query);

                                    echo "<div class='huge'>{$user_count}</div>";

                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

                                    $query = "SELECT * FROM categories";

                                    $category_count_query = mysqli_query($connection, $query);

                                    confirm($category_count_query);

                                    $category_count = mysqli_num_rows($category_count_query);

                                    echo "<div class='huge'>{$category_count}</div>";

                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->


        <?php
        $query = "SELECT * FROM posts where post_status = 'draft'";
        $draft_post_count_query = mysqli_query($connection, $query);
        confirm($draft_post_count_query);
        $draft_post_count = mysqli_num_rows($draft_post_count_query);

        $query = "SELECT * FROM users where user_role = 'subscriber'";
        $subscriber_user_count_query = mysqli_query($connection, $query);
        confirm($subscriber_user_count_query);
        $subscriber_user_count = mysqli_num_rows($subscriber_user_count_query);

        $query = "SELECT * FROM comments where comment_status = 'Unapproved'";
        $unapproved_comments_query = mysqli_query($connection, $query);
        confirm($unapproved_comments_query);
        $unapproved_comments_count = mysqli_num_rows($unapproved_comments_query);




        ?>

        <div class="row">
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count', ],

                        <?php

                        $element_text = ['Active Posts', 'Draft posts', 'Categories', 'Users', 'Subscribers', 'Comments', 'Unapproved Comments'];
                        $element_count = [$post_count, $draft_post_count, $category_count, $user_count, $subscriber_user_count,  $comment_count,  $unapproved_comments_count];


                        for ($i = 0; $i < 7; $i++) {
                            echo "['{$element_text[$i]}'" . "," . " {$element_count[$i]}], ";
                        }

                        ?>

                    ]);

                    var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
            <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

        </div>


    </div>
    <!-- /#page-wrapper -->



    <?php include "includes/admin_footer.php" ?>
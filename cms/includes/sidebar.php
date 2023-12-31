<div class="col-md-4">





    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>


    <div class="well">

        <?php if (isset($_SESSION['user_role'])) : ?>
            <h4>Logged in as <?php  echo $_SESSION['username']; ?></h4>
            <a href="includes/logout.php" class="btn btn-primary">Logout</a>
        <?php else : ?>
            <h4>Login </h4>
            <form action="includes/login.php" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Enter username">

                </div>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">Submit</button>
                    </span>

                </div>
            </form>
        <?php endif ?>

        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>


        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php


                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                        echo "<li><a href='category.php?category={$row['cat_id']}'>{$row['cat_title']}</a></li>";
                    }

                    ?>

                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>
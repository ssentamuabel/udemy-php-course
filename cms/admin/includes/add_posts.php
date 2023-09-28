<?php



if (isset($_POST['create_post'])) {

    $post_title = escape( $_POST['title']);
    $post_author = escape($_POST['author']);
    $post_category = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
    // $post_comment_count = 4;


    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts (post_category_id, post_title, post_author, 
                post_date, post_image, post_content, 
                post_tags,  post_status)";

    $query .= "VALUES({$post_category}, '{$post_title}', '{$post_author}', now(),  '{$post_image}',
                         '{$post_content}',  '{$post_tags}',  '{$post_status}')";


    $create_post_query = mysqli_query($connection, $query);

    confirm($create_post_query);

    $the_post_id = mysqli_insert_id($connection);

    echo "<p class='bg-success'> 
    Post Updated 
    <a href='../post.php?p_id={$the_post_id}'>View Post</a> 
    or 
    <a href='posts.php'>Back to Posts</a></p>";
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="title">Category</label>
        <select class="form-control" name="post_category" id="">


            <?php

            $query = "SELECT * FROM categories";

            $category_query = mysqli_query($connection, $query);

            confirm($category_query);


            while ($row = mysqli_fetch_assoc($category_query)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}' id=''>{$cat_title} </option>";
            }

            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="title">Author</label>
        <select class="form-control" name="author" id="">
            <option value="<?php  echo $_SESSION['username']?>">Select Author</option>
            <?php

            $query = "SELECT * FROM users";

            $user_query = mysqli_query($connection, $query);

            confirm($user_query);


            while ($row = mysqli_fetch_assoc($user_query)) {
                $user_id = $row['user_id'];
                $username = $row['username'];

                echo "<option value='{$username}' id=''>{$username} </option>";
            }

            ?>
        </select>
    </div>





    <!-- 
    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div> -->





    <div class="form-group">
    <label for="title">Status</label>
        <select class="form-control" name="post_status" id="">
            <option value="draft">Select post status</option>
            <option value="Publish">Publish</option>
            <option value="draft">Draft</option>
        </select>



    </div>
    <div class="form-group">
        <label for="title">Post Image</label>
        <input class="form-control" type="file" name="image">
    </div>
    <div class="form-group">
        <label for="title">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" id="summernote" cols="30" rows="10" name="post_content"></textarea>
    </div>
    <div class="form-group">
        <label for="title">Post Status</label>
        <input type="submit" class="btn btn-primary" value="Publish post" name="create_post">
    </div>
</form>
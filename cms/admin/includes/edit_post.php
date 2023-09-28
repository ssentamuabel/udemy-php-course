<?php




if (isset($_GET['p_id'])) {

    $the_post_id = $_GET['p_id'];

  

    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
    $post_query = mysqli_query($connection, $query);


    while ($row = mysqli_fetch_assoc($post_query)) {

        $post_author = $row['post_author'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];

?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?php echo $post_title ?>" class="form-control" name="title">
    </div>
    <div class="form-group">
        <select  class="form-control" name="post_category_id" id ="">


        <?php 
        
        $query = "SELECT * FROM categories";

        $category_query = mysqli_query($connection, $query);

        confirm($category_query);

        
        while ($row = mysqli_fetch_assoc($category_query))
        {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<option value ='{$cat_id}' id=''>{$cat_title} </option>";
        }
        
        ?>
            
        </select>
    </div>


    <div class="form-group">
        <label for="title">Author</label>
        <select class="form-control" name="author" id="">
            <option value="<?php  echo$post_author; ?>"><?php  echo$post_author; ?></option>
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
    <!-- <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" value="<?php  echo $post_author ?>" class="form-control" name="author">
    </div> -->

    <div class="form-group">
        <select class="form-control" name="post_status" id ="">

            <option value="<?php echo $post_status ?>" id =""><?php echo $post_status ?></option>

            <?php 
            
            if ($post_status == 'Publish')
            {
                echo "<option value='draft' id =''>Draft</option>";
            }else
            {
                echo "<option value='Publish' id =''>Publish</option>";
            }
            
            ?>

        </select>
    </div>


    <!-- <div class="form-group">
        <label for="title">Post Status</label>
        <input type="text" value="<?php echo $post_status ?>" class="form-control" name="post_status">
    </div> -->
    <div class="form-group">
        <img width = "100" src="../images/<?php  echo $post_image ?>" />
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="title">Post Tags</label>
        <input type="text" value="<?php  echo $post_tags ?>" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" id="summernote" cols="30" rows="10" name="post_content"><?php echo $post_content ?></textarea>
    </div>
    <div class="form-group">
        <label for="title">Post Status</label>
        <input type="submit" class="btn btn-primary" value="Publish post" name="update_post">
    </div>
</form>

<?php }
}




if (isset($_POST['update_post']))
{
    $post_title = escape($_POST['title']);
    $post_author = escape($_POST['author']);
    $post_category_id = escape($_POST['post_category_id']);    
    $post_status = escape($_POST['post_status']);

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
  
   move_uploaded_file($post_image_temp, "../images/$post_image");

   if (empty($post_image))
   {
    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
    $select_image = mysqli_query($connection,$query);

    while ($row = mysqli_fetch_array($select_image))
    {
        $post_image = $row['post_image'];
    }
   }


   // Update query
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date  = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
   $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE  post_id  =  {$the_post_id}";


    $update_query = mysqli_query($connection, $query);

    confirm($update_query);



    echo "<p class='bg-success'> 
                Post Updated 
                <a href='../post.php?p_id={$the_post_id}'>View Post</a> 
                or 
                <a href='posts.php'>Back to Posts</a></p>";

    

    

}


?>

<?php

if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $selected_post_id) {
        $bulk_options = $_POST['bulk_options'];


        switch ($bulk_options) {
            case 'published':

                $query = "UPDATE posts SET post_status = 'Publish' WHERE post_id = '{$selected_post_id}'";

                $publish_query = mysqli_query($connection, $query);
                confirm($publish_query);

                break;
            case 'draft':

                $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = '{$selected_post_id}'";

                $draft_query = mysqli_query($connection, $query);
                confirm($draft_query);

                break;
            case 'delete':

                $query = "DELETE  FROM posts  WHERE post_id = '{$selected_post_id}'";

                $delete_query = mysqli_query($connection, $query);
                confirm($delete_query);
                header("Location: posts.php");


                break;
        }
    }
}


?>

<?php include "delete_model.php" ?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4 p-3">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4 p-3">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>



        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>


            <?php



            $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_date, posts.post_image, posts.post_content, posts.post_tags, posts.post_comment_count, posts.post_status, ";
            $query .= "categories.cat_id, categories.cat_title FROM posts  LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";
            $posts_query = mysqli_query($connection, $query);

            confirm($posts_query);


            while ($row = mysqli_fetch_assoc($posts_query)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];



                echo "<tr>";

            ?>
                <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
            <?php
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>"; 
                echo "<td>{$cat_title}</td>";

                echo "<td>{$post_status}</td>";
                echo "<td><img src='../images/{$post_image}' width='100' alt = 'image' /></td>";
                echo "<td>{$post_tags}</td>";

                
                $query = "SELECT * FROM  comments WHERE comment_post_id = {$post_id}";

                $comment_count_query = mysqli_query($connection, $query);

                if (!$comment_count_query)
                {
                    die("QUERY FAILED " . mysqli_error($connection));
                }

                $comment_count = mysqli_num_rows($comment_count_query);
                

                echo "<td><a href='view_post_comments.php?p_id={$post_id}'>{$comment_count}</a></td>";



                echo "<td>{$post_date}</td>";                
                echo "<td><a href='../post.php?p_id={$post_id}'>View </a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a rel ='$post_id' class='delete_link' href='javascript:void(0)'>Delete</a></td>";
               // echo "<td><a onClick = \" javascript: return confirm('Are you sure you want to delete the field'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "</tr>";
            }

            ?>

        </tbody>
    </table>


</form>




<?php


if (isset($_GET['delete'])) {

    if (isset($_SESSION['user_role']) )
    {

        $the_post_id  = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";

        $delete_query = mysqli_query($connection, $query);

        header("Location: posts.php");
    }
    else
    {
        header("Location: ../index.php");
    }
}

?>



<script>
    $(document).ready(function()
    {
        $(".delete_link").on('click', function(){

            var id = $(this).attr("rel");

            var delete_url = "posts.php?delete=" + id + "";

            alert(delete_url);

            $(".model-delete-link").attr("href", delete_url);


            $(".myModal").model('show');

          

            
        });
    });
</script>




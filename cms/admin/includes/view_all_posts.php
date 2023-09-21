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
            <a href="add_post.php" class="btn btn-primary">Add New</a>
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
                <th>Dates</th>
            </tr>
        </thead>
        <tbody>


            <?php

            $query = "SELECT * FROM posts";
            $posts_query = mysqli_query($connection, $query);

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



                echo "<tr>";

            ?>
                <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
            <?php
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>";



                $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                $selected_categories = mysqli_query($connection, $query);

                confirm($selected_categories);

                while ($row = mysqli_fetch_assoc($selected_categories)) {
                    $cat_title = $row['cat_title'];
                    echo "<td>{$cat_title}</td>";
                }




                echo "<td>{$post_status}</td>";
                echo "<td><img src='../images/{$post_image}' width='100' alt = 'image' /></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comment_count}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a href='posts.php?delete={$post_id}'>Delete Post</a></td>";
                echo "</tr>";
            }

            ?>

        </tbody>
    </table>


</form>


<?php


if (isset($_GET['delete'])) {
    $the_post_id  = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";

    $delete_query = mysqli_query($connection, $query);

    header("Location: posts.php");
}

?>
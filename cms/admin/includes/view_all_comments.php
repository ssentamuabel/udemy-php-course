<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>


        <?php

        $query = "SELECT * FROM comments";
        $comments_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($comments_query)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
          

       

            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";

            

            // $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
            // $selected_categories = mysqli_query($connection, $query);

            // confirm($selected_categories);

            // while ($row = mysqli_fetch_assoc($selected_categories))
            // {
            //     $cat_title = $row['cat_title'];
            //     echo "<td>{$cat_title}</td>";
            // }

           


            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";

            $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
            $post_comment_query = mysqli_query($connection, $query);

            if (!$post_comment_query)
            {
                die("QUERY FAILED " . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($post_comment_query))
            {
                echo "<td><a href='../post.php?p_id={$row['post_id']}'>{$row['post_title']}</a></td>";
            }


            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
            echo "<td><a href='comments.php?delete={$comment_id}'>Delete Comment</a></td>";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>


<?php 

if (isset($_GET['approve']))
{
    $query= "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$_GET['approve']}";

    $approve_query = mysqli_query($connection, $query);
    if (!$approve_query)
    {
        die("QUERY FAILED ". mysqli_error($connection));
    }
    header("Location: comments.php");
}


if (isset($_GET['unapprove']))
{
    $query= "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$_GET['unapprove']}";

    $unapprove_query = mysqli_query($connection, $query);
    if (!$unapprove_query)
    {
        die("QUERY FAILED ". mysqli_error($connection));
    }

    header("Location: comments.php");
}


if (isset($_GET['delete']))
{
    $the_comment_id  = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";

    $delete_query = mysqli_query($connection, $query);

    if (!$delete_query)
    {
        die("QUERY FAILED " . mysqli_error($connecton));
    }

    header("Location: comments.php");

    
}

?>
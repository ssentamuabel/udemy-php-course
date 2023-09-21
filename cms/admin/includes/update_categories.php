<?php
// EDIT THE CATEGORY
if (isset($_GET['edit'])) {
    $cat_edit = $_GET['edit'];

    $query = "SELECT * FROM categories WHERE cat_id = {$cat_edit}";

    $edit_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($edit_query)) {
        $cat_id = $row['cat_id'];


?>
        <form action="" method="post">
            <div class="form-group">
                <label for="cat-title">Category</label>

                <input class="form-control" type="text" value="<?php if (isset($_GET['edit'])) {
                                                                    echo $row['cat_title'];
                                                                } ?> " name="cat-title">

            <?php }

        // UPDATE DATABASE
        if (isset($_POST['update'])) {

            $form_value = $_POST['cat-title'];
            $query = "UPDATE categories SET cat_title =  '{$form_value}' WHERE cat_id={$cat_id}";

            $update_query = mysqli_query($connection, $query);

            if (!$update_query) {
                die("Query Failed " . mysqli_error($connection));
            }
        }

            ?>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update" value="Update">
            </div>
        </form>
    <?php  } ?>
<?php include "includes/admin_header.php" ?>





<div id="wrapper">

    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">
            <h1>
                Welcome to Admin
                <small>authour</small>
            </h1>
            <?php

            if (isset($_GET['source'])) {
                $source = $_GET['source'];
            } else {
                $source = '';
            }

            switch ($source) {
                case 'add_user':
                    include "includes/add_user.php";
                    break;
                case 'edit_user':
                    include "includes/edit_user.php";
                    break;
                case '39':
                    echo "NICE 39";
                    break;
                default:
                    include "includes/view_all_users.php";
            }


            ?>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>
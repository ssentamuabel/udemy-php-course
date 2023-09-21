<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

    <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>

                        <?php insert(); ?>
                        

                        // DELETE THE CATEGORY
                       <?php delete_category() ?>
 

                        <div class="col-xs-6">
                            <form action ="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Category</label>
                                    <input class="form-control" type="text"  name="cat-title">
                                </div>
                                <div class="form-group">
                                    <input  class="btn btn-primary" type="submit"  name="submit" value="Add Category">
                                </div>
                            </form>
                           
                                   <?php include "includes/update_categories.php" ?>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>Id</td>
                                        <td>Category Title</td>
                                        <td>EDIT</td>
                                        <td>DELETE</td>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php getAllCategories(); ?>                          
                                    
                                </tbody>
                            </table>
                        </div>




                     
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>

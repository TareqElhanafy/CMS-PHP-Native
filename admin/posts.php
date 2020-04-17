
<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->

        <?php include "includes/admin_nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>Author</small>
                       </h1>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
<?php

if (isset($_GET['source'])) {

$source=$_GET['source'];
switch ($source) {
  case 'view':
    include 'includes/view_all_posts.php';
    break ;

    case 'add':
      include 'includes/add_post.php';
      break;
      case 'edit':
        include 'includes/edit_post.php';
        break;
  default:
  include 'includes/view_all_posts.php';
    break;
}




} ?>




        </div>
        <!-- /#page-wrapper -->

    </div>
    <?php include "includes/admin_footer.php" ?>

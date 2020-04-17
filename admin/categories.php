
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
                            Welcom To Admin
                            <small>Author</small>
 </h1>

<div class="col-xs-6">
<?php
if (isset($_POST['submit'])) {
  $addedCategory=$_POST['cat_title'];
  $query="INSERT INTO category ";
  $query.="(cat_title) VALUES ('$addedCategory') ";
  $selected_query=mysqli_query($connction,$query);
  if (!$selected_query) {
    die("failed".mysqli_error($connection));
  }

}





 ?>


  <form class="" action="" method="post">
    <div class="form-group">
      <label for="cat">Add Category</label>
      <input type="text"class="form-control" name="cat_title">
    </div>
    <div class="form-group">
      <input type="submit" name="submit"  class="btn btn-primary" value="Add">
    </div>
  </form>

  <form class="" action="" method="post">
    <?php
    if (isset($_GET['edit'])) {
      $edited=$_GET['edit'];
      $query="SELECT * FROM category WHERE cat_id=$edited";
      $selected_query=mysqli_query($connction,$query);
      while ($row=mysqli_fetch_assoc($selected_query)) {
        $cat_id=$row['cat_id'];
        $cat_title=$row['cat_title'];
        ?>
        <div class="form-group">
          <label for="cat">Edit Category</label>
          <input type="text"class="form-control" value='<?php echo $cat_title; ?>' name="cat_title">
        </div>
        <div class="form-group">
          <input type="submit" name="update_cat"  class="btn btn-primary" value="Update">
        </div>
        </form>






<?php }} ?>
<?php
if (isset($_POST['update_cat'])) {
  $updatedCat=$_POST['cat_title'];
  $query="UPDATE category SET cat_title='$updatedCat' WHERE cat_id=$cat_id";
  $selected_query=mysqli_query($connction,$query);
// if ($selected_query) {
//   echo "ok";
// }else {
//   die("f".mysqli_error($connction));
// }
header("location:categories.php");
}

 ?>
</div>




<div class="col-xs-6">


  <table class="table table-bordered table-hover">
    <thead>
      <th>Id</th>
      <th>Category Title</th>
    </thead>
    <?php
    $query="SELECT * FROM category";
    $selected_query=mysqli_query($connction,$query);
    while ($row=mysqli_fetch_assoc($selected_query)) {
      $id_number=$row['cat_id'];
      $cat_title=$row['cat_title'];
      ?>
    <tbody>
      <tr>
        <td><?php echo $id_number; ?></td>
        <td><?php echo $cat_title; ?></td>
        <td><a href="categories.php?delete=<?php echo $id_number; ?>">Delete</a></td>
        <td><a href="categories.php?edit=<?php echo $id_number; ?>">Edit</a></td>
      </tr>
    </tbody>
    <?php } ?>
    <?php
    if (isset($_GET['delete'])) {
      $deleted=$_GET['delete'];
      $query="DELETE FROM category WHERE cat_id=$deleted";
       $selected_deleted_query=mysqli_query($connction,$query);
header('location:categories.php');
    }

     ?>
  </table>
</div>





                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <?php include "includes/admin_footer.php" ?>

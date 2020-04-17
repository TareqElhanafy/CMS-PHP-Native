<?php include 'includes/db.php'; ?>

<?php include 'includes/header.php'; ?>

    <!-- Navigation -->
  <?php include "includes/nav.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


<?php
if (isset($_GET['c_id'])) {
  $selected_cat_id= $_GET['c_id'];
}

  $query="SELECT * FROM posts WHERE post_cat_id=$selected_cat_id";
  $selected_query_cat=mysqli_query($connction,$query);
  while ($row=mysqli_fetch_assoc($selected_query_cat)) {
    $post_id=$row['post_id'];
    $post_title=$row['post_title'];
    $post_content=$row['post_content'];
    $post_author=$row['post_author'];
    $post_date=$row['post_date'];
    $post_image=$row['post_image'];


?>

<h1 class="page-header">
    Page Heading
    <small>Secondary Text</small>
</h1>

<!-- First Blog Post -->
<h2>
    <a href="post.php"><?php echo $post_title; ?></a>
</h2>
<p class="lead">
    by <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
<hr>
<img class="img-responsive" href="post.php?p_id=<?php echo $post_id; ?>" src="<?php echo'images/'.$post_image ?>" alt="">
<hr>
<p><?php echo $post_content; ?>.</p>
<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>



<?php } ?>






            </div>

            <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
      <?php include "includes/footer.php" ?>

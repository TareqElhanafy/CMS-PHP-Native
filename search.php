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


if(isset($_POST['submit'])){

  $search=$_POST['search'];
  $query="SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
$selected_query=mysqli_query($connction,$query);
if (!$selected_query) {
  die ("failed". mysqli_error($connction));
}else {
  while ($row=mysqli_fetch_assoc($selected_query)) {
    $post_id=$row['post_id'];
    $post_title=$row['post_title'];
    $post_content=$row['post_content'];
    $post_author=$row['post_author'];
    $post_date=$row['post_date'];
  }
}


}

 ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p><?php echo $post_content; ?>.</p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>"">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>


            </div>

            <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
      <?php include "includes/footer.php" ?>

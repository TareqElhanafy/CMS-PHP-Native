
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
if (isset($_GET['p_id'])) {
  $selected_post_id=$_GET['p_id'];
$query="UPDATE posts SET  post_view=post_view+1 WHERE post_id=$selected_post_id ";
$selected_view_query=mysqli_query($connction,$query);

  $query="SELECT * FROM posts WHERE post_id=$selected_post_id";
  $selected_query=mysqli_query($connction,$query);
  while ($row=mysqli_fetch_assoc($selected_query)) {
    $post_title=$row['post_title'];
    $post_content=$row['post_content'];
    $post_author=$row['post_author'];
    $post_date=$row['post_date'];
    $post_image=$row['post_image'];
}

?>

<h1 class="page-header">
    Page Heading
    <small>Secondary Text</small>
</h1>

<!-- First Blog Post -->
<h2>
    <a href=""><?php echo $post_title; ?></a>
</h2>
<p class="lead">
    by <a href="userpost.php?p_au=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
<hr>
<img class="img-responsive" src="<?php echo'images/'.$post_image ?>" alt="">
<hr>
<p><?php echo $post_content; ?>.</p>
<hr>
<div class="row">
  <h1><a href="" class="glyphicon glyphicon-thumbs-up pull-right like">Like</a></h1>
</div>
<br>
<div class="">
<h1 class="pull-right">likes: 10</h1>
</div>



<?php } ?>
<!-- Blog Comments -->
<br>
<br>
<br>

<?php
if (isset($_POST['submit'])) {

  $author_name=$_POST['comment_author'];
  $author_email=$_POST['comment_email'];
  $comment=$_POST['comment_content'];
  $comment_date=date('d-m-y');
  $comment_post_id=$selected_post_id;
  if (empty($author_name)&&empty($author_email)&&empty($comment)) {
    echo "<script> alert(' Faild. You should write your comment first')</script>";
  }else {
    $query_comment="INSERT INTO comments (comment_author , comment_email, comment_content, comment_date, comment_post_id)";
    $query_comment.=" VALUES ('$author_name', '$author_email', '$comment',now(),$comment_post_id) ";
    $selected_comment_query=mysqli_query($connction,$query_comment);
    if (!$selected_comment_query) {
      die("f".mysqli_error($connection));
    }
    $query="UPDATE posts SET post_comment_count=post_comment_count+1 WHERE post_id=$selected_post_id ";
    $selected_comment_count=mysqli_query($connction,$query);
  }




}





 ?>


<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    <form role="form" action="" method="post">
        <div class="form-group">
          <label for="Author">Author</label>
      <input type="text" name="comment_author" class="form-control" value="">
    </div>
        <div class="form-group">
          <label for="email">Email</label>

     <input type="email" name="comment_email" class="form-control"value="">
 </div>
        <div class="form-group">
          <label for="comment">Your Comment</label>

            <textarea class="form-control" id="body" rows="3" class="form-control" name="comment_content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit" >Creat Comment</button>
    </form>
</div>

<hr>

<!-- Posted Comments -->
<?php
$query="SELECT * FROM comments WHERE comment_post_id=$selected_post_id ";
$query.="AND comment_status='approved' ";
$query.="ORDER BY comment_id DESC ";
$selected_comment_query=mysqli_query($connction,$query);
while ($row=mysqli_fetch_assoc($selected_comment_query)) {

$comment_id=$row['comment_id'];
$comment_author=$row['comment_author'];
$comment_content=$row['comment_content'];
$comment_date=$row['comment_date'];
?>
<!-- Comment -->
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><?php echo $comment_author; ?>
            <small><?php echo $comment_date; ?></small>
        </h4>
       <?php echo $comment_content; ?>
    </div>
</div>
<?php }
?>









            </div>

            <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
      <?php include "includes/footer.php" ?>

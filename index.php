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
if(isset($_GET['page'])){
  $page=$_GET['page'];
}else {
  $page="";
}
if ($page=="" || $page==1) {
  $currentPage=0;
}else {
  $currentPage=($page*5)-5;
}


 ?>
<?php
if (isset($_SESSION['role'])&&$_SESSION['role']==='Admin') {
  $query="SELECT * FROM posts ";

}else {
$query="SELECT * FROM posts WHERE post_status='publish' ";

}


$selected_Pager_query=mysqli_query($connction,$query);
$count=mysqli_num_rows($selected_Pager_query);
$count=ceil($count/5);

if($_SESSION['role']){
  $query=$query." LIMIT $currentPage,5 ";
$selected_query=mysqli_query($connction,$query);
while ($row=mysqli_fetch_assoc($selected_query)) {
  $post_id=$row['post_id'];
  $post_title=$row['post_title'];
  $post_content=$row['post_content'];
  $post_author=$row['post_author'];
  $post_date=$row['post_date'];
  $post_image=$row['post_image'];
  $post_status=$row['post_status'];
  // if ($post_status=='publish') {


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
    by <a href="userpost.php?p_au=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
<hr>
<a href="post.php?p_id=<?php echo $post_id; ?>">
<img class="img-responsive" href="post.php?p_id=<?php echo $post_id; ?>" src="<?php echo'images/'.$post_image ?>" alt="">
</a>
<hr>
<p><?php echo $post_content; ?>.</p>
<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>



<?php } }?>






            </div>

            <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        <ul class="pager">
          <?php
           for ($i=1; $i <$count ; $i++) {

             if ($i==$page) {
                 echo "<li><a class='active_link' href='index.php?page=$i'>$i</a></li>";
             }else {
            echo "<li><a href='index.php?page=$i'>$i</a></li>";
          }
        }
          ?>
        </ul>
        <!-- Footer -->
      <?php include "includes/footer.php" ?>





<table class="table table-bordered table-hover">
  <thead>
    <th>Id</th>
    <th>Author</th>
    <th>Content</th>
    <th>In Respose to</th>
    <th>Status</th>
    <th>Email</th>
    <th>Date</th>
    <th>Approve</th>
    <th>Unapprove</th>
    <th>Delete</th>

  </thead>
  <tbody>
<?php
$query="SELECT * FROM comments ";
$selected_query=mysqli_query($connction,$query);
while ($row=mysqli_fetch_assoc($selected_query)) {

$comment_id=$row['comment_id'];
$comment_author=$row['comment_author'];
$comment_content=$row['comment_content'];
$comment_post_id=$row['comment_post_id'];
$comment_status=$row['comment_status'];
$comment_email=$row['comment_email'];
$comment_date=$row['comment_date'];

?>

  <tr>
    <td><?php echo $comment_id ; ?></td>
    <td><?php echo $comment_author ; ?></td>
    <td><?php echo $comment_content; ?></td>
    <?php
    $query_post="SELECT * FROM posts WHERE post_id=$comment_post_id ";
    $selectedpost_id=mysqli_query($connction,$query_post);
    while ($row=mysqli_fetch_assoc($selectedpost_id)) {
      $post_id=$row['post_id'];
      $post_title=$row['post_title'];
    }
  ?>
    <td><a href="../post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></td>
    <td><?php echo $comment_status; ?></td>
    <td><?php echo $comment_email ; ?></td>
    <td><?php echo $comment_date; ?></td>
    <td><a href="comments.php?delete=<?php echo $comment_id; ?>">Delete</a></td>
      <td><a href="comments.php?approve=<?php echo $comment_id; ?>">Approve</a></td>
        <td><a href="comments.php?unapprove=<?php echo $comment_id; ?>">Unapprove</a></td>
  
  </tr>

<?php } ?>
</tbody>
</table>


<?php
if(isset($_GET['approve'])){
$approved=$_GET['approve'];
$query="UPDATE comments SET comment_status='approved'WHERE comment_id=$comment_id ";
$selected_approved_query=mysqli_query($connction,$query);
header("location:comments.php");
if (!$selected_query) {
  die("f".mysqli_error($connction));
}
}
if(isset($_GET['unapprove'])){
$approved=$_GET['unapprove'];
$query="UPDATE comments SET comment_status='unapproved'WHERE comment_id=$comment_id ";
$selected_unapproved_query=mysqli_query($connction,$query);
header("location:comments.php");
if (!$selected_query) {
  die("f".mysqli_error($connction));
}

}
if(isset($_GET['delete'])){
$deleted=$_GET['delete'];
$query="DELETE FROM comments WHERE comment_id=$deleted";
$selected_query=mysqli_query($connction,$query);
header("location:comments.php");
if (!$selected_query) {
  die("f".mysqli_error($connction));
}


}

 ?>

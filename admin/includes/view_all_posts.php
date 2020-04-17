<?php

if (isset($_POST['checkbox'])) {

foreach ($_POST['checkbox'] as  $checkedvalue) {

  $bulkValue=$_POST['bulkvalue'];

  switch ($bulkValue) {
    case 'publish':
      $query="UPDATE posts SET post_status='$bulkValue' WHERE post_id=$checkedvalue";
      $selected_published_query=mysqli_query($connction,$query);
      break;
      case 'unpublish':
        $query="UPDATE posts SET post_status='$bulkValue' WHERE post_id=$checkedvalue";
        $selected_unpublished_query=mysqli_query($connction,$query);
        break;
        case 'draft':
          $query="UPDATE posts SET post_status='$bulkValue' WHERE post_id=$checkedvalue";
          $selected_drafteded_query=mysqli_query($connction,$query);
          break;
          case 'clone':
          $query="SELECT * FROM posts WHERE post_id=$checkedvalue ";
          $selected_query=mysqli_query($connction,$query);
          while ($row=mysqli_fetch_assoc($selected_query)) {

          $post_id=$row['post_id'];
          $post_author=$row['post_author'];
          $post_title=$row['post_title'];
          $post_category=$row['post_cat_id'];
          $post_status=$row['post_status'];
          $post_image=$row['post_image'];
          $post_tags=$row['post_tags'];
          $post_comments=$row['post_comment_count'];
          $post_date=$row['post_date'];
          $post_content=$row['post_content'];

        }
        $query="INSERT INTO posts  (post_title, post_cat_id , post_author , post_status , post_image , post_tags , post_content , post_date) ";
        $query.=" VALUES ('$post_title','$post_category','$post_author','$post_status','$post_image','$post_tags','$post_content',now()) ";
        $selected_query=mysqli_query($connction,$query);
        if (!$selected_query) {
          die("f".mysqli_error($connction));
        }else {
          header("location:posts.php?source=view");
        }
            break;

  }
}
}


 ?>




<form class="" action="" method="post">

<table class="table table-bordered table-hover">
<div class="col-xs-4" id="bulkoption">
  <select class="form-control" name="bulkvalue">
    <option value="">Select Option</option>
    <option value="publish">publish</option>
    <option value="unpublish">unpublish</option>
    <option value="draft">draft</option>
    <option value="clone">Clone</option>
  </select>
</div>
<div class="col-xs-4">
  <input type="submit" class="btn btn-success"name="submit" value="Apply">
  <a href="posts.php?source=add" class="btn btn-primary" >Add new</a>
</div>
<br>
<br>


  <thead>
    <th><input type="checkbox" id="sellectAllboxes" /></th>
    <th>Id</th>
    <th>Author</th>
    <th>Title</th>
    <th>Content</th>
    <th>Category</th>
    <th>Status</th>
    <th>Image</th>
    <th>Tags</th>
    <th>Comments</th>
    <th>Views</th>
    <th>Date</th>
    <th>Reset Views</th>

  </thead>
  <tbody>
<?php
$query="SELECT * FROM posts ORDER BY post_id DESC ";
$selected_query=mysqli_query($connction,$query);
while ($row=mysqli_fetch_assoc($selected_query)) {

$post_id=$row['post_id'];
$post_author=$row['post_author'];
$post_title=$row['post_title'];
$post_category=$row['post_cat_id'];
$post_status=$row['post_status'];
$post_image=$row['post_image'];
$post_tags=$row['post_tags'];
$post_comments=$row['post_comment_count'];
$post_date=$row['post_date'];
$post_content=$row['post_content'];
$post_view=$row['post_view'];
?>

  <tr>
    <td><input type="checkbox" name="checkbox[]" class="checkBoxes" value="<?php echo $post_id; ?>"/></td>
    <td><?php echo $post_id ; ?></td>
    <td><?php echo $post_author ; ?></td>
    <td><?php echo $post_title ; ?></td>
    <td><?php echo $post_content ; ?></td>
    <?php
    $query="SELECT * FROM category WHERE cat_id=$post_category";
    $selected_query_cat=mysqli_query($connction,$query);
    while ($row=mysqli_fetch_assoc($selected_query_cat)) {
      $id_number=$row['cat_id'];
      $cat_title=$row['cat_title'];
}
      ?>
    <td><?php echo $cat_title ; ?></td>
    <td><?php echo $post_status ; ?></td>
    <td><img class="img-responsive" width=200  src= "<?php echo'../images/'.$post_image ;?>" alt="images"/></td>
    <td><?php echo $post_tags ; ?></td>
    <td><?php echo $post_comments ; ?></td>
    <td><?php echo $post_view ; ?></td>
    <td><?php echo $post_date ; ?></td>
    <td><a href="posts.php?source=view&v_id=<?php echo $post_id; ?>">Reset</a></td>
    <td><a href="../post.php?p_id=<?php echo $post_id; ?>">View Post</a></td>
    <td><a href="posts.php?source=view&delete=<?php echo $post_id; ?>">Delete</a></td>
    <td><a href="posts.php?source=edit&p_id=<?php echo $post_id; ?>">Edit</a></td>
  </tr>

<?php } ?>
</tbody>
</table>
</form>

<?php
if(isset($_GET['delete'])){
$deleted=$_GET['delete'];
$query="DELETE FROM posts WHERE post_id=$deleted";
$selected_query=mysqli_query($connction,$query);
if (!$selected_query) {
  die("f".mysqli_error($connction));
}
header("location:posts.php?source=view");


}

if (isset($_GET['v_id'])) {
  $reseted=$_GET['v_id'];
  $query="UPDATE posts SET post_view=0 WHERE post_id=$reseted ";
  $selected_reseted_query=mysqli_query($connction,$query);
  header("location:posts.php?source=view");
}
 ?>

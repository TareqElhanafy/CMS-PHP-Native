<?php
if (isset($_POST['submit'])) {
  $title=$_POST['title'];
  $cat_id=$_POST['post_cat_id'];
  $name=$_POST['name'];
  $status=$_POST['posts_status'];
  $image=$_FILES['image']['name'];
  $image_temp=$_FILES['image']['tmp_name'];
  $tag=$_POST['tag'];
  $content=$_POST['content'];
  $post_date=date('d-m-y');
  move_uploaded_file($image_temp,"../images/$image");
  $query="INSERT INTO posts  (post_title, post_cat_id , post_author , post_status , post_image , post_tags , post_content , post_date) ";
  $query.=" VALUES ('$title','$cat_id','$name','$status','$image','$tag','$content',now()) ";
  $selected_query=mysqli_query($connction,$query);
  if (!$selected_query) {
    die("f".mysqli_error($connction));
  }else {
    header("location:posts.php?source=view");
  }
}






 ?>



<form class="" action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" name="title" class="form-control">
  </div>
  <div class="form-group">
    <select  class="form-control" name="post_cat_id">
<?php
$query="SELECT * FROM category";
$selected_query=mysqli_query($connction,$query);
while ($row=mysqli_fetch_assoc($selected_query)) {
  $id_number=$row['cat_id'];
  $cat_title=$row['cat_title'];
  ?>
    <option value="<?php echo $id_number; ?>"> <?php echo $cat_title; ?></option>
<?php }
 ?>
    </select>
  </div>
  <div class="form-group">
    <label for="title">Author Name</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="form-group">
    <label for="title">Post Status</label>
    <select class="form-control" name="posts_status">
      <option value="publish">Publish</option>
      <option value="unpublish">unpublish</option>
      <option value="draft">draft</option>
    </select>
  </div>
  <div class="form-group">
    <label for="title">Post Image</label>
    <input type="file" name="image" class="form-control">
  </div>
  <div class="form-group">
    <label for="title">Post Tags</label>
    <input type="text" name="tag" class="form-control">
  </div>
  <div class="form-group">
    <label for="title">Post Content</label>
  <textarea class="form-control" id="body" name="content" rows="10" cols="80"></textarea>
  </div>
  <div class="form-group">

<input type="submit" class="btn btn-primary"name="submit" value="Creat Post">
  </div>
</form>

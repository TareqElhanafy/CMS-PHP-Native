<?php

if(isset($_GET['p_id'])){
$edited=$_GET['p_id'];
$query="SELECT * FROM posts WHERE post_id=$edited ";
$selected_query=mysqli_query($connction,$query);
while ($row=mysqli_fetch_assoc($selected_query)) {
  $post_author=$row['post_author'];
  $post_title=$row['post_title'];
  $post_category=$row['post_cat_id'];
  $post_status=$row['post_status'];
  $post_image=$row['post_image'];
  $post_tags=$row['post_tags'];
  $post_content=$row['post_content'];

}
}
 ?>




<?php

if (isset($_POST['submit'])) {
  $image=$_FILES['image']['name'];
  $image_temp=$_FILES['image']['tmp_name'];
  $title=$_POST['title'];
  $cat_id=$_POST['post_cat_id'];
  $name=$_POST['name'];
  $status=$_POST['postStatus'];
  $tag=$_POST['tag'];
  $content=$_POST['content'];
  $post_date=date('d-m-y');
  if (empty($image)) {
    $query="SELECT * FROM posts WHERE post_id=$edited ";
    $selected_image_query=mysqli_query($connction,$query);
    while ($row=mysqli_fetch_assoc($selected_image_query)) {
      $image=$row['post_image'];
    }
  }
  move_uploaded_file($image_temp,"../images/$image");
  $query="UPDATE posts SET  post_title='$title', ";
  $query.="post_cat_id='$cat_id',";
  $query.="post_author='$name', ";
  $query.="post_status='$status', ";
  $query.="post_image='$image', ";
  $query.="post_tags='$tag', ";
  $query.="post_content='$content', ";
  $query.="post_tags='$tag', ";
  $query.="post_date= now() ";
  $query.=" WHERE post_id=$edited  ";

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
    <input type="text" name="title" class="form-control" value="<?php echo $post_title ;?>" >
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
    <input type="text" name="name" class="form-control" value="<?php echo $post_author; ?>">
  </div>
  <div class="form-group">
    <label for="title">Post Status</label>
    <br>

     <select class="mdb-select md-form btn btn-primary" name="postStatus">
       <option value="<?php echo$post_status; ?>"><?php echo$post_status; ?></option>
       <?php
if ($post_status=='publish') {
  echo " <option value='draft'>draft </option>";
  echo " <option value='unpublish'>unpublish </option>";
}else {
  echo " <option value='publish'>publish </option>";
}
        ?>
     </select>
  </div>
  <div class="form-group">
    <label for="title">Post Image</label>
    <br>
    <img width="100"src="<?php echo "../images/".$post_image; ?>" alt="">
    <br>
    <br>
    <input type="file" name="image" class="form-control" src="<?php echo$post_image; ?>">
  </div>
  <div class="form-group">
    <label for="title">Post Tags</label>
    <input type="text" name="tag" class="form-control" value="<?php  echo$post_tags;?>">
  </div>
  <div class="form-group">
    <label for="title">Post Content</label>
  <textarea class="form-control" id="body" name="content" rows="10" cols="80"   > <?php echo $post_content;?> </textarea>
  </div>
  <script>
      ClassicEditor
          .create( document.querySelector( '#editor' ) )
          .catch( error => {
              console.error( error );
          } );
  </script>
  <div class="form-group">

<input type="submit" class="btn btn-primary"name="submit" value="Update Post">
  </div>
</form>

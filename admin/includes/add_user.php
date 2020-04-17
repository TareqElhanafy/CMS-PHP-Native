<?php
if (isset($_POST['submit'])) {
  $username=$_POST['username'];
  $first_name=$_POST['firstname'];
  $last_name=$_POST['lastname'];
  $image=$_FILES['image']['name'];
  $image_temp=$_FILES['image']['tmp_name'];
  $password=$_POST['password'];
  $useremail=$_POST['useremail'];
  $user_date=date('d-m-y');
  $role=$_POST['role'];
  move_uploaded_file($image_temp,"../images/$image");
  $query="INSERT INTO users  (user_name , user_firstname, user_lastname, user_image , user_password , user_date, user_email , role) ";
  $query.=" VALUES ('$username','$first_name','$last_name','$image','$password', now(),'$useremail','$role' ) ";
  $selected_query=mysqli_query($connction,$query);
  if (!$selected_query) {
    die("f".mysqli_error($connction));
  }else {
    header("location:users.php?source=view");
  }
}






 ?>



<form class="" action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">User Name</label>
    <input type="text" name="username" class="form-control">
  </div>
  <div class="form-group">
    <select class="mdb-select md-form btn btn-primary" name="role">
      <option value="select">Select Role</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>
  <div class="form-group">
    <label for="title">Fitst name</label>
    <input type="text" name="firstname" class="form-control">
  </div>
  <div class="form-group">
    <label for="title">Last name</label>
    <input type="text" name="lastname" class="form-control">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control">
  </div>
  <div class="form-group">
    <label for="title">User Image</label>
    <input type="file" name="image" class="form-control">
  </div>
  <div class="form-group">
    <label for="email">User email</label>
    <input type="email" name="useremail" class="form-control">
  </div>


  <div class="form-group">

<input type="submit" class="btn btn-primary"name="submit" value="Add User">
  </div>
</form>

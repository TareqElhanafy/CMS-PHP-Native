<?php

if(isset($_GET['u_id'])){
$edited=$_GET['u_id'];
$query="SELECT * FROM users WHERE user_id=$edited ";
$selected_query=mysqli_query($connction,$query);
while ($row=mysqli_fetch_assoc($selected_query)) {
  $user_id=$row['user_id'];
  $user_name=$row['user_name'];
  $user_firstname=$row['user_firstname'];
  $user_lastname=$row['user_lastname'];
  $user_email=$row['user_email'];
  $user_image=$row['user_image'];
  $user_date=$row['user_date'];
  $role=$row['role'];
  $password=$row['user_password'];
}

 ?>




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
if (!empty($password)) {
  $query="SELECT * FROM users WHERE user_id=$edited ";
  $selected_pass_query=mysqli_query($connction,$query);
  $row=mysqli_fetch_assoc($selected_pass_query);
  $db_password=$row['user_password'];
}
if ($db_password!=$password) {
  $password=password_hash($password,PASSWORD_BCRYPT,array('cost'=>9));
}

  $query="UPDATE users SET  user_name='$username', ";
  $query.="user_firstname='$first_name',";
  $query.="user_lastname='$last_name', ";
  $query.="user_password='$password', ";
  $query.="user_image='$image', ";
  $query.="user_email='$useremail', ";
  $query.="role='$role', ";
  $query.="user_date= now() ";
  $query.=" WHERE user_id=$edited  ";

$selected_updated_query=mysqli_query($connction,$query);
if (!$selected_query) {
  die("f".mysqli_error($connction));
}else {
  header("location:users.php?source=view");
}
}
}else {
  header("location:../index.php");
}
 ?>





 <form class="" action="" method="post" enctype="multipart/form-data">
   <div class="form-group">
     <label for="title">User Name</label>
     <input type="text" name="username" value="<?php echo $user_name;  ?>" class="form-control">
   </div>
   <div class="form-group">
     <select class="mdb-select md-form btn btn-primary"   name="role">
       <option value="<?php echo $role;  ?>"><?php echo $role;  ?></option>

       <?php
if ($role=='Admin') {
  echo "<option value='subscriber'>Subscriber</option>";

}else {
  echo "<option value='Admin'>Admin</option>";
}
        ?>

     </select>
   </div>
   <div class="form-group">
     <label for="title">Fitst name</label>
     <input type="text" name="firstname" value="<?php echo $user_firstname;  ?>" class="form-control">
   </div>
   <div class="form-group">
     <label for="title">Last name</label>
     <input type="text" name="lastname" value="<?php echo $user_lastname;  ?>" class="form-control">
   </div>
   <div class="form-group">
     <label for="password">Password</label>
     <input type="password" name="password" value="<?php echo $password;  ?>" class="form-control">
   </div>
   <div class="form-group">
     <label for="title">User Image</label>
     <input type="file" name="image" value="<?php echo $user_image;  ?>" class="form-control">
   </div>
   <div class="form-group">
     <label for="email">User email</label>
     <input type="email" name="useremail" value="<?php echo $user_email;  ?>" class="form-control">
   </div>


   <div class="form-group">

 <input type="submit" class="btn btn-primary"name="submit" value="Edit User">
   </div>
 </form>

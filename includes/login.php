<?php include 'db.php'; ?>
<?php  include "../admin/functions.php"; ?>


<?php
if (isset($_POST['submit'])) {
  $user_name=$_POST['username'];
  $password=$_POST['password'];
  global $connction;
  $user_name=mysqli_real_escape_string($connction,$user_name);
  $password=mysqli_real_escape_string($connction,$password);
  $query="SELECT * FROM users WHERE user_name='$user_name' ";
  $selected_query=mysqli_query($connction,$query);
  while ($row=mysqli_fetch_assoc($selected_query)) {
    $db_user_id=$row['user_id'];
    $db_user_name=$row['user_name'];
    $db_user_password=$row['user_password'];
    $db_user_firstname=$row['user_firstname'];
    $db_user_lastname=$row['user_lastname'];
    $db_user_role=$row['role'];

  }


if (password_verify($password,$db_user_password)) {

$_SESSION['username']=$db_user_name;
$_SESSION['password']=$db_user_password;
$_SESSION['firstname']=$db_user_firstname;
$_SESSION['lastname']=$db_user_lastname;
$_SESSION['role']=$db_user_role;

header("location:../admin/index.php");
}else {
  header("location:index.php");
}
}





 ?>

<?php
ob_start();
?>

<?php
function is_admin($username){
global $connction;
$query="SELECT role FROM users WHERE user_name='$username'";
$selected_checked_query=mysqli_query($connction,$query);
$row=mysqli_fetch_assoc($selected_checked_query);
if ($row['role']=='Admin') {
  return true;
}else {
  return false;
}
}

function username_exist($username){
  global $connction;
  $query="SELECT user_name FROM users WHERE user_name='$username'";
  $selected_users_query=mysqli_query($connction,$query);
  $row=mysqli_num_rows($selected_users_query);
  if ($row>0) {
    return true;
  }else {
    return false;
  }

}
function email_exist($useremail){
  global $connction;
  $query="SELECT user_email FROM users WHERE user_email='$useremail'";
  $selected_emails_query=mysqli_query($connction,$query);
  $row=mysqli_num_rows($selected_emails_query);
  if ($row>0) {
    return true;
  }else {
    return false;
  }

}

function register_user($userName,$userEmail,$userPassword){
  global $connction;

    $userName=mysqli_real_escape_string($connction,$userName);
    $userEmail=mysqli_real_escape_string($connction,$userEmail);
    $Password=mysqli_real_escape_string($connction,$userPassword);
  $userPassword=password_hash($userPassword,PASSWORD_BCRYPT,array('cost'=>9));
   $query="INSERT INTO users (user_name , user_password, user_email , role)";
   $query.="VALUES ('$userName','$userPassword','$userEmail','subscriber')";
  $selected_new_user_query=mysqli_query($connction,$query);
  if (!$selected_new_user_query) {
    die("f".mysqli_error($connction));
  }

}

function login_user($user_name,$password){
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

header("location:admin/index.php");
}else {
  header("location:index.php");
}
}

function ifisMethod($method){
  if($_SERVER['REQUEST_METHOD']==strtoupper($method)){
    return true;
  }else {
    return false;
  }
}
function isLoggedIN (){
  if(!isset($_SESSION['role'])){
    return true;
  }
  return false;
}
 ?>

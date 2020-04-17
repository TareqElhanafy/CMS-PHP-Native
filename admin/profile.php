


<?php include "includes/admin_header.php" ?>
<?php
if (isset($_SESSION['username'])) {
$username_session=$_SESSION['username'];
$query="SELECT * FROM users WHERE user_name='$username_session' ";
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
}
 ?>
 <?php

 if (isset($_POST['submit'])) {
   $username=$_POST['username'];
   $first_name=$_POST['firstname'];
   $last_name=$_POST['lastname'];
   $password=$_POST['password'];
   $useremail=$_POST['useremail'];
   $user_date=date('d-m-y');
   $role=$_POST['role'];
   $query="UPDATE users SET  user_name='$username', ";
   $query.="user_firstname='$first_name',";
   $query.="user_lastname='$last_name', ";
   $query.="user_email='$useremail', ";
   $query.="role='$role', ";
   $query.="user_date= now() ";
   $query.=" WHERE user_name='$username_session'  ";

 $selected_updated_query=mysqli_query($connction,$query);
 if (!$selected_query) {
   die("f".mysqli_error($connction));
 }else {
   header("location:users.php?source=view");
 }
 }
?>

    <div id="wrapper">

        <!-- Navigation -->

        <?php include "includes/admin_nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small><?php echo $_SESSION['username']; ?></small>

                    </div>

                     <form class="" action="" method="post" enctype="multipart/form-data">
                       <div class="form-group">
                         <label for="title">User Name</label>
                         <input type="text" name="username" value="<?php echo $user_name;  ?>" class="form-control">
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
                         <label for="email">User email</label>
                         <input type="email" name="useremail" value="<?php echo $user_email;  ?>" class="form-control">
                       </div>


                       <div class="form-group">

                     <input type="submit" class="btn btn-primary"name="submit" value="Edit User">
                       </div>
                     </form>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <?php include "includes/admin_footer.php" ?>

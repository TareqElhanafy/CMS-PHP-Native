<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
if (!isset($_GET['email'])&&!isset($_GET['token'])) {
  header("location:forgot.php");
}else{
$email=$_GET['email'];
$token=$_GET['token'];
$query="SELECT * FROM users WHERE token='$token'";
$selected_query=mysqli_query($connction,$query);
while ($row=mysqli_fetch_assoc($selected_query)) {
  $db_user_resetname=$row['user_name'];
  $db_user_email=$row['user_email'];
  $db_user_token=$row['token'];
}
if ($email!==$db_user_email&&$token!==$db_user_token) {
  header("location:forgot.php");
}else {
  if (isset($_POST['password'])) {
    $newPass=$_POST['password'];
    $confiPass=$_POST['confirmpassword'];
    if ($newPass===$confiPass) {
      $hashedPass=password_hash($newPass,PASSWORD_BCRYPT,array('cost'=>9));
      $query="UPDATE users SET user_password='$hashedPass'";
     $selected_reseted_pass=mysqli_query($connction,$query);
     if (!isset($selected_reseted_pass)) {
       die("f".mysqli_error($connction));
     }
    header("location:login.php");
    }

  }
}
}

 ?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" action="" class="form" method="post">

                                      <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                          <input name="password" type="password" class="form-control" placeholder="Password">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                          <input name="confirmpassword" type="password" class="form-control" placeholder="Confirm Password">
                                        </div>
                                      </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

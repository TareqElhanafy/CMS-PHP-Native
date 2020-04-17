<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require ('vendor/phpmailer/phpmailer/src/PHPMailer.php');
require ('vendor/phpmailer/phpmailer/src/SMTP.php');
require ('vendor/phpmailer/phpmailer/src/Exception.php');
require ('vendor/autoload.php');

?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<?php
if (!ifisMethod('get')&&!isset($_GET['forgot'])) {
  header('location:index.php');
}

if (ifisMethod('post')) {
if(isset($_POST['email'])){
  $Email=$_POST['email'];
  $length=50;
  $token=bin2hex(openssl_random_pseudo_bytes($length));
  if (email_exist($Email)) {
    $query="UPDATE users SET token='$token' WHERE user_email='$Email' ";
   $selected_query=mysqli_query($connction,$query);
   if (!isset($selected_query)) {
     die('f'.mysqli_error($connction));
   }
  }
  $mail =   new PHPMailer();


    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '841f6e066da616';                     // SMTP username
    $mail->Password   = '852c486a329547';                               // SMTP password
    $mail->SMTPSecure = 't';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;
    $mail->CharSet = 'UTF-8';
     $mail->isHTML(true);

     $mail->setFrom('himtoxi@gmail.com.com', 'Mailer');
     $mail->addAddress($Email);
     $mail->Subject = 'Here is the subject';
     $mail->Body    = "<a href='http://localhost/cms/reset.php?email=$Email&token=$token'>http://localhost/cms/reset.php?email=$Email&token=$token</a>";

    if ($mail->send()) {
      $emailsent=true;
  }else {
  header("");
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


<?php if (!isset($emailsent)): ?>


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" action=""  class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <input name="recover-submit" class="btn btn-lg btn-primary btn-block" type="submit" value="Reset Password">

                                        </div>


                                    </form>



                                </div><!-- Body-->
<?php else: ?>
  <h1 class="text-center">Check your Mail</h1>
  <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

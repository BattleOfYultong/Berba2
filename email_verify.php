
<?php

session_start();
@include 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];

    $sqlfetch = "SELECT *FROM admin WHERE email = '$email'";
    $sqlfetchresult = mysqli_query($con, $sqlfetch);

    if($sqlfetchresult && mysqli_num_rows($sqlfetchresult) > 0){
        $row = mysqli_fetch_assoc($sqlfetchresult);
        $name = $row['name'];
        $id = $row['id'];
    }
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        $sql = $con->prepare("SELECT email FROM admin WHERE email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            // Email found, send password reset link
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'tnvsberba@gmail.com '; // Your Gmail email address
                $mail->Password = 'gbwygkybqfgfxvgm'; // Your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('tnvsberba@gmail.com', 'TNVS Berba');
                $mail->addAddress($email); // Use the found email address
                $mail->addReplyTo('tnvsberba@gmail.com','Email Verification TNVS');

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Email Verification';
                $mail->Body = 'Here is your verification link: <a href="http://localhost/berba/register_photo?token=' . urlencode(base64_encode($email)) . '&verifiedmessage=true">Verify Email</a>';

                $mail->send();
                 echo "<script>window.location.href='email_verify.php?register_success1=true';</script>";
            } catch (Exception $e) {
                $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $error = "Email not found";
        }
    }
}
   
}
else{
    echo "<script>window.location.href='login_form.php?error_set=true'</script>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form </title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="css/all.min.css">
    <script src="SweetAlert/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="SweetAlert/sweetalert2.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
</head>
<body>

<div class="wrapper">
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <h1>Verify Your Email</h1>
      
      <div class="input-box">
        <input type="email" name="email" placeholder="Email" >
      </div>

      
      <button type="submit" class="btn">Submit</button>
      <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register now</a></p>
      </div>
    </form>


    
  </div>


                <?php
                    if (isset($_GET['verifiedmessage']) && $_GET['verifiedmessage'] == 'true') {
                            echo "<script>
                                    Swal.fire({
                                    title: 'Verify Email',
                                    text: 'Please verify your $email',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    position: 'top',
                                 });
                                </script>";
                                }
                ?>

                <?php
                    if (isset($_GET['register_success1']) && $_GET['register_success1'] == 'true') {
                            echo "<script>
                                    Swal.fire({
                                    title: 'Please Check your Email',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    position: 'top',
                                 });
                                </script>";
                                }
                ?>
</body>
</html>
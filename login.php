<?php
session_start();
$email = $password = "";
$emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "<center>Email is required!</center>";
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["password"])) {
        $passwordErr = "<center>Password is required!</center>";
    } else {
        $password = $_POST["password"];
    }

    if ($email && $password) {
        include("config.php");
        $check_email = mysqli_query($con, "SELECT * FROM admin WHERE email = '$email'");
        
        if (mysqli_num_rows($check_email) > 0) {
            $row = mysqli_fetch_assoc($check_email);
            $db_password = $row["password"];
            $db_account_type = $row["account_type"];
            
            if ($password == $db_password) {
                if ($db_account_type == "1") {
                    $_SESSION['email'] = $email;
                    echo "<script>window.location.href='admin.php';</script>";
                    exit();
                } else {
                    $_SESSION['email'] = $email;
                    echo "<script>window.location.href='user.php';</script>";
                    exit(); 
                }
            } else {
                $passwordErr = "<center>Password is incorrect!</center>";
            }
        } else {
            $emailErr = "<center>Email is not registered!</center>";
        }
    }
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
      <h1>Login</h1>
      <div class="input-box">
        <input type="email" name="email" placeholder="Email" value="<?php echo $email;?>">
      <br><span class="error"> <?php echo $emailErr; ?> </span>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
       <br><span class="error"> <?php echo $passwordErr; ?>  </span>
      </div>
      
      <button type="submit" class="btn">Submit</button>
      <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register now</a></p>
      </div>
    </form>


    
  </div>
  <?php
                    if (isset($_GET['reg_success']) && $_GET['reg_success'] == 'true') {
                            echo "<script>
                                    Swal.fire({
                                    title: 'Registration Success',
                                    text: 'You can now login',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    position: 'top',
                                 });
                                </script>";
                                }
                ?>

  <script>

  </script>
</body>
</html>
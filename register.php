<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type'];

    $sql = "INSERT INTO admin (name, email, password, account_type) VALUES ('$name', '$email', '$password', $account_type)";

        if($con->query($sql) === TRUE){
           $_SESSION['email'] = $email;
            echo  "<script>window.location.href='email_verify.php?verifiedmessage=true';</script>";
        }
        else{
            echo "error:" .$sql . "br" .$con->error;
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
      <h1>Register</h1>
        <div class="input-box">
        <input type="text" name="name" placeholder="Name" >
      </div>

      <div class="input-box">
        <input type="email" name="email" placeholder="Email" >
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password">
      </div>

       <div class="input-box">
        <select name="account_type" id="">
            <option name="" value="1">ADMIN</option>
            <option name="" value="2">USER</option>
        </select>
      </div>
      
      <button type="submit" class="btn">Submit</button>
      <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register now</a></p>
      </div>
    </form>


    
  </div>


  <script>

  </script>
</body>
</html>
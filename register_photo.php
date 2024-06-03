<?php
include 'config.php';
session_start();

if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];

    $sqlfetch = "SELECT * FROM admin WHERE email = '$email'";
    $sqlfetchresult = mysqli_query($con, $sqlfetch);

    if($sqlfetchresult && mysqli_num_rows($sqlfetchresult) > 0){
        $row = mysqli_fetch_assoc($sqlfetchresult);
        $name = $row['name'];
        $id = $row['id'];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        
        if (!isset($_SESSION['email'])) {
            echo "Session not set";
            exit();
        }
    
        $email = $_SESSION['email'];
    
        $targetDirectory = "Photos/";
        $targetFile = $targetDirectory . basename($_FILES["Photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        $check = getimagesize($_FILES["Photo"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    
        if ($_FILES["Photo"]["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    
        if (!in_array($imageFileType, array("jpg", "png", "jpeg", "gif"))) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            $uniqueFilename = uniqid() . "." . $imageFileType;
            $targetFilePath = $targetDirectory . $uniqueFilename;
    
            if (move_uploaded_file($_FILES["Photo"]["tmp_name"], $targetFilePath)) {
                $updateQuery = "UPDATE admin SET Photo = '$uniqueFilename' WHERE email = '$email'";
                if (mysqli_query($con, $updateQuery)) {
                    echo "<script>window.location.href='login.php?reg_success=true';</script>";
                    exit(); 
                } else {
                    echo "Error updating record: " . mysqli_error($con);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
} else {
    echo "<script>window.location.href='login_form.php?error_set=true'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="css/all.min.css">
  <script src="SweetAlert/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="SweetAlert/sweetalert2.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
</head>
<body>

<div class="wrapper">
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
      <h1>Upload Photo</h1>
      <div class="img-container">
        <img src="css/user_sample.png" id="imagedis" alt="">
        <input name="Photo" id="imgup" type="file" required accept="image/*" onchange="previewPhoto()">
      </div>
      <button type="submit" name="submit" class="btn">Submit</button>
      <div class="register-link">
        <p>Don't have an account? <a href="register.php">Register now</a></p>
      </div>
    </form>
  </div>

<?php
if (isset($_GET['verifiedmessage']) && $_GET['verifiedmessage'] == 'true') {
    echo "<script>
        Swal.fire({
        title: 'Verification Success',
        text: 'Please Upload A Photo',
        icon: 'success',
        showConfirmButton: false,
        position: 'top',
    });
    </script>";
}
?>

<script>
function previewPhoto() {
    const fileInput = document.getElementById('imgup');
    const previewImg = document.getElementById('imagedis');
    const file = fileInput.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewImg.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        previewImg.src = '#';
        previewImg.style.display = 'none';
    }
}
</script>
</body>
</html>

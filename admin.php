<?php
session_start();
include 'config.php';
  if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];

    $sqlfetch = "SELECT *FROM admin WHERE email = '$email'";
    $sqlfetchresult = mysqli_query($con, $sqlfetch);

    if($sqlfetchresult && mysqli_num_rows($sqlfetchresult) > 0){
        $row = mysqli_fetch_assoc($sqlfetchresult);
        $name = $row['name'];
        $id = $row['id'];
       $Photo = "Photos/" . $row['Photo'];

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
  <title>ADMIN! </title>
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
  <link rel="stylesheet" href="admin.css">
</head>

  <div class="main">
            <script>
      function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
      }

      function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
      }     
</script>

</div>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="db.php"><i class="fa fa-dashboard"></i> Dashboard</a>
 <a href="employee.php"><i class="fa fa-users"></i> Employee</a>
  <a href="Leavelist.php"><i class="fa fa-clipboard"></i> Leavelist</a></a>
  <a href="#contact"><i class="fa fa-building"></i> Department</a>
  <a href="#Setting"><i class="fa fa-gear"></i> Settings</a>
  <a href="login.php"><i class="fa fa-arrow-right"></i> Logout</a>
</div>
<body>
 

<div id="main">
  <button class="openbtn" onclick="openNav()">☰ </button>
      <div class="opening">
          <img src="<?php echo "$Photo" ?>" alt="">
          <h1>Welcome <?php echo "$name" ?></h1>
      </div>
      
<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
   
</body>

</html> 

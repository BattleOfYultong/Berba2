<?php
include ('config.php'); 
$sql = "DELETE FROM users WHERE id='" . $_GET["id"] . "'";

$run = mysqli_query($con,$sql);

if($run == true){
			
    echo "<script> 
            alert('User Deleted');
            window.open('leavelist.php','_self');
          </script>";
}else{
    echo "<script> 
    alert('Failed to delete');
    </script>";
}

mysqli_close($con);
?>
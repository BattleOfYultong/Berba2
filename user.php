<?php

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN! </title>
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
  <link rel="stylesheet" href="user.css">
  <link rel="stylesheet" href="users.css">
</head>
</div>
<div class="topnav" id="myTopnav">
<a href="login.php"><i class="fa fa-arrow-right"></i> Logout</a>
 <a href="account.php"><i class="fa fa-users"></i> Manage Account</a>
  <img src="logo.png" alt="Avatar" style="width:70px">
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
<body>

	<section id="sections" class="py-4 mb-4 bg-faded">
		<div class="container">
			<div class="row">
				<div class="col-md"></div>
				<div class="col-md-3">
					<a href="#" class="btn btn-primary btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addPostModal"><i class="fa fa-plus"></i> Apply Leave</a>
				</div>
				<div class="col-md-3">
					<a href="#" class="btn btn-warning btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addCateModal"><i class="fa fa-spinner"></i> Pendings</a>
				</div>
				<div class="col-md-3">
					<a href="#" class="btn btn-success btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addUsertModal"><i class="fa fa-check"></i> Approved Leaves</a>
				</div>
				<div class="col-md"></div>
			</div>
		</div>
	
	</section>
	
	<section id="post">
		<div class="container">
			<div class="row">
			<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Leave Date</th>
								<th>Reason</th>
								<th>Status</th>
							</thead>
							 <tbody>
							 	<?php 
                include('config.php');
                include('connections.php');
									$sql = "SELECT * FROM leaves WHERE email=''";
									$que = mysqli_query($con,$sql);
									$cnt=1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['leavedate']; ?></td>
							 		<td><?php echo $result['leavereason']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
							 				echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			else{
							 				echo "<span class='badge badge-success'>Approved</span>";
							 			}
							 	$cnt++;	}
							 		 ?>
							 		</td>
							 	</tr>

							 </tbody>
						</table>
			</div>
		</div>
	</section>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

	
	

	<div class="modal fade" id="addPostModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<div class="modal-title">
						<h5>Apply Leave</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="form-control-label">Name</label>
							<input type="text" name="name" class="form-control"/>
							<input type="hidden" name="email" value="">
							<label class="form-control-label">Department</label>
							<select name="department" class="form-control" >
								<option value="HR">HR</option>
								<option value="Marketing">Marketing</option>
								<option value="Development">Development</option>
								<option value="IT">IT</option>
								<option value="Accounting">Accounting</option>
								<option value="Finance">Finance</option>
								<option value="Customer Support">Customer Support</option>
							</select>
						</div>
						
						<div class="form-group">
							<label class="form-control-label">Leave Date</label>
							<input type="date" name="leavedate" class="form-control" />
						</div>
						<div class="form-group">
							<label>Reason For Leave</label>
							<textarea name="editor1" class="form-control"></textarea>
						</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" style="border-radius:0%;" data-dismiss="modal">Close</button>
					<input type="hidden" name="status" value="0">
					<input type="submit" class="btn btn-success" style="border-radius:0%;" name="apply"  value="Apply">
				</div>
			</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="addCateModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-warning text-white">
					<div class="modal-title">
						<h5>Pending Leaves</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Leave Date</th>
								<th>Reason</th>
								<th>Status</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM leaves WHERE status = 0 && email=''";
									$que = mysqli_query($con,$sql);
									$cnt=1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['leavedate']; ?></td>
							 		<td><?php echo $result['leavereason']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			else{
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
							 	$cnt++;	}
							 		 ?>
							 		</td>
							 	</tr>

							 </tbody>
						</table>
					
				</div>
				
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="addUsertModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-success text-white">
					<div class="modal-title">
						<h5>Total Approved Leaves</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Leave Date</th>
								<th>Reason</th>
								<th>Status</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM leaves WHERE status = 1 AND email=''";
									$que = mysqli_query($con,$sql);
									$cnt=1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['leavedate']; ?></td>
							 		<td><?php echo $result['leavereason']; ?></td>
							 		<td>
							 			<?php 
							 			if ($result['status'] == 0) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			else{
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
							 	$cnt++;	}
							 		 ?>
							 		</td>
							 	</tr>

							 </tbody>
						</table>
				</div>
				
			</div>
		</div>
	</div>
  
  
  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.9.1/standard/ckeditor.js"></script>
  <script>
	CKEDITOR.replace('editor1');
  </script>

            <script>
    
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
} 
</script>
</body>

</html> 


<?php 
	if (isset($_POST['apply'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$department = $_POST['department'];
		$leavedate = $_POST['leavedate'];
		$editor1 = $_POST['editor1'];
		$status = $_POST['status'];

		$sql = "INSERT INTO leaves(name,email,department,leavedate,leavereason,status)VALUES('$name','$email','$department','$leavedate','$editor1','$status')";

		$run = mysqli_query($con,$sql);

		if($run == true){
			
			echo "<script> 
					alert('Leave Requested, Please wait for approval status');
					window.open('user.php','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Failed To Apply');
			</script>";
		}
	}
	
 ?>
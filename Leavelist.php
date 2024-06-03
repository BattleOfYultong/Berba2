<?php
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="leavelist.css">
<link rel="stylesheet" href="leave.css">
<link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
</head>
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
  <img src="logo.png" alt="Avatar" style="width:100px">
<section id="sections" class="py-4 mb-4 bg-faded">
		<div class="container">
			<div class="row">
				<div class="col-md"></div>
				<div class="col-md-2">
					<a href="#" class="btn btn-warning btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addPostModal"><i class="fa fa-spinner"></i> Pending Leaves</a>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-success btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addCateModal"><i class="fa fa-check"></i> Approved</a>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-primary btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addUsertModal"><i class="fa fa-th"></i> Total Leaves</a>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-danger btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#addEmpModal"><i class="fa fa-users"></i> Add Employees</a>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-info btn-block" style="border-radius:0%;" data-toggle="modal" data-target="#viewEmpModal"><i class="fa fa-eye"></i> View Employees</a>
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
								<th>Date</th>
								<th>Reason</th>
								<th>Status</th>
							</thead>
							 <tbody>
							 	<?php 
                include('config.php');
									$sql = "SELECT * FROM leaves ORDER BY id DESC";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
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
	
	<section id="main-footer" class="text-center text-white bg-inverse mt-4 p-4">
		<div class="container">
			<div class="row">
				<div class="col">
				<p class="lead"></p>
				</div>
			</div>
		</div>
	</section>
	
	
	<div class="modal fade" id="addPostModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-warning text-white">
					<div class="modal-title">
						<h5>Pending</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Date</th>
								<th>Reason</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM leaves WHERE status = 0";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
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
							 				echo "Pending";
							 				?>
							 				</td>
							 		<td>
							 			<form action="accept.php?id=<?php echo $result['id']; ?>" method="POST">
							 				<input type="hidden" name="appid" value="<?php echo $result['id']; ?>">
							 				<input type="submit" class="btn btn-sm btn-success" name="approve" value="Approve">
							 			</form>
							 		</td>
							 				<?php
							 			}
							 			else{
							 				echo "Approved";
							 			}
							 	$cnt++;	}
							 		 ?>
							 		
							 	</tr>

							 </tbody>
						</table>
					
				</div>
				
			</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="addCateModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-success text-white">
					<div class="modal-title">
						<h5>Approved Leaves</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Date</th>
								<th>Reason</th>
								<th>Status</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM leaves WHERE status = 1";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
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
				<div class="modal-header bg-primary text-white">
					<div class="modal-title">
						<h5>Total Leaves</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Date</th>
								<th>Reason</th>
								<th>Status</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM leaves ORDER BY id DESC";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
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


	
	<div class="modal fade" id="addEmpModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<div class="modal-title">
						<h5>Add Employees</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="form-control-label">Name</label>
							<input type="text" name="name" class="form-control" />
							<label class="form-control-label">Department</label>
							<select name="department" class="form-control">
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
							<label class="form-control-label">Email</label>
							<input type="email" name="email" class="form-control" />
						</div>
						<div class="form-group">
							<label class="form-control-label">Password</label>
							<input type="password" name="password" class="form-control" />
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger" style="border-radius:0%;" data-dismiss="modal">Close</button>
						<input type="hidden" name="status" value="0">
						<input type="submit" class="btn btn-success" style="border-radius:0%;" name="adduser"  value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>


	
	<div class="modal fade" id="viewEmpModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-info text-white">
					<div class="modal-title">
						<h5>Employees List</h5>
					</div>
					<button class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
				<table class="table table-bordered table-hover table-striped">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Department</th>
								<th>Email</th>
								<th>Action</th>
							</thead>
							 <tbody>
							 	<?php 
									$sql = "SELECT * FROM users";
									$que = mysqli_query($con,$sql);
									$cnt = 1;
									while ($result = mysqli_fetch_assoc($que)) {
									?>

									
							 	<tr>
									<td><?php echo $cnt;?></td>
							 		<td><?php echo $result['name']; ?></td>
							 		<td><?php echo $result['department']; ?></td>
							 		<td><?php echo $result['email']; ?></td>
									 <td><a href="deletemp.php?id=<?php echo $result["id"]; ?>"><button type="button" class="btn btn-danger" style="border-radius:0%;">Delete</button></a> </td>
							 	</tr>

							 </tbody>
							 <?php $cnt++; }?>
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
<?php 
	if (isset($_POST['adduser'])){
		$name = $_POST['name'];
		$department = $_POST['department'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$password = md5($_POST['password']);


		$sql = "INSERT INTO users(name,department,email,password)VALUES('$name','$department','$email','$password')";

		$run = mysqli_query($con,$sql);

		if($run == true){
			
			echo "<script> 
					alert('User Added');
					window.open('leavelist.php','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Failed');
			</script>";
		}
	}
	
 ?>
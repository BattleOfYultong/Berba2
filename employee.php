<?php
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="emp.css">
<link rel="stylesheet" href="employee.css">
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
  <button class="openbtn" onclick="openNav()">☰ </button> <h2>Types of Leave</h2>
<div class="row">
<div class="col-md-12"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name"> 
<table id="myTable">
  <tr class="header">
    <th style="width:60%;">Type</th>
    <th style="width:40%;">Days</th>
  </tr>
  <tr>
    <td>Sick Leave</td>
    <td>12 days</td>
  </tr>
  <tr>
    <td>Maternity Leave</td>
    <td>135 days</td>
  </tr>
  <tr>
    <td>Annual Leave</td>
    <td>14 days</td>
  </tr>
  <tr>
    <td>Casual Leave</td>
    <td>12 days</td>
  </tr>
  <tr>
    <td>Transfer Leave</td>
    <td>3 days</td>
  </tr>
  <tr>
    <td>Marriage Leave</td>
    <td>15 days</td>
  </tr>
  <tr>
    <td>Holiday Leave</td>
    <td>5 days</td>
  </tr>
  <tr>
    <td>Bereavement Leave</td>
    <td>10 days</td>
  </tr>
</table>
 
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

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
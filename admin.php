
<?php
    include('session.php');

    // if session not logged in OR accountype not admin go to login
    if ($_SESSION["account_type"] !== "Admin") {
        header("Location: login.php");
        die();
    }

    require_once "database.php";

     $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
   
	$sql = "SELECT * FROM `emptbl` WHERE `fname` LIKE '%$search_query%' OR `lname` LIKE '%$search_query%' OR `username` LIKE '%$search_query%' OR `empid` LIKE '%$search_query%' OR `position` LIKE '%$search_query%' OR `department` LIKE '%$search_query%'";
	$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Page</title>
	<link rel="shortcut icon" href="img/team.ico" />
	<link href="css/admin.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">	
</head>

<body>
	<div class="topnav2" >
		<div class="name">
			<span id="n"><strong><?php echo  $_SESSION['fname']; ?> <?php echo  $_SESSION['lname']; ?></strong></span>
			<br>
			<?php echo $_SESSION['account_type']?> |
			<a href="logout.php"  id="out" >Sign out</a>	
		</div>
	</div>
		
	<div class="container">
		<div class="row mt-5 ">
			<div class="col">
				<div class="card mt-5 rounded-0 w-100">				
					<div class="card-header rounded-0" style="background-color: #ff5757;" >		
						<div class="menu2">
							<a href="#" >Manage Account</a> <hr>
							<a href="add_account.php" style="color: #808080;">Create New Account</a> <br>
							<div class="float-right">
							<form action="" method="GET">
				               <input type="text" name="search_query" placeholder="Search" >
				               <button type="submit" >Search</button>
				            </form>
				            </div>
						</div>				
					</div>
								
					<div class="card-body overflow-auto" >			
						<table class="table table-bordered text-center border-dark table-responsive scroll">
							<tr class="text-white" style="background-color:black;">
								<td> <strong>Employee ID</strong> </td>
								<td> <strong>Account Type</strong> </td>
								<td> <strong>Username</strong> </td>
								<td> <strong>Password</strong> </td>
								<td> <strong>First Name</strong> </td>
								<td> <strong>Last Name</strong> </td>										
								<td> <strong>Date Hired</strong> </td>
								<td> <strong>Position</strong> </td>
								<td> <strong>Salary</strong> </td>
								<td> <strong>Department</strong> </td>
								<td> <strong>Update</strong> </td>
								<td> <strong>Delete</strong> </td>
							</tr>
						

							<tr>
							<?php 
							if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_array($result)){
									$empid = $row['empid'];
									$account_type = $row['account_type'];
									$username = $row['username'];
									$password = $row['password'];
									$fname = $row['fname'];
									$lname = $row['lname'];
									$date_hired = $row['date_hired'];
									$position = $row['position'];
									$salary = $row['salary'];
									$department = $row['department'];
									echo '<tr>
									<td>'.$empid.'</td>
									<td>'.$account_type.'</td>
									<td>'.$username.'</td>
									<td>'.$password.'</td>
									<td>'.$fname.'</td>
									<td>'.$lname.'</td>
									<td>'.$date_hired.'</td>
									<td>'.$position.'</td>
									<td>'.$salary.'</td>
									<td>'.$department.'</td>
									<td> <a href="update_account.php?empid='.$empid.'"><img src="img/edit.png" ></i></a></td>
									<td> <a href="delete.php?empid='.$empid.'" ><img src="img/trash.png"></i></a>
									</td>
									</tr>';

							}
                     		}?>
						</table>
					</div>						
				</div>
			</div>
		</div>
	</div>
</body>


</html>
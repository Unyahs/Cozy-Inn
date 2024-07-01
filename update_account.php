<?php 
include('session.php'); 
require('database.php');
$empid = $_GET['empid'];

$sql = "SELECT * FROM emptbl WHERE empid='$empid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$account_type = $row["account_type"];
$fname = $row["fname"];
$lname = $row["lname"];
$date_hired = $row["date_hired"];
$position = $row["position"];
$salary = $row["salary"];
$department = $row["department"];
$username = $row["username"];


if (isset($_POST['update'])) {  
	$account_type = $_POST["account_type"];
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $date_hired = $_POST["date"];
    $position = $_POST["position"];
    $salary = $_POST["salary"];
    $department = $_POST["department"];
    $username = $_POST["username"];

    $sql = "UPDATE emptbl SET empid='$empid', account_type='$account_type', fname='$fname', lname='$lname', date_hired='$date_hired', position='$position', salary='$salary', department='$department', username='$username' WHERE empid='$empid'";
	$result = mysqli_query($conn, $sql);
	if ($result) {
            echo "Updated Successfully";
            header("Location: admin.php");
        }
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/updateaccount.css">
</head>

<script type="text/javascript" src="jsscript/jquery-3.3.1.min.js"> </script>

<script>	
	$(document).ready(function() {
		
		$("#rimg").click(function() {
			location.href= 'admin.php';
		});
	});
</script>

<body>
	<div class="container">
		<div class="header"><h1>Update Account</h1></div>

		<form method="post" autocomplete="off" >
            <div class="form-group">
                <label for="acctype">Account Type:</label>
                <select name="account_type" id="acctype" type="text" class="form-select" label="Choose Account Type" required>
                    <option selected> <?php echo $account_type ;?></option>
                    <option value="Admin">Admin</option>
                    <option value="Employee">Employee</option>    
                </select>
            </div>

            <div class="form-group">
                <label for="firstname">Firstname:</label>
                <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Enter First Name:" value="<?php echo $fname ;?>">
            </div>

            <div class="form-group">
                <label for="lastname">Lastname:</label>
                <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Enter Last Name:" value="<?php echo $lname ;?>">
            </div>

            <div class="form-group">
                <label for="date">Date Hired:</label>
                <input type="date" id="date" class="form-control" name="date" placeholder="Enter Date Hired:" value="<?php echo $date_hired ;?>">
            </div>

            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" id="position" class="form-control" name="position" placeholder="Enter Position:" value="<?php echo $position ;?>">
            </div>

            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" id="salary" class="form-control" name="salary" placeholder="Enter Salary:" value="<?php echo $salary ;?>">
            </div>

            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" id="department" class="form-control" name="department" placeholder="Enter Department:" value="<?php echo $department ;?>">
            </div>

            <div class="form-group">
                <label for="Username">Username:</label>
                <input type="text" id="Username" class="form-control" name="username" placeholder="Enter a Username:" value="<?php echo $username ;?>">
            </div>


			<input type="submit" name="update" value="Update" class="button btn-block">

        </form>
	</div>
</body>
</html>
	
				
<?php include('session.php');

require("database.php");
$id = $_GET['proj_id'];
 
$sql = "DELETE FROM projects_tbl WHERE proj_id='$id'";
$result = mysqli_query($conn, "DELETE FROM projects_tbl WHERE proj_id='$id'");

if ($result) {
	echo "Deleted Successfully";
	header("Location: employee_page.php");
}
else{
	die(mysqli_error($conn));
}
 

exit;
?>

<?php

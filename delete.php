<?php include('session.php');

require("database.php");
$id = $_GET['empid'];
 
$sql = "DELETE FROM emptbl WHERE empid='$id'";
$result = mysqli_query($conn, "DELETE FROM emptbl WHERE empid=$id");

if ($result) {
	echo "Deleted Successfully";
	header("Location: admin.php");
}
else{
	die(mysqli_error($conn));
}
 

exit;
?>

<?php


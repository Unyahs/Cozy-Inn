<form action="admin.php" method="post" class="form">
	From: <input type="date" name="date1" >
	To: <input type="date" name="date2">
	<input type="submit" name="search" value="search">
</form>

<?php
if (isset($_POST['submit'])) {
	$date1 = $_POST["date1"];
	$date2 = $_POST["date2"];	

	require_once "database.php";
    $date = "SELECT * FROM emptbl WHERE date_hired BETWEEN $date1 and $date2";
		$result = mysqli_query($conn, $date);
	$user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>
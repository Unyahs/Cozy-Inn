<?php include('session.php')?>

<?php 
    if(isset($_SESSION['accounttype']) && $_SESSION['accounttype']=="Farmers"){
        header('location: index.php');
    }
?>

<?php
    require('database.php');
    $proj_id = $_GET['proj_id'];

    $sql = "SELECT * FROM projects_tbl WHERE proj_id='$proj_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $proj_name = $row["proj_name"];
    $emp_name = $row["emp_name"];
    $empid = $row["empid"];
    $department = $row["department"];
    $proj_cost = $row["proj_cost"];
    $proj_start = $row["proj_start"];
    $proj_deadline = $row["proj_deadline"];
    $proj_remaining_time = $row["proj_remaining_time"];
    $proj_desc = $row["proj_desc"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/see_project.css">
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
        <h1><b>Project <?php echo $proj_name ?></b></h1>
        <p> Here are the Details: </p>

        <p> Project ID: <b class="text"><?php echo $proj_id ?></b></p>
        <hr>
        <p> Project Name: <b class="text"><?php echo $proj_name ?></b></p>
        <hr>
        <p> Employee Working: <b class="text"><?php echo $emp_name?></b></p>
        <hr>
        <p> Employee ID: <b class="text"><?php echo $empid ?></b></p>
        <hr>
        <p> Department: <b class="text"><?php echo $department ?></b></p>
        <hr>
        <p> Project Description: <b class="text"><?php echo $proj_desc ?></b></p>
        <hr>
        <p> Project Cost: <b class="text"><?php echo $proj_cost ?></b></p>
        <hr>
        <p> Start Date: <b class="text"><?php echo $proj_start ?></b></p>
        <hr>
        <p> Due Date: <b class="text"><?php echo $proj_deadline ?></b></p>
        <hr>
        <p> Remaining Time: <b class="text"><?php echo $proj_remaining_time ?></b></p>
        
        <form action="employee_page.php" method="post" class="form">
            <button type="submit" value="Return" class="button">Return</button>
        </form>
    </div>
</body>
</html>
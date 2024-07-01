<?php include('session.php')?>

<?php 
    if ($_SESSION["account_type"] == "Admin")
    header("Location: admin.php")
?>

<?php
    require('database.php');
    $empid= $_SESSION["empid"];
    $account_type="";
    $fname="";
    $lname="";
    $date_hired = "";
    $position = "";
    $salary = "";
    $department = "";
    $username="";
    $query = mysqli_query($conn,"SELECT * FROM emptbl WHERE empid='$empid'");
?>

<?php
    require('database.php');
    $empid= $_SESSION["empid"];
    $proj_id="";
    $proj_name="";
    $emp_name = "";
    $department = "";
    $proj_desc = "";
    $proj_cost = "";
    $proj_start="";
    $proj_deadline="";
    $proj_remaining_time="";
    $second_query = mysqli_query($conn,"SELECT * FROM projects_tbl WHERE empid='$empid'");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Page</title>
    <link href="css/employee_page.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet">   
</head>

<body>
    <div class="topnav2" >
        <div class="name">
            <span id="n"><strong><?php echo  $_SESSION['fname']; ?> <?php echo  $_SESSION['lname']; ?></strong></span>
            <br>
            <?php echo $_SESSION['account_type']?> |
            <a href="logout.php"  id="out" >Sign-out</a>    
        </div>
    </div>

    <div class="container">
        <div class="row mt-5 ">
            <div class="col">
                <div class="card mt-5 rounded-0">               
                    <div class="card-header rounded-0" style="background-color: #ff5757;" >     
                        <div class="menu2">                     
                            <a href="#" style="cursor: default; color: black;" >Account Details</a>
                        </div>              
                    </div>
                                
                                
                    <div class="card-body">
                        <table class="table table-bordered text-center border-dark">
                            <tr class="text-white" style="background-color:black;">
                                <td> <strong>Employee ID</strong> </td>
                                <td> <strong>Account Type</strong> </td>
                                <td> <strong>Username</strong> </td>
                                <td> <strong>First Name</strong> </td>
                                <td> <strong>Last Name</strong> </td>                                       
                                <td> <strong>Date Hired</strong> </td>
                                <td> <strong>Position</strong> </td>
                                <td> <strong>Salary</strong> </td>
                                <td> <strong>Department</strong> </td>
                            </tr>
                        

                            <tr>
                            <?php 
                            while($row = mysqli_fetch_assoc($query))
                            {

                            ?>
                                <td> <?php echo $row['empid'];?></td>                           
                                <td> <?php echo $row['account_type'];?></td>
                                <td> <?php echo $row['username'];?></td>
                                <td> <?php echo $row['fname'];?></td>
                                <td> <?php echo $row['lname'];?></td>                                   
                                <td> <?php echo $row['date_hired'];?></td>
                                <td> <?php echo $row['position'];?></td>
                                <td> <?php echo $row['salary'];?></td>
                                <td> <?php echo $row['department'];?></td>
                            </tr>

                            <?php 
                            }

                            ?>
                        </table>
                    </div>                      
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5 ">
            <div class="col">
                <div class="card mt-5 rounded-0">               
                    <div class="card-header rounded-0" style="background-color: #ff5757;" >     
                        <div class="menu2">                     
                            <a href="#" style="cursor: default; color: black;" >Projects</a> |
                            <a href="add_project.php" style="color:#808080;" >Add Project</a> <br>
                        </div>              
                    </div>
                                
                                
                    <div class="card-body">
                        <table class="table table-bordered text-center border-dark">
                            <tr class="text-white" style="background-color:black;">
                                <td> <strong>Project ID</strong> </td>
                                <td> <strong>Project Name</strong> </td>
                                <td> <strong>Employee Working</strong> </td>
                                <td> <strong>Employee ID</strong> </td>
                                <td> <strong>Department</strong> </td>
                                <td> <strong>Project Description</strong> </td>                                       
                                <td> <strong>Project Cost</strong> </td>
                                <td> <strong>Start Date</strong> </td>
                                <td> <strong>Due Date</strong> </td>
                                <td> <strong>Remainning Time</strong> </td>
                                <td> <strong>See Project</strong> </td>
                                <td> <strong>Delete Project</strong> </td>
                            </tr>
                        

                            <tr>
                            <?php 
                            while($row = mysqli_fetch_assoc($second_query))
                            {

                            ?>
                                <td> <?php echo $row['proj_id'];?></td>                           
                                <td> <?php echo $row['proj_name'];?></td>
                                <td> <?php echo $row['emp_name'];?></td>
                                <td> <?php echo $row['empid'];?></td>
                                <td> <?php echo $row['department'];?></td>
                                <td> <?php echo $row['proj_desc'];?></td>                                   
                                <td> <?php echo $row['proj_cost'];?></td>
                                <td> <?php echo $row['proj_start'];?></td>
                                <td> <?php echo $row['proj_deadline'];?></td> 
                                <td> <?php echo $row['proj_remaining_time'];?></td> 
                                <td> <a href="see_project.php?proj_id=<?php echo $row['proj_id'];?>" ><span class="material-icons-sharp eye_icon"  > visibility </span></a></td> 
                                <td> <a href="delete_2.php?proj_id=<?php echo $row['proj_id'];?>" onClick="return confirm('Are you sure you want to Delete this data?')"><span class="material-icons-sharp trash_icon">delete</span></a></td>                            
                            </tr>

                            <?php 
                            }

                            ?>
                        </table>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</body>


</html>
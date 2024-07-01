<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/add_project.css">
</head>
<body>
    <div class="container">
        <div class="header"><h1>Project Form</h1></div>
        <?php
        if (isset($_POST['submit'])) {
            $proj_name = $_POST["proj_name"];
            $emp_name = $_POST["emp_name"];
            $empid = $_POST["empid"];
            $department = $_POST["department"];
            $proj_cost = $_POST["proj_cost"];
            $proj_start = $_POST["proj_start"];
            $proj_deadline = $_POST["proj_deadline"];
            $proj_desc = $_POST["proj_desc"];        

            $datetime1 = new DateTime($proj_start);
            $datetime2 = new DateTime($proj_deadline);

            // Calculate project duration
            $interval_duration = $datetime1->diff($datetime2);
            $years_duration = $interval_duration->y;
            $months_duration = $interval_duration->m;
            $days_duration = $interval_duration->d;

            $project_duration = $years_duration . " Years, " . $months_duration . " Months, and " . $days_duration . " Days";

            // Calculate remaining time
            $now = new DateTime();
            if ($datetime2 < $now) {
                $interval_remaining = new DateInterval('P0D');
            } else {
                $interval_remaining = $now->diff($datetime2);
            }

            $years_remaining = $interval_remaining->y;
            $months_remaining = $interval_remaining->m;
            $days_remaining = $interval_remaining->d;

            $proj_remaining_time = $years_remaining . " Years, " . $months_remaining . " Months, and " . $days_remaining . " Days";

            $errors = array();
            
            if (empty($proj_name) OR empty($emp_name) OR empty($empid) OR empty($department) OR empty($proj_cost)  OR empty($proj_start) OR empty($proj_deadline) OR empty($proj_desc)){
            array_push($errors, "All fields are required.");
            }

            if (strtotime($proj_start) > strtotime($proj_deadline)){
            array_push($errors, "Invalid Project Start.");
            }

            require_once "database.php";
            $sql = "SELECT * FROM emptbl WHERE empid = '$empid'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if (!$user) {
                array_push($errors,"Id not valid.");
            }

           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
            }else{
                $sql= "INSERT INTO projects_tbl (proj_name, emp_name, empid, department, proj_desc, proj_cost, proj_start, proj_deadline, proj_remaining_time) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $preparestmt = mysqli_stmt_prepare($stmt, $sql);


                if ($preparestmt) {
                    mysqli_stmt_bind_param($stmt,"ssissssss", $proj_name, $emp_name, $empid, $department, $proj_desc, $proj_cost, $proj_start, $proj_deadline, 
                    $proj_remaining_time);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You registered successfully. Redirecting...</div>";
                    echo "<meta http-equiv='refresh' content='2;url=login.php'>"; 
                    header("Location: employee_page.php");

                } else {
                    die("Something went wrong.");
                }
            }
        }
        ?>

        <form action="add_project.php" method="post">
            <div class="form-group">
                <label for="proj_name">Project Name:</label>
                <input type="text" id="proj_name" class="form-control" name="proj_name" placeholder="Enter Project Name:">
            </div>

            <div class="form-group">
                <label for="emp_name">Employee First Name:</label>
                <input type="text" id="emp_name" class="form-control" name="emp_name" placeholder="Enter Employee First Name:">
            </div>

            <div class="form-group">
                <label for="empid">Employee ID:</label>
                <input type="text" id="empid" class="form-control" name="empid" placeholder="Enter Employee ID:">
            </div>

            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" id="department" class="form-control" name="department" placeholder="Enter Department:">
            </div>

            <div class="form-group">
                <label for="proj_cost">Project Cost:</label>
                <input type="number" id="proj_cost" class="form-control" name="proj_cost" placeholder="Enter Project Cost:">
            </div>

            <div class="form-group">
                <label for="proj_start">Starting Date:</label>
                <input type="date" id="proj_start" class="form-control" name="proj_start" placeholder="Enter Starting Date:">
            </div>

            <div class="form-group">
                <label for="proj_deadline">Due Date:</label>
                <input type="date" id="proj_deadline" class="form-control" name="proj_deadline" placeholder="Enter Due Date:">
            </div>

            <div class="form-group">
                <label for="proj_desc">Project Description:</label>
                <textarea id="proj_desc" class="form-control" name="proj_desc" placeholder="Enter Project Description:"></textarea>
            </div>

        
            <input type="submit" value="Add Project" name="submit" class="button btn-block">
        </form>

        <footer>
            <div class="form-text text-muted"> <a href="employee_page.php" style="color: #ff5757; text-decoration: none;">Return to Employee Page</a></p></div>
        </footer>
    </div>
</body>
</html>
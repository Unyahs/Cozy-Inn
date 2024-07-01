
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/registration.css">
</head>
<body>
    <div class="container">
        <div class="header"><h1>Employee Account Registration</h1></div>
        <?php
        if (isset($_POST["submit"])) {
            $account_type = $_POST["account_type"];
            $fname = $_POST["firstname"];
            $lname = $_POST["lastname"];
            $date_hired = $_POST["date"];
            $position = $_POST["position"];
            $salary = $_POST["salary"];
            $department = $_POST["department"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];
           
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($fname) OR empty($lname) OR empty($date_hired) OR empty($position) OR empty($salary) OR empty($department) OR empty($username) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
            }
           
            if (strlen($password)<6) {
            array_push($errors,"Password must be at least 6 charactes long");
            }

            if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
            }

            require_once "database.php";
            $sql = "SELECT * FROM emptbl WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                array_push($errors,"This Username is taken!");
            }
           
            if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
            }else{

            $sql = "INSERT INTO emptbl (account_type, fname, lname, date_hired, position, salary, department, username, password) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn); 
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, 'sssssisss', $account_type, $fname, $lname, $date_hired, $position, $salary, $department, $username, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Registered successfully. Redirecting...</div>";
                echo "<meta http-equiv='refresh' content='2;url=admin.php'>"; 
            }else{
                die("Something went wrong");
            }
           }
        }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <label for="acctype">Account Type:</label>
                <select name="account_type" id="acctype" type="text" class="form-select" label="Choose Account Type" required>
                    <option selected> Choose Account Type</option>
                    <option value="Admin">Admin</option>
                    <option value="Employee">Employee</option>    
                </select>
            </div>

            <div class="form-group">
                <label for="firstname">Firstname:</label>
                <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Enter First Name:">
            </div>

            <div class="form-group">
                <label for="lastname">Lastname:</label>
                <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Enter Last Name:">
            </div>

            <div class="form-group">
                <label for="date">Date Hired:</label>
                <input type="date" id="date" class="form-control" name="date" placeholder="Enter Date Hired:">
            </div>

            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" id="position" class="form-control" name="position" placeholder="Enter Position:">
            </div>

            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="number" id="salary" class="form-control" name="salary" placeholder="Enter Salary:">
            </div>

            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" id="department" class="form-control" name="department" placeholder="Enter Department:">
            </div>

            <div class="form-group">
                <label for="Username">Username:</label>
                <input type="text" id="Username" class="form-control" name="username" placeholder="Enter a Username:">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Enter an at least 6 characters Password:">
            </div>

            <div class="form-group">
                <label for="repeat_password">Repeat Password:</label>
                <input type="password" id="repeat_password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>

        
            <input type="submit" value="Register" name="submit" class="button btn-block">
        </form>

        
    </div>
</body>
</html>
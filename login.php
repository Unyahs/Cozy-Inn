<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: employee_page.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="whole-container">
        <div class="container">
            <div class="header"><h1>Employee Account Log-in</h1></div>
            
            <?php
            if (isset($_POST["login"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                require_once "database.php";
                $sql = "SELECT * FROM emptbl WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        $_SESSION["account_type"] = $user["account_type"];
                        $_SESSION["user"] = $user["username"];
                        $_SESSION["empid"] = $user["empid"];
                        $_SESSION["fname"] = $user["fname"];
                        $_SESSION["lname"] = $user["lname"];
                        $_SESSION["date"] = $user["date_hired"];
                        $_SESSION["position"] = $user["position"];
                        $_SESSION["salary"] = $user["salary"];
                        $_SESSION["department"] = $user["department"];
                        header("Location: employee_page.php");
                        die();
                    }else{
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }
                }else{
                    echo "<div class='alert alert-danger'>Username is not registered. Please Register. Redirecting to registration page in 5 seconds...</div>";
                    echo "<meta http-equiv='refresh' content='5;url=registration.php'>"; 
                }
            }
            ?>
          
            <form action="login.php" method="post" class="form">
                <div class="form-group">
                    <label for="Username">Username:</label>
                    <input type="text" id="Username" placeholder="Enter Username:" name="username" class="form-control">
                </div>

                <div class="form-group">
                    <label for="Password">Password:</label>
                    <input type="password" id="Password" placeholder="Enter Password:" name="password" class="form-control">
                </div>

                
                <input type="submit" value="Log-in" name="login" class="button btn-block">
                
            </form>

            <br>
            <div class="form-text text-muted">Not Registered? <a href="registration.php" style="color: #ff5757;">Register Here</a> </div>
            
        </div>

        <div class="container"></div>

    </div>
</body>
</html>
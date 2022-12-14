<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>
    <?php
    require('db.php');
    session_start();
    
    if (isset($_POST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        //Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username' and password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION["username"] = $username;
            // Redirect user to index.php
            $url = "index.php";
            if (headers_sent()) {
                die("<meta http-equiv=\"refresh\" content=\"0;url=$url\">\r\n");
            } else {
                exit(header("Location: $url"));
            }
        } else {
            echo "<div class='form'>
                    <h3>Username/password is incorrect.</h3>
                    <br/>Click here to <a href='login.php'>Login</a></div>";
        }
    } else { ?>
        <div class="form">
            <h1>Log In</h1>
            <form action="" method="post" name="login">
                <input type="text" name="username" placeholder="Username" required />
                <input type="password" name="password" placeholder="Password" required />
                <br>
                <input name="submit" type="submit" value="Login" />
            </form>
            <p>Not registered yet? <a href='registration.php'>Register Here</a></p>
        </div>

    <?php } ?>
</body>

</html>
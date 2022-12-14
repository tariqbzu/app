<?php

require('db.php');

session_start();
print_r($_SESSION);

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
        // header("Location: index.php");
        //  header("Location: db.php");
        $url = "db.php";
        if (headers_sent()) {
            die("<meta http-equiv=\"refresh\" content=\"0;url=$url\">\r\n");
        } else {
            exit(header("Location: $url"));
        }
        exit;
    } else {
        echo "<div class='form'>
                <h3>Username/password is incorrect.</h3>
                <br/>Click here to <a href='login.php'>Login</a></div>";
    }
}

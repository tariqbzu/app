<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>
<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <div style="text-align: center; font-size: 32px;">
        <p>Hello,</p>
        <p><b><?php echo $_SESSION["username"] ?></b> login successfull.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>
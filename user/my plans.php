<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
	
    </style>
<link rel="stylesheet" type="text/css" media="screen" href="../css/service.css" />
</head>
<body background="../images/home_page/wall_3.jpg">
<nav>
        <a href="homePage.html">Home</a>
        <a href="about.html">About</a>
        <a href="service.html">Sevices</a>
        <a href="blog.html">Blog</a>
        <a href="shop.html">Shop</a>
        <a href="contacts.html">Contact Us</a>
        <a href="register.php">SignUp </a>
	<a href="login.php">Login</a>
    </nav>
<br><br><br><br><br><br><br>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. We provide you the best coffe in the Country.</h1>
    </div>
<br><br><br><br><br><br><br>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out </a><br><br><br>
	
    </p>
</body>
</html>
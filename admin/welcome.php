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
<link rel="stylesheet" type="text/css" media="screen" href="home.css" />
<style>
        body {
          background-color : black;
        }
        </style>
</head>


<body>
<div class="navbar">


					<a href="register.php"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100" height="50" viewBox="0 0 188 74">
					  <defs>
						<filter id="Rectangle_2" x="0" y="0" width="188" height="74" filterUnits="userSpaceOnUse">
						  <feOffset dy="3" input="SourceAlpha"/>
						  <feGaussianBlur stdDeviation="3" result="blur"/>
						  <feFlood flood-opacity="0.161"/>
						  <feComposite operator="in" in2="blur"/>
						  <feComposite in="SourceGraphic"/>
						</filter>
					  </defs>
					  <g id="Group_1" data-name="Group 1" transform="translate(-1612 -70)">
						<g transform="matrix(1, 0, 0, 1, 1612, 70)" filter="url(#Rectangle_2)">
						  <g id="Rectangle_2-2" data-name="Rectangle 2" transform="translate(9 6)" fill="#7e9346" stroke="#707070" stroke-width="1">
							<rect width="170" height="56" rx="28" stroke="none"/>
							<rect x="0.5" y="0.5" width="169" height="55" rx="27.5" fill="none"/>
						  </g>
						</g>
						<text id="Sign_Up" data-name="Sign Up" transform="translate(1660 114)" fill="#f2f3ed" font-size="30" font-family="OpenSans-SemiBold, Open Sans" font-weight="600"><tspan x="0" y="0">Sign Up</tspan></text>
					  </g>
					</svg>
					</a><br>
				  
					<a href="login.php">Login</a>
					<a href="food.html">Foods</a>
					<a href="user.html">Users</a>
				
				  
				  <div id="logo">
					  <a href="home.html">
					<svg xmlns="http://www.w3.org/2000/svg" width="150" height="50" viewBox="0 0 231 100">
					  <text id="_EAT_HEALTHY" data-name="    EAT
					HEALTHY" transform="translate(0 40)" fill="#7e9346" font-size="40" "><tspan x="0" y="0" xml:space="preserve">    EAT</tspan><tspan x="0" y="50">HEALTHY</tspan></text>
					</svg></a>
					</div>
					
				  
				  </div>


<br><br><br><br><br><br><br>
    


    <p>
    <br><br><br>
        
        <a href="logout.php" class="btn btn-danger">Sign Out </a><br><br><br>
	
    </p>
</body>
</html>
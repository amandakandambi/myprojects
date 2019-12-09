<?php

session_start();
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 

require_once "config.php";
 
$username = $password = "";
$username_err = $password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
   

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty($username_err) && empty($password_err)){
     

        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
           

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
          

            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            session_start();
                            
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            
                            header("location: welcome.php");
                        } else{
                            
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
       
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; 
            
          background-image: url('images/back.jpg');
        }
        .wrapper{ width: 350px; padding: 20px; 
            
    }
    </style>
	<link rel="stylesheet" type="text/css" media="screen" href="login.css" />
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
<br><br><br><br><br><br><br><br>


    <div class="wrapper">
        <div id="form">
        <h2>Login</h2>
       

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
</div>
    </div>    
</body>
</html>
<?php

require_once "config.php";
 

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
    
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            
            $param_username = trim($_POST["username"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    < <meta charset="UTF-8">
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
  <a href="about.html">About Us</a>
  <a href="myplans.php">My Plans</a>
  <a href="planmeal.php">Plan Meals</a>

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
        <h2>Sign Up</h2>
     

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div> 
</div>   
</body>
</html>
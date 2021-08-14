<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    exit;
}

session_start();

$_SESSION['destroy'] = true;

if (isset($_POST['reg_user'])){
 
	$_SESSION['destroy'] = false;
}

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password_1']) && isset($_POST['password_2'])){
	
	$username =$_POST['username'];
    $email =$_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];


	$db = mysqli_connect('fdb22.awardspace.net', '3188816_registration', 'ah22117798', '3188816_registration');
	$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result); // return Associative array
	
   if ($user) { // if user exists

        if ($user['username'] === $username) {  // (Identical)

           echo '<script type="text/javascript">';
           echo 'setTimeout(function () { swal("Oops!","this username already exists!","warning");';
           echo '}, 400);</script>';
		  }


	 else if ($user['email'] === $email) { // (Identical)
		  
	   echo '<script type="text/javascript">';
           echo 'setTimeout(function () { swal("Oops!","this email already exists!","warning");';
           echo '}, 400);</script>';
		}
	  }
    else{
		$password = md5($password_1);
		
        date_default_timezone_set('Africa/Cairo');
        $dt = date('Y-m-d h:i:s');

		$query = "INSERT INTO users (email,username,password,registration_date) VALUES('$email', '$username', '$password','$dt')";
		mysqli_query($db, $query);
		
		//session_start();
  	    $_SESSION['username'] = $username;
  	    
  	    header('location: welcome.php');
	}
	
}
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<html>
<head>
  <title>Registration Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="icon" href="icon.jpg">
</head>
<body class = "body2">
  <div class="header">
  	<h2>Register</h2>
  </div>

  <form method="post" action="register.php">
  	<div class="input-group">
  	  <label>Username</label>
  	  <input id ="username" type="text" name="username" placeholder = "enter your username...">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input id ="email" type="email" name="email" placeholder = "enter your email...">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input id ="password_1" type="password" name="password_1" placeholder = "enter your password...">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input id ="password_2" type="password" name="password_2" placeholder = "re-enter your password...">
  	</div>
  	<div class="input-group">
  	  <button class="btn" name="reg_user" onclick ="return validate();">Register</button>
  	</div>
  </form>
</body>
</html>

<script>
function validate(){

    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	if(document.getElementById("username").value == ""){
	  swal("Oops!","username is empty...","error");
	  return false;
	}
        else if(document.getElementById("email").value == ""){
	  swal("Oops!","email is empty...","error");
	  return false;
	}
	else if(document.getElementById("password_1").value == ""){
	  swal("Oops!","password is empty...","error");
	  return false;
        }
	else if(document.getElementById("password_2").value == ""){
	  swal("Oops!","password is empty...","error");
	  return false;
        }
        else if(!document.getElementById("username").value.match(/^[a-zA-Z][0-9|a-zA-Z| ]+$/)){
	  swal("Oops!","Username must start with a letter and contain letters ,numbers and space only!","error");
	  return false;
	}
        else if(!document.getElementById("email").value.match(mailformat)){
	  swal("Oops!","You have entered an invalid email address!","error");
	  return false;
	}
        else if(!document.getElementById("password_1").value.match(/^[0-9|a-zA-Z]{8,12}$/)){
	  swal("Oops!","Password must contain letters OR numbers Only Min 8 digits and Max 12 digits!","error");
	  return false;
        }
        else if(!document.getElementById("password_2").value.match(/^[0-9|a-zA-Z]{8,12}$/)){
	  swal("Oops!","Password must contain letters OR numbers Only Min 8 digits and Max 12 digits!","error");
	  return false;
        }
	else if(document.getElementById("password_1").value != document.getElementById("password_2").value){
	  swal("Oops!","password and confirm passwoed does not match...","error");
	  return false;
	}
}	
  </script>
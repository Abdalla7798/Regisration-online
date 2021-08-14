<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    exit;
}

session_start();

$_SESSION['destroy'] = true;

if (isset($_POST['login_user'])){
 
	$_SESSION['destroy'] = false;
}

if(isset($_POST['email']) && isset($_POST['password'])){

	$email =$_POST['email'];
	$password = $_POST['password'];
	
	$db = mysqli_connect('fdb22.awardspace.net', '3188816_registration', 'ah22117798', '3188816_registration');
	$password = md5($password);
	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";

	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
		$user = mysqli_fetch_assoc($results);
		$username = $user['username'];

       
	   // session_start();
            $_SESSION['username'] = $username;
  	    
  	    header('location: welcome.php');
  	}else {
        
               echo '<script type="text/javascript">';
               echo 'setTimeout(function () { swal("Oops!","this account does not exist!","warning");';
               echo '}, 400);</script>';
  	}

}
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="icon" href="icon.jpg">
</head>
<body class = "body1">
  <div class="header1">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">

  	<div class="input-group">
  		<label>Email</label>
  		<input id ="email" type="text" name="email" placeholder = "enter your email...">
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input id ="password" type="password" name="password" placeholder = "enter your password...">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user" onclick ="return validate();">Login</button>
  	</div>
  </form>
</body>
</html>


<script>

function validate(){

var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

if(document.getElementById("email").value == "" ){
  swal("Oops!","email is empty...","error");
  return false;
}
else if(document.getElementById("password").value == ""){
  swal("Oops!","password is empty...","error");
  return false;
}
else if(!document.getElementById("email").value.match(mailformat)){
  swal("Oops!","You have entered an invalid email address!","error");
  return false;
}
else if(!document.getElementById("password").value.match(/^[0-9|a-zA-Z]{8,12}$/)){
  swal("Oops!","Password must contain letters OR numbers Only Min 8 digits and Max 12 digits!","error");
  return false;
}
}	
</script>
<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403);
    exit;
}

session_start();


if ($_SESSION['destroy'] == true){
  header("location: page_not_found.php");
  exit;
}


if (isset($_POST['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>

<html>
<head>
  <title>Welcome Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="icon" href="icon.jpg">
</head>
<body class = "body3">
  <form style ="all:unset" method = "post">
  <div class="header1">
  	<h2>Welcome</h2>
  </div>
	 
  <div class="divstyle">
      <h3 style = "margin-top: 25px ; font-size:35"><?php echo $_SESSION['username'];?></h3>
      <button id = "logout" style = "margin-left: -5px" type="submit" class="btnn" name="logout">Logout</button>
  </div>
</form>
</body>
</html>
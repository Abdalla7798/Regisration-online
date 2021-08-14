<?php

$db = mysqli_connect('fdb22.awardspace.net', '3188816_registration', 'ah22117798', '3188816_registration');

session_start();

$session = session_id();

date_default_timezone_set('Africa/Cairo');
$dt = date('Y-m-d h:i:s');


$query1 = "SELECT * FROM useronline WHERE session = '$session'";
$results1 = mysqli_query($db, $query1);

$count1 = mysqli_num_rows($results1);

$query2 = "SELECT * FROM online WHERE session = '$session'";
$results2 = mysqli_query($db, $query2);

$count2 = mysqli_num_rows($results2);


if ($count1 == NULL){
       
        $count_no = 1;

	mysqli_query($db, "INSERT INTO useronline (session ,count, time) VALUES ('$session',$count_no,'$dt')");
}
else{
    
    $query = "SELECT * FROM useronline WHERE session = '$session'";
    $results = mysqli_query($db, $query);
    
    $user = mysqli_fetch_assoc($results);
    $count_no = $user['count'];
    $count_no = $count_no +1;
    
    mysqli_query($db, "UPDATE useronline SET count = $count_no , time = '$dt' WHERE session = '$session'");
}

if($count2 == NULL){

      mysqli_query($db, "INSERT INTO online (session) VALUES ('$session')");

}

    $query = "SELECT * FROM useronline WHERE TIME(time) < TIMEDIFF(TIME('".$dt."'),'00:01:00')";
    $result = mysqli_query($db, $query);
    
    
    while ($row = mysqli_fetch_assoc($result)) {

    $temp = $row["session"];
    
    mysqli_query($db,"DELETE FROM online WHERE session = '$temp'");
    
    }

mysqli_close($db);

?>

<html>
<head >
<title>Home page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="icon" href="icon.jpg">
</head>

<body class = "body4">

                
		<button id = "btn1" class = "btnn" onclick="btn1();">Register</button>

		<button id = "btn2" class = "btnn1" onclick="btn2();">Login</button>
                
                               
		
</body>
<script>
function btn1(){
	//header("location: register.php")
	location.href = "register.php";
}

function btn2(){
	//header("location: login.php");
	location.href = "login.php";
}

</script>

</html>
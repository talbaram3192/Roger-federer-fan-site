<html>

<head>
<link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
<style>
button{
	background-color:#daf1f1;
	border-style:solid;
	border-width:1px;
	border-color:black;
    padding: 8px 16px;
    text-decoration: none;
	font: 17px 'Oleo Script', Helvetica, sans-serif;
    color: #2b2b2b;
    text-shadow: 4px 4px 0px rgba(0,0,0,0.1);
	
}
body{
	font: 27px 'Oleo Script', Helvetica, sans-serif;
    color: #2b2b2b;
    text-shadow: 4px 4px 0px rgba(0,0,0,0.1);
	background-image:url('../images/img.jpg');
	background-position: center center;
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: cover;

}

</style>

</head>
<body>

<?php

header('Content-Type: text/html; charset=utf-8');


$servername = "localhost";
$username = "tomerat";
$password = "t#Lxuba7hi";
$dbname = "tomerat_RF";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
    
if (!$conn->set_charset("utf8")) { printf("Error loading character set utf8: %s\n", $conn->error); exit();}

    $conn->query("SET NAMES 'utf8'");

$tournament=$_POST["t"];
$numOfTickets=$_POST["numTickets"];
$section=$_POST["section"];
$insurance=$_POST["insurance"];
$fullName=$_POST["fullName"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$country=$_POST["country"];
$address=$_POST["address"];
$cardname=$_POST["cardname"];
$id=$_POST["cardid"];
$cardnumber=$_POST["cardnumber"];
$expmonth=$_POST["expmonth"];
$expyear=$_POST["expyear"];
$cvv=$_POST["cvv"];


$sql="INSERT INTO users (fullname,email,phonenumber,country,address,cardname,id,cardnumber,
expirationmonth,expirationyear,cvv) VALUES ('".$fullName."','".$email."','".$phone."','".$country."','".$address."','".$cardname."'
,'".$id."','".$cardnumber."','".$expmonth."','".$expyear."','".$cvv."');";

$sql2="INSERT INTO tournaments (tournament,numberoftickets,section,insurancefee)
 VALUES ('".$tournament."','".$numOfTickets."','".$section."','".$insurance."');";
 
$sql3="INSERT INTO purchase (id,fullname,tournament,numberoftickets,section)
 VALUES ('".$id."','".$fullName."','".$tournament."','".$numOfTickets."','".$section."');";


if ($conn->query($sql)==FALSE || $conn->query($sql2)==FALSE || $conn->query($sql3)==FALSE){
    echo "seems like we have a problem: ".$conn->error;
    exit();
}else{
	echo "your ticket has been purchased succesfully!!";
}

     $result=$conn->query("SELECT * FROM purchase WHERE id='".$id."'");
	 
echo "<br>";
echo " your purchase's details:";
echo "<br>";


if ($result->num_rows > 0) {
    echo "<style>table{  text-align:center; background-color:#daf1f1; border: 2px black solid;} tr{ color: black; border: 2px black solid;} td{ color: black; border: 2px black solid;}</style>
	<table><tr><th>ID</th><th>Name</th><th>tournament</th><th>number of tickets</th><th>section</th>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["id"]. "</td><td>" . $row["fullname"]. "</td><td> " . $row["tournament"]. "</td><td> " . $row["numberoftickets"]. "</td><td> " . $row["section"]. "</td></tr>";
     }
     echo "</table>";
} else {
     echo "0 results";
}

echo "<br>";
echo " see you on court!!";


$conn->close();
?>  


<br>
<img src="..\images\fedgif.gif" height="300" width="400">

<br>

<button><a href="..\html\home.html">back home</a></button>




</body>
</html>
<?php
$q1 = explode(" ", $_REQUEST["q1"]);

$servername = "localhost";
$username = "root";
$password = ""; //Add password here
$DBname = "";   //Add DB name here

// Create connection
$conn = new mysqli($servername, $username, $password , $DBname);

// Check connection
if ($conn->connect_error) {
    die("<script> window.location = 'error404.html';</script>");
}
$key = $q1[1];
$val = $q1[0];

$sql = "SELECT ".$key." FROM ranninfo";
$result = $conn->query($sql);
$count = 1;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($row[$key] == $val)
        {	
        	$count = 0;
        	echo 0;
        	break;
        }
    }
    if($count == 1)
    {
    	echo 1;	
    }
    
} else {
    echo "0";
}


?>
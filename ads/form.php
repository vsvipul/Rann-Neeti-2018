<?php
if($_SERVER["REQUEST_METHOD"] == "GET")
{
		die( "<script> window.location = '/' </script>");
}
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

$name = $contact = $email = $college = $teamname = $teamsize = $event = $category = "";
$nameerr = $contacterr = $emailerr = $collegeerr = $teamnameerr = $teamsizeerr = $eventerr = $categoryerr ="";
if($_SERVER["REQUEST_METHOD"] == "POST")
{	
	$id;
	$handle = fopen("details.txt", "r");
	fscanf($handle, "%d\n", $id);
	$id += 1;
	fclose($handle);
	$name = test_input($_POST["name"]);
	// echo $name;
	$email = test_input($_POST["email"]);
	$contact = test_input($_POST["mobile"]);
	$college = test_input($_POST["college"]);
	$teamname = test_input($_POST["teamname"]);
	$teamsize = test_input($_POST["teamsize"]);
	$event = test_input($_POST["event"]);
	$category = test_input($_POST["category"]);
	$length = strlen($id);
	//echo $length
	//echo "<h1>".$id."</h1>";
	$rannid = "RANN";
	for($x = 1 ; $x <= 4-$length ; $x++)
	{
		$rannid = $rannid."0";
	}
	$rannid = $rannid.$id;
	//echo "Connected successfully";
	
	$sql = "INSERT INTO ranninfo (rannid,fname , email,mobile , college , teamname , teamsize , event , edone)
VALUES ('".$rannid."','".$name."','".$email."','".$contact."','".$college."','".$teamname."','".$teamsize."','".$event."','0')";
		
if ($conn->query($sql) === TRUE) {
	$cookiname = "id";
	$cookivalue = $rannid;
	setcookie($cookiname, $cookivalue, time() + (86400 * 30), "/"); // 86400 = 1 day
	require './phpmailer/PHPMailerAutoload.php';
	$mail = new PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);
	$mail->Username = "er.adi2612@gmail.com";
	$mail->Password = "**********";
	$mail->SetFrom("er.adi2612@gmail.com");
	$mail->Subject = "Rann-neeti'18";
	$mail->Body = "yo have successfuly registered for the Rann-neeti'18 , your unique team id is "." ".$rannid."\n"."kindly do the payement process for confirming your participation";
	$mail->AddAddress($email);

	if(!$mail->Send())
	{
	    //echo "<script>console.log('Mailer Error: " . $mail->ErrorInfo."')</script>";
	    $sql1 = "UPDATE ranninfo SET edone='0' WHERE rannid=".$rannid."'";
	    $conn->query($sql1);
		

	} 
	else 
	{
	   // echo "<script> console.log('Done')</script>";
	    $sql1 = "UPDATE ranninfo SET edone='1' WHERE rannid='".$rannid."'";
	    $conn->query($sql1);
	}
	$handle = fopen("details.txt", "w") or die("f");
	fwrite($handle,$id);
	fclose($handle);
    echo "<script>window.location = 'success.php';console.log('ss');</script> ";

} else {
	//echo "Error: " . $sql . "<br>" . $conn->error;
    echo "<script>window.location = 'error404.html';</script> ";
	}


}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
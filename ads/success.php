<?php
if(!isset($_COOKIE['id']))
{
	die( "<script> window.location = '/' </script>");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Success</title>
</head>
<body>
	<h1>YOU have successfuly registered for Rann-neeti' 18 </h1>
	<h1>your unique team id is 
	<?php
		$id;
		$handle = fopen("details.txt" , "r");
		fscanf($handle , "%d\n" , $id);
		$rannid = "RANN";
		$length = strlen($id);
		for($x = 1 ; $x <= 4-$length ; $x++)
		{
			$rannid = $rannid."0";
		}
		$rannid = $rannid.$id;
		echo $rannid;


		setcookie("id", "", time() - 3600);
	?> </h1>
</body>
</html>
<?php
function OpenCon(){
	$conntype = "PROD"; //LDEV; PREV; PROD
	
	switch($conntype){
		case "LDEV":
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpass = "root";
			$db = "deco";
			break;
		case "PREV":
			$dbhost = "localhost";
			$dbuser = "decopt_wp810_prev";
			$dbpass = "2dshfHrbvcfIh_K3";
			$db = "decopt_wp810_prev";
			break;
		case "PROD":
			$dbhost = "localhost";
			$dbuser = "decopt_wp810";
			$dbpass = "SpS0-1.kn1";
			$db = "decopt_wp810";
			break;
	}
	
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);

	return $conn;
}

function CloseCon($conn){
	$conn -> close();
}
?>
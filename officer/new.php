<?php 
	$dbhost = 'localhost'; 
	$dbuser = 'root'; 
	$dbpass = '1234'; 
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass); 
	if(! $conn ) 
	{ 
		die('Could not connect: ' . mysqli_error()); 
	} 
	echo 'Connected successfully'; 
	#mysqli_select_db($conn, 'SPSO'); 

	#mysqli_close($conn); 
?>
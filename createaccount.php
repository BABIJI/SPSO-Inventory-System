<?php
	require 'db.php';
	
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['first_name'] = $_POST['first_name'];
	$_SESSION['last_name'] = $_POST['last_name'];

	
	$first_name = $mysqli->escape_string($_POST['first_name']);
	$last_name = $mysqli->escape_string($_POST['last_name']);
	$username = $mysqli->escape_string($_POST['username']);
	$email = $mysqli->escape_string($_POST['email']);
	$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
	$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
	
	
	$result = $mysqli -> query("SELECT * FROM officeraccount WHERE username == '$username'");

	
	if ($result -> num_rows > 0 )
	{
		$_SESSION['message'] = 'Username already exists!';
		header("location: error.php");
    
	}
	else
	{ 
		if($mysqli->query("insert into officeraccount values('$first_name','$last_name','$username','$email','$password','$hash');"))
		{
			header("location: index.php");
		}
		else
		{
			$_SESSION['message'] = 'Registration failed!';
			header("location: error.php");
		}
	}

?>
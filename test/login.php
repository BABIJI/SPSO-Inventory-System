<?php
	$host = 'localhost';
	$user = 'root';
	$password = '1234';
	$db = 'spso';

	$mysqli = new mysqli($host, $user, $password, $db) or die($mysql -> error);
	
	
	$username = $mysqli->escape_string($_POST['username']);
	$result = $mysqli -> query("SELECT * from client_user_table where username = '$username';");
	if ( $result->num_rows == 0)
	{
		$_SESSION['message'] = "Username doesn't exist!";
		header("location: error.php");
	}
	else
	{
		$user = $result->fetch_assoc();
		$pass = hash('sha256', $_POST['password']);
		$_SESSION['pass'] = password_hash($pass, PASSWORD_BCRYPT);
		if( password_verify($pass, $user['user_Password']))
		{
			//$_SESSION['username'] = $user['username'];
			//$_SESSION['first_name'] = $user['first_name'];
			//$_SESSION['last_name'] = $user['last_name'];
			//$_SESSION['active'] = $user['active'];
        
			$_SESSION['logged_in'] = true;

			header("location: ../client/Client_Menu.html");
		}
		else
		{
			$_SESSION['message'] = "You have entered wrong password, try again!"." ".$_SESSION['pass'];
			header("location: error.php");
		}
	}
?>
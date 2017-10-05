<?php
	
	$username = $mysqli->escape_string($_POST['username']);
	$result = $mysqli -> query("SELECT * from officeraccount where username = '$username';");

	if ( $result->num_rows == 0)
	{
		$_SESSION['message'] = "Username doesn't exist!";
		header("location: error.php");
	}
	else
	{
		$user = $result->fetch_assoc();
		
		if( password_verify($_POST['password'], $user['password']) )
		{
			$_SESSION['username'] = $user['username'];
			$_SESSION['first_name'] = $user['first_name'];
			$_SESSION['last_name'] = $user['last_name'];
			$_SESSION['active'] = $user['active'];
        
			$_SESSION['logged_in'] = true;

			header("location: account.php");
		}
		else
		{
			$_SESSION['message'] = "You have entered wrong password, try again!";
			header("location: error.php");
		}
	}
?>
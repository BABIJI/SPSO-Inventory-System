<?php
	session_start();
	$host = 'localhost';
	$user = $_POST['username'];
	$password = $_POST['password'];
	$db = 'spso';

	$mysqli = new mysqli($host, $user, $password, $db); //or die($mysql -> error);
	if ($mysqli -> connect_error) {
		
		$_SESSION['message'] = "Incorrect Username/Password!";
		header("location: error.php");
	}else{
		$result = $mysqli -> query("SELECT * FROM employee WHERE employee_username = '$user';");
		$employee_record = $result->fetch_assoc();
		$_SESSION['logged_in'] = true;
		$_SESSION['user_name'] = $user;
		$_SESSION['pass_word'] = $password;
		$_SESSION['role'] = $employee_record['role'];
		if($employee_record['role'] != 0)
		{
			header("location: officer/Officer_Menu.php");
		}
		else
		{
			header("location: client/Client_Menu.php");
		}
		/*
		
		if ( $result->num_rows == 0)//username DO NOT exists in client_table
		{
			$result = $mysqli -> query("SELECT * from officer_user_table where username = '$user';");
			if ( $result->num_rows == 0)//username DO NOT exists in officer_table
			{
				$_SESSION['message'] = "Incorrect Username/Password";
				header("location: error.php");
			}
			else	//username exists in officer_table
			{
				$_SESSION['logged_in'] = true;
				$_SESSION['user_name'] = $user;
				$_SESSION['pass_word'] = $password;
				$_SESSION['type'] = "officer";
				header("location: officer/Officer_Menu.html");
			}
		}
		else //tries if username exist in officer_table
		{
			$_SESSION['logged_in'] = true;
			$_SESSION['user_name'] = $user;
			$_SESSION['pass_word'] = $password;
			$_SESSION['type'] = "client";
			header("location: client/Client_Menu.html");
			
				//$_SESSION['first_name'] = $user['first_name'];
				//$_SESSION['last_name'] = $user['last_name'];
				//$_SESSION['active'] = $user['active'];
		}*/
		mysqli_close($mysqli);
	}
?>
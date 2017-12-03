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
		
/**********************************Authenticator****************************************************************************/		
		//$mysqli = new mysqli("localhost", $_SESSION['user_name'], $_SESSION['pass_word'], "spso");
		//if (mysqli_connect_errno())
		//{
			//echo "Failed to connect to MySQL: " . mysqli_connect_error();
		//}
		//mysqli_select_db($mysqli, "spso");

/*gathering user account information BEGIN*/
		$us = $_SESSION["user_name"];
		$query1 = "SELECT * FROM employee WHERE employee_username = '$us';";
		$account_info = mysqli_query($mysqli, $query1);
		if (!$account_info) {
			die('Invalid query: ');
		}
		$temp = mysqli_fetch_array($account_info);
		
		$_SESSION["account_id"] = $temp['employee_id'];
		$temp2 = $temp['employee_id'];
		$_SESSION["account_firstname"] = $temp['employee_firstname'];
		$_SESSION["account_lastname"] = $temp['employee_lastname'];
		$_SESSION["account_position"] = $temp['employee_position'];
		$query1 = 'SELECT office_name FROM office_employee WHERE employee_id = \''.$temp2.'\';';
		$account_info = mysqli_query($mysqli, $query1);
		if (!$account_info) {
			die('Invalid query:'.$query1);
		}
		$temp = mysqli_fetch_array($account_info);
		$_SESSION["account_office"] = $temp['office_name'];
/*gathering user account information END*/
		mysqli_close($mysqli);
/*********************************Authenticator end*************************************************************************/
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
		//mysqli_close($mysqli);
	}
?>
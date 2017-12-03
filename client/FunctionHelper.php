<?php
	
	session_start();
	//$temp = array('wtf' => 'WTF');
	//echo json_encode($temp);
	$input = $_POST;
	if($input['function'] == 'hash')
	{
		$oldHash = hash('sha256', $input['old']);
		$result = array('hash' => $oldHash);
		echo json_encode($result);
	}
	if($input['function'] == 'changePassword')
	{
		$newPassword = $input['newPassword'];
		$username = $_SESSION['user_name'];
		$db = new mysqli("localhost", $_SESSION['user_name'], $_SESSION['pass_word'], "spso");
		if (mysqli_connect_errno())
		{
			die("Failed to connect to MySQL: " . mysqli_connect_error());
		}
		$result = mysqli_query($db, "UPDATE mysql.user SET authentication_string = password('$newPassword') WHERE User = '$username';");
		if(!$result)
		{
			//mysqli_close($db);
			die("MySQL Error upon change Password Query!");
		}
		$result = mysqli_query($db, "FLUSH PRIVILEGES;");
		if(!$result)
		{
			//mysqli_close($db);
			die("MySQL Error upon Flushing Privileges!");
		}
		mysqli_close($db);
	}
?>
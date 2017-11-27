<?php
	session_start();
	$description = $_POST['description'];
	$db = new mysqli("localhost", $_SESSION['user_name'], $_SESSION['pass_word'], "spso");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	mysqli_select_db($db, "spso");
	$result = mysqli_query($db, "SELECT stock_no, Unit FROM supply where description = '$description';");
	mysqli_close($db);
	if($myrow = mysqli_fetch_array($result))
	{
		$array = array("stock" => $myrow["stock_no"] , "unit" =>$myrow["Unit"]);
		echo  json_encode($array);
	}else{
		echo json_encode("N/A");
	}
?>
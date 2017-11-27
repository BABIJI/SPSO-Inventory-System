<?php
	session_start();
	$ris = $_POST['ris'];
	$array = array();
	$db = new mysqli("localhost", $_SESSION['user_name'], $_SESSION['pass_word'], "spso");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	mysqli_select_db($db, "spso");
	$result = mysqli_query($db, "SELECT rs.stock_no, s.Unit, s.description, rs.quantity FROM supply s, ris_supply rs where rs.RIS_no = '$ris' and s.stock_no = rs.stock_no;");
	
	mysqli_close($db);
	$count = 0;
	while($myrow = mysqli_fetch_array($result))
	{
		$record = array("stock_no".$count => $myrow["stock_no"] , "unit".$count =>$myrow["Unit"], "description".$count =>$myrow["description"], "quantity".$count =>$myrow["quantity"]);
		
		$array = $array + $record;
		//echo  json_encode($array);
		$count++;
	}
	$array = $array + array("total_number" => $count);
	
	echo json_encode($array);
?>
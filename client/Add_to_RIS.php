<?php
	session_start();
	if(isset($_POST['ris_no'])){
		$receivedData = $_POST;
		//echo json_encode($gg);
		$db = new mysqli("localhost", $_SESSION['user_name'], $_SESSION['pass_word'], "spso");
		if (mysqli_connect_errno())
		{
			die("Failed to connect to MySQL: " . mysqli_connect_error());
		}
		mysqli_select_db($db, "spso");
/*Need to put scheduling here so as to provide unique No. for each user*/
		$ris_numberRetreiver = mysqli_query($db, "SELECT COUNT(RIS_no) from ris;");
		if(!$ris_numberRetreiver)
		{
			die("error failed to retreive ris_no on ris table");
		}
		//echo $receivedData['purpose'];
		$result = mysqli_fetch_array($ris_numberRetreiver);
		//echo $result["COUNT(RIS_no)"];
		//$result = json_encode($result);
		//echo $ris_numberRetreiver;
		$ris_no = mysqli_real_escape_string($db, $receivedData['ris_no'].'-'.$result['COUNT(RIS_no)']);
		$purpose = mysqli_real_escape_string($db, $receivedData['purpose']);
		$dateTime = mysqli_real_escape_string($db, $receivedData['dateAndTime']);
		$employee_id = mysqli_real_escape_string($db, $receivedData['employee_id']);
		$status = "TBP";
		$inserter = mysqli_query($db, "INSERT INTO ris (RIS_no, date_and_time, Purpose, requester, status) values ('$ris_no', '$dateTime', '$purpose' , '$employee_id', '$status');");
		if(!$inserter){
			die("error failed to insert on ris table Basic ".mysqli_error($db));
		}
		$i = 0;
		
		for($i = 1; $i <= (int)$receivedData['number_of_requested_supplies']; $i++)
		{
			$stock = mysqli_real_escape_string($db, $receivedData[$i.'_stock']);
			$qty = mysqli_real_escape_string($db, $receivedData[$i.'_qty']);
			$inserter = mysqli_query($db, "INSERT INTO ris_supply (RIS_no, stock_no, quantity) values ('$ris_no', '$stock', '$qty');");
			if(!$inserter){
				die("error failed to insert on ris-supply table");
			}
		}
		mysqli_close($db);
	}else{
		
	}
		/*for($i = 0; i < (int)$_POST['number_of_requested_supplies']; $i++)
		{
			$ris_no = $_POST['ris_no'];
			$stock = $_POST['$g.send1'];
			$qty = $_POST['$g.send2'];
			$inserter = mysqli_query($db, "INSERT INTO ris-supply (RIS_no, stock_no, quantity) values ($ris_no, $stock, $qty);");
			if(!$inserter){
			die("error failed to insert on ris-supply table");
		}*/
		
		
		
		
		
		//$result = mysqli_query($_SESSION["db"], "SELECT stock_no, description, Unit FROM supplies");
		//$_S = mysqli_num_rows ( $_SESSION["result"]);
/*		
		$_clientFrom = $_SESSION["type"].'_user_table';
		$us = $_SESSION["user_name"];
		$query1 = "SELECT e.* FROM employee e, $_clientFrom c WHERE e.employee_id = c.employee_id and c.username = '$us';";
		$account_info = mysqli_query($_SESSION["db"], $query1);
		if (!$account_info) {
			die('Invalid query: '.$_clientFrom);
		}
		$temp = mysqli_fetch_array($account_info);
		
		$_SESSION["account_id"] = $temp['employee_id'];
		$temp2 = $temp['employee_id'];
		$_SESSION["account_firstname"] = $temp['employee_firstname'];
		$_SESSION["account_lastname"] = $temp['employee_lastname'];
		$_SESSION["account_position"] = $temp['employee_position'];
		
		$query1 = 'SELECT office_name FROM belongs WHERE employee_id = \''.$temp2.'\';';
		$account_info = mysqli_query($_SESSION["db"], $query1);
		if (!$account_info) {
			die('Invalid query:'.$query1);
		}
		$temp = mysqli_fetch_array($account_info);
		$_SESSION["account_office"] = $temp['office_name'];
		*/
	
?>

<!DOCTYPE html>
<html>
	<?php
		session_start();
		//header('Cache-Control: no-cache, must-revalidate');
		
		$_SESSION["db"] = new mysqli("localhost", $_SESSION['user_name'], $_SESSION['pass_word'], "spso");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($_SESSION["db"], "spso");

/*gathering user account information BEGIN*/
		$us = $_SESSION["user_name"];
		$query1 = "SELECT * FROM employee WHERE employee_username = '$us';";
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
		$query1 = 'SELECT office_name FROM office_employee WHERE employee_id = \''.$temp2.'\';';
		$account_info = mysqli_query($_SESSION["db"], $query1);
		if (!$account_info) {
			die('Invalid query:'.$query1);
		}
		$temp = mysqli_fetch_array($account_info);
		$_SESSION["account_office"] = $temp['office_name'];
/*gathering user account information END*/
		mysqli_close($_SESSION["db"]);
		
	?>
	<head>
		
		<style>
/*CENTER PROBLEMS!!!!!!!*/
			#pa {
				background-image: url("../images/UPVTC_Logo_200x196.png");
				background-repeat: no-repeat;
				background-position: center top;
			}
			
			.img{
				top: 20px;
				position: absolute; 
				width: 150px;
				left: 50px;
				margin-left: auto;
				margin-right: auto;
				opacity: 0.9;
			}
			
			.h1{
				position:absolute;
				left: 0;
				right: 0;
				margin: 0 auto;
				font-family: Roboto Thin;
				font-weight: normal;
				font-size:70px;
				text-align: center;
				color: black;
				
				top: 200px;
			}
			
			.button{
				position: absolute;
				
				padding-top: 10px;
				text-decoration:none;
				text-align: center;
				width: 200px;
				height: 45px;
				border: none;
				background: rgba(0, 0, 0, 0.7);
				color: white;
				font-family: Roboto Thin;
				font-size: 25px;
			}
			
			.button:hover{
				background: rgba(0, 0, 0, 0.8);
			}
		</style>

		
	</head>
		
	<body style = "margin:0;padding:0;">
	
		
		<iframe src="Home.html" name = "Base_A" frameborder="0" scrolling="no" width = 100% height = 100%  style = "position:absolute; 
				top:0px">
		</iframe>
		
		<h1 class = "h1">
			Use Inventory System as...
		</h1>
		
		<a href="../client/Client_Menu.html" class="button" style = "top: 300px; left: 450px;">
			Client
		</a>
		
		<a href="Admin_Menu.html" class = "button" style = "top: 300px; right: 450px;">
			Admin
		</a>
		
		<p style = "color: black; position: absolute; top: 615px; left: 600px" >&#169;All rights Reserved 2017 </p>
			

	</body>
</html>

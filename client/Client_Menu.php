<!DOCTYPE html>
<html>
	<?php
		session_start();
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
		<?php header('Cache-Control: no-cache, must-revalidate');?>
		<style>
/*CENTER PROBLEMS!!!!!!!*/
			#pa {
				background-image: url("../images/UPVTC_Logo_200x196.png");
				background-repeat: no-repeat;
				background-position: center top;
			}

			.container {	
				padding: 0px 0px 0px 894.5px;
				overflow: hidden;
				font-family: Century Gothic;	
			}

			.container a {
				float: right;
				font-size: 16px;
				color: black;
				text-align: center;
				padding: 14px 16px;
				padding-left: 30px;
				padding-right: 30px;
				text-decoration: none;
			}


			.container a:hover, .dropdown:hover .dropbtn {
    			background-color: green;
			}

			.button{

				display: block;
				background-color: rgba(255, 255, 255, 0.5);
				width: 250px;
				height: 330px;
				
				top: 290px;
				border: none;
			}
			
			.button:hover{
				background-color: rgba(250, 250, 250, 0.6);
			}
			
			.block{
				margin-top: 350px;
				width: 300px;
				margin-left: auto ;
				margin-right: auto ;
				background-color: black;
			}
			
			.h1{
				position:absolute;
				left: 0;
				right: 0;
				margin: 0 auto;
				font-family: Roboto Thin;
				font-weight: normal;
				font-size:150px;
				text-align: center;
				color: black;
				
				top: 70px;
			}
			
			
			.text{
				left: 0;
				right: 0;
				margin: 0 auto;
				position: absolute;
				font-family: Roboto Light;
				bottom: 110px;
				font-weight: normal;
				font-size: 40px; 
				text-align: center; 
				color: black;
				
				
			}
			
			.text2{
				position:absolute;
				font-family: Century Gothic;
				font-weight: normal;
				font-size: 20px; 
				text-align: center; 
				color: black;
				top: 200px;
			}
			
			.img{
				position: absolute; 
				left: 0;
				right: 0;
				display: block;
				margin: 0 auto;
				top: 20px;
				width: 150px;
				
				
				opacity: 0.9;
			}
			
		</style>

		
	</head>
		
	<body style = "margin:0;padding:0;">
	
	
		<iframe src="Home.html" name = "Base_A" frameborder="0" scrolling="no" width = "100%" height = "100%"  style = "position:absolute; 
				top:0px">
		</iframe>
		
		<div class = "block2">
			<h1 class = "h1">
				Welcome, user!
			</h1>
		</div>
		
		<div class="container" style = "position:absolute; top: 0px">
			<a href="../Log_In.php">Log out</a>
			<a href="#news">Contact</a>
			<a href="#request">About</a>
			<a href="#request">Home</a>
		</div>
		
		<button  onclick="location.href='Request_Form2.php';" class = "button" style = "left: 200px; position: absolute;">
			<img src = "../images/order.png" class = "img" style = "opacity: 0.75"></img>
			<h2 class = "text">
				RIS Request
			</h2>
			<h3 class = "text2">
				Ordering supplies now made easier! 
			</h3>
		</button>
		
		<button  onclick="location.href='Request_History.php';" class = "button" style = "display: block; position: absolute; left: 0; right: 0; margin: 0 auto; ">
			<img src = "../images/Followup.png" class = "img">
			</img>
			<h2 class = "text">
				RIS History
			</h2>
			<h3 class = "text2">
				Keep track of your requests by viewing the list of submitted requests
			</h3>
		</button>
		
		<button  class = "button" style = "right: 200px; margin: auto; position: absolute;">
			<img src = "../images/feedback1.png" class = "img" >
			</img>
			<h2 class = "text">
				Feedback
			</h2>
			<h3 class = "text2">
				Problems with the supplies delivered? Let your supplier know by giving a feedback!
			</h3>
		</button>
		
	
		<p style = "color: black; position: absolute; top: 615px; left: 600px" >&#169;All rights Reserved 2017 </p>
			

	</body>
</html>

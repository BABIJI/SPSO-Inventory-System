<?php
	require 'db.php';
	session_start();
?>

<?php 
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST['login']))
		{
			require 'login.php';
		}
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>SPSO Log In</title>
		<meta charset="utf-8">

	</head>
	<body style="background-color:white;">
		<!--style="border:2px solid Tomato;"background-image:url('images/UPVTC_Logo_200x196.png')-->
		<h1 style="text-align:center; color:maroon;font-size:250%;">
			<img src="../images/UPVTC_Logo_200x196.png" alt="UPVTC Logo" style = "width=100px;height=96px;">
			<br>S P S O<br>
			<!-- --><small>Supplies and Property Services Office</small>
		</h1><br>
		<form style="text-align:center;" action="index.php" method = "post" autocomplete="off">
			<!--Username:<br>-->
			<input type="text" name="username"  required autocomplete = "off" placeholder = "Username" style="text-align:center;font-size:20px;border: 0;outline: 0;background: transparent;
			border-bottom: 1px solid gray;"><br><br>
			<!--Last name:<br>-->
			<input type="password" name="password" required autocomplete = "off" placeholder = "Password" style="text-align:center;font-size:20px;border: 0;outline: 0;background: transparent;
			border-bottom: 1px solid gray;"><br><br>
			<input type="submit" value="Log-in" name="login" style="text-align:center;font-size:20px;">
		</form>
		<p1></p1>
	<footer style = "text-align: center;color:maroon">
		<p>&#169;All rights Reserved 2017
	</footer>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>
	</body>

</html>
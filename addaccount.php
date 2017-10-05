<?php
	require 'db.php';
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Account</title>
  <meta charset="utf-8">
</head>

<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_POST['createaccount']))
		{
			require 'createaccount.php'; 
		}
	}
?>
<body style="background-color:white;">

		<!--style="border:2px solid Tomato;"background-image:url('images/UPVTC_Logo_200x196.png')-->
		<h1 style="text-align:center; color:maroon;font-size:250%;">
			<img src="images/UPVTC_Logo_200x196.png" alt="UPVTC Logo" style = "width=100px;height=96px;">
			<br>S P S O<br>
			<!-- --><small>Supplies and Property Services Office</small>
		</h1><br>
		
		<form style="text-align:center;" action="addaccount.php" method = "post" autocomplete="off">
			<!--First Name:<br>-->
			<input type="text" name="first_name"  required autocomplete = "off" placeholder = "First Name" style="text-align:center;font-size:20px;border: 0;outline: 0;background: transparent;
			border-bottom: 1px solid gray;"><br><br>
			
			<!--Last Name:<br>-->
			<input type="text" name="last_name" required autocomplete = "off" placeholder = "Last Name" style="text-align:center;font-size:20px;border: 0;outline: 0;background: transparent;
			border-bottom: 1px solid gray;"><br><br>
			
			<!--Username:<br>-->
			<input type="text" name="username" required autocomplete = "off" placeholder = "Username" style="text-align:center;font-size:20px;border: 0;outline: 0;background: transparent;
			border-bottom: 1px solid gray;"><br><br>
			
			<!--Email Address:<br>-->
			<input type="email" name="email" required autocomplete = "off" placeholder = "Email" style="text-align:center;font-size:20px;border: 0;outline: 0;background: transparent;
			border-bottom: 1px solid gray;"><br><br>
			
			<!--Password:<br>-->
			<input type="password" name="password" required autocomplete = "off" placeholder = "Password" style="text-align:center;font-size:20px;border: 0;outline: 0;background: transparent;
			border-bottom: 1px solid gray;"><br><br>
		
			<input type="submit" value="Create Account" name="createaccount" style="text-align:center;font-size:20px;">
		</form>
		<p1></p1>
	<footer style = "text-align: center;color:maroon">
		<p>&#169;All rights Reserved 2017
	</footer>
</body>
</html>
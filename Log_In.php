<!DOCTYPE html>
<html>
	<head>
		<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
		<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
		<?php
			// remove all session variables
			if(session_status() == PHP_SESSION_ACTIVE)
			{
				session_unset(); 
				// destroy the session 
				session_destroy(); 
			}
			
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				if (isset($_POST['login']))
				{
					require 'login_processor.php';
				}
			}
		?>

		<title>SPSO Log In</title>
		<meta charset="utf-8">
		<style>
			.submit{
				text-align:center; 
				font-size:25px; 
				background-color: rgba(0,0,0,0) /*#b4b4b4*/; 
				border: none; 
				color: white;
				font-family: Roboto Light; 
				padding: 5px 5px 5px 5px; 
				width: 150px; 
				height: 50px; 
			}
			
			.submit:hover{
				background-color: rgba(255, 255, 255, 0.5)
			}
			
			h5 {
			
			text-align: center;
			font-family: Century Gothic;
			bottom: 0px;
			color: white;
		} 
		</style>
	</head>
	<body style = "margin: 0; padding: 0;">
		<iframe src="Background.html" name = "Base_A" frameborder="0" scrolling="no" width = 100% height = 100%  style = "position:absolute; 
				top:0px">
		</iframe>
		
		<!--<h4>Incorrect Username/Password!</h4>-->
		<form action="Log_in.php" method = "post" style="text-align:center; position: relative; top: 400px;">
			<!--<h5>Incorrect!</h5>-->
			<input type="text" name="username" placeholder = "Username" style="text-align:center;font-size:25px;border: 0;outline: 0;background: transparent;
				border-bottom: 1px solid gray; color: rgb(228, 228, 228); font-family: Century Gothic; padding: 5px ; width: 350px;"><br><br>
			
			<input type="password" name="password" placeholder = "Password" style="text-align:center;font-size:25px;border: 0;outline: 0;background: transparent;
				border-bottom: 1px solid gray; font-family: Century Gothic; Color: rgb(228, 228, 228); padding: 5px; width: 350px;"><br><br>
			
			<input class = "submit" type="submit" name = "login" value="Log-in" >
		</form>
		
		
		
	<p1></p1>
	</body>

</html>
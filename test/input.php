<HTML>
	<?php
		if($submit)
		{
			$db = mysql_connect("localhost", "root","");
			mysql_select_db("learndb",$db);
			$sql = "INSERT INTO personnel (firstname, lastname, nick, email, salary) VALUES ('$first','$last','$nickname','$result = mysql_query($sql)')";
			echo "Thank you! Information entered.\n";
		}
		else
		{
	?>
			<form method="get" action="input.php">
			First name:<input type="Text" name="first"><br>
			Last name:<input type="Text" name="last"><br>
			Nick Name:<input type="Text" name="nickname"><br>
			E-mail:<input type="Text" name="email"><br>
			Salary:<input type="Text" name="salary"><br>
			<input type="Submit" name="submit" value="Enter information"></form>
	<?php
		}
	?>
</HTML>
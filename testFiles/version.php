<HTML>
	<?php
		$db = new mysqli("localhost", "root", "1234", "learndb");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($db, "learndb");
		$result = mysqli_query($db, "SELECT * FROM personnel");
		echo "<TABLE>";
		echo"<TR><TD><B>Full Name</B><TD><B>Nick Name</B><TD><B>Salary</B></TR>";
		while ($myrow = mysqli_fetch_array($result))
		{
			echo "<TR><TD>";
			echo $myrow["firstname"];
			echo " ";
			echo $myrow["lastname"];
			echo "<TD>";
			echo $myrow["nick"];
			echo "<TD>";
			echo $myrow["salary"];
		}
		echo "</TABLE>";
	?>
</HTML>
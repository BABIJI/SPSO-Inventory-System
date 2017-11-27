<?php

			session_start();
			//echo ++$_SESSION["quantity_array"][0];
				//echo $_SESSION["button_array"][$x][1].' '.$_SESSION["quantity_array"][$x];
			//session_start();
			$x = 0;
			for ($x = 0; $x < count($_SESSION["quantity_array"]); $x++) {
				if($_SESSION["button_array"][$x][0] == $_POST["name"])
			{
				if($_SESSION["quantity_array"][$x] > 0)
				{
					$_SESSION["quantity_array"][$x]--;
					//echo $_SESSION["button_array"][$x][0].' '.$_SESSION["quantity_array"][$x];
				}
			}
			else if($_SESSION["button_array"][$x][1] == $_POST["name"])
				$_SESSION["quantity_array"][$x]++;
				//echo $_SESSION["button_array"][$x][1].' '.$_SESSION["quantity_array"][$x];
			}
		
	//	abc($idea);
		
	
		
		
		
?>
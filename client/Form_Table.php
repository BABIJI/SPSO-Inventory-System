<!DOCTYPE html>
<html>
	<?php
		
		session_start();
		$_SESSION["db"] = new mysqli("localhost", "root", "1234", "spso");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($_SESSION["db"], "spso");
		$_SESSION["result"] = mysqli_query($_SESSION["db"], "SELECT stock_no, description, Unit FROM supplies");
		$_SESSION["myrow"] = mysqli_num_rows ( $_SESSION["result"]);
		mysqli_close($_SESSION["db"]);
		
	?>
	
	<script>		
		var record_number = <?php echo  $_SESSION["myrow"];?>;
		
		function updateValue(id) {
			for(i = 0; i < record_number; i++){
				if((i+".right") == id){
					document.getElementById(i).innerHTML = parseInt(document.getElementById(i).innerHTML, 10)+1;
				}
				else if((i+".left") == id)
				{
					if((parseInt(document.getElementById(i).innerHTML, 10)) > 0){
						document.getElementById(i).innerHTML = parseInt(document.getElementById(i).innerHTML, 10)-1;
					}
					
				
				}
			}
		}
		//document.getElementById("quantity").innerHTML = document.getElementById("left").elements.length;
		
		</script>
	<head>
		<style>
			p{
				font-size: 16px;
				display: inline;
				padding: 8px;
			}
			
			
			table{
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 750px;
				white-space:nowrap;
				color:maroon;
				
			}
			
			td, th{
				border: 2px solid maroon;
				text-align: center;
				padding: 8px;
			}

			tr:nth-child(even) {
				background-color: #eee;
			}
			
			section{
			}
			
			#a{
				rowspan = "2";
			}
			
			.arrowheadLeft{
				align:left;
			}
			
			.arrowheadRight{
				align:right;
			}
		</style>
		<script src="jquery-3.2.1.js"></script>
		<script>
			
			function myAjax (clicked_id) {
				$.ajax({
					type: "POST",
					url: "php/AddQuantity.php",
					data: { name: clicked_id }
					error: function ( xhr ) {
						alert( "error" );
					}
				}).done(function( msg ) {
					//alert( "Incremented daw" + msg);
					window.location.reload();
				});

			};
		</script>
	</head>
	<body>
		<?php
		echo'<table align = "center">
			<col width="50">
			<col width="50">
			<col width="400">
			<col width="100">	
			<tr>
				<th id = "a">Stock No.</th>
				<th id = "a">Unit</th>
				<th id = "a">Description</th>
				<th id = "a">Qty</th>
			</tr>
		';
		$_SESSION["db"] = new mysqli("localhost", "root", "1234", "spso");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		mysqli_select_db($_SESSION["db"], "spso");
		$_SESSION["result"] = mysqli_query($_SESSION["db"], "SELECT stock_no, description, Unit FROM supplies");
		$x = 0;
		while($_SESSION["myrow"] = mysqli_fetch_array($_SESSION["result"]))
		{
			echo	'<tr>';
			echo	'<td id = "'.'$x'.'.stock">';		echo $_SESSION["myrow"]["stock_no"];	echo'</td>';
			echo	'<td id = "'.'$x'.'.unit">';		echo $_SESSION["myrow"]["Unit"];		echo'</td>';
			echo	'<td id = "'.'$x'.'descrptn">';		echo $_SESSION["myrow"]["description"];	echo'</td>';
			echo	'<td><button type="button" onclick = updateValue(this.id) id ="'.$x.'.left"';
			echo	'">&lArr;</button>';
							echo '<p id = "'.$x.'">0</p>';	
			echo '<button type="button" onclick = updateValue(this.id) id = "'.$x.'.right"';
			echo'">&rArr;</button>';
			echo'</td></tr>';
			$x++;
		}
		echo '</table>';
		mysqli_close($_SESSION["db"]);
		//session_unset();
		//session_destroy();
		//session_start();
		?>
		
	</body>
</head>